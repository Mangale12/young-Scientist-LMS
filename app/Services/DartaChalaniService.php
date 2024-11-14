<?php

namespace App\Services;
use App\Models\Image;
use App\Models\DartaChalani;
use App\Models\FiscalYear;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DartaChalaniRequest;
class DartaChalaniService extends DM_BaseService
{
    protected $folder_path_image;
    protected $folder_path_file;
    protected $folder = 'darta-chalani';
    protected $file   = 'file';
    protected $prefix_path_image = '/upload_file/darta-chalani/';
    protected $prefix_path_file = '/upload_file/darta-chalani/file/';
    protected $model;
    protected $image;
    protected $fiscalService;
    protected $officeService;
    protected $documentTypeService;
    protected $branchService;
    protected $userService;
    public function __construct(DartaChalani $model, Image $image, OfficeService $officeService, DocumentTypeService $documentTypeService, BranchService $branchService, FiscalYearService $fiscalService, UserService $userService)
    {
        $this->branchService = $branchService;
        $this->documentTypeService = $documentTypeService;
        $this->officeService = $officeService;
        $this->fiscalService = $fiscalService;
        $this->userService = $userService;
        $this->image;
        $this->model = $model;
        $this->folder_path_image = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR;
        $this->folder_path_file = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $this->file . DIRECTORY_SEPARATOR;
    }

    public function getAll(){
        return $this->model::all();
    }
    public function getOldData() {
        return $this->model::where('is_old', 1)
                    ->where('is_approved', 0)
                    ->get();
    }

   public function getDarta() {
       return $this->model::where('is_darta', 1)
                    ->where('is_approved', 0)
                    ->where('is_old', 0)
                    ->get();
   }
   public function getAllDarta() {
        return $this->model::where('is_darta', 1)
                            ->OrWhere('darta_no', '!=', null)
                            ->get();
   }
   public function getApprovedDarta() {
    return $this->model::where('is_approved', 1)
                        ->where('is_darta', 1)
                        ->where('is_old', 0)
                        ->get();
   }
   public function getChalani(){
    return $this->model::where('is_darta', 0)
                        ->where('is_approved', 0)
                        ->where('is_old', 0)
                        ->get();
   }

    public function getAllChalani() {
        return $this->model::where('is_darta', 0)
                            ->OrWhere('chalani_no', '!=', null)
                            ->get();
    }
    public function getApprovedChalani() {
        return $this->model::where('is_approved', 1)
                            ->where('is_old', 0)
                            ->where('is_darta', 0)
                            ->get();
    }

    public function getApproved(){
        return $this->model::where('is_approved', 1)
                            ->get();
    }
    public function getPending(){
        return $this->model::where('is_approved', 0)
                            ->get();
    }
   public function getFiscal(){
    return $this->fiscalService->getAll();
   }
   public function getOffice(){
    return $this->officeService->getAll();
   }
   public function getBranch(){
    return $this->branchService->getAll();
   }
   public function getUser(){
    return $this->userService->getAll();
}
   public function getDocumentType(){
    return $this->documentTypeService->getAll();
   }
    public function getById($id){
        return $this->model::find($id);
    }

    public function storeOrUpdate(DartaChalaniRequest $request, $id = null) // Keep it as the custom request type
    {
        try {
            DB::beginTransaction();
            // If updating, find the existing record
            if ($id) {
                $record = $this->model::findOrFail($id);
            } else {
                $record = new DartaChalani();
            }

            // Common fields
            $record->fiscal_year_id = $request->fiscal_year_id;
            $record->subject = $request->subject;
            $record->name = $request->name;
            $record->date = $request->date;
            $record->added_date = $request->date;
            $record->branch_id = $request->branch_id;
            $record->user_id = auth()->user()->id;
            $record->office_id = $request->office_id;
            $record->unique_id = parent::generateUniqueRandomNumber('darta_chalanis', 'unique_id');
            $record->remarks = $request->remarks;
            $record->ward_id = auth()->user()->ward_id;
            // Set darta_no and chalani_no based on is_darta flag
            if ($request->is_darta) {
                $record->darta_no = getNepToEng($request->darta_no ?? $this->generateDartaNo()); // generate new darta_no if null
                $record->chalani_no = null; // chalani_no should be null
                $record->is_darta = true; // set is_darta flag to true
            } elseif ($request->is_old) { //
                $record->darta_no = getNepToEng($request->darta_no); // darta_no should be null
                $record->chalani_no = getNepToEng($request->chalani_no); // chalani_no should not be null
                $record->is_old = true; // set is_darta flag to false
            }
            else {
                $record->chalani_no = $request->chalani_no ?? $this->generateChalaniNo(); // generate new chalani_no if null
                $record->darta_no = null; // darta_no should be null
                $record->is_darta = false; // set is_darta flag to false
            }
            // Save the record
            $record->document_type_id = $request->document_type_id;
            $record->save();

            if (isset($request->document)) {
                foreach ($request->document as $document) {
                    $image = new Image(); // Create a new Image model instance
                    // Upload each image and store the path
                    $imagePath = parent::uploadImage($document['image'], $this->folder_path_image, $this->prefix_path_image);
                    $image->image_path = $imagePath;
                    $image->darta_chalani_id = $record->id;
                    $image->document_type_id = $document['document_type'];
                    $image->key = parent::generateUniqueRandomNumber('images', 'key');
                    // Get and optionally save the image size
                    // $image->size = $document['image']->getSize();
                    $image->save();
                }
            }

            DB::commit(); // Commit the transaction
            return $record;
        } catch (\Throwable $th) {
            DB::rollBack(); // Rollback the transaction if an error occurs
            dd($th);
            return false;

            throw $th;
        }

    }

    public function getImageByKey($key){
        return Image::where('key', $key)->firstOrFail();
    }
    public function downloadImage($key)
    {
        $image = $this->getImageByKey($key);

        if ($image && file_exists(public_path($image->image_path))) {
            // Increment download count
            $image->download_count++;
            $image->save();

        } else {
            return false;
        }
    }

    // public function create($data)
    // {
    //     $dartaChalani = new DartaChalani();
    //     try {
    //         DB::beginTransaction(); // Start transaction

    //         // Save the Chalani record
    //         $dartaChalani->subject = $data['subject'];
    //         $dartaChalani->no = $data['no'];
    //         $dartaChalani->fiscal_year_id = $data['fiscal_year_id'];
    //         $dartaChalani->date = $data['date'];
    //         $dartaChalani->name = $data['name'];
    //         $dartaChalani->branch = $data['branch'];
    //         $dartaChalani->remarks = $data['remarks'];
    //         $dartaChalani->unique_id = parent::generateUniqueRandomNumber('chalanis', 'unique_id');
    //         $darta->save(); // Save chalani record to get chalani_id

    //         // Handle images if present
    //         if (isset($data['image'])) {
    //             foreach ($data['image'] as $imageFile) {
    //                 $image = new Image(); // Create a new Image model instance

    //                 // Upload each image and store the path
    //                 $imagePath = parent::uploadImage($imageFile, $this->folder_path_image, $this->prefix_path_image);

    //                 // Assign image path and associate it with the Chalani record
    //                 $image->image_path = $imagePath;
    //                 $image->darta_id = $darta->id;
    //                 // Save image record
    //                 $image->save();
    //             }
    //         }


    //         DB::commit(); // Commit transaction after successful save of Chalani and images

    //         return true;
    //     } catch (Exception $e) {
    //         DB::rollBack(); // Rollback transaction in case of an error
    //         return false;
    //     }
    // }

    // public function update($id, $data){
    //     $darta = $this->model::find($id);
    //     if($chalani){
    //         return $chalani->update($data);
    //         try {
    //             if(isset($data['images'])){
    //                 foreach($data['images'] as $image){
    //                     if(parrent::deleteImage($image))
    //                     $image = new Image;
    //                     $image->image_path = $imageFile = parent::uploadFile($request, $this->folder_path_image, $this->prefix_path_image, 'image');
    //                     $image->darta_id = $darta->id;
    //                     $image->save();
    //                 }
    //                 DB::commit();
    //                 return true;
    //             }
    //         }catch(Exception $e){
    //             DB::rollBack();
    //             return false;
    //         }
    //     }
    //     return false;
    // }
    public function delete($id){
        $record = $this->getById($id);
        if($record->images->isNotEmpty()) {
            // Delete images associated with the record
            // $images = Image::where('darta_chalani_id', $id)->get();
            foreach ($record->images as $image) {
                parent::deleteImage($image->image_path);
                $image->delete();
            }
        }
        $record->delete();
        return true;
    }

     // Method to generate darta_no
     public function generateDartaNo()
     {
         $lastDartaNo = $this->model::latest('id')->whereNotNull('darta_no')->first();
         return $lastDartaNo ? $lastDartaNo->darta_no + 1 : 1; // Increment last darta_no or start from 1
     }

     // Method to generate chalani_no
     public function generateChalaniNo()
     {
         $lastChalaniNo = $this->model::latest('id')->whereNotNull('chalani_no')->first();
         return $lastChalaniNo ? $lastChalaniNo->chalani_no + 1 : 1; // Increment last chalani_no or start from 1
     }
    public function getDartaNo()
    {
        $lastDartaNo = $this->model::latest('id')->value('no'); // Use 'value' to get the actual 'no' value
        if ($lastDartaNo) {
            $lastDartaNo++; // Increment the numeric value directly
        } else {
            $lastDartaNo = 1; // Start from 1 if no record exists
        }
        return $lastDartaNo;
    }

    public function updateStatus($id){
        $record = $this->getById($id);
        if($record){
            $record->is_approved = 1;
            $record->approved_date = getNepToEng(datenepUnicode(date('Y-m-d'), 'nepali'));
            $record->approved_user_id = auth()->user()->id;
            return $record->save();
        }
        return false;
    }

    public function getChalaniWardData($request){
        $chalni = $this->model::with('fiscalYear')
                                ->with('office')
                                ->with('branch')
                                ->with('documentType');
        if($request->fiscal_year_id){
            $chalni->where('fiscal_year_id', $request->fiscal_year_id);
        }
        if($request->office_id){
            $chalni->where('office_id', $request->office_id);
        }
        if($request->branch_id){
            $chalni->where('branch_id', $request->branch_id);
        }
        if($request->ward_id){
            $chalni->where('ward_id', $request->ward_id);
        }
        if($request->chalani_no){
            $chalni->where('chalani_no', $request->chalani_no);
        }
        // if($request->start_date) {
        //     $chalni = $chalni->whereRaw("STR_TO_DATE(date, '%Y-%m-%d') >= STR_TO_DATE(?, '%Y-%m-%d')", [$request->start_date])
        //          ->orWhereRaw("STR_TO_DATE(date, '%Y/%m/%d') >= STR_TO_DATE(?, '%Y/%m/%d')", [$request->start_date]);
        // }
        // if($request->end_date) {
        //     $chalni = $chalni->whereRaw("STR_TO_DATE(date, '%Y-%m-%d') <= STR_TO_DATE(?, '%Y-%m-%d')", [$request->start_date])
        //          ->orWhereRaw("STR_TO_DATE(date, '%Y/%m/%d') <= STR_TO_DATE(?, '%Y/%m/%d')", [$request->start_date]);
        // }
        if($request->type == 'chalani') {
            return $chalni->where('is_darta', 0)->get();
        }else if($request->type == 'darta') {
            return $chalni->where('is_darta', 0)->get();
        }

    }

    public function getDartaWardData($request){
        $chalni = $this->model::with('fiscalYear')
                                ->with('office')
                                ->with('branch')
                                ->with('documentType');
        if($request->fiscal_year_id){
            $chalni->where('fiscal_year_id', $request->fiscal_year_id);
        }
        if($request->office_id){
            $chalni->where('office_id', $request->office_id);
        }
        if($request->branch_id){
            $chalni->where('branch_id', $request->branch_id);
        }
        if($request->ward_id){
            $chalni->where('ward_id', $request->ward_id);
        }
        if($request->chalani_no){
            $chalni->where('darta_no', $request->chalani_no);
        }
        // if($request->start_date) {
        //     $chalni = $chalni->whereRaw("STR_TO_DATE(date, '%Y-%m-%d') >= STR_TO_DATE(?, '%Y-%m-%d')", [$request->start_date])
        //          ->orWhereRaw("STR_TO_DATE(date, '%Y/%m/%d') >= STR_TO_DATE(?, '%Y/%m/%d')", [$request->start_date]);
        // }
        // if($request->end_date) {
        //     $chalni = $chalni->whereRaw("STR_TO_DATE(date, '%Y-%m-%d') <= STR_TO_DATE(?, '%Y-%m-%d')", [$request->start_date])
        //          ->orWhereRaw("STR_TO_DATE(date, '%Y/%m/%d') <= STR_TO_DATE(?, '%Y/%m/%d')", [$request->start_date]);
        // }
        if($request->type == 'darta') {
            return $chalni->where('is_darta', 1)->get();
        }else if($request->type == 'darta') {
            return $chalni->where('is_darta', 1)->get();
        }

    }
    public function deleteImage($id){
        $image = Image::find($id);
        if($image){
            parent::deleteImage($image->image_path);
            $image->delete();
            return true;
        }
        return false;
    }

    public function getStatusText($status)
    {
        switch ($status) {
            case 1:
                return 'Approved';
            case 0:
                return 'Pending';
            default:
                return 'Unknown';
        }
    }


}

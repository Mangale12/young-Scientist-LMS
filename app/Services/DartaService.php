<?php

namespace App\Services;
use App\Models\Darta;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
class DartaService extends DM_BaseService
{
    protected $folder_path_image;
    protected $folder_path_file;
    protected $folder = 'darta';
    protected $file   = 'file';
    protected $prefix_path_image = '/upload_file/darta/';
    protected $prefix_path_file = '/upload_file/darta/file/';
    protected $model;
    protected $image;


    public function __construct(Darta $model, Image $image)
    {
        $this->image;
        $this->model = $model;
        $this->folder_path_image = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR;
        $this->folder_path_file = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $this->file . DIRECTORY_SEPARATOR;
    }

    public function getAll(){
        return $this->model::with('fiscalYear') // Eager load 'fiscalYear'
                            ->where('status', 0) // Add status filter
                            ->whereHas('fiscalYear') // Ensure there's a fiscal year relationship
                            ->get(); // Execute the query and get the results
    }

    public function getById($id){
        return $this->model::find($id);
    }
    public function create($data)
    {
        $darta = new Darta();
        try {
            DB::beginTransaction(); // Start transaction

            // Save the Chalani record
            $darta->subject = $data['subject'];
            $darta->no = $data['no'];
            $darta->fiscal_year_id = $data['fiscal_year_id'];
            $darta->date = $data['date'];
            $darta->name = $data['name'];
            $darta->branch = $data['branch'];
            $darta->remarks = $data['remarks'];
            $darta->unique_id = parent::generateUniqueRandomNumber('chalanis', 'unique_id');
            $darta->save(); // Save chalani record to get chalani_id

            // Handle images if present
            if (isset($data['image'])) {
                foreach ($data['image'] as $imageFile) {
                    $image = new Image(); // Create a new Image model instance

                    // Upload each image and store the path
                    $imagePath = parent::uploadImage($imageFile, $this->folder_path_image, $this->prefix_path_image);

                    // Assign image path and associate it with the Chalani record
                    $image->image_path = $imagePath;
                    $image->darta_id = $darta->id;
                    // Save image record
                    $image->save();
                }
            }


            DB::commit(); // Commit transaction after successful save of Chalani and images

            return true;
        } catch (Exception $e) {
            DB::rollBack(); // Rollback transaction in case of an error
            return false;
        }
    }

    public function update($id, $data){
        $darta = $this->model::find($id);
        if($chalani){
            return $chalani->update($data);
            try {
                if(isset($data['images'])){
                    foreach($data['images'] as $image){
                        if(parrent::deleteImage($image))
                        $image = new Image;
                        $image->image_path = $imageFile = parent::uploadFile($request, $this->folder_path_image, $this->prefix_path_image, 'image');
                        $image->darta_id = $darta->id;
                        $image->save();
                    }
                    DB::commit();
                    return true;
                }
            }catch(Exception $e){
                DB::rollBack();
                return false;
            }
        }
        return false;
    }
    public function delete($id){
        return $this->model::destroy($id);
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

    public function getDartaFile($id){
        return $this->model::find($id)->images()->get();
    }
    public function updateStatus($id){
        $darta = $this->model::find($id);
        if($darta){
            $darta->status = 1;
            return $darta->save();
        }
        return false;
    }
}

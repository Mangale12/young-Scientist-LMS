<?php

namespace App\Services;
use App\Models\Chalani;
use App\Models\Image;
use DB;
class ChalaniService extends DM_BaseService
{
    protected $folder_path_image;
    protected $folder_path_file;
    protected $folder = 'chalani';
    protected $file   = 'file';
    protected $prefix_path_image = '/upload_file/chalani/';
    protected $prefix_path_file = '/upload_file/chalani/file/';
    protected $model;
    protected $image;

    public function __construct(Chalani $model, Image $image)
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
        $chalani = new Chalani();
        try {
            DB::beginTransaction(); // Start transaction

            // Save the Chalani record
            $chalani->subject = $data['subject'];
            $chalani->no = $data['no'];
            $chalani->fiscal_year_id = $data['fiscal_year_id'];
            $chalani->date = $data['date'];
            $chalani->name = $data['name'];
            $chalani->branch = $data['branch'];
            $chalani->remarks = $data['remarks'];
            $chalani->unique_id = parent::generateUniqueRandomNumber('chalanis', 'unique_id');
            $chalani->save(); // Save chalani record to get chalani_id

            // Handle images if present
            if (isset($data['image'])) {
                foreach ($data['image'] as $imageFile) {
                    $image = new Image(); // Create a new Image model instance

                    // Upload each image and store the path
                    $imagePath = parent::uploadImage($imageFile, $this->folder_path_image, $this->prefix_path_image);

                    // Assign image path and associate it with the Chalani record
                    $image->image_path = $imagePath;
                    $image->chalani_id = $chalani->id;

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
        $chalani = $this->model::find($id);
        if($chalani){
            return $chalani->update($data);
            try {
                if(isset($data['images'])){
                    foreach($data['images'] as $image){
                        if(parrent::deleteImage($image))
                        $image = new Image;
                        $image->image_path = $imageFile = parent::uploadFile($request, $this->folder_path_image, $this->prefix_path_image, 'image');
                        $image->chalani_id = $chalani->id;
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

    public function getChalaniNo(){
        $lastChalaniNo = $this->model::where('status', 0)->max('no');
        if($lastChalaniNo){
            $lastChalaniNo++;
        }else{
            $lastChalaniNo = 1;
        }
        return $lastChalaniNo;
    }

    public function getChalaniFile($id){
        return $this->model::find($id)->images()->get();
    }
    public function updateStatus($id){
        $chalani = $this->model::find($id);
        if($chalani){
            $chalani->status = 1;
            return $chalani->save();
        }
        return false;
    }

}

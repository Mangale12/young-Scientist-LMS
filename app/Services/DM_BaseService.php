<?php

namespace App\Services;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DM_BaseService
{

    protected $lang;
    protected function getLangId($lang_code) {
        $lang_id = Language::where('code', '=', $lang_code)->pluck('id')->all();
        return $lang_id;
    }

    /**
     * To upload single file
     *
     * call from child controller
     *
     */
    protected function uploadFile($folder_path, $image_prefix_path, $name, $logo, $request) {
        if($request->hasFile($name)){
            $this->createFolder($folder_path);
               $file = $request->file($name);
               $file_name = time().'_'.rand().'_'.$file->getClientOriginalName();
            //    $file_extension = $file->getClientOriginalExtension();
               $file->move($folder_path, $file_name);
               $file_path = $image_prefix_path.$file_name;
               return $file_path;
           }
        return false;
    }

    public function deleteFile($folder_path, $row,$name){
        if(is_file($folder_path.$row->$name)){
            unlink($folder_path.$row->$name);
         }
    }
    /**
     * Method to upload Images
     *
     * call from child controller
     *
     */
    // protected function uploadImage(Request $request, $folder_path_image, $prefix_path_image, $name, $image_width = '', $image_height = '') {
    //     if($request->hasFile($name)){
    //         $this->createFolder($folder_path_image);
    //             $file = $request->file($name);
    //             $file_name = time().'_'.rand().'_'.$file->getClientOriginalName();
    //         //    $file_extension = $file->getClientOriginalExtension();
    //             if(isset($image_height) && isset($image_width)){
    //                 $file_resize = Image::make($file->getRealPath());
    //                 $file_resize->resize($image_width, $image_height);
    //                 $file_resize->save($folder_path_image.$file_name);
    //             }
    //             else{
    //                 $file->move($folder_path_image, $file_name);
    //             }
    //             $file_path = $prefix_path_image.$file_name;
    //            return $file_path;
    //        }
    //     return false;
    // }

    protected function uploadImage($file, $folder_path_image, $prefix_path_image, $image_width = '', $image_height = '') {
        // Check if the file exists
        if ($file) {
            // Create folder if not exists
            $this->createFolder($folder_path_image);

            // Generate unique file name
            $file_name = time() . '_' . rand() . '_' . $file->getClientOriginalName();

            // If resizing is specified
            if (!empty($image_width) && !empty($image_height)) {
                // Resize and save the image
                $file_resize = \Intervention\Image\Facades\Image::make($file->getRealPath());
                $file_resize->resize($image_width, $image_height);
                $file_resize->save($folder_path_image . $file_name);
            } else {
                // Save the file without resizing
                $file->move($folder_path_image, $file_name);
            }

            // Return the file path to store in the database
            $file_path = $prefix_path_image . $file_name;
            return $file_path;
        }

        return false; // If no file is uploaded, return false
    }

    /**
     * upload Multiple Files
     * call from child controller
     */
    protected function uploadMultipleFiles(Request $request, $folder_path_file, $prefix_path_file, $name) {
        if($request->hasFile($name)){
            $this->createFolder($folder_path_file);
                $files = $request->file($name);
                foreach($files as $file){
                    $file_name = time().'_'.rand().'_'.$file->getClientOriginalName();
                //    $file_extension = $file->getClientOriginalExtension();
                    $file->move($folder_path_file, $file_name);
                    $files_path[] = $prefix_path_file.$file_name;
                }
            return $files_path;
           }
        return false;
    }

    /**
     * if folder does not exist then create new and give permission
    *  */
    protected function createFolder($folder_path_image) {
        // Check if the folder exists, if not, create it with appropriate permissions
        if (!is_dir($folder_path_image)) {
            mkdir($folder_path_image, 0775, true);
        }
    }


    /** Parse the json data for the menu
     * Used for nestable
    */
    protected function parseJsonArray($jsonArray, $parentID = Null) {
        $return = array();
        foreach ($jsonArray as $subArray) {
            $returnSubSubArray = array();
            if (isset($subArray->children)) {
                $returnSubSubArray = $this->parseJsonArray($subArray->children, $subArray->id );
            }
            $return[] = array('id' => $subArray->id, 'parentID' => $parentID);
            $return = array_merge($return, $returnSubSubArray);
        }
        return $return;
    }

    protected function uniqueParseJsonArray($jsonArray, $parentID = Null) {
        $return = array();
        foreach($jsonArray as $subArray) {
            $returnSubSubArray = array();
            if (isset($subArray->children)) {
                $returnSubSubArray = $this->parseJsonArray($subArray->children, $subArray->id );
            }
           $return[] = array('id' => $subArray->id, 'unique' => $subArray->unique, 'parentID' => $parentID);
           $return = array_merge($return, $returnSubSubArray);
        }
        return $return;
    }
    public function deleteImage($imagePath) {
        // dd($imagePath);

        // Assuming $imagePath is the path of the image to be deleted
        if (file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath)); // Deletes the file
            return true;
        }else {
            return false; // Returns false if the file does not exist
        }
    }

    function generateUniqueRandomNumber($table, $column) {
        do {
            // Generate an 8-digit random number
            $number = mt_rand(10000000, 99999999);

            // Check if the number already exists in the database
            $exists = DB::table($table)->where($column, $number)->exists();

        } while ($exists); // Repeat until a unique number is found

        return $number;
    }
}

<?php

namespace App\Services;
use App\Models\Setting;
use App\Http\Requests\SettingRequest;
class SettingService extends DM_BaseService
{
    protected $model;
    protected $folder_path_image;
    protected $folder_path_file;
    protected $folder = 'setting';
    protected $file   = 'file';
    protected $prefix_path_image = '/upload_file/setting/';
    protected $prefix_path_file = '/upload_file/setting/file/';
    public function __construct(Setting $model)
    {
        $this->model = $model;
        $this->folder_path_image = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR;
        $this->folder_path_file = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $this->file . DIRECTORY_SEPARATOR;
    }
    public function getAll(){
        return $this->model->first();
    }
    public function getById($id){
        return $this->model->find($id);
    }
    public function update(SettingRequest $request){
        try {
            $model = $this->getAll();
            $model->site_name = $request->site_name;
            $model->email = $request->email;
            $model->contact_name = $request->contact_name;
            $model->phone = $request->phone;
            $model->mobile = $request->mobile;
            $model->address = $request->address;
            $model->second_address = $request->second_address;
            if($request->hasFile('logo')){
                parent::deleteImage($model->logo);  // Delete old image if exists
                $model->logo = parent::uploadImage($request->logo, $this->folder_path_image, $this->prefix_path_image);
            }
            $model->save();
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return false;
        }

    }
    // Your business logic here
}

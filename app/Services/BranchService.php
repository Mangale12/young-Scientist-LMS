<?php

namespace App\Services;
use App\Models\Branch;
class BranchService extends DM_BaseService
{
    protected $model;
    protected $folder = 'branches';
    protected $prefix_path = '/upload_file/branches/';
    public function __construct(Branch $model)
    {
        $this->model = $model;
    }
    public function getAll(){
        return $this->model::all();
    }
    public function getById($id){
        return $this->model::findOrFail($id);
    }
    public function create($data)
    {
        return $this->model::create($data);
    }
    public function update($data,$id){
        $branch = $this->getById($id);
        if($branch){
            return $branch->update($data);
        }
        return false;
    }
    public function delete($id){
        return $this->model::destroy($id);
    }

}

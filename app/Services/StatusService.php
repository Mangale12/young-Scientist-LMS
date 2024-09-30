<?php

namespace App\Services;
use App\Models\Status;
class StatusService
{
    protected $model;
    public function __construct(Status $model){
        $this->model = $model;
    }
    public function getAll(){
        return $this->model->all();
    }
    public function getById($id){
        return $this->model->findOrFail($id);
    }
    public function storeOrUpdate($data, $id = null){
        try {
            if($id){
                $status = $this->getById($id);
            } else {
                $status = new $this->model;
            }
            $status->fill($data);
            $status->save();
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }

    }
    public function destroy($id){
        $status = $this->getById($id);
        $status->delete();
    }
}

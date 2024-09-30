<?php

namespace App\Services;
use App\Models\Position;
class PositionService extends DM_BaseService
{
    protected $model;
    public function __construct(Position $model){
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
                $position = $this->getById($id);
            } else {
                $position = new $this->model;
            }
            $position->fill($data);
            $position->save();
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }

    }
    public function destroy($id){
        $position = $this->getById($id);
        $position->delete();
    }
}

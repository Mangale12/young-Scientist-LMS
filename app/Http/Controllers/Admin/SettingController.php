<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Repositories\SettingRepositoryInterface;

class SettingController extends DM_BaseController
{
    protected $repository;
    protected $panel = "Setting";
    protected $base_route = 'admin.setting';
    protected $view_path = 'admin.setting';
    public function __construct(SettingRepositoryInterface $repository){
        $this->repository = $repository;
    }
    public function index(){
        $data = $this->repository->getById(1);
        return view(parent::loadView($this->view_path.'.index'), compact('data'));
    }
    public function update(SettingRequest $request){
        if($this->repository->update(1, $request)){
            session()->flash('alert-success', 'Data Created Succefully ! ');
            return redirect()->route($this->base_route.'.index');
        }else{
            $request->session()->flash('alert-danger', 'Data creation unsuccess !');
            return redirect()->route($this->base_route.'.index');
        }
    }
}

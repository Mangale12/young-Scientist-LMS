<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\TeacherRepositoryInterface;
use App\Http\Requests\TeacherRequest;

class TeacherController extends DM_BaseController
{
    protected $repository;
    protected $base_route = 'site.teacher';
    protected $view_path = 'site.teacher';
    public function __construct(TeacherRepositoryInterface $repository){
        $this->repository = $repository;
    }
    public function index(){
        $teachers = $this->repository->getAll();
        return view($this->view_path.'.index', compact('teachers'));
    }
    public function create(){
        return view($this->view_path.'.create');
    }
    public function store(TeacherRequest $request){
        return $this->repository->create($request);
    }
        
    
}

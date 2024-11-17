<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\TeacherRepositoryInterface;
use App\Http\Requests\TeacherRequest;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends DM_BaseController
{
    protected $repository;
    protected $base_route = 'site.teacher';
    protected $view_path = 'site.teacher';
    protected $panel = "Teacher";
    public function __construct(TeacherRepositoryInterface $repository){
        $this->repository = $repository;
    }
    public function index(){
        $this->view_path = 'admin.teachers';
        $this->base_route = 'admin.teachers';
        return view(parent::loadView($this->view_path.'.index'));
    }

    // Fetch data for the DataTable
    public function getData(Request $request)
    {
        $this->base_route = 'admin.teachers';
        $this->view_path = 'admin.teachers';
        if ($request->ajax()) {
            $data = $this->repository->getAll();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editButton = view('admin.section.buttons.button-edit', ['id' => $row->id, 'route' => route($this->base_route.'.edit', $row->id)]);
                    $deleteButton = view('admin.section.buttons.button-delete', ['id' => $row->id, 'route' => route($this->base_route.'.destroy', $row->id)]);
                    $addChapter = view('admin.section.buttons.button-add-chapter', ['id' => $row->id, 'route' => route($this->base_route.'.chapters', $row->id)]);
                    return $editButton.' '.$deleteButton. ' '.$addChapter;
                })
                ->addColumn('name', function($row){
                    $row->user->name;
                })
                ->addColumn('email', function($row){
                    $row->user->email;
                })
                ->rawColumns(['action']) // Render both columns as HTML
                ->make(true);
        }
    }


    public function create(){
        return view($this->view_path.'.create');
    }
    public function store(TeacherRequest $request){
        return $this->repository->create($request);
    }
        
    
}

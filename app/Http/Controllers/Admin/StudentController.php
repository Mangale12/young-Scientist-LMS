<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\StudentRepositoryInterface;
use App\Http\Requests\StudentRequest;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends DM_BaseController
{
    protected $repository;
    protected $panel = 'Student';
    protected $base_route = 'admin.students';
    protected $view_path = 'admin.students';

    public function __construct(StudentRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function index(){
        return view(parent::loadView($this->view_path.'.index'));
    }
    public function dashboard(){
        return view('site.student.dashboard');
    }

    // Fetch data for the DataTable
    public function getData(Request $request){
        if ($request->ajax()) {
            $data = $this->repository->getAll();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editButton = view('admin.section.buttons.button-edit', ['id' => $row->id, 'route' => route($this->base_route . '.edit', $row->id)]);
                    $deleteButton = view('admin.section.buttons.button-delete', ['id' => $row->id, 'route' => route($this->base_route . '.destroy', $row->id)]);

                    return $editButton . ' ' . $deleteButton;
                })
                ->rawColumns(['action']) // To render HTML content
                ->make(true);
        }

    }

    public function create() {
        return view(parent::loadView($this->view_path.'.create'));
    }
    public function store(StudentRequest $request) {
        return $this->repository->create($request);
        
    }
}

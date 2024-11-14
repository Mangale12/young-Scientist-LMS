<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\GradeRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\GradeRequest;
class GradeController extends DM_BaseController
{
    protected $repository;
    protected $panel = 'Grade';
    protected $base_route = 'admin.grade';
    protected $view_path = 'admin.grade';
    public function __construct(GradeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    } 
    public function index()
    {
        return view(parent::loadView($this->view_path.'.index'));
        $data['rows'] = $this->repository->all();
        
        return response()->json($grades);
    }

    // Fetch data for the DataTable
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data =$this->repository->getAll();
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
    public function create(){
        return view(parent::loadView($this->view_path.'.create'));
    }

    public function store(GradeRequest $request){
        if($this->repository->create($request)){
            session()->flash('alert-success', 'Data created successfully !');
            return redirect()->route($this->base_route.'.index');
        }else{
            $request->session()->flash('alert-danger', 'Data creation failed!');
            return redirect()->back();
        }
    }

    public function edit($id){
        $data['rows'] = $this->repository->getById($id);
        return view(parent::loadView($this->view_path.'.edit'), compact('data'));
    }

    public function update(GradeRequest $request, $id){
        if($this->repository->update($id, $request)){
            session()->flash('alert-success', 'Data updated successfully!');
            return redirect()->route($this->base_route.'.index');
        }else{
            $request->session()->flash('alert-danger', 'Data update failed!');
            return redirect()->back();
        }
    }

    public function delete($id){
        $this->repository->delete($id);
        session()->flash('alert-success', 'Data deleted successfully!');
        return redirect()->route($this->base_route.'.index');
    }
}

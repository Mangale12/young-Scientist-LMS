<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SchoolRepositoryInterface;
use App\Http\Requests\SchoolRequest;
use Yajra\DataTables\Facades\DataTables;
class SchoolController extends DM_BaseController
{
    protected $repository;
    protected $panel = 'School';
    protected $base_route = 'admin.school';
    protected $view_path = 'admin.school';
    public function __construct(SchoolRepositoryInterface $repository){
        $this->repository = $repository;
    }
    public function index(){
        return view(parent::loadView($this->view_path.'.index'));
        $data['rows'] = $this->repository->all();
        
        return response()->json($schools);
    }
    // Fetch data for the DataTable
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->repository->getAll();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editButton = view('admin.section.buttons.button-edit', ['id' => $row->id, 'route' => route($this->base_route.'.edit', $row->id)]);
                    $deleteButton = view('admin.section.buttons.button-delete', ['id' => $row->id, 'route' => route($this->base_route.'.destroy', $row->id)]);

                    return $editButton.' '.$deleteButton;
                })
                ->rawColumns(['action']) // To render HTML content
                ->make(true);
        }
    }
    public function create(){
        return view(parent::loadView($this->view_path.'.create'));
    }
    public function store(SchoolRequest $request){
        if($this->repository->create($request)){
            session()->flash('alert-success', 'Data created successfully!');
            return redirect()->route($this->base_route.'.index');
        }else{
            session()->flash('alert-danger', 'Data created Failed !');
            return redirect()->route($this->base_route.'.index');
        }
    }

    public function edit($id){
        $data['rows']=$this->repository->getById($id);
        return view(parent::loadView($this->view_path.'.edit'), compact('data'));
    }

    public function update(SchoolRequest $request, $id){
        if($this->repository->update($id, $request)){
            session()->flash('alert-success', 'Data updated successfully!');
            return redirect()->route($this->base_route.'.index');
        }else{
            session()->flash('alert-danger', 'Data updated failed!');
            return redirect()->route($this->base_route.'.index');
        }
    }

    public function delete($id){
        $this->repository->delete($id);
        session()->flash('alert-success', 'Data deleted successfully!');
        return redirect()->route($this->base_route.'.index');
    }
}

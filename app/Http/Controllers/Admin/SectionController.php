<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SectionRequest;
use App\Repositories\SectionRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;

class SectionController extends DM_BaseController
{
    protected $panel = "Section";
    protected $base_route = 'admin.section';
    protected $view_path = 'admin.school-section';
    protected $repository;

    public function __construct(SectionRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function index(){
        return view(parent::loadView($this->view_path.'.index'));
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

    public function store(SectionRequest $request){
        if($this->repository->create($request)){
            session()->flash('alert-success', 'Data Created Successfully!');
            return redirect()->route($this->base_route.'.index');
        }else{
            session()->flash('alert-danger', 'Data Creation Failed!');
            return redirect()->route($this->base_route.'.index');
        }
        
    }

    public function edit($id){
        $section = $this->repository->getById($id);
        return view(parent::loadView($this->view_path.'.edit'), compact('section'));
    }

    public function update(SectionRequest $request, $id){
        if($this->repository->update($id, $request)){
            session()->flash('alert-success', 'Data Updated Successfully!');
            return redirect()->route($this->base_route.'.index');
        }else{
            session()->flash('alert-danger', 'Data Updated Failed!');
            return redirect()->back();
        }
        
    }
    public function destroy($id){
        $this->repository->delete($id);
        session()->flash('alert-success', '��ि��ा�� ���लता����र्��क ��िर्��ना ��रिय��');
        return redirect()->route($this->base_route.'.index');
    }
    
}

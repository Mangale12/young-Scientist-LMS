<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RoleService;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\RoleRequest;

class RoleController extends DM_BaseController
{
    protected $service;
    protected $panel = "Role";
    protected $base_route = 'admin.role';
    protected $view_path = 'admin.role';
    public function __construct(RoleService $service){
        $this->service = $service;
    }
    public function index(){
        return view(parent::loadView($this->view_path.'.index'));
    }
    // Fetch data for the DataTable
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->service->getAll();
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
        $data['permissions'] = $this->service->getAllPermissions();  // Fetch all permissions for the web guard
        return view(parent::loadView($this->view_path.'.create'), compact('data'));
    }
    public function store(RoleRequest $request){
        // Call storeOrUpdate for creating a new role
        if($this->service->storeOrUpdate($request)){
            session()->flash('alert-success', 'डेटा सफलतापूर्वक सिर्जना गरियो');
            return redirect()->route($this->base_route.'.index');
        }else{
            $request->session()->flash('alert-danger', 'डेटा सिर्जना गर्न असफल');
            return redirect()->back();
        }
    }
    public function edit($id){
        $data['rows'] = $this->service->getById($id);
        $data['role'] = $this->service->getById($id);
        $data['permissions'] = $this->service->getAllPermissions();  // Fetch all permissions for the web guard
        $data['rolePermissions'] = $this->service->getRolePermissions($id);
        return view(parent::loadView($this->view_path.'.edit'), compact('data'));
    }
    public function update(RoleRequest $request, $id){
        if($this->service->storeOrUpdate($request, $id)){
            session()->flash('alert-success', 'डेटा सफलतापूर्वक सिर्जना गरियो');
            return redirect()->route($this->base_route.'.index');
        }else{
            $request->session()->flash('alert-danger', 'डेटा सिर्जना गर्न असफल');
            return redirect()->back();
        }
    }
    public function destroy($id){
        $this->service->delete($id);
        return redirect()->route($this->base_route.'.index')->with('success', '��ा��ा �����लता ��या ����');
    }
}
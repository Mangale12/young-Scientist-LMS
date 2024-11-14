<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StatusService;
use App\Http\Requests\StatusRequest;
use Yajra\DataTables\Facades\DataTables;

class StatusController extends DM_BaseController
{
    protected $service;
    protected $panel;
    protected $view_path ='admin.status';
    protected $base_route = 'admin.status';
    public function __construct(StatusService $service){
        $this->service = $service;
        $this->panel = 'Status';
    }
    public function index(){
        $data['rows'] = $this->service->getAll();
        return view(parent::loadView($this->view_path.'.index'), compact('data'));
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
        return view(parent::loadView($this->view_path.'.create'));
    }
    public function store(StatusRequest $request){
        $this->service->storeOrUpdate($request->all());
        return redirect()->route($this->base_route.'.index')->with('success', 'Status added successfully.');
    }
    public function edit($id){
        $data['rows'] = $this->service->getById($id);
        return view(parent::loadView($this->view_path.'.edit'), compact('data'));
    }
    public function update(StatusRequest $request, $id){
        $this->service->storeOrUpdate($request->all(), $id);
        return redirect()->route($this->base_route.'.index')->with('success', 'Status updated successfully.');
    }
    public function destroy($id){
        $this->service->destroy($id);
        return redirect()->route($this->base_route.'.index')->with('success', 'Status deleted successfully.');
    }

}

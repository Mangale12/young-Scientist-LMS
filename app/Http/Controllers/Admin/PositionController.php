<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PositionService;
use App\Http\Requests\PositionRequest;
use Yajra\DataTables\Facades\DataTables;


class PositionController extends DM_BaseController
{
    protected $service;
    protected $panel;
    protected $view_path = 'admin.position';
    protected $base_route = 'admin.position';
    public function __construct(PositionService $service){
        $this->service = $service;
        $this->panel = 'Position';
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

    public function store(PositionRequest $request){
        $this->service->storeOrUpdate($request->all());
        return redirect()->route($this->base_route.'.index')->with('success', 'Position added successfully.');
    }

    public function edit($id){
        $data['rows'] = $this->service->getById($id);
        return view(parent::loadView($this->view_path.'.edit'), compact('data'));
    }

    public function update(PositionRequest $request, $id){
        $this->service->storeOrUpdate($request->all(), $id);
        return redirect()->route($this->base_route.'.index')->with('success', 'Position updated successfully.');
    }

    public function destroy($id){
        $this->service->destroy($id);
        return redirect()->route($this->base_route.'.index')->with('success', 'Position deleted successfully.');
    }
}

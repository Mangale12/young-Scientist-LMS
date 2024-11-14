<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DocumentTypeService;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\DocumentTypeRequest;
class DocumentTypeController extends DM_BaseController
{
    protected $service;
    protected $panel = "Document Type";
    protected $base_route = 'admin.document-type';
    protected $view_path = 'admin.document-type';
    public function __construct(DocumentTypeService $service){
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
        return view(parent::loadView($this->view_path.'.create'));
    }
    public function store(DocumentTypeRequest $request){
        if($this->service->create($request->all())){
            session()->flash('alert-success', 'डेटा सफलतापूर्वक सिर्जना गरियो');
            return redirect()->route($this->base_route.'.index');
        }else{
            $request->session()->flash('alert-danger', 'डेटा सिर्जना गर्न असफल');
            return redirect()->back();
        }

    }
    public function edit($id){
        $data['rows'] = $this->service->getById($id);
        return view(parent::loadView($this->view_path.'.edit'), compact('data'));
    }
    public function update(DocumentTypeRequest $request, $id){
        if($this->service->update($request->all(), $id)){
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

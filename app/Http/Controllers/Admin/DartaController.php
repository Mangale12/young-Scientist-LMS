<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DartaChalaniService;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\DartaChalaniRequest;
class DartaController extends DM_BaseController
{
    protected $service;
    protected $panel = 'Darta';
    protected $base_route = 'admin.darta';
    protected $view_path = 'admin.darta';
    public function __construct(DartaChalaniService $service){
        $this->service = $service;
    }
    public function index(){
        return view(parent::loadView($this->view_path.'.index'));
    }
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            // Get data using the updated getAll method
            $data = $this->service->getDarta();

            return DataTables::of($data)
                ->addColumn('fiscal_year', function ($row) {
                    return $row->fiscalYear ? $row->fiscalYear->fiscal_np : 'N/A';
                })
                ->addColumn('branch', function ($row) {
                    return $row->branch ? $row->branch->name : 'N/A';
                })
                ->addColumn('status', function ($row) {
                    return $this->getStatusText($row->is_approved);
                })
                ->addColumn('action', function ($row) {
                    $editButton = view('admin.section.buttons.button-edit', ['id' => $row->id, 'route' => route($this->base_route . '.edit', $row->id)]);
                    $viewtButton = view('admin.section.buttons.button-view', ['id' => $row->id, 'route' => route($this->base_route . '.show', $row->id)]);
                    $deleteButton = view('admin.section.buttons.button-delete', ['id' => $row->id, 'route' => route($this->base_route . '.destroy', $row->id)]);
                    $doneButton = view('admin.section.buttons.button-verified', ['id' => $row->id, 'route' => route($this->base_route . '.status', $row->id)]);
                    return $editButton . ' ' . $viewtButton . ' ' . $doneButton . ' ' . $deleteButton ;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function oldIndex() {
        $this->view_path = 'admin.old-document';
        $this->panel = 'Old Dociment';
        return view(parent::loadView($this->view_path.'.index'));
    }

    public function getOldData(Request $request)
    {
        if ($request->ajax()) {
            // Get data using the updated getAll method
            $data = $this->service->getOldData();

            return DataTables::of($data)
                ->addColumn('fiscal_year', function ($row) {
                    return $row->fiscalYear ? $row->fiscalYear->fiscal_np : 'N/A';
                })
                ->addColumn('branch', function ($row) {
                    return $row->branch ? $row->branch->name : 'N/A';
                })
                ->addColumn('status', function ($row) {
                    return $this->getStatusText($row->is_approved);
                })
                ->addColumn('action', function ($row) {
                    $editButton = view('admin.section.buttons.button-edit', ['id' => $row->id, 'route' => route($this->base_route . '.edit', $row->id)]);
                    $viewtButton = view('admin.section.buttons.button-view', ['id' => $row->id, 'route' => route($this->base_route . '.show', $row->id)]);
                    $deleteButton = view('admin.section.buttons.button-delete', ['id' => $row->id, 'route' => route($this->base_route . '.destroy', $row->id)]);
                    $doneButton = view('admin.section.buttons.button-verified', ['id' => $row->id, 'route' => route($this->base_route . '.status', $row->id)]);
                    return $editButton . ' ' . $viewtButton . ' ' . $doneButton . ' ' . $deleteButton ;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    protected function getStatusText($status)
    {
        switch ($status) {
            case 1:
                return 'Approved';
            case 0:
                return 'Pending';
            default:
                return 'Unknown';
        }
    }

    public function create(){
        $data['darta_no'] = $this->service->generateDartaNo();
        $data['fiscalYears'] = $this->service->getFiscal();
        $data['offices'] = $this->service->getOffice();
        $data['branches'] = $this->service->getBranch();
        $data['documentTypes'] = $this->service->getDocumentType();
        return view(parent::loadView($this->view_path.'.create'), compact('data'));
    }
    public function store(DartaChalaniRequest $request){
        if($this->service->storeOrUpdate($request)){
            $request->session()->flash('alert-success', 'डेटा सफलतापूर्वक सिर्जना गरियो');
            return redirect()->route($this->base_route.'.index');
        }else{
            $request->session()->flash('alert-danger', 'डेटा सिर्जना गर्न असफल');
            return redirect()->back();
        }
    }
    public function edit($id){
        $data['fiscalYears'] = $this->fiscalYearService->getAll();
        $data['rows'] = $this->service->getById($id);
        return view(parent::loadView($this->view_path.'.edit'), compact('data'));
    }
    public function update(DartaChalaniRequest $request, $id){
        if($this->service->update($id, $request->all())){
            $request->session()->flash('alert-success', 'डेटा सफलतापूर्वक अद्यावधिक गरियो');
            return redirect()->route($this->base_route.'.index');
        }else{
            $request->session()->flash('alert-danger', 'डेटा सिर्जना गर्न असफल');
            return redirect()->back();
        }
    }

    public function status($id){
        $this->service->updateStatus($id);
        return redirect()->route($this->base_route.'.index');
    }

    public function show($id){
        $data['rows'] = $this->service->getById($id);
        return view(parent::loadView($this->view_path.'.show'), compact('data'));
    }
    public function destroy($id){
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}

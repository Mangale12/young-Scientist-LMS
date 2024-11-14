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
                    return $row->fiscalYear ? getUnicodeNumber($row->fiscalYear->fiscal_np) : 'N/A';
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
                    $doneButton = view('admin.section.buttons.button-verified', ['id' => $row->id, 'route' => route($this->base_route . '.status', $row->id), 'is_verified' => $row->is_approved]);
                    return $editButton . ' ' . $viewtButton . ' ' . $doneButton . ' ' . $deleteButton ;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function all(){
        $this->panel = 'All Darta';
        return view(parent::loadView($this->view_path.'.all'));
    }

    public function getAllData(Request $request)
    {
        if ($request->ajax()) {
            // Get data using the updated getAll method
            $data = $this->service->getAllDarta();
            if($request->is('admin/darta/verified-darta')){
                $data = $this->service->getApprovedDarta();
            }else if($request->is('admin/darta/unverified-darta')){
                $data = $this->service->getDarta();
            }

            return DataTables::of($data)
                ->addColumn('fiscal_year', function ($row) {
                    return $row->fiscalYear ? getUnicodeNumber($row->fiscalYear->fiscal_np) : 'N/A';
                })
                ->addColumn('branch', function ($row) {
                    return $row->branch ? $row->branch->name : 'N/A';
                })
                ->addColumn('status', function ($row) {
                    return $this->getStatusText($row->is_approved);
                })
                ->addColumn('darta_no', function ($row) {
                    return $this->getStatusText($row->darta_no);
                })
                ->addColumn('action', function ($row) {
                    $editButton = view('admin.section.buttons.button-edit', ['id' => $row->id, 'route' => route($this->base_route . '.edit', $row->id)]);
                    $viewtButton = view('admin.section.buttons.button-view', ['id' => $row->id, 'route' => route($this->base_route . '.show', $row->id)]);
                    $deleteButton = view('admin.section.buttons.button-delete', ['id' => $row->id, 'route' => route($this->base_route . '.destroy', $row->id)]);
                    $doneButton = view('admin.section.buttons.button-verified', ['id' => $row->id, 'route' => route($this->base_route . '.status', $row->id), 'is_verified' => $row->is_approved]);
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
        $data['darta_no'] = $this->service->generateDartaNo();
        $data['fiscalYears'] = $this->service->getFiscal();
        $data['offices'] = $this->service->getOffice();
        $data['branches'] = $this->service->getBranch();
        $data['documentTypes'] = $this->service->getDocumentType();
        $data['rows'] = $this->service->getById($id);
        return view(parent::loadView($this->view_path.'.edit'), compact('data'));
    }
    public function update(DartaChalaniRequest $request, $id){
        if($this->service->storeOrUpdate($request, $id)){
            $request->session()->flash('alert-success', 'डेटा सफलतापूर्वक अद्यावधिक गरियो');
            return redirect()->route($this->base_route.'.index');
        }else{
            $request->session()->flash('alert-danger', 'डेटा सिर्जना गर्न असफल');
            return redirect()->back();
        }
    }

    public function status($id){
        $this->service->updateStatus($id);
        return response()->json(null, 204);
    }

    public function show($id){
        $data['rows'] = $this->service->getById($id);
        $data['users'] = $this->service->getUser();
        $data['branches'] = $this->service->getBranch();
        return view(parent::loadView($this->view_path.'.show'), compact('data'));
    }
    public function destroy($id){
        $this->service->delete($id);
        return response()->json(null, 204);
    }

    public function deleteImage($id){
        $this->service->deleteImage($id);
        return response($this->service->deleteImage($id));
    }
    public function download($id){
        $row = DartaChalani::find($id);
        $file_path = storage_path('app/public/darta_chalanis/'. $row->file_path);
        return response()->download($file_path, $row->file_name);
    }

    public function wardForm(Request $request){
        $data['fiscalYears'] = $this->service->getFiscal();
        $data['offices'] = $this->service->getOffice();
        $data['branches'] = $this->service->getBranch();
        $data['documentTypes'] = $this->service->getDocumentType();
        return view(parent::loadView($this->view_path.'.ward-form'), compact('data'));
    }

    public function getWardData(Request $request)
    {
        $data['rows'] = $this->service->getDartaWardData($request);
        $route = 'edit';

        // Render the view as a string
        $html = view($this->view_path . '.ward-table-body', compact('data', 'route'))->render();

        // Return the rendered HTML as a JSON response
        return response()->json([
            'html' => $html
        ]);
    }

    public function downloadImage($key){
        $image = $this->service->downloadImage($key);
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DartaChalaniService;
use Yajra\DataTables\Facades\DataTables;

class DartaChalaniController extends DM_BaseController
{
    protected $base_route = 'admin.darta';
    protected $view_path = 'admin.darta-chalani';
    protected $panel = 'Darta Chalani';
    protected $service;
    public function __construct(DartaChalaniService $service)
    {
        $this->service = $service;
    }
    public function index(){
        return view(parent::loadView($this->view_path.'.index'));
    }
    public function getData(Request $request){
        if ($request->ajax()) {
            // Get data using the updated getAll method
            $data = $this->service->getAll();
            if($request->is('admin/darta-chalani/verified-data')){
                $data = $this->service->getApproved();
            }else if($request->is('admin/darta-chalani/unverified-data')){
                $data = $this->service->getPending();
            }

            return DataTables::of($data)
                ->addColumn('fiscal_year', function ($row) {
                    return $row->fiscalYear ? $row->fiscalYear->fiscal_np : 'N/A';
                })
                ->addColumn('branch', function ($row) {
                    return $row->branch ? $row->branch->name : 'N/A';
                })
                ->addColumn('status', function ($row) {
                    return $this->service->getStatusText($row->is_approved);
                })
                ->addColumn('type', function ($row) {
                    return $row->is_darta == 1 ? 'Send' : 'Recieced';
                })
                ->addColumn('action', function ($row) {
                    if($row->is_darta == 1) {
                        $this->base_route = 'admin.darta';
                    }else if($row->is_old == 1) {
                        $this->base_route = 'admin.old-document';
                    }else if($row->is_darta == 0) {
                        $this->base_route = 'admin.chalani';
                    }
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


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FiscalYearRequest;
use App\Services\FiscalYearService;
use App\DataTables\FiscalYearDataTable;
use Yajra\DataTables\Facades\DataTables;
class FiscalYearController extends DM_BaseController
{
    protected $fiscalYearService;
    protected $panel = 'Fiscal Year';
    protected $base_route = 'admin.fiscal_year';
    protected $view_path = 'admin.fiscal-year';

    public function __construct(FiscalYearService $fiscalYearService)
    {
        $this->fiscalYearService = $fiscalYearService;
    }

    public function index()
    {
        $data['rows'] = $this->fiscalYearService->getAll();
        return view(parent::loadView($this->view_path.'.index'), compact('data'));
    }
    // Fetch data for the DataTable
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->fiscalYearService->getAll();
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
    public function show($id)
    {
        $data['rows'] = $this->fiscalYearService->getById($id);
        return view(parent::loadView($this->view_path.'.show'), compact('data'));
    }

    public function store(FiscalYearRequest $request)
    {
        // $data = $request->validated(); // Get validated data

        if ($this->fiscalYearService->create($request->all())) {
            $request->session()->flash('alert-success', 'डेटा सफलतापूर्वक सिर्जना गरियो');
            return redirect()->route($this->base_route.'.index');
        } else {
            $request->session()->flash('alert-danger', 'डेटा सिर्जना गर्न असफल');
            return redirect()->back();
        }
    }

    public function edit($id){
        $data['rows'] = $this->fiscalYearService->getById($id);
        return view(parent::loadView($this->view_path.'.edit'), compact('data'));
    }

    public function update(FiscalYearRequest $request, $id)
    {
        $data = $request->validated(); // Get validated data

        if ($this->fiscalYearService->update($id, $data)) {
            $request->session()->flash('alert-success', 'डेटा सफलतापूर्वक अद्यावधिक गरियो');
            return redirect()->route($this->base_route.'.index');
        } else {
            $request->session()->flash('alert-danger', 'डेटा अद्यावधिक गर्न असफल');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $this->fiscalYearService->delete($id);
        return response()->json(null, 204);
    }
}

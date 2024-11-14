<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Services\UserService;
use Yajra\DataTables\Facades\DataTables;
class UserController extends DM_BaseController
{
    protected $service;
    protected $view_path ='admin.user';
    protected $base_route = 'admin.user';
    protected $panel = "User";
    public function __construct(UserService $service){
        $this->service = $service;
    }
    public function index(){
        $data['rows'] = $this->service->getAll();
        return view(parent::loadView($this->view_path.'.index'), compact('data'));
    }
    // Fetch data for the DataTable
    public function getData(Request $request){
        if ($request->ajax()) {
            $data = $this->service->getAll();
            return DataTables::of($data)
                ->addColumn('user_status', function ($row) {
                    return $row->userStatus ? $row->statuuserStatuss->name : 'N/A';
                })
                ->addColumn('roles', function ($row) {
                    // Fetch roles and display as a comma-separated string
                    $roles = $row->getRoleNames(); // This returns a collection of role names
                    return $roles->isNotEmpty() ? $roles->implode(', ') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $editButton = view('admin.section.buttons.button-edit', ['id' => $row->id, 'route' => route($this->base_route. '.edit', $row->id)]);
                    $deleteButton = view('admin.section.buttons.button-delete', ['id' => $row->id, 'route' => route($this->base_route. '.destroy', $row->id)]);
                    $viewtButton = view('admin.section.buttons.button-view', ['id' => $row->id, 'route' => route($this->base_route . '.show', $row->id)]);
                    $keyButton = view('admin.section.buttons.button-key', ['id' => $row->id, 'route' => route($this->base_route . '.change-passwords', $row->id)]);
                    return $editButton.' '. ' ' . $viewtButton . ' ' . $keyButton . ' ' . $deleteButton;
                })
                ->rawColumns(['action']) // To render HTML content
                ->make(true);
        }
    }
    public function create(){
        $data['branches'] = $this->service->getBranch();
        $data['wards'] = $this->service->getWard();
        $data['positions'] = $this->service->getPosition();
        $data['roles'] = $this->service->getRoles();
        $data['statuses'] = $this->service->getStatus();
        return view(parent::loadView($this->view_path.'.create'), compact('data'));
    }

    public function store(UserRequest $request){
        if($this->service->storeOrUpdate($request)){
            session()->flash('alert-success', 'डेटा सफलतापूर्वक सिर्जना गरियो');
            return redirect()->route($this->base_route.'.index');
        }else{
            $request->session()->flash('alert-danger', 'डेटा सिर्जना गर्न असफल');
            return redirect()->back();
        }
        return redirect()->route($this->base_route.'.index')->with('success', 'User added successfully.');
    }
    public function edit($id){
        $data['rows'] = $this->service->getById($id);
        $data['branches'] = $this->service->getBranch();
        $data['wards'] = $this->service->getWard();
        $data['positions'] = $this->service->getPosition();
        $data['statuses'] = $this->service->getStatus();
        $data['roles'] = $this->service->getRoles();
        return view(parent::loadView($this->view_path.'.edit'), compact('data'));
    }
    public function update(UserRequest $request, $id){
        if($this->service->storeOrUpdate($request, $id)){
            session()->flash('alert-success', 'डेटा सफलतापूर्वक सिर्जना गरियो');
            return redirect()->route($this->base_route.'.index')->with('success', 'User updated successfully.');
        }else{
            $request->session()->flash('alert-danger', 'डेटा सिर्जना गर्न असफल');
            return redirect()->back();
        }
    }
    public function changePassword($id = null) {
        if($id) {
            $data['rows'] = $this->service->getById($id);
            return view(parent::loadView($this->view_path.'.change-passwords'), compact('data'));
        }else{
            $data['rows'] = auth()->user();
            return view(parent::loadView($this->view_path.'.change-password'), compact('data'));
        }
    }
    public function updatePasswords(UpdatePasswordRequest $request, $id) {
        $this->service->updatePassword($request->all(), $id);
        return redirect()->route($this->base_route.'.index')->with('success', 'Password updated successfully.');
    }
    public function updatePassword(UpdatePasswordRequest $request, $id)
    {
        $response = $this->service->updatePassword($request, $id);

        // If there is an error (like wrong old password), return the response with error
        if ($response instanceof \Illuminate\Http\RedirectResponse) {
            return $response;
        }

        // If everything is okay, redirect with a success message
        return redirect()->route($this->base_route . '.index')->with('success', 'Password updated successfully.');
    }

    public function destroy($id){
        $this->service->destroy($id);
        return redirect()->route($this->base_route.'.index')->with('success', 'User deleted successfully.');
    }

    function show($id){
        $data['rows'] = $this->service->getById($id);
        return view(parent::loadView($this->view_path.'.show'), compact('data'));
    }
}

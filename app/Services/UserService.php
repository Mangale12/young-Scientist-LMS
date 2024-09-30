<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
class UserService extends DM_BaseService
{
    // Your business logic here
    protected $model;
    protected $folder_path_image;
    protected $folder_path_file;
    protected $folder = 'user';
    protected $file   = 'file';
    protected $prefix_path_image = '/upload_file/user/';
    protected $prefix_path_file = '/upload_file/user/file/';
    protected $image;
    protected $positionService;
    protected $wardService;
    protected $statusService;
    protected $branchService;
    protected $roleService;
    public function __construct(User $model, StatusService $statusService, WardService $wardService, PositionService $positionService, BranchService $branchService, RoleService $roleService){
        $this->model = $model;
        $this->statusService = $statusService;
        $this->wardService = $wardService;
        $this->positionService = $positionService;
        $this->branchService = $branchService;
        $this->roleService = $roleService;

    }
    // Add your custom methods here
    public function getAll(){
        return $this->model->all();
    }
    public function getById($id){
        return $this->model->findOrFail($id);
    }
    public function storeOrUpdate(UserRequest $request, $id = null) {
        try {
            // Fetch existing user or create a new instance
            if ($id) {
                $record = $this->getById($id);
            } else {
                $record = new User();
            }

            // Update user details
            $record->name = $request->name;
            $record->last_name = $request->last_name;
            $record->email = $request->email;
            $record->phone = $request->phone;
            $record->username = $request->username;
            $record->is_super_admin = $request->is_super_admin;

            // Only update the password if it's present in the request
            if ($request->has('password')) {
                $record->password = bcrypt($request->password);
            }

            // Update other user fields
            $record->position_id = $request->position_id;
            $record->ward_id = $request->ward_id;
            $record->status_id = $request->status_id;
            $record->branch_id = $request->branch_id;
            $record->remember_token = null;  // reset remember token
            $record->status = 0;
            $record->save();

            // Fetch the role by ID
            $role = $this->roleService->getById($request->role_id);

            // Ensure the role exists before assigning it
            if ($role) {
                // Remove any existing roles and assign the new one
                $record->syncRoles([$role]);
            } else {
                throw new \Exception('Role not found');
            }

            return true;

        } catch (\Throwable $th) {
            return false;
        }
    }

    public function destroy($id){
        $record = $this->getById($id);
        $record->delete();
    }
    public function getWard(){
        return $this->wardService->getAll();
    }
    public function getPosition(){
        return $this->positionService->getAll();
    }
    public function getStatus(){
        return $this->statusService->getAll();
    }
    public function getBranch(){
        return $this->branchService->getAll();
    }

    public function getRoles(){
        return $this->roleService->getAll();
    }
}

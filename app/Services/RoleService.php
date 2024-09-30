<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RoleRequest;
use DB;

class RoleService
{
    protected $model;

    public function __construct(Role $model){
        $this->model = $model;
    }

    // Get all roles
    public function getAll(){
        return $this->model->all();
    }

    // Get a role by ID
    public function getById($id){
        return $this->model->findOrFail($id);
    }

    // Store or update a role
    public function storeOrUpdate(RoleRequest $request, $id = null){
        DB::beginTransaction(); // Start transaction
        try {
            if ($id) {
                $record = $this->getById($id);
            } else {
                $record = new $this->model;
            }

            $record->name = $request->name;
            $record->guard_name = 'web';
            $record->save();

            $permissions = $request->input('permission', []);
            if (!empty($permissions)) {
                $permissions = Permission::whereIn('id', $permissions)->get();
                $record->syncPermissions($permissions);
            } else {
                // If no permissions provided, clear all permissions
                $record->syncPermissions([]);
            }

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th); // Log the exception for debugging
            return false;
        }
    }


    // Delete a role by ID
    public function destroy($id){
        $role = $this->getById($id);
        $role->delete();
    }

    // Get all permissions grouped by model name in Nepali
    public function getAllPermissions($guardName = 'web'){
        return Permission::where('guard_name', $guardName)->get()->groupBy('model_nep');
    }

    // Get all permissions assigned to a role by role ID
    public function getRolePermissions($id) {
        $role = $this->getById($id);

        // Get permissions assigned to the role
        $rolePermissions = $role->permissions; // Using direct access to permissions relationship

        return $rolePermissions;
    }
}

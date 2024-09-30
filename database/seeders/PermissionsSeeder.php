<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define a list of models or resources in English and Nepali
        $models = [
            'Fiscal Year' => 'आर्थिक वर्ष',
            'Darta' => 'दर्ता',
            'Chalani' => 'चलानी',
            'Branch' => 'शाखा',
            'Ward' => 'वार्ड',
            'Office' => 'कार्यालय',
            'Billing' => 'कागजातको प्रकार',
            'Document Type' => 'पुरानो कागजात',
            'Status' => 'स्थिति',
            'Position' => 'पद',
            'User' => 'प्रयोगकर्ता',
            'Role' => 'प्रयोगकर्ता प्रकार',
        ];

        // Define a list of actions in English and Nepali
        $actions = [
            'view' => 'पढ्न अनुमति',
            'create' => 'सिर्जना गर्न अनुमति',
            'edit' => 'अद्यावधिक गर्न अनुमति',
            'delete' => 'मेटाउन अनुमति',
        ];

        // Loop through each model and action to create permissions
        foreach ($models as $engModel => $nepModel) {
            foreach ($actions as $action => $nepAction) {
                // Create permissions for English names
                $permissionNameNep = "{$nepModel} {$nepAction}";
                $permissionNameEng = "{$action} {$engModel}";
                Permission::firstOrCreate([
                    'name' => $permissionNameEng,
                    'model' => $engModel,
                    'guard_name' => "web",
                    'model_nep' => $nepModel,
                    'name_nep' => $permissionNameNep,
                ]);
            }
        }

        // Create roles and assign permissions (commented out for now)
        // $adminRole = Role::create(['name' => 'admin']);
        // $userRole = Role::create(['name' => 'user']);

        // Assign all permissions to the admin role
        // $permissions = Permission::pluck('id')->all();
        // $adminRole->syncPermissions($permissions);

        // Assign specific permissions to the user role
        // Example: Give user role permissions for specific actions
        // $userRole->givePermissionTo('view agriculture');
        // $userRole->givePermissionTo('create farmer');
        // Add more permissions as needed
    }
}

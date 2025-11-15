<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            // Users
            [
                'category' => 'Users',
                'name'     => 'List Users',
                'code'     => 'list_users',
            ],
            [
                'category' => 'Users',
                'name'     => 'Create Users',
                'code'     => 'create_users',
            ],
            [
                'category' => 'Users',
                'name'     => 'View Users',
                'code'     => 'view_users',
            ],
            [
                'category' => 'Users',
                'name'     => 'Edit Users',
                'code'     => 'edit_users',
            ],
            [
                'category' => 'Users',
                'name'     => 'Delete Users',
                'code'     => 'delete_users',
            ],
            [
                'category' => 'Users',
                'name'     => 'Activate Users',
                'code'     => 'activate_users',
            ],
            [
                'category' => 'Users',
                'name'     => 'Deactivate Users',
                'code'     => 'deactivate_users',
            ],

            // Roles
            [
                'category' => 'Roles',
                'name'     => 'List Roles',
                'code'     => 'list_roles',
            ],
            [
                'category' => 'Roles',
                'name'     => 'Create Roles',
                'code'     => 'create_roles',
            ],
            [
                'category' => 'Roles',
                'name'     => 'View Roles',
                'code'     => 'view_roles',
            ],
            [
                'category' => 'Roles',
                'name'     => 'Edit Roles',
                'code'     => 'edit_roles',
            ],
            [
                'category' => 'Roles',
                'name'     => 'Delete Roles',
                'code'     => 'delete_roles',
            ],

            // Permissions
            [
                'category' => 'Permissions',
                'name'     => 'List Permissions',
                'code'     => 'list_permissions',
            ],
            [
                'category' => 'Permissions',
                'name'     => 'View Permissions',
                'code'     => 'view_permissions',
            ],

            // Settings
            [
                'category' => 'Settings',
                'name'     => 'Edit Settings',
                'code'     => 'edit_settings',
            ],
        ];

        Permission::insert($permissions);
    }
}

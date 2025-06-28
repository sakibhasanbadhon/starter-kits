<?php

namespace Database\Seeders;

use App\Models\Admin\Module;
use Illuminate\Database\Seeder;
use App\Models\Admin\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dashboard Permission
        $module_dashboard = Module::updateOrCreate(['name' => 'Dashboard'],['name' => 'Dashboard']);
        Permission::updateOrCreate(['slug' => 'access-dashboard'],[
            'module_id' => $module_dashboard->id,
            'name' => 'Access',
            'slug' => 'access-dashboard',
        ]);

        // Role Permissions
        $module_role = Module::updateOrCreate(['name' => 'Role'],['name' => 'Role']);
        Permission::updateOrCreate(['slug' => 'access-role'],[
            'module_id' => $module_role->id,
            'name' => 'Access',
            'slug' => 'access-role',
        ]);
        Permission::updateOrCreate(['slug' => 'create-role'],[
            'module_id' => $module_role->id,
            'name' => 'Create',
            'slug' => 'create-role',
        ]);
        Permission::updateOrCreate(['slug' => 'edit-role'],[
            'module_id' => $module_role->id,
            'name' => 'Edit',
            'slug' => 'edit-role',
        ]);
        Permission::updateOrCreate(['slug' => 'delete-role'],[
            'module_id' => $module_role->id,
            'name' => 'Delete',
            'slug' => 'delete-role',
        ]);


        // Admin Permissions
        $module_admin = Module::updateOrCreate(['name' => 'Admin'],['name' => 'Admin']);
        Permission::updateOrCreate(['slug' => 'access-admin'],[
            'module_id' => $module_admin->id,
            'name' => 'Access',
            'slug' => 'access-admin',
        ]);
        Permission::updateOrCreate(['slug' => 'create-admin'],[
            'module_id' => $module_admin->id,
            'name' => 'Create',
            'slug' => 'create-admin',
        ]);
        Permission::updateOrCreate(['slug' => 'edit-admin'],[
            'module_id' => $module_admin->id,
            'name' => 'Edit',
            'slug' => 'edit-admin',
        ]);
        Permission::updateOrCreate(['slug' => 'delete-admin'],[
            'module_id' => $module_admin->id,
            'name' => 'Delete',
            'slug' => 'delete-admin',
        ]);


        // User Permissions
        $module_user = Module::updateOrCreate(['name' => 'User'],['name' => 'User']);
        Permission::updateOrCreate(['slug' => 'access-user'],[
            'module_id' => $module_user->id,
            'name' => 'Access',
            'slug' => 'access-user',
        ]);
        Permission::updateOrCreate(['slug' => 'create-user'],[
            'module_id' => $module_user->id,
            'name' => 'Create',
            'slug' => 'create-user',
        ]);
        Permission::updateOrCreate(['slug' => 'edit-user'],[
            'module_id' => $module_user->id,
            'name' => 'Edit',
            'slug' => 'edit-user',
        ]);
        Permission::updateOrCreate(['slug' => 'delete-user'],[
            'module_id' => $module_user->id,
            'name' => 'Delete',
            'slug' => 'delete-user',
        ]);



    }
}

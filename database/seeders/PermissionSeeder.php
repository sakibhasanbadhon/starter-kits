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
        // Dashboard
        $module_dashboard = Module::updateOrCreate(['name' => 'Dashboard Management'],['name' => 'Dashboard Management']);
        Permission::updateOrCreate(['slug' => 'access-dashboard'],[
            'module_id' => $module_dashboard->id,
            'name' => 'Access Dashboard',
            'slug' => 'access-dashboard',
        ]);

        // Role
        $module_role = Module::updateOrCreate(['name' => 'Role Management'],['name' => 'Role Management']);
        Permission::updateOrCreate(['slug' => 'access-role'],[
            'module_id' => $module_role->id,
            'name' => 'Access Role',
            'slug' => 'access-role',
        ]);
        Permission::updateOrCreate(['slug' => 'create-role'],[
            'module_id' => $module_role->id,
            'name' => 'Create Role',
            'slug' => 'create-role',
        ]);
        Permission::updateOrCreate(['slug' => 'edit-role'],[
            'module_id' => $module_role->id,
            'name' => 'Edit Role',
            'slug' => 'edit-role',
        ]);
        Permission::updateOrCreate(['slug' => 'delete-role'],[
            'module_id' => $module_role->id,
            'name' => 'Delete Role',
            'slug' => 'delete-role',
        ]);


        // Role
        $module_admin = Module::updateOrCreate(['name' => 'Admin Management'],['name' => 'Admin Management']);
        Permission::updateOrCreate(['slug' => 'access-admin'],[
            'module_id' => $module_admin->id,
            'name' => 'Access admin',
            'slug' => 'access-admin',
        ]);
        Permission::updateOrCreate(['slug' => 'create-admin'],[
            'module_id' => $module_admin->id,
            'name' => 'Create admin',
            'slug' => 'create-admin',
        ]);
        Permission::updateOrCreate(['slug' => 'edit-admin'],[
            'module_id' => $module_admin->id,
            'name' => 'Edit admin',
            'slug' => 'edit-admin',
        ]);
        Permission::updateOrCreate(['slug' => 'delete-admin'],[
            'module_id' => $module_admin->id,
            'name' => 'Delete admin',
            'slug' => 'delete-admin',
        ]);


        // Role
        $module_user = Module::updateOrCreate(['name' => 'User Management'],['name' => 'User Management']);
        Permission::updateOrCreate(['slug' => 'access-user'],[
            'module_id' => $module_user->id,
            'name' => 'Access user',
            'slug' => 'access-user',
        ]);
        Permission::updateOrCreate(['slug' => 'create-user'],[
            'module_id' => $module_user->id,
            'name' => 'Create user',
            'slug' => 'create-user',
        ]);
        Permission::updateOrCreate(['slug' => 'edit-user'],[
            'module_id' => $module_user->id,
            'name' => 'Edit user',
            'slug' => 'edit-user',
        ]);
        Permission::updateOrCreate(['slug' => 'delete-user'],[
            'module_id' => $module_user->id,
            'name' => 'Delete user',
            'slug' => 'delete-user',
        ]);


        // currencies
        $module_currencies = Module::updateOrCreate(['name' => 'Currencies Management'],['name' => 'Currencies Management']);
        Permission::updateOrCreate(['slug' => 'access-currencies'],[
            'module_id' => $module_currencies->id,
            'name' => 'Access currencies',
            'slug' => 'access-currencies',
        ]);
        Permission::updateOrCreate(['slug' => 'create-currencies'],[
            'module_id' => $module_currencies->id,
            'name' => 'Create currencies',
            'slug' => 'create-currencies',
        ]);
        Permission::updateOrCreate(['slug' => 'edit-currencies'],[
            'module_id' => $module_currencies->id,
            'name' => 'Edit currencies',
            'slug' => 'edit-currencies',
        ]);
        Permission::updateOrCreate(['slug' => 'delete-currencies'],[
            'module_id' => $module_currencies->id,
            'name' => 'Delete currencies',
            'slug' => 'delete-currencies',
        ]);
        Permission::updateOrCreate(['slug' => 'status-currencies'],[
            'module_id' => $module_currencies->id,
            'name' => 'Status currencies',
            'slug' => 'status-currencies',
        ]);

        // useful links
        $module_useful_links = Module::updateOrCreate(['name' => 'Useful Links Management'],['name' => 'Useful Links Management']);
        Permission::updateOrCreate(['slug' => 'access-useful-links'],[
            'module_id' => $module_useful_links->id,
            'name' => 'Access useful links',
            'slug' => 'access-useful-links',
        ]);
        Permission::updateOrCreate(['slug' => 'create-useful-links'],[
            'module_id' => $module_useful_links->id,
            'name' => 'Create useful links',
            'slug' => 'create-useful-links',
        ]);
        Permission::updateOrCreate(['slug' => 'edit-useful-links'],[
            'module_id' => $module_useful_links->id,
            'name' => 'Edit useful links',
            'slug' => 'edit-useful-links',
        ]);
        Permission::updateOrCreate(['slug' => 'delete-useful-links'],[
            'module_id' => $module_useful_links->id,
            'name' => 'Delete useful links',
            'slug' => 'delete-useful-links',
        ]);
        Permission::updateOrCreate(['slug' => 'status-useful-links'],[
            'module_id' => $module_useful_links->id,
            'name' => 'Status useful links',
            'slug' => 'status-useful-links',
        ]);


        // Language links
        $module_languages = Module::updateOrCreate(['name' => 'Languages Management'],['name' => 'Languages Management']);
        Permission::updateOrCreate(['slug' => 'access-languages'],[
            'module_id' => $module_languages->id,
            'name' => 'Access languages',
            'slug' => 'access-languages',
        ]);
        Permission::updateOrCreate(['slug' => 'create-languages'],[
            'module_id' => $module_languages->id,
            'name' => 'Create languages',
            'slug' => 'create-languages',
        ]);
        Permission::updateOrCreate(['slug' => 'edit-languages'],[
            'module_id' => $module_languages->id,
            'name' => 'Edit languages',
            'slug' => 'edit-languages',
        ]);
        Permission::updateOrCreate(['slug' => 'delete-languages'],[
            'module_id' => $module_languages->id,
            'name' => 'Delete languages',
            'slug' => 'delete-languages',
        ]);
        Permission::updateOrCreate(['slug' => 'status-languages'],[
            'module_id' => $module_languages->id,
            'name' => 'Status languages',
            'slug' => 'status-languages',
        ]);



    }
}

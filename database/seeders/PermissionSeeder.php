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
        $moduleDashboard = Module::updateOrCreate(['name' => 'Dashboard'],['name' => 'Dashboard']);
        Permission::updateOrCreate(['slug' => 'dashboard-access'],[
            'module_id' => $moduleDashboard->id,
            'name' => 'Access',
            'slug' => 'dashboard-access',
        ]);

        // Role Permissions
        $moduleRole = Module::updateOrCreate(['name' => 'Role'],['name' => 'Role']);
        Permission::updateOrCreate(['slug' => 'role-access'],[
            'module_id' => $moduleRole->id,
            'name' => 'Access',
            'slug' => 'role-access',
        ]);
        Permission::updateOrCreate(['slug' => 'role-create'],[
            'module_id' => $moduleRole->id,
            'name' => 'Create',
            'slug' => 'role-create',
        ]);
        Permission::updateOrCreate(['slug' => 'role-edit'],[
            'module_id' => $moduleRole->id,
            'name' => 'Edit/Update',
            'slug' => 'role-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'role-delete'],[
            'module_id' => $moduleRole->id,
            'name' => 'Delete',
            'slug' => 'role-delete',
        ]);


        // Admin Permissions
        $moduleAdmin = Module::updateOrCreate(['name' => 'Admin'],['name' => 'Admin']);
        Permission::updateOrCreate(['slug' => 'admin-access'],[
            'module_id' => $moduleAdmin->id,
            'name' => 'Access',
            'slug' => 'admin-access',
        ]);
        Permission::updateOrCreate(['slug' => 'admin-create'],[
            'module_id' => $moduleAdmin->id,
            'name' => 'Create',
            'slug' => 'admin-create',
        ]);
        Permission::updateOrCreate(['slug' => 'admin-edit'],[
            'module_id' => $moduleAdmin->id,
            'name' => 'Edit/Update',
            'slug' => 'admin-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'admin-delete'],[
            'module_id' => $moduleAdmin->id,
            'name' => 'Delete',
            'slug' => 'admin-delete',
        ]);
        Permission::updateOrCreate(['slug' => 'admin-status'],[
            'module_id' => $moduleAdmin->id,
            'name' => 'Status Change',
            'slug' => 'admin-status',
        ]);


        // User Permissions
        $moduleUser = Module::updateOrCreate(['name' => 'User'],['name' => 'User']);
        Permission::updateOrCreate(['slug' => 'user-access'],[
            'module_id' => $moduleUser->id,
            'name' => 'Access',
            'slug' => 'user-access',
        ]);
        Permission::updateOrCreate(['slug' => 'user-create'],[
            'module_id' => $moduleUser->id,
            'name' => 'Create',
            'slug' => 'user-create',
        ]);
        Permission::updateOrCreate(['slug' => 'user-edit'],[
            'module_id' => $moduleUser->id,
            'name' => 'Edit/Update',
            'slug' => 'user-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'user-delete'],[
            'module_id' => $moduleUser->id,
            'name' => 'Delete',
            'slug' => 'user-delete',
        ]);
        Permission::updateOrCreate(['slug' => 'user-status'],[
            'module_id' => $moduleUser->id,
            'name' => 'Status Change',
            'slug' => 'user-status',
        ]);

        // Category Permissions
        $moduleCategory = Module::updateOrCreate(['name' => 'Category'],['name' => 'Category']);
        Permission::updateOrCreate(['slug' => 'category-access'],[
            'module_id' => $moduleCategory->id,
            'name' => 'Access',
            'slug' => 'category-access',
        ]);
        Permission::updateOrCreate(['slug' => 'category-create'],[
            'module_id' => $moduleCategory->id,
            'name' => 'Create',
            'slug' => 'category-create',
        ]);
        Permission::updateOrCreate(['slug' => 'category-edit'],[
            'module_id' => $moduleCategory->id,
            'name' => 'Edit/Update',
            'slug' => 'category-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'category-delete'],[
            'module_id' => $moduleCategory->id,
            'name' => 'Delete',
            'slug' => 'category-delete',
        ]);
        Permission::updateOrCreate(['slug' => 'category-status'],[
            'module_id' => $moduleCategory->id,
            'name' => 'Status Change',
            'slug' => 'category-status',
        ]);

        // Post Permissions
        $modulePost = Module::updateOrCreate(['name' => 'Post'],['name' => 'Post']);
        Permission::updateOrCreate(['slug' => 'post-access'],[
            'module_id' => $modulePost->id,
            'name' => 'Access',
            'slug' => 'post-access',
        ]);
        Permission::updateOrCreate(['slug' => 'post-create'],[
            'module_id' => $modulePost->id,
            'name' => 'Create',
            'slug' => 'post-create',
        ]);
        Permission::updateOrCreate(['slug' => 'post-edit'],[
            'module_id' => $modulePost->id,
            'name' => 'Edit/Update',
            'slug' => 'post-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'post-delete'],[
            'module_id' => $modulePost->id,
            'name' => 'Delete',
            'slug' => 'post-delete',
        ]);
        Permission::updateOrCreate(['slug' => 'post-status'],[
            'module_id' => $modulePost->id,
            'name' => 'Status Change',
            'slug' => 'post-status',
        ]);

    }
}

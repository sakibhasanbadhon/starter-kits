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

        // Testimonial Permissions
        $modulePost = Module::updateOrCreate(['name' => 'Testimonial'],['name' => 'Testimonial']);
        Permission::updateOrCreate(['slug' => 'testimonial-access'],[
            'module_id' => $modulePost->id,
            'name' => 'Access',
            'slug' => 'testimonial-access',
        ]);
        Permission::updateOrCreate(['slug' => 'testimonial-create'],[
            'module_id' => $modulePost->id,
            'name' => 'Create',
            'slug' => 'testimonial-create',
        ]);
        Permission::updateOrCreate(['slug' => 'testimonial-edit'],[
            'module_id' => $modulePost->id,
            'name' => 'Edit/Update',
            'slug' => 'testimonial-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'testimonial-delete'],[
            'module_id' => $modulePost->id,
            'name' => 'Delete',
            'slug' => 'testimonial-delete',
        ]);
        Permission::updateOrCreate(['slug' => 'testimonial-status'],[
            'module_id' => $modulePost->id,
            'name' => 'Status Change',
            'slug' => 'testimonial-status',
        ]);

        // FAQ Permissions
        $modulePost = Module::updateOrCreate(['name' => 'FAQ'],['name' => 'FAQ']);
        Permission::updateOrCreate(['slug' => 'faq-access'],[
            'module_id' => $modulePost->id,
            'name' => 'Access',
            'slug' => 'faq-access',
        ]);
        Permission::updateOrCreate(['slug' => 'faq-create'],[
            'module_id' => $modulePost->id,
            'name' => 'Create',
            'slug' => 'faq-create',
        ]);
        Permission::updateOrCreate(['slug' => 'faq-edit'],[
            'module_id' => $modulePost->id,
            'name' => 'Edit/Update',
            'slug' => 'faq-edit',
        ]);
        Permission::updateOrCreate(['slug' => 'faq-delete'],[
            'module_id' => $modulePost->id,
            'name' => 'Delete',
            'slug' => 'faq-delete',
        ]);
        Permission::updateOrCreate(['slug' => 'faq-status'],[
            'module_id' => $modulePost->id,
            'name' => 'Status Change',
            'slug' => 'faq-status',
        ]);

        // Subscriber Permissions
        $modulePost = Module::updateOrCreate(['name' => 'Subscriber'],['name' => 'Subscriber']);
        Permission::updateOrCreate(['slug' => 'subscriber-access'],[
            'module_id' => $modulePost->id,
            'name' => 'Access',
            'slug' => 'subscriber-access',
        ]);
        Permission::updateOrCreate(['slug' => 'subscriber-delete'],[
            'module_id' => $modulePost->id,
            'name' => 'Delete',
            'slug' => 'subscriber-delete',
        ]);
        Permission::updateOrCreate(['slug' => 'subscriber-broadcast'],[
            'module_id' => $modulePost->id,
            'name' => 'Broadcast Send',
            'slug' => 'subscriber-broadcast',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_permission = Permission::all();
        Role::updateOrCreate(['slug' => 'admin'],[
            'name' => 'Admin',
            'slug' => 'admin',
            'delatable' => false,
        ])->permissions()->sync($admin_permission->pluck('id'));

        Role::updateOrCreate(['slug' => 'editor'],[
            'name' => 'Editor',
            'slug' => 'editor',
            'delatable' => true,
        ]);
    }
}

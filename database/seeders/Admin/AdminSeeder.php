<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrcreate(['email' => 'admin@gmail.com'],[
            'role_id'    => 1,
            'first_name' => 'Super',
            'last_name'  => 'Admin',
            'username'  => 'admin',
            'email'      => 'admin@gmail.com',
            'password'   => Hash::make('admin'),
            'created_at' => now(),
            'delatable'  => false,
            'status'     => true,
        ]);

        Admin::updateOrcreate(['email' => 'editor@gmail.com'],[
            'role_id'    => 2,
            'first_name' => 'MR',
            'last_name'  => 'Editor',
            'username'  => 'editor',
            'email'      => 'editor@gmail.com',
            'password'   => Hash::make('editor'),
            'created_at' => now(),
            'delatable'  => true,
            'status'     => true,
        ]);
    }
}

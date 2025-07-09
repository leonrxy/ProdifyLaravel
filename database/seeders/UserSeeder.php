<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan user pertama dengan role superadmin
        $adminRole = Role::where('name', 'superadmin')->first();
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
            'password' => Hash::make('superadmin'),
            'role_id' => $adminRole->id
        ]);

        // Menambahkan user kedua dengan role admin
        $editorRole = Role::where('name', 'admin')->first();
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
            'role_id' => $editorRole->id
        ]);

        // Menambahkan user ketiga dengan role user
        $userRole = Role::where('name', 'user')->first();
        User::create([
            'name' => 'Regular User',
            'email' => 'user@mail.com',
            'password' => Hash::make('user'),
            'role_id' => $userRole->id
        ]);
    }
}

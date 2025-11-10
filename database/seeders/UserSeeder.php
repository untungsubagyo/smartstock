<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role admin ada
        $role = Role::firstOrCreate([
            'code' => 'ADMIN',
        ], [
            'name' => 'Administrator',
            'description' => 'Full system access',
            'is_system' => true,
        ]);

        // Buat user admin default
        User::firstOrCreate([
            'username' => 'admin',
        ], [
            'name' => 'Administrator',
            'email' => 'admin@smartstock.local',
            'password' => Hash::make('123456'),
            'is_active' => true,
            'role_id' => $role->id,
        ]);
    }
}

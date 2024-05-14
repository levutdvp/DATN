<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);

        // Create the "super-admin" user
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'hotro.trooi.datn@gmail.com', // Replace with the actual email
            'password' => Hash::make('Admin123'), // Replace with the actual password
            'role' => 'admin', // Change the role to 'admin'
            'phone' => '0987654321'
        ]);
        // Assign the "super-admin" role to the "super-admin" user
        $superAdmin->assignRole($superAdminRole);
    }
}

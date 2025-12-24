<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            ModuleSeeder::class,
            SchoolSeeder::class,
            DefaultSettingsSeeder::class,
        ]);

        // ====================
        // CREATE SUPER ADMIN USER
        // ====================
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@schoolsystem.com',
            'password' => Hash::make('password123'),
            'school_id' => null,
            'branch_id' => null,
            'phone' => '+1234567890',
            'status' => 'active'
        ]);

        // Get the Super Admin role
        $superAdminRole = \Spatie\Permission\Models\Role::where('name', 'Super Admin')->first();
        $superAdmin->assignRole($superAdminRole);

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('=====================================');
        $this->command->info('📱 LOGIN CREDENTIALS:');
        $this->command->info('=====================================');
        $this->command->info('Super Admin:');
        $this->command->info('  Email: superadmin@schoolsystem.com');
        $this->command->info('  Password: password123');
        $this->command->info('');
        $this->command->info('School Admin:');
        $this->command->info('  Email: admin@mainschool.com');
        $this->command->info('  Password: password123');
        $this->command->info('');
        $this->command->info('Teacher:');
        $this->command->info('  Email: teacher@mainschool.com');
        $this->command->info('  Password: password123');
        $this->command->info('');
        $this->command->info('Student:');
        $this->command->info('  Email: student@mainschool.com');
        $this->command->info('  Password: password123');
        $this->command->info('=====================================');
    }
}

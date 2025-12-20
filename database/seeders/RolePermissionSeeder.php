<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ====================
        // 1. CREATE PERMISSIONS
        // ====================
        $permissions = [
            // Dashboard
            'view_dashboard',

            // User Management
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',

            // Role & Permission Management
            'view_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',
            'assign_roles',

            // School Management
            'view_schools',
            'create_schools',
            'edit_schools',
            'delete_schools',
            'manage_school_settings',

            // Branch Management
            'view_branches',
            'create_branches',
            'edit_branches',
            'delete_branches',

            // Student Management
            'view_students',
            'create_students',
            'edit_students',
            'delete_students',

            // Teacher Management
            'view_teachers',
            'create_teachers',
            'edit_teachers',
            'delete_teachers',

            // Attendance
            'view_attendance',
            'mark_attendance',
            'edit_attendance',

            // Fees Management
            'view_fees',
            'create_fees',
            'edit_fees',
            'delete_fees',
            'collect_fees',

            // Exams & Results
            'view_exams',
            'create_exams',
            'edit_exams',
            'delete_exams',
            'publish_results',

            // Academic Management
            'view_classes',
            'create_classes',
            'edit_classes',
            'delete_classes',
            'view_subjects',
            'create_subjects',
            'edit_subjects',
            'delete_subjects',

            // Reports
            'view_reports',
            'generate_reports',
            'export_reports',

            // Settings
            'manage_settings',
            'view_audit_logs',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // ====================
        // 2. CREATE GLOBAL ROLES (school_id = null)
        // ====================
        $superAdminRole = Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);
        $superAdminRole->givePermissionTo(Permission::all());

        $this->command->info('✅ Role and Permission seeded successfully!');
    }
}

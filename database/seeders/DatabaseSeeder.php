<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\School;
use App\Models\Branch;
use App\Models\ClassModel;
use App\Models\Section;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
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
        // 2. CREATE ROLES
        // ====================
        // Global Roles (school_id = null)
        $superAdminRole = Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);
        $superAdminRole->givePermissionTo(Permission::all());

        // ====================
        // 3. CREATE MAIN SCHOOL
        // ====================
        $mainSchool = School::create([
            'name' => 'Main School System',
            'email' => 'admin@mainschool.com',
            'phone' => '+1234567890',
            'address' => '123 Main Street, City, Country',
            'status' => 'active'
        ]);

        // ====================
        // 4. CREATE BRANCH
        // ====================
        $mainBranch = Branch::create([
            'school_id' => $mainSchool->id,
            'name' => 'Main Campus',
            'phone' => '+1234567890',
            'address' => '123 Main Street, City, Country',
            'status' => 'active'
        ]);

        // ====================
        // 5. CREATE SCHOOL-SPECIFIC ROLES
        // ====================
        // Create roles with school prefix for uniqueness
        $schoolPrefix = "school_{$mainSchool->id}_";

        // School Admin Role
        $schoolAdminRole = Role::create([
            'name' => $schoolPrefix . 'admin',
            'guard_name' => 'web',
        ]);

        $schoolAdminPermissions = [
            'view_dashboard',
            'view_users',
            'create_users',
            'edit_users',
            'view_roles',
            'assign_roles',
            'view_branches',
            'create_branches',
            'edit_branches',
            'view_students',
            'create_students',
            'edit_students',
            'view_teachers',
            'create_teachers',
            'edit_teachers',
            'view_attendance',
            'mark_attendance',
            'view_fees',
            'create_fees',
            'collect_fees',
            'view_exams',
            'create_exams',
            'publish_results',
            'view_classes',
            'create_classes',
            'edit_classes',
            'view_subjects',
            'create_subjects',
            'edit_subjects',
            'view_reports',
            'generate_reports',
            'manage_settings',
        ];
        $schoolAdminRole->givePermissionTo($schoolAdminPermissions);

        // Teacher Role
        $teacherRole = Role::create([
            'name' => $schoolPrefix . 'teacher',
            'guard_name' => 'web',
        ]);
        $teacherPermissions = [
            'view_dashboard',
            'view_students',
            'view_attendance',
            'mark_attendance',
            'view_exams',
            'view_classes',
            'view_subjects',
        ];
        $teacherRole->givePermissionTo($teacherPermissions);

        // Student Role
        $studentRole = Role::create([
            'name' => $schoolPrefix . 'student',
            'guard_name' => 'web',
        ]);
        $studentPermissions = [
            'view_dashboard',
            'view_attendance',
            'view_fees',
            'view_exams',
        ];
        $studentRole->givePermissionTo($studentPermissions);

        // Parent Role
        $parentRole = Role::create([
            'name' => $schoolPrefix . 'parent',
            'guard_name' => 'web',
        ]);
        $parentPermissions = [
            'view_dashboard',
            'view_attendance',
            'view_fees',
            'view_exams',
        ];
        $parentRole->givePermissionTo($parentPermissions);

        // Accountant Role
        $accountantRole = Role::create([
            'name' => $schoolPrefix . 'accountant',
            'guard_name' => 'web',
        ]);
        $accountantPermissions = [
            'view_dashboard',
            'view_fees',
            'create_fees',
            'collect_fees',
            'view_reports',
            'generate_reports',
        ];
        $accountantRole->givePermissionTo($accountantPermissions);

        // Receptionist Role
        $receptionistRole = Role::create([
            'name' => $schoolPrefix . 'receptionist',
            'guard_name' => 'web',
        ]);
        $receptionistPermissions = [
            'view_dashboard',
            'view_students',
            'create_students',
            'view_attendance',
            'view_fees',
            'collect_fees',
        ];
        $receptionistRole->givePermissionTo($receptionistPermissions);

        // ====================
        // 6. CREATE SUPER ADMIN USER
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
        $superAdmin->assignRole($superAdminRole);

        // ====================
        // 7. CREATE SCHOOL ADMIN USER
        // ====================
        $schoolAdmin = User::create([
            'name' => 'School Admin',
            'email' => 'admin@mainschool.com',
            'password' => Hash::make('password123'),
            'school_id' => $mainSchool->id,
            'branch_id' => $mainBranch->id,
            'phone' => '+1234567890',
            'status' => 'active'
        ]);
        $schoolAdmin->assignRole($schoolAdminRole);



        // ====================
        // 11. CREATE TEACHER USER
        // ====================
        $teacherUser = User::create([
            'name' => 'John Teacher',
            'email' => 'teacher@mainschool.com',
            'password' => Hash::make('password123'),
            'school_id' => $mainSchool->id,
            'branch_id' => $mainBranch->id,
            'phone' => '+1234567891',
            'status' => 'active'
        ]);
        $teacherUser->assignRole($teacherRole);

        // ====================
        // 12. CREATE STUDENT USER
        // ====================
        $studentUser = User::create([
            'name' => 'Jane Student',
            'email' => 'student@mainschool.com',
            'password' => Hash::make('password123'),
            'school_id' => $mainSchool->id,
            'branch_id' => $mainBranch->id,
            'phone' => '+1234567892',
            'status' => 'active'
        ]);
        $studentUser->assignRole($studentRole);

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

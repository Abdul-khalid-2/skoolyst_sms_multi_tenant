<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\School;
use App\Models\Branch;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        // ====================
        // 1. CREATE MAIN SCHOOL
        // ====================
        $mainSchool = School::create([
            'name' => 'Main School System',
            'slug' => Str::slug('Main School System'),
            'email' => 'admin@mainschool.com',
            'phone' => '+1234567890',
            'address' => '123 Main Street, City, Country',
            'status' => 'active'
        ]);

        // ====================
        // 2. CREATE BRANCH
        // ====================
        $mainBranch = Branch::create([
            'school_id' => $mainSchool->id,
            'name' => 'Main Campus',
            'phone' => '+1234567890',
            'address' => '123 Main Street, City, Country',
            'status' => 'active'
        ]);

        // ====================
        // 3. CREATE GLOBAL ROLES (if they don't exist)
        // ====================
        $this->createGlobalRoles();

        // ====================
        // 4. CREATE SUPER ADMIN USER (Global role - no school assigned)
        // ====================
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mainschool.com',
            'password' => Hash::make('password123'),
            'phone' => '+1234567899',
            'status' => 'active'
        ]);
        $superAdmin->assignRole('superadmin');

        // ====================
        // 5. CREATE SCHOOL ADMIN USER
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
        $schoolAdmin->assignRole('admin');

        // ====================
        // 6. CREATE TEACHER USER
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
        $teacherUser->assignRole('teacher');

        // ====================
        // 7. CREATE STUDENT USER
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
        $studentUser->assignRole('student');

        // ====================
        // 8. CREATE OTHER ROLES USERS
        // ====================
        $this->createOtherRoleUsers($mainSchool->id, $mainBranch->id);

        $this->command->info('✅ School data seeded successfully!');
    }

    private function createGlobalRoles(): void
    {
        // Check if roles already exist to avoid duplicates
        $roles = ['superadmin', 'admin', 'teacher', 'student', 'parent', 'accountant', 'receptionist', 'librarian'];

        foreach ($roles as $roleName) {
            if (!Role::where('name', $roleName)->exists()) {
                Role::create(['name' => $roleName, 'guard_name' => 'web']);
            }
        }

        // Assign permissions to roles
        $this->assignRolePermissions();
    }

    private function assignRolePermissions(): void
    {
        // Super Admin Role - All permissions
        $superAdminRole = Role::where('name', 'superadmin')->first();
        if ($superAdminRole) {
            // Create all permissions if they don't exist
            $allPermissions = [
                // System permissions
                'manage_system',
                'view_all_schools',
                'create_schools',
                'edit_schools',
                'delete_schools',

                // User management
                'view_users',
                'create_users',
                'edit_users',
                'delete_users',

                // Role management
                'view_roles',
                'create_roles',
                'edit_roles',
                'delete_roles',
                'assign_roles',

                // School management
                'view_dashboard',
                'view_branches',
                'create_branches',
                'edit_branches',
                'delete_branches',

                // Student management
                'view_students',
                'create_students',
                'edit_students',
                'delete_students',

                // Teacher management
                'view_teachers',
                'create_teachers',
                'edit_teachers',
                'delete_teachers',

                // Attendance
                'view_attendance',
                'mark_attendance',
                'edit_attendance',

                // Fees
                'view_fees',
                'create_fees',
                'edit_fees',
                'collect_fees',
                'delete_fees',

                // Exams
                'view_exams',
                'create_exams',
                'edit_exams',
                'delete_exams',
                'publish_results',

                // Classes
                'view_classes',
                'create_classes',
                'edit_classes',
                'delete_classes',

                // Subjects
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
                'view_activity_logs',
            ];

            foreach ($allPermissions as $permissionName) {
                if (!Permission::where('name', $permissionName)->exists()) {
                    Permission::create(['name' => $permissionName, 'guard_name' => 'web']);
                }
            }

            $superAdminRole->givePermissionTo(Permission::all());
        }

        // Admin Role (School Admin)
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminPermissions = [
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
            $adminRole->givePermissionTo($adminPermissions);
        }

        // Teacher Role
        $teacherRole = Role::where('name', 'teacher')->first();
        if ($teacherRole) {
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
        }

        // Student Role
        $studentRole = Role::where('name', 'student')->first();
        if ($studentRole) {
            $studentPermissions = [
                'view_dashboard',
                'view_attendance',
                'view_fees',
                'view_exams',
            ];
            $studentRole->givePermissionTo($studentPermissions);
        }

        // Parent Role
        $parentRole = Role::where('name', 'parent')->first();
        if ($parentRole) {
            $parentPermissions = [
                'view_dashboard',
                'view_attendance',
                'view_fees',
                'view_exams',
            ];
            $parentRole->givePermissionTo($parentPermissions);
        }

        // Accountant Role
        $accountantRole = Role::where('name', 'accountant')->first();
        if ($accountantRole) {
            $accountantPermissions = [
                'view_dashboard',
                'view_fees',
                'create_fees',
                'collect_fees',
                'view_reports',
                'generate_reports',
            ];
            $accountantRole->givePermissionTo($accountantPermissions);
        }

        // Receptionist Role
        $receptionistRole = Role::where('name', 'receptionist')->first();
        if ($receptionistRole) {
            $receptionistPermissions = [
                'view_dashboard',
                'view_students',
                'create_students',
                'view_attendance',
                'view_fees',
                'collect_fees',
            ];
            $receptionistRole->givePermissionTo($receptionistPermissions);
        }
    }

    private function createOtherRoleUsers(int $schoolId, int $branchId): void
    {
        // Parent User
        $parentUser = User::create([
            'name' => 'Parent User',
            'email' => 'parent@mainschool.com',
            'password' => Hash::make('password123'),
            'school_id' => $schoolId,
            'branch_id' => $branchId,
            'phone' => '+1234567893',
            'status' => 'active'
        ]);
        $parentUser->assignRole('parent');

        // Accountant User
        $accountantUser = User::create([
            'name' => 'Accountant User',
            'email' => 'accountant@mainschool.com',
            'password' => Hash::make('password123'),
            'school_id' => $schoolId,
            'branch_id' => $branchId,
            'phone' => '+1234567894',
            'status' => 'active'
        ]);
        $accountantUser->assignRole('accountant');

        // Receptionist User
        $receptionistUser = User::create([
            'name' => 'Receptionist User',
            'email' => 'receptionist@mainschool.com',
            'password' => Hash::make('password123'),
            'school_id' => $schoolId,
            'branch_id' => $branchId,
            'phone' => '+1234567895',
            'status' => 'active'
        ]);
        $receptionistUser->assignRole('receptionist');
    }
}

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
        // 3. CREATE SCHOOL-SPECIFIC ROLES
        // ====================
        $this->createSchoolRoles($mainSchool->id);

        // ====================
        // 4. CREATE SCHOOL ADMIN USER
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
        $schoolAdminRole = Role::where('name', "school_{$mainSchool->id}_admin")->first();
        $schoolAdmin->assignRole($schoolAdminRole);

        // ====================
        // 5. CREATE TEACHER USER
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
        $teacherRole = Role::where('name', "school_{$mainSchool->id}_teacher")->first();
        $teacherUser->assignRole($teacherRole);

        // ====================
        // 6. CREATE STUDENT USER
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
        $studentRole = Role::where('name', "school_{$mainSchool->id}_student")->first();
        $studentUser->assignRole($studentRole);

        // ====================
        // 7. CREATE OTHER ROLES USERS (Optional)
        // ====================
        $this->createOtherRoleUsers($mainSchool->id, $mainBranch->id);

        $this->command->info('✅ School data seeded successfully!');
    }

    private function createSchoolRoles(int $schoolId): void
    {
        $schoolPrefix = "school_{$schoolId}_";

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
    }

    private function createOtherRoleUsers(int $schoolId, int $branchId): void
    {
        $schoolPrefix = "school_{$schoolId}_";

        // Parent User (Optional)
        $parentUser = User::create([
            'name' => 'Parent User',
            'email' => 'parent@mainschool.com',
            'password' => Hash::make('password123'),
            'school_id' => $schoolId,
            'branch_id' => $branchId,
            'phone' => '+1234567893',
            'status' => 'active'
        ]);
        $parentRole = Role::where('name', $schoolPrefix . 'parent')->first();
        $parentUser->assignRole($parentRole);

        // Accountant User (Optional)
        $accountantUser = User::create([
            'name' => 'Accountant User',
            'email' => 'accountant@mainschool.com',
            'password' => Hash::make('password123'),
            'school_id' => $schoolId,
            'branch_id' => $branchId,
            'phone' => '+1234567894',
            'status' => 'active'
        ]);
        $accountantRole = Role::where('name', $schoolPrefix . 'accountant')->first();
        $accountantUser->assignRole($accountantRole);

        // Receptionist User (Optional)
        $receptionistUser = User::create([
            'name' => 'Receptionist User',
            'email' => 'receptionist@mainschool.com',
            'password' => Hash::make('password123'),
            'school_id' => $schoolId,
            'branch_id' => $branchId,
            'phone' => '+1234567895',
            'status' => 'active'
        ]);
        $receptionistRole = Role::where('name', $schoolPrefix . 'receptionist')->first();
        $receptionistUser->assignRole($receptionistRole);
    }
}

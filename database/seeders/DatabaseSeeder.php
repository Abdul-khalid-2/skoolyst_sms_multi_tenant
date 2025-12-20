<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\School;
use App\Models\Branch;
use App\Models\AcademicYear;
use App\Models\ClassModel;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Teacher;
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
            'school_id' => null
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
        $schoolAdminRole = Role::create([
            'name' => 'School Admin',
            'guard_name' => 'web',
            'school_id' => $mainSchool->id
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

        $teacherRole = Role::create([
            'name' => 'Teacher',
            'guard_name' => 'web',
            'school_id' => $mainSchool->id
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

        $studentRole = Role::create([
            'name' => 'Student',
            'guard_name' => 'web',
            'school_id' => $mainSchool->id
        ]);
        $studentPermissions = [
            'view_dashboard',
            'view_attendance',
            'view_fees',
            'view_exams',
        ];
        $studentRole->givePermissionTo($studentPermissions);

        $parentRole = Role::create([
            'name' => 'Parent',
            'guard_name' => 'web',
            'school_id' => $mainSchool->id
        ]);
        $parentPermissions = [
            'view_dashboard',
            'view_attendance',
            'view_fees',
            'view_exams',
        ];
        $parentRole->givePermissionTo($parentPermissions);

        $accountantRole = Role::create([
            'name' => 'Accountant',
            'guard_name' => 'web',
            'school_id' => $mainSchool->id
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

        $receptionistRole = Role::create([
            'name' => 'Receptionist',
            'guard_name' => 'web',
            'school_id' => $mainSchool->id
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
        // 8. CREATE ACADEMIC YEAR
        // ====================
        $academicYear = AcademicYear::create([
            'school_id' => $mainSchool->id,
            'name' => '2024-2025',
            'start_date' => '2024-04-01',
            'end_date' => '2025-03-31',
            'is_active' => true
        ]);

        // ====================
        // 9. CREATE CLASSES
        // ====================
        $classes = [
            ['name' => 'Play Group', 'order' => 1],
            ['name' => 'Nursery', 'order' => 2],
            ['name' => 'KG', 'order' => 3],
            ['name' => 'Class 1', 'order' => 4],
            ['name' => 'Class 2', 'order' => 5],
            ['name' => 'Class 3', 'order' => 6],
            ['name' => 'Class 4', 'order' => 7],
            ['name' => 'Class 5', 'order' => 8],
            ['name' => 'Class 6', 'order' => 9],
            ['name' => 'Class 7', 'order' => 10],
            ['name' => 'Class 8', 'order' => 11],
            ['name' => 'Class 9', 'order' => 12],
            ['name' => 'Class 10', 'order' => 13],
        ];

        foreach ($classes as $class) {
            ClassModel::create([
                'school_id' => $mainSchool->id,
                'name' => $class['name'],
                'order' => $class['order']
            ]);
        }

        // ====================
        // 10. CREATE SECTIONS
        // ====================
        $classIds = ClassModel::pluck('id')->toArray();
        $sections = ['A', 'B', 'C'];

        foreach ($classIds as $classId) {
            foreach ($sections as $section) {
                Section::create([
                    'class_id' => $classId,
                    'name' => $section,
                    'capacity' => 40
                ]);
            }
        }

        // // ====================
        // // 11. CREATE SUBJECTS
        // // ====================
        // $subjects = [
        //     ['name' => 'English', 'code' => 'ENG'],
        //     ['name' => 'Mathematics', 'code' => 'MATH'],
        //     ['name' => 'Science', 'code' => 'SCI'],
        //     ['name' => 'Social Studies', 'code' => 'SST'],
        //     ['name' => 'Urdu', 'code' => 'URDU'],
        //     ['name' => 'Islamiat', 'code' => 'ISL'],
        //     ['name' => 'Computer Science', 'code' => 'CS'],
        //     ['name' => 'Physics', 'code' => 'PHY'],
        //     ['name' => 'Chemistry', 'code' => 'CHEM'],
        //     ['name' => 'Biology', 'code' => 'BIO'],
        // ];

        // foreach ($subjects as $subject) {
        //     Subject::create([
        //         'school_id' => $mainSchool->id,
        //         'name' => $subject['name'],
        //         'code' => $subject['code']
        //     ]);
        // }

        // // ====================
        // // 12. CREATE TEACHER
        // // ====================
        // $teacher = Teacher::create([
        //     'school_id' => $mainSchool->id,
        //     'branch_id' => $mainBranch->id,
        //     'employee_id' => 'T001',
        //     'name' => 'John Teacher',
        //     'email' => 'teacher@mainschool.com',
        //     'phone' => '+1234567891',
        //     'gender' => 'male',
        //     'dob' => '1985-05-15',
        //     'designation' => 'Senior Teacher',
        //     'qualification' => 'M.Sc Mathematics',
        //     'address' => '456 Teacher Street, City, Country',
        //     'joining_date' => '2020-01-01',
        //     'status' => 'active'
        // ]);

        // $teacherUser = User::create([
        //     'name' => 'John Teacher',
        //     'email' => 'teacher@mainschool.com',
        //     'password' => Hash::make('password123'),
        //     'school_id' => $mainSchool->id,
        //     'branch_id' => $mainBranch->id,
        //     'phone' => '+1234567891',
        //     'status' => 'active'
        // ]);
        // $teacherUser->assignRole($teacherRole);

        // // ====================
        // // 13. CREATE STUDENT
        // // ====================
        // $class = ClassModel::where('name', 'Class 5')->first();
        // $section = Section::where('class_id', $class->id)->first();

        // $student = Student::create([
        //     'school_id' => $mainSchool->id,
        //     'branch_id' => $mainBranch->id,
        //     'academic_year_id' => $academicYear->id,
        //     'class_id' => $class->id,
        //     'section_id' => $section->id,
        //     'admission_no' => 'S001',
        //     'name' => 'Jane Student',
        //     'gender' => 'female',
        //     'dob' => '2015-03-10',
        //     'blood_group' => 'O+',
        //     'religion' => 'Islam',
        //     'nationality' => 'Pakistani',
        //     'address' => '789 Student Street, City, Country',
        //     'phone' => '+1234567892',
        //     'email' => 'student@mainschool.com',
        //     'admission_date' => '2024-04-01',
        //     'status' => 'active'
        // ]);

        // $studentUser = User::create([
        //     'name' => 'Jane Student',
        //     'email' => 'student@mainschool.com',
        //     'password' => Hash::make('password123'),
        //     'school_id' => $mainSchool->id,
        //     'branch_id' => $mainBranch->id,
        //     'phone' => '+1234567892',
        //     'status' => 'active'
        // ]);
        // $studentUser->assignRole($studentRole);

        // // ====================
        // // 14. CREATE STUDENT GUARDIAN
        // // ====================
        // \App\Models\StudentGuardian::create([
        //     'student_id' => $student->id,
        //     'name' => 'John Parent',
        //     'relation' => 'father',
        //     'occupation' => 'Businessman',
        //     'phone' => '+1234567893',
        //     'email' => 'parent@mainschool.com',
        //     'address' => '789 Student Street, City, Country',
        //     'is_primary' => true
        // ]);

        // // ====================
        // // 15. CREATE SETTINGS
        // // ====================
        // $settings = [
        //     ['key' => 'school_name', 'value' => $mainSchool->name],
        //     ['key' => 'school_email', 'value' => $mainSchool->email],
        //     ['key' => 'school_phone', 'value' => $mainSchool->phone],
        //     ['key' => 'school_address', 'value' => $mainSchool->address],
        //     ['key' => 'currency', 'value' => 'PKR'],
        //     ['key' => 'timezone', 'value' => 'Asia/Karachi'],
        //     ['key' => 'date_format', 'value' => 'd-m-Y'],
        //     ['key' => 'theme_color', 'value' => '#4f46e5'],
        //     ['key' => 'logo', 'value' => ''],
        //     ['key' => 'favicon', 'value' => ''],
        //     ['key' => 'language', 'value' => 'en'],
        //     ['key' => 'fee_due_days', 'value' => '30'],
        //     ['key' => 'late_fee_percentage', 'value' => '5'],
        //     ['key' => 'attendance_marking_time', 'value' => '10:00 AM'],
        // ];

        // foreach ($settings as $setting) {
        //     \App\Models\Setting::create([
        //         'school_id' => $mainSchool->id,
        //         'key' => $setting['key'],
        //         'value' => $setting['value']
        //     ]);
        // }

        // // ====================
        // // 16. CREATE FEE TYPES
        // // ====================
        // $feeTypes = [
        //     ['name' => 'Tuition Fee', 'type' => 'tuition'],
        //     ['name' => 'Admission Fee', 'type' => 'admission'],
        //     ['name' => 'Examination Fee', 'type' => 'exam'],
        //     ['name' => 'Library Fee', 'type' => 'library'],
        //     ['name' => 'Transport Fee', 'type' => 'transport'],
        //     ['name' => 'Computer Lab Fee', 'type' => 'other'],
        //     ['name' => 'Sports Fee', 'type' => 'other'],
        // ];

        // foreach ($feeTypes as $feeType) {
        //     \App\Models\FeeType::create([
        //         'school_id' => $mainSchool->id,
        //         'name' => $feeType['name'],
        //         'type' => $feeType['type']
        //     ]);
        // }

        // // ====================
        // // 17. CREATE FEE STRUCTURE FOR CLASS 5
        // // ====================
        // $tuitionFee = \App\Models\FeeType::where('name', 'Tuition Fee')->first();
        // $examFee = \App\Models\FeeType::where('name', 'Examination Fee')->first();
        // $transportFee = \App\Models\FeeType::where('name', 'Transport Fee')->first();

        // \App\Models\FeeStructure::create([
        //     'school_id' => $mainSchool->id,
        //     'class_id' => $class->id,
        //     'fee_type_id' => $tuitionFee->id,
        //     'amount' => 5000.00,
        //     'frequency' => 'monthly'
        // ]);

        // \App\Models\FeeStructure::create([
        //     'school_id' => $mainSchool->id,
        //     'class_id' => $class->id,
        //     'fee_type_id' => $examFee->id,
        //     'amount' => 2000.00,
        //     'frequency' => 'one_time'
        // ]);

        // \App\Models\FeeStructure::create([
        //     'school_id' => $mainSchool->id,
        //     'class_id' => $class->id,
        //     'fee_type_id' => $transportFee->id,
        //     'amount' => 3000.00,
        //     'frequency' => 'monthly'
        // ]);

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('Super Admin Login: superadmin@schoolsystem.com / password123');
        $this->command->info('School Admin Login: admin@mainschool.com / password123');
        $this->command->info('Teacher Login: teacher@mainschool.com / password123');
        $this->command->info('Student Login: student@mainschool.com / password123');
    }
}

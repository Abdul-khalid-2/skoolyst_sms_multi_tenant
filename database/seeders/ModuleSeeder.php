<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            [
                'code' => 'school_management',
                'name' => 'School Management',
                'description' => 'Manage school settings, branches, and activation',
                'icon' => 'fas fa-school',
                'route' => 'schools.index',
                'order' => 1,
                'is_core' => true,
                'permissions' => ['view_schools', 'create_schools', 'edit_schools', 'delete_schools', 'manage_school_settings'],
                'submodules' => [
                    ['name' => 'School CRUD', 'route' => 'schools.index'],
                    ['name' => 'School Settings', 'route' => 'schools.settings'],
                    ['name' => 'School Activation', 'route' => 'schools.activation'],
                ]
            ],
            [
                'code' => 'user_management',
                'name' => 'User & Role Management',
                'description' => 'Manage users, roles, and permissions',
                'icon' => 'fas fa-users-cog',
                'route' => 'users.index',
                'order' => 2,
                'permissions' => ['view_users', 'create_users', 'edit_users', 'delete_users', 'view_roles', 'assign_roles'],
                'submodules' => [
                    ['name' => 'Role Permissions', 'route' => 'roles.index'],
                    ['name' => 'User Management', 'route' => 'users.index'],
                    ['name' => 'Profile Management', 'route' => 'profiles.index'],
                ]
            ],
            [
                'code' => 'academic_structure',
                'name' => 'Academic Structure',
                'description' => 'Manage academic years, classes, sections, and subjects',
                'icon' => 'fas fa-graduation-cap',
                'route' => 'academic-years.index',
                'order' => 3,
                'permissions' => ['view_classes', 'create_classes', 'edit_classes', 'view_subjects', 'create_subjects', 'edit_subjects'],
                'submodules' => [
                    ['name' => 'Academic Years', 'route' => 'academic-years.index'],
                    ['name' => 'Classes Setup', 'route' => 'classes.index'],
                    ['name' => 'Sections Setup', 'route' => 'sections.index'],
                    ['name' => 'Subjects Setup', 'route' => 'subjects.index'],
                ]
            ],
            [
                'code' => 'student_management',
                'name' => 'Student Management',
                'description' => 'Student registration, profiles, guardians, and documents',
                'icon' => 'fas fa-user-graduate',
                'route' => 'students.index',
                'order' => 4,
                'permissions' => ['view_students', 'create_students', 'edit_students', 'delete_students'],
                'submodules' => [
                    ['name' => 'Student Registration', 'route' => 'students.create'],
                    ['name' => 'Student Profile', 'route' => 'students.index'],
                    ['name' => 'Guardian Information', 'route' => 'guardians.index'],
                    ['name' => 'Documents Upload', 'route' => 'documents.index'],
                ]
            ],
            [
                'code' => 'teacher_management',
                'name' => 'Teacher Management',
                'description' => 'Teacher profiles, subjects, and class assignments',
                'icon' => 'fas fa-chalkboard-teacher',
                'route' => 'teachers.index',
                'order' => 5,
                'permissions' => ['view_teachers', 'create_teachers', 'edit_teachers', 'delete_teachers'],
                'submodules' => [
                    ['name' => 'Teacher Profiles', 'route' => 'teachers.index'],
                    ['name' => 'Teacher Subjects', 'route' => 'teacher-subjects.index'],
                    ['name' => 'Class Teacher Assignment', 'route' => 'class-teachers.index'],
                ]
            ],
            [
                'code' => 'attendance_system',
                'name' => 'Attendance System',
                'description' => 'Daily attendance, monthly reports, and SMS alerts',
                'icon' => 'fas fa-calendar-check',
                'route' => 'attendance.index',
                'order' => 6,
                'permissions' => ['view_attendance', 'mark_attendance', 'edit_attendance'],
                'submodules' => [
                    ['name' => 'Daily Attendance', 'route' => 'attendance.daily'],
                    ['name' => 'Monthly Reports', 'route' => 'attendance.reports'],
                    ['name' => 'SMS Alerts', 'route' => 'attendance.alerts'],
                ]
            ],
            [
                'code' => 'fees_management',
                'name' => 'Fees Management',
                'description' => 'Fee types, invoice generation, payment tracking, due alerts',
                'icon' => 'fas fa-money-bill-wave',
                'route' => 'fees.index',
                'order' => 7,
                'permissions' => ['view_fees', 'create_fees', 'edit_fees', 'collect_fees'],
                'submodules' => [
                    ['name' => 'Fee Types', 'route' => 'fee-types.index'],
                    ['name' => 'Invoice Generation', 'route' => 'invoices.create'],
                    ['name' => 'Payment Tracking', 'route' => 'payments.index'],
                    ['name' => 'Due Alerts', 'route' => 'alerts.due'],
                ]
            ],
            // Add more modules as needed
        ];

        foreach ($modules as $module) {
            Module::updateOrCreate(
                ['code' => $module['code']],
                $module
            );
        }

        $this->command->info('✅ Modules seeded successfully!');
    }
}

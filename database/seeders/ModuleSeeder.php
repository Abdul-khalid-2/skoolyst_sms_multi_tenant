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
                'is_active' => true,
                'permissions' => [
                    'view_schools',
                    'create_schools',
                    'edit_schools',
                    'delete_schools',
                    'manage_school_settings'
                ],
                'submodules' => [
                    ['name' => 'Schools', 'route' => 'schools.index'],
                ],
            ],
            [
                'code' => 'user_management',
                'name' => 'User & Role',
                'description' => 'Manage users, roles, and permissions',
                'icon' => 'fas fa-users-cog',
                'route' => 'users.index',
                'order' => 2,
                'is_core' => false,
                'is_active' => true,
                'permissions' => [
                    'view_users',
                    'create_users',
                    'edit_users',
                    'delete_users',
                    'view_roles',
                    'assign_roles'
                ],
                'submodules' => [
                    ['name' => 'Role Permissions', 'route' => 'roles.index'],
                    ['name' => 'User Management', 'route' => 'users.index'],
                ],
            ],
            [
                'code' => 'academic_structure',
                'name' => 'Academic Structure',
                'description' => 'Manage academic years, classes, sections, and subjects',
                'icon' => 'fas fa-graduation-cap',
                'route' => 'academic-years.index',
                'order' => 3,
                'is_core' => false,
                'is_active' => true,
                'permissions' => [
                    'view_classes',
                    'create_classes',
                    'edit_classes',
                    'view_subjects',
                    'create_subjects',
                    'edit_subjects'
                ],
                'submodules' => [
                    ['name' => 'Academic Years', 'route' => 'academic-years.index'],
                    ['name' => 'Classes Setup', 'route' => 'classes.index'],
                    ['name' => 'Sections Setup', 'route' => 'sections.index'],
                    ['name' => 'Subjects Setup', 'route' => 'subjects.index'],
                ],
            ],
            [
                'code' => 'student_management',
                'name' => 'Student Management',
                'description' => 'Student registration, profiles, guardians, and documents',
                'icon' => 'fas fa-user-graduate',
                'route' => 'students.index',
                'order' => 4,
                'is_core' => false,
                'is_active' => true,
                'permissions' => [
                    'view_students',
                    'create_students',
                    'edit_students',
                    'delete_students'
                ],
                'submodules' => [
                    ['name' => 'Students', 'route' => 'students.index'],
                ],
            ],
            [
                'code' => 'teacher_management',
                'name' => 'Teacher Management',
                'description' => 'Teachers, subjects, and class assignments',
                'icon' => 'fas fa-chalkboard-teacher',
                'route' => 'teachers.index',
                'order' => 5,
                'is_core' => false,
                'is_active' => true,
                'permissions' => [
                    'view_teachers',
                    'create_teachers',
                    'edit_teachers',
                    'delete_teachers'
                ],
                'submodules' => [
                    ['name' => 'Teachers', 'route' => 'teachers.index'],
                    ['name' => 'Teacher Subjects', 'route' => 'teacher-subjects.index'],
                ],
            ],
            [
                'code' => 'attendance_system',
                'name' => 'Attendance System',
                'description' => 'Daily attendance, monthly reports, and SMS alerts',
                'icon' => 'fas fa-calendar-check',
                'route' => 'attendance.index',
                'order' => 6,
                'is_core' => false,
                'is_active' => true,
                'permissions' => [
                    'view_attendance',
                    'mark_attendance',
                    'edit_attendance'
                ],
                'submodules' => [
                    ['name' => 'Daily Attendance', 'route' => 'attendance.daily'],
                    ['name' => 'Monthly Reports', 'route' => 'attendance.reports'],
                    ['name' => 'SMS Alerts', 'route' => 'attendance.alerts'],
                ],
            ],
            [
                'code' => 'fees_management',
                'name' => 'Fees Management',
                'description' => 'Fee types, invoice generation, payment tracking, due alerts',
                'icon' => 'fas fa-money-bill-wave',
                'route' => 'fees.index',
                'order' => 7,
                'is_core' => false,
                'is_active' => true,
                'permissions' => [
                    'view_fees',
                    'create_fees',
                    'edit_fees',
                    'collect_fees'
                ],
                'submodules' => [
                    ['name' => 'Fee Types', 'route' => 'fee-types.index'],
                    ['name' => 'Invoice Generation', 'route' => 'invoices.index'],
                    ['name' => 'Payment Tracking', 'route' => 'payments.index'],
                    ['name' => 'Due Alerts', 'route' => 'alerts.due'],
                    ['name' => 'Reports', 'route' => 'fees.reports'],
                ],
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

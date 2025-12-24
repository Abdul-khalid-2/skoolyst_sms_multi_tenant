<?php

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SchoolSettingsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Module View Routes - Return simple views without controllers
Route::middleware(['auth'])->group(function () {
    // School Management Module Routes
    // School Management Module Routes
    // Route::get('/schools', function () {
    //     // Dummy schools data
    //     $schools = [
    //         [
    //             'id' => 1,
    //             'name' => 'ABC International School',
    //             'email' => 'info@abc.edu.pk',
    //             'phone' => '+92 300 1234567',
    //             'address' => '123 Main Street, Karachi',
    //             'logo' => 'schools/logos/abc-logo.jpg',
    //             'status' => 'active',
    //             'branches_count' => 3,
    //             'users_count' => 45,
    //             'active_users_count' => 42,
    //             'inactive_users_count' => 3,
    //             'created_at' => now()->subDays(30),
    //             'updated_at' => now()->subDays(5),
    //         ],
    //         [
    //             'id' => 2,
    //             'name' => 'City Grammar School',
    //             'email' => 'contact@citygrammar.edu.pk',
    //             'phone' => '+92 300 7654321',
    //             'address' => '456 College Road, Lahore',
    //             'logo' => null,
    //             'status' => 'active',
    //             'branches_count' => 2,
    //             'users_count' => 28,
    //             'active_users_count' => 25,
    //             'inactive_users_count' => 3,
    //             'created_at' => now()->subDays(45),
    //             'updated_at' => now()->subDays(10),
    //         ],
    //         [
    //             'id' => 3,
    //             'name' => 'Global Academy',
    //             'email' => 'admin@globalacademy.edu.pk',
    //             'phone' => '+92 300 9876543',
    //             'address' => '789 University Avenue, Islamabad',
    //             'logo' => 'schools/logos/global-logo.png',
    //             'status' => 'inactive',
    //             'branches_count' => 1,
    //             'users_count' => 15,
    //             'active_users_count' => 0,
    //             'inactive_users_count' => 15,
    //             'created_at' => now()->subDays(60),
    //             'updated_at' => now()->subDays(2),
    //         ],
    //         [
    //             'id' => 4,
    //             'name' => 'Bright Future School',
    //             'email' => 'info@brightfuture.edu.pk',
    //             'phone' => '+92 300 4567890',
    //             'address' => '321 Education Road, Rawalpindi',
    //             'logo' => null,
    //             'status' => 'active',
    //             'branches_count' => 1,
    //             'users_count' => 32,
    //             'active_users_count' => 30,
    //             'inactive_users_count' => 2,
    //             'created_at' => now()->subDays(20),
    //             'updated_at' => now()->subDays(1),
    //         ],
    //         [
    //             'id' => 5,
    //             'name' => 'Excel High School',
    //             'email' => 'principal@excelhigh.edu.pk',
    //             'phone' => '+92 300 2345678',
    //             'address' => '654 Knowledge Street, Faisalabad',
    //             'logo' => 'schools/logos/excel-logo.jpg',
    //             'status' => 'active',
    //             'branches_count' => 4,
    //             'users_count' => 56,
    //             'active_users_count' => 54,
    //             'inactive_users_count' => 2,
    //             'created_at' => now()->subDays(90),
    //             'updated_at' => now()->subDays(7),
    //         ],
    //     ];

    //     // Convert arrays to objects for easier access in blade
    //     $schools = array_map(function ($school) {
    //         return (object) $school;
    //     }, $schools);

    //     return view('dashboard.schools.index', compact('schools'));
    // })->name('schools.index');

    // Route::get('/schools/create', function () {
    //     return view('dashboard.schools.create');
    // })->name('schools.create');

    // Route::get('/schools/{id}', function ($id) {
    //     // Dummy school data
    //     $school = (object) [
    //         'id' => $id,
    //         'name' => 'ABC International School',
    //         'email' => 'info@abc.edu.pk',
    //         'phone' => '+92 300 1234567',
    //         'address' => '123 Main Street, Karachi, Pakistan',
    //         'logo' => 'schools/logos/abc-logo.jpg',
    //         'status' => 'active',
    //         'branches_count' => 3,
    //         'users_count' => 45,
    //         'active_users_count' => 42,
    //         'inactive_users_count' => 3,
    //         'created_at' => now()->subDays(30),
    //         'updated_at' => now()->subDays(5),
    //     ];

    //     return view('dashboard.schools.show', compact('school'));
    // })->name('schools.show');

    // Route::get('/schools/{id}/edit', function ($id) {
    //     // Dummy school data for edit form
    //     $school = (object) [
    //         'id' => $id,
    //         'name' => 'ABC International School',
    //         'email' => 'info@abc.edu.pk',
    //         'phone' => '+92 300 1234567',
    //         'address' => '123 Main Street, Karachi',
    //         'logo' => 'schools/logos/abc-logo.jpg',
    //         'status' => 'active',
    //         'branches_count' => 3,
    //         'users_count' => 45,
    //         'created_at' => now()->subDays(30),
    //         'updated_at' => now()->subDays(5),
    //     ];

    //     return view('dashboard.schools.edit', compact('school'));
    // })->name('schools.edit');

    // Route::get('/schools/{id}/settings', function ($id) {
    //     // Dummy school data
    //     $school = (object) [
    //         'id' => $id,
    //         'name' => 'ABC International School',
    //         'email' => 'info@abc.edu.pk',
    //         'phone' => '+92 300 1234567',
    //         'address' => '123 Main Street, Karachi',
    //         'logo' => 'schools/logos/abc-logo.jpg',
    //         'status' => 'active',
    //         'branches_count' => 3,
    //         'users_count' => 45,
    //         'created_at' => now()->subDays(30),
    //         'updated_at' => now()->subDays(5),
    //     ];

    //     // Dummy settings data
    //     $settings = [
    //         'current_academic_year' => '2024-2025',
    //         'default_class' => '1st',
    //         'timezone' => 'Asia/Karachi',
    //         'currency' => 'PKR',
    //         'fee_due_days' => '10',
    //         'late_fee_amount' => '500',
    //         'enable_partial_payment' => true,
    //         'primary_color' => '#007bff',
    //         'secondary_color' => '#6c757d',
    //     ];

    //     return view('dashboard.schools.settings', compact('school', 'settings'));
    // })->name('schools.settings.show');

    // Route::get('/schools/{id}/activation', function ($id) {
    //     // Dummy school data for activation page
    //     $school = (object) [
    //         'id' => $id,
    //         'name' => 'ABC International School',
    //         'email' => 'info@abc.edu.pk',
    //         'phone' => '+92 300 1234567',
    //         'address' => '123 Main Street, Karachi',
    //         'logo' => 'schools/logos/abc-logo.jpg',
    //         'status' => 'active',
    //         'branches_count' => 3,
    //         'users_count' => 45,
    //         'active_users_count' => 42,
    //         'inactive_users_count' => 3,
    //         'created_at' => now()->subDays(30),
    //         'updated_at' => now()->subDays(5),
    //     ];

    //     return view('dashboard.schools.activation', compact('school'));
    // })->name('schools.activation');

    // // Dummy POST routes for form submissions (for testing)
    // Route::post('/schools', function () {
    //     return redirect()->route('schools.index')
    //         ->with('success', 'School created successfully!');
    // })->name('schools.store');

    // Route::put('/schools/{id}', function ($id) {
    //     return redirect()->route('schools.index')
    //         ->with('success', 'School updated successfully!');
    // })->name('schools.update');

    // Route::delete('/schools/{id}', function ($id) {
    //     return redirect()->route('schools.index')
    //         ->with('success', 'School deleted successfully!');
    // })->name('schools.destroy');

    // Route::put('/schools/{id}/settings', function ($id) {
    //     return redirect()->route('schools.settings', $id)
    //         ->with('success', 'Settings updated successfully!');
    // })->name('schools.settings.update');

    // Route::put('/schools/{id}/activation', function ($id) {
    //     $status = request('status') == 'active' ? 'activated' : 'deactivated';
    //     return redirect()->route('schools.activation', $id)
    //         ->with('success', "School {$status} successfully!");
    // })->name('schools.activation.update');




    Route::prefix('schools')->group(function () {
        Route::get('/', [SchoolController::class, 'index'])->name('schools.index');
        Route::get('/create', [SchoolController::class, 'create'])->name('schools.create');
        Route::post('/', [SchoolController::class, 'store'])->name('schools.store');
        Route::get('/{school}', [SchoolController::class, 'show'])->name('schools.show');
        Route::get('/{school}/edit', [SchoolController::class, 'edit'])->name('schools.edit');
        Route::put('/{school}', [SchoolController::class, 'update'])->name('schools.update');
        Route::delete('/{school}', [SchoolController::class, 'destroy'])->name('schools.destroy');

        // Activation routes
        Route::get('/{school}/activation', [SchoolController::class, 'activation'])->name('schools.activation');
        Route::put('/{school}/activation', [SchoolController::class, 'updateActivation'])->name('schools.activation.update');

        // Settings routes
        Route::get('/{school}/settings', [SchoolSettingsController::class, 'show'])->name('schools.settings.show');
        Route::put('/{school}/settings', [SchoolSettingsController::class, 'update'])->name('schools.settings.update');
    });










    // User Management Module Routes
    Route::get('/roles', function () {
        return view('dashboard.users.roles');
    })->name('roles.index');

    Route::get('/profiles', function () {
        return view('dashboard.users.profiles');
    })->name('profiles.index');

    Route::get('/roles/create', function () {
        return view('dashboard.users.roles-create');
    })->name('roles.create');

    Route::get('/users', function () {
        return view('dashboard.users.index');
    })->name('users.index');

    Route::get('/users/create', function () {
        return view('dashboard.users.create');
    })->name('users.create');

    Route::get('/users/{id}', function ($id) {
        return view('dashboard.users.show');
    })->name('users.show');

    Route::get('/users/{id}/edit', function ($id) {
        return view('dashboard.users.edit');
    })->name('users.edit');









    // Academic Years
    Route::get('/academic-years', function () {
        return view('dashboard.academic.academic-years.index');
    })->name('academic-years.index');

    Route::get('/academic-years/create', function () {
        return view('dashboard.academic.academic-years.create');
    })->name('academic-years.create');

    // Classes
    Route::get('/classes', function () {
        return view('dashboard.academic.classes.index');
    })->name('classes.index');

    Route::get('/classes/create', function () {
        return view('dashboard.academic.classes.create');
    })->name('classes.create');

    // Sections
    Route::get('/sections', function () {
        return view('dashboard.academic.sections.index');
    })->name('sections.index');

    Route::get('/sections/create', function () {
        return view('dashboard.academic.sections.create');
    })->name('sections.create');

    // Subjects
    Route::get('/subjects', function () {
        return view('dashboard.academic.subjects.index');
    })->name('subjects.index');

    Route::get('/subjects/create', function () {
        return view('dashboard.academic.subjects.create');
    })->name('subjects.create');

    // Add dummy form submission routes for testing
    Route::post('/academic-years', function () {
        return redirect()->route('academic-years.index')
            ->with('success', 'Academic year created successfully!');
    })->name('academic-years.store');


    Route::post('/classes', function () {
        return redirect()->route('classes.index')
            ->with('success', 'Class created successfully!');
    })->name('classes.store');

    Route::post('/sections', function () {
        return redirect()->route('sections.index')
            ->with('success', 'Section created successfully!');
    })->name('sections.store');

    Route::post('/subjects', function () {
        return redirect()->route('subjects.index')
            ->with('success', 'Subject created successfully!');
    })->name('subjects.store');







    // ============================================
    // STUDENT MANAGEMENT MODULE ROUTES (STATIC)
    // ============================================

    // Students
    Route::get('/students', function () {
        return view('dashboard.students.index');
    })->name('students.index');

    Route::get('/students/create', function () {
        return view('dashboard.students.create');
    })->name('students.create');

    Route::get('/students/{id}', function ($id) {
        return view('dashboard.students.show');
    })->name('students.show');

    Route::get('/students/{id}/edit', function ($id) {
        return view('dashboard.students.edit');
    })->name('students.edit');

    // Dummy form submission routes
    Route::post('/students', function () {
        return redirect()->route('students.index')
            ->with('success', 'Student registered successfully!');
    })->name('students.store');

    Route::put('/students/{id}', function ($id) {
        return redirect()->route('students.show', $id)
            ->with('success', 'Student updated successfully!');
    })->name('students.update');









    // ============================================
    // TEACHER MANAGEMENT MODULE ROUTES (STATIC)
    // ============================================

    // Teachers
    Route::get('/teachers', function () {
        return view('dashboard.teachers.index');
    })->name('teachers.index');

    Route::get('/teachers/create', function () {
        return view('dashboard.teachers.create');
    })->name('teachers.create');

    Route::post('/teachers', function () {
        return redirect()->route('teachers.index')
            ->with('success', 'Teacher registered successfully!');
    })->name('teachers.store');

    Route::get('/teachers/{id}', function ($id) {
        return view('dashboard.teachers.show');
    })->name('teachers.show');

    Route::get('/teachers/{id}/edit', function ($id) {
        return view('dashboard.teachers.edit');
    })->name('teachers.edit');

    Route::put('/teachers/{id}', function ($id) {
        return redirect()->route('teachers.show', $id)
            ->with('success', 'Teacher information updated successfully!');
    })->name('teachers.update');

    Route::delete('/teachers/{id}', function ($id) {
        return redirect()->route('teachers.index')
            ->with('success', 'Teacher deleted successfully!');
    })->name('teachers.destroy');

    // Teacher Subject Assignment
    Route::get('/teachers/subjects/assignment', function () {
        return view('dashboard.teachers.subjects');
    })->name('teachers.subjects');

    Route::post('/teachers/subjects/assign', function () {
        return redirect()->route('teachers.subjects')
            ->with('success', 'Subject assigned successfully!');
    })->name('teachers.assign-subject');

    Route::post('/teachers/class-teacher/assign', function () {
        return redirect()->route('teachers.subjects')
            ->with('success', 'Class teacher assigned successfully!');
    })->name('teachers.assign-class-teacher');





    Route::get('/teacher-subjects', function () {
        return view('dashboard.teachers.subjects');
    })->name('teacher-subjects.index');



    // Attendance
    Route::get('/attendance/daily', function () {
        return view('dashboard.attendance.daily');
    })->name('attendance.daily');

    Route::get('/attendance/reports', function () {
        return view('dashboard.attendance.reports');
    })->name('attendance.reports');

    Route::get('/attendance/sms-alerts', function () {
        return view('dashboard.attendance.sms-alerts');
    })->name('attendance.alerts');

    Route::get('/attendance/settings', function () {
        return view('dashboard.attendance.settings');
    })->name('attendance.settings');

    // Attendance Actions
    Route::post('/attendance/save', function () {
        return redirect()->route('attendance.daily')
            ->with('success', 'Attendance saved successfully!');
    })->name('attendance.save');

    Route::post('/attendance/send-sms', function () {
        return redirect()->route('attendance.daily')
            ->with('success', 'SMS alerts sent successfully!');
    })->name('attendance.send-sms');

    Route::post('/attendance/generate-report', function () {
        return redirect()->route('attendance.reports')
            ->with('success', 'Report generated successfully!');
    })->name('attendance.generate-report');

    // SMS Actions
    Route::post('/sms/send-bulk', function () {
        return redirect()->route('attendance.sms-alerts')
            ->with('success', 'Bulk SMS sent successfully!');
    })->name('sms.send-bulk');

    Route::post('/sms/save-settings', function () {
        return redirect()->route('attendance.sms-alerts')
            ->with('success', 'SMS settings saved successfully!');
    })->name('sms.save-settings');

    // Settings Actions
    Route::post('/attendance/save-settings', function () {
        return redirect()->route('attendance.settings')
            ->with('success', 'Attendance settings saved successfully!');
    })->name('attendance.save-settings');




    Route::get('fees/types', function () {
        return view('dashboard.fees.types');
    })->name('fee-types.index');

    Route::get('fees/invoices', function () {
        return view('dashboard.fees.invoices');
    })->name('invoices.index');

    Route::get('fees/payments', function () {
        return view('dashboard.fees.payments');
    })->name('payments.index');

    Route::get('fees/discounts', function () {
        return view('dashboard.fees.discounts');
    })->name('fees.discounts');

    Route::get('fees/reports', function () {
        return view('dashboard.fees.reports');
    })->name('fees.reports');

    Route::get('/alerts/due', function () {
        return view('dashboard.fees.alerts');
    })->name('alerts.due');



    // ============================================
    // SETTING MODULE ROUTES
    // ============================================


    // Module Settings
    Route::get('settings/modules', function () {
        return view('dashboard.settings.modules');
    })->name('module.settings');



    // School Settings ------------------------------------
    // Route::get('settings/school', function () {
    //     return view('dashboard.settings.school');
    // })->name('school.settings');
    Route::middleware(['auth', 'verified'])->group(function () {
        // Settings routes
        Route::prefix('settings')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('school.settings');
            Route::post('/', [SettingController::class, 'store'])->name('settings.store');
            Route::post('/category/{category}', [SettingController::class, 'updateCategory'])->name('settings.category');
            Route::post('/upload-file', [SettingController::class, 'uploadFile'])->name('settings.upload');
            Route::post('/export', [SettingController::class, 'export'])->name('settings.export');
            Route::post('/reset', [SettingController::class, 'reset'])->name('settings.reset');
        });
    });





    // Dummy POST routes for form submissions
    // Route::post('settings/modules/install', function () {
    //     return redirect()->route('module.settings')
    //         ->with('success', 'Module installed successfully!');
    // })->name('settings.modules.install');

    // Route::post('settings/modules/{id}/toggle', function ($id) {
    //     return redirect()->route('module.settings')
    //         ->with('success', 'Module status updated!');
    // })->name('settings.modules.toggle');

    // Route::post('settings/modules/permissions', function () {
    //     return redirect()->route('module.settings')
    //         ->with('success', 'Permissions updated successfully!');
    // })->name('settings.modules.permissions.update');

    // Route::post('settings/school/save', function () {
    //     return redirect()->route('school.settings')
    //         ->with('success', 'School settings saved successfully!');
    // })->name('settings.school.save');

    Route::post('settings/school/backup', function () {
        return redirect()->route('school.settings')
            ->with('success', 'Backup created successfully!');
    })->name('settings.school.backup');
});

require __DIR__ . '/auth.php';

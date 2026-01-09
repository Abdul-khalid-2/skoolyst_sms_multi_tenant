<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\ClassesSetupController;
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


    // ============================================
    // SCHOOL MANAGEMENT MODULE ROUTES 
    // ============================================

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









    // ============================================
    // ACADEMIC YEAR MANAGEMENT MODULE ROUTES 
    // ============================================
    Route::post('/academic-years/{academicYear}/activate', [AcademicYearController::class, 'activate'])
        ->name('academic-years.activate');
    Route::post('/academic-years/{academicYear}/archive', [AcademicYearController::class, 'archive'])
        ->name('academic-years.archive');
    Route::resource('academic-years', AcademicYearController::class);







    // ============================================
    // CLASS SETUP MANAGEMENT MODULE ROUTES 
    // ============================================
    Route::post('/classes/{class}/toggle-status', [ClassesSetupController::class, 'toggleStatus'])
        ->name('classes.toggle-status');
    Route::resource('classes', ClassesSetupController::class);




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
    // Route::post('/academic-years', function () {
    //     return redirect()->route('academic-years.index')
    //         ->with('success', 'Academic year created successfully!');
    // })->name('academic-years.store');


    // Route::post('/classes', function () {
    //     return redirect()->route('classes.index')
    //         ->with('success', 'Class created successfully!');
    // })->name('classes.store');

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

    Route::get('/attendance/index', function () {
        return view('dashboard.attendance.daily');
    })->name('attendance.index');

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
    Route::get('fees/fees', function () {
        return view('dashboard.fees.types');
    })->name('fees.index');

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
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/modules', [ModuleController::class, 'index'])->name('module.settings');
        Route::post('/modules/toggle', [ModuleController::class, 'toggle'])->name('modules.toggle');
        Route::get('/modules/settings', [ModuleController::class, 'settings'])->name('modules.settings');
        Route::put('/modules/{module}/settings', [ModuleController::class, 'updateSettings'])->name('modules.update-settings');
        Route::post('/modules/update-permissions', [ModuleController::class, 'updatePermissions'])->name('modules.update-permissions');
        Route::post('/modules/install', [ModuleController::class, 'install'])->name('modules.install');
    });

    // Module Settings



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

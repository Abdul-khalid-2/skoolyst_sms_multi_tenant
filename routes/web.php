<?php

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/schools', function () {
        return view('modules.schools.index');
    })->name('schools.index');

    Route::get('/schools/settings', function () {
        return view('modules.schools.settings');
    })->name('schools.settings');

    Route::get('/schools/activation', function () {
        return view('modules.schools.activation');
    })->name('schools.activation');

    // User Management Module Routes
    Route::get('/roles', function () {
        return view('modules.users.roles');
    })->name('roles.index');

    Route::get('/users', function () {
        return view('modules.users.index');
    })->name('users.index');

    Route::get('/profiles', function () {
        return view('modules.users.profiles');
    })->name('profiles.index');

    // Academic Structure Module Routes
    Route::get('/academic-years', function () {
        return view('modules.academic.years');
    })->name('academic-years.index');

    Route::get('/classes', function () {
        return view('modules.academic.classes');
    })->name('classes.index');

    Route::get('/sections', function () {
        return view('modules.academic.sections');
    })->name('sections.index');

    Route::get('/subjects', function () {
        return view('modules.academic.subjects');
    })->name('subjects.index');

    // Student Management Module Routes
    Route::get('/students', function () {
        return view('modules.students.index');
    })->name('students.index');

    Route::get('/students/create', function () {
        return view('modules.students.create');
    })->name('students.create');

    Route::get('/guardians', function () {
        return view('modules.students.guardians');
    })->name('guardians.index');

    Route::get('/documents', function () {
        return view('modules.students.documents');
    })->name('documents.index');

    // Teacher Management Module Routes
    Route::get('/teachers', function () {
        return view('modules.teachers.index');
    })->name('teachers.index');

    Route::get('/teacher-subjects', function () {
        return view('modules.teachers.subjects');
    })->name('teacher-subjects.index');

    Route::get('/class-teachers', function () {
        return view('modules.teachers.class-assignments');
    })->name('class-teachers.index');

    // Attendance System Module Routes
    Route::get('/attendance', function () {
        return view('modules.attendance.index');
    })->name('attendance.index');

    Route::get('/attendance/daily', function () {
        return view('modules.attendance.daily');
    })->name('attendance.daily');

    Route::get('/attendance/reports', function () {
        return view('modules.attendance.reports');
    })->name('attendance.reports');

    Route::get('/attendance/alerts', function () {
        return view('modules.attendance.alerts');
    })->name('attendance.alerts');

    // Fees Management Module Routes
    Route::get('/fees', function () {
        return view('modules.fees.index');
    })->name('fees.index');

    Route::get('/fee-types', function () {
        return view('modules.fees.types');
    })->name('fee-types.index');

    Route::get('/invoices/create', function () {
        return view('modules.fees.create-invoice');
    })->name('invoices.create');

    Route::get('/payments', function () {
        return view('modules.fees.payments');
    })->name('payments.index');

    Route::get('/alerts/due', function () {
        return view('modules.fees.due-alerts');
    })->name('alerts.due');


    Route::get('/exams', function () {
        return view('modules.school.settings');
    })->name('school.settings');
});

// Module Settings Route
// Route::middleware(['auth', 'permission:manage_school_settings'])->group(function () {
//     Route::get('/school/{school}/module-settings', [ModuleController::class, 'index'])->name('module.settings');
// });
// Module Settings Route - Without school parameter
Route::middleware(['auth', 'permission:manage_school_settings'])->group(function () {
    // Route using current user's school
    Route::get('/my-school/module-settings', function () {
        $school = auth()->user()->school;
        return app(ModuleController::class)->index($school);
    })->name('module.settings');

    // Keep original route for super admin
    Route::get('/school/{school}/module-settings', [ModuleController::class, 'index'])->name('admin.module.settings');
});

require __DIR__ . '/auth.php';

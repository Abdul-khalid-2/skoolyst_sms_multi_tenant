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
    // School Management Module Routes
    Route::get('/schools', function () {
        // Dummy schools data
        $schools = [
            [
                'id' => 1,
                'name' => 'ABC International School',
                'email' => 'info@abc.edu.pk',
                'phone' => '+92 300 1234567',
                'address' => '123 Main Street, Karachi',
                'logo' => 'schools/logos/abc-logo.jpg',
                'status' => 'active',
                'branches_count' => 3,
                'users_count' => 45,
                'active_users_count' => 42,
                'inactive_users_count' => 3,
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(5),
            ],
            [
                'id' => 2,
                'name' => 'City Grammar School',
                'email' => 'contact@citygrammar.edu.pk',
                'phone' => '+92 300 7654321',
                'address' => '456 College Road, Lahore',
                'logo' => null,
                'status' => 'active',
                'branches_count' => 2,
                'users_count' => 28,
                'active_users_count' => 25,
                'inactive_users_count' => 3,
                'created_at' => now()->subDays(45),
                'updated_at' => now()->subDays(10),
            ],
            [
                'id' => 3,
                'name' => 'Global Academy',
                'email' => 'admin@globalacademy.edu.pk',
                'phone' => '+92 300 9876543',
                'address' => '789 University Avenue, Islamabad',
                'logo' => 'schools/logos/global-logo.png',
                'status' => 'inactive',
                'branches_count' => 1,
                'users_count' => 15,
                'active_users_count' => 0,
                'inactive_users_count' => 15,
                'created_at' => now()->subDays(60),
                'updated_at' => now()->subDays(2),
            ],
            [
                'id' => 4,
                'name' => 'Bright Future School',
                'email' => 'info@brightfuture.edu.pk',
                'phone' => '+92 300 4567890',
                'address' => '321 Education Road, Rawalpindi',
                'logo' => null,
                'status' => 'active',
                'branches_count' => 1,
                'users_count' => 32,
                'active_users_count' => 30,
                'inactive_users_count' => 2,
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(1),
            ],
            [
                'id' => 5,
                'name' => 'Excel High School',
                'email' => 'principal@excelhigh.edu.pk',
                'phone' => '+92 300 2345678',
                'address' => '654 Knowledge Street, Faisalabad',
                'logo' => 'schools/logos/excel-logo.jpg',
                'status' => 'active',
                'branches_count' => 4,
                'users_count' => 56,
                'active_users_count' => 54,
                'inactive_users_count' => 2,
                'created_at' => now()->subDays(90),
                'updated_at' => now()->subDays(7),
            ],
        ];

        // Convert arrays to objects for easier access in blade
        $schools = array_map(function ($school) {
            return (object) $school;
        }, $schools);

        return view('dashboard.schools.index', compact('schools'));
    })->name('schools.index');

    Route::get('/schools/create', function () {
        return view('modules.schools.create');
    })->name('schools.create');

    Route::get('/schools/{id}', function ($id) {
        // Dummy school data
        $school = (object) [
            'id' => $id,
            'name' => 'ABC International School',
            'email' => 'info@abc.edu.pk',
            'phone' => '+92 300 1234567',
            'address' => '123 Main Street, Karachi, Pakistan',
            'logo' => 'schools/logos/abc-logo.jpg',
            'status' => 'active',
            'branches_count' => 3,
            'users_count' => 45,
            'active_users_count' => 42,
            'inactive_users_count' => 3,
            'created_at' => now()->subDays(30),
            'updated_at' => now()->subDays(5),
        ];

        return view('dashboard.schools.show', compact('school'));
    })->name('schools.show');

    Route::get('/schools/{id}/edit', function ($id) {
        // Dummy school data for edit form
        $school = (object) [
            'id' => $id,
            'name' => 'ABC International School',
            'email' => 'info@abc.edu.pk',
            'phone' => '+92 300 1234567',
            'address' => '123 Main Street, Karachi',
            'logo' => 'schools/logos/abc-logo.jpg',
            'status' => 'active',
            'branches_count' => 3,
            'users_count' => 45,
            'created_at' => now()->subDays(30),
            'updated_at' => now()->subDays(5),
        ];

        return view('dashboard.schools.edit', compact('school'));
    })->name('schools.edit');

    Route::get('/schools/{id}/settings', function ($id) {
        // Dummy school data
        $school = (object) [
            'id' => $id,
            'name' => 'ABC International School',
            'email' => 'info@abc.edu.pk',
            'phone' => '+92 300 1234567',
            'address' => '123 Main Street, Karachi',
            'logo' => 'schools/logos/abc-logo.jpg',
            'status' => 'active',
            'branches_count' => 3,
            'users_count' => 45,
            'created_at' => now()->subDays(30),
            'updated_at' => now()->subDays(5),
        ];

        // Dummy settings data
        $settings = [
            'current_academic_year' => '2024-2025',
            'default_class' => '1st',
            'timezone' => 'Asia/Karachi',
            'currency' => 'PKR',
            'fee_due_days' => '10',
            'late_fee_amount' => '500',
            'enable_partial_payment' => true,
            'primary_color' => '#007bff',
            'secondary_color' => '#6c757d',
        ];

        return view('modules.schools.settings', compact('school', 'settings'));
    })->name('schools.settings');

    Route::get('/schools/{id}/activation', function ($id) {
        // Dummy school data for activation page
        $school = (object) [
            'id' => $id,
            'name' => 'ABC International School',
            'email' => 'info@abc.edu.pk',
            'phone' => '+92 300 1234567',
            'address' => '123 Main Street, Karachi',
            'logo' => 'schools/logos/abc-logo.jpg',
            'status' => 'active',
            'branches_count' => 3,
            'users_count' => 45,
            'active_users_count' => 42,
            'inactive_users_count' => 3,
            'created_at' => now()->subDays(30),
            'updated_at' => now()->subDays(5),
        ];

        return view('modules.schools.activation', compact('school'));
    })->name('schools.activation');

    // Dummy POST routes for form submissions (for testing)
    Route::post('/schools', function () {
        return redirect()->route('schools.index')
            ->with('success', 'School created successfully!');
    })->name('schools.store');

    Route::put('/schools/{id}', function ($id) {
        return redirect()->route('schools.index')
            ->with('success', 'School updated successfully!');
    })->name('schools.update');

    Route::delete('/schools/{id}', function ($id) {
        return redirect()->route('schools.index')
            ->with('success', 'School deleted successfully!');
    })->name('schools.destroy');

    Route::put('/schools/{id}/settings', function ($id) {
        return redirect()->route('schools.settings', $id)
            ->with('success', 'Settings updated successfully!');
    })->name('schools.settings.update');

    Route::put('/schools/{id}/activation', function ($id) {
        $status = request('status') == 'active' ? 'activated' : 'deactivated';
        return redirect()->route('schools.activation', $id)
            ->with('success', "School {$status} successfully!");
    })->name('schools.activation.update');




    // Route::get('/schools', function () {
    //     return view('dashboard');
    // })->name('schools.index');

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

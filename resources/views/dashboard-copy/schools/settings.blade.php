<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">School Settings</h4>
                <p class="mb-0">Manage school configuration</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Schools</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </nav>
            </div>
        </div>

        <form action="{{ route('schools.settings.update', $school->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Success Alert -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <!-- Error Alert -->
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            
            <!-- 1. General Information Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="las la-info-circle mr-2"></i> General Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Current Academic Year *</label>
                                <select name="academic_current_academic_year" class="form-control" required>
                                    <option value="">Select Academic Year</option>
                                    <option value="2025-2026" {{ ($settings['academic_current_academic_year'] ?? '') == '2025-2026' ? 'selected' : '' }}>2025-2026</option>
                                    <option value="2026-2027" {{ ($settings['academic_current_academic_year'] ?? '') == '2026-2027' ? 'selected' : '' }}>2026-2027</option>
                                    <option value="2027-2028" {{ ($settings['academic_current_academic_year'] ?? '') == '2027-2028' ? 'selected' : '' }}>2027-2028</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Default Class *</label>
                                <select name="default_class" class="form-control" required>
                                    <option value="">Select Default Class</option>
                                    <option value="Nursery" {{ ($settings['default_class'] ?? '') == 'Nursery' ? 'selected' : '' }}>Nursery</option>
                                    <option value="KG" {{ ($settings['default_class'] ?? '') == 'KG' ? 'selected' : '' }}>KG</option>
                                    <option value="1st" {{ ($settings['default_class'] ?? '') == '1st' ? 'selected' : '' }}>1st</option>
                                    <option value="2nd" {{ ($settings['default_class'] ?? '') == '2nd' ? 'selected' : '' }}>2nd</option>
                                    <option value="3rd" {{ ($settings['default_class'] ?? '') == '3rd' ? 'selected' : '' }}>3rd</option>
                                    <option value="4th" {{ ($settings['default_class'] ?? '') == '4th' ? 'selected' : '' }}>4th</option>
                                    <option value="5th" {{ ($settings['default_class'] ?? '') == '5th' ? 'selected' : '' }}>5th</option>
                                    <option value="6th" {{ ($settings['default_class'] ?? '') == '6th' ? 'selected' : '' }}>6th</option>
                                    <option value="7th" {{ ($settings['default_class'] ?? '') == '7th' ? 'selected' : '' }}>7th</option>
                                    <option value="8th" {{ ($settings['default_class'] ?? '') == '8th' ? 'selected' : '' }}>8th</option>
                                    <option value="9th" {{ ($settings['default_class'] ?? '') == '9th' ? 'selected' : '' }}>9th</option>
                                    <option value="10th" {{ ($settings['default_class'] ?? '') == '10th' ? 'selected' : '' }}>10th</option>
                                    <option value="11th" {{ ($settings['default_class'] ?? '') == '11th' ? 'selected' : '' }}>11th</option>
                                    <option value="12th" {{ ($settings['default_class'] ?? '') == '12th' ? 'selected' : '' }}>12th</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Timezone *</label>
                                <select name="timezone" class="form-control" required>
                                    <option value="">Select Timezone</option>
                                    <option value="Asia/Karachi" {{ ($settings['timezone'] ?? '') == 'Asia/Karachi' ? 'selected' : '' }}>Asia/Karachi (UTC+5)</option>
                                    <option value="UTC" {{ ($settings['timezone'] ?? '') == 'UTC' ? 'selected' : '' }}>UTC</option>
                                    <option value="America/New_York" {{ ($settings['timezone'] ?? '') == 'America/New_York' ? 'selected' : '' }}>America/New_York</option>
                                    <option value="Europe/London" {{ ($settings['timezone'] ?? '') == 'Europe/London' ? 'selected' : '' }}>Europe/London</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Currency *</label>
                                <select name="currency" class="form-control" required>
                                    <option value="PKR" {{ ($settings['currency'] ?? '') == 'PKR' ? 'selected' : '' }}>PKR - Pakistani Rupee</option>
                                    <option value="USD" {{ ($settings['currency'] ?? '') == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                                    <option value="EUR" {{ ($settings['currency'] ?? '') == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                                    <option value="GBP" {{ ($settings['currency'] ?? '') == 'GBP' ? 'selected' : '' }}>GBP - British Pound</option>
                                    <option value="SAR" {{ ($settings['currency'] ?? '') == 'SAR' ? 'selected' : '' }}>SAR - Saudi Riyal</option>
                                    <option value="AED" {{ ($settings['currency'] ?? '') == 'AED' ? 'selected' : '' }}>AED - UAE Dirham</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date Format *</label>
                                <select name="date_format" class="form-control" required>
                                    <option value="d/m/Y" {{ ($settings['date_format'] ?? '') == 'd/m/Y' ? 'selected' : '' }}>DD/MM/YYYY (31/12/2024)</option>
                                    <option value="m/d/Y" {{ ($settings['date_format'] ?? '') == 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY (12/31/2024)</option>
                                    <option value="Y-m-d" {{ ($settings['date_format'] ?? '') == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD (2024-12-31)</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Time Format *</label>
                                <select name="time_format" class="form-control" required>
                                    <option value="12" {{ ($settings['time_format'] ?? '') == '12' ? 'selected' : '' }}>12-hour format (2:30 PM)</option>
                                    <option value="24" {{ ($settings['time_format'] ?? '') == '24' ? 'selected' : '' }}>24-hour format (14:30)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Academic Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="las la-graduation-cap mr-2"></i> Academic Settings
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Grading System *</label>
                                <select name="grading_system" class="form-control" required>
                                    <option value="percentage" {{ ($settings['grading_system'] ?? '') == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                    <option value="cgpa" {{ ($settings['grading_system'] ?? '') == 'cgpa' ? 'selected' : '' }}>CGPA (4.0 scale)</option>
                                    <option value="gpa" {{ ($settings['grading_system'] ?? '') == 'gpa' ? 'selected' : '' }}>GPA (5.0 scale)</option>
                                    <option value="letter" {{ ($settings['grading_system'] ?? '') == 'letter' ? 'selected' : '' }}>Letter Grades (A-F)</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Passing Percentage *</label>
                                <input type="number" name="passing_percentage" class="form-control"
                                    value="{{ old('passing_percentage', $settings['passing_percentage'] ?? '40') }}" min="0" max="100" required>
                                <small class="form-text text-muted">Minimum percentage required to pass</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input"
                                        id="enable_attendance" name="enable_attendance" value="1" 
                                        {{ ($settings['enable_attendance'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="enable_attendance">
                                        Enable Attendance Tracking
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input"
                                        id="enable_exams" name="enable_exams" value="1"
                                        {{ ($settings['enable_exams'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="enable_exams">
                                        Enable Exam Management
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Academic Terms in Year</label>
                                <div class="row">
                                    @php
                                        $selectedTerms = json_decode($settings['terms'] ?? '["1st","2nd"]', true) ?? ['1st', '2nd'];
                                    @endphp
                                    <div class="col-4">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="term1" name="terms[]" value="1st" 
                                                {{ in_array('1st', $selectedTerms) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="term1">1st Term</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="term2" name="terms[]" value="2nd"
                                                {{ in_array('2nd', $selectedTerms) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="term2">2nd Term</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="term3" name="terms[]" value="3rd"
                                                {{ in_array('3rd', $selectedTerms) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="term3">3rd Term</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Fee Management Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="las la-money-bill-wave mr-2"></i> Fee Management Settings
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Basic Fee Settings -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-primary mb-3">Basic Settings</h6>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fee Due Days *</label>
                                <input type="number" name="fee_due_days" class="form-control"
                                    value="{{ old('fee_due_days', $settings['fee_due_days'] ?? '10') }}" min="1" max="90" required>
                                <small class="form-text text-muted">Days after which fee is considered late</small>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Late Fee Amount</label>
                                <input type="number" step="0.01" name="late_fee_amount" class="form-control"
                                    value="{{ old('late_fee_amount', $settings['late_fee_amount'] ?? '500.00') }}" min="0">
                                <small class="form-text text-muted">Fixed late fee amount</small>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Late Fee Type</label>
                                <select name="late_fee_type" class="form-control">
                                    <option value="fixed" {{ ($settings['late_fee_type'] ?? '') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                    <option value="percentage" {{ ($settings['late_fee_type'] ?? '') == 'percentage' ? 'selected' : '' }}>Percentage of Fee</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Fee Features -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-primary mb-3">Fee Features</h6>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_partial_payment" name="enable_partial_payment" value="1"
                                    {{ ($settings['enable_partial_payment'] ?? '1') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_partial_payment">
                                    Partial Payments
                                </label>
                                <small class="form-text text-muted">Allow installment payments</small>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_online_payment" name="enable_online_payment" value="1"
                                    {{ ($settings['enable_online_payment'] ?? '1') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_online_payment">
                                    Online Payments
                                </label>
                                <small class="form-text text-muted">Enable online fee payment</small>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_fee_waiver" name="enable_fee_waiver" value="1"
                                    {{ ($settings['enable_fee_waiver'] ?? '0') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_fee_waiver">
                                    Fee Waivers
                                </label>
                                <small class="form-text text-muted">Allow fee concessions</small>
                            </div>
                        </div>
                    </div>

                    <!-- Discount Settings -->
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="text-primary mb-3">Discount & Scholarship Settings</h6>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_sibling_discount" name="enable_sibling_discount" value="1"
                                    {{ ($settings['enable_sibling_discount'] ?? '1') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_sibling_discount">
                                    Sibling Discount
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_early_payment_discount" name="enable_early_payment_discount" value="1"
                                    {{ ($settings['enable_early_payment_discount'] ?? '0') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_early_payment_discount">
                                    Early Payment Discount
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_scholarship" name="enable_scholarship" value="1"
                                    {{ ($settings['enable_scholarship'] ?? '0') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_scholarship">
                                    Scholarships
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Student & Parent Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="las la-users mr-2"></i> Student & Parent Settings
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Admission Number Format</label>
                                <input type="text" name="admission_format" class="form-control"
                                    value="{{ old('admission_format', $settings['admission_format'] ?? 'SCH-{YEAR}-{SEQ}') }}" placeholder="e.g., SCH-2024-001">
                                <small class="form-text text-muted">Use {YEAR} for year, {SEQ} for sequence</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Roll Number Format</label>
                                <input type="text" name="roll_number_format" class="form-control"
                                    value="{{ old('roll_number_format', $settings['roll_number_format'] ?? '{CLASS}-{SECTION}-{NO}') }}" placeholder="e.g., 1-A-01">
                                <small class="form-text text-muted">Use {CLASS}, {SECTION}, {NO}</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_parent_portal" name="enable_parent_portal" value="1"
                                    {{ ($settings['enable_parent_portal'] ?? '1') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_parent_portal">
                                    Parent Portal Access
                                </label>
                                <small class="form-text text-muted">Allow parents to view student progress</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_student_portal" name="enable_student_portal" value="1"
                                    {{ ($settings['enable_student_portal'] ?? '0') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_student_portal">
                                    Student Portal Access
                                </label>
                                <small class="form-text text-muted">Allow students to access their portal</small>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_sms_notifications" name="enable_sms_notifications" value="1"
                                    {{ ($settings['enable_sms_notifications'] ?? '0') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_sms_notifications">
                                    SMS Notifications
                                </label>
                                <small class="form-text text-muted">Send SMS alerts for attendance, fees, etc.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. Staff & Teacher Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="las la-chalkboard-teacher mr-2"></i> Staff & Teacher Settings
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Employee ID Format</label>
                                <input type="text" name="employee_id_format" class="form-control"
                                    value="{{ old('employee_id_format', $settings['employee_id_format'] ?? 'EMP-{YEAR}-{SEQ}') }}" placeholder="e.g., EMP-2024-001">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Default Working Hours/Day</label>
                                <input type="number" name="working_hours" class="form-control"
                                    value="{{ old('working_hours', $settings['working_hours'] ?? '8') }}" min="1" max="12">
                                <small class="form-text text-muted">Standard working hours per day</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_teacher_portal" name="enable_teacher_portal" value="1"
                                    {{ ($settings['enable_teacher_portal'] ?? '1') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_teacher_portal">
                                    Teacher Portal
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_attendance_tracking" name="enable_attendance_tracking" value="1"
                                    {{ ($settings['enable_attendance_tracking'] ?? '0') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_attendance_tracking">
                                    Staff Attendance Tracking
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. Inventory & Library Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="las la-book mr-2"></i> Inventory & Library Settings
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_library" name="enable_library" value="1"
                                    {{ ($settings['enable_library'] ?? '1') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_library">
                                    Library Management
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_inventory" name="enable_inventory" value="1"
                                    {{ ($settings['enable_inventory'] ?? '0') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_inventory">
                                    Inventory Management
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Maximum Books Issuance</label>
                                <input type="number" name="max_books" class="form-control"
                                    value="{{ old('max_books', $settings['max_books'] ?? '3') }}" min="1" max="10">
                                <small class="form-text text-muted">Maximum books a student can borrow</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Book Return Days</label>
                                <input type="number" name="book_return_days" class="form-control"
                                    value="{{ old('book_return_days', $settings['book_return_days'] ?? '14') }}" min="1" max="90">
                                <small class="form-text text-muted">Days allowed to keep borrowed books</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 7. Transportation Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="las la-bus mr-2"></i> Transportation Settings
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_transport" name="enable_transport" value="1"
                                    {{ ($settings['enable_transport'] ?? '0') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_transport">
                                    Transportation Management
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Transport Fee Type</label>
                                <select name="transport_fee_type" class="form-control">
                                    <option value="monthly" {{ ($settings['transport_fee_type'] ?? '') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="quarterly" {{ ($settings['transport_fee_type'] ?? '') == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                                    <option value="yearly" {{ ($settings['transport_fee_type'] ?? '') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 8. Theme & Branding -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="las la-palette mr-2"></i> Theme & Branding
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Primary Color</label>
                                <div class="input-group colorpickerinput">
                                    <input type="text" name="primary_color" class="form-control"
                                        value="{{ old('primary_color', $settings['primary_color'] ?? '#007bff') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon">
                                            <i></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Secondary Color</label>
                                <div class="input-group colorpickerinput">
                                    <input type="text" name="secondary_color" class="form-control"
                                        value="{{ old('secondary_color', $settings['secondary_color'] ?? '#6c757d') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon">
                                            <i></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Logo Display</label>
                                <select name="logo_display" class="form-control">
                                    <option value="show" {{ ($settings['logo_display'] ?? '') == 'show' ? 'selected' : '' }}>Show on all pages</option>
                                    <option value="login_only" {{ ($settings['logo_display'] ?? '') == 'login_only' ? 'selected' : '' }}>Login page only</option>
                                    <option value="hide" {{ ($settings['logo_display'] ?? '') == 'hide' ? 'selected' : '' }}>Hide</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 9. System & Security Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="las la-shield-alt mr-2"></i> System & Security Settings
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Session Timeout (minutes)</label>
                                <input type="number" name="session_timeout" class="form-control"
                                    value="{{ old('session_timeout', $settings['session_timeout'] ?? '30') }}" min="5" max="240">
                                <small class="form-text text-muted">Auto logout after inactivity</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Max Login Attempts</label>
                                <input type="number" name="max_login_attempts" class="form-control"
                                    value="{{ old('max_login_attempts', $settings['max_login_attempts'] ?? '5') }}" min="1" max="10">
                                <small class="form-text text-muted">Before account lockout</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_two_factor" name="enable_two_factor" value="1"
                                    {{ ($settings['enable_two_factor'] ?? '0') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_two_factor">
                                    Two-Factor Authentication
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="enable_audit_log" name="enable_audit_log" value="1"
                                    {{ ($settings['enable_audit_log'] ?? '1') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="enable_audit_log">
                                    Audit Logging
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="las la-save mr-2"></i> Save All Settings
                            </button>
                            <button type="reset" class="btn btn-danger mr-2">
                                <i class="las la-redo mr-2"></i> Reset to Default
                            </button>
                            <a href="{{ route('schools.show', $school->id) }}" class="btn btn-secondary">
                                <i class="las la-arrow-left mr-2"></i> Back to School Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Color Picker -->
    <script>
        $(document).ready(function() {
            // Initialize color picker if available
            if($.fn.colorpicker) {
                $('.colorpickerinput').colorpicker();
            }
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
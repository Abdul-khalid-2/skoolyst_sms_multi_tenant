<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    @endpush

    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Create New User</h4>
                            <p class="mb-0">Add a new user to the system</p>
                        </div>
                        <a href="#" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Back to Users
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf
                            
                            <!-- User Type Selection -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h6 class="text-primary mb-3">Select User Type</h6>
                                    <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                        <label class="btn btn-outline-primary active">
                                            <input type="radio" name="user_type" id="type_staff" checked> Staff
                                        </label>
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="user_type" id="type_teacher"> Teacher
                                        </label>
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="user_type" id="type_student"> Student
                                        </label>
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="user_type" id="type_parent"> Parent
                                        </label>
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="user_type" id="type_admin"> Administrator
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Basic Information -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-user-circle mr-2"></i> Basic Information
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name *</label>
                                        <input type="text" name="first_name" class="form-control" 
                                               placeholder="Enter first name" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name *</label>
                                        <input type="text" name="last_name" class="form-control" 
                                               placeholder="Enter last name" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address *</label>
                                        <input type="email" name="email" class="form-control" 
                                               placeholder="Enter email address" required>
                                        <small class="form-text text-muted">Will be used for login</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" class="form-control" 
                                               placeholder="Enter phone number">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" name="date_of_birth" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control" rows="2" 
                                                  placeholder="Enter full address"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Professional Details (for Staff/Teachers) -->
                            <div class="row mt-4" id="professional-section">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-briefcase mr-2"></i> Professional Details
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input type="text" name="designation" class="form-control" 
                                               placeholder="e.g., Mathematics Teacher">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select name="department" class="form-control">
                                            <option value="">Select Department</option>
                                            <option value="administration">Administration</option>
                                            <option value="academic">Academic</option>
                                            <option value="finance">Finance</option>
                                            <option value="it">IT Department</option>
                                            <option value="operations">Operations</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Joining Date</label>
                                        <input type="date" name="joining_date" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee ID</label>
                                        <input type="text" name="employee_id" class="form-control" 
                                               placeholder="Auto-generated if left blank">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Academic Details (for Students) -->
                            <div class="row mt-4 d-none" id="academic-section">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-graduation-cap mr-2"></i> Academic Details
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Roll Number</label>
                                        <input type="text" name="roll_number" class="form-control" 
                                               placeholder="e.g., 2024-001">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Admission Date</label>
                                        <input type="date" name="admission_date" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Class/Grade</label>
                                        <select name="class" class="form-control">
                                            <option value="">Select Class</option>
                                            <option value="nursery">Nursery</option>
                                            <option value="kg">KG</option>
                                            <option value="1">1st</option>
                                            <option value="2">2nd</option>
                                            <option value="3">3rd</option>
                                            <option value="4">4th</option>
                                            <option value="5">5th</option>
                                            <option value="6">6th</option>
                                            <option value="7">7th</option>
                                            <option value="8">8th</option>
                                            <option value="9">9th</option>
                                            <option value="10">10th</option>
                                            <option value="11">11th</option>
                                            <option value="12">12th</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section</label>
                                        <select name="section" class="form-control">
                                            <option value="">Select Section</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- School Assignment -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-school mr-2"></i> School Assignment
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>School *</label>
                                        <select name="school_id" class="form-control" required>
                                            <option value="">Select School</option>
                                            <option value="1">ABC International School</option>
                                            <option value="2">City Grammar School</option>
                                            <option value="3">Global Academy</option>
                                            <option value="4">Bright Future School</option>
                                            <option value="5">Excel High School</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Branch</label>
                                        <select name="branch_id" class="form-control">
                                            <option value="">Select Branch (Optional)</option>
                                            <option value="1">Main Campus</option>
                                            <option value="2">Secondary Campus</option>
                                            <option value="3">Evening Campus</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Account Settings -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-cog mr-2"></i> Account Settings
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username *</label>
                                        <input type="text" name="username" class="form-control" 
                                               placeholder="Auto-generated from email if left blank">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>User Role *</label>
                                        <select name="role" class="form-control" required id="role-select">
                                            <option value="">Select Role</option>
                                            <option value="school_admin">School Administrator</option>
                                            <option value="teacher">Teacher</option>
                                            <option value="accountant">Accountant</option>
                                            <option value="parent">Parent</option>
                                            <option value="student">Student</option>
                                            <option value="librarian">Librarian</option>
                                            <option value="supervisor">Supervisor</option>
                                            <option value="receptionist">Receptionist</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password *</label>
                                        <input type="password" name="password" class="form-control" 
                                               placeholder="Enter password" required>
                                        <small class="form-text text-muted">Minimum 8 characters</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Password *</label>
                                        <input type="password" name="password_confirmation" class="form-control" 
                                               placeholder="Confirm password" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="send_welcome_email" name="send_welcome_email" checked>
                                        <label class="custom-control-label" for="send_welcome_email">
                                            Send welcome email with login credentials
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="force_password_change" name="force_password_change">
                                        <label class="custom-control-label" for="force_password_change">
                                            Force password change on first login
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="account_active" name="account_active" checked>
                                        <label class="custom-control-label" for="account_active">
                                            Account Active (User can login immediately)
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Additional Settings -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">
                                                <i class="las la-plus-circle mr-2"></i> Additional Settings (Optional)
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Additional Roles</label>
                                                        <select name="additional_roles[]" class="form-control" multiple style="height: 120px;">
                                                            <option value="report_viewer">Report Viewer</option>
                                                            <option value="attendance_manager">Attendance Manager</option>
                                                            <option value="fee_collector">Fee Collector</option>
                                                            <option value="library_access">Library Access</option>
                                                            <option value="exam_manager">Exam Manager</option>
                                                            <option value="transport_manager">Transport Manager</option>
                                                            <option value="inventory_manager">Inventory Manager</option>
                                                        </select>
                                                        <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple roles</small>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Access Permissions</label>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="permission_dashboard" checked>
                                                            <label class="custom-control-label" for="permission_dashboard">Dashboard Access</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="permission_reports">
                                                            <label class="custom-control-label" for="permission_reports">Report Generation</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="permission_export">
                                                            <label class="custom-control-label" for="permission_export">Data Export</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="permission_import">
                                                            <label class="custom-control-label" for="permission_import">Data Import</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="las la-user-plus mr-2"></i> Create User
                                    </button>
                                    <button type="reset" class="btn btn-danger">
                                        <i class="las la-redo mr-2"></i> Reset Form
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <!-- User Type Toggle -->
    <script>
        $(document).ready(function() {
            // Toggle sections based on user type
            $('input[name="user_type"]').change(function() {
                var userType = $(this).attr('id');
                
                // Hide all sections first
                $('#professional-section').addClass('d-none');
                $('#academic-section').addClass('d-none');
                
                // Show relevant sections
                if(userType === 'type_staff' || userType === 'type_teacher' || userType === 'type_admin') {
                    $('#professional-section').removeClass('d-none');
                } else if(userType === 'type_student') {
                    $('#academic-section').removeClass('d-none');
                }
                
                // Update role selection based on user type
                var roleSelect = $('#role-select');
                roleSelect.val('');
                
                switch(userType) {
                    case 'type_staff':
                        roleSelect.find('option[value="accountant"], option[value="librarian"], option[value="supervisor"], option[value="receptionist"]').show();
                        break;
                    case 'type_teacher':
                        roleSelect.val('teacher');
                        break;
                    case 'type_student':
                        roleSelect.val('student');
                        break;
                    case 'type_parent':
                        roleSelect.val('parent');
                        break;
                    case 'type_admin':
                        roleSelect.val('school_admin');
                        break;
                }
            });
            
            // Password confirmation validation
            $('input[name="password_confirmation"]').on('keyup', function() {
                var password = $('input[name="password"]').val();
                var confirmPassword = $(this).val();
                
                if(password !== '' && confirmPassword !== '' && password !== confirmPassword) {
                    $(this).addClass('is-invalid');
                    $(this).removeClass('is-valid');
                } else if(password !== '' && confirmPassword !== '' && password === confirmPassword) {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                    $('input[name="password"]').addClass('is-valid');
                }
            });
            
            // Auto-generate username from email
            $('input[name="email"]').on('blur', function() {
                var email = $(this).val();
                var usernameInput = $('input[name="username"]');
                
                if(email && !usernameInput.val()) {
                    var username = email.split('@')[0];
                    usernameInput.val(username);
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
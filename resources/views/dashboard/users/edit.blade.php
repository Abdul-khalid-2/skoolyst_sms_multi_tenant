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
                            <h4 class="card-title">Edit User</h4>
                            <p class="mb-0">Update user information and settings</p>
                        </div>
                        <a href="#" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Back to Users
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <!-- User Information -->
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
                                               value="Sarah" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name *</label>
                                        <input type="text" name="last_name" class="form-control" 
                                               value="Smith" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address *</label>
                                        <input type="email" name="email" class="form-control" 
                                               value="sarah.smith@abc.edu.pk" required>
                                        <small class="form-text text-muted">User's primary email for login</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" class="form-control" 
                                               value="+92 300 7654321">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" name="date_of_birth" class="form-control" 
                                               value="1988-03-15">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="male">Male</option>
                                            <option value="female" selected>Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control" rows="3">456 Garden Town, Lahore, Punjab, Pakistan</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Professional Details -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-briefcase mr-2"></i> Professional Details
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Designation *</label>
                                        <input type="text" name="designation" class="form-control" 
                                               value="School Administrator" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee ID</label>
                                        <input type="text" name="employee_id" class="form-control" 
                                               value="EMP-2024-002" readonly>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select name="department" class="form-control">
                                            <option value="administration" selected>Administration</option>
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
                                        <input type="date" name="joining_date" class="form-control" 
                                               value="2024-01-20">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>School *</label>
                                        <select name="school_id" class="form-control" required>
                                            <option value="">Select School</option>
                                            <option value="1" selected>ABC International School</option>
                                            <option value="2">City Grammar School</option>
                                            <option value="3">Global Academy</option>
                                            <option value="4">Bright Future School</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Branch</label>
                                        <select name="branch_id" class="form-control">
                                            <option value="">Select Branch</option>
                                            <option value="1" selected>Main Campus</option>
                                            <option value="2">Secondary Campus</option>
                                            <option value="3">Evening Campus</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Bio / About</label>
                                        <textarea name="bio" class="form-control" rows="3">Experienced school administrator with 8 years in educational management. Specialized in operational efficiency and staff management.</textarea>
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
                                               value="sarah.smith" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Account Status *</label>
                                        <select name="status" class="form-control" required>
                                            <option value="active" selected>Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="suspended">Suspended</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>User Role *</label>
                                        <select name="role" class="form-control" required>
                                            <option value="">Select Role</option>
                                            <option value="super_admin">Super Administrator</option>
                                            <option value="school_admin" selected>School Administrator</option>
                                            <option value="teacher">Teacher</option>
                                            <option value="accountant">Accountant</option>
                                            <option value="parent">Parent</option>
                                            <option value="student">Student</option>
                                            <option value="librarian">Librarian</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Additional Roles</label>
                                        <select name="additional_roles[]" class="form-control" multiple>
                                            <option value="report_viewer" selected>Report Viewer</option>
                                            <option value="attendance_manager">Attendance Manager</option>
                                            <option value="fee_collector">Fee Collector</option>
                                            <option value="library_access">Library Access</option>
                                        </select>
                                        <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple roles</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="email_verified" name="email_verified" checked>
                                        <label class="custom-control-label" for="email_verified">
                                            Email Verified
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="phone_verified" name="phone_verified" checked>
                                        <label class="custom-control-label" for="phone_verified">
                                            Phone Verified
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="force_password_change" name="force_password_change">
                                        <label class="custom-control-label" for="force_password_change">
                                            Force Password Change on Next Login
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Change Password (Optional) -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">
                                                <i class="las la-key mr-2"></i> Change Password (Optional)
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input type="password" name="new_password" class="form-control">
                                                        <small class="form-text text-muted">Leave blank to keep current password</small>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Confirm New Password</label>
                                                        <input type="password" name="new_password_confirmation" class="form-control">
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
                                        <i class="las la-save mr-2"></i> Update User
                                    </button>
                                    <button type="reset" class="btn btn-danger mr-2">
                                        <i class="las la-redo mr-2"></i> Reset
                                    </button>
                                    <a href="#" class="btn btn-secondary">
                                        <i class="las la-times mr-2"></i> Cancel
                                    </a>
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
    
    <!-- Form Validation -->
    <script>
        $(document).ready(function() {
            // Password confirmation validation
            $('input[name="new_password_confirmation"]').on('keyup', function() {
                var password = $('input[name="new_password"]').val();
                var confirmPassword = $(this).val();
                
                if(password !== confirmPassword) {
                    $(this).addClass('is-invalid');
                    $(this).removeClass('is-valid');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                }
            });
            
            // Reset form button
            $('button[type="reset"]').click(function() {
                if(confirm('Are you sure you want to reset all changes?')) {
                    location.reload();
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
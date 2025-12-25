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
                            <h4 class="card-title">Create New Role</h4>
                        </div>
                        <a href="#" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Back to Roles
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf
                            
                            <!-- Role Information -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-info-circle mr-2"></i> Role Information
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role Name *</label>
                                        <input type="text" name="name" class="form-control" 
                                               placeholder="Enter role name (e.g., Librarian)" required>
                                        <small class="form-text text-muted">Unique name for the role</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Display Name *</label>
                                        <input type="text" name="display_name" class="form-control" 
                                               placeholder="Enter display name (e.g., Library Manager)" required>
                                        <small class="form-text text-muted">User-friendly name shown in system</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="3" 
                                                  placeholder="Describe the role's purpose and responsibilities"></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role Type</label>
                                        <select name="role_type" class="form-control">
                                            <option value="system">System Role</option>
                                            <option value="school" selected>School Role</option>
                                            <option value="custom">Custom Role</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active" selected>Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Permission Selection -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-user-shield mr-2"></i> Assign Permissions
                                    </h5>
                                    <p class="text-muted mb-4">Select permissions to assign to this role</p>
                                </div>
                                
                                <!-- Quick Select Options -->
                                <div class="col-md-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Quick Permission Sets</h6>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-outline-primary active">
                                                    <input type="radio" name="permission_set" id="option1" checked> Read Only
                                                </label>
                                                <label class="btn btn-outline-primary">
                                                    <input type="radio" name="permission_set" id="option2"> Basic Access
                                                </label>
                                                <label class="btn btn-outline-primary">
                                                    <input type="radio" name="permission_set" id="option3"> Full Access
                                                </label>
                                                <label class="btn btn-outline-primary">
                                                    <input type="radio" name="permission_set" id="option4"> Custom
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Module Permissions -->
                                <div class="col-md-12">
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="dashboard_all">
                                                <label class="custom-control-label" for="dashboard_all">
                                                    <h6 class="mb-0">
                                                        <i class="las la-tachometer-alt mr-2"></i>
                                                        Dashboard Module
                                                    </h6>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="dashboard_view">
                                                        <label class="custom-control-label" for="dashboard_view">View Dashboard</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="dashboard_stats">
                                                        <label class="custom-control-label" for="dashboard_stats">View Statistics</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="dashboard_reports">
                                                        <label class="custom-control-label" for="dashboard_reports">Generate Reports</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user_management_all">
                                                <label class="custom-control-label" for="user_management_all">
                                                    <h6 class="mb-0">
                                                        <i class="las la-users mr-2"></i>
                                                        User Management
                                                    </h6>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="user_view">
                                                        <label class="custom-control-label" for="user_view">View Users</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="user_create">
                                                        <label class="custom-control-label" for="user_create">Create Users</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="user_edit">
                                                        <label class="custom-control-label" for="user_edit">Edit Users</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="user_delete">
                                                        <label class="custom-control-label" for="user_delete">Delete Users</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="user_activate">
                                                        <label class="custom-control-label" for="user_activate">Activate/Deactivate</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="role_manage">
                                                        <label class="custom-control-label" for="role_manage">Manage Roles</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="student_management_all">
                                                <label class="custom-control-label" for="student_management_all">
                                                    <h6 class="mb-0">
                                                        <i class="las la-user-graduate mr-2"></i>
                                                        Student Management
                                                    </h6>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="student_view">
                                                        <label class="custom-control-label" for="student_view">View Students</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="student_create">
                                                        <label class="custom-control-label" for="student_create">Add Students</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="student_edit">
                                                        <label class="custom-control-label" for="student_edit">Edit Students</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="student_delete">
                                                        <label class="custom-control-label" for="student_delete">Delete Students</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="student_promote">
                                                        <label class="custom-control-label" for="student_promote">Promote Students</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="fee_management_all">
                                                <label class="custom-control-label" for="fee_management_all">
                                                    <h6 class="mb-0">
                                                        <i class="las la-money-bill-wave mr-2"></i>
                                                        Fee Management
                                                    </h6>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="fee_view">
                                                        <label class="custom-control-label" for="fee_view">View Fees</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="fee_create">
                                                        <label class="custom-control-label" for="fee_create">Create Fees</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="fee_collect">
                                                        <label class="custom-control-label" for="fee_collect">Collect Fees</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="fee_waiver">
                                                        <label class="custom-control-label" for="fee_waiver">Grant Waivers</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="academic_management_all">
                                                <label class="custom-control-label" for="academic_management_all">
                                                    <h6 class="mb-0">
                                                        <i class="las la-book-open mr-2"></i>
                                                        Academic Management
                                                    </h6>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="class_view">
                                                        <label class="custom-control-label" for="class_view">View Classes</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="class_manage">
                                                        <label class="custom-control-label" for="class_manage">Manage Classes</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="subject_manage">
                                                        <label class="custom-control-label" for="subject_manage">Manage Subjects</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="timetable_manage">
                                                        <label class="custom-control-label" for="timetable_manage">Manage Timetable</label>
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
                                        <i class="las la-save mr-2"></i> Create Role
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
    
    <!-- Checkbox Toggle All -->
    <script>
        $(document).ready(function() {
            // Toggle all checkboxes in a module when header checkbox is clicked
            $('.card-header .custom-control-input').change(function() {
                var cardBody = $(this).closest('.card-header').next('.card-body');
                var checkboxes = cardBody.find('.custom-control-input');
                checkboxes.prop('checked', $(this).prop('checked'));
            });
            
            // Quick permission sets
            $('input[name="permission_set"]').change(function() {
                var set = $(this).attr('id');
                
                // Reset all checkboxes
                $('.custom-control-input').prop('checked', false);
                
                // Set based on selection
                switch(set) {
                    case 'option1': // Read Only
                        $('input[id$="_view"]').prop('checked', true);
                        break;
                    case 'option2': // Basic Access
                        $('input[id$="_view"], input[id$="_create"], input[id$="_edit"]').prop('checked', true);
                        break;
                    case 'option3': // Full Access
                        $('.custom-control-input').prop('checked', true);
                        break;
                    // option4 (Custom) does nothing - user will select manually
                }
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
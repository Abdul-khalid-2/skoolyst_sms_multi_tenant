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
                <h4 class="mb-3">Role & Permission Management</h4>
                <p class="mb-0">Define roles and assign permissions to control user access</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Roles & Permissions</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('roles.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-3"></i>Add New Role
                </a>
            </div>
        </div>

        <!-- Success Alert -->
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Role permissions updated successfully!
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Roles List -->
        <div class="row">
            <div class="col-lg-4">
                <!-- Roles Card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">System Roles</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Super Administrator</h6>
                                    <small>5 users</small>
                                </div>
                                <p class="mb-1">Full system access with all permissions</p>
                                <small>Created: 15 Jan 2024</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">School Administrator</h6>
                                    <small>12 users</small>
                                </div>
                                <p class="mb-1">Complete school management access</p>
                                <small>Created: 20 Jan 2024</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Teacher</h6>
                                    <small>45 users</small>
                                </div>
                                <p class="mb-1">Class and student management</p>
                                <small>Created: 22 Jan 2024</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Accountant</h6>
                                    <small>8 users</small>
                                </div>
                                <p class="mb-1">Fee and financial management</p>
                                <small>Created: 25 Jan 2024</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Parent</h6>
                                    <small>150 users</small>
                                </div>
                                <p class="mb-1">View student progress and fees</p>
                                <small>Created: 28 Jan 2024</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Student</h6>
                                    <small>500 users</small>
                                </div>
                                <p class="mb-1">Access to personal academic records</p>
                                <small>Created: 30 Jan 2024</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Librarian</h6>
                                    <small>3 users</small>
                                </div>
                                <p class="mb-1">Library book management</p>
                                <small>Created: 02 Feb 2024</small>
                            </a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-block">
                            <i class="las la-plus mr-2"></i> Create New Role
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <!-- Permissions Card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="las la-user-shield mr-2"></i>
                            Permissions for: <span class="text-primary">School Administrator</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <!-- Dashboard Module -->
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="las la-tachometer-alt mr-2"></i>
                                        Dashboard Module
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="dashboard_view" checked>
                                                <label class="custom-control-label" for="dashboard_view">View Dashboard</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="dashboard_stats" checked>
                                                <label class="custom-control-label" for="dashboard_stats">View Statistics</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="dashboard_reports">
                                                <label class="custom-control-label" for="dashboard_reports">Generate Reports</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- School Management -->
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="las la-school mr-2"></i>
                                        School Management
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="school_view" checked>
                                                <label class="custom-control-label" for="school_view">View Schools</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="school_create" checked>
                                                <label class="custom-control-label" for="school_create">Create School</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="school_edit" checked>
                                                <label class="custom-control-label" for="school_edit">Edit School</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="school_delete" checked>
                                                <label class="custom-control-label" for="school_delete">Delete School</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="school_settings" checked>
                                                <label class="custom-control-label" for="school_settings">School Settings</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="school_activate" checked>
                                                <label class="custom-control-label" for="school_activate">Activate/Deactivate</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- User Management -->
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="las la-users mr-2"></i>
                                        User Management
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user_view" checked>
                                                <label class="custom-control-label" for="user_view">View Users</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user_create" checked>
                                                <label class="custom-control-label" for="user_create">Create User</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user_edit" checked>
                                                <label class="custom-control-label" for="user_edit">Edit User</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user_delete" checked>
                                                <label class="custom-control-label" for="user_delete">Delete User</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="user_activate" checked>
                                                <label class="custom-control-label" for="user_activate">Activate/Deactivate</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="role_manage" checked>
                                                <label class="custom-control-label" for="role_manage">Manage Roles</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="permission_manage" checked>
                                                <label class="custom-control-label" for="permission_manage">Manage Permissions</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Student Management -->
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="las la-user-graduate mr-2"></i>
                                        Student Management
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="student_view" checked>
                                                <label class="custom-control-label" for="student_view">View Students</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="student_create" checked>
                                                <label class="custom-control-label" for="student_create">Add Student</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="student_edit" checked>
                                                <label class="custom-control-label" for="student_edit">Edit Student</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="student_delete">
                                                <label class="custom-control-label" for="student_delete">Delete Student</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="student_promote" checked>
                                                <label class="custom-control-label" for="student_promote">Promote Students</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="student_transfer">
                                                <label class="custom-control-label" for="student_transfer">Transfer Students</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fee Management -->
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="las la-money-bill-wave mr-2"></i>
                                        Fee Management
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="fee_view" checked>
                                                <label class="custom-control-label" for="fee_view">View Fees</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="fee_create" checked>
                                                <label class="custom-control-label" for="fee_create">Create Fee</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="fee_collect" checked>
                                                <label class="custom-control-label" for="fee_collect">Collect Fees</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="fee_waiver">
                                                <label class="custom-control-label" for="fee_waiver">Grant Fee Waivers</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="fee_reports" checked>
                                                <label class="custom-control-label" for="fee_reports">Fee Reports</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="fee_discount">
                                                <label class="custom-control-label" for="fee_discount">Give Discounts</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Academic Management -->
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="las la-book-open mr-2"></i>
                                        Academic Management
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="class_view" checked>
                                                <label class="custom-control-label" for="class_view">View Classes</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="class_manage" checked>
                                                <label class="custom-control-label" for="class_manage">Manage Classes</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="subject_manage" checked>
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

                            <!-- Reports -->
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="las la-chart-bar mr-2"></i>
                                        Reports & Analytics
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="report_view" checked>
                                                <label class="custom-control-label" for="report_view">View Reports</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="report_generate" checked>
                                                <label class="custom-control-label" for="report_generate">Generate Reports</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="report_export" checked>
                                                <label class="custom-control-label" for="report_export">Export Reports</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="analytics_view" checked>
                                                <label class="custom-control-label" for="analytics_view">View Analytics</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- System Settings -->
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="las la-cog mr-2"></i>
                                        System Settings
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="system_settings">
                                                <label class="custom-control-label" for="system_settings">System Settings</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="backup_manage">
                                                <label class="custom-control-label" for="backup_manage">Manage Backups</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="audit_logs">
                                                <label class="custom-control-label" for="audit_logs">View Audit Logs</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary mr-2">
                            <i class="las la-save mr-2"></i> Save Permissions
                        </button>
                        <button class="btn btn-secondary">
                            <i class="las la-redo mr-2"></i> Reset Changes
                        </button>
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
    
    <!-- Checkbox Toggle All -->
    <script>
        $(document).ready(function() {
            // Toggle all checkboxes in a section
            $('.card-header').click(function() {
                var cardBody = $(this).next('.card-body');
                var checkboxes = cardBody.find('.custom-control-input');
                var allChecked = checkboxes.length === checkboxes.filter(':checked').length;
                
                checkboxes.prop('checked', !allChecked);
            });
        });
    </script>
    @endpush
</x-app-layout>
<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .module-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .module-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .module-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 24px;
            margin-right: 15px;
        }
        
        .module-status {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
        
        .module-status.active {
            background-color: #28a745;
        }
        
        .module-status.inactive {
            background-color: #dc3545;
        }
        
        .module-status.pending {
            background-color: #ffc107;
        }
        
        .permission-group {
            border-left: 3px solid #007bff;
            padding-left: 15px;
            margin-bottom: 20px;
        }
        
        .version-badge {
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 10px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Module Settings</h4>
                <p class="mb-0">Manage and configure system modules and their permissions</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Modules</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#installModuleModal">
                    <i class="las la-plus mr-2"></i>Install Module
                </button>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Modules</h6>
                                <h2 class="mb-0 text-white">12</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-cubes fa-lg text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Active</h6>
                                <h2 class="mb-0 text-white">8</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-check-circle fa-lg text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Inactive</h6>
                                <h2 class="mb-0 text-white">3</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-toggle-off fa-lg text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">System Core</h6>
                                <h2 class="mb-0 text-white">4</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-server fa-lg text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modules Grid -->
        <div class="row mb-4">
            <!-- User Management Module -->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="module-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex align-items-center">
                                <div class="module-icon bg-primary text-white">
                                    <i class="las la-users"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">User Management</h5>
                                    <p class="text-muted mb-0">v2.5.1</p>
                                </div>
                            </div>
                            <div>
                                <span class="module-status active"></span>
                                <small class="text-success">Active</small>
                            </div>
                        </div>
                        
                        <p class="text-muted mb-3">Manage users, roles, permissions and profiles</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <small class="text-muted">Last Updated: 15 Dec 2024</small>
                            </div>
                            <span class="version-badge bg-primary text-white">Core</span>
                        </div>
                        
                        <div class="btn-group w-100">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="las la-cog mr-1"></i> Settings
                            </button>
                            <button class="btn btn-sm btn-outline-success">
                                <i class="las la-key mr-1"></i> Permissions
                            </button>
                            <button class="btn btn-sm btn-outline-warning">
                                <i class="las la-toggle-on mr-1"></i> Disable
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Management Module -->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="module-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex align-items-center">
                                <div class="module-icon bg-success text-white">
                                    <i class="las la-graduation-cap"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Academic Management</h5>
                                    <p class="text-muted mb-0">v1.8.3</p>
                                </div>
                            </div>
                            <div>
                                <span class="module-status active"></span>
                                <small class="text-success">Active</small>
                            </div>
                        </div>
                        
                        <p class="text-muted mb-3">Manage academic years, classes, sections, subjects</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <small class="text-muted">Last Updated: 10 Dec 2024</small>
                            </div>
                            <span class="version-badge bg-success text-white">Standard</span>
                        </div>
                        
                        <div class="btn-group w-100">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="las la-cog mr-1"></i> Settings
                            </button>
                            <button class="btn btn-sm btn-outline-success">
                                <i class="las la-key mr-1"></i> Permissions
                            </button>
                            <button class="btn btn-sm btn-outline-warning">
                                <i class="las la-toggle-on mr-1"></i> Disable
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Management Module -->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="module-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex align-items-center">
                                <div class="module-icon bg-info text-white">
                                    <i class="las la-user-graduate"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Student Management</h5>
                                    <p class="text-muted mb-0">v3.2.0</p>
                                </div>
                            </div>
                            <div>
                                <span class="module-status active"></span>
                                <small class="text-success">Active</small>
                            </div>
                        </div>
                        
                        <p class="text-muted mb-3">Manage student admissions, profiles, and records</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <small class="text-muted">Last Updated: 05 Dec 2024</small>
                            </div>
                            <span class="version-badge bg-info text-white">Premium</span>
                        </div>
                        
                        <div class="btn-group w-100">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="las la-cog mr-1"></i> Settings
                            </button>
                            <button class="btn btn-sm btn-outline-success">
                                <i class="las la-key mr-1"></i> Permissions
                            </button>
                            <button class="btn btn-sm btn-outline-warning">
                                <i class="las la-toggle-on mr-1"></i> Disable
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teacher Management Module -->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="module-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex align-items-center">
                                <div class="module-icon bg-warning text-white">
                                    <i class="las la-chalkboard-teacher"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Teacher Management</h5>
                                    <p class="text-muted mb-0">v2.1.5</p>
                                </div>
                            </div>
                            <div>
                                <span class="module-status active"></span>
                                <small class="text-success">Active</small>
                            </div>
                        </div>
                        
                        <p class="text-muted mb-3">Manage teachers, assignments, and timetables</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <small class="text-muted">Last Updated: 01 Dec 2024</small>
                            </div>
                            <span class="version-badge bg-warning text-white">Standard</span>
                        </div>
                        
                        <div class="btn-group w-100">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="las la-cog mr-1"></i> Settings
                            </button>
                            <button class="btn btn-sm btn-outline-success">
                                <i class="las la-key mr-1"></i> Permissions
                            </button>
                            <button class="btn btn-sm btn-outline-warning">
                                <i class="las la-toggle-on mr-1"></i> Disable
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Module -->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="module-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex align-items-center">
                                <div class="module-icon bg-danger text-white">
                                    <i class="las la-calendar-check"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Attendance</h5>
                                    <p class="text-muted mb-0">v2.9.0</p>
                                </div>
                            </div>
                            <div>
                                <span class="module-status active"></span>
                                <small class="text-success">Active</small>
                            </div>
                        </div>
                        
                        <p class="text-muted mb-3">Track student and staff attendance</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <small class="text-muted">Last Updated: 28 Nov 2024</small>
                            </div>
                            <span class="version-badge bg-danger text-white">Premium</span>
                        </div>
                        
                        <div class="btn-group w-100">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="las la-cog mr-1"></i> Settings
                            </button>
                            <button class="btn btn-sm btn-outline-success">
                                <i class="las la-key mr-1"></i> Permissions
                            </button>
                            <button class="btn btn-sm btn-outline-warning">
                                <i class="las la-toggle-on mr-1"></i> Disable
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fees Management Module -->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="module-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex align-items-center">
                                <div class="module-icon bg-secondary text-white">
                                    <i class="las la-money-bill-wave"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Fees Management</h5>
                                    <p class="text-muted mb-0">v4.0.1</p>
                                </div>
                            </div>
                            <div>
                                <span class="module-status active"></span>
                                <small class="text-success">Active</small>
                            </div>
                        </div>
                        
                        <p class="text-muted mb-3">Manage fees, payments, invoices, and discounts</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <small class="text-muted">Last Updated: 25 Nov 2024</small>
                            </div>
                            <span class="version-badge bg-secondary text-white">Premium</span>
                        </div>
                        
                        <div class="btn-group w-100">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="las la-cog mr-1"></i> Settings
                            </button>
                            <button class="btn btn-sm btn-outline-success">
                                <i class="las la-key mr-1"></i> Permissions
                            </button>
                            <button class="btn btn-sm btn-outline-warning">
                                <i class="las la-toggle-on mr-1"></i> Disable
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exam Management Module (Inactive) -->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="module-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex align-items-center">
                                <div class="module-icon bg-dark text-white">
                                    <i class="las la-clipboard-list"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Exam Management</h5>
                                    <p class="text-muted mb-0">v1.5.2</p>
                                </div>
                            </div>
                            <div>
                                <span class="module-status inactive"></span>
                                <small class="text-danger">Inactive</small>
                            </div>
                        </div>
                        
                        <p class="text-muted mb-3">Manage exams, schedules, and results</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <small class="text-muted">Last Updated: 20 Nov 2024</small>
                            </div>
                            <span class="version-badge bg-dark text-white">Standard</span>
                        </div>
                        
                        <div class="btn-group w-100">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="las la-cog mr-1"></i> Settings
                            </button>
                            <button class="btn btn-sm btn-outline-success">
                                <i class="las la-key mr-1"></i> Permissions
                            </button>
                            <button class="btn btn-sm btn-outline-success">
                                <i class="las la-toggle-off mr-1"></i> Enable
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Library Management Module -->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="module-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex align-items-center">
                                <div class="module-icon bg-primary text-white">
                                    <i class="las la-book"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Library Management</h5>
                                    <p class="text-muted mb-0">v2.3.0</p>
                                </div>
                            </div>
                            <div>
                                <span class="module-status active"></span>
                                <small class="text-success">Active</small>
                            </div>
                        </div>
                        
                        <p class="text-muted mb-3">Manage books, issues, returns, and inventory</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <small class="text-muted">Last Updated: 15 Nov 2024</small>
                            </div>
                            <span class="version-badge bg-primary text-white">Standard</span>
                        </div>
                        
                        <div class="btn-group w-100">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="las la-cog mr-1"></i> Settings
                            </button>
                            <button class="btn btn-sm btn-outline-success">
                                <i class="las la-key mr-1"></i> Permissions
                            </button>
                            <button class="btn btn-sm btn-outline-warning">
                                <i class="las la-toggle-on mr-1"></i> Disable
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transport Module (Inactive) -->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="module-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex align-items-center">
                                <div class="module-icon bg-success text-white">
                                    <i class="las la-bus"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Transport Management</h5>
                                    <p class="text-muted mb-0">v1.2.1</p>
                                </div>
                            </div>
                            <div>
                                <span class="module-status inactive"></span>
                                <small class="text-danger">Inactive</small>
                            </div>
                        </div>
                        
                        <p class="text-muted mb-3">Manage vehicles, routes, and transport fees</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <small class="text-muted">Last Updated: 10 Nov 2024</small>
                            </div>
                            <span class="version-badge bg-success text-white">Add-on</span>
                        </div>
                        
                        <div class="btn-group w-100">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="las la-cog mr-1"></i> Settings
                            </button>
                            <button class="btn btn-sm btn-outline-success">
                                <i class="las la-key mr-1"></i> Permissions
                            </button>
                            <button class="btn btn-sm btn-outline-success">
                                <i class="las la-toggle-off mr-1"></i> Enable
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Module Permissions -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Module Permissions Configuration</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="permission-group">
                            <h6>User Management</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm1" checked>
                                <label class="form-check-label" for="perm1">Create Users</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm2" checked>
                                <label class="form-check-label" for="perm2">Edit Users</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm3" checked>
                                <label class="form-check-label" for="perm3">Delete Users</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm4" checked>
                                <label class="form-check-label" for="perm4">Manage Roles</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="permission-group">
                            <h6>Academic Management</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm5" checked>
                                <label class="form-check-label" for="perm5">Create Classes</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm6" checked>
                                <label class="form-check-label" for="perm6">Manage Sections</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm7" checked>
                                <label class="form-check-label" for="perm7">Create Subjects</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm8" checked>
                                <label class="form-check-label" for="perm8">Assign Teachers</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="permission-group">
                            <h6>Student Management</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm9" checked>
                                <label class="form-check-label" for="perm9">Admit Students</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm10" checked>
                                <label class="form-check-label" for="perm10">Edit Student Info</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm11" checked>
                                <label class="form-check-label" for="perm11">View Reports</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm12" checked>
                                <label class="form-check-label" for="perm12">Export Data</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="permission-group">
                            <h6>Fees Management</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm13" checked>
                                <label class="form-check-label" for="perm13">Create Invoices</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm14" checked>
                                <label class="form-check-label" for="perm14">Receive Payments</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm15" checked>
                                <label class="form-check-label" for="perm15">Grant Discounts</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm16" checked>
                                <label class="form-check-label" for="perm16">View Reports</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="permission-group">
                            <h6>Attendance Management</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm17" checked>
                                <label class="form-check-label" for="perm17">Take Attendance</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm18" checked>
                                <label class="form-check-label" for="perm18">View Reports</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm19" checked>
                                <label class="form-check-label" for="perm19">Send SMS Alerts</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm20" checked>
                                <label class="form-check-label" for="perm20">Export Data</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="permission-group">
                            <h6>Teacher Management</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm21" checked>
                                <label class="form-check-label" for="perm21">Add Teachers</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm22" checked>
                                <label class="form-check-label" for="perm22">Assign Subjects</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm23" checked>
                                <label class="form-check-label" for="perm23">Manage Timetable</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm24" checked>
                                <label class="form-check-label" for="perm24">View Profiles</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <button class="btn btn-primary">
                        <i class="las la-save mr-2"></i> Save Permission Settings
                    </button>
                </div>
            </div>
        </div>

        <!-- System Information -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">System Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">System Name</th>
                                <td>School Management System</td>
                            </tr>
                            <tr>
                                <th>Version</th>
                                <td>v5.2.0</td>
                            </tr>
                            <tr>
                                <th>License Type</th>
                                <td>Enterprise Edition</td>
                            </tr>
                            <tr>
                                <th>License Expiry</th>
                                <td class="text-success">31 Dec 2025</td>
                            </tr>
                            <tr>
                                <th>PHP Version</th>
                                <td>8.2.12</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Laravel Version</th>
                                <td>10.10.0</td>
                            </tr>
                            <tr>
                                <th>Database</th>
                                <td>MySQL 8.0</td>
                            </tr>
                            <tr>
                                <th>Server OS</th>
                                <td>Ubuntu 22.04</td>
                            </tr>
                            <tr>
                                <th>Last Backup</th>
                                <td class="text-warning">24 Dec 2024 02:30 AM</td>
                            </tr>
                            <tr>
                                <th>Next Update</th>
                                <td class="text-info">15 Jan 2025</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="alert alert-warning mt-3">
                    <i class="las la-exclamation-triangle mr-2"></i>
                    <strong>Important:</strong> System updates and module installations should be performed during maintenance hours (12:00 AM - 4:00 AM) to avoid disruption.
                </div>
            </div>
        </div>
    </div>

    <!-- Install Module Modal -->
    <div class="modal fade" id="installModuleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Install New Module</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="installModuleForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Module Type</label>
                                    <select class="form-control">
                                        <option value="">Select Module Type</option>
                                        <option value="core">Core Module</option>
                                        <option value="standard">Standard Module</option>
                                        <option value="premium">Premium Module</option>
                                        <option value="addon">Add-on Module</option>
                                        <option value="plugin">Plugin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Module File</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="moduleFile">
                                        <label class="custom-file-label" for="moduleFile">Choose .zip file</label>
                                    </div>
                                    <small class="form-text text-muted">Upload module zip file (max 50MB)</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Module Name</label>
                                    <input type="text" class="form-control" placeholder="Enter module name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Version</label>
                                    <input type="text" class="form-control" placeholder="e.g., 1.0.0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Author</label>
                                    <input type="text" class="form-control" placeholder="Author name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Module description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="autoEnable" checked>
                                        <label class="custom-control-label" for="autoEnable">
                                            Enable after installation
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="createPermissions">
                                        <label class="custom-control-label" for="createPermissions">
                                            Create default permissions
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="installModule">
                        <i class="las la-download mr-2"></i> Install Module
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Module Settings Script -->
    <script>
        $(document).ready(function() {
            // File input label
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
            
            // Install module
            $('#installModule').click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Installing...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    $('#installModuleModal').modal('hide');
                    alert('Module installed successfully! Please check the modules list.');
                }, 2000);
            });
            
            // Enable/Disable module
            $('.btn-group .btn').on('click', function() {
                const btn = $(this);
                const card = btn.closest('.module-card');
                const statusSpan = card.find('.module-status');
                const statusText = card.find('.text-success, .text-danger');
                
                if (btn.text().includes('Enable')) {
                    statusSpan.removeClass('inactive').addClass('active');
                    statusText.removeClass('text-danger').addClass('text-success').text('Active');
                    btn.html('<i class="las la-toggle-on mr-1"></i> Disable').removeClass('btn-outline-success').addClass('btn-outline-warning');
                    alert('Module enabled successfully!');
                } else if (btn.text().includes('Disable')) {
                    statusSpan.removeClass('active').addClass('inactive');
                    statusText.removeClass('text-success').addClass('text-danger').text('Inactive');
                    btn.html('<i class="las la-toggle-off mr-1"></i> Enable').removeClass('btn-outline-warning').addClass('btn-outline-success');
                    alert('Module disabled successfully!');
                } else if (btn.text().includes('Settings')) {
                    alert('Opening module settings...');
                } else if (btn.text().includes('Permissions')) {
                    alert('Opening permission settings...');
                }
            });
            
            // Save permissions
            $('.btn-primary').last().click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Saving...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert('Permission settings saved successfully!');
                }, 1500);
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
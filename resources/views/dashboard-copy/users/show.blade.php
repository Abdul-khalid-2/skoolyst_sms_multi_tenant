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
                <h4 class="mb-3">User Details</h4>
                <p class="mb-0">View detailed information about user</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
                        <li class="breadcrumb-item active">User Details</li>
                    </ol>
                </nav>
            </div>
            <a href="#" class="btn btn-primary add-list">
                <i class="las la-arrow-left mr-3"></i>Back to Users
            </a>
        </div>

        <div class="row">
            <!-- User Profile Card -->
            <div class="col-lg-4">
                <!-- Profile Overview -->
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xxl mb-4">
                            <img src="https://ui-avatars.com/api/?name=Sarah+Smith&background=28a745&color=fff&size=150" 
                                 class="rounded-circle border" alt="Sarah Smith">
                        </div>
                        
                        <h4 class="mb-2">Sarah Smith</h4>
                        <p class="text-muted mb-3">
                            <i class="las la-briefcase mr-2"></i>School Administrator
                        </p>
                        
                        <div class="mb-4">
                            <span class="badge badge-success badge-pill p-2 px-3">Active</span>
                            <span class="badge badge-primary badge-pill p-2 px-3 ml-2">Verified</span>
                        </div>
                        
                        <div class="d-flex justify-content-center mb-3">
                            <a href="#" class="btn btn-primary btn-sm mx-1">
                                <i class="las la-envelope mr-1"></i> Message
                            </a>
                            <a href="#" class="btn btn-info btn-sm mx-1">
                                <i class="las la-edit mr-1"></i> Edit
                            </a>
                            <a href="#" class="btn btn-warning btn-sm mx-1">
                                <i class="las la-user-slash mr-1"></i> Deactivate
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Quick Statistics</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Member Since:</span>
                            <span class="font-weight-bold">20 Jan 2024</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Last Login:</span>
                            <span class="font-weight-bold">Yesterday, 14:30</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Login Count:</span>
                            <span class="font-weight-bold">47 times</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Account Age:</span>
                            <span class="font-weight-bold">15 days</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Details -->
            <div class="col-lg-8">
                <!-- Personal Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="las la-user mr-2"></i>Personal Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Full Name</label>
                                    <p class="form-control-static">Sarah Smith</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Email Address</label>
                                    <p class="form-control-static">sarah.smith@abc.edu.pk</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Phone Number</label>
                                    <p class="form-control-static">+92 300 7654321</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Date of Birth</label>
                                    <p class="form-control-static">15 March 1988</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Gender</label>
                                    <p class="form-control-static">Female</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nationality</label>
                                    <p class="form-control-static">Pakistani</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="font-weight-bold">Address</label>
                                    <p class="form-control-static">456 Garden Town, Lahore, Punjab, Pakistan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="las la-briefcase mr-2"></i>Professional Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Designation</label>
                                    <p class="form-control-static">School Administrator</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Employee ID</label>
                                    <p class="form-control-static">EMP-2024-002</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Department</label>
                                    <p class="form-control-static">Administration</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Joining Date</label>
                                    <p class="form-control-static">20 January 2024</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">School</label>
                                    <p class="form-control-static">ABC International School</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Branch</label>
                                    <p class="form-control-static">Main Campus</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="font-weight-bold">About</label>
                                    <p class="form-control-static">Experienced school administrator with 8 years in educational management. Specialized in operational efficiency and staff management.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account & Security -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="las la-shield-alt mr-2"></i>Account & Security
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Username</label>
                                    <p class="form-control-static">sarah.smith</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Account Type</label>
                                    <p class="form-control-static">Staff Account</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Email Verified</label>
                                    <p class="form-control-static">
                                        <span class="badge badge-success">Yes</span>
                                        <small class="text-muted ml-2">Verified on 21 Jan 2024</small>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Phone Verified</label>
                                    <p class="form-control-static">
                                        <span class="badge badge-success">Yes</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Two-Factor Auth</label>
                                    <p class="form-control-static">
                                        <span class="badge badge-danger">Disabled</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Last Password Change</label>
                                    <p class="form-control-static">25 Jan 2024</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="font-weight-bold">Assigned Roles</label>
                                    <div>
                                        <span class="badge badge-primary mr-2 p-2">School Administrator</span>
                                        <span class="badge badge-secondary mr-2 p-2">Report Viewer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="las la-history mr-2"></i>Recent Activity
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Logged into system</h6>
                                    <p class="text-muted small mb-0">Yesterday at 14:30 PM from IP: 192.168.1.100</p>
                                    <small class="text-muted">2 days ago</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Updated student record</h6>
                                    <p class="text-muted small mb-0">Modified Alex Miller's information</p>
                                    <small class="text-muted">3 days ago</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Generated fee report</h6>
                                    <p class="text-muted small mb-0">Monthly fee collection report for January 2024</p>
                                    <small class="text-muted">5 days ago</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Added new teacher</h6>
                                    <p class="text-muted small mb-0">Created account for Michael Brown</p>
                                    <small class="text-muted">1 week ago</small>
                                </div>
                            </div>
                        </div>
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
    @endpush
</x-app-layout>
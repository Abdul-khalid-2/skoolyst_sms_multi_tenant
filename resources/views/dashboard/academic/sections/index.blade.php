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
                <h4 class="mb-3">Sections Setup</h4>
                <p class="mb-0">Manage parallel sections for each class (A, B, C, etc.)</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Academic</a></li>
                        <li class="breadcrumb-item active">Sections</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('sections.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-3"></i>Add Section
                </a>
            </div>
        </div>

        <!-- Feature Toggle Alert -->
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <h6><i class="las la-toggle-on mr-2"></i>Feature Status: Enabled</h6>
            <p class="mb-0">Sections feature is currently enabled. You can disable it from School Settings if not needed.</p>
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Search Section</label>
                            <input type="text" class="form-control" placeholder="Search section name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Class</label>
                            <select class="form-control">
                                <option value="">All Classes</option>
                                <option value="playgroup">Play Group</option>
                                <option value="nursery">Nursery</option>
                                <option value="kg">Kindergarten</option>
                                <option value="class1" selected>Class 1</option>
                                <option value="class2">Class 2</option>
                                <option value="class3">Class 3</option>
                                <option value="class4">Class 4</option>
                                <option value="class5">Class 5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Academic Year</label>
                            <select class="form-control">
                                <option value="">All Years</option>
                                <option value="2024-2025" selected>2024-2025</option>
                                <option value="2023-2024">2023-2024</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group w-100">
                            <button class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Class-wise Sections -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Sections by Class - Academic Year: 2024-2025</h5>
            </div>
            <div class="card-body">
                <!-- Class 1 Sections -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="las la-chalkboard mr-2"></i>
                            Class 1 Sections
                            <span class="badge badge-primary ml-2">4 Sections</span>
                            <span class="badge badge-info ml-2">80 Students</span>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Section A -->
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 border-primary">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1">Section A</h5>
                                                <p class="text-muted mb-0">Class 1 - Morning Shift</p>
                                            </div>
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Capacity:</span>
                                                <span class="font-weight-bold">25 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Current:</span>
                                                <span class="font-weight-bold">20 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Remaining:</span>
                                                <span class="font-weight-bold text-success">5 Seats</span>
                                            </div>
                                        </div>
                                        
                                        <div class="progress mb-3" style="height: 10px;">
                                            <div class="progress-bar bg-success" style="width: 80%"></div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <div class="btn-group w-100">
                                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <a href="#" class="btn btn-sm btn-outline-warning">Deactivate</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section B -->
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 border-primary">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1">Section B</h5>
                                                <p class="text-muted mb-0">Class 1 - Morning Shift</p>
                                            </div>
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Capacity:</span>
                                                <span class="font-weight-bold">25 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Current:</span>
                                                <span class="font-weight-bold">25 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Remaining:</span>
                                                <span class="font-weight-bold text-danger">Full</span>
                                            </div>
                                        </div>
                                        
                                        <div class="progress mb-3" style="height: 10px;">
                                            <div class="progress-bar bg-danger" style="width: 100%"></div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <div class="btn-group w-100">
                                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <a href="#" class="btn btn-sm btn-outline-warning">Deactivate</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section C -->
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 border-primary">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1">Section C</h5>
                                                <p class="text-muted mb-0">Class 1 - Morning Shift</p>
                                            </div>
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Capacity:</span>
                                                <span class="font-weight-bold">25 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Current:</span>
                                                <span class="font-weight-bold">18 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Remaining:</span>
                                                <span class="font-weight-bold text-success">7 Seats</span>
                                            </div>
                                        </div>
                                        
                                        <div class="progress mb-3" style="height: 10px;">
                                            <div class="progress-bar bg-success" style="width: 72%"></div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <div class="btn-group w-100">
                                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <a href="#" class="btn btn-sm btn-outline-warning">Deactivate</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section D -->
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 border-primary">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1">Section D</h5>
                                                <p class="text-muted mb-0">Class 1 - Evening Shift</p>
                                            </div>
                                            <span class="badge badge-warning">Inactive</span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Capacity:</span>
                                                <span class="font-weight-bold">25 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Current:</span>
                                                <span class="font-weight-bold">17 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Remaining:</span>
                                                <span class="font-weight-bold text-success">8 Seats</span>
                                            </div>
                                        </div>
                                        
                                        <div class="progress mb-3" style="height: 10px;">
                                            <div class="progress-bar bg-warning" style="width: 68%"></div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <div class="btn-group w-100">
                                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <a href="#" class="btn btn-sm btn-outline-success">Activate</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Class 2 Sections -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="las la-chalkboard mr-2"></i>
                            Class 2 Sections
                            <span class="badge badge-primary ml-2">3 Sections</span>
                            <span class="badge badge-info ml-2">75 Students</span>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Section A -->
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 border-success">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1">Section A</h5>
                                                <p class="text-muted mb-0">Class 2 - Morning Shift</p>
                                            </div>
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Capacity:</span>
                                                <span class="font-weight-bold">30 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Current:</span>
                                                <span class="font-weight-bold">25 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Remaining:</span>
                                                <span class="font-weight-bold text-success">5 Seats</span>
                                            </div>
                                        </div>
                                        
                                        <div class="progress mb-3" style="height: 10px;">
                                            <div class="progress-bar bg-success" style="width: 83%"></div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <div class="btn-group w-100">
                                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <a href="#" class="btn btn-sm btn-outline-warning">Deactivate</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section B -->
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 border-success">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1">Section B</h5>
                                                <p class="text-muted mb-0">Class 2 - Morning Shift</p>
                                            </div>
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Capacity:</span>
                                                <span class="font-weight-bold">30 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Current:</span>
                                                <span class="font-weight-bold">30 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Remaining:</span>
                                                <span class="font-weight-bold text-danger">Full</span>
                                            </div>
                                        </div>
                                        
                                        <div class="progress mb-3" style="height: 10px;">
                                            <div class="progress-bar bg-danger" style="width: 100%"></div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <div class="btn-group w-100">
                                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <a href="#" class="btn btn-sm btn-outline-warning">Deactivate</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section C -->
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 border-success">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1">Section C</h5>
                                                <p class="text-muted mb-0">Class 2 - Evening Shift</p>
                                            </div>
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Capacity:</span>
                                                <span class="font-weight-bold">30 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Current:</span>
                                                <span class="font-weight-bold">20 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Remaining:</span>
                                                <span class="font-weight-bold text-success">10 Seats</span>
                                            </div>
                                        </div>
                                        
                                        <div class="progress mb-3" style="height: 10px;">
                                            <div class="progress-bar bg-success" style="width: 67%"></div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <div class="btn-group w-100">
                                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <a href="#" class="btn btn-sm btn-outline-warning">Deactivate</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kindergarten Sections -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="las la-chalkboard mr-2"></i>
                            Kindergarten (KG) Sections
                            <span class="badge badge-primary ml-2">5 Sections</span>
                            <span class="badge badge-info ml-2">75 Students</span>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Red Group -->
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="card h-100 border-danger">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1">Red Group</h5>
                                                <p class="text-muted mb-0">KG - Color Groups</p>
                                            </div>
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Capacity:</span>
                                                <span class="font-weight-bold">15 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Current:</span>
                                                <span class="font-weight-bold">15 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Remaining:</span>
                                                <span class="font-weight-bold text-danger">Full</span>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <div class="btn-group w-100">
                                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Blue Group -->
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="card h-100 border-primary">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1">Blue Group</h5>
                                                <p class="text-muted mb-0">KG - Color Groups</p>
                                            </div>
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Capacity:</span>
                                                <span class="font-weight-bold">15 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Current:</span>
                                                <span class="font-weight-bold">15 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Remaining:</span>
                                                <span class="font-weight-bold text-danger">Full</span>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <div class="btn-group w-100">
                                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Green Group -->
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="card h-100 border-success">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1">Green Group</h5>
                                                <p class="text-muted mb-0">KG - Color Groups</p>
                                            </div>
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Capacity:</span>
                                                <span class="font-weight-bold">15 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Current:</span>
                                                <span class="font-weight-bold">15 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Remaining:</span>
                                                <span class="font-weight-bold text-danger">Full</span>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <div class="btn-group w-100">
                                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Yellow Group -->
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="card h-100 border-warning">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1">Yellow Group</h5>
                                                <p class="text-muted mb-0">KG - Color Groups</p>
                                            </div>
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Capacity:</span>
                                                <span class="font-weight-bold">15 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Current:</span>
                                                <span class="font-weight-bold">15 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Remaining:</span>
                                                <span class="font-weight-bold text-danger">Full</span>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <div class="btn-group w-100">
                                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Purple Group -->
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="card h-100" style="border-color: #6f42c1;">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1">Purple Group</h5>
                                                <p class="text-muted mb-0">KG - Color Groups</p>
                                            </div>
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Capacity:</span>
                                                <span class="font-weight-bold">15 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Current:</span>
                                                <span class="font-weight-bold">15 Students</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Remaining:</span>
                                                <span class="font-weight-bold text-danger">Full</span>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <div class="btn-group w-100">
                                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State Example -->
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="las la-layer-group fa-4x text-muted mb-3"></i>
                <h5>No Sections Found for Selected Class</h5>
                <p class="text-muted">Select a different class or add sections to this class</p>
                <a href="{{ route('sections.create') }}" class="btn btn-primary">
                    <i class="las la-plus mr-2"></i> Add New Section
                </a>
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
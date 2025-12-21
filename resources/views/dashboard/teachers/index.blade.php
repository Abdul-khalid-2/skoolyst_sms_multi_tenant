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
                <h4 class="mb-3">Teacher Management</h4>
                <p class="mb-0">Manage all teacher records, profiles, and assignments</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Teachers</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('teachers.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-3"></i>Add New Teacher
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Search Teacher</label>
                            <input type="text" class="form-control" placeholder="Name, Employee ID, Subject">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Department</label>
                            <select class="form-control">
                                <option value="">All Departments</option>
                                <option value="science">Science</option>
                                <option value="arts">Arts</option>
                                <option value="commerce">Commerce</option>
                                <option value="computer">Computer Science</option>
                                <option value="mathematics">Mathematics</option>
                                <option value="english">English</option>
                                <option value="urdu">Urdu</option>
                                <option value="islamiat">Islamiat</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="on-leave">On Leave</option>
                                <option value="probation">Probation</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Designation</label>
                            <select class="form-control">
                                <option value="">All Designations</option>
                                <option value="principal">Principal</option>
                                <option value="vice-principal">Vice Principal</option>
                                <option value="senior-teacher">Senior Teacher</option>
                                <option value="teacher">Teacher</option>
                                <option value="assistant-teacher">Assistant Teacher</option>
                                <option value="trainee">Trainee Teacher</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group w-100">
                            <button class="btn btn-primary btn-block">Search</button>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary active">All Teachers</button>
                            <button type="button" class="btn btn-outline-primary">Class Teachers</button>
                            <button type="button" class="btn btn-outline-primary">Subject Teachers</button>
                            <button type="button" class="btn btn-outline-primary">On Leave</button>
                            <button type="button" class="btn btn-outline-primary">Probation</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teacher Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Teachers</h6>
                                <h2 class="mb-0 text-white">45</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-chalkboard-teacher fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">Active Teachers</h6>
                                <h2 class="mb-0 text-white">42</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-user-check fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">Class Teachers</h6>
                                <h2 class="mb-0 text-white">15</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-users fa-2x text-info"></i>
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
                                <h6 class="text-white mb-0">On Leave</h6>
                                <h2 class="mb-0 text-white">3</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-umbrella-beach fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teachers Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">All Teachers</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Teacher</th>
                                <th>Employee ID</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Subjects</th>
                                <th>Class Teacher</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Teacher 1 -->
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Sarah+Smith&background=007bff&color=fff" 
                                                 class="rounded-circle" alt="Sarah Smith">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Ms. Sarah Smith</h6>
                                            <small class="text-muted">Joined: 15 Jan 2020</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>TEA-001</strong>
                                    <div><small class="text-muted">EMP ID</small></div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">Senior Teacher</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">English</span>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge badge-light">English</span>
                                        <span class="badge badge-light">Literature</span>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge badge-success">Class 1-A</span>
                                        <div><small>Since 2024</small></div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <small>+92 300 1234567</small>
                                        <div><small>sarah@example.com</small></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <div><small>4 Years Experience</small></div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('teachers.show', 1) }}" class="btn btn-sm btn-info mr-2" title="View Profile">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('teachers.edit', 1) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Assign Subjects">
                                            <i class="las la-book"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                    data-toggle="dropdown" title="More">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"><i class="las la-calendar mr-2"></i> Time Table</a>
                                                <a class="dropdown-item" href="#"><i class="las la-money-bill mr-2"></i> Salary</a>
                                                <a class="dropdown-item" href="#"><i class="las la-file-alt mr-2"></i> Documents</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#"><i class="las la-trash mr-2"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Teacher 2 -->
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Ali+Khan&background=28a745&color=fff" 
                                                 class="rounded-circle" alt="Ali Khan">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Mr. Ali Khan</h6>
                                            <small class="text-muted">Joined: 10 Mar 2018</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>TEA-002</strong>
                                    <div><small class="text-muted">EMP ID</small></div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">Vice Principal</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">Science</span>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge badge-light">Physics</span>
                                        <span class="badge badge-light">Chemistry</span>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge badge-success">Class 9-A</span>
                                        <div><small>Since 2023</small></div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <small>+92 300 2345678</small>
                                        <div><small>ali@example.com</small></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <div><small>6 Years Experience</small></div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('teachers.show', 2) }}" class="btn btn-sm btn-info mr-2" title="View Profile">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('teachers.edit', 2) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Assign Subjects">
                                            <i class="las la-book"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                    data-toggle="dropdown" title="More">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"><i class="las la-calendar mr-2"></i> Time Table</a>
                                                <a class="dropdown-item" href="#"><i class="las la-money-bill mr-2"></i> Salary</a>
                                                <a class="dropdown-item" href="#"><i class="las la-file-alt mr-2"></i> Documents</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#"><i class="las la-trash mr-2"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Teacher 3 -->
                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Fatima+Ahmed&background=ffc107&color=000" 
                                                 class="rounded-circle" alt="Fatima Ahmed">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Ms. Fatima Ahmed</h6>
                                            <small class="text-muted">Joined: 05 Sep 2022</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>TEA-003</strong>
                                    <div><small class="text-muted">EMP ID</small></div>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">Teacher</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">Mathematics</span>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge badge-light">Mathematics</span>
                                        <span class="badge badge-light">Statistics</span>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge badge-success">Class 5-B</span>
                                        <div><small>Since 2023</small></div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <small>+92 300 3456789</small>
                                        <div><small>fatima@example.com</small></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <div><small>2 Years Experience</small></div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('teachers.show', 3) }}" class="btn btn-sm btn-info mr-2" title="View Profile">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('teachers.edit', 3) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Assign Subjects">
                                            <i class="las la-book"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                    data-toggle="dropdown" title="More">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"><i class="las la-calendar mr-2"></i> Time Table</a>
                                                <a class="dropdown-item" href="#"><i class="las la-money-bill mr-2"></i> Salary</a>
                                                <a class="dropdown-item" href="#"><i class="las la-file-alt mr-2"></i> Documents</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#"><i class="las la-trash mr-2"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Teacher 4 (On Leave) -->
                            <tr>
                                <td>4</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Zainab+Malik&background=17a2b8&color=fff" 
                                                 class="rounded-circle" alt="Zainab Malik">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Ms. Zainab Malik</h6>
                                            <small class="text-muted">Joined: 20 Jun 2021</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>TEA-004</strong>
                                    <div><small class="text-muted">EMP ID</small></div>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">Teacher</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">Urdu</span>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge badge-light">Urdu</span>
                                        <span class="badge badge-light">Islamic Studies</span>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge badge-secondary">Class 3-C</span>
                                        <div><small>Till 15 Jun 2024</small></div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <small>+92 300 4567890</small>
                                        <div><small>zainab@example.com</small></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-warning">On Leave</span>
                                    <div><small>Returns: 15 Aug 2024</small></div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('teachers.show', 4) }}" class="btn btn-sm btn-info mr-2" title="View Profile">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('teachers.edit', 4) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-secondary mr-2" title="Leave Details">
                                            <i class="las la-umbrella-beach"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                    data-toggle="dropdown" title="More">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"><i class="las la-calendar mr-2"></i> Time Table</a>
                                                <a class="dropdown-item" href="#"><i class="las la-money-bill mr-2"></i> Salary</a>
                                                <a class="dropdown-item" href="#"><i class="las la-file-alt mr-2"></i> Documents</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#"><i class="las la-trash mr-2"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Teacher 5 (Probation) -->
                            <tr class="table-warning">
                                <td>5</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Bilal+Hussain&background=6c757d&color=fff" 
                                                 class="rounded-circle" alt="Bilal Hussain">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Mr. Bilal Hussain</h6>
                                            <small class="text-muted">Joined: 01 Jan 2024</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>TEA-005</strong>
                                    <div><small class="text-muted">EMP ID</small></div>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">Trainee</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">Computer Science</span>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge badge-light">Computer</span>
                                        <span class="badge badge-light">ICT</span>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge badge-light">Not Assigned</span>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <small>+92 300 5678901</small>
                                        <div><small>bilal@example.com</small></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">Probation</span>
                                    <div><small>Ends: 30 Jun 2024</small></div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('teachers.show', 5) }}" class="btn btn-sm btn-info mr-2" title="View Profile">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('teachers.edit', 5) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success mr-2" title="Complete Probation">
                                            <i class="las la-check-circle"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                    data-toggle="dropdown" title="More">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"><i class="las la-calendar mr-2"></i> Time Table</a>
                                                <a class="dropdown-item" href="#"><i class="las la-money-bill mr-2"></i> Salary</a>
                                                <a class="dropdown-item" href="#"><i class="las la-file-alt mr-2"></i> Documents</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#"><i class="las la-trash mr-2"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mt-4">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Quick Actions Card -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 mb-3">
                                <a href="{{ route('teachers.create') }}" class="btn btn-primary btn-block">
                                    <i class="las la-user-plus mr-2"></i> Add Teacher
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <a href="#" class="btn btn-success btn-block">
                                    <i class="las la-file-import mr-2"></i> Bulk Import
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <a href="#" class="btn btn-info btn-block">
                                    <i class="las la-file-export mr-2"></i> Export List
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <a href="#" class="btn btn-warning btn-block">
                                    <i class="las la-calendar-alt mr-2"></i> Assign Classes
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <a href="#" class="btn btn-secondary btn-block">
                                    <i class="las la-book mr-2"></i> Subject Allocation
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <a href="#" class="btn btn-dark btn-block">
                                    <i class="las la-id-card mr-2"></i> Generate ID Cards
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <a href="#" class="btn btn-danger btn-block">
                                    <i class="las la-calendar-check mr-2"></i> Leave Management
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <a href="#" class="btn btn-success btn-block">
                                    <i class="las la-money-bill-wave mr-2"></i> Salary Slips
                                </a>
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
    
    <!-- Tooltip Initialization -->
    <script>
        $(function () {
            $('[title]').tooltip();
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
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
                <h4 class="mb-3">Student Management</h4>
                <p class="mb-0">Manage all student records, admissions and profiles</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('students.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-3"></i>Register New Student
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Search Student</label>
                            <input type="text" class="form-control" placeholder="Name, Roll No, Admission No">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Class</label>
                            <select class="form-control">
                                <option value="">All Classes</option>
                                <option value="playgroup">Play Group</option>
                                <option value="nursery">Nursery</option>
                                <option value="kg">Kindergarten</option>
                                <option value="class1">Class 1</option>
                                <option value="class2">Class 2</option>
                                <option value="class3">Class 3</option>
                                <option value="class4">Class 4</option>
                                <option value="class5">Class 5</option>
                                <option value="class6">Class 6</option>
                                <option value="class7">Class 7</option>
                                <option value="class8">Class 8</option>
                                <option value="class9">Class 9</option>
                                <option value="class10">Class 10</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Section</label>
                            <select class="form-control">
                                <option value="">All Sections</option>
                                <option value="A">Section A</option>
                                <option value="B">Section B</option>
                                <option value="C">Section C</option>
                                <option value="D">Section D</option>
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
                                <option value="alumni">Alumni</option>
                                <option value="transferred">Transferred</option>
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
                            <button type="button" class="btn btn-outline-primary active">All Students</button>
                            <button type="button" class="btn btn-outline-primary">New Admissions</button>
                            <button type="button" class="btn btn-outline-primary">Fee Defaulters</button>
                            <button type="button" class="btn btn-outline-primary">Birthdays</button>
                            <button type="button" class="btn btn-outline-primary">Today's Absent</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Students</h6>
                                <h2 class="mb-0 text-white">500</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-user-graduate fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">Active Students</h6>
                                <h2 class="mb-0 text-white">485</h2>
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
                                <h6 class="text-white mb-0">New This Month</h6>
                                <h2 class="mb-0 text-white">25</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-user-plus fa-2x text-info"></i>
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
                                <h6 class="text-white mb-0">Fee Defaulters</h6>
                                <h2 class="mb-0 text-white">15</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-exclamation-triangle fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">All Students - Class 1 (Section A)</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Admission No</th>
                                <th>Roll No</th>
                                <th>Class/Section</th>
                                <th>Gender</th>
                                <th>Guardian</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Student 1 -->
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Alex+Johnson&background=007bff&color=fff" 
                                                 class="rounded-circle" alt="Alex Johnson">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Alex Johnson</h6>
                                            <small class="text-muted">DOB: 15 Mar 2016</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>ADM-2024-001</strong>
                                    <div><small class="text-muted">01 Apr 2024</small></div>
                                </td>
                                <td><span class="badge badge-primary">1-A-01</span></td>
                                <td>
                                    <span class="badge badge-info">Class 1</span>
                                    <span class="badge badge-secondary">Section A</span>
                                </td>
                                <td><span class="badge badge-primary">Male</span></td>
                                <td>
                                    <div>
                                        <strong>Mr. Robert Johnson</strong>
                                        <div><small>Father</small></div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <small>+92 300 1234567</small>
                                        <div><small>alex@example.com</small></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <div><small>Fee: Paid</small></div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('students.show', 1) }}" class="btn btn-sm btn-info mr-2" title="View Profile">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Fee">
                                            <i class="las la-money-bill"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-secondary" title="More">
                                            <i class="las la-ellipsis-v"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Student 2 -->
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Sofia+Williams&background=28a745&color=fff" 
                                                 class="rounded-circle" alt="Sofia Williams">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Sofia Williams</h6>
                                            <small class="text-muted">DOB: 22 Jul 2016</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>ADM-2024-002</strong>
                                    <div><small class="text-muted">05 Apr 2024</small></div>
                                </td>
                                <td><span class="badge badge-primary">1-A-02</span></td>
                                <td>
                                    <span class="badge badge-info">Class 1</span>
                                    <span class="badge badge-secondary">Section A</span>
                                </td>
                                <td><span class="badge badge-danger">Female</span></td>
                                <td>
                                    <div>
                                        <strong>Ms. Emma Williams</strong>
                                        <div><small>Mother</small></div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <small>+92 300 2345678</small>
                                        <div><small>sofia@example.com</small></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <div><small>Fee: Paid</small></div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('students.show', 1) }}" class="btn btn-sm btn-info mr-2" title="View Profile">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Fee">
                                            <i class="las la-money-bill"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-secondary" title="More">
                                            <i class="las la-ellipsis-v"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Student 3 -->
                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Ethan+Brown&background=ffc107&color=000" 
                                                 class="rounded-circle" alt="Ethan Brown">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Ethan Brown</h6>
                                            <small class="text-muted">DOB: 10 Nov 2016</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>ADM-2024-003</strong>
                                    <div><small class="text-muted">10 Apr 2024</small></div>
                                </td>
                                <td><span class="badge badge-primary">1-A-03</span></td>
                                <td>
                                    <span class="badge badge-info">Class 1</span>
                                    <span class="badge badge-secondary">Section A</span>
                                </td>
                                <td><span class="badge badge-primary">Male</span></td>
                                <td>
                                    <div>
                                        <strong>Mr. David Brown</strong>
                                        <div><small>Father</small></div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <small>+92 300 3456789</small>
                                        <div><small>ethan@example.com</small></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <div><small>Fee: Due</small></div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('students.show', 1) }}" class="btn btn-sm btn-info mr-2" title="View Profile">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger mr-2" title="Fee Due">
                                            <i class="las la-exclamation-circle"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-secondary" title="More">
                                            <i class="las la-ellipsis-v"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Student 4 -->
                            <tr>
                                <td>4</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Mia+Davis&background=dc3545&color=fff" 
                                                 class="rounded-circle" alt="Mia Davis">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Mia Davis</h6>
                                            <small class="text-muted">DOB: 05 Jan 2017</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>ADM-2024-004</strong>
                                    <div><small class="text-muted">15 Apr 2024</small></div>
                                </td>
                                <td><span class="badge badge-primary">1-A-04</span></td>
                                <td>
                                    <span class="badge badge-info">Class 1</span>
                                    <span class="badge badge-secondary">Section A</span>
                                </td>
                                <td><span class="badge badge-danger">Female</span></td>
                                <td>
                                    <div>
                                        <strong>Ms. Sarah Davis</strong>
                                        <div><small>Mother</small></div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <small>+92 300 4567890</small>
                                        <div><small>mia@example.com</small></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <div><small>Fee: Paid</small></div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('students.show', 1) }}" class="btn btn-sm btn-info mr-2" title="View Profile">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Fee">
                                            <i class="las la-money-bill"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-secondary" title="More">
                                            <i class="las la-ellipsis-v"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Student 5 (Inactive) -->
                            <tr>
                                <td>5</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Noah+Miller&background=6c757d&color=fff" 
                                                 class="rounded-circle" alt="Noah Miller">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Noah Miller</h6>
                                            <small class="text-muted">DOB: 20 Feb 2016</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>ADM-2024-005</strong>
                                    <div><small class="text-muted">20 Apr 2024</small></div>
                                </td>
                                <td><span class="badge badge-primary">1-A-05</span></td>
                                <td>
                                    <span class="badge badge-info">Class 1</span>
                                    <span class="badge badge-secondary">Section A</span>
                                </td>
                                <td><span class="badge badge-primary">Male</span></td>
                                <td>
                                    <div>
                                        <strong>Mr. James Miller</strong>
                                        <div><small>Father</small></div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <small>+92 300 5678901</small>
                                        <div><small>noah@example.com</small></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-danger">Transferred</span>
                                    <div><small>01 Jun 2024</small></div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('students.show', 1) }}" class="btn btn-sm btn-info mr-2" title="View Profile">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success mr-2" title="Reactivate">
                                            <i class="las la-user-check"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-secondary" title="More">
                                            <i class="las la-ellipsis-v"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Student 6 (New Admission) -->
                            <tr class="table-info">
                                <td>6</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Olivia+Wilson&background=17a2b8&color=fff" 
                                                 class="rounded-circle" alt="Olivia Wilson">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Olivia Wilson</h6>
                                            <small class="text-muted">DOB: 12 May 2017</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>ADM-2024-006</strong>
                                    <div><small class="text-muted">Today</small></div>
                                </td>
                                <td><span class="badge badge-primary">1-A-06</span></td>
                                <td>
                                    <span class="badge badge-info">Class 1</span>
                                    <span class="badge badge-secondary">Section A</span>
                                </td>
                                <td><span class="badge badge-danger">Female</span></td>
                                <td>
                                    <div>
                                        <strong>Mr. Michael Wilson</strong>
                                        <div><small>Father</small></div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <small>+92 300 6789012</small>
                                        <div><small>olivia@example.com</small></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Pending</span>
                                    <div><small>Fee: Unpaid</small></div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('students.show', 1) }}" class="btn btn-sm btn-info mr-2" title="View Profile">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success mr-2" title="Approve">
                                            <i class="las la-check-circle"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-secondary" title="More">
                                            <i class="las la-ellipsis-v"></i>
                                        </a>
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
                                <a href="#" class="btn btn-primary btn-block">
                                    <i class="las la-user-plus mr-2"></i> New Admission
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
                                    <i class="las la-print mr-2"></i> Print ID Cards
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
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <!-- Tooltip Initialization -->
    <script>
        $(function () {
            $('[title]').tooltip();
        });
    </script>
    @endpush
</x-app-layout>
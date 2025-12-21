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
                <h4 class="mb-3">User Management</h4>
                <p class="mb-0">Manage system users, their roles and access permissions</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('users.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-3"></i>Add New User
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Search User</label>
                            <input type="text" class="form-control" placeholder="Name, Email or Phone">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control">
                                <option value="">All Roles</option>
                                <option value="super_admin">Super Admin</option>
                                <option value="school_admin">School Admin</option>
                                <option value="teacher">Teacher</option>
                                <option value="accountant">Accountant</option>
                                <option value="parent">Parent</option>
                                <option value="student">Student</option>
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
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>School</label>
                            <select class="form-control">
                                <option value="">All Schools</option>
                                <option value="1">ABC International School</option>
                                <option value="2">City Grammar School</option>
                                <option value="3">Global Academy</option>
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

        <!-- User Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Users</h6>
                                <h2 class="mb-0 text-white">723</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-users fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">Active Users</h6>
                                <h2 class="mb-0 text-white">698</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-user-check fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">Teachers</h6>
                                <h2 class="mb-0 text-white">45</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-chalkboard-teacher fa-2x text-warning"></i>
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
                                <h6 class="text-white mb-0">Students</h6>
                                <h2 class="mb-0 text-white">500</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-user-graduate fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>School</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Super Admin -->
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=John+Doe&background=007bff&color=fff" 
                                                 class="rounded-circle" alt="John Doe">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">John Doe</h6>
                                            <small>Super Administrator</small>
                                        </div>
                                    </div>
                                </td>
                                <td>john.doe@example.com</td>
                                <td>+92 300 1234567</td>
                                <td><span class="badge badge-danger">Super Admin</span></td>
                                <td>All Schools</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>2 hours ago</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('users.show', 1) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', 1) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Deactivate">
                                            <i class="las la-user-slash"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- School Admin -->
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Sarah+Smith&background=28a745&color=fff" 
                                                 class="rounded-circle" alt="Sarah Smith">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Sarah Smith</h6>
                                            <small>School Administrator</small>
                                        </div>
                                    </div>
                                </td>
                                <td>sarah.smith@abc.edu.pk</td>
                                <td>+92 300 7654321</td>
                                <td><span class="badge badge-primary">School Admin</span></td>
                                <td>ABC International School</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>Yesterday, 14:30</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('users.show', 2) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', 2) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Deactivate">
                                            <i class="las la-user-slash"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Teacher -->
                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Michael+Brown&background=ffc107&color=000" 
                                                 class="rounded-circle" alt="Michael Brown">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Michael Brown</h6>
                                            <small>Mathematics Teacher</small>
                                        </div>
                                    </div>
                                </td>
                                <td>michael.brown@abc.edu.pk</td>
                                <td>+92 300 9876543</td>
                                <td><span class="badge badge-warning">Teacher</span></td>
                                <td>ABC International School</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>Today, 08:45</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('users.show', 3) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', 3) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Deactivate">
                                            <i class="las la-user-slash"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Accountant -->
                            <tr>
                                <td>4</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=David+Wilson&background=17a2b8&color=fff" 
                                                 class="rounded-circle" alt="David Wilson">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">David Wilson</h6>
                                            <small>Accountant</small>
                                        </div>
                                    </div>
                                </td>
                                <td>david.wilson@abc.edu.pk</td>
                                <td>+92 300 4567890</td>
                                <td><span class="badge badge-info">Accountant</span></td>
                                <td>ABC International School</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>Today, 10:15</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('users.show', 4) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', 4) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Deactivate">
                                            <i class="las la-user-slash"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Parent -->
                            <tr>
                                <td>5</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Emma+Johnson&background=6f42c1&color=fff" 
                                                 class="rounded-circle" alt="Emma Johnson">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Emma Johnson</h6>
                                            <small>Parent</small>
                                        </div>
                                    </div>
                                </td>
                                <td>emma.johnson@example.com</td>
                                <td>+92 300 2345678</td>
                                <td><span class="badge badge-secondary">Parent</span></td>
                                <td>ABC International School</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>1 week ago</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('users.show', 5) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', 5) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Deactivate">
                                            <i class="las la-user-slash"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Student -->
                            <tr>
                                <td>6</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Alex+Miller&background=20c997&color=fff" 
                                                 class="rounded-circle" alt="Alex Miller">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Alex Miller</h6>
                                            <small>Grade 10 Student</small>
                                        </div>
                                    </div>
                                </td>
                                <td>alex.miller@abc.edu.pk</td>
                                <td>+92 300 3456789</td>
                                <td><span class="badge badge-success">Student</span></td>
                                <td>ABC International School</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>2 days ago</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('users.show', 6) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', 6) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Deactivate">
                                            <i class="las la-user-slash"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Inactive User -->
                            <tr>
                                <td>7</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Robert+Taylor&background=dc3545&color=fff" 
                                                 class="rounded-circle" alt="Robert Taylor">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Robert Taylor</h6>
                                            <small>Physics Teacher</small>
                                        </div>
                                    </div>
                                </td>
                                <td>robert.taylor@abc.edu.pk</td>
                                <td>+92 300 5678901</td>
                                <td><span class="badge badge-warning">Teacher</span></td>
                                <td>City Grammar School</td>
                                <td><span class="badge badge-danger">Inactive</span></td>
                                <td>1 month ago</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('users.show', 7) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', 7) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success mr-2" title="Activate">
                                            <i class="las la-user-check"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
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
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
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
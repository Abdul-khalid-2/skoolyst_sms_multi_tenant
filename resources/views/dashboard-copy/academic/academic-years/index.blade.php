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
                <h4 class="mb-3">Academic Years</h4>
                <p class="mb-0">Manage academic years to organize data year-wise</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Academic</a></li>
                        <li class="breadcrumb-item active">Academic Years</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('academic-years.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-3"></i>Add Academic Year
                </a>
            </div>
        </div>

        <!-- Warning Alert -->
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <h6><i class="las la-exclamation-triangle mr-2"></i>Important Rule</h6>
            <p class="mb-0">Only one academic year can be active at a time. Changing the active year will affect all operations.</p>
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Search Year</label>
                            <input type="text" class="form-control" placeholder="Search by year name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-group w-100">
                            <button class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Year Highlight -->
        <div class="alert alert-success mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1"><i class="las la-star mr-2"></i>Currently Active Academic Year</h5>
                    <p class="mb-0">2024-2025 (01 April 2024 - 31 March 2025)</p>
                </div>
                <span class="badge badge-success badge-pill p-2">Active</span>
            </div>
        </div>

        <!-- Academic Years Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Year Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Total Classes</th>
                                <th>Total Students</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Active Year -->
                            <tr class="table-success">
                                <td>1</td>
                                <td>
                                    <strong>2024-2025</strong>
                                    <div><small class="text-muted">Current Academic Session</small></div>
                                </td>
                                <td>01 April 2024</td>
                                <td>31 March 2025</td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <div><small>Since: 01 Apr 2024</small></div>
                                </td>
                                <td><span class="badge badge-info">15 Classes</span></td>
                                <td><span class="badge badge-info">500 Students</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-secondary mr-2" title="Already Active" disabled>
                                            <i class="las la-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Archive" data-toggle="modal" data-target="#archiveModal">
                                            <i class="las la-archive"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Previous Years -->
                            <tr>
                                <td>2</td>
                                <td>2023-2024</td>
                                <td>01 April 2023</td>
                                <td>31 March 2024</td>
                                <td><span class="badge badge-secondary">Archived</span></td>
                                <td><span class="badge badge-info">14 Classes</span></td>
                                <td><span class="badge badge-info">480 Students</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-success mr-2" title="Set Active" data-toggle="modal" data-target="#activateModal">
                                            <i class="las la-toggle-on"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning" title="Archive" disabled>
                                            <i class="las la-archive"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>2022-2023</td>
                                <td>01 April 2022</td>
                                <td>31 March 2023</td>
                                <td><span class="badge badge-secondary">Archived</span></td>
                                <td><span class="badge badge-info">13 Classes</span></td>
                                <td><span class="badge badge-info">450 Students</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-success mr-2" title="Set Active" data-toggle="modal" data-target="#activateModal">
                                            <i class="las la-toggle-on"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning" title="Archive" disabled>
                                            <i class="las la-archive"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>2021-2022</td>
                                <td>01 April 2021</td>
                                <td>31 March 2022</td>
                                <td><span class="badge badge-secondary">Archived</span></td>
                                <td><span class="badge badge-info">12 Classes</span></td>
                                <td><span class="badge badge-info">420 Students</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-success mr-2" title="Set Active" data-toggle="modal" data-target="#activateModal">
                                            <i class="las la-toggle-on"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning" title="Archive" disabled>
                                            <i class="las la-archive"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Future Year -->
                            <tr class="table-info">
                                <td>5</td>
                                <td>
                                    <strong>2025-2026</strong>
                                    <div><small class="text-muted">Upcoming Year</small></div>
                                </td>
                                <td>01 April 2025</td>
                                <td>31 March 2026</td>
                                <td><span class="badge badge-warning">Inactive</span></td>
                                <td><span class="badge badge-secondary">0 Classes</span></td>
                                <td><span class="badge badge-secondary">0 Students</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-success mr-2" title="Set Active" data-toggle="modal" data-target="#activateModal">
                                            <i class="las la-toggle-on"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete" data-toggle="modal" data-target="#deleteModal">
                                            <i class="las la-trash"></i>
                                        </button>
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
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Activation Confirmation Modal -->
    <div class="modal fade" id="activateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning">
                        <i class="las la-exclamation-triangle mr-2"></i>Change Active Academic Year
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <h6><i class="las la-exclamation-circle mr-2"></i>Important Warning</h6>
                        <p class="mb-0">Changing the active academic year will affect:</p>
                        <ul class="mb-0 mt-2">
                            <li>Current fee collection will be paused</li>
                            <li>Attendance tracking will reset</li>
                            <li>Exam schedules will change</li>
                            <li>Students will be promoted to next year</li>
                        </ul>
                    </div>
                    <p>Are you sure you want to set <strong>2023-2024</strong> as active academic year?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning">Yes, Change Active Year</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Archive Confirmation Modal -->
    <div class="modal fade" id="archiveModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Archive Academic Year</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to archive <strong>2024-2025</strong>?</p>
                    <div class="alert alert-info">
                        <h6><i class="las la-info-circle mr-2"></i>Note</h6>
                        <p class="mb-0">Archiving will keep all data but make the year read-only. You cannot archive the active year.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Archive Year</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">
                        <i class="las la-exclamation-triangle mr-2"></i>Delete Academic Year
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <h6><i class="las la-ban mr-2"></i>Warning: This action cannot be undone!</h6>
                        <p class="mb-0">You cannot delete an academic year if it contains:</p>
                        <ul class="mb-0 mt-2">
                            <li>Student records</li>
                            <li>Fee transactions</li>
                            <li>Exam results</li>
                            <li>Attendance records</li>
                        </ul>
                    </div>
                    <p>Are you sure you want to delete <strong>2025-2026</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete Year</button>
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
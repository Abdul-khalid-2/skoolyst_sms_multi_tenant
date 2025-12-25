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
                <h4 class="mb-3">Subjects Setup</h5>
                <p class="mb-0">Manage subjects and assign them to different classes</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Academic</a></li>
                        <li class="breadcrumb-item active">Subjects</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('subjects.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-3"></i>Add Subject
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Search Subject</label>
                            <input type="text" class="form-control" placeholder="Search subject name or code">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Subject Type</label>
                            <select class="form-control">
                                <option value="">All Types</option>
                                <option value="theory">Theory</option>
                                <option value="practical">Practical</option>
                                <option value="both">Both</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Class</label>
                            <select class="form-control">
                                <option value="">All Classes</option>
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
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group w-100">
                            <button class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subject Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Subjects</h6>
                                <h2 class="mb-0 text-white">45</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-book-open fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">Theory Subjects</h6>
                                <h2 class="mb-0 text-white">35</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-book-reader fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">Practical Subjects</h6>
                                <h2 class="mb-0 text-white">10</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-flask fa-2x text-info"></i>
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
                                <h6 class="text-white mb-0">Active Classes</h6>
                                <h2 class="mb-0 text-white">15</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-chalkboard-teacher fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subjects Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">All Subjects</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject Name</th>
                                <th>Subject Code</th>
                                <th>Type</th>
                                <th>Classes Assigned</th>
                                <th>Total Students</th>
                                <th>Teachers</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Language Subjects -->
                            <tr class="table-light">
                                <td colspan="9"><strong>Language Subjects</strong></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>
                                    <strong>English Language</strong>
                                    <div><small class="text-muted">Core language subject</small></div>
                                </td>
                                <td><span class="badge badge-primary">ENG-101</span></td>
                                <td><span class="badge badge-success">Theory</span></td>
                                <td>
                                    <div class="mb-1">
                                        <span class="badge badge-info">Class 1-10</span>
                                    </div>
                                    <small class="text-muted">10 Classes</small>
                                </td>
                                <td><span class="badge badge-info">500 Students</span></td>
                                <td>
                                    <div class="d-flex flex-wrap">
                                        <span class="badge badge-secondary mr-1 mb-1">Ms. Sarah</span>
                                        <span class="badge badge-secondary mr-1 mb-1">Mr. John</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View Details">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-2" title="Deactivate" data-toggle="modal" data-target="#deactivateModal">
                                            <i class="las la-toggle-off"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete" disabled>
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <strong>Urdu Language</strong>
                                    <div><small class="text-muted">National language</small></div>
                                </td>
                                <td><span class="badge badge-primary">URD-102</span></td>
                                <td><span class="badge badge-success">Theory</span></td>
                                <td>
                                    <div class="mb-1">
                                        <span class="badge badge-info">Class 1-10</span>
                                    </div>
                                    <small class="text-muted">10 Classes</small>
                                </td>
                                <td><span class="badge badge-info">500 Students</span></td>
                                <td>
                                    <span class="badge badge-secondary">Mr. Ahmed</span>
                                </td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View Details">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-2" title="Deactivate" data-toggle="modal" data-target="#deactivateModal">
                                            <i class="las la-toggle-off"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete" disabled>
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Science Subjects -->
                            <tr class="table-light">
                                <td colspan="9"><strong>Science & Mathematics</strong></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    <strong>Mathematics</strong>
                                    <div><small class="text-muted">Core subject</small></div>
                                </td>
                                <td><span class="badge badge-primary">MATH-201</span></td>
                                <td><span class="badge badge-success">Theory</span></td>
                                <td>
                                    <div class="mb-1">
                                        <span class="badge badge-info">Class 1-10</span>
                                    </div>
                                    <small class="text-muted">10 Classes</small>
                                </td>
                                <td><span class="badge badge-info">500 Students</span></td>
                                <td>
                                    <div class="d-flex flex-wrap">
                                        <span class="badge badge-secondary mr-1 mb-1">Mr. David</span>
                                        <span class="badge badge-secondary mr-1 mb-1">Ms. Emma</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View Details">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-2" title="Deactivate" data-toggle="modal" data-target="#deactivateModal">
                                            <i class="las la-toggle-off"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete" disabled>
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>
                                    <strong>General Science</strong>
                                    <div><small class="text-muted">Class 1-5</small></div>
                                </td>
                                <td><span class="badge badge-primary">SCI-202</span></td>
                                <td><span class="badge badge-info">Theory & Practical</span></td>
                                <td>
                                    <div class="mb-1">
                                        <span class="badge badge-info">Class 1-5</span>
                                    </div>
                                    <small class="text-muted">5 Classes</small>
                                </td>
                                <td><span class="badge badge-info">250 Students</span></td>
                                <td>
                                    <span class="badge badge-secondary">Ms. Fatima</span>
                                </td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View Details">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-2" title="Deactivate" data-toggle="modal" data-target="#deactivateModal">
                                            <i class="las la-toggle-off"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete" disabled>
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>
                                    <strong>Physics</strong>
                                    <div><small class="text-muted">Class 9-10</small></div>
                                </td>
                                <td><span class="badge badge-primary">PHY-301</span></td>
                                <td><span class="badge badge-info">Theory & Practical</span></td>
                                <td>
                                    <div class="mb-1">
                                        <span class="badge badge-info">Class 9-10</span>
                                    </div>
                                    <small class="text-muted">2 Classes</small>
                                </td>
                                <td><span class="badge badge-info">100 Students</span></td>
                                <td>
                                    <span class="badge badge-secondary">Mr. Robert</span>
                                </td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View Details">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-2" title="Deactivate" data-toggle="modal" data-target="#deactivateModal">
                                            <i class="las la-toggle-off"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete" disabled>
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Social Studies -->
                            <tr class="table-light">
                                <td colspan="9"><strong>Social Studies & Islamiat</strong></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>
                                    <strong>Social Studies</strong>
                                    <div><small class="text-muted">History & Geography</small></div>
                                </td>
                                <td><span class="badge badge-primary">SST-401</span></td>
                                <td><span class="badge badge-success">Theory</span></td>
                                <td>
                                    <div class="mb-1">
                                        <span class="badge badge-info">Class 4-8</span>
                                    </div>
                                    <small class="text-muted">5 Classes</small>
                                </td>
                                <td><span class="badge badge-info">250 Students</span></td>
                                <td>
                                    <span class="badge badge-secondary">Ms. Sophia</span>
                                </td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View Details">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-2" title="Deactivate" data-toggle="modal" data-target="#deactivateModal">
                                            <i class="las la-toggle-off"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete" disabled>
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>
                                    <strong>Islamiat</strong>
                                    <div><small class="text-muted">Islamic Studies</small></div>
                                </td>
                                <td><span class="badge badge-primary">ISL-402</span></td>
                                <td><span class="badge badge-success">Theory</span></td>
                                <td>
                                    <div class="mb-1">
                                        <span class="badge badge-info">Class 1-10</span>
                                    </div>
                                    <small class="text-muted">10 Classes</small>
                                </td>
                                <td><span class="badge badge-info">500 Students</span></td>
                                <td>
                                    <span class="badge badge-secondary">Mr. Usman</span>
                                </td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View Details">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-2" title="Deactivate" data-toggle="modal" data-target="#deactivateModal">
                                            <i class="las la-toggle-off"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete" disabled>
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Computer & Arts -->
                            <tr class="table-light">
                                <td colspan="9"><strong>Computer & Creative Arts</strong></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>
                                    <strong>Computer Science</strong>
                                    <div><small class="text-muted">ICT Education</small></div>
                                </td>
                                <td><span class="badge badge-primary">COM-501</span></td>
                                <td><span class="badge badge-info">Theory & Practical</span></td>
                                <td>
                                    <div class="mb-1">
                                        <span class="badge badge-info">Class 3-10</span>
                                    </div>
                                    <small class="text-muted">8 Classes</small>
                                </td>
                                <td><span class="badge badge-info">400 Students</span></td>
                                <td>
                                    <span class="badge badge-secondary">Mr. Ali</span>
                                </td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View Details">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-2" title="Deactivate" data-toggle="modal" data-target="#deactivateModal">
                                            <i class="las la-toggle-off"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete" disabled>
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>
                                    <strong>Art & Drawing</strong>
                                    <div><small class="text-muted">Creative Arts</small></div>
                                </td>
                                <td><span class="badge badge-primary">ART-502</span></td>
                                <td><span class="badge badge-warning">Practical</span></td>
                                <td>
                                    <div class="mb-1">
                                        <span class="badge badge-info">Class 1-5</span>
                                    </div>
                                    <small class="text-muted">5 Classes</small>
                                </td>
                                <td><span class="badge badge-info">250 Students</span></td>
                                <td>
                                    <span class="badge badge-secondary">Ms. Aisha</span>
                                </td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View Details">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-2" title="Deactivate" data-toggle="modal" data-target="#deactivateModal">
                                            <i class="las la-toggle-off"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Inactive Subject Example -->
                            <tr>
                                <td>10</td>
                                <td>
                                    <strong>French Language</strong>
                                    <div><small class="text-muted">Optional subject</small></div>
                                </td>
                                <td><span class="badge badge-secondary">FRE-601</span></td>
                                <td><span class="badge badge-success">Theory</span></td>
                                <td>
                                    <div class="mb-1">
                                        <span class="badge badge-secondary">Class 9-10</span>
                                    </div>
                                    <small class="text-muted">2 Classes</small>
                                </td>
                                <td><span class="badge badge-secondary">0 Students</span></td>
                                <td>
                                    <span class="badge badge-light">No Teacher</span>
                                </td>
                                <td><span class="badge badge-danger">Inactive</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View Details">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-success mr-2" title="Activate">
                                            <i class="las la-toggle-on"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete">
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
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Deactivation Confirmation Modal -->
    <div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning">
                        <i class="las la-exclamation-triangle mr-2"></i>Deactivate Subject
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h6><i class="las la-exclamation-circle mr-2"></i>Warning</h6>
                        <p class="mb-0">You cannot deactivate a subject if it is linked to active classes or has exam records.</p>
                    </div>
                    <p>Are you sure you want to deactivate <strong>English Language</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning">Deactivate Subject</button>
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
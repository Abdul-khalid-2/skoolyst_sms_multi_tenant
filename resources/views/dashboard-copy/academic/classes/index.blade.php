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
                <h4 class="mb-3">Classes Setup</h4>
                <p class="mb-0">Define school classes for different academic systems</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Academic</a></li>
                        <li class="breadcrumb-item active">Classes</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('classes.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-3"></i>Add Class
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Search Class</label>
                            <input type="text" class="form-control" placeholder="Search class name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Academic Year</label>
                            <select class="form-control">
                                <option value="">All Academic Years</option>
                                <option value="2024-2025" selected>2024-2025</option>
                                <option value="2023-2024">2023-2024</option>
                                <option value="2022-2023">2022-2023</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
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

        <!-- Class Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Classes</h6>
                                <h2 class="mb-0 text-white">15</h2>
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
                                <h6 class="text-white mb-0">Active Classes</h6>
                                <h2 class="mb-0 text-white">14</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-check-circle fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">Total Sections</h6>
                                <h2 class="mb-0 text-white">45</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-layer-group fa-2x text-info"></i>
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
                                <h6 class="text-white mb-0">Total Subjects</h6>
                                <h2 class="mb-0 text-white">120</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-book-open fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Classes Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Classes List - Academic Year: 2024-2025</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Class Name</th>
                                <th>Academic Year</th>
                                <th>Sections Count</th>
                                <th>Subjects Count</th>
                                <th>Students Count</th>
                                <th>Display Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Pre-Primary Classes -->
                            <tr class="table-light">
                                <td colspan="9"><strong>Pre-Primary Section</strong></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>
                                    <strong>Play Group</strong>
                                    <div><small class="text-muted">Age: 2-3 years</small></div>
                                </td>
                                <td>2024-2025</td>
                                <td><span class="badge badge-info">3 Sections</span></td>
                                <td><span class="badge badge-info">5 Subjects</span></td>
                                <td><span class="badge badge-info">45 Students</span></td>
                                <td>1</td>
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
                                    <strong>Nursery</strong>
                                    <div><small class="text-muted">Age: 3-4 years</small></div>
                                </td>
                                <td>2024-2025</td>
                                <td><span class="badge badge-info">4 Sections</span></td>
                                <td><span class="badge badge-info">6 Subjects</span></td>
                                <td><span class="badge badge-info">60 Students</span></td>
                                <td>2</td>
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
                                <td>3</td>
                                <td>
                                    <strong>Kindergarten (KG)</strong>
                                    <div><small class="text-muted">Age: 4-5 years</small></div>
                                </td>
                                <td>2024-2025</td>
                                <td><span class="badge badge-info">5 Sections</span></td>
                                <td><span class="badge badge-info">7 Subjects</span></td>
                                <td><span class="badge badge-info">75 Students</span></td>
                                <td>3</td>
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

                            <!-- Primary Classes -->
                            <tr class="table-light">
                                <td colspan="9"><strong>Primary Section (Class 1-5)</strong></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><strong>Class 1</strong></td>
                                <td>2024-2025</td>
                                <td><span class="badge badge-info">4 Sections</span></td>
                                <td><span class="badge badge-info">8 Subjects</span></td>
                                <td><span class="badge badge-info">80 Students</span></td>
                                <td>4</td>
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
                                <td><strong>Class 2</strong></td>
                                <td>2024-2025</td>
                                <td><span class="badge badge-info">4 Sections</span></td>
                                <td><span class="badge badge-info">8 Subjects</span></td>
                                <td><span class="badge badge-info">80 Students</span></td>
                                <td>5</td>
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
                                <td>6</td>
                                <td><strong>Class 3</strong></td>
                                <td>2024-2025</td>
                                <td><span class="badge badge-info">3 Sections</span></td>
                                <td><span class="badge badge-info">9 Subjects</span></td>
                                <td><span class="badge badge-info">75 Students</span></td>
                                <td>6</td>
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

                            <!-- Middle Classes -->
                            <tr class="table-light">
                                <td colspan="9"><strong>Middle Section (Class 6-8)</strong></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td><strong>Class 6</strong></td>
                                <td>2024-2025</td>
                                <td><span class="badge badge-info">3 Sections</span></td>
                                <td><span class="badge badge-info">10 Subjects</span></td>
                                <td><span class="badge badge-info">90 Students</span></td>
                                <td>7</td>
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

                            <!-- Secondary Classes -->
                            <tr class="table-light">
                                <td colspan="9"><strong>Secondary Section (Class 9-10)</strong></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td><strong>Class 9</strong></td>
                                <td>2024-2025</td>
                                <td><span class="badge badge-info">2 Sections</span></td>
                                <td><span class="badge badge-info">12 Subjects</span></td>
                                <td><span class="badge badge-info">60 Students</span></td>
                                <td>8</td>
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

                            <!-- Cambridge O-Level -->
                            <tr class="table-light">
                                <td colspan="9"><strong>Cambridge System (O-Level)</strong></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>
                                    <strong>O Level Year 1</strong>
                                    <div><small class="text-muted">Grade 9 Equivalent</small></div>
                                </td>
                                <td>2024-2025</td>
                                <td><span class="badge badge-info">2 Sections</span></td>
                                <td><span class="badge badge-info">8 Subjects</span></td>
                                <td><span class="badge badge-info">40 Students</span></td>
                                <td>9</td>
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

                            <!-- Inactive Class Example -->
                            <tr>
                                <td>10</td>
                                <td>
                                    <strong>Montessori Group</strong>
                                    <div><small class="text-muted">Discontinued</small></div>
                                </td>
                                <td>2024-2025</td>
                                <td><span class="badge badge-secondary">0 Sections</span></td>
                                <td><span class="badge badge-secondary">0 Subjects</span></td>
                                <td><span class="badge badge-secondary">0 Students</span></td>
                                <td>10</td>
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
                        <i class="las la-exclamation-triangle mr-2"></i>Deactivate Class
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h6><i class="las la-exclamation-circle mr-2"></i>Warning</h6>
                        <p class="mb-0">You cannot deactivate a class if it contains active students. Please transfer or graduate students first.</p>
                    </div>
                    <p>Are you sure you want to deactivate <strong>Class 1</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning">Deactivate Class</button>
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
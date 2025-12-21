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
                <h4 class="mb-3">Teacher Subject Assignment</h4>
                <p class="mb-0">Manage subject allocations and class assignments for teachers</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}">Teachers</a></li>
                        <li class="breadcrumb-item active">Subject Assignment</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('teachers.index') }}" class="btn btn-primary">
                    <i class="las la-arrow-left mr-3"></i>Back to Teachers
                </a>
            </div>
        </div>

        <!-- Subject Assignment Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Academic Year</label>
                            <select class="form-control" id="academicYear">
                                <option value="2024-2025" selected>2024-2025</option>
                                <option value="2023-2024">2023-2024</option>
                                <option value="2022-2023">2022-2023</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Class</label>
                            <select class="form-control" id="classFilter">
                                <option value="">All Classes</option>
                                <optgroup label="Pre-Primary">
                                    <option value="playgroup">Play Group</option>
                                    <option value="nursery">Nursery</option>
                                    <option value="kg">Kindergarten (KG)</option>
                                </optgroup>
                                <optgroup label="Primary (Class 1-5)">
                                    <option value="class1">Class 1</option>
                                    <option value="class2">Class 2</option>
                                    <option value="class3">Class 3</option>
                                    <option value="class4">Class 4</option>
                                    <option value="class5">Class 5</option>
                                </optgroup>
                                <optgroup label="Middle (Class 6-8)">
                                    <option value="class6">Class 6</option>
                                    <option value="class7">Class 7</option>
                                    <option value="class8">Class 8</option>
                                </optgroup>
                                <optgroup label="Secondary (Class 9-10)">
                                    <option value="class9">Class 9</option>
                                    <option value="class10">Class 10</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Subject</label>
                            <select class="form-control" id="subjectFilter">
                                <option value="">All Subjects</option>
                                <option value="english">English</option>
                                <option value="urdu">Urdu</option>
                                <option value="mathematics">Mathematics</option>
                                <option value="science">Science</option>
                                <option value="computer">Computer Science</option>
                                <option value="islamiat">Islamiat</option>
                                <option value="social-studies">Social Studies</option>
                                <option value="physics">Physics</option>
                                <option value="chemistry">Chemistry</option>
                                <option value="biology">Biology</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary btn-block" id="filterButton">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teacher Subject Assignment Table -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Subject Assignments - Academic Year 2024-2025</h5>
                <button class="btn btn-primary" data-toggle="modal" data-target="#assignSubjectModal">
                    <i class="las la-plus mr-2"></i> Assign Subject
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Teacher</th>
                                <th>Subject</th>
                                <th>Classes</th>
                                <th>Sections</th>
                                <th>Periods/Week</th>
                                <th>Academic Year</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Assignment 1 -->
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Sarah+Smith&background=007bff&color=fff" 
                                                 class="rounded-circle" alt="Sarah Smith">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Ms. Sarah Smith</h6>
                                            <small class="text-muted">English Department</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">English</span>
                                </td>
                                <td>
                                    Class 1, Class 9, Class 10
                                </td>
                                <td>
                                    A, B, C
                                </td>
                                <td>
                                    39
                                </td>
                                <td>
                                    2024-2025
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View Details">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit Assignment">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" title="Remove Assignment">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Assignment 2 -->
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Ali+Khan&background=28a745&color=fff" 
                                                 class="rounded-circle" alt="Ali Khan">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Mr. Ali Khan</h6>
                                            <small class="text-muted">Science Department</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Physics</span>
                                    <span class="badge badge-info">Chemistry</span>
                                </td>
                                <td>
                                    Class 9, Class 10
                                </td>
                                <td>
                                    A, B
                                </td>
                                <td>
                                    32
                                </td>
                                <td>
                                    2024-2025
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View Details">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit Assignment">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" title="Remove Assignment">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Assignment 3 -->
                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Fatima+Ahmed&background=ffc107&color=000" 
                                                 class="rounded-circle" alt="Fatima Ahmed">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Ms. Fatima Ahmed</h6>
                                            <small class="text-muted">Mathematics Department</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Mathematics</span>
                                </td>
                                <td>
                                    Class 1-8
                                </td>
                                <td>
                                    All Sections
                                </td>
                                <td>
                                    45
                                </td>
                                <td>
                                    2024-2025
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View Details">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary mr-2" title="Edit Assignment">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" title="Remove Assignment">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Assignment 4 -->
                            <tr>
                                <td>4</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Zainab+Malik&background=17a2b8&color=fff" 
                                                 class="rounded-circle" alt="Zainab Malik">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Ms. Zainab Malik</h6>
                                            <small class="text-muted">Urdu Department</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">Urdu</span>
                                    <span class="badge badge-secondary">Islamiat</span>
                                </td>
                                <td>
                                    Class 1-5
                                </td>
                                <td>
                                    A, B, C
                                </td>
                                <td>
                                    36
                                </td>
                                <td>
                                    2024-2025
                                </td>
                                <td>
                                    <span class="badge badge-warning">On Leave</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-info mr-2" title="View Details">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-secondary mr-2" title="Leave Details">
                                            <i class="las la-umbrella-beach"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" title="Remove Assignment">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Class Teacher Assignment -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Class Teacher Assignments - Academic Year 2024-2025</h5>
                <button class="btn btn-primary" data-toggle="modal" data-target="#assignClassTeacherModal">
                    <i class="las la-plus mr-2"></i> Assign Class Teacher
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Class 1 -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-title">Class 1 - Section A</h6>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-sm mr-3">
                                        <img src="https://ui-avatars.com/api/?name=Sarah+Smith&background=007bff&color=fff" 
                                             class="rounded-circle" alt="Sarah Smith">
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Ms. Sarah Smith</h6>
                                        <small class="text-muted">Class Teacher</small>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Since:</small>
                                    <span class="font-weight-bold">January 2024</span>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Students:</small>
                                    <span class="font-weight-bold">35</span>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Status:</small>
                                    <span class="badge badge-success">Active</span>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-sm btn-primary mr-2">Edit</button>
                                    <button class="btn btn-sm btn-danger">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Class 1 - Section B -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-title">Class 1 - Section B</h6>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-sm mr-3">
                                        <img src="https://ui-avatars.com/api/?name=Ahmed+Raza&background=28a745&color=fff" 
                                             class="rounded-circle" alt="Ahmed Raza">
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Mr. Ahmed Raza</h6>
                                        <small class="text-muted">Class Teacher</small>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Since:</small>
                                    <span class="font-weight-bold">January 2024</span>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Students:</small>
                                    <span class="font-weight-bold">32</span>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Status:</small>
                                    <span class="badge badge-success">Active</span>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-sm btn-primary mr-2">Edit</button>
                                    <button class="btn btn-sm btn-danger">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Class 9 - Section A -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-title">Class 9 - Section A</h6>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-sm mr-3">
                                        <img src="https://ui-avatars.com/api/?name=Ali+Khan&background=ffc107&color=000" 
                                             class="rounded-circle" alt="Ali Khan">
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Mr. Ali Khan</h6>
                                        <small class="text-muted">Class Teacher</small>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Since:</small>
                                    <span class="font-weight-bold">January 2023</span>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">Students:</small>
                                    <span class="font-weight-bold">40</span>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Status:</small>
                                    <span class="badge badge-success">Active</span>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-sm btn-primary mr-2">Edit</button>
                                    <button class="btn btn-sm btn-danger">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Class 3 - Section C (Vacant) -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 border-warning">
                            <div class="card-body">
                                <h6 class="card-title">Class 3 - Section C</h6>
                                <div class="text-center py-4">
                                    <div class="mb-3">
                                        <i class="las la-user-times fa-3x text-warning"></i>
                                    </div>
                                    <h6 class="text-warning">Class Teacher Required</h6>
                                    <p class="text-muted mb-3">No teacher assigned</p>
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#assignClassTeacherModal">
                                        Assign Teacher
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Assign Subject Modal -->
    <div class="modal fade" id="assignSubjectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Subject to Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Teacher *</label>
                                    <select class="form-control" required>
                                        <option value="">Select Teacher</option>
                                        <option value="1">Ms. Sarah Smith (English)</option>
                                        <option value="2">Mr. Ali Khan (Science)</option>
                                        <option value="3">Ms. Fatima Ahmed (Mathematics)</option>
                                        <option value="4">Ms. Zainab Malik (Urdu)</option>
                                        <option value="5">Mr. Bilal Hussain (Computer)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subject *</label>
                                    <select class="form-control" required>
                                        <option value="">Select Subject</option>
                                        <option value="english">English</option>
                                        <option value="urdu">Urdu</option>
                                        <option value="mathematics">Mathematics</option>
                                        <option value="science">Science</option>
                                        <option value="computer">Computer Science</option>
                                        <option value="islamiat">Islamiat</option>
                                        <option value="social-studies">Social Studies</option>
                                        <option value="physics">Physics</option>
                                        <option value="chemistry">Chemistry</option>
                                        <option value="biology">Biology</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Class *</label>
                                    <select class="form-control" required multiple>
                                        <optgroup label="Primary (Class 1-5)">
                                            <option value="class1">Class 1</option>
                                            <option value="class2">Class 2</option>
                                            <option value="class3">Class 3</option>
                                            <option value="class4">Class 4</option>
                                            <option value="class5">Class 5</option>
                                        </optgroup>
                                        <optgroup label="Middle (Class 6-8)">
                                            <option value="class6">Class 6</option>
                                            <option value="class7">Class 7</option>
                                            <option value="class8">Class 8</option>
                                        </optgroup>
                                        <optgroup label="Secondary (Class 9-10)">
                                            <option value="class9">Class 9</option>
                                            <option value="class10">Class 10</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sections *</label>
                                    <select class="form-control" required multiple>
                                        <option value="A">Section A</option>
                                        <option value="B">Section B</option>
                                        <option value="C">Section C</option>
                                        <option value="D">Section D</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Periods per Week *</label>
                                    <input type="number" class="form-control" min="1" max="50" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Academic Year *</label>
                                    <select class="form-control" required>
                                        <option value="2024-2025" selected>2024-2025</option>
                                        <option value="2023-2024">2023-2024</option>
                                        <option value="2022-2023">2022-2023</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Notes (Optional)</label>
                                    <textarea class="form-control" rows="3" placeholder="Any additional notes or instructions"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Assign Subject</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Assign Class Teacher Modal -->
    <div class="modal fade" id="assignClassTeacherModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Class Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Class & Section *</label>
                                    <select class="form-control" required>
                                        <option value="">Select Class & Section</option>
                                        <optgroup label="Primary (Class 1-5)">
                                            <option value="class1-a">Class 1 - Section A</option>
                                            <option value="class1-b">Class 1 - Section B</option>
                                            <option value="class1-c">Class 1 - Section C</option>
                                            <option value="class2-a">Class 2 - Section A</option>
                                            <option value="class2-b">Class 2 - Section B</option>
                                            <option value="class2-c">Class 2 - Section C</option>
                                            <option value="class3-a">Class 3 - Section A</option>
                                            <option value="class3-b">Class 3 - Section B</option>
                                            <option value="class3-c">Class 3 - Section C</option>
                                            <option value="class4-a">Class 4 - Section A</option>
                                            <option value="class4-b">Class 4 - Section B</option>
                                            <option value="class4-c">Class 4 - Section C</option>
                                            <option value="class5-a">Class 5 - Section A</option>
                                            <option value="class5-b">Class 5 - Section B</option>
                                            <option value="class5-c">Class 5 - Section C</option>
                                        </optgroup>
                                        <optgroup label="Middle (Class 6-8)">
                                            <option value="class6-a">Class 6 - Section A</option>
                                            <option value="class6-b">Class 6 - Section B</option>
                                            <option value="class6-c">Class 6 - Section C</option>
                                            <option value="class7-a">Class 7 - Section A</option>
                                            <option value="class7-b">Class 7 - Section B</option>
                                            <option value="class7-c">Class 7 - Section C</option>
                                            <option value="class8-a">Class 8 - Section A</option>
                                            <option value="class8-b">Class 8 - Section B</option>
                                            <option value="class8-c">Class 8 - Section C</option>
                                        </optgroup>
                                        <optgroup label="Secondary (Class 9-10)">
                                            <option value="class9-a">Class 9 - Section A</option>
                                            <option value="class9-b">Class 9 - Section B</option>
                                            <option value="class9-c">Class 9 - Section C</option>
                                            <option value="class10-a">Class 10 - Section A</option>
                                            <option value="class10-b">Class 10 - Section B</option>
                                            <option value="class10-c">Class 10 - Section C</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Teacher *</label>
                                    <select class="form-control" required>
                                        <option value="">Select Teacher</option>
                                        <option value="1">Ms. Sarah Smith (English)</option>
                                        <option value="2">Mr. Ali Khan (Science)</option>
                                        <option value="3">Ms. Fatima Ahmed (Mathematics)</option>
                                        <option value="4">Ms. Zainab Malik (Urdu)</option>
                                        <option value="5">Mr. Bilal Hussain (Computer)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Assignment Start Date *</label>
                                    <input type="date" class="form-control" required value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Notes (Optional)</label>
                                    <textarea class="form-control" rows="3" placeholder="Any special instructions or notes"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Assign as Class Teacher</button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Subject Assignment Script -->
    <script>
        $(document).ready(function() {
            // Filter functionality
            $('#filterButton').click(function() {
                var academicYear = $('#academicYear').val();
                var classFilter = $('#classFilter').val();
                var subjectFilter = $('#subjectFilter').val();
                
                // Here you would typically make an AJAX request to filter data
                // For now, we'll just show an alert
                alert('Filter applied:\nAcademic Year: ' + academicYear + 
                      '\nClass: ' + (classFilter || 'All') + 
                      '\nSubject: ' + (subjectFilter || 'All'));
            });
            
            // Tooltip initialization
            $('[title]').tooltip();
            
            // Modal form handling
            $('#assignSubjectModal').on('show.bs.modal', function() {
                // Reset form
                $(this).find('form')[0].reset();
            });
            
            $('#assignClassTeacherModal').on('show.bs.modal', function() {
                // Reset form
                $(this).find('form')[0].reset();
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
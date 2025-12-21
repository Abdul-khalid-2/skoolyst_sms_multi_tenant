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
                <h4 class="mb-3">Teacher Profile</h4>
                <p class="mb-0">Complete teacher information and records</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}">Teachers</a></li>
                        <li class="breadcrumb-item active">Teacher Profile</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('teachers.index') }}" class="btn btn-primary add-list">
                <i class="las la-arrow-left mr-3"></i>Back to Teachers
            </a>
        </div>

        <div class="row">
            <!-- Left Column - Teacher Info -->
            <div class="col-lg-4">
                <!-- Profile Card -->
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xxl mb-4">
                            <img src="https://ui-avatars.com/api/?name=Sarah+Smith&background=007bff&color=fff&size=150" 
                                 class="rounded-circle border" alt="Sarah Smith">
                        </div>
                        
                        <h4 class="mb-2">Ms. Sarah Smith</h4>
                        <p class="text-muted mb-3">
                            <i class="las la-chalkboard-teacher mr-2"></i>Senior Teacher - English Department
                        </p>
                        
                        <div class="mb-4">
                            <span class="badge badge-success badge-pill p-2">Active</span>
                            <span class="badge badge-primary badge-pill p-2 ml-2">EMP: TEA-001</span>
                            <span class="badge badge-info badge-pill p-2 ml-2">Class Teacher</span>
                        </div>
                        
                        <!-- Quick Stats -->
                        <div class="row text-center mb-4">
                            <div class="col-4">
                                <h5 class="mb-1">4</h5>
                                <small class="text-muted">Years</small>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-1">5</h5>
                                <small class="text-muted">Classes</small>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-1">2</h5>
                                <small class="text-muted">Subjects</small>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="d-flex justify-content-center mb-3">
                            <a href="{{ route('teachers.edit', 1) }}" class="btn btn-primary btn-sm mx-1">
                                <i class="las la-edit mr-1"></i> Edit
                            </a>
                            <a href="#" class="btn btn-info btn-sm mx-1">
                                <i class="las la-calendar-alt mr-1"></i> Time Table
                            </a>
                            <a href="#" class="btn btn-warning btn-sm mx-1">
                                <i class="las la-id-card mr-1"></i> ID Card
                            </a>
                            <a href="#" class="btn btn-secondary btn-sm mx-1">
                                <i class="las la-ellipsis-v mr-1"></i> More
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Basic Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Basic Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Employee ID:</span>
                            <span class="font-weight-bold">TEA-001</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Joining Date:</span>
                            <span class="font-weight-bold">15 Jan 2020</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Date of Birth:</span>
                            <span class="font-weight-bold">15 Mar 1985 (39 years)</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Gender:</span>
                            <span class="font-weight-bold">Female</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Marital Status:</span>
                            <span class="font-weight-bold">Married</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Nationality:</span>
                            <span class="font-weight-bold">Pakistani</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Contact Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="font-weight-bold">Address:</label>
                            <p class="mb-0">456 Teacher's Colony, Model Town, Lahore, Pakistan</p>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold">Phone:</label>
                            <p class="mb-0">+92 300 1234567</p>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold">Email:</label>
                            <p class="mb-0">sarah@example.com</p>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold">Emergency Contact:</label>
                            <p class="mb-0">Mr. John Smith (Husband)<br>+92 300 9876543</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Detailed Information -->
            <div class="col-lg-8">
                <!-- Profile Tabs -->
                <div class="card mb-4">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="profileTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview">
                                    <i class="las la-user-circle mr-2"></i>Overview
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="professional-tab" data-toggle="tab" href="#professional">
                                    <i class="las la-briefcase mr-2"></i>Professional
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="qualifications-tab" data-toggle="tab" href="#qualifications">
                                    <i class="las la-graduation-cap mr-2"></i>Qualifications
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="teaching-tab" data-toggle="tab" href="#teaching">
                                    <i class="las la-chalkboard-teacher mr-2"></i>Teaching
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents">
                                    <i class="las la-file-alt mr-2"></i>Documents
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="profileTabContent">
                            <!-- Overview Tab -->
                            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Full Name</label>
                                            <p class="form-control-static">Ms. Sarah Smith</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Religion</label>
                                            <p class="form-control-static">Christianity</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Blood Group</label>
                                            <p class="form-control-static">O+</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">CNIC</label>
                                            <p class="form-control-static">35201-1234567-8</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Bank Details</label>
                                            <p class="form-control-static">
                                                Bank: Allied Bank Limited<br>
                                                Account #: 1234567890123<br>
                                                Branch: Model Town, Lahore
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Salary Information -->
                                <div class="mt-4">
                                    <h6 class="mb-3">Salary Information</h6>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h5 class="mb-1 text-success">PKR 80,000</h5>
                                                    <small class="text-muted">Basic Salary</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h5 class="mb-1 text-info">PKR 95,000</h5>
                                                    <small class="text-muted">Gross Salary</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h5 class="mb-1 text-primary">BPS-16</h5>
                                                    <small class="text-muted">Salary Scale</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Professional Tab -->
                            <div class="tab-pane fade" id="professional" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Designation</label>
                                            <p class="form-control-static">
                                                <span class="badge badge-primary">Senior Teacher</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Department</label>
                                            <p class="form-control-static">
                                                <span class="badge badge-info">English Department</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Employment Type</label>
                                            <p class="form-control-static">Permanent</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Status</label>
                                            <p class="form-control-static">
                                                <span class="badge badge-success">Active</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Total Experience</label>
                                            <p class="form-control-static">8 Years (4 years at this school)</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Last Promotion</label>
                                            <p class="form-control-static">01 Jan 2023</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Previous Experience -->
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-history mr-2"></i> Previous Experience
                                        </h6>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Organization</th>
                                                        <th>Position</th>
                                                        <th>Duration</th>
                                                        <th>Experience</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Sunrise School System</td>
                                                        <td>English Teacher</td>
                                                        <td>Jan 2016 - Dec 2019</td>
                                                        <td>4 Years</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bright Future School</td>
                                                        <td>Assistant Teacher</td>
                                                        <td>Mar 2014 - Dec 2015</td>
                                                        <td>1 Year 10 Months</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <!-- Awards & Achievements -->
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-award mr-2"></i> Awards & Achievements
                                        </h6>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <i class="las la-trophy text-warning mr-2"></i>
                                                Best Teacher Award 2022
                                            </li>
                                            <li class="list-group-item">
                                                <i class="las la-medal text-success mr-2"></i>
                                                Excellence in Teaching 2021
                                            </li>
                                            <li class="list-group-item">
                                                <i class="las la-star text-info mr-2"></i>
                                                Students' Favorite Teacher 2023
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Qualifications Tab -->
                            <div class="tab-pane fade" id="qualifications" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6 class="mb-3">Educational Qualifications</h6>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Degree</th>
                                                        <th>Subject</th>
                                                        <th>Institution</th>
                                                        <th>Year</th>
                                                        <th>Grade</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>M.A English Literature</td>
                                                        <td>English Literature</td>
                                                        <td>University of the Punjab</td>
                                                        <td>2014</td>
                                                        <td>First Division</td>
                                                    </tr>
                                                    <tr>
                                                        <td>B.A (Hons)</td>
                                                        <td>English</td>
                                                        <td>University of the Punjab</td>
                                                        <td>2012</td>
                                                        <td>First Division</td>
                                                    </tr>
                                                    <tr>
                                                        <td>F.Sc</td>
                                                        <td>Pre-Medical</td>
                                                        <td>Punjab College</td>
                                                        <td>2008</td>
                                                        <td>A Grade</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Matric</td>
                                                        <td>Science</td>
                                                        <td>Convent School</td>
                                                        <td>2006</td>
                                                        <td>A+ Grade</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3">Professional Qualifications</h6>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Certification</th>
                                                        <th>Issuing Authority</th>
                                                        <th>Year</th>
                                                        <th>Document</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>B.Ed (Bachelor of Education)</td>
                                                        <td>Allama Iqbal Open University</td>
                                                        <td>2015</td>
                                                        <td>
                                                            <a href="#" class="btn btn-sm btn-outline-primary">
                                                                <i class="las la-eye mr-1"></i> View
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>TEFL Certification</td>
                                                        <td>International TEFL Academy</td>
                                                        <td>2018</td>
                                                        <td>
                                                            <a href="#" class="btn btn-sm btn-outline-primary">
                                                                <i class="las la-eye mr-1"></i> View
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Classroom Management</td>
                                                        <td>British Council</td>
                                                        <td>2020</td>
                                                        <td>
                                                            <a href="#" class="btn btn-sm btn-outline-primary">
                                                                <i class="las la-eye mr-1"></i> View
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Teaching Tab -->
                            <div class="tab-pane fade" id="teaching" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="alert alert-info">
                                            <h6><i class="las la-info-circle mr-2"></i> Current Teaching Assignments</h6>
                                            <p class="mb-0">Academic Year: 2024-2025 | Status: Active</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Class Teacher Assignment -->
                                    <div class="col-md-12 mb-4">
                                        <h6 class="mb-3">
                                            <i class="las la-users mr-2"></i> Class Teacher Assignment
                                        </h6>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h5 class="mb-1">Class 1 - Section A</h5>
                                                        <p class="mb-0 text-muted">Since: January 2024</p>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-success badge-pill p-2">Active</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <p class="mb-2"><strong>Responsibilities:</strong></p>
                                                    <ul class="mb-0">
                                                        <li>Classroom management and discipline</li>
                                                        <li>Parent-teacher meetings</li>
                                                        <li>Student progress monitoring</li>
                                                        <li>Attendance tracking</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Subject Assignments -->
                                    <div class="col-md-12 mb-4">
                                        <h6 class="mb-3">
                                            <i class="las la-book mr-2"></i> Subject Assignments
                                        </h6>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Subject</th>
                                                        <th>Class</th>
                                                        <th>Section</th>
                                                        <th>Periods/Week</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>English</td>
                                                        <td>Class 1</td>
                                                        <td>A, B, C</td>
                                                        <td>15</td>
                                                        <td><span class="badge badge-success">Active</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>English Literature</td>
                                                        <td>Class 9</td>
                                                        <td>A, B</td>
                                                        <td>10</td>
                                                        <td><span class="badge badge-success">Active</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>English Language</td>
                                                        <td>Class 10</td>
                                                        <td>A</td>
                                                        <td>8</td>
                                                        <td><span class="badge badge-success">Active</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Creative Writing</td>
                                                        <td>Class 8</td>
                                                        <td>A, B</td>
                                                        <td>6</td>
                                                        <td><span class="badge badge-success">Active</span></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3" class="text-right">Total Periods:</th>
                                                        <th>39</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <!-- Weekly Time Table -->
                                    <div class="col-md-12">
                                        <h6 class="mb-3">
                                            <i class="las la-calendar-alt mr-2"></i> Weekly Time Table
                                        </h6>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Day/Time</th>
                                                                <th>8:00-9:00</th>
                                                                <th>9:00-10:00</th>
                                                                <th>10:00-11:00</th>
                                                                <th>11:00-12:00</th>
                                                                <th>12:00-1:00</th>
                                                                <th>1:00-2:00</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th>Monday</th>
                                                                <td>Class 1A (English)</td>
                                                                <td>Class 1B (English)</td>
                                                                <td>Class 1C (English)</td>
                                                                <td>Break</td>
                                                                <td>Class 9A (Literature)</td>
                                                                <td>Class 9B (Literature)</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tuesday</th>
                                                                <td>Class 8A (Writing)</td>
                                                                <td>Class 8B (Writing)</td>
                                                                <td>Class 10A (English)</td>
                                                                <td>Break</td>
                                                                <td>Meeting</td>
                                                                <td>Preparation</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Wednesday</th>
                                                                <td>Class 1A (English)</td>
                                                                <td>Class 1B (English)</td>
                                                                <td>Class 1C (English)</td>
                                                                <td>Break</td>
                                                                <td>Class 9A (Literature)</td>
                                                                <td>Class 9B (Literature)</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Thursday</th>
                                                                <td>Class 8A (Writing)</td>
                                                                <td>Class 8B (Writing)</td>
                                                                <td>Class 10A (English)</td>
                                                                <td>Break</td>
                                                                <td>Class 10A (English)</td>
                                                                <td>Preparation</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Friday</th>
                                                                <td>Class 1A (English)</td>
                                                                <td>Class 1B (English)</td>
                                                                <td>Class 1C (English)</td>
                                                                <td>Assembly</td>
                                                                <td>Free Period</td>
                                                                <td>Free Period</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Documents Tab -->
                            <div class="tab-pane fade" id="documents" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <h6 class="mb-3">Teacher Documents</h6>
                                        <div class="alert alert-success">
                                            <i class="las la-check-circle mr-2"></i>
                                            All documents have been verified and approved.
                                        </div>
                                    </div>
                                    
                                    <!-- Document List -->
                                    <div class="col-md-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h6 class="card-title mb-1">CNIC Copy</h6>
                                                        <p class="text-muted mb-0">Size: 2.1 MB | Verified: 15 Jan 2020</p>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-success">Verified</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-eye mr-1"></i> View
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-secondary">
                                                        <i class="las la-download mr-1"></i> Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h6 class="card-title mb-1">Educational Certificates</h6>
                                                        <p class="text-muted mb-0">Size: 8.5 MB | 4 Files</p>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-success">Verified</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-eye mr-1"></i> View All
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-secondary">
                                                        <i class="las la-download mr-1"></i> Download Zip
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h6 class="card-title mb-1">Experience Certificates</h6>
                                                        <p class="text-muted mb-0">Size: 3.2 MB | 2 Files</p>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-success">Verified</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-eye mr-1"></i> View
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-secondary">
                                                        <i class="las la-download mr-1"></i> Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h6 class="card-title mb-1">Police Clearance</h6>
                                                        <p class="text-muted mb-0">Size: 1.5 MB | Expires: Dec 2025</p>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-success">Valid</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-eye mr-1"></i> View
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-secondary">
                                                        <i class="las la-download mr-1"></i> Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h6 class="card-title mb-1">Medical Certificate</h6>
                                                        <p class="text-muted mb-0">Size: 1.8 MB | Date: Jan 2024</p>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-success">Valid</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-eye mr-1"></i> View
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-secondary">
                                                        <i class="las la-download mr-1"></i> Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h6 class="card-title mb-1">CV/Resume</h6>
                                                        <p class="text-muted mb-0">Size: 2.3 MB | Updated: Dec 2023</p>
                                                    </div>
                                                    <div>
                                                        <span class="badge badge-success">Verified</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-eye mr-1"></i> View
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-secondary">
                                                        <i class="las la-download mr-1"></i> Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Upload New Document -->
                                    <div class="col-md-12 mt-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">Upload New Document</h6>
                                            </div>
                                            <div class="card-body">
                                                <form>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Document Type</label>
                                                                <select class="form-control">
                                                                    <option value="">Select Document Type</option>
                                                                    <option value="certificate">New Certificate</option>
                                                                    <option value="experience">Experience Certificate</option>
                                                                    <option value="medical">Medical Certificate</option>
                                                                    <option value="police">Police Clearance</option>
                                                                    <option value="other">Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Document</label>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="newDocument">
                                                                    <label class="custom-file-label" for="newDocument">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="las la-upload mr-2"></i> Upload Document
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
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
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Tab Activation -->
    <script>
        $(document).ready(function() {
            // Handle tab switching
            $('#profileTab a').on('click', function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
            
            // File input label update
            $('.custom-file-input').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
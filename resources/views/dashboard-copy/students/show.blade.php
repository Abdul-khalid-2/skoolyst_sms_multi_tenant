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
                <h4 class="mb-3">Student Profile</h4>
                <p class="mb-0">Complete student information and records</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Students</a></li>
                        <li class="breadcrumb-item active">Student Profile</li>
                    </ol>
                </nav>
            </div>
            <a href="#" class="btn btn-primary add-list">
                <i class="las la-arrow-left mr-3"></i>Back to Students
            </a>
        </div>

        <div class="row">
            <!-- Left Column - Student Info -->
            <div class="col-lg-4">
                <!-- Profile Card -->
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xxl mb-4">
                            <img src="https://ui-avatars.com/api/?name=Alex+Johnson&background=007bff&color=fff&size=150" 
                                 class="rounded-circle border" alt="Alex Johnson">
                        </div>
                        
                        <h4 class="mb-2">Alex Johnson</h4>
                        <p class="text-muted mb-3">
                            <i class="las la-graduation-cap mr-2"></i>Class 1 - Section A
                        </p>
                        
                        <div class="mb-4">
                            <span class="badge badge-success badge-pill p-2">Active</span>
                            <span class="badge badge-primary badge-pill p-2 ml-2">Fee: Paid</span>
                            <span class="badge badge-info badge-pill p-2 ml-2">Roll: 1-A-01</span>
                        </div>
                        
                        <!-- Quick Stats -->
                        <div class="row text-center mb-4">
                            <div class="col-4">
                                <h5 class="mb-1">85%</h5>
                                <small class="text-muted">Attendance</small>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-1">A</h5>
                                <small class="text-muted">Grade</small>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-1">3</h5>
                                <small class="text-muted">Absent</small>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="d-flex justify-content-center mb-3">
                            <a href="#" class="btn btn-primary btn-sm mx-1">
                                <i class="las la-edit mr-1"></i> Edit
                            </a>
                            <a href="#" class="btn btn-info btn-sm mx-1">
                                <i class="las la-money-bill mr-1"></i> Fee
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
                            <span>Admission No:</span>
                            <span class="font-weight-bold">ADM-2024-001</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Admission Date:</span>
                            <span class="font-weight-bold">01 Apr 2024</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Date of Birth:</span>
                            <span class="font-weight-bold">15 Mar 2016 (8 years)</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Gender:</span>
                            <span class="font-weight-bold">Male</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Blood Group:</span>
                            <span class="font-weight-bold">A+</span>
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
                            <label class="font-weight-bold">Current Address:</label>
                            <p class="mb-0">123 Main Street, Garden Town, Lahore, Pakistan</p>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold">Phone:</label>
                            <p class="mb-0">+92 300 1234567</p>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold">Email:</label>
                            <p class="mb-0">alex@example.com</p>
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
                                <a class="nav-link" id="guardian-tab" data-toggle="tab" href="#guardian">
                                    <i class="las la-users mr-2"></i>Guardian
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="academic-tab" data-toggle="tab" href="#academic">
                                    <i class="las la-graduation-cap mr-2"></i>Academic
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents">
                                    <i class="las la-file-alt mr-2"></i>Documents
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="fee-tab" data-toggle="tab" href="#fee">
                                    <i class="las la-money-bill-wave mr-2"></i>Fee
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
                                            <p class="form-control-static">Alex Johnson</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Religion</label>
                                            <p class="form-control-static">Islam</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Place of Birth</label>
                                            <p class="form-control-static">Lahore, Pakistan</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Mother Tongue</label>
                                            <p class="form-control-static">Urdu</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Medical Information</label>
                                            <p class="form-control-static">No known allergies or medical conditions</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Special Notes</label>
                                            <p class="form-control-static">Excellent in mathematics, participates in sports activities</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Attendance Summary -->
                                <div class="mt-4">
                                    <h6 class="mb-3">Attendance Summary (Current Month)</h6>
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-3">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h3 class="mb-1 text-success">17</h3>
                                                    <small class="text-muted">Present</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6 mb-3">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h3 class="mb-1 text-danger">3</h3>
                                                    <small class="text-muted">Absent</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6 mb-3">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h3 class="mb-1 text-warning">2</h3>
                                                    <small class="text-muted">Late</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6 mb-3">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h3 class="mb-1 text-info">85%</h3>
                                                    <small class="text-muted">Percentage</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Guardian Tab -->
                            <div class="tab-pane fade" id="guardian" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-male mr-2"></i> Father's Information
                                        </h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Name</label>
                                            <p class="form-control-static">Mr. Robert Johnson</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">CNIC</label>
                                            <p class="form-control-static">35201-1234567-8</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Occupation</label>
                                            <p class="form-control-static">Business Owner</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Monthly Income</label>
                                            <p class="form-control-static">PKR 150,000</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Email</label>
                                            <p class="form-control-static">robert@example.com</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Phone</label>
                                            <p class="form-control-static">+92 300 1234567</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-female mr-2"></i> Mother's Information
                                        </h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Name</label>
                                            <p class="form-control-static">Ms. Emma Johnson</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">CNIC</label>
                                            <p class="form-control-static">35201-2345678-9</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Occupation</label>
                                            <p class="form-control-static">Teacher</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Email</label>
                                            <p class="form-control-static">emma@example.com</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Phone</label>
                                            <p class="form-control-static">+92 300 2345678</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-phone mr-2"></i> Emergency Contact
                                        </h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Name</label>
                                            <p class="form-control-static">Mr. David Wilson</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Relation</label>
                                            <p class="form-control-static">Uncle</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Phone</label>
                                            <p class="form-control-static">+92 300 3456789</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Address</label>
                                            <p class="form-control-static">456 College Road, Lahore</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Academic Tab -->
                            <div class="tab-pane fade" id="academic" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Academic Year</label>
                                            <p class="form-control-static">2024-2025</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Class</label>
                                            <p class="form-control-static">
                                                <span class="badge badge-info">Class 1</span>
                                                <span class="badge badge-secondary">Section A</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Roll Number</label>
                                            <p class="form-control-static">1-A-01</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Class Teacher</label>
                                            <p class="form-control-static">Ms. Sarah Smith</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-school mr-2"></i> Previous School Information
                                        </h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Previous School</label>
                                            <p class="form-control-static">Little Angels School</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Previous Class</label>
                                            <p class="form-control-static">KG</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Transfer Certificate No</label>
                                            <p class="form-control-static">TC-2024-123</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Leaving Date</label>
                                            <p class="form-control-static">31 Mar 2024</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Current Subjects -->
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-book-open mr-2"></i> Current Subjects
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <span class="badge badge-primary p-2">English</span>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <span class="badge badge-primary p-2">Urdu</span>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <span class="badge badge-primary p-2">Mathematics</span>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <span class="badge badge-primary p-2">General Science</span>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <span class="badge badge-primary p-2">Islamiat</span>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <span class="badge badge-primary p-2">Drawing</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Documents Tab -->
                            <div class="tab-pane fade" id="documents" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <h6 class="mb-3">Uploaded Documents</h6>
                                        <div class="alert alert-info">
                                            <i class="las la-info-circle mr-2"></i>
                                            All documents have been verified and approved.
                                        </div>
                                    </div>
                                    
                                    <!-- Document List -->
                                    <div class="col-md-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h6 class="card-title mb-1">Birth Certificate</h6>
                                                        <p class="text-muted mb-0">Size: 2.1 MB</p>
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
                                                        <h6 class="card-title mb-1">Father's CNIC</h6>
                                                        <p class="text-muted mb-0">Size: 1.5 MB</p>
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
                                                        <h6 class="card-title mb-1">Student Photograph</h6>
                                                        <p class="text-muted mb-0">Size: 0.8 MB</p>
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
                                                        <h6 class="card-title mb-1">Transfer Certificate</h6>
                                                        <p class="text-muted mb-0">Size: 1.2 MB</p>
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
                                                                    <option value="medical">Medical Certificate</option>
                                                                    <option value="character">Character Certificate</option>
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

                            <!-- Fee Tab -->
                            <div class="tab-pane fade" id="fee" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="alert alert-success">
                                            <h6><i class="las la-check-circle mr-2"></i> Fee Status: All Paid</h6>
                                            <p class="mb-0">All fees are paid up to date. Next due date: 05 Mar 2025</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Fee Summary -->
                                    <div class="col-md-12 mb-4">
                                        <h6 class="mb-3">Fee Summary - Academic Year 2024-2025</h6>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Fee Type</th>
                                                        <th>Amount</th>
                                                        <th>Due Date</th>
                                                        <th>Status</th>
                                                        <th>Payment Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Admission Fee</td>
                                                        <td>PKR 5,000</td>
                                                        <td>01 Apr 2024</td>
                                                        <td><span class="badge badge-success">Paid</span></td>
                                                        <td>01 Apr 2024</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Monthly Fee (Apr)</td>
                                                        <td>PKR 3,000</td>
                                                        <td>05 Apr 2024</td>
                                                        <td><span class="badge badge-success">Paid</span></td>
                                                        <td>03 Apr 2024</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Monthly Fee (May)</td>
                                                        <td>PKR 3,000</td>
                                                        <td>05 May 2024</td>
                                                        <td><span class="badge badge-success">Paid</span></td>
                                                        <td>02 May 2024</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Monthly Fee (Jun)</td>
                                                        <td>PKR 3,000</td>
                                                        <td>05 Jun 2024</td>
                                                        <td><span class="badge badge-success">Paid</span></td>
                                                        <td>04 Jun 2024</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Exam Fee</td>
                                                        <td>PKR 1,000</td>
                                                        <td>15 Jun 2024</td>
                                                        <td><span class="badge badge-success">Paid</span></td>
                                                        <td>12 Jun 2024</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Total</th>
                                                        <th>PKR 15,000</th>
                                                        <th>-</th>
                                                        <th>-</th>
                                                        <th>-</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <!-- Quick Fee Actions -->
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title mb-3">Quick Fee Actions</h6>
                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <a href="#" class="btn btn-success btn-block">
                                                            <i class="las la-money-bill-wave mr-2"></i> Collect Fee
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <a href="#" class="btn btn-info btn-block">
                                                            <i class="las la-file-invoice mr-2"></i> Generate Receipt
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <a href="#" class="btn btn-warning btn-block">
                                                            <i class="las la-history mr-2"></i> Fee History
                                                        </a>
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
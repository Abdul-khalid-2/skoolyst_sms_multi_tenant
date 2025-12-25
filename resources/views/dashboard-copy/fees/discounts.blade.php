<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .discount-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
        }
        
        .discount-amount {
            font-size: 18px;
            font-weight: bold;
        }
        
        .percentage-badge {
            background-color: #e3f2fd;
            color: #1565c0;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 12px;
        }
        
        .fixed-badge {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 12px;
        }
        
        .discount-actions .btn {
            min-width: 100px;
        }
        
        .discount-card {
            border-left: 4px solid;
            transition: all 0.3s ease;
        }
        
        .discount-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .card-sibling { border-left-color: #007bff; }
        .card-merit { border-left-color: #28a745; }
        .card-staff { border-left-color: #ffc107; }
        .card-orphan { border-left-color: #dc3545; }
        .card-needy { border-left-color: #6c757d; }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Discounts & Waivers</h4>
                <p class="mb-0">Manage fee discounts, scholarships, and waivers</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Fees Management</a></li>
                        <li class="breadcrumb-item active">Discounts & Waivers</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addDiscountModal">
                    <i class="las la-percent mr-2"></i>Add New Discount
                </button>
                <button class="btn btn-success ml-2" data-toggle="modal" data-target="#applyDiscountModal">
                    <i class="las la-user-check mr-2"></i>Apply Discount to Student
                </button>
            </div>
        </div>

        <!-- Discount Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Active Discounts</h6>
                                <h2 class="mb-0 text-white">8</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-tags fa-lg text-primary"></i>
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
                                <h6 class="text-white mb-0">Students Benefited</h6>
                                <h2 class="mb-0 text-white">45</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-users fa-lg text-success"></i>
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
                                <h6 class="text-white mb-0">Total Discount Given</h6>
                                <h2 class="mb-0 text-white">PKR 125K</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-hand-holding-usd fa-lg text-info"></i>
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
                                <h6 class="text-white mb-0">This Month</h6>
                                <h2 class="mb-0 text-white">PKR 25K</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-calendar-alt fa-lg text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Discount Categories -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Discount Categories</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Sibling Discount -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                                <div class="card discount-card card-sibling h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">Sibling Discount</h6>
                                                <p class="text-muted mb-2">For families with multiple children</p>
                                                <div class="d-flex align-items-center">
                                                    <span class="percentage-badge mr-2">15%</span>
                                                    <span class="badge badge-info">25 Students</span>
                                                </div>
                                            </div>
                                            <div class="text-primary">
                                                <i class="las la-user-friends fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Merit Scholarship -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                                <div class="card discount-card card-merit h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">Merit Scholarship</h6>
                                                <p class="text-muted mb-2">For top-performing students</p>
                                                <div class="d-flex align-items-center">
                                                    <span class="percentage-badge mr-2">25%</span>
                                                    <span class="badge badge-info">10 Students</span>
                                                </div>
                                            </div>
                                            <div class="text-success">
                                                <i class="las la-medal fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Staff Child -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                                <div class="card discount-card card-staff h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">Staff Child</h6>
                                                <p class="text-muted mb-2">For children of school staff</p>
                                                <div class="d-flex align-items-center">
                                                    <span class="percentage-badge mr-2">50%</span>
                                                    <span class="badge badge-info">8 Students</span>
                                                </div>
                                            </div>
                                            <div class="text-warning">
                                                <i class="las la-user-tie fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Orphan Student -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                                <div class="card discount-card card-orphan h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">Orphan Student</h6>
                                                <p class="text-muted mb-2">Complete fee waiver</p>
                                                <div class="d-flex align-items-center">
                                                    <span class="percentage-badge mr-2">100%</span>
                                                    <span class="badge badge-info">5 Students</span>
                                                </div>
                                            </div>
                                            <div class="text-danger">
                                                <i class="las la-heart fa-2x"></i>
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

        <!-- Discount Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Search</label>
                            <input type="text" class="form-control" placeholder="Student name, discount type">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Discount Type</label>
                            <select class="form-control">
                                <option value="">All Types</option>
                                <option value="sibling">Sibling Discount</option>
                                <option value="merit">Merit Scholarship</option>
                                <option value="staff">Staff Child</option>
                                <option value="orphan">Orphan Student</option>
                                <option value="needy">Needy Student</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="expired">Expired</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Academic Year</label>
                            <select class="form-control">
                                <option value="">2024-2025</option>
                                <option value="2023-2024">2023-2024</option>
                                <option value="2022-2023">2022-2023</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary btn-block">
                                <i class="las la-filter mr-2"></i>Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Discounts Table -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Active Discounts</h5>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                            data-toggle="dropdown">
                        <i class="las la-download mr-2"></i>Export
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="las la-file-pdf mr-2"></i> Export as PDF</a>
                        <a class="dropdown-item" href="#"><i class="las la-file-excel mr-2"></i> Export as Excel</a>
                        <a class="dropdown-item" href="#"><i class="las la-print mr-2"></i> Print Report</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Discount Type</th>
                                <th>Amount</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Applied On</th>
                                <th>Approved By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Discount 1 -->
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Emma+Wilson&background=007bff&color=fff&size=30" 
                                             class="rounded-circle mr-3" alt="Emma Wilson">
                                        <div>
                                            <h6 class="mb-0">Emma Wilson</h6>
                                            <small class="text-muted">Class 2-A | Sibling</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">Sibling Discount</span>
                                </td>
                                <td>
                                    <div class="discount-amount text-success">PKR 900</div>
                                    <small class="text-muted">(15% monthly)</small>
                                </td>
                                <td>01 Aug 2024</td>
                                <td>31 May 2025</td>
                                <td>
                                    <div>Tuition Fee</div>
                                    <small class="text-muted">All months</small>
                                </td>
                                <td>
                                    <div>Mr. Ali Khan</div>
                                    <small class="text-muted">Principal</small>
                                </td>
                                <td>
                                    <span class="discount-badge" style="background-color: #d4edda; color: #155724;">
                                        Active
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                data-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit-discount" href="#">
                                                <i class="las la-edit mr-2"></i> Edit
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-eye mr-2"></i> View Details
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-file-invoice-dollar mr-2"></i> Apply to Invoice
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">
                                                <i class="las la-times-circle mr-2"></i> Revoke
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Discount 2 -->
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=James+Brown&background=28a745&color=fff&size=30" 
                                             class="rounded-circle mr-3" alt="James Brown">
                                        <div>
                                            <h6 class="mb-0">James Brown</h6>
                                            <small class="text-muted">Class 5-B | Merit</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Merit Scholarship</span>
                                </td>
                                <td>
                                    <div class="discount-amount text-success">PKR 1,000</div>
                                    <small class="text-muted">(25% monthly)</small>
                                </td>
                                <td>01 Aug 2024</td>
                                <td>31 May 2025</td>
                                <td>
                                    <div>Tuition Fee</div>
                                    <small class="text-muted">All months</small>
                                </td>
                                <td>
                                    <div>Ms. Sarah Smith</div>
                                    <small class="text-muted">Director</small>
                                </td>
                                <td>
                                    <span class="discount-badge" style="background-color: #d4edda; color: #155724;">
                                        Active
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                data-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit-discount" href="#">
                                                <i class="las la-edit mr-2"></i> Edit
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-eye mr-2"></i> View Details
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Discount 3 -->
                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Olivia+Taylor&background=ffc107&color=000&size=30" 
                                             class="rounded-circle mr-3" alt="Olivia Taylor">
                                        <div>
                                            <h6 class="mb-0">Olivia Taylor</h6>
                                            <small class="text-muted">Class 3-A | Staff Child</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Staff Child</span>
                                </td>
                                <td>
                                    <div class="discount-amount text-success">PKR 2,000</div>
                                    <small class="text-muted">(50% monthly)</small>
                                </td>
                                <td>01 Aug 2024</td>
                                <td>31 May 2025</td>
                                <td>
                                    <div>All Fees</div>
                                    <small class="text-muted">Except transport</small>
                                </td>
                                <td>
                                    <div>Mr. Ahmed Raza</div>
                                    <small class="text-muted">Manager</small>
                                </td>
                                <td>
                                    <span class="discount-badge" style="background-color: #d4edda; color: #155724;">
                                        Active
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                data-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit-discount" href="#">
                                                <i class="las la-edit mr-2"></i> Edit
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-eye mr-2"></i> View Details
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Discount 4 (Orphan) -->
                            <tr>
                                <td>4</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Noah+Miller&background=dc3545&color=fff&size=30" 
                                             class="rounded-circle mr-3" alt="Noah Miller">
                                        <div>
                                            <h6 class="mb-0">Noah Miller</h6>
                                            <small class="text-muted">Class 1-A | Orphan</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-danger">Orphan Student</span>
                                </td>
                                <td>
                                    <div class="discount-amount text-success">PKR 6,300</div>
                                    <small class="text-muted">(100% monthly)</small>
                                </td>
                                <td>01 Aug 2024</td>
                                <td>31 May 2025</td>
                                <td>
                                    <div>All Fees</div>
                                    <small class="text-muted">Complete waiver</small>
                                </td>
                                <td>
                                    <div>Ms. Fatima Ahmed</div>
                                    <small class="text-muted">Trustee</small>
                                </td>
                                <td>
                                    <span class="discount-badge" style="background-color: #d4edda; color: #155724;">
                                        Active
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                data-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit-discount" href="#">
                                                <i class="las la-edit mr-2"></i> Edit
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-eye mr-2"></i> View Details
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Discount 5 (Needy) -->
                            <tr>
                                <td>5</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Ava+Johnson&background=6c757d&color=fff&size=30" 
                                             class="rounded-circle mr-3" alt="Ava Johnson">
                                        <div>
                                            <h6 class="mb-0">Ava Johnson</h6>
                                            <small class="text-muted">Class 4-B | Needy</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">Needy Student</span>
                                </td>
                                <td>
                                    <div class="discount-amount text-success">PKR 1,500</div>
                                    <small class="text-muted">(30% monthly)</small>
                                </td>
                                <td>01 Aug 2024</td>
                                <td>31 Dec 2024</td>
                                <td>
                                    <div>Tuition Fee</div>
                                    <small class="text-muted">Aug-Dec 2024</small>
                                </td>
                                <td>
                                    <div>Mr. Imran Khan</div>
                                    <small class="text-muted">Administrator</small>
                                </td>
                                <td>
                                    <span class="discount-badge" style="background-color: #fff3cd; color: #856404;">
                                        Expiring Soon
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                data-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit-discount" href="#">
                                                <i class="las la-edit mr-2"></i> Edit
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-redo mr-2"></i> Renew
                                            </a>
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

        <!-- Discount Summary -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Discount Summary - Academic Year 2024-2025</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Discount Type</th>
                                        <th>Number of Students</th>
                                        <th>Monthly Amount</th>
                                        <th>Annual Amount</th>
                                        <th>Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sibling Discount</td>
                                        <td>25</td>
                                        <td>PKR 22,500</td>
                                        <td>PKR 225,000</td>
                                        <td>36%</td>
                                    </tr>
                                    <tr>
                                        <td>Merit Scholarship</td>
                                        <td>10</td>
                                        <td>PKR 10,000</td>
                                        <td>PKR 100,000</td>
                                        <td>16%</td>
                                    </tr>
                                    <tr>
                                        <td>Staff Child</td>
                                        <td>8</td>
                                        <td>PKR 16,000</td>
                                        <td>PKR 160,000</td>
                                        <td>26%</td>
                                    </tr>
                                    <tr>
                                        <td>Orphan Student</td>
                                        <td>5</td>
                                        <td>PKR 31,500</td>
                                        <td>PKR 315,000</td>
                                        <td>14%</td>
                                    </tr>
                                    <tr>
                                        <td>Needy Student</td>
                                        <td>7</td>
                                        <td>PKR 10,500</td>
                                        <td>PKR 105,000</td>
                                        <td>8%</td>
                                    </tr>
                                    <tr class="table-success">
                                        <td><strong>Total</strong></td>
                                        <td><strong>55</strong></td>
                                        <td><strong>PKR 90,500</strong></td>
                                        <td><strong>PKR 905,000</strong></td>
                                        <td><strong>100%</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body discount-actions">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#addDiscountModal">
                                    <i class="las la-plus-circle mr-2"></i> Create New Discount
                                </button>
                            </div>
                            <div class="col-12 mb-3">
                                <button class="btn btn-success btn-block" data-toggle="modal" data-target="#applyDiscountModal">
                                    <i class="las la-user-check mr-2"></i> Apply to Student
                                </button>
                            </div>
                            <div class="col-12 mb-3">
                                <button class="btn btn-info btn-block">
                                    <i class="las la-file-export mr-2"></i> Export Report
                                </button>
                            </div>
                            <div class="col-12 mb-3">
                                <button class="btn btn-warning btn-block">
                                    <i class="las la-bell mr-2"></i> Expiry Alerts
                                </button>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-danger btn-block">
                                    <i class="las la-chart-pie mr-2"></i> View Analytics
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Discount Modal -->
    <div class="modal fade" id="addDiscountModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Discount</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addDiscountForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount Name *</label>
                                    <input type="text" class="form-control" placeholder="e.g., Sibling Discount, Merit Scholarship" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount Code *</label>
                                    <input type="text" class="form-control" placeholder="e.g., SIB-15, MERIT-25" required>
                                    <small class="form-text text-muted">Unique code for this discount</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount Type *</label>
                                    <select class="form-control" required>
                                        <option value="">Select Type</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed">Fixed Amount</option>
                                        <option value="full">Full Waiver</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount Value *</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" placeholder="Value" required min="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Applicable Fee Types</label>
                                    <select class="form-control" multiple>
                                        <option value="tuition">Tuition Fee</option>
                                        <option value="admission">Admission Fee</option>
                                        <option value="exam">Exam Fee</option>
                                        <option value="transport">Transport Fee</option>
                                        <option value="computer">Computer Fee</option>
                                        <option value="sports">Sports Fee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Applicable Classes</label>
                                    <select class="form-control" multiple>
                                        <option value="all">All Classes</option>
                                        <option value="playgroup">Play Group</option>
                                        <option value="nursery">Nursery</option>
                                        <option value="class1">Class 1</option>
                                        <option value="class2">Class 2</option>
                                        <option value="class3">Class 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date *</label>
                                    <input type="date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" class="form-control">
                                    <small class="form-text text-muted">Leave empty for no expiration</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Description of discount criteria and terms"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Terms & Conditions</label>
                                    <textarea class="form-control" rows="2" placeholder="Terms and conditions for availing this discount"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="requiresApproval" checked>
                                        <label class="custom-control-label" for="requiresApproval">
                                            Requires Approval
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="isActiveDiscount" checked>
                                        <label class="custom-control-label" for="isActiveDiscount">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveDiscount">
                        <i class="las la-save mr-2"></i> Save Discount
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Apply Discount Modal -->
    <div class="modal fade" id="applyDiscountModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Apply Discount to Student</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="applyDiscountForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Student *</label>
                                    <select class="form-control" required>
                                        <option value="">Select Student</option>
                                        <option value="1">Alex Johnson (Class 1-A)</option>
                                        <option value="2">Sofia Williams (Class 1-A)</option>
                                        <option value="3">Ethan Brown (Class 1-A)</option>
                                        <option value="4">Mia Davis (Class 1-A)</option>
                                        <option value="5">Noah Miller (Class 1-A)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount *</label>
                                    <select class="form-control" required>
                                        <option value="">Select Discount</option>
                                        <option value="sibling">Sibling Discount (15%)</option>
                                        <option value="merit">Merit Scholarship (25%)</option>
                                        <option value="staff">Staff Child (50%)</option>
                                        <option value="orphan">Orphan Student (100%)</option>
                                        <option value="needy">Needy Student (30%)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Effective Date *</label>
                                    <input type="date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Valid Until</label>
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Applicable Fees</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="feeTuition" checked>
                                                <label class="custom-control-label" for="feeTuition">Tuition Fee</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="feeExam" checked>
                                                <label class="custom-control-label" for="feeExam">Exam Fee</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="feeTransport">
                                                <label class="custom-control-label" for="feeTransport">Transport Fee</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="feeComputer">
                                                <label class="custom-control-label" for="feeComputer">Computer Fee</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Reason/Justification *</label>
                                    <textarea class="form-control" rows="3" placeholder="Reason for granting this discount" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Approved By</label>
                                    <input type="text" class="form-control" placeholder="Name of approver">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Approval Date</label>
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6>Discount Preview</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-1">Student: <strong id="previewStudent">Not selected</strong></p>
                                                <p class="mb-1">Discount: <strong id="previewDiscount">Not selected</strong></p>
                                                <p class="mb-0">Monthly Saving: <strong id="previewSaving" class="text-success">PKR 0</strong></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-1">Annual Saving: <strong id="previewAnnual" class="text-success">PKR 0</strong></p>
                                                <p class="mb-1">Effective Period: <strong id="previewPeriod">Not set</strong></p>
                                                <p class="mb-0">Status: <span id="previewStatus" class="badge badge-warning">Pending</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="applyDiscount">
                        <i class="las la-check mr-2"></i> Apply Discount
                    </button>
                    <button type="button" class="btn btn-success" id="applyAndApprove">
                        <i class="las la-check-double mr-2"></i> Apply & Approve
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Discounts Script -->
    <script>
        $(document).ready(function() {
            // Set default dates
            const today = new Date();
            const nextYear = new Date(today);
            nextYear.setFullYear(today.getFullYear() + 1);
            
            $('input[type="date"]').each(function() {
                if ($(this).attr('id') !== 'endDate' && !$(this).val()) {
                    $(this).val(today.toISOString().split('T')[0]);
                }
            });
            
            // Save discount
            $('#saveDiscount').click(function() {
                const form = $('#addDiscountForm');
                if (form[0].checkValidity()) {
                    const btn = $(this);
                    const originalText = btn.html();
                    btn.html('<i class="las la-spinner la-spin mr-2"></i>Saving...').prop('disabled', true);
                    
                    setTimeout(function() {
                        btn.html(originalText).prop('disabled', false);
                        $('#addDiscountModal').modal('hide');
                        form[0].reset();
                        alert('Discount created successfully!');
                    }, 1500);
                } else {
                    form[0].reportValidity();
                }
            });
            
            // Apply discount
            $('#applyDiscount').click(function() {
                const form = $('#applyDiscountForm');
                if (form[0].checkValidity()) {
                    const btn = $(this);
                    const originalText = btn.html();
                    btn.html('<i class="las la-spinner la-spin mr-2"></i>Applying...').prop('disabled', true);
                    
                    setTimeout(function() {
                        btn.html(originalText).prop('disabled', false);
                        $('#applyDiscountModal').modal('hide');
                        form[0].reset();
                        alert('Discount applied successfully! Waiting for approval.');
                    }, 1500);
                } else {
                    form[0].reportValidity();
                }
            });
            
            // Apply and approve
            $('#applyAndApprove').click(function() {
                const form = $('#applyDiscountForm');
                if (form[0].checkValidity()) {
                    const btn = $(this);
                    const originalText = btn.html();
                    btn.html('<i class="las la-spinner la-spin mr-2"></i>Processing...').prop('disabled', true);
                    
                    setTimeout(function() {
                        btn.html(originalText).prop('disabled', false);
                        $('#applyDiscountModal').modal('hide');
                        form[0].reset();
                        alert('Discount applied and approved successfully!');
                    }, 1500);
                } else {
                    form[0].reportValidity();
                }
            });
            
            // Edit discount
            $('.edit-discount').click(function() {
                $('#editDiscountModal .modal-body').html(`
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p>Loading discount details...</p>
                    </div>
                `);
                
                // In real app, this would load data from backend
                setTimeout(function() {
                    $('#editDiscountModal .modal-body').html(`
                        <form id="editDiscountForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discount Name</label>
                                        <input type="text" class="form-control" value="Sibling Discount" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discount Value</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" value="15" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Valid Until</label>
                                        <input type="date" class="form-control" value="2025-05-31">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea class="form-control" rows="3">Discount for sibling of existing student</textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    `);
                }, 1000);
                
                $('#editDiscountModal').modal('show');
            });
            
            // Discount preview calculation
            $('select').on('change', function() {
                updateDiscountPreview();
            });
            
            $('input[type="date"]').on('change', function() {
                updateDiscountPreview();
            });
            
            function updateDiscountPreview() {
                const student = $('#applyDiscountForm select').eq(0).val();
                const discount = $('#applyDiscountForm select').eq(1).val();
                const startDate = $('#applyDiscountForm input[type="date"]').eq(0).val();
                const endDate = $('#applyDiscountForm input[type="date"]').eq(1).val();
                
                if (student) {
                    $('#previewStudent').text($('#applyDiscountForm select').eq(0).find('option:selected').text());
                }
                
                if (discount) {
                    $('#previewDiscount').text($('#applyDiscountForm select').eq(1).find('option:selected').text());
                    
                    // Calculate savings based on discount type
                    const discountValues = {
                        'sibling': { percent: 15, monthly: 900 },
                        'merit': { percent: 25, monthly: 1500 },
                        'staff': { percent: 50, monthly: 3000 },
                        'orphan': { percent: 100, monthly: 6300 },
                        'needy': { percent: 30, monthly: 1800 }
                    };
                    
                    if (discountValues[discount]) {
                        $('#previewSaving').text('PKR ' + discountValues[discount].monthly.toLocaleString());
                        $('#previewAnnual').text('PKR ' + (discountValues[discount].monthly * 10).toLocaleString());
                    }
                }
                
                if (startDate && endDate) {
                    $('#previewPeriod').text(startDate + ' to ' + endDate);
                } else if (startDate) {
                    $('#previewPeriod').text('From ' + startDate);
                }
            }
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
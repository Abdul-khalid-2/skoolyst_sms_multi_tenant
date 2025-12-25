<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .payment-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
        }
        
        .payment-method {
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .method-cash { background-color: #d4edda; color: #155724; }
        .method-bank { background-color: #cce5ff; color: #004085; }
        .method-card { background-color: #fff3cd; color: #856404; }
        .method-online { background-color: #d1ecf1; color: #0c5460; }
        
        .payment-actions .btn {
            min-width: 100px;
        }
        
        .receipt-preview {
            background: white;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Payment Tracking</h4>
                <p class="mb-0">Track and manage all fee payments</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Fees Management</a></li>
                        <li class="breadcrumb-item active">Payments</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#receivePaymentModal">
                    <i class="las la-money-bill-wave mr-2"></i>Receive Payment
                </button>
            </div>
        </div>

        <!-- Payment Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Collected</h6>
                                <h2 class="mb-0 text-white">PKR 1.2M</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-money-bill-wave fa-lg text-primary"></i>
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
                                <h6 class="text-white mb-0">This Month</h6>
                                <h2 class="mb-0 text-white">PKR 185K</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-calendar-alt fa-lg text-success"></i>
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
                                <h6 class="text-white mb-0">Today</h6>
                                <h2 class="mb-0 text-white">PKR 25K</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-calendar-day fa-lg text-info"></i>
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
                                <h6 class="text-white mb-0">Pending</h6>
                                <h2 class="mb-0 text-white">PKR 45K</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-clock fa-lg text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Search</label>
                            <input type="text" class="form-control" placeholder="Receipt #, Student Name">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Payment Method</label>
                            <select class="form-control">
                                <option value="">All Methods</option>
                                <option value="cash">Cash</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="card">Card</option>
                                <option value="online">Online</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Date From</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Date To</label>
                            <input type="date" class="form-control">
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

        <!-- Payments Table -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Recent Payments</h5>
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
                                <th>Receipt #</th>
                                <th>Date</th>
                                <th>Student</th>
                                <th>Invoice #</th>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>Received By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Payment 1 -->
                            <tr>
                                <td>
                                    <strong>RCPT-2024-001</strong>
                                </td>
                                <td>
                                    <div>15 Dec 2024</div>
                                    <small class="text-muted">10:30 AM</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Alex+Johnson&background=007bff&color=fff&size=30" 
                                             class="rounded-circle mr-3" alt="Alex Johnson">
                                        <div>
                                            <h6 class="mb-0">Alex Johnson</h6>
                                            <small class="text-muted">Class 1-A</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light">INV-2024-001</span>
                                </td>
                                <td>
                                    <span class="payment-method method-cash">Cash</span>
                                </td>
                                <td>
                                    <strong class="text-success">PKR 6,300</strong>
                                </td>
                                <td>
                                    <div>Ms. Sarah Smith</div>
                                    <small class="text-muted">Accountant</small>
                                </td>
                                <td>
                                    <span class="payment-status" style="background-color: #d4edda; color: #155724;">
                                        Completed
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                data-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item view-receipt" href="#">
                                                <i class="las la-eye mr-2"></i> View Receipt
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-download mr-2"></i> Download
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-print mr-2"></i> Print
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">
                                                <i class="las la-trash mr-2"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Payment 2 -->
                            <tr>
                                <td>
                                    <strong>RCPT-2024-002</strong>
                                </td>
                                <td>
                                    <div>15 Dec 2024</div>
                                    <small class="text-muted">11:45 AM</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Sofia+Williams&background=28a745&color=fff&size=30" 
                                             class="rounded-circle mr-3" alt="Sofia Williams">
                                        <div>
                                            <h6 class="mb-0">Sofia Williams</h6>
                                            <small class="text-muted">Class 1-A</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light">INV-2024-002</span>
                                </td>
                                <td>
                                    <span class="payment-method method-bank">Bank Transfer</span>
                                </td>
                                <td>
                                    <strong class="text-success">PKR 3,000</strong>
                                    <div><small class="text-warning">Partial</small></div>
                                </td>
                                <td>
                                    <div>Mr. Ali Khan</div>
                                    <small class="text-muted">Cashier</small>
                                </td>
                                <td>
                                    <span class="payment-status" style="background-color: #d4edda; color: #155724;">
                                        Completed
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                data-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item view-receipt" href="#">
                                                <i class="las la-eye mr-2"></i> View Receipt
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-download mr-2"></i> Download
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-print mr-2"></i> Print
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Payment 3 -->
                            <tr>
                                <td>
                                    <strong>RCPT-2024-003</strong>
                                </td>
                                <td>
                                    <div>14 Dec 2024</div>
                                    <small class="text-muted">02:15 PM</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Mia+Davis&background=dc3545&color=fff&size=30" 
                                             class="rounded-circle mr-3" alt="Mia Davis">
                                        <div>
                                            <h6 class="mb-0">Mia Davis</h6>
                                            <small class="text-muted">Class 1-A</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light">INV-2024-004</span>
                                </td>
                                <td>
                                    <span class="payment-method method-card">Card</span>
                                </td>
                                <td>
                                    <strong class="text-success">PKR 8,300</strong>
                                </td>
                                <td>
                                    <div>Ms. Fatima Ahmed</div>
                                    <small class="text-muted">Accountant</small>
                                </td>
                                <td>
                                    <span class="payment-status" style="background-color: #d4edda; color: #155724;">
                                        Completed
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                data-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item view-receipt" href="#">
                                                <i class="las la-eye mr-2"></i> View Receipt
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-download mr-2"></i> Download
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-print mr-2"></i> Print
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Payment 4 (Online) -->
                            <tr>
                                <td>
                                    <strong>RCPT-2024-004</strong>
                                </td>
                                <td>
                                    <div>13 Dec 2024</div>
                                    <small class="text-muted">09:30 AM</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Noah+Miller&background=6c757d&color=fff&size=30" 
                                             class="rounded-circle mr-3" alt="Noah Miller">
                                        <div>
                                            <h6 class="mb-0">Noah Miller</h6>
                                            <small class="text-muted">Class 1-A</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light">INV-2024-005</span>
                                </td>
                                <td>
                                    <span class="payment-method method-online">Online</span>
                                </td>
                                <td>
                                    <strong class="text-success">PKR 3,000</strong>
                                </td>
                                <td>
                                    <div>System</div>
                                    <small class="text-muted">Auto-generated</small>
                                </td>
                                <td>
                                    <span class="payment-status" style="background-color: #d4edda; color: #155724;">
                                        Completed
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                data-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item view-receipt" href="#">
                                                <i class="las la-eye mr-2"></i> View Receipt
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-download mr-2"></i> Download
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-print mr-2"></i> Print
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Payment 5 (Pending - Bank Transfer) -->
                            <tr class="table-warning">
                                <td>
                                    <strong>RCPT-2024-005</strong>
                                </td>
                                <td>
                                    <div>12 Dec 2024</div>
                                    <small class="text-muted">03:45 PM</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Liam+Taylor&background=6610f2&color=fff&size=30" 
                                             class="rounded-circle mr-3" alt="Liam Taylor">
                                        <div>
                                            <h6 class="mb-0">Liam Taylor</h6>
                                            <small class="text-muted">Class 2-A</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light">INV-2024-006</span>
                                </td>
                                <td>
                                    <span class="payment-method method-bank">Bank Transfer</span>
                                </td>
                                <td>
                                    <strong class="text-warning">PKR 4,500</strong>
                                </td>
                                <td>
                                    <div>Pending</div>
                                    <small class="text-muted">Awaiting confirmation</small>
                                </td>
                                <td>
                                    <span class="payment-status" style="background-color: #fff3cd; color: #856404;">
                                        Pending
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                data-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-check-circle mr-2"></i> Confirm
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-times-circle mr-2"></i> Reject
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-envelope mr-2"></i> Send Reminder
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

        <!-- Payment Summary -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Payment Summary - December 2024</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Payment Method</th>
                                        <th>Number of Payments</th>
                                        <th>Total Amount</th>
                                        <th>Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Cash</td>
                                        <td>85</td>
                                        <td>PKR 525,000</td>
                                        <td>65%</td>
                                    </tr>
                                    <tr>
                                        <td>Bank Transfer</td>
                                        <td>25</td>
                                        <td>PKR 175,000</td>
                                        <td>22%</td>
                                    </tr>
                                    <tr>
                                        <td>Card</td>
                                        <td>10</td>
                                        <td>PKR 75,000</td>
                                        <td>9%</td>
                                    </tr>
                                    <tr>
                                        <td>Online</td>
                                        <td>5</td>
                                        <td>PKR 25,000</td>
                                        <td>4%</td>
                                    </tr>
                                    <tr class="table-success">
                                        <td><strong>Total</strong></td>
                                        <td><strong>125</strong></td>
                                        <td><strong>PKR 800,000</strong></td>
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
                    <div class="card-body payment-actions">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#receivePaymentModal">
                                    <i class="las la-money-bill-wave mr-2"></i> Receive Payment
                                </button>
                            </div>
                            <div class="col-12 mb-3">
                                <button class="btn btn-success btn-block">
                                    <i class="las la-file-export mr-2"></i> Export Report
                                </button>
                            </div>
                            <div class="col-12 mb-3">
                                <button class="btn btn-info btn-block">
                                    <i class="las la-print mr-2"></i> Print Today's Report
                                </button>
                            </div>
                            <div class="col-12 mb-3">
                                <button class="btn btn-warning btn-block">
                                    <i class="las la-envelope mr-2"></i> Send Reminders
                                </button>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-danger btn-block">
                                    <i class="las la-trash mr-2"></i> Delete Old Records
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Receipt Preview -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Receipt Preview</h5>
            </div>
            <div class="card-body">
                <div class="receipt-preview">
                    <div class="text-center mb-4">
                        <h3 class="text-primary">OFFICIAL RECEIPT</h3>
                        <h5 class="mb-0">Bright Future School</h5>
                        <p class="mb-1">123 Education Street, Lahore, Pakistan</p>
                        <p class="mb-0">Phone: +92 42 1234567 | GST: 1234567890</p>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Receipt No:</strong> RCPT-2024-001</p>
                            <p class="mb-1"><strong>Date:</strong> 15 December 2024</p>
                            <p class="mb-1"><strong>Time:</strong> 10:30 AM</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p class="mb-1"><strong>Invoice No:</strong> INV-2024-001</p>
                            <p class="mb-1"><strong>Academic Year:</strong> 2024-2025</p>
                            <p class="mb-1"><strong>Status:</strong> <span class="text-success">PAID</span></p>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Received From:</h6>
                            <p class="mb-1"><strong>Mr. Robert Johnson</strong></p>
                            <p class="mb-1">123 Main Street, Garden Town, Lahore</p>
                            <p class="mb-0">Phone: +92 300 1234567</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Student:</h6>
                            <p class="mb-1"><strong>Alex Johnson</strong></p>
                            <p class="mb-1"><strong>Class 1 - Section A</strong></p>
                            <p class="mb-0"><strong>Roll No:</strong> 1-A-01</p>
                        </div>
                    </div>
                    
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tuition Fee - December 2024</td>
                                    <td class="text-right">PKR 3,000</td>
                                </tr>
                                <tr>
                                    <td>Transport Fee - December 2024</td>
                                    <td class="text-right">PKR 2,000</td>
                                </tr>
                                <tr>
                                    <td>Exam Fee - Term 2</td>
                                    <td class="text-right">PKR 1,000</td>
                                </tr>
                                <tr>
                                    <td>Computer Lab Fee - December 2024</td>
                                    <td class="text-right">PKR 500</td>
                                </tr>
                                <tr>
                                    <td>Sports Fee - December 2024</td>
                                    <td class="text-right">PKR 300</td>
                                </tr>
                                <tr class="table-success">
                                    <td class="text-right"><strong>TOTAL RECEIVED</strong></td>
                                    <td class="text-right"><strong>PKR 6,800</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Payment Method:</strong> Cash</p>
                            <p class="mb-1"><strong>Received By:</strong> Ms. Sarah Smith</p>
                            <p class="mb-0"><strong>Designation:</strong> Accountant</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="mt-4 pt-2">
                                <p class="mb-0"><strong>Signature:</strong></p>
                                <div class="border-top mt-2 pt-2" style="width: 200px; margin-left: auto;">
                                    <p class="mb-0 text-center">Authorized Signature</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4 pt-4 border-top">
                        <p class="mb-2 text-muted">This is a computer generated receipt. No signature required.</p>
                        <p class="mb-0 text-muted">Thank you for your payment!</p>
                    </div>
                </div>
                
                <!-- Receipt Actions -->
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <button class="btn btn-primary btn-block">
                            <i class="las la-print mr-2"></i> Print Receipt
                        </button>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button class="btn btn-success btn-block">
                            <i class="las la-download mr-2"></i> Download PDF
                        </button>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button class="btn btn-info btn-block">
                            <i class="las la-share-alt mr-2"></i> Share Receipt
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Receive Payment Modal -->
    <div class="modal fade" id="receivePaymentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Receive Payment</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="receivePaymentForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Student *</label>
                                    <select class="form-control" id="paymentStudent" required>
                                        <option value="">Select Student</option>
                                        <option value="1">Alex Johnson (Class 1-A) - Balance: PKR 0</option>
                                        <option value="2">Sofia Williams (Class 1-A) - Balance: PKR 3,300</option>
                                        <option value="3">Ethan Brown (Class 1-A) - Balance: PKR 6,615</option>
                                        <option value="4">Mia Davis (Class 1-A) - Balance: PKR 0</option>
                                        <option value="5">Noah Miller (Class 1-A) - Balance: PKR 6,300</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment Date *</label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                                                        </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Invoice Number</label>
                                    <select class="form-control" id="invoiceSelect">
                                        <option value="">Select Invoice</option>
                                        <option value="INV-2024-002">INV-2024-002 (Balance: PKR 3,300)</option>
                                        <option value="INV-2024-003">INV-2024-003 (Balance: PKR 6,615)</option>
                                        <option value="INV-2024-005">INV-2024-005 (Balance: PKR 6,300)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment Method *</label>
                                    <select class="form-control" required>
                                        <option value="">Select Method</option>
                                        <option value="cash">Cash</option>
                                        <option value="bank">Bank Transfer</option>
                                        <option value="card">Card</option>
                                        <option value="online">Online Payment</option>
                                        <option value="cheque">Cheque</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount Received *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PKR</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Enter amount" required min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Transaction ID/Reference</label>
                                    <input type="text" class="form-control" placeholder="Bank ref, transaction ID, etc.">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Received By *</label>
                                    <input type="text" class="form-control" value="Ms. Sarah Smith" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea class="form-control" rows="3" placeholder="Additional payment notes"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6>Payment Summary</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-1">Outstanding Balance: <span id="outstandingBalance" class="text-danger font-weight-bold">PKR 0</span></p>
                                                <p class="mb-1">Amount Paying: <span id="payingAmount" class="font-weight-bold">PKR 0</span></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-1">Remaining Balance: <span id="remainingBalance" class="text-success font-weight-bold">PKR 0</span></p>
                                                <p class="mb-0">Payment Status: <span id="paymentStatus" class="badge badge-success">Full Payment</span></p>
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
                    <button type="button" class="btn btn-primary" id="savePayment">
                        <i class="las la-check mr-2"></i> Save Payment
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Receipt Modal -->
    <div class="modal fade" id="viewReceiptModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Receipt content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary print-receipt">
                        <i class="las la-print mr-2"></i> Print
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Payment Tracking Script -->
    <script>
        $(document).ready(function() {
            // Student selection for payment
            $('#paymentStudent').change(function() {
                const studentId = $(this).val();
                if (studentId) {
                    // In real app, fetch student's outstanding balance from backend
                    const balances = {
                        '1': 0,
                        '2': 3300,
                        '3': 6615,
                        '4': 0,
                        '5': 6300
                    };
                    
                    $('#outstandingBalance').text('PKR ' + balances[studentId].toLocaleString());
                    $('#remainingBalance').text('PKR ' + balances[studentId].toLocaleString());
                    
                    if (balances[studentId] > 0) {
                        $('#paymentStatus').removeClass('badge-success badge-warning')
                                          .addClass('badge-danger')
                                          .text('Pending Payment');
                    } else {
                        $('#paymentStatus').removeClass('badge-danger badge-warning')
                                          .addClass('badge-success')
                                          .text('No Dues');
                    }
                }
            });
            
            // Amount input change
            $('input[type="number"]').on('input', function() {
                const paying = parseFloat($(this).val()) || 0;
                const outstanding = parseFloat($('#outstandingBalance').text().replace(/[^\d.]/g, '')) || 0;
                const remaining = Math.max(0, outstanding - paying);
                
                $('#payingAmount').text('PKR ' + paying.toLocaleString());
                $('#remainingBalance').text('PKR ' + remaining.toLocaleString());
                
                if (remaining === 0 && paying > 0) {
                    $('#paymentStatus').removeClass('badge-danger badge-warning')
                                      .addClass('badge-success')
                                      .text('Full Payment');
                } else if (paying > 0 && remaining > 0) {
                    $('#paymentStatus').removeClass('badge-danger badge-success')
                                      .addClass('badge-warning')
                                      .text('Partial Payment');
                }
            });
            
            // Save payment
            $('#savePayment').click(function() {
                const form = $('#receivePaymentForm');
                if (form[0].checkValidity()) {
                    const btn = $(this);
                    const originalText = btn.html();
                    btn.html('<i class="las la-spinner la-spin mr-2"></i>Saving...').prop('disabled', true);
                    
                    setTimeout(function() {
                        btn.html(originalText).prop('disabled', false);
                        $('#receivePaymentModal').modal('hide');
                        form[0].reset();
                        alert('Payment recorded successfully! Receipt generated: RCPT-2024-006');
                    }, 1500);
                } else {
                    form[0].reportValidity();
                }
            });
            
            // View receipt
            $('.view-receipt').click(function(e) {
                e.preventDefault();
                $('#viewReceiptModal .modal-body').html(`
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p>Loading receipt...</p>
                    </div>
                `);
                
                $('#viewReceiptModal').modal('show');
                
                setTimeout(function() {
                    $('#viewReceiptModal .modal-body').html(`
                        <div class="receipt-preview">
                            <div class="text-center mb-4">
                                <h3 class="text-primary">PAYMENT RECEIPT</h3>
                                <h5 class="mb-0">Bright Future School</h5>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Receipt No:</strong> RCPT-2024-001</p>
                                    <p class="mb-1"><strong>Date:</strong> 15 Dec 2024</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p class="mb-1"><strong>Student:</strong> Alex Johnson</p>
                                    <p class="mb-1"><strong>Class:</strong> 1-A</p>
                                </div>
                            </div>
                            
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr><td>Amount Received</td><td class="text-right">PKR 6,800</td></tr>
                                        <tr><td>Payment Method</td><td class="text-right">Cash</td></tr>
                                        <tr class="table-success"><td><strong>TOTAL</strong></td><td class="text-right"><strong>PKR 6,800</strong></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="text-center mt-4 pt-4 border-top">
                                <p class="mb-2 text-muted">Thank you for your payment!</p>
                            </div>
                        </div>
                    `);
                }, 1000);
            });
            
            // Print receipt
            $(document).on('click', '.print-receipt', function() {
                window.print();
            });
            
            // Initialize date picker
            $('input[type="date"]').val(new Date().toISOString().split('T')[0]);
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
                            
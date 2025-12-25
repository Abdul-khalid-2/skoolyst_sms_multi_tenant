<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .invoice-preview {
            background: white;
            padding: 30px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .invoice-header {
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .invoice-table th {
            background-color: #f8f9fa;
        }
        
        .invoice-total {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 20px;
        }
        
        .invoice-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
        }
        
        .invoice-actions .btn {
            min-width: 120px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Invoice Generation</h4>
                <p class="mb-0">Generate and manage fee invoices for students</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Fees Management</a></li>
                        <li class="breadcrumb-item active">Invoices</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#generateInvoiceModal">
                    <i class="las la-file-invoice-dollar mr-2"></i>Generate Invoice
                </button>
            </div>
        </div>

        <!-- Invoice Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Invoices</h6>
                                <h2 class="mb-0 text-white">245</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-file-invoice fa-lg text-primary"></i>
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
                                <h6 class="text-white mb-0">Paid</h6>
                                <h2 class="mb-0 text-white">185</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-check-circle fa-lg text-success"></i>
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
                                <h2 class="mb-0 text-white">45</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-clock fa-lg text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Overdue</h6>
                                <h2 class="mb-0 text-white">15</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-exclamation-circle fa-lg text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoice Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Search Invoice</label>
                            <input type="text" class="form-control" placeholder="Invoice #, Student Name">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control">
                                <option value="">All Status</option>
                                <option value="paid">Paid</option>
                                <option value="pending">Pending</option>
                                <option value="overdue">Overdue</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Month</label>
                            <select class="form-control">
                                <option value="">All Months</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ $i == date('n') ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Class</label>
                            <select class="form-control">
                                <option value="">All Classes</option>
                                <option value="class1">Class 1</option>
                                <option value="class2">Class 2</option>
                                <option value="class3">Class 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary btn-block">
                                <i class="las la-search mr-2"></i>Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoices Table -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Recent Invoices</h5>
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
                                <th>Invoice #</th>
                                <th>Student</th>
                                <th>Class</th>
                                <th>Month</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Invoice 1 -->
                            <tr>
                                <td>
                                    <strong>INV-2024-001</strong>
                                    <div><small class="text-muted">15 Dec 2024</small></div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Alex+Johnson&background=007bff&color=fff&size=30" 
                                             class="rounded-circle mr-3" alt="Alex Johnson">
                                        <div>
                                            <h6 class="mb-0">Alex Johnson</h6>
                                            <small class="text-muted">Roll: 1-A-01</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">Class 1</span>
                                </td>
                                <td>December 2024</td>
                                <td>
                                    <div>05 Jan 2025</div>
                                    <small class="text-muted">In 20 days</small>
                                </td>
                                <td>
                                    <strong>PKR 6,300</strong>
                                </td>
                                <td>
                                    <strong class="text-success">PKR 6,300</strong>
                                </td>
                                <td>
                                    <strong class="text-success">PKR 0</strong>
                                </td>
                                <td>
                                    <span class="invoice-status" style="background-color: #d4edda; color: #155724;">
                                        Paid
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                data-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item view-invoice" href="#">
                                                <i class="las la-eye mr-2"></i> View Invoice
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-download mr-2"></i> Download PDF
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-print mr-2"></i> Print
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-envelope mr-2"></i> Send Reminder
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Invoice 2 -->
                            <tr>
                                <td>
                                    <strong>INV-2024-002</strong>
                                    <div><small class="text-muted">15 Dec 2024</small></div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Sofia+Williams&background=28a745&color=fff&size=30" 
                                             class="rounded-circle mr-3" alt="Sofia Williams">
                                        <div>
                                            <h6 class="mb-0">Sofia Williams</h6>
                                            <small class="text-muted">Roll: 1-A-02</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">Class 1</span>
                                </td>
                                <td>December 2024</td>
                                <td>
                                    <div>05 Jan 2025</div>
                                    <small class="text-muted">In 20 days</small>
                                </td>
                                <td>
                                    <strong>PKR 6,300</strong>
                                </td>
                                <td>
                                    <strong class="text-success">PKR 3,000</strong>
                                </td>
                                <td>
                                    <strong class="text-warning">PKR 3,300</strong>
                                </td>
                                <td>
                                    <span class="invoice-status" style="background-color: #fff3cd; color: #856404;">
                                        Partial
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                data-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item view-invoice" href="#">
                                                <i class="las la-eye mr-2"></i> View Invoice
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-download mr-2"></i> Download PDF
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-print mr-2"></i> Print
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-money-bill-wave mr-2"></i> Receive Payment
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Invoice 3 (Overdue) -->
                            <tr class="table-danger">
                                <td>
                                    <strong>INV-2024-003</strong>
                                    <div><small class="text-muted">15 Nov 2024</small></div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Ethan+Brown&background=ffc107&color=000&size=30" 
                                             class="rounded-circle mr-3" alt="Ethan Brown">
                                        <div>
                                            <h6 class="mb-0">Ethan Brown</h6>
                                            <small class="text-muted">Roll: 1-A-03</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">Class 1</span>
                                </td>
                                <td>November 2024</td>
                                <td>
                                    <div>05 Dec 2024</div>
                                    <small class="text-danger">Overdue by 10 days</small>
                                </td>
                                <td>
                                    <strong>PKR 6,300</strong>
                                </td>
                                <td>
                                    <strong class="text-danger">PKR 0</strong>
                                </td>
                                <td>
                                    <strong class="text-danger">PKR 6,300</strong>
                                    <div><small class="text-danger">+PKR 315 late fee</small></div>
                                </td>
                                <td>
                                    <span class="invoice-status" style="background-color: #f8d7da; color: #721c24;">
                                        Overdue
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                data-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item view-invoice" href="#">
                                                <i class="las la-eye mr-2"></i> View Invoice
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-download mr-2"></i> Download PDF
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-print mr-2"></i> Print
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-money-bill-wave mr-2"></i> Receive Payment
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-envelope mr-2"></i> Send Reminder
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Invoice 4 -->
                            <tr>
                                <td>
                                    <strong>INV-2024-004</strong>
                                    <div><small class="text-muted">15 Dec 2024</small></div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Mia+Davis&background=dc3545&color=fff&size=30" 
                                             class="rounded-circle mr-3" alt="Mia Davis">
                                        <div>
                                            <h6 class="mb-0">Mia Davis</h6>
                                            <small class="text-muted">Roll: 1-A-04</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">Class 1</span>
                                </td>
                                <td>December 2024</td>
                                <td>
                                    <div>05 Jan 2025</div>
                                    <small class="text-muted">In 20 days</small>
                                </td>
                                <td>
                                    <strong>PKR 8,300</strong>
                                    <div><small>With transport</small></div>
                                </td>
                                <td>
                                    <strong class="text-success">PKR 8,300</strong>
                                </td>
                                <td>
                                    <strong class="text-success">PKR 0</strong>
                                </td>
                                <td>
                                    <span class="invoice-status" style="background-color: #d4edda; color: #155724;">
                                        Paid
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                data-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item view-invoice" href="#">
                                                <i class="las la-eye mr-2"></i> View Invoice
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-download mr-2"></i> Download PDF
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-print mr-2"></i> Print
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Invoice 5 (Pending) -->
                            <tr class="table-warning">
                                <td>
                                    <strong>INV-2024-005</strong>
                                    <div><small class="text-muted">15 Dec 2024</small></div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Noah+Miller&background=6c757d&color=fff&size=30" 
                                             class="rounded-circle mr-3" alt="Noah Miller">
                                        <div>
                                            <h6 class="mb-0">Noah Miller</h6>
                                            <small class="text-muted">Roll: 1-A-05</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">Class 1</span>
                                </td>
                                <td>December 2024</td>
                                <td>
                                    <div>05 Jan 2025</div>
                                    <small class="text-muted">In 20 days</small>
                                </td>
                                <td>
                                    <strong>PKR 6,300</strong>
                                </td>
                                <td>
                                    <strong class="text-danger">PKR 0</strong>
                                </td>
                                <td>
                                    <strong class="text-warning">PKR 6,300</strong>
                                </td>
                                <td>
                                    <span class="invoice-status" style="background-color: #fff3cd; color: #856404;">
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
                                            <a class="dropdown-item view-invoice" href="#">
                                                <i class="las la-eye mr-2"></i> View Invoice
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-download mr-2"></i> Download PDF
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-print mr-2"></i> Print
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-money-bill-wave mr-2"></i> Receive Payment
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

        <!-- Invoice Preview -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Invoice Preview</h5>
            </div>
            <div class="card-body">
                <div class="invoice-preview">
                    <!-- Invoice Header -->
                    <div class="invoice-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="text-primary">INVOICE</h2>
                                <h5 class="mb-0">Bright Future School</h5>
                                <p class="mb-1">123 Education Street, Lahore, Pakistan</p>
                                <p class="mb-1">Phone: +92 42 1234567 | Email: info@brightfuture.edu</p>
                                <p class="mb-0">Website: www.brightfuture.edu.pk</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <h3 class="mb-0">INV-2024-001</h3>
                                <p class="mb-1"><strong>Issue Date:</strong> 15 December 2024</p>
                                <p class="mb-1"><strong>Due Date:</strong> 05 January 2025</p>
                                <p class="mb-0"><strong>Status:</strong> <span class="text-success">Paid</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Bill To -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Bill To:</h6>
                            <p class="mb-1"><strong>Mr. Robert Johnson</strong></p>
                            <p class="mb-1">123 Main Street, Garden Town, Lahore</p>
                            <p class="mb-1">Phone: +92 300 1234567</p>
                            <p class="mb-0">Email: robert@example.com</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Student Information:</h6>
                            <p class="mb-1"><strong>Alex Johnson</strong></p>
                            <p class="mb-1"><strong>Roll No:</strong> 1-A-01 | <strong>Class:</strong> 1 - Section A</p>
                            <p class="mb-1"><strong>Admission No:</strong> ADM-2024-001</p>
                            <p class="mb-0"><strong>Academic Year:</strong> 2024-2025</p>
                        </div>
                    </div>

                    <!-- Invoice Items -->
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered invoice-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Month</th>
                                    <th>Due Date</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Tuition Fee</td>
                                    <td>December 2024</td>
                                    <td>05 Jan 2025</td>
                                    <td class="text-right">PKR 3,000</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Transport Fee</td>
                                    <td>December 2024</td>
                                    <td>05 Jan 2025</td>
                                    <td class="text-right">PKR 2,000</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Computer Lab Fee</td>
                                    <td>December 2024</td>
                                    <td>05 Jan 2025</td>
                                    <td class="text-right">PKR 500</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Sports Fee</td>
                                    <td>December 2024</td>
                                    <td>05 Jan 2025</td>
                                    <td class="text-right">PKR 300</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Exam Fee (Term 2)</td>
                                    <td>December 2024</td>
                                    <td>05 Jan 2025</td>
                                    <td class="text-right">PKR 1,000</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Subtotal</strong></td>
                                    <td class="text-right"><strong>PKR 6,800</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Late Fee (0%)</strong></td>
                                    <td class="text-right"><strong>PKR 0</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Discount (0%)</strong></td>
                                    <td class="text-right"><strong>PKR 0</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Total</strong></td>
                                    <td class="text-right"><strong>PKR 6,800</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Amount Paid</strong></td>
                                    <td class="text-right"><strong>PKR 6,800</strong></td>
                                </tr>
                                <tr class="table-success">
                                    <td colspan="4" class="text-right"><strong>Balance Due</strong></td>
                                    <td class="text-right"><strong>PKR 0</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Payment Details -->
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Payment Details:</h6>
                            <p class="mb-1"><strong>Payment Method:</strong> Cash</p>
                            <p class="mb-1"><strong>Payment Date:</strong> 15 December 2024</p>
                            <p class="mb-1"><strong>Received By:</strong> Ms. Sarah Smith (Accountant)</p>
                            <p class="mb-0"><strong>Receipt No:</strong> RCPT-2024-001</p>
                        </div>
                        <div class="col-md-4">
                            <div class="invoice-total">
                                <h5 class="mb-3">Invoice Summary</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <span>PKR 6,800</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Late Fee:</span>
                                    <span>PKR 0</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Discount:</span>
                                    <span>PKR 0</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total:</span>
                                    <span><strong>PKR 6,800</strong></span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Paid:</span>
                                    <span class="text-success"><strong>PKR 6,800</strong></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Balance:</span>
                                    <span class="text-success"><strong>PKR 0</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="row mt-4 pt-4 border-top">
                        <div class="col-md-12 text-center">
                            <p class="mb-2"><strong>Thank you for your payment!</strong></p>
                            <p class="mb-0 text-muted">
                                This is a computer generated invoice. No signature required.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Invoice Actions -->
                <div class="row mt-4 invoice-actions">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <button class="btn btn-primary btn-block">
                            <i class="las la-print mr-2"></i> Print Invoice
                        </button>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <button class="btn btn-success btn-block">
                            <i class="las la-download mr-2"></i> Download PDF
                        </button>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <button class="btn btn-info btn-block">
                            <i class="las la-envelope mr-2"></i> Email Invoice
                        </button>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <button class="btn btn-warning btn-block">
                            <i class="las la-sms mr-2"></i> Send SMS
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Generate Invoice Modal -->
    <div class="modal fade" id="generateInvoiceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Generate New Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="generateInvoiceForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Student *</label>
                                    <select class="form-control" id="studentSelect" required>
                                        <option value="">Select Student</option>
                                        <option value="1">Alex Johnson (Class 1-A)</option>
                                        <option value="2">Sofia Williams (Class 1-A)</option>
                                        <option value="3">Ethan Brown (Class 1-A)</option>
                                        <option value="4">Mia Davis (Class 1-A)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Invoice Date *</label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Due Date *</label>
                                    <input type="date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Month *</label>
                                    <select class="form-control" required>
                                        <option value="">Select Month</option>
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ $i == date('n') ? 'selected' : '' }}>
                                                {{ date('F', mktime(0, 0, 0, $i, 1)) }} {{ date('Y') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h6 class="mb-3">Fee Items</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="50"><input type="checkbox" id="selectAllFees"></th>
                                                <th>Fee Type</th>
                                                <th>Amount</th>
                                                <th>Late Fee %</th>
                                                <th>Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="checkbox" class="fee-checkbox" checked></td>
                                                <td>Tuition Fee</td>
                                                <td>PKR 3,000</td>
                                                <td>5%</td>
                                                <td><input type="text" class="form-control form-control-sm" placeholder="Notes"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="fee-checkbox" checked></td>
                                                <td>Transport Fee</td>
                                                <td>PKR 2,000</td>
                                                <td>5%</td>
                                                <td><input type="text" class="form-control form-control-sm" placeholder="Notes"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="fee-checkbox"></td>
                                                <td>Computer Lab Fee</td>
                                                <td>PKR 500</td>
                                                <td>5%</td>
                                                <td><input type="text" class="form-control form-control-sm" placeholder="Notes"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="fee-checkbox"></td>
                                                <td>Sports Fee</td>
                                                <td>PKR 300</td>
                                                <td>5%</td>
                                                <td><input type="text" class="form-control form-control-sm" placeholder="Notes"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="fee-checkbox" checked></td>
                                                <td>Exam Fee</td>
                                                <td>PKR 1,000</td>
                                                <td>5%</td>
                                                <td><input type="text" class="form-control form-control-sm" placeholder="Notes"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount Type</label>
                                    <select class="form-control">
                                        <option value="">No Discount</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed">Fixed Amount</option>
                                        <option value="sibling">Sibling Discount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount Amount</label>
                                    <input type="number" class="form-control" min="0">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Notes (Optional)</label>
                                    <textarea class="form-control" rows="3" placeholder="Additional notes for invoice"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="generateInvoiceBtn">
                        <i class="las la-file-invoice-dollar mr-2"></i> Generate Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Invoice Modal -->
    <div class="modal fade" id="viewInvoiceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Invoice content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary print-invoice">
                        <i class="las la-print mr-2"></i> Print
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Invoice Generation Script -->
    <script>
        $(document).ready(function() {
            // Set default due date (30 days from today)
            const dueDate = new Date();
            dueDate.setDate(dueDate.getDate() + 30);
            $('#generateInvoiceForm input[type="date"]:last').val(dueDate.toISOString().split('T')[0]);
            
            // Select all fees checkbox
            $('#selectAllFees').change(function() {
                $('.fee-checkbox').prop('checked', $(this).prop('checked'));
            });
            
            // Generate invoice
            $('#generateInvoiceBtn').click(function() {
                const form = $('#generateInvoiceForm');
                if (form[0].checkValidity()) {
                    const btn = $(this);
                    const originalText = btn.html();
                    btn.html('<i class="las la-spinner la-spin mr-2"></i>Generating...').prop('disabled', true);
                    
                    setTimeout(function() {
                        btn.html(originalText).prop('disabled', false);
                        $('#generateInvoiceModal').modal('hide');
                        form[0].reset();
                        alert('Invoice generated successfully!');
                    }, 1500);
                } else {
                    form[0].reportValidity();
                }
            });
            
            // View invoice
            $('.view-invoice').click(function(e) {
                e.preventDefault();
                $('#viewInvoiceModal .modal-body').html(`
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p>Loading invoice...</p>
                    </div>
                `);
                
                $('#viewInvoiceModal').modal('show');
                
                setTimeout(function() {
                    $('#viewInvoiceModal .modal-body').html(`
                        <div class="invoice-preview">
                            <div class="invoice-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="text-primary">INVOICE</h2>
                                        <h5 class="mb-0">Bright Future School</h5>
                                        <p class="mb-1">123 Education Street, Lahore, Pakistan</p>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <h3 class="mb-0">INV-2024-001</h3>
                                        <p class="mb-1"><strong>Issue Date:</strong> 15 Dec 2024</p>
                                        <p class="mb-0"><strong>Status:</strong> <span class="text-success">Paid</span></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6>Bill To:</h6>
                                    <p class="mb-1"><strong>Mr. Robert Johnson</strong></p>
                                    <p class="mb-0">123 Main Street, Lahore</p>
                                </div>
                                <div class="col-md-6">
                                    <h6>Student:</h6>
                                    <p class="mb-1"><strong>Alex Johnson</strong></p>
                                    <p class="mb-0"><strong>Class 1 - Section A</strong></p>
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
                                        <tr><td>Tuition Fee - December 2024</td><td class="text-right">PKR 3,000</td></tr>
                                        <tr><td>Transport Fee - December 2024</td><td class="text-right">PKR 2,000</td></tr>
                                        <tr><td>Exam Fee - Term 2</td><td class="text-right">PKR 1,000</td></tr>
                                        <tr><td class="text-right"><strong>Total</strong></td><td class="text-right"><strong>PKR 6,000</strong></td></tr>
                                        <tr class="table-success"><td class="text-right"><strong>Paid</strong></td><td class="text-right"><strong>PKR 6,000</strong></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    `);
                }, 1000);
            });
            
            // Print invoice
            $(document).on('click', '.print-invoice', function() {
                window.print();
            });
            
            // Initialize date pickers
            const today = new Date();
            $('input[type="date"]').each(function() {
                if (!$(this).val()) {
                    $(this).val(today.toISOString().split('T')[0]);
                }
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
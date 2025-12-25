<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/apexcharts/dist/apexcharts.css') }}">
    <style>
        .report-card {
            border-left: 4px solid;
            transition: all 0.3s ease;
        }
        
        .report-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .card-revenue { border-left-color: #007bff; }
        .card-pending { border-left-color: #ffc107; }
        .card-collected { border-left-color: #28a745; }
        .card-discount { border-left-color: #6c757d; }
        
        .chart-container {
            height: 300px;
            position: relative;
        }
        
        .progress-report {
            height: 25px;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .report-table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        
        .export-options .btn {
            min-width: 150px;
            margin-bottom: 10px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Fee Reports & Analytics</h4>
                <p class="mb-0">Comprehensive fee reports and financial analytics</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Fees Management</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </nav>
            </div>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                    <i class="las la-download mr-2"></i>Export Reports
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"><i class="las la-file-pdf mr-2"></i> PDF Report</a>
                    <a class="dropdown-item" href="#"><i class="las la-file-excel mr-2"></i> Excel Report</a>
                    <a class="dropdown-item" href="#"><i class="las la-print mr-2"></i> Print Report</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="las la-chart-bar mr-2"></i> Analytics Dashboard</a>
                </div>
            </div>
        </div>

        <!-- Summary Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card report-card card-revenue h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">Total Revenue</h6>
                                <h2 class="mb-1 text-primary">PKR 1.2M</h2>
                                <p class="text-muted mb-0">Annual 2024-2025</p>
                            </div>
                            <div class="text-primary">
                                <i class="las la-chart-line fa-2x"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="text-success"><i class="las la-arrow-up mr-1"></i> 12.5%</span>
                            <span class="text-muted ml-2">vs last year</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card report-card card-collected h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">Collected This Month</h6>
                                <h2 class="mb-1 text-success">PKR 185K</h2>
                                <p class="text-muted mb-0">December 2024</p>
                            </div>
                            <div class="text-success">
                                <i class="las la-money-bill-wave fa-2x"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="progress progress-report">
                                <div class="progress-bar bg-success" style="width: 85%"></div>
                            </div>
                            <small class="text-muted">85% of target collected</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card report-card card-pending h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">Pending Payments</h6>
                                <h2 class="mb-1 text-warning">PKR 45K</h2>
                                <p class="text-muted mb-0">15 pending invoices</p>
                            </div>
                            <div class="text-warning">
                                <i class="las la-clock fa-2x"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="text-danger"><i class="las la-exclamation-circle mr-1"></i> Overdue: PKR 15K</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card report-card card-discount h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">Discounts Given</h6>
                                <h2 class="mb-1 text-secondary">PKR 25K</h2>
                                <p class="text-muted mb-0">This month</p>
                            </div>
                            <div class="text-secondary">
                                <i class="las la-percent fa-2x"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="text-info">45 students benefited</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Generate Custom Report</h5>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Report Type</label>
                            <select class="form-control" id="reportType">
                                <option value="monthly">Monthly Collection</option>
                                <option value="annual">Annual Summary</option>
                                <option value="classwise">Class-wise Collection</option>
                                <option value="feewise">Fee Type Analysis</option>
                                <option value="pending">Pending Payments</option>
                                <option value="discount">Discount Report</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Month</label>
                            <select class="form-control" id="reportMonth">
                                <option value="all">All Months</option>
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
                            <label>Academic Year</label>
                            <select class="form-control" id="reportYear">
                                <option value="2024-2025">2024-2025</option>
                                <option value="2023-2024">2023-2024</option>
                                <option value="2022-2023">2022-2023</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Class</label>
                            <select class="form-control" id="reportClass">
                                <option value="all">All Classes</option>
                                <option value="playgroup">Play Group</option>
                                <option value="nursery">Nursery</option>
                                <option value="class1">Class 1</option>
                                <option value="class2">Class 2</option>
                                <option value="class3">Class 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary btn-block" id="generateReport">
                                <i class="las la-chart-bar mr-2"></i> Generate Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Monthly Collection Trend</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div id="monthlyChart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Payment Methods Distribution</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div id="paymentMethodChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Reports -->
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Class-wise Collection</h5>
                        <span class="badge badge-primary">December 2024</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered report-table">
                                <thead>
                                    <tr>
                                        <th>Class</th>
                                        <th>Students</th>
                                        <th>Target</th>
                                        <th>Collected</th>
                                        <th>Pending</th>
                                        <th>% Collected</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Play Group</td>
                                        <td>20</td>
                                        <td>PKR 80,000</td>
                                        <td>PKR 72,000</td>
                                        <td>PKR 8,000</td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-success" style="width: 90%">90%</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nursery</td>
                                        <td>25</td>
                                        <td>PKR 100,000</td>
                                        <td>PKR 85,000</td>
                                        <td>PKR 15,000</td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-success" style="width: 85%">85%</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Class 1</td>
                                        <td>30</td>
                                        <td>PKR 180,000</td>
                                        <td>PKR 162,000</td>
                                        <td>PKR 18,000</td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-success" style="width: 90%">90%</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Class 2</td>
                                        <td>28</td>
                                        <td>PKR 168,000</td>
                                        <td>PKR 151,200</td>
                                        <td>PKR 16,800</td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-success" style="width: 90%">90%</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Class 3</td>
                                        <td>32</td>
                                        <td>PKR 192,000</td>
                                        <td>PKR 172,800</td>
                                        <td>PKR 19,200</td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-success" style="width: 90%">90%</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="table-success">
                                        <td><strong>Total</strong></td>
                                        <td><strong>135</strong></td>
                                        <td><strong>PKR 720,000</strong></td>
                                        <td><strong>PKR 648,000</strong></td>
                                        <td><strong>PKR 72,000</strong></td>
                                        <td><strong>90%</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Fee Type Analysis</h5>
                        <span class="badge badge-primary">December 2024</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered report-table">
                                <thead>
                                    <tr>
                                        <th>Fee Type</th>
                                        <th>Amount</th>
                                        <th>% of Total</th>
                                        <th>Growth</th>
                                        <th>Trend</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tuition Fee</td>
                                        <td>PKR 360,000</td>
                                        <td>50%</td>
                                        <td><span class="text-success">+8%</span></td>
                                        <td><i class="las la-arrow-up text-success"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Transport Fee</td>
                                        <td>PKR 144,000</td>
                                        <td>20%</td>
                                        <td><span class="text-success">+12%</span></td>
                                        <td><i class="las la-arrow-up text-success"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Exam Fee</td>
                                        <td>PKR 108,000</td>
                                        <td>15%</td>
                                        <td><span class="text-success">+5%</span></td>
                                        <td><i class="las la-arrow-up text-success"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Computer Fee</td>
                                        <td>PKR 54,000</td>
                                        <td>7.5%</td>
                                        <td><span class="text-success">+15%</span></td>
                                        <td><i class="las la-arrow-up text-success"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Sports Fee</td>
                                        <td>PKR 32,400</td>
                                        <td>4.5%</td>
                                        <td><span class="text-success">+10%</span></td>
                                        <td><i class="las la-arrow-up text-success"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Other Fees</td>
                                        <td>PKR 21,600</td>
                                        <td>3%</td>
                                        <td><span class="text-success">+8%</span></td>
                                        <td><i class="las la-arrow-up text-success"></i></td>
                                    </tr>
                                    <tr class="table-success">
                                        <td><strong>Total</strong></td>
                                        <td><strong>PKR 720,000</strong></td>
                                        <td><strong>100%</strong></td>
                                        <td><strong>+9%</strong></td>
                                        <td><i class="las la-arrow-up text-success"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Payments Report -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Pending Payments Report</h5>
                <button class="btn btn-sm btn-warning" id="sendReminders">
                    <i class="las la-envelope mr-2"></i> Send Reminders
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Class</th>
                                <th>Invoice #</th>
                                <th>Month</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                                <th>Days Overdue</th>
                                <th>Last Reminder</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-danger">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Ethan+Brown&background=dc3545&color=fff&size=30" 
                                             class="rounded-circle mr-3" alt="Ethan Brown">
                                        <div>
                                            <h6 class="mb-0">Ethan Brown</h6>
                                            <small class="text-muted">Roll: 1-A-03</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-info">Class 1</span></td>
                                <td><span class="badge badge-light">INV-2024-003</span></td>
                                <td>November 2024</td>
                                <td>05 Dec 2024</td>
                                <td><strong>PKR 6,615</strong></td>
                                <td><span class="badge badge-danger">10 days</span></td>
                                <td>10 Dec 2024</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">
                                        <i class="las la-phone mr-1"></i> Call
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-warning">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Noah+Miller&background=ffc107&color=000&size=30" 
                                             class="rounded-circle mr-3" alt="Noah Miller">
                                        <div>
                                            <h6 class="mb-0">Noah Miller</h6>
                                            <small class="text-muted">Roll: 1-A-05</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-info">Class 1</span></td>
                                <td><span class="badge badge-light">INV-2024-005</span></td>
                                <td>December 2024</td>
                                <td>05 Jan 2025</td>
                                <td><strong>PKR 6,300</strong></td>
                                <td><span class="badge badge-warning">Due soon</span></td>
                                <td>-</td>
                                <td>
                                    <button class="btn btn-sm btn-warning">
                                        <i class="las la-sms mr-1"></i> SMS
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-warning">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Liam+Taylor&background=ffc107&color=000&size=30" 
                                             class="rounded-circle mr-3" alt="Liam Taylor">
                                        <div>
                                            <h6 class="mb-0">Liam Taylor</h6>
                                            <small class="text-muted">Roll: 2-A-01</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-info">Class 2</span></td>
                                <td><span class="badge badge-light">INV-2024-006</span></td>
                                <td>December 2024</td>
                                <td>05 Jan 2025</td>
                                <td><strong>PKR 6,500</strong></td>
                                <td><span class="badge badge-warning">Due soon</span></td>
                                <td>-</td>
                                <td>
                                    <button class="btn btn-sm btn-warning">
                                        <i class="las la-sms mr-1"></i> SMS
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Export Options -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Export Reports</h5>
            </div>
            <div class="card-body">
                <div class="row export-options">
                    <div class="col-md-3 col-sm-6">
                        <button class="btn btn-outline-primary btn-block">
                            <i class="las la-file-pdf mr-2"></i> Monthly Report PDF
                        </button>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <button class="btn btn-outline-success btn-block">
                            <i class="las la-file-excel mr-2"></i> Annual Report Excel
                        </button>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <button class="btn btn-outline-info btn-block">
                            <i class="las la-chart-pie mr-2"></i> Analytics Dashboard
                        </button>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <button class="btn btn-outline-warning btn-block">
                            <i class="las la-print mr-2"></i> Print All Reports
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Apex Charts -->
    <script src="{{ asset('backend/assets/vendor/apexcharts/dist/apexcharts.js') }}"></script>
    
    <!-- Fee Reports Script -->
    <script>
        $(document).ready(function() {
            // Initialize monthly chart
            var monthlyOptions = {
                series: [{
                    name: 'Collection',
                    data: [65000, 72000, 68000, 75000, 82000, 78000, 85000, 92000, 88000, 95000, 90000, 185000]
                }],
                chart: {
                    type: 'area',
                    height: 300,
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                colors: ['#007bff'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.2,
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    labels: {
                        style: {
                            colors: '#6c757d'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return 'PKR ' + (value / 1000) + 'K';
                        },
                        style: {
                            colors: '#6c757d'
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return 'PKR ' + value.toLocaleString();
                        }
                    }
                }
            };

            var monthlyChart = new ApexCharts(document.querySelector("#monthlyChart"), monthlyOptions);
            monthlyChart.render();

            // Initialize payment method chart
            var paymentOptions = {
                series: [65, 22, 9, 4],
                chart: {
                    type: 'donut',
                    height: 300
                },
                colors: ['#28a745', '#007bff', '#ffc107', '#17a2b8'],
                labels: ['Cash', 'Bank Transfer', 'Card', 'Online'],
                legend: {
                    position: 'bottom'
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    formatter: function(w) {
                                        return 'PKR 800K'
                                    }
                                }
                            }
                        }
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 250
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var paymentChart = new ApexCharts(document.querySelector("#paymentMethodChart"), paymentOptions);
            paymentChart.render();

            // Generate report
            $('#generateReport').click(function() {
                const reportType = $('#reportType').val();
                const month = $('#reportMonth').val();
                const year = $('#reportYear').val();
                const classVal = $('#reportClass').val();
                
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Generating...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    
                    let reportName = '';
                    switch(reportType) {
                        case 'monthly':
                            reportName = 'Monthly Collection Report';
                            break;
                        case 'annual':
                            reportName = 'Annual Summary Report';
                            break;
                        case 'classwise':
                            reportName = 'Class-wise Collection Report';
                            break;
                        case 'feewise':
                            reportName = 'Fee Type Analysis Report';
                            break;
                        case 'pending':
                            reportName = 'Pending Payments Report';
                            break;
                        case 'discount':
                            reportName = 'Discount Report';
                            break;
                    }
                    
                    alert(`${reportName} generated successfully for ${month !== 'all' ? month + ' ' : ''}${year}${classVal !== 'all' ? ' - ' + classVal : ''}`);
                }, 1500);
            });
            
            // Send reminders
            $('#sendReminders').click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Sending...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert('Reminders sent successfully to 3 parents with pending payments!');
                }, 1500);
            });
            
            // Export buttons
            $('.export-options button').click(function() {
                const btnText = $(this).text();
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Processing...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert(btnText + ' downloaded successfully!');
                }, 1500);
            });
            
            // Update charts on window resize
            $(window).resize(function() {
                setTimeout(function() {
                    monthlyChart.update();
                    paymentChart.update();
                }, 500);
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
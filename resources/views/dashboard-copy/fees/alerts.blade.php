<!-- resources/views/modules/fees/alerts.blade.php -->
<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .alert-card {
            border-left: 4px solid;
            transition: all 0.3s ease;
        }
        
        .alert-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .card-due-today { border-left-color: #ffc107; }
        .card-overdue { border-left-color: #dc3545; }
        .card-upcoming { border-left-color: #17a2b8; }
        .card-reminder { border-left-color: #007bff; }
        
        .alert-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
        }
        
        .sms-template {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            font-family: monospace;
        }
        
        .notification-log {
            max-height: 300px;
            overflow-y: auto;
        }
        
        .log-entry {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .log-entry.success { background-color: #d4edda; }
        .log-entry.failed { background-color: #f8d7da; }
        .log-entry.pending { background-color: #fff3cd; }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Due Alerts & Reminders</h4>
                <p class="mb-0">Manage payment reminders and due date alerts</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Fees Management</a></li>
                        <li class="breadcrumb-item active">Due Alerts</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#sendBulkReminders">
                    <i class="las la-bullhorn mr-2"></i>Send Bulk Reminders
                </button>
                <button class="btn btn-success ml-2" data-toggle="modal" data-target="#configureAlerts">
                    <i class="las la-cog mr-2"></i>Configure Alerts
                </button>
            </div>
        </div>

        <!-- Alert Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card alert-card card-overdue h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">Overdue Payments</h6>
                                <h2 class="mb-1 text-danger">15</h2>
                                <p class="text-muted mb-0">PKR 45,000 total</p>
                            </div>
                            <div class="text-danger">
                                <i class="las la-exclamation-triangle fa-2x"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-sm btn-danger btn-block">
                                <i class="las la-envelope mr-2"></i> Send Alerts
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card alert-card card-due-today h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">Due Today</h6>
                                <h2 class="mb-1 text-warning">8</h2>
                                <p class="text-muted mb-0">PKR 25,000 total</p>
                            </div>
                            <div class="text-warning">
                                <i class="las la-calendar-day fa-2x"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-sm btn-warning btn-block">
                                <i class="las la-sms mr-2"></i> Send SMS
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card alert-card card-upcoming h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">Upcoming (7 days)</h6>
                                <h2 class="mb-1 text-info">32</h2>
                                <p class="text-muted mb-0">PKR 96,000 total</p>
                            </div>
                            <div class="text-info">
                                <i class="las la-clock fa-2x"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-sm btn-info btn-block">
                                <i class="las la-bell mr-2"></i> Schedule Alerts
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card alert-card card-reminder h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">Today's Reminders</h6>
                                <h2 class="mb-1 text-primary">45</h2>
                                <p class="text-muted mb-0">Sent successfully</p>
                            </div>
                            <div class="text-primary">
                                <i class="las la-check-circle fa-2x"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: 95%"></div>
                            </div>
                            <small class="text-muted">95% success rate</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Tabs -->
        <div class="card mb-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#overdue">
                            <i class="las la-exclamation-circle mr-2"></i>Overdue
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#dueToday">
                            <i class="las la-calendar-day mr-2"></i>Due Today
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#upcoming">
                            <i class="las la-clock mr-2"></i>Upcoming
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#sentAlerts">
                            <i class="las la-history mr-2"></i>Alert History
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!-- Overdue Tab -->
                    <div class="tab-pane fade show active" id="overdue">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Invoice #</th>
                                        <th>Due Date</th>
                                        <th>Days Overdue</th>
                                        <th>Amount</th>
                                        <th>Late Fee</th>
                                        <th>Last Alert</th>
                                        <th>Actions</th>
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
                                                    <small class="text-muted">Class 1-A</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-light">INV-2024-003</span></td>
                                        <td>05 Dec 2024</td>
                                        <td><span class="badge badge-danger">10 days</span></td>
                                        <td><strong>PKR 6,300</strong></td>
                                        <td><strong class="text-danger">PKR 315</strong></td>
                                        <td>10 Dec 2024</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-primary">
                                                    <i class="las la-sms"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning">
                                                    <i class="las la-envelope"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="las la-phone"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- More overdue entries... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Due Today Tab -->
                    <div class="tab-pane fade" id="dueToday">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Invoice #</th>
                                        <th>Due Date</th>
                                        <th>Amount</th>
                                        <th>Parent Contact</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-warning">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name=Alex+Johnson&background=ffc107&color=000&size=30" 
                                                     class="rounded-circle mr-3" alt="Alex Johnson">
                                                <div>
                                                    <h6 class="mb-0">Alex Johnson</h6>
                                                    <small class="text-muted">Class 1-A</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-light">INV-2024-007</span></td>
                                        <td>25 Dec 2024</td>
                                        <td><strong>PKR 6,300</strong></td>
                                        <td>
                                            <div>+92 300 1234567</div>
                                            <small>johnson@email.com</small>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning">
                                                <i class="las la-bell mr-1"></i> Remind
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- More due today entries... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Upcoming Tab -->
                    <div class="tab-pane fade" id="upcoming">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Invoice #</th>
                                        <th>Due Date</th>
                                        <th>Days Left</th>
                                        <th>Amount</th>
                                        <th>Schedule Alert</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name=Sofia+Williams&background=17a2b8&color=fff&size=30" 
                                                     class="rounded-circle mr-3" alt="Sofia Williams">
                                                <div>
                                                    <h6 class="mb-0">Sofia Williams</h6>
                                                    <small class="text-muted">Class 1-A</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-light">INV-2024-008</span></td>
                                        <td>05 Jan 2025</td>
                                        <td><span class="badge badge-info">11 days</span></td>
                                        <td><strong>PKR 3,300</strong></td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <select class="form-control">
                                                    <option value="1">1 day before</option>
                                                    <option value="3" selected>3 days before</option>
                                                    <option value="5">5 days before</option>
                                                    <option value="7">7 days before</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-info">Schedule</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- More upcoming entries... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Alert History Tab -->
                    <div class="tab-pane fade" id="sentAlerts">
                        <div class="notification-log">
                            <div class="log-entry success">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>SMS Sent</strong> to Mr. Robert Johnson
                                        <small class="d-block">Invoice: INV-2024-003 - PKR 6,615</small>
                                    </div>
                                    <div class="text-right">
                                        <small>24 Dec 2024 10:30 AM</small>
                                        <div class="text-success">Delivered</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="log-entry success">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>Email Sent</strong> to sofia.parent@email.com
                                        <small class="d-block">Reminder: Payment due in 3 days</small>
                                    </div>
                                    <div class="text-right">
                                        <small>24 Dec 2024 09:15 AM</small>
                                        <div class="text-success">Sent</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="log-entry failed">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>SMS Failed</strong> to Mr. Ethan Brown
                                        <small class="d-block">Invalid phone number</small>
                                    </div>
                                    <div class="text-right">
                                        <small>23 Dec 2024 02:45 PM</small>
                                        <div class="text-danger">Failed</div>
                                    </div>
                                </div>
                            </div>
                            <!-- More history entries... -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Configuration -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Alert Templates</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h6>SMS Template - Overdue</h6>
                                <div class="sms-template">
                                    Dear {parent_name},<br>
                                    Fee payment of PKR {amount} for {student_name} is overdue by {days_overdue} days.<br>
                                    Please pay immediately to avoid late fee.<br>
                                    Invoice: {invoice_number}<br>
                                    - {school_name}
                                </div>
                                <button class="btn btn-sm btn-primary">Edit Template</button>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <h6>SMS Template - Due Today</h6>
                                <div class="sms-template">
                                    Dear {parent_name},<br>
                                    Friendly reminder: Fee payment of PKR {amount} for {student_name} is due today.<br>
                                    Invoice: {invoice_number}<br>
                                    Due date: {due_date}<br>
                                    - {school_name}
                                </div>
                                <button class="btn btn-sm btn-primary">Edit Template</button>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <h6>Email Template - Upcoming</h6>
                                <div class="sms-template">
                                    Subject: Fee Payment Reminder - Due in {days_left} days<br><br>
                                    Dear {parent_name},<br><br>
                                    This is a reminder that the fee payment for {student_name} will be due on {due_date}.<br>
                                    Amount: PKR {amount}<br>
                                    Invoice: {invoice_number}<br><br>
                                    Please make the payment before the due date to avoid late fee.<br><br>
                                    Regards,<br>
                                    {school_name}
                                </div>
                                <button class="btn btn-sm btn-primary">Edit Template</button>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <h6>Email Template - Payment Confirmation</h6>
                                <div class="sms-template">
                                    Subject: Payment Received - Thank You<br><br>
                                    Dear {parent_name},<br><br>
                                    Thank you for your payment of PKR {amount} for {student_name}.<br>
                                    Receipt: {receipt_number}<br>
                                    Date: {payment_date}<br>
                                    Balance: PKR {balance}<br><br>
                                    Regards,<br>
                                    {school_name}
                                </div>
                                <button class="btn btn-sm btn-primary">Edit Template</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#sendBulkReminders">
                                    <i class="las la-bullhorn mr-2"></i> Send Bulk Reminders
                                </button>
                            </div>
                            <div class="col-12 mb-3">
                                <button class="btn btn-success btn-block">
                                    <i class="las la-sync mr-2"></i> Auto-send Due Today
                                </button>
                            </div>
                            <div class="col-12 mb-3">
                                <button class="btn btn-info btn-block">
                                    <i class="las la-phone mr-2"></i> Call Overdue Parents
                                </button>
                            </div>
                            <div class="col-12 mb-3">
                                <button class="btn btn-warning btn-block">
                                    <i class="las la-history mr-2"></i> View Alert Logs
                                </button>
                            </div>
                            <div class="col-12 mb-3">
                                <button class="btn btn-danger btn-block">
                                    <i class="las la-exclamation-triangle mr-2"></i> Emergency Alerts
                                </button>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h6>Alert Settings</h6>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="autoSMS" checked>
                                <label class="custom-control-label" for="autoSMS">Auto SMS for overdue</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="autoEmail" checked>
                                <label class="custom-control-label" for="autoEmail">Auto Email reminders</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="weekendAlerts">
                                <label class="custom-control-label" for="weekendAlerts">Send alerts on weekends</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Send Bulk Reminders Modal -->
    <div class="modal fade" id="sendBulkReminders" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send Bulk Reminders</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="bulkRemindersForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alert Type</label>
                                    <select class="form-control">
                                        <option value="overdue">Overdue Payments</option>
                                        <option value="due_today">Due Today</option>
                                        <option value="upcoming">Upcoming Payments</option>
                                        <option value="custom">Custom Selection</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Communication Method</label>
                                    <select class="form-control">
                                        <option value="sms">SMS Only</option>
                                        <option value="email">Email Only</option>
                                        <option value="both">SMS & Email</option>
                                        <option value="whatsapp">WhatsApp</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Message Template</label>
                                    <textarea class="form-control" rows="4">
Dear {parent_name},
Fee payment of PKR {amount} for {student_name} is {status}.
Due date: {due_date}
Invoice: {invoice_number}
Please pay at your earliest convenience.
- {school_name}
                                    </textarea>
                                    <small class="form-text text-muted">
                                        Available variables: {parent_name}, {student_name}, {amount}, {due_date}, {invoice_number}, {days_overdue}, {school_name}
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6>Recipients Summary</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-1">Total Students: <strong>15</strong></p>
                                                <p class="mb-1">Total Amount: <strong>PKR 45,000</strong></p>
                                                <p class="mb-0">SMS Cost: <strong>PKR 45</strong> (PKR 3 per SMS)</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-1">Emails: <strong>15</strong></p>
                                                <p class="mb-1">SMS: <strong>15</strong></p>
                                                <p class="mb-0">Estimated Time: <strong>2 minutes</strong></p>
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
                    <button type="button" class="btn btn-warning" id="testReminder">
                        <i class="las la-vial mr-2"></i> Test Send
                    </button>
                    <button type="button" class="btn btn-primary" id="sendReminders">
                        <i class="las la-paper-plane mr-2"></i> Send Reminders
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Configure Alerts Modal -->
    <div class="modal fade" id="configureAlerts" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Configure Alert Settings</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="configureAlertsForm">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>SMS Settings</h6>
                                <div class="form-group">
                                    <label>SMS Provider</label>
                                    <select class="form-control">
                                        <option value="telenor">Telenor</option>
                                        <option value="jazz">Jazz</option>
                                        <option value="zong">Zong</option>
                                        <option value="ufone">Ufone</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SMS Sender ID</label>
                                    <input type="text" class="form-control" value="BFSCHOOL">
                                </div>
                                <div class="form-group">
                                    <label>SMS Cost per Message</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PKR</span>
                                        </div>
                                        <input type="number" class="form-control" value="3.00" step="0.01">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h6>Email Settings</h6>
                                <div class="form-group">
                                    <label>SMTP Host</label>
                                    <input type="text" class="form-control" value="smtp.gmail.com">
                                </div>
                                <div class="form-group">
                                    <label>SMTP Port</label>
                                    <input type="number" class="form-control" value="587">
                                </div>
                                <div class="form-group">
                                    <label>From Email</label>
                                    <input type="email" class="form-control" value="accounts@brightfuture.edu.pk">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <h6 class="mt-3">Alert Schedule</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>First Reminder</label>
                                            <select class="form-control">
                                                <option value="7">7 days before due date</option>
                                                <option value="5">5 days before due date</option>
                                                <option value="3" selected>3 days before due date</option>
                                                <option value="1">1 day before due date</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Second Reminder</label>
                                            <select class="form-control">
                                                <option value="1">1 day before due date</option>
                                                <option value="0" selected>On due date</option>
                                                <option value="-1">1 day after due date</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Overdue Reminder</label>
                                            <select class="form-control">
                                                <option value="3">Every 3 days</option>
                                                <option value="7" selected>Every 7 days</option>
                                                <option value="14">Every 14 days</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <h6 class="mt-3">Timing Restrictions</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <input type="time" class="form-control" value="09:00">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <input type="time" class="form-control" value="17:00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveAlertSettings">
                        <i class="las la-save mr-2"></i> Save Settings
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Due Alerts Script -->
    <script>
        $(document).ready(function() {
            // Send bulk reminders
            $('#sendReminders').click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Sending...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    $('#sendBulkReminders').modal('hide');
                    alert('Reminders sent successfully to 15 parents!');
                }, 2000);
            });
            
            // Test reminder
            $('#testReminder').click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Testing...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert('Test message sent successfully to your registered number/email!');
                }, 1500);
            });
            
            // Save alert settings
            $('#saveAlertSettings').click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Saving...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    $('#configureAlerts').modal('hide');
                    alert('Alert settings saved successfully!');
                }, 1500);
            });
            
            // Auto-send due today
            $('.btn-block').eq(1).click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Processing...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert('Auto-reminders sent to 8 parents with payments due today!');
                }, 1500);
            });
            
            // Update recipients count when alert type changes
            $('#bulkRemindersForm select').first().change(function() {
                const type = $(this).val();
                const counts = {
                    'overdue': 15,
                    'due_today': 8,
                    'upcoming': 32,
                    'custom': 0
                };
                
                const count = counts[type] || 0;
                $('.card-body p strong').eq(0).text(count);
                $('.card-body p strong').eq(2).text('PKR ' + (count * 3));
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
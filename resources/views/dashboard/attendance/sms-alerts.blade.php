<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .sms-status {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
        .status-sent { background-color: #28a745; }
        .status-failed { background-color: #dc3545; }
        .status-pending { background-color: #ffc107; }
        .status-queued { background-color: #17a2b8; }
        
        .sms-preview {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .character-count {
            font-size: 12px;
            color: #6c757d;
        }
        
        .sms-templates .card {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .sms-templates .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .sms-templates .card.active {
            border-color: #007bff;
            background-color: rgba(0, 123, 255, 0.05);
        }
        
        .recipient-list {
            max-height: 300px;
            overflow-y: auto;
        }
        
        .recipient-item {
            border-bottom: 1px solid #dee2e6;
            padding: 10px 0;
        }
        
        .recipient-item:last-child {
            border-bottom: none;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">SMS Alerts Management</h4>
                <p class="mb-0">Send SMS alerts for attendance, announcements, and notifications</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('attendance.daily') }}">Attendance</a></li>
                        <li class="breadcrumb-item active">SMS Alerts</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-primary" id="sendBulkSMS" data-toggle="modal" data-target="#sendSMSModal">
                    <i class="las la-sms mr-2"></i>Send Bulk SMS
                </button>
            </div>
        </div>

        <!-- SMS Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total SMS Sent</h6>
                                <h2 class="mb-0 text-white">1,245</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-sms fa-lg text-primary"></i>
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
                                <h6 class="text-white mb-0">Successful</h6>
                                <h2 class="mb-0 text-white">1,210</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-check-circle fa-lg text-success"></i>
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
                                <h6 class="text-white mb-0">Failed</h6>
                                <h2 class="mb-0 text-white">35</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-times-circle fa-lg text-danger"></i>
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
                                <h6 class="text-white mb-0">This Month</h6>
                                <h2 class="mb-0 text-white">285</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-calendar-alt fa-lg text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SMS History and Templates -->
        <div class="row">
            <!-- SMS History -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Recent SMS History</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                                    data-toggle="dropdown">
                                Filter by Type
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">All SMS</a>
                                <a class="dropdown-item" href="#">Attendance Alerts</a>
                                <a class="dropdown-item" href="#">Fee Reminders</a>
                                <a class="dropdown-item" href="#">Announcements</a>
                                <a class="dropdown-item" href="#">Exam Notifications</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>Recipient</th>
                                        <th>Message</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- SMS 1 -->
                                    <tr>
                                        <td>
                                            <div>15 Dec 2024</div>
                                            <small class="text-muted">09:30 AM</small>
                                        </td>
                                        <td>
                                            <div>Mr. Robert Johnson</div>
                                            <small class="text-muted">+92 300 1234567</small>
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;">
                                                Dear parent, your child Alex Johnson was absent today (15 Dec, 2024)...
                                            </div>
                                            <button class="btn btn-sm btn-link p-0 view-message" data-message="Dear parent, your child Alex Johnson was absent today (15 Dec, 2024). Please contact school if this was unexpected.">
                                                View Full
                                            </button>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">Attendance</span>
                                        </td>
                                        <td>
                                            <span class="sms-status status-sent"></span>
                                            <span class="text-success">Sent</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary resend-sms" data-id="1">
                                                <i class="las la-redo"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- SMS 2 -->
                                    <tr>
                                        <td>
                                            <div>14 Dec 2024</div>
                                            <small class="text-muted">02:15 PM</small>
                                        </td>
                                        <td>
                                            <div>Ms. Emma Williams</div>
                                            <small class="text-muted">+92 300 2345678</small>
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;">
                                                Dear parent, monthly fee for December is due. Please pay before 20th...
                                            </div>
                                            <button class="btn btn-sm btn-link p-0 view-message" data-message="Dear parent, monthly fee for December is due. Please pay before 20th December to avoid late fee.">
                                                View Full
                                            </button>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">Fee Reminder</span>
                                        </td>
                                        <td>
                                            <span class="sms-status status-sent"></span>
                                            <span class="text-success">Sent</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary resend-sms" data-id="2">
                                                <i class="las la-redo"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- SMS 3 (Failed) -->
                                    <tr class="table-danger">
                                        <td>
                                            <div>13 Dec 2024</div>
                                            <small class="text-muted">10:45 AM</small>
                                        </td>
                                        <td>
                                            <div>Mr. David Brown</div>
                                            <small class="text-muted">+92 300 3456789</small>
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;">
                                                Parent-Teacher meeting scheduled for 20th December at 2:00 PM...
                                            </div>
                                            <button class="btn btn-sm btn-link p-0 view-message" data-message="Parent-Teacher meeting scheduled for 20th December at 2:00 PM. Your presence is requested.">
                                                View Full
                                            </button>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">Announcement</span>
                                        </td>
                                        <td>
                                            <span class="sms-status status-failed"></span>
                                            <span class="text-danger">Failed</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-danger resend-sms" data-id="3">
                                                <i class="las la-redo"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- SMS 4 -->
                                    <tr>
                                        <td>
                                            <div>12 Dec 2024</div>
                                            <small class="text-muted">08:30 AM</small>
                                        </td>
                                        <td>
                                            <div>All Parents (Bulk)</div>
                                            <small class="text-muted">35 Recipients</small>
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;">
                                                School will remain closed on 25th December for Christmas holiday...
                                            </div>
                                            <button class="btn btn-sm btn-link p-0 view-message" data-message="School will remain closed on 25th December for Christmas holiday. Classes will resume on 26th December.">
                                                View Full
                                            </button>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Holiday</span>
                                        </td>
                                        <td>
                                            <span class="sms-status status-sent"></span>
                                            <span class="text-success">Sent</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary resend-sms" data-id="4">
                                                <i class="las la-redo"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- SMS 5 (Pending) -->
                                    <tr class="table-warning">
                                        <td>
                                            <div>11 Dec 2024</div>
                                            <small class="text-muted">03:20 PM</small>
                                        </td>
                                        <td>
                                            <div>Class 9 Parents</div>
                                            <small class="text-muted">42 Recipients</small>
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;">
                                                Mid-term exams start from 20th December. Please ensure your child...
                                            </div>
                                            <button class="btn btn-sm btn-link p-0 view-message" data-message="Mid-term exams start from 20th December. Please ensure your child comes prepared. Exam schedule sent earlier.">
                                                View Full
                                            </button>
                                        </td>
                                        <td>
                                            <span class="badge badge-danger">Exam Alert</span>
                                        </td>
                                        <td>
                                            <span class="sms-status status-pending"></span>
                                            <span class="text-warning">Pending</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-warning" disabled>
                                                <i class="las la-clock"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mt-3">
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
            </div>

            <!-- SMS Templates -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">SMS Templates</h5>
                    </div>
                    <div class="card-body sms-templates">
                        <div class="row">
                            <!-- Template 1 -->
                            <div class="col-12 mb-3">
                                <div class="card template-card active" data-template="attendance">
                                    <div class="card-body">
                                        <h6 class="card-title">Attendance Alert</h6>
                                        <p class="card-text text-muted small">
                                            Dear parent, your child [student_name] was [status] today ([date])...
                                        </p>
                                        <button class="btn btn-sm btn-outline-primary use-template">Use Template</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Template 2 -->
                            <div class="col-12 mb-3">
                                <div class="card template-card" data-template="fee">
                                    <div class="card-body">
                                        <h6 class="card-title">Fee Reminder</h6>
                                        <p class="card-text text-muted small">
                                            Dear parent, monthly fee for [month] is due. Please pay before [due_date]...
                                        </p>
                                        <button class="btn btn-sm btn-outline-primary use-template">Use Template</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Template 3 -->
                            <div class="col-12 mb-3">
                                <div class="card template-card" data-template="holiday">
                                    <div class="card-body">
                                        <h6 class="card-title">Holiday Announcement</h6>
                                        <p class="card-text text-muted small">
                                            School will remain closed on [date] for [occasion]. Classes resume on [resume_date]...
                                        </p>
                                        <button class="btn btn-sm btn-outline-primary use-template">Use Template</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Template 4 -->
                            <div class="col-12 mb-3">
                                <div class="card template-card" data-template="meeting">
                                    <div class="card-body">
                                        <h6 class="card-title">Parent-Teacher Meeting</h6>
                                        <p class="card-text text-muted small">
                                            Parent-Teacher meeting scheduled for [date] at [time]. Your presence is requested...
                                        </p>
                                        <button class="btn btn-sm btn-outline-primary use-template">Use Template</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Template 5 -->
                            <div class="col-12">
                                <div class="card template-card" data-template="exam">
                                    <div class="card-body">
                                        <h6 class="card-title">Exam Notification</h6>
                                        <p class="card-text text-muted small">
                                            [exam_name] exams start from [start_date]. Please ensure your child comes prepared...
                                        </p>
                                        <button class="btn btn-sm btn-outline-primary use-template">Use Template</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Create New Template -->
                        <div class="mt-4">
                            <button class="btn btn-outline-secondary btn-block" data-toggle="modal" data-target="#createTemplateModal">
                                <i class="las la-plus mr-2"></i> Create New Template
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SMS Balance & Settings -->
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">SMS Balance & Usage</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card bg-light mb-3">
                                    <div class="card-body text-center">
                                        <h2 class="text-primary mb-0">985</h2>
                                        <small class="text-muted">SMS Balance</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light mb-3">
                                    <div class="card-body text-center">
                                        <h2 class="text-success mb-0">1,245</h2>
                                        <small class="text-muted">Total Sent</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="progress mb-3" style="height: 20px;">
                            <div class="progress-bar bg-success" style="width: 55%">55% Used</div>
                            <div class="progress-bar bg-primary" style="width: 45%">45% Remaining</div>
                        </div>
                        
                        <div class="alert alert-info">
                            <h6><i class="las la-info-circle mr-2"></i> SMS Package Information</h6>
                            <p class="mb-1"><strong>Current Package:</strong> 2,000 SMS (Monthly)</p>
                            <p class="mb-1"><strong>Renewal Date:</strong> 25 December 2024</p>
                            <p class="mb-1"><strong>SMS Cost:</strong> PKR 1.50 per SMS</p>
                            <p class="mb-0"><strong>Service Provider:</strong> Telenor SMS Gateway</p>
                        </div>
                        
                        <button class="btn btn-primary btn-block">
                            <i class="las la-shopping-cart mr-2"></i> Buy More SMS
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">SMS Settings</h5>
                    </div>
                    <div class="card-body">
                        <form id="smsSettingsForm">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="autoAttendanceSMS" checked>
                                    <label class="custom-control-label" for="autoAttendanceSMS">
                                        Automatic Attendance Alerts
                                    </label>
                                </div>
                                <small class="form-text text-muted">Send automatic SMS for absent students daily</small>
                            </div>
                            
                            <div class="form-group">
                                <label>Attendance Alert Time</label>
                                <input type="time" class="form-control" value="10:00">
                                <small class="form-text text-muted">Time to send daily attendance alerts</small>
                            </div>
                            
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="feeReminderSMS" checked>
                                    <label class="custom-control-label" for="feeReminderSMS">
                                        Fee Reminder Alerts
                                    </label>
                                </div>
                                <small class="form-text text-muted">Send reminders 3 days before fee due date</small>
                            </div>
                            
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="holidaySMS">
                                    <label class="custom-control-label" for="holidaySMS">
                                        Holiday Announcements
                                    </label>
                                </div>
                                <small class="form-text text-muted">Send SMS for holiday announcements</small>
                            </div>
                            
                            <div class="form-group">
                                <label>SMS Sender ID</label>
                                <input type="text" class="form-control" value="SCHOOL" maxlength="11">
                                <small class="form-text text-muted">Maximum 11 characters</small>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="las la-save mr-2"></i> Save Settings
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Send SMS Modal -->
        <div class="modal fade" id="sendSMSModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Send Bulk SMS</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="bulkSMSForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Send To *</label>
                                        <select class="form-control" id="smsAudience" required>
                                            <option value="">Select Audience</option>
                                            <option value="all">All Parents</option>
                                            <option value="class">Specific Class</option>
                                            <option value="absent">Absent Students Today</option>
                                            <option value="late">Late Students Today</option>
                                            <option value="custom">Custom Selection</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Class (if applicable)</label>
                                        <select class="form-control" id="smsClass">
                                            <option value="">All Classes</option>
                                            <option value="class1">Class 1</option>
                                            <option value="class2">Class 2</option>
                                            <option value="class3">Class 3</option>
                                            <option value="class4">Class 4</option>
                                            <option value="class5">Class 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Message *</label>
                                        <textarea class="form-control" id="smsMessage" rows="4" required 
                                                  placeholder="Type your message here... (Maximum 160 characters)"></textarea>
                                        <div class="d-flex justify-content-between mt-1">
                                            <div class="character-count">
                                                <span id="charCount">0</span>/160 characters
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" id="addVariables">
                                                    <i class="las la-code mr-1"></i> Add Variables
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Variables Dropdown -->
                                <div class="col-md-12 mb-3" id="variablesDropdown" style="display: none;">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title mb-2">Available Variables</h6>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary add-variable" data-var="[student_name]">
                                                    Student Name
                                                </button>
                                                <button type="button" class="btn btn-outline-primary add-variable" data-var="[parent_name]">
                                                    Parent Name
                                                </button>
                                                <button type="button" class="btn btn-outline-primary add-variable" data-var="[date]">
                                                    Date
                                                </button>
                                                <button type="button" class="btn btn-outline-primary add-variable" data-var="[class]">
                                                    Class
                                                </button>
                                                <button type="button" class="btn btn-outline-primary add-variable" data-var="[roll_number]">
                                                    Roll Number
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- SMS Preview -->
                                <div class="col-md-12">
                                    <h6>SMS Preview</h6>
                                    <div class="sms-preview" id="smsPreview">
                                        Message preview will appear here...
                                    </div>
                                </div>
                                
                                <!-- Recipient List -->
                                <div class="col-md-12">
                                    <h6>Recipients <span class="badge badge-primary" id="recipientCount">0</span></h6>
                                    <div class="recipient-list border rounded p-3">
                                        <div class="text-center text-muted" id="noRecipients">
                                            No recipients selected. Select an audience to see the list.
                                        </div>
                                        <div id="recipientList" style="display: none;"></div>
                                    </div>
                                </div>
                                
                                <!-- Schedule Options -->
                                <div class="col-md-12 mt-3">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="scheduleSMS">
                                        <label class="custom-control-label" for="scheduleSMS">
                                            Schedule SMS
                                        </label>
                                    </div>
                                    
                                    <div class="row mt-2" id="scheduleOptions" style="display: none;">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Schedule Date</label>
                                                <input type="date" class="form-control" id="scheduleDate">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Schedule Time</label>
                                                <input type="time" class="form-control" id="scheduleTime">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="sendSMSBtn">
                            <i class="las la-paper-plane mr-2"></i> Send SMS
                        </button>
                        <button type="button" class="btn btn-success" id="scheduleSMSBtn" style="display: none;">
                            <i class="las la-clock mr-2"></i> Schedule
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Message Modal -->
        <div class="modal fade" id="viewMessageModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">SMS Message</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="sms-preview" id="fullMessageContent"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="copyMessage">
                            <i class="las la-copy mr-2"></i> Copy Message
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Template Modal -->
        <div class="modal fade" id="createTemplateModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New SMS Template</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Template Name *</label>
                                <input type="text" class="form-control" placeholder="e.g., Attendance Alert">
                            </div>
                            <div class="form-group">
                                <label>Message *</label>
                                <textarea class="form-control" rows="4" placeholder="Enter template message..."></textarea>
                                <small class="form-text text-muted">Use variables like [student_name], [date], [class] etc.</small>
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control">
                                    <option value="attendance">Attendance</option>
                                    <option value="fee">Fee Reminder</option>
                                    <option value="holiday">Holiday</option>
                                    <option value="exam">Exam</option>
                                    <option value="general">General</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Save Template</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- SMS Alerts Script -->
    <script>
        $(document).ready(function() {
            // Character count for SMS
            $('#smsMessage').on('input', function() {
                const text = $(this).val();
                const charCount = text.length;
                $('#charCount').text(charCount);
                
                // Update preview
                updateSMSPreview();
                
                // Update recipient count
                updateRecipientCount();
            });
            
            // Update SMS preview
            function updateSMSPreview() {
                const message = $('#smsMessage').val();
                $('#smsPreview').text(message || 'Message preview will appear here...');
            }
            
            // Update recipient count
            function updateRecipientCount() {
                const audience = $('#smsAudience').val();
                let count = 0;
                
                switch(audience) {
                    case 'all':
                        count = 150;
                        break;
                    case 'class':
                        count = 35;
                        break;
                    case 'absent':
                        count = 5;
                        break;
                    case 'late':
                        count = 3;
                        break;
                    case 'custom':
                        count = 10;
                        break;
                }
                
                $('#recipientCount').text(count);
                
                // Update recipient list
                if (audience) {
                    $('#noRecipients').hide();
                    $('#recipientList').show().html(generateRecipientList(audience, count));
                } else {
                    $('#noRecipients').show();
                    $('#recipientList').hide();
                }
            }
            
            // Generate recipient list
            function generateRecipientList(audience, count) {
                let html = '';
                const names = [
                    'Mr. Robert Johnson', 'Ms. Emma Williams', 'Mr. David Brown', 
                    'Ms. Sarah Davis', 'Mr. James Miller', 'Mr. Michael Wilson',
                    'Mr. William Taylor', 'Ms. Jessica Anderson', 'Mr. Thomas Martinez'
                ];
                
                const phones = [
                    '+92 300 1234567', '+92 300 2345678', '+92 300 3456789',
                    '+92 300 4567890', '+92 300 5678901', '+92 300 6789012',
                    '+92 300 7890123', '+92 300 8901234', '+92 300 9012345'
                ];
                
                for (let i = 0; i < Math.min(count, 9); i++) {
                    html += `
                        <div class="recipient-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>${names[i] || 'Parent ' + (i+1)}</strong>
                                    <div class="text-muted">${phones[i] || '+92 300 XXXXXX' + (i+1)}</div>
                                </div>
                                <div>
                                    <span class="badge badge-light">Student: ${i+1}</span>
                                </div>
                            </div>
                        </div>
                    `;
                }
                
                if (count > 9) {
                    html += `
                        <div class="recipient-item text-center">
                            <span class="text-muted">... and ${count - 9} more recipients</span>
                        </div>
                    `;
                }
                
                return html;
            }
            
            // Audience change handler
            $('#smsAudience').change(updateRecipientCount);
            $('#smsClass').change(updateRecipientCount);
            
            // Add variables
            $('#addVariables').click(function() {
                $('#variablesDropdown').toggle();
            });
            
            $('.add-variable').click(function() {
                const variable = $(this).data('var');
                const textarea = $('#smsMessage');
                const current = textarea.val();
                const cursorPos = textarea.prop('selectionStart');
                const textBefore = current.substring(0, cursorPos);
                const textAfter = current.substring(cursorPos);
                
                textarea.val(textBefore + variable + textAfter);
                textarea.focus();
                textarea.prop('selectionStart', cursorPos + variable.length);
                textarea.prop('selectionEnd', cursorPos + variable.length);
                
                // Trigger input event to update count
                textarea.trigger('input');
            });
            
            // Template selection
            $('.template-card').click(function() {
                $('.template-card').removeClass('active');
                $(this).addClass('active');
            });
            
            $('.use-template').click(function(e) {
                e.stopPropagation();
                const template = $(this).closest('.template-card').data('template');
                let message = '';
                
                switch(template) {
                    case 'attendance':
                        message = 'Dear parent, your child [student_name] was [status] today ([date]). Please contact school if this was unexpected.';
                        break;
                    case 'fee':
                        message = 'Dear parent, monthly fee for [month] is due. Please pay before [due_date] to avoid late fee.';
                        break;
                    case 'holiday':
                        message = 'School will remain closed on [date] for [occasion]. Classes will resume on [resume_date].';
                        break;
                    case 'meeting':
                        message = 'Parent-Teacher meeting scheduled for [date] at [time]. Your presence is requested.';
                        break;
                    case 'exam':
                        message = '[exam_name] exams start from [start_date]. Please ensure your child comes prepared. Exam schedule sent earlier.';
                        break;
                }
                
                $('#smsMessage').val(message).trigger('input');
                $('#sendSMSModal').modal('show');
            });
            
            // Schedule SMS toggle
            $('#scheduleSMS').change(function() {
                if ($(this).is(':checked')) {
                    $('#scheduleOptions').show();
                    $('#scheduleSMSBtn').show();
                    $('#sendSMSBtn').hide();
                } else {
                    $('#scheduleOptions').hide();
                    $('#scheduleSMSBtn').hide();
                    $('#sendSMSBtn').show();
                }
            });
            
            // Send SMS
            $('#sendSMSBtn').click(function() {
                const message = $('#smsMessage').val();
                const audience = $('#smsAudience').val();
                const recipientCount = parseInt($('#recipientCount').text());
                
                if (!message.trim()) {
                    alert('Please enter a message');
                    return;
                }
                
                if (!audience) {
                    alert('Please select an audience');
                    return;
                }
                
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Sending...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    $('#sendSMSModal').modal('hide');
                    alert(`SMS sent successfully to ${recipientCount} recipients!`);
                }, 2000);
            });
            
            // Schedule SMS
            $('#scheduleSMSBtn').click(function() {
                const message = $('#smsMessage').val();
                const audience = $('#smsAudience').val();
                const scheduleDate = $('#scheduleDate').val();
                const scheduleTime = $('#scheduleTime').val();
                
                if (!message.trim()) {
                    alert('Please enter a message');
                    return;
                }
                
                if (!audience) {
                    alert('Please select an audience');
                    return;
                }
                
                if (!scheduleDate || !scheduleTime) {
                    alert('Please select schedule date and time');
                    return;
                }
                
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Scheduling...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    $('#sendSMSModal').modal('hide');
                    alert(`SMS scheduled for ${scheduleDate} at ${scheduleTime}!`);
                }, 2000);
            });
            
            // View full message
            $('.view-message').click(function() {
                const message = $(this).data('message');
                $('#fullMessageContent').text(message);
                $('#viewMessageModal').modal('show');
            });
            
            // Copy message
            $('#copyMessage').click(function() {
                const message = $('#fullMessageContent').text();
                navigator.clipboard.writeText(message).then(function() {
                    alert('Message copied to clipboard!');
                });
            });
            
            // Resend SMS
            $('.resend-sms').click(function() {
                const smsId = $(this).data('id');
                const btn = $(this);
                const originalHtml = btn.html();
                
                btn.html('<i class="las la-spinner la-spin"></i>').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalHtml).prop('disabled', false);
                    alert(`SMS #${smsId} resent successfully!`);
                }, 1500);
            });
            
            // Save SMS settings
            $('#smsSettingsForm').submit(function(e) {
                e.preventDefault();
                const btn = $(this).find('button[type="submit"]');
                const originalText = btn.html();
                
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Saving...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert('SMS settings saved successfully!');
                }, 1500);
            });
            
            // Initialize send SMS modal
            $('#sendSMSModal').on('show.bs.modal', function() {
                $('#smsMessage').val('').trigger('input');
                $('#smsAudience').val('');
                $('#smsClass').val('');
                $('#scheduleSMS').prop('checked', false).trigger('change');
                updateRecipientCount();
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
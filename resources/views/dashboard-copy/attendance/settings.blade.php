<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .holiday-list {
            max-height: 400px;
            overflow-y: auto;
        }
        
        .holiday-item {
            border-left: 4px solid #007bff;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        
        .holiday-item.holiday {
            border-left-color: #dc3545;
        }
        
        .holiday-item.event {
            border-left-color: #28a745;
        }
        
        .time-slot {
            border: 1px solid #dee2e6;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            position: relative;
        }
        
        .remove-time-slot {
            position: absolute;
            top: 5px;
            right: 5px;
        }
        
        .settings-section {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        
        .settings-section:last-child {
            border-bottom: none;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Attendance Settings</h4>
                <p class="mb-0">Configure attendance rules, holidays, and system settings</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('attendance.daily') }}">Attendance</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-primary" id="saveAllSettings">
                    <i class="las la-save mr-2"></i>Save All Settings
                </button>
            </div>
        </div>

        <!-- Settings Tabs -->
        <div class="card mb-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="settingsTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general">
                            <i class="las la-cog mr-2"></i>General Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="holidays-tab" data-toggle="tab" href="#holidays">
                            <i class="las la-calendar-times mr-2"></i>Holidays & Events
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="timings-tab" data-toggle="tab" href="#timings">
                            <i class="las la-clock mr-2"></i>School Timings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rules-tab" data-toggle="tab" href="#rules">
                            <i class="las la-gavel mr-2"></i>Attendance Rules
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="notifications-tab" data-toggle="tab" href="#notifications">
                            <i class="las la-bell mr-2"></i>Notifications
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="settingsTabContent">
                    <!-- General Settings Tab -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                        <div class="settings-section">
                            <h5 class="mb-4">General Attendance Settings</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="autoMarkAttendance" checked>
                                            <label class="custom-control-label" for="autoMarkAttendance">
                                                Auto-mark Attendance at Check-in
                                            </label>
                                        </div>
                                        <small class="form-text text-muted">Automatically mark students as present when they check-in</small>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="enableLateMarking" checked>
                                            <label class="custom-control-label" for="enableLateMarking">
                                                Enable Late Marking
                                            </label>
                                        </div>
                                        <small class="form-text text-muted">Allow marking students as late</small>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="enableHalfDay" checked>
                                            <label class="custom-control-label" for="enableHalfDay">
                                                Enable Half Day Marking
                                            </label>
                                        </div>
                                        <small class="form-text text-muted">Allow marking students as half day</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Default Attendance Status</label>
                                        <select class="form-control" id="defaultStatus">
                                            <option value="present">Present</option>
                                            <option value="absent" selected>Absent</option>
                                            <option value="late">Late</option>
                                            <option value="holiday">Holiday</option>
                                        </select>
                                        <small class="form-text text-muted">Default status when loading attendance sheet</small>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Minimum Attendance Percentage</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" value="75" min="0" max="100">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">Minimum required attendance for promotion</small>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Academic Year</label>
                                        <select class="form-control" id="academicYear">
                                            <option value="2024-2025" selected>2024-2025</option>
                                            <option value="2023-2024">2023-2024</option>
                                            <option value="2022-2023">2022-2023</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="settings-section">
                            <h5 class="mb-4">Data Management</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Attendance Data Retention</label>
                                        <select class="form-control">
                                            <option value="1">1 Year</option>
                                            <option value="2">2 Years</option>
                                            <option value="3" selected>3 Years</option>
                                            <option value="5">5 Years</option>
                                            <option value="permanent">Permanent</option>
                                        </select>
                                        <small class="form-text text-muted">How long to keep attendance records</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Backup Frequency</label>
                                        <select class="form-control">
                                            <option value="daily">Daily</option>
                                            <option value="weekly" selected>Weekly</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="never">Never</option>
                                        </select>
                                        <small class="form-text text-muted">How often to backup attendance data</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-warning">
                                <h6><i class="las la-exclamation-triangle mr-2"></i> Data Management Warning</h6>
                                <p class="mb-0">
                                    Changes to data retention settings will affect historical attendance records. 
                                    Please consult with administration before making changes.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Holidays & Events Tab -->
                    <div class="tab-pane fade" id="holidays" role="tabpanel">
                        <div class="settings-section">
                            <h5 class="mb-4">Manage Holidays & Events</h5>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#addHolidayModal">
                                        <i class="las la-plus mr-2"></i> Add New Holiday/Event
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Current Holidays List -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="mb-3">Scheduled Holidays & Events (2024-2025)</h6>
                                    <div class="holiday-list">
                                        <!-- Holiday 1 -->
                                        <div class="holiday-item holiday">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">Summer Vacation</h6>
                                                    <p class="mb-1 text-muted">01 Jun 2024 - 15 Aug 2024 (76 days)</p>
                                                    <small>Annual summer break for students and staff</small>
                                                </div>
                                                <div>
                                                    <span class="badge badge-danger">Holiday</span>
                                                    <button class="btn btn-sm btn-outline-danger ml-2 delete-holiday">
                                                        <i class="las la-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Holiday 2 -->
                                        <div class="holiday-item holiday">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">Eid-ul-Fitr</h6>
                                                    <p class="mb-1 text-muted">10 Apr 2024 - 12 Apr 2024 (3 days)</p>
                                                    <small>Religious holiday</small>
                                                </div>
                                                <div>
                                                    <span class="badge badge-danger">Holiday</span>
                                                    <button class="btn btn-sm btn-outline-danger ml-2 delete-holiday">
                                                        <i class="las la-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Holiday 3 -->
                                        <div class="holiday-item holiday">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">Eid-ul-Adha</h6>
                                                    <p class="mb-1 text-muted">17 Jun 2024 - 19 Jun 2024 (3 days)</p>
                                                    <small>Religious holiday</small>
                                                </div>
                                                <div>
                                                    <span class="badge badge-danger">Holiday</span>
                                                    <button class="btn btn-sm btn-outline-danger ml-2 delete-holiday">
                                                        <i class="las la-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Event 1 -->
                                        <div class="holiday-item event">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">Sports Day</h6>
                                                    <p class="mb-1 text-muted">15 Mar 2024 (1 day)</p>
                                                    <small>Annual sports competition</small>
                                                </div>
                                                <div>
                                                    <span class="badge badge-success">Event</span>
                                                    <button class="btn btn-sm btn-outline-danger ml-2 delete-holiday">
                                                        <i class="las la-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Holiday 4 -->
                                        <div class="holiday-item holiday">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">Winter Vacation</h6>
                                                    <p class="mb-1 text-muted">25 Dec 2024 - 05 Jan 2025 (12 days)</p>
                                                    <small>Christmas and New Year break</small>
                                                </div>
                                                <div>
                                                    <span class="badge badge-danger">Holiday</span>
                                                    <button class="btn btn-sm btn-outline-danger ml-2 delete-holiday">
                                                        <i class="las la-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Holiday 5 -->
                                        <div class="holiday-item holiday">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">Pakistan Day</h6>
                                                    <p class="mb-1 text-muted">23 Mar 2024 (1 day)</p>
                                                    <small>National holiday</small>
                                                </div>
                                                <div>
                                                    <span class="badge badge-danger">Holiday</span>
                                                    <button class="btn btn-sm btn-outline-danger ml-2 delete-holiday">
                                                        <i class="las la-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Import/Export Holidays -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h6 class="mb-3">Import/Export Holidays</h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <button class="btn btn-outline-primary btn-block" id="exportHolidays">
                                                <i class="las la-file-export mr-2"></i> Export Holidays (CSV)
                                            </button>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <button class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#importHolidaysModal">
                                                <i class="las la-file-import mr-2"></i> Import Holidays
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- School Timings Tab -->
                    <div class="tab-pane fade" id="timings" role="tabpanel">
                        <div class="settings-section">
                            <h5 class="mb-4">School Timings Configuration</h5>
                            
                            <!-- Regular School Timings -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h6 class="mb-3">Regular School Hours</h6>
                                    <div class="time-slot">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>School Start Time *</label>
                                                    <input type="time" class="form-control" value="08:00">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>School End Time *</label>
                                                    <input type="time" class="form-control" value="14:00">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Late After (Minutes) *</label>
                                                    <input type="number" class="form-control" value="30" min="0" max="120">
                                                    <small class="form-text text-muted">Considered late after this many minutes</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Class-wise Timings -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h6 class="mb-3">Class-wise Timings</h6>
                                    <div id="classTimingsContainer">
                                        <!-- Class 1 Timing -->
                                        <div class="time-slot">
                                            <button class="btn btn-sm btn-danger remove-time-slot">
                                                <i class="las la-times"></i>
                                            </button>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Class *</label>
                                                        <select class="form-control">
                                                            <option value="class1" selected>Class 1</option>
                                                            <option value="class2">Class 2</option>
                                                            <option value="class3">Class 3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Start Time *</label>
                                                        <input type="time" class="form-control" value="08:00">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>End Time *</label>
                                                        <input type="time" class="form-control" value="13:00">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Break Time</label>
                                                        <input type="time" class="form-control" value="11:00">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Class 2 Timing -->
                                        <div class="time-slot">
                                            <button class="btn btn-sm btn-danger remove-time-slot">
                                                <i class="las la-times"></i>
                                            </button>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Class *</label>
                                                        <select class="form-control">
                                                            <option value="class1">Class 1</option>
                                                            <option value="class2" selected>Class 2</option>
                                                            <option value="class3">Class 3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Start Time *</label>
                                                        <input type="time" class="form-control" value="08:30">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>End Time *</label>
                                                        <input type="time" class="form-control" value="13:30">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Break Time</label>
                                                        <input type="time" class="form-control" value="11:30">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button class="btn btn-outline-primary" id="addClassTiming">
                                        <i class="las la-plus mr-2"></i> Add Class Timing
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Working Days -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="mb-3">Working Days Configuration</h6>
                                    <div class="row">
                                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                        <div class="col-md-3 col-sm-4 mb-3">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" 
                                                       id="day{{ $day }}" {{ in_array($day, ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="day{{ $day }}">
                                                    {{ $day }}
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Rules Tab -->
                    <div class="tab-pane fade" id="rules" role="tabpanel">
                        <div class="settings-section">
                            <h5 class="mb-4">Attendance Rules & Policies</h5>
                            
                            <!-- Leave Policies -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h6 class="mb-3">Leave Policies</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Sick Leave Limit</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="10" min="0" max="100">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">days/year</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Casual Leave Limit</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="12" min="0" max="100">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">days/year</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Medical Certificate Required After</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="3" min="0" max="10">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">days</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Late Arrival Rules -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h6 class="mb-3">Late Arrival Rules</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Maximum Late Arrivals</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="5" min="0" max="50">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">per month</span>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">Warning after this limit</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Late Arrival Grace Period</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="15" min="0" max="60">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">minutes</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Late Marking After</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="30" min="0" max="120">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">minutes</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Absenteeism Rules -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h6 class="mb-3">Absenteeism Rules</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Consecutive Absence Warning</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="3" min="0" max="10">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">days</span>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">Send warning after consecutive absences</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Monthly Absence Warning</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="8" min="0" max="31">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">days/month</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Promotion Rules -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="mb-3">Promotion Rules</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Minimum Attendance for Promotion</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="75" min="0" max="100">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Grace Attendance</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="5" min="0" max="20">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">Additional grace percentage</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Tab -->
                    <div class="tab-pane fade" id="notifications" role="tabpanel">
                        <div class="settings-section">
                            <h5 class="mb-4">Notification Settings</h5>
                            
                            <!-- SMS Notifications -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h6 class="mb-3">SMS Notifications</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="smsAbsentAlert" checked>
                                                    <label class="custom-control-label" for="smsAbsentAlert">
                                                        Absent Student Alerts
                                                    </label>
                                                </div>
                                                <small class="form-text text-muted">Send SMS when student is absent</small>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="smsLateAlert" checked>
                                                    <label class="custom-control-label" for="smsLateAlert">
                                                        Late Arrival Alerts
                                                    </label>
                                                </div>
                                                <small class="form-text text-muted">Send SMS when student arrives late</small>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="smsLowAttendance" checked>
                                                    <label class="custom-control-label" for="smsLowAttendance">
                                                        Low Attendance Warnings
                                                    </label>
                                                </div>
                                                <small class="form-text text-muted">Send SMS when attendance drops below threshold</small>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>SMS Send Time</label>
                                                <input type="time" class="form-control" value="10:30">
                                                <small class="form-text text-muted">Time to send daily attendance alerts</small>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Alert Threshold</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="80" min="0" max="100">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">Send alert when attendance falls below this</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Email Notifications -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h6 class="mb-3">Email Notifications</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="emailWeeklyReport" checked>
                                                    <label class="custom-control-label" for="emailWeeklyReport">
                                                        Weekly Attendance Reports
                                                    </label>
                                                </div>
                                                <small class="form-text text-muted">Send weekly reports to parents</small>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="emailMonthlyReport" checked>
                                                    <label class="custom-control-label" for="emailMonthlyReport">
                                                        Monthly Attendance Reports
                                                    </label>
                                                </div>
                                                <small class="form-text text-muted">Send monthly reports to parents</small>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Report Day</label>
                                                <select class="form-control">
                                                    <option value="monday">Monday</option>
                                                    <option value="friday" selected>Friday</option>
                                                    <option value="saturday">Saturday</option>
                                                </select>
                                                <small class="form-text text-muted">Day to send weekly reports</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Admin Notifications -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="mb-3">Admin Notifications</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="adminDailySummary" checked>
                                                    <label class="custom-control-label" for="adminDailySummary">
                                                        Daily Attendance Summary
                                                    </label>
                                                </div>
                                                <small class="form-text text-muted">Send daily summary to admin</small>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="adminAbsenteeismAlert" checked>
                                                    <label class="custom-control-label" for="adminAbsenteeismAlert">
                                                        Absenteeism Alerts
                                                    </label>
                                                </div>
                                                <small class="form-text text-muted">Alert admin about frequent absenteeism</small>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Admin Email</label>
                                                <input type="email" class="form-control" value="admin@school.edu">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Absenteeism Threshold</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="10" min="0" max="31">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">days/month</span>
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

    <!-- Add Holiday Modal -->
    <div class="modal fade" id="addHolidayModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Holiday/Event</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addHolidayForm">
                        <div class="form-group">
                            <label>Title *</label>
                            <input type="text" class="form-control" placeholder="e.g., Summer Vacation, Sports Day">
                        </div>
                        
                        <div class="form-group">
                            <label>Type *</label>
                            <select class="form-control" id="holidayType">
                                <option value="holiday">Holiday</option>
                                <option value="event">School Event</option>
                                <option value="exam">Exam Day</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Start Date *</label>
                            <input type="date" class="form-control" id="holidayStartDate">
                        </div>
                        
                        <div class="form-group">
                            <label>End Date *</label>
                            <input type="date" class="form-control" id="holidayEndDate">
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="isRecurring">
                                <label class="custom-control-label" for="isRecurring">
                                    Recurring Yearly
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" placeholder="Optional description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveHoliday">Save Holiday</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Holidays Modal -->
    <div class="modal fade" id="importHolidaysModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Holidays from CSV</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <h6><i class="las la-info-circle mr-2"></i> CSV Format Required</h6>
                        <p class="mb-0">CSV must contain columns: title, type, start_date, end_date, description</p>
                    </div>
                    
                    <div class="form-group">
                        <label>Select CSV File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="holidayCSV" accept=".csv">
                            <label class="custom-file-label" for="holidayCSV">Choose file</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="overwriteExisting">
                            <label class="custom-control-label" for="overwriteExisting">
                                Overwrite existing holidays
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="importHolidays">Import</button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Attendance Settings Script -->
    <script>
        $(document).ready(function() {
            // Tab activation
            $('#settingsTab a').on('click', function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
            
            // Add class timing slot
            let classTimingIndex = 2;
            $('#addClassTiming').click(function() {
                classTimingIndex++;
                const newTiming = `
                    <div class="time-slot">
                        <button class="btn btn-sm btn-danger remove-time-slot">
                            <i class="las la-times"></i>
                        </button>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Class *</label>
                                    <select class="form-control">
                                        <option value="class1">Class 1</option>
                                        <option value="class2">Class 2</option>
                                        <option value="class3">Class 3</option>
                                        <option value="class4">Class 4</option>
                                        <option value="class5">Class 5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Start Time *</label>
                                    <input type="time" class="form-control" value="08:00">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>End Time *</label>
                                    <input type="time" class="form-control" value="13:00">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Break Time</label>
                                    <input type="time" class="form-control" value="11:00">
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $('#classTimingsContainer').append(newTiming);
            });
            
            // Remove time slot
            $(document).on('click', '.remove-time-slot', function() {
                if ($('#classTimingsContainer .time-slot').length > 1) {
                    $(this).closest('.time-slot').remove();
                } else {
                    alert('At least one class timing must remain');
                }
            });
            
            // Delete holiday
            $(document).on('click', '.delete-holiday', function() {
                if (confirm('Are you sure you want to delete this holiday?')) {
                    $(this).closest('.holiday-item').remove();
                }
            });
            
            // Save holiday
            $('#saveHoliday').click(function() {
                const title = $('#addHolidayForm input[type="text"]').val();
                const type = $('#holidayType').val();
                const startDate = $('#holidayStartDate').val();
                const endDate = $('#holidayEndDate').val();
                
                if (!title || !startDate || !endDate) {
                    alert('Please fill all required fields');
                    return;
                }
                
                // Format dates
                const start = new Date(startDate);
                const end = new Date(endDate);
                const daysDiff = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
                
                // Add to holiday list
                const holidayItem = `
                    <div class="holiday-item ${type}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">${title}</h6>
                                <p class="mb-1 text-muted">${formatDate(startDate)} - ${formatDate(endDate)} (${daysDiff} days)</p>
                                <small>${$('#holidayType option:selected').text()}</small>
                            </div>
                            <div>
                                <span class="badge badge-${type === 'holiday' ? 'danger' : 'success'}">
                                    ${type === 'holiday' ? 'Holiday' : 'Event'}
                                </span>
                                <button class="btn btn-sm btn-outline-danger ml-2 delete-holiday">
                                    <i class="las la-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                
                $('.holiday-list').prepend(holidayItem);
                $('#addHolidayModal').modal('hide');
                $('#addHolidayForm')[0].reset();
            });
            
            // Format date for display
            function formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', { 
                    day: 'numeric', 
                    month: 'short', 
                    year: 'numeric' 
                });
            }
            
            // Export holidays
            $('#exportHolidays').click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Exporting...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert('Holidays exported successfully as CSV!');
                }, 1500);
            });
            
            // Import holidays
            $('#importHolidays').click(function() {
                const file = $('#holidayCSV')[0].files[0];
                if (!file) {
                    alert('Please select a CSV file');
                    return;
                }
                
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Importing...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    $('#importHolidaysModal').modal('hide');
                    alert('Holidays imported successfully!');
                }, 2000);
            });
            
            // File input label
            $('.custom-file-input').on('change', function() {
                const fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });
            
            // Save all settings
            $('#saveAllSettings').click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Saving...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert('All settings saved successfully!');
                }, 2000);
            });
            
            // Initialize date pickers for holidays
            const today = new Date();
            const nextYear = new Date(today.getFullYear() + 1, today.getMonth(), today.getDate());
            
            $('#holidayStartDate').val(today.toISOString().split('T')[0]);
            $('#holidayEndDate').val(today.toISOString().split('T')[0]);
            
            // Set max date for end date based on start date
            $('#holidayStartDate').on('change', function() {
                $('#holidayEndDate').attr('min', $(this).val());
                if ($('#holidayEndDate').val() < $(this).val()) {
                    $('#holidayEndDate').val($(this).val());
                }
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
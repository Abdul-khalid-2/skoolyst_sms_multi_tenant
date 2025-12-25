<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .attendance-status {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
        .status-present { background-color: #28a745; }
        .status-absent { background-color: #dc3545; }
        .status-late { background-color: #ffc107; }
        .status-half-day { background-color: #17a2b8; }
        .status-holiday { background-color: #6c757d; }
        
        .student-photo {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .attendance-checkbox {
            transform: scale(1.2);
        }
        
        .attendance-actions button {
            min-width: 100px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Daily Attendance</h4>
                <p class="mb-0">Mark and manage daily student attendance</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-primary" id="saveAttendance">
                    <i class="las la-save mr-2"></i>Save Attendance
                </button>
            </div>
        </div>

        <!-- Attendance Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date *</label>
                            <input type="date" class="form-control" id="attendanceDate" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Class *</label>
                            <select class="form-control" id="classSelect">
                                <option value="">Select Class</option>
                                <optgroup label="Pre-Primary">
                                    <option value="playgroup">Play Group</option>
                                    <option value="nursery">Nursery</option>
                                    <option value="kg">Kindergarten (KG)</option>
                                </optgroup>
                                <optgroup label="Primary (Class 1-5)">
                                    <option value="class1" selected>Class 1</option>
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
                            <label>Section</label>
                            <select class="form-control" id="sectionSelect">
                                <option value="all">All Sections</option>
                                <option value="A" selected>Section A</option>
                                <option value="B">Section B</option>
                                <option value="C">Section C</option>
                                <option value="D">Section D</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary btn-block" id="loadAttendance">
                                <i class="las la-sync mr-2"></i>Load Attendance
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Date Navigation -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary" id="prevDay">
                                <i class="las la-arrow-left mr-2"></i>Previous Day
                            </button>
                            <button type="button" class="btn btn-outline-primary" id="today">
                                <i class="las la-calendar-day mr-2"></i>Today
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="nextDay">
                                Next Day<i class="las la-arrow-right ml-2"></i>
                            </button>
                        </div>
                        
                        <!-- Holiday Check -->
                        <div class="custom-control custom-checkbox d-inline-block ml-3">
                            <input type="checkbox" class="custom-control-input" id="markHoliday">
                            <label class="custom-control-label" for="markHoliday">Mark as Holiday</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance Statistics -->
        <div class="row mb-4">
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Students</h6>
                                <h2 class="mb-0 text-white" id="totalStudents">35</h2>
                            </div>
                            <div class="bg-white rounded p-2">
                                <i class="las la-users fa-lg text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Present</h6>
                                <h2 class="mb-0 text-white" id="presentCount">30</h2>
                            </div>
                            <div class="bg-white rounded p-2">
                                <i class="las la-user-check fa-lg text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Absent</h6>
                                <h2 class="mb-0 text-white" id="absentCount">3</h2>
                            </div>
                            <div class="bg-white rounded p-2">
                                <i class="las la-user-times fa-lg text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Late</h6>
                                <h2 class="mb-0 text-white" id="lateCount">2</h2>
                            </div>
                            <div class="bg-white rounded p-2">
                                <i class="las la-clock fa-lg text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Attendance %</h6>
                                <h2 class="mb-0 text-white" id="attendancePercent">85.7%</h2>
                            </div>
                            <div class="bg-white rounded p-2">
                                <i class="las la-percentage fa-lg text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                <div class="card bg-secondary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Half Day</h6>
                                <h2 class="mb-0 text-white" id="halfDayCount">0</h2>
                            </div>
                            <div class="bg-white rounded p-2">
                                <i class="las la-user-clock fa-lg text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance Actions -->
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="card-title mb-3">Quick Actions</h6>
                <div class="row attendance-actions">
                    <div class="col-md-2 col-sm-4 mb-2">
                        <button class="btn btn-success btn-block" id="markAllPresent">
                            <i class="las la-check-circle mr-2"></i>All Present
                        </button>
                    </div>
                    <div class="col-md-2 col-sm-4 mb-2">
                        <button class="btn btn-danger btn-block" id="markAllAbsent">
                            <i class="las la-times-circle mr-2"></i>All Absent
                        </button>
                    </div>
                    <div class="col-md-2 col-sm-4 mb-2">
                        <button class="btn btn-warning btn-block" id="markAllLate">
                            <i class="las la-clock mr-2"></i>All Late
                        </button>
                    </div>
                    <div class="col-md-2 col-sm-4 mb-2">
                        <button class="btn btn-info btn-block" id="markAllHalfDay">
                            <i class="las la-user-clock mr-2"></i>All Half Day
                        </button>
                    </div>
                    <div class="col-md-2 col-sm-4 mb-2">
                        <button class="btn btn-secondary btn-block" id="sendSMSAlerts">
                            <i class="las la-sms mr-2"></i>Send SMS
                        </button>
                    </div>
                    <div class="col-md-2 col-sm-4 mb-2">
                        <button class="btn btn-primary btn-block" id="printAttendance">
                            <i class="las la-print mr-2"></i>Print
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Class 1 - Section A - Attendance for <span id="currentDate">{{ date('d M, Y') }}</span></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="attendanceTable">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Student</th>
                                <th width="100">Roll No</th>
                                <th width="100">Status</th>
                                <th width="150">Check In Time</th>
                                <th width="150">Check Out Time</th>
                                <th width="120">Remarks</th>
                                <th width="200">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="attendanceBody">
                            <!-- Student 1 -->
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Alex+Johnson&background=007bff&color=fff&size=30" 
                                             class="student-photo mr-3" alt="Alex Johnson">
                                        <div>
                                            <h6 class="mb-0">Alex Johnson</h6>
                                            <small class="text-muted">Father: Robert Johnson</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">1-A-01</span>
                                </td>
                                <td>
                                    <select class="form-control form-control-sm attendance-status-select" data-student-id="1">
                                        <option value="present" selected>Present</option>
                                        <option value="absent">Absent</option>
                                        <option value="late">Late</option>
                                        <option value="half_day">Half Day</option>
                                        <option value="holiday">Holiday</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm check-in-time" 
                                           value="08:00" data-student-id="1">
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm check-out-time" 
                                           value="14:00" data-student-id="1">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm remarks" 
                                           placeholder="Remarks" data-student-id="1">
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-success mark-present" data-student-id="1">
                                            <i class="las la-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger mark-absent" data-student-id="1">
                                            <i class="las la-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning mark-late" data-student-id="1">
                                            <i class="las la-clock"></i>
                                        </button>
                                        <button type="button" class="btn btn-info mark-half-day" data-student-id="1">
                                            <i class="las la-user-clock"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Student 2 -->
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Sofia+Williams&background=28a745&color=fff&size=30" 
                                             class="student-photo mr-3" alt="Sofia Williams">
                                        <div>
                                            <h6 class="mb-0">Sofia Williams</h6>
                                            <small class="text-muted">Mother: Emma Williams</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">1-A-02</span>
                                </td>
                                <td>
                                    <select class="form-control form-control-sm attendance-status-select" data-student-id="2">
                                        <option value="present" selected>Present</option>
                                        <option value="absent">Absent</option>
                                        <option value="late">Late</option>
                                        <option value="half_day">Half Day</option>
                                        <option value="holiday">Holiday</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm check-in-time" 
                                           value="08:05" data-student-id="2">
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm check-out-time" 
                                           value="14:00" data-student-id="2">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm remarks" 
                                           placeholder="Remarks" data-student-id="2">
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-success mark-present" data-student-id="2">
                                            <i class="las la-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger mark-absent" data-student-id="2">
                                            <i class="las la-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning mark-late" data-student-id="2">
                                            <i class="las la-clock"></i>
                                        </button>
                                        <button type="button" class="btn btn-info mark-half-day" data-student-id="2">
                                            <i class="las la-user-clock"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Student 3 (Absent) -->
                            <tr class="table-danger">
                                <td>3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Ethan+Brown&background=ffc107&color=000&size=30" 
                                             class="student-photo mr-3" alt="Ethan Brown">
                                        <div>
                                            <h6 class="mb-0">Ethan Brown</h6>
                                            <small class="text-muted">Father: David Brown</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">1-A-03</span>
                                </td>
                                <td>
                                    <select class="form-control form-control-sm attendance-status-select" data-student-id="3">
                                        <option value="present">Present</option>
                                        <option value="absent" selected>Absent</option>
                                        <option value="late">Late</option>
                                        <option value="half_day">Half Day</option>
                                        <option value="holiday">Holiday</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm check-in-time" 
                                           value="" data-student-id="3" disabled>
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm check-out-time" 
                                           value="" data-student-id="3" disabled>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm remarks" 
                                           value="Sick Leave" data-student-id="3">
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-success mark-present" data-student-id="3">
                                            <i class="las la-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger mark-absent active" data-student-id="3">
                                            <i class="las la-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning mark-late" data-student-id="3">
                                            <i class="las la-clock"></i>
                                        </button>
                                        <button type="button" class="btn btn-info mark-half-day" data-student-id="3">
                                            <i class="las la-user-clock"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Student 4 (Late) -->
                            <tr class="table-warning">
                                <td>4</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Mia+Davis&background=dc3545&color=fff&size=30" 
                                             class="student-photo mr-3" alt="Mia Davis">
                                        <div>
                                            <h6 class="mb-0">Mia Davis</h6>
                                            <small class="text-muted">Mother: Sarah Davis</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">1-A-04</span>
                                </td>
                                <td>
                                    <select class="form-control form-control-sm attendance-status-select" data-student-id="4">
                                        <option value="present">Present</option>
                                        <option value="absent">Absent</option>
                                        <option value="late" selected>Late</option>
                                        <option value="half_day">Half Day</option>
                                        <option value="holiday">Holiday</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm check-in-time" 
                                           value="09:30" data-student-id="4">
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm check-out-time" 
                                           value="14:00" data-student-id="4">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm remarks" 
                                           value="Late due to traffic" data-student-id="4">
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-success mark-present" data-student-id="4">
                                            <i class="las la-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger mark-absent" data-student-id="4">
                                            <i class="las la-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning mark-late active" data-student-id="4">
                                            <i class="las la-clock"></i>
                                        </button>
                                        <button type="button" class="btn btn-info mark-half-day" data-student-id="4">
                                            <i class="las la-user-clock"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Student 5 (Late) -->
                            <tr class="table-warning">
                                <td>5</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Noah+Miller&background=6c757d&color=fff&size=30" 
                                             class="student-photo mr-3" alt="Noah Miller">
                                        <div>
                                            <h6 class="mb-0">Noah Miller</h6>
                                            <small class="text-muted">Father: James Miller</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">1-A-05</span>
                                </td>
                                <td>
                                    <select class="form-control form-control-sm attendance-status-select" data-student-id="5">
                                        <option value="present">Present</option>
                                        <option value="absent">Absent</option>
                                        <option value="late" selected>Late</option>
                                        <option value="half_day">Half Day</option>
                                        <option value="holiday">Holiday</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm check-in-time" 
                                           value="09:15" data-student-id="5">
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm check-out-time" 
                                           value="14:00" data-student-id="5">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm remarks" 
                                           value="Doctor appointment" data-student-id="5">
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-success mark-present" data-student-id="5">
                                            <i class="las la-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger mark-absent" data-student-id="5">
                                            <i class="las la-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning mark-late active" data-student-id="5">
                                            <i class="las la-clock"></i>
                                        </button>
                                        <button type="button" class="btn btn-info mark-half-day" data-student-id="5">
                                            <i class="las la-user-clock"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Student 6 (Absent) -->
                            <tr class="table-danger">
                                <td>6</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Olivia+Wilson&background=17a2b8&color=fff&size=30" 
                                             class="student-photo mr-3" alt="Olivia Wilson">
                                        <div>
                                            <h6 class="mb-0">Olivia Wilson</h6>
                                            <small class="text-muted">Father: Michael Wilson</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">1-A-06</span>
                                </td>
                                <td>
                                    <select class="form-control form-control-sm attendance-status-select" data-student-id="6">
                                        <option value="present">Present</option>
                                        <option value="absent" selected>Absent</option>
                                        <option value="late">Late</option>
                                        <option value="half_day">Half Day</option>
                                        <option value="holiday">Holiday</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm check-in-time" 
                                           value="" data-student-id="6" disabled>
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm check-out-time" 
                                           value="" data-student-id="6" disabled>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm remarks" 
                                           value="Family function" data-student-id="6">
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-success mark-present" data-student-id="6">
                                            <i class="las la-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger mark-absent active" data-student-id="6">
                                            <i class="las la-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning mark-late" data-student-id="6">
                                            <i class="las la-clock"></i>
                                        </button>
                                        <button type="button" class="btn btn-info mark-half-day" data-student-id="6">
                                            <i class="las la-user-clock"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Student 7 (Absent) -->
                            <tr class="table-danger">
                                <td>7</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Liam+Taylor&background=6610f2&color=fff&size=30" 
                                             class="student-photo mr-3" alt="Liam Taylor">
                                        <div>
                                            <h6 class="mb-0">Liam Taylor</h6>
                                            <small class="text-muted">Father: William Taylor</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">1-A-07</span>
                                </td>
                                <td>
                                    <select class="form-control form-control-sm attendance-status-select" data-student-id="7">
                                        <option value="present">Present</option>
                                        <option value="absent" selected>Absent</option>
                                        <option value="late">Late</option>
                                        <option value="half_day">Half Day</option>
                                        <option value="holiday">Holiday</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm check-in-time" 
                                           value="" data-student-id="7" disabled>
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm check-out-time" 
                                           value="" data-student-id="7" disabled>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm remarks" 
                                           value="No information" data-student-id="7">
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-success mark-present" data-student-id="7">
                                            <i class="las la-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger mark-absent active" data-student-id="7">
                                            <i class="las la-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning mark-late" data-student-id="7">
                                            <i class="las la-clock"></i>
                                        </button>
                                        <button type="button" class="btn btn-info mark-half-day" data-student-id="7">
                                            <i class="las la-user-clock"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Bulk SMS Modal -->
        <div class="modal fade" id="smsModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Send SMS Alerts</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Send To</label>
                                    <select class="form-control" id="smsRecipient">
                                        <option value="absent">Absent Students Only</option>
                                        <option value="all">All Students</option>
                                        <option value="late">Late Students Only</option>
                                        <option value="custom">Custom Selection</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SMS Type</label>
                                    <select class="form-control" id="smsType">
                                        <option value="attendance">Attendance Alert</option>
                                        <option value="custom">Custom Message</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Message Template</label>
                                    <select class="form-control" id="messageTemplate">
                                        <option value="default">Dear parent, your child [student_name] was absent today ([date]). Please contact school if this was unexpected.</option>
                                        <option value="late">Dear parent, your child [student_name] was late today ([date]) arriving at [check_in_time]. Please ensure punctuality.</option>
                                        <option value="custom">Custom Message</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Custom Message</label>
                                    <textarea class="form-control" id="customMessage" rows="4" placeholder="Enter custom message..."></textarea>
                                    <small class="form-text text-muted">Available variables: [student_name], [date], [check_in_time], [class], [section]</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <h6><i class="las la-info-circle mr-2"></i> SMS Preview</h6>
                                    <p id="smsPreview">Dear parent, your child Alex Johnson was absent today (15 Dec, 2024). Please contact school if this was unexpected.</p>
                                    <p class="mb-0"><strong>Recipients:</strong> <span id="recipientCount">3 parents</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="sendSMSNow">Send SMS Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Attendance System Script -->
    <script>
        $(document).ready(function() {
            // Format date for display
            function formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', { 
                    day: 'numeric', 
                    month: 'short', 
                    year: 'numeric' 
                });
            }
            
            // Update date display
            function updateDateDisplay() {
                const date = $('#attendanceDate').val();
                $('#currentDate').text(formatDate(date));
            }
            
            // Initialize date display
            updateDateDisplay();
            
            // Date change handler
            $('#attendanceDate').change(updateDateDisplay);
            
            // Previous day
            $('#prevDay').click(function() {
                const currentDate = new Date($('#attendanceDate').val());
                currentDate.setDate(currentDate.getDate() - 1);
                $('#attendanceDate').val(currentDate.toISOString().split('T')[0]);
                updateDateDisplay();
            });
            
            // Today
            $('#today').click(function() {
                $('#attendanceDate').val(new Date().toISOString().split('T')[0]);
                updateDateDisplay();
            });
            
            // Next day
            $('#nextDay').click(function() {
                const currentDate = new Date($('#attendanceDate').val());
                currentDate.setDate(currentDate.getDate() + 1);
                $('#attendanceDate').val(currentDate.toISOString().split('T')[0]);
                updateDateDisplay();
            });
            
            // Load attendance
            $('#loadAttendance').click(function() {
                const date = $('#attendanceDate').val();
                const classId = $('#classSelect').val();
                const section = $('#sectionSelect').val();
                
                if (!classId) {
                    alert('Please select a class');
                    return;
                }
                
                // Simulate loading attendance data
                $('.card-title').text(`Class 1 - Section ${section} - Attendance for ${formatDate(date)}`);
                
                // Show loading indicator
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Loading...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    updateAttendanceStats();
                }, 1000);
            });
            
            // Update attendance statistics
            function updateAttendanceStats() {
                let present = 0, absent = 0, late = 0, halfDay = 0;
                
                $('.attendance-status-select').each(function() {
                    const status = $(this).val();
                    switch(status) {
                        case 'present': present++; break;
                        case 'absent': absent++; break;
                        case 'late': late++; break;
                        case 'half_day': halfDay++; break;
                    }
                });
                
                const total = present + absent + late + halfDay;
                const percentage = total > 0 ? ((present + late * 0.5) / total * 100).toFixed(1) : 0;
                
                $('#totalStudents').text(total);
                $('#presentCount').text(present);
                $('#absentCount').text(absent);
                $('#lateCount').text(late);
                $('#halfDayCount').text(halfDay);
                $('#attendancePercent').text(percentage + '%');
            }
            
            // Initialize stats
            updateAttendanceStats();
            
            // Status change handler
            $(document).on('change', '.attendance-status-select', function() {
                const status = $(this).val();
                const studentId = $(this).data('student-id');
                const row = $(this).closest('tr');
                const checkIn = row.find('.check-in-time');
                const checkOut = row.find('.check-out-time');
                
                // Update row styling
                row.removeClass('table-success table-danger table-warning table-info table-secondary');
                
                switch(status) {
                    case 'present':
                        row.addClass('table-success');
                        checkIn.prop('disabled', false);
                        checkOut.prop('disabled', false);
                        break;
                    case 'absent':
                        row.addClass('table-danger');
                        checkIn.val('').prop('disabled', true);
                        checkOut.val('').prop('disabled', true);
                        break;
                    case 'late':
                        row.addClass('table-warning');
                        checkIn.prop('disabled', false);
                        checkOut.prop('disabled', false);
                        break;
                    case 'half_day':
                        row.addClass('table-info');
                        checkIn.prop('disabled', false);
                        checkOut.prop('disabled', false);
                        break;
                    case 'holiday':
                        row.addClass('table-secondary');
                        checkIn.prop('disabled', true);
                        checkOut.prop('disabled', true);
                        break;
                }
                
                // Update quick action buttons
                updateQuickActionButtons(studentId, status);
                updateAttendanceStats();
            });
            
            // Update quick action buttons
            function updateQuickActionButtons(studentId, status) {
                const btnGroup = $(`button[data-student-id="${studentId}"]`).closest('.btn-group');
                btnGroup.find('button').removeClass('active');
                
                switch(status) {
                    case 'present':
                        btnGroup.find('.mark-present').addClass('active');
                        break;
                    case 'absent':
                        btnGroup.find('.mark-absent').addClass('active');
                        break;
                    case 'late':
                        btnGroup.find('.mark-late').addClass('active');
                        break;
                    case 'half_day':
                        btnGroup.find('.mark-half-day').addClass('active');
                        break;
                }
            }
            
            // Quick action buttons
            $(document).on('click', '.mark-present', function() {
                const studentId = $(this).data('student-id');
                $(`select[data-student-id="${studentId}"]`).val('present').trigger('change');
            });
            
            $(document).on('click', '.mark-absent', function() {
                const studentId = $(this).data('student-id');
                $(`select[data-student-id="${studentId}"]`).val('absent').trigger('change');
            });
            
            $(document).on('click', '.mark-late', function() {
                const studentId = $(this).data('student-id');
                $(`select[data-student-id="${studentId}"]`).val('late').trigger('change');
            });
            
            $(document).on('click', '.mark-half-day', function() {
                const studentId = $(this).data('student-id');
                $(`select[data-student-id="${studentId}"]`).val('half_day').trigger('change');
            });
            
            // Bulk actions
            $('#markAllPresent').click(function() {
                $('.attendance-status-select').val('present').trigger('change');
            });
            
            $('#markAllAbsent').click(function() {
                $('.attendance-status-select').val('absent').trigger('change');
            });
            
            $('#markAllLate').click(function() {
                $('.attendance-status-select').val('late').trigger('change');
            });
            
            $('#markAllHalfDay').click(function() {
                $('.attendance-status-select').val('half_day').trigger('change');
            });
            
            // Save attendance
            $('#saveAttendance').click(function() {
                const date = $('#attendanceDate').val();
                const classId = $('#classSelect').val();
                const section = $('#sectionSelect').val();
                
                if (!classId) {
                    alert('Please select a class');
                    return;
                }
                
                // Collect attendance data
                const attendanceData = [];
                $('tr', '#attendanceBody').each(function() {
                    const studentId = $(this).find('.attendance-status-select').data('student-id');
                    const status = $(this).find('.attendance-status-select').val();
                    const checkIn = $(this).find('.check-in-time').val();
                    const checkOut = $(this).find('.check-out-time').val();
                    const remarks = $(this).find('.remarks').val();
                    
                    attendanceData.push({
                        student_id: studentId,
                        status: status,
                        check_in: checkIn,
                        check_out: checkOut,
                        remarks: remarks
                    });
                });
                
                // Show saving indicator
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Saving...').prop('disabled', true);
                
                // Simulate API call
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert('Attendance saved successfully for ' + formatDate(date));
                }, 1500);
            });
            
            // SMS functionality
            $('#sendSMSAlerts').click(function() {
                // Count absent students
                const absentCount = $('.attendance-status-select').filter(function() {
                    return $(this).val() === 'absent';
                }).length;
                
                $('#recipientCount').text(absentCount + ' parents');
                $('#smsModal').modal('show');
            });
            
            // Update SMS preview
            $('#messageTemplate, #customMessage').on('input', function() {
                const template = $('#messageTemplate').val();
                let message = '';
                
                if (template === 'custom') {
                    message = $('#customMessage').val() || 'Enter custom message...';
                } else {
                    message = $('#messageTemplate option:selected').text();
                }
                
                // Replace variables
                message = message.replace('[student_name]', 'Alex Johnson')
                                 .replace('[date]', formatDate($('#attendanceDate').val()))
                                 .replace('[check_in_time]', '09:30')
                                 .replace('[class]', 'Class 1')
                                 .replace('[section]', 'Section A');
                
                $('#smsPreview').text(message);
            });
            
            // Send SMS
            $('#sendSMSNow').click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Sending...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    $('#smsModal').modal('hide');
                    alert('SMS alerts sent successfully!');
                }, 2000);
            });
            
            // Print attendance
            $('#printAttendance').click(function() {
                window.print();
            });
            
            // Holiday checkbox
            $('#markHoliday').change(function() {
                if ($(this).is(':checked')) {
                    $('.attendance-status-select').val('holiday').trigger('change');
                    $('#attendanceTable input, #attendanceTable select').prop('disabled', true);
                    $('#saveAttendance').prop('disabled', true);
                } else {
                    $('.attendance-status-select').val('present').trigger('change');
                    $('#attendanceTable input, #attendanceTable select').prop('disabled', false);
                    $('#saveAttendance').prop('disabled', false);
                }
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
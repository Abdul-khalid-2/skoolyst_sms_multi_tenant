<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .attendance-calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            margin-top: 20px;
        }
        
        .calendar-day {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
            min-height: 80px;
            position: relative;
        }
        
        .calendar-day.header {
            background-color: #f8f9fa;
            font-weight: bold;
            min-height: auto;
        }
        
        .day-number {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .attendance-status {
            font-size: 11px;
            padding: 2px 5px;
            border-radius: 3px;
            margin: 1px;
            display: inline-block;
        }
        
        .status-present { background-color: #d4edda; color: #155724; }
        .status-absent { background-color: #f8d7da; color: #721c24; }
        .status-late { background-color: #fff3cd; color: #856404; }
        .status-holiday { background-color: #e2e3e5; color: #383d41; }
        
        .progress-bar-attendance {
            height: 10px;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .chart-container {
            height: 300px;
            position: relative;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Attendance Reports</h4>
                <p class="mb-0">Monthly reports, analytics, and attendance history</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('attendance.daily') }}">Attendance</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-primary" id="generateReport">
                    <i class="las la-file-export mr-2"></i>Export Report
                </button>
            </div>
        </div>

        <!-- Report Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Report Type</label>
                            <select class="form-control" id="reportType">
                                <option value="monthly">Monthly Summary</option>
                                <option value="student">Student Report</option>
                                <option value="class">Class Report</option>
                                <option value="teacher">Teacher Report</option>
                                <option value="absenteeism">Absenteeism Report</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Month</label>
                            <select class="form-control" id="reportMonth">
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
                            <label>Year</label>
                            <select class="form-control" id="reportYear">
                                @for($year = date('Y') - 2; $year <= date('Y'); $year++)
                                    <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Class</label>
                            <select class="form-control" id="reportClass">
                                <option value="all">All Classes</option>
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
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary btn-block" id="generateReportBtn">
                                <i class="las la-chart-bar mr-2"></i>Generate
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Working Days</h6>
                                <h3 class="mb-0">22</h3>
                            </div>
                            <div class="bg-primary rounded p-3">
                                <i class="las la-calendar-alt fa-lg text-white"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small class="text-muted">Month: November 2024</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Average Attendance</h6>
                                <h3 class="mb-0">87.5%</h3>
                            </div>
                            <div class="bg-success rounded p-3">
                                <i class="las la-percentage fa-lg text-white"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="progress-bar-attendance bg-light">
                                <div class="bg-success" style="width: 87.5%; height: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Absences</h6>
                                <h3 class="mb-0">45</h3>
                            </div>
                            <div class="bg-danger rounded p-3">
                                <i class="las la-user-times fa-lg text-white"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small class="text-muted">Average: 2.0 per day</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Late Arrivals</h6>
                                <h3 class="mb-0">28</h3>
                            </div>
                            <div class="bg-warning rounded p-3">
                                <i class="las la-clock fa-lg text-white"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small class="text-muted">Average: 1.3 per day</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Attendance Report -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Monthly Attendance Summary - Class 1 (November 2024)</h5>
            </div>
            <div class="card-body">
                <!-- Attendance Calendar -->
                <div class="mb-4">
                    <h6 class="mb-3">Attendance Calendar</h6>
                    <div class="attendance-calendar" id="attendanceCalendar">
                        <!-- Calendar headers will be generated by JavaScript -->
                    </div>
                </div>

                <!-- Student-wise Attendance Table -->
                <div class="mt-5">
                    <h6 class="mb-3">Student-wise Attendance Details</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Present</th>
                                    <th>Absent</th>
                                    <th>Late</th>
                                    <th>Half Day</th>
                                    <th>Total Days</th>
                                    <th>Attendance %</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Student 1 -->
                                <tr>
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
                                        <span class="badge badge-success">20</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger">2</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-warning">0</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">0</span>
                                    </td>
                                    <td>22</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 mr-2" style="height: 8px;">
                                                <div class="progress-bar bg-success" style="width: 90.9%"></div>
                                            </div>
                                            <span>90.9%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary view-student-report" data-student-id="1">
                                            <i class="las la-eye mr-1"></i> View
                                        </button>
                                    </td>
                                </tr>

                                <!-- Student 2 -->
                                <tr>
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
                                        <span class="badge badge-success">21</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger">1</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-warning">0</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">0</span>
                                    </td>
                                    <td>22</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 mr-2" style="height: 8px;">
                                                <div class="progress-bar bg-success" style="width: 95.5%"></div>
                                            </div>
                                            <span>95.5%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary view-student-report" data-student-id="2">
                                            <i class="las la-eye mr-1"></i> View
                                        </button>
                                    </td>
                                </tr>

                                <!-- Student 3 (Poor Attendance) -->
                                <tr class="table-warning">
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
                                        <span class="badge badge-success">15</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger">7</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-warning">3</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">0</span>
                                    </td>
                                    <td>22</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 mr-2" style="height: 8px;">
                                                <div class="progress-bar bg-warning" style="width: 68.2%"></div>
                                            </div>
                                            <span>68.2%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary view-student-report" data-student-id="3">
                                            <i class="las la-eye mr-1"></i> View
                                        </button>
                                    </td>
                                </tr>

                                <!-- Student 4 -->
                                <tr>
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
                                        <span class="badge badge-success">19</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger">2</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-warning">1</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">0</span>
                                    </td>
                                    <td>22</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 mr-2" style="height: 8px;">
                                                <div class="progress-bar bg-success" style="width: 86.4%"></div>
                                            </div>
                                            <span>86.4%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary view-student-report" data-student-id="4">
                                            <i class="las la-eye mr-1"></i> View
                                        </button>
                                    </td>
                                </tr>

                                <!-- Student 5 (Excellent Attendance) -->
                                <tr class="table-success">
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
                                        <span class="badge badge-success">22</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger">0</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-warning">0</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">0</span>
                                    </td>
                                    <td>22</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 mr-2" style="height: 8px;">
                                                <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                            <span>100%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary view-student-report" data-student-id="5">
                                            <i class="las la-eye mr-1"></i> View
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance Analytics -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Attendance Trends - Last 6 Months</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <!-- Chart will be generated by JavaScript -->
                            <canvas id="attendanceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Top Absent Students</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach([
                                ['name' => 'Ethan Brown', 'absent' => 7, 'percentage' => 68.2],
                                ['name' => 'Liam Taylor', 'absent' => 6, 'percentage' => 72.7],
                                ['name' => 'Olivia Wilson', 'absent' => 5, 'percentage' => 77.3],
                                ['name' => 'James Anderson', 'absent' => 4, 'percentage' => 81.8],
                                ['name' => 'Emma Martinez', 'absent' => 4, 'percentage' => 81.8]
                            ] as $student)
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $student['name'] }}</h6>
                                    <small class="text-danger">{{ $student['absent'] }} absences</small>
                                </div>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-warning" style="width: {{ $student['percentage'] }}%"></div>
                                </div>
                                <small class="text-muted">Attendance: {{ $student['percentage'] }}%</small>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Report Section -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detailed Attendance Analysis</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-3">Attendance by Day of Week</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Average Attendance</th>
                                    <th>Absences</th>
                                    <th>Trend</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach([
                                    ['day' => 'Monday', 'attendance' => 85, 'absences' => 5, 'trend' => 'down'],
                                    ['day' => 'Tuesday', 'attendance' => 88, 'absences' => 4, 'trend' => 'up'],
                                    ['day' => 'Wednesday', 'attendance' => 90, 'absences' => 3, 'trend' => 'up'],
                                    ['day' => 'Thursday', 'attendance' => 87, 'absences' => 4, 'trend' => 'down'],
                                    ['day' => 'Friday', 'attendance' => 82, 'absences' => 6, 'trend' => 'down']
                                ] as $day)
                                <tr>
                                    <td>{{ $day['day'] }}</td>
                                    <td>{{ $day['attendance'] }}%</td>
                                    <td>{{ $day['absences'] }}</td>
                                    <td>
                                        @if($day['trend'] == 'up')
                                        <i class="las la-arrow-up text-success"></i>
                                        @else
                                        <i class="las la-arrow-down text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-3">Late Arrival Analysis</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Time Range</th>
                                    <th>Students</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Before 8:00 AM</td>
                                    <td>28</td>
                                    <td>80%</td>
                                </tr>
                                <tr>
                                    <td>8:00 - 8:30 AM</td>
                                    <td>5</td>
                                    <td>14.3%</td>
                                </tr>
                                <tr>
                                    <td>8:30 - 9:00 AM</td>
                                    <td>2</td>
                                    <td>5.7%</td>
                                </tr>
                                <tr>
                                    <td>After 9:00 AM</td>
                                    <td>0</td>
                                    <td>0%</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <!-- Report Actions -->
                        <div class="mt-4">
                            <h6 class="mb-3">Report Actions</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <button class="btn btn-outline-primary btn-block" id="printReport">
                                        <i class="las la-print mr-2"></i> Print Report
                                    </button>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <button class="btn btn-outline-success btn-block" id="exportPDF">
                                        <i class="las la-file-pdf mr-2"></i> Export PDF
                                    </button>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <button class="btn btn-outline-info btn-block" id="exportExcel">
                                        <i class="las la-file-excel mr-2"></i> Export Excel
                                    </button>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <button class="btn btn-outline-warning btn-block" id="sendReportEmail">
                                        <i class="las la-envelope mr-2"></i> Email Report
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Detail Modal -->
        <div class="modal fade" id="studentDetailModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Student Attendance Details</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="studentDetailContent">
                            <!-- Content will be loaded dynamically -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="printStudentReport">
                            <i class="las la-print mr-2"></i> Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Attendance Reports Script -->
    <script>
        $(document).ready(function() {
            // Generate attendance calendar
            function generateCalendar(year, month) {
                const calendarEl = $('#attendanceCalendar');
                calendarEl.empty();
                
                // Day headers
                const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                days.forEach(day => {
                    calendarEl.append(`<div class="calendar-day header">${day}</div>`);
                });
                
                // Get first day of month
                const firstDay = new Date(year, month - 1, 1).getDay();
                const daysInMonth = new Date(year, month, 0).getDate();
                
                // Add empty cells for days before first day
                for (let i = 0; i < firstDay; i++) {
                    calendarEl.append('<div class="calendar-day"></div>');
                }
                
                // Add days of month
                for (let day = 1; day <= daysInMonth; day++) {
                    const date = new Date(year, month - 1, day);
                    const dayOfWeek = date.getDay();
                    
                    // Determine attendance status for demo
                    let status = 'present';
                    let statusClass = 'status-present';
                    let statusText = 'P';
                    
                    if (day % 7 === 0) { // Sunday
                        status = 'holiday';
                        statusClass = 'status-holiday';
                        statusText = 'H';
                    } else if (day % 10 === 0) { // Every 10th day
                        status = 'absent';
                        statusClass = 'status-absent';
                        statusText = 'A';
                    } else if (day % 5 === 0) { // Every 5th day
                        status = 'late';
                        statusClass = 'status-late';
                        statusText = 'L';
                    }
                    
                    const calendarDay = `
                        <div class="calendar-day">
                            <div class="day-number">${day}</div>
                            <div class="${statusClass} attendance-status">${statusText}</div>
                            <small class="text-muted">${days[dayOfWeek]}</small>
                        </div>
                    `;
                    
                    calendarEl.append(calendarDay);
                }
            }
            
            // Initialize calendar
            const currentYear = $('#reportYear').val();
            const currentMonth = $('#reportMonth').val();
            generateCalendar(currentYear, currentMonth);
            
            // Update calendar when month/year changes
            $('#reportMonth, #reportYear').change(function() {
                const year = $('#reportYear').val();
                const month = $('#reportMonth').val();
                generateCalendar(year, month);
            });
            
            // Generate report
            $('#generateReportBtn').click(function() {
                const reportType = $('#reportType').val();
                const month = $('#reportMonth').val();
                const year = $('#reportYear').val();
                const classId = $('#reportClass').val();
                
                const monthNames = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];
                
                // Update title
                $('.card-title').text(`Monthly Attendance Summary - Class 1 (${monthNames[month-1]} ${year})`);
                
                // Show loading
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Generating...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert(`${reportType} report generated for ${monthNames[month-1]} ${year}`);
                }, 1500);
            });
            
            // Initialize chart
            const ctx = document.getElementById('attendanceChart').getContext('2d');
            const attendanceChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'],
                    datasets: [{
                        label: 'Attendance %',
                        data: [85, 82, 88, 86, 89, 87.5],
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }, {
                        label: 'Absences',
                        data: [40, 45, 35, 42, 38, 45],
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            min: 50,
                            title: {
                                display: true,
                                text: 'Percentage / Count'
                            }
                        }
                    }
                }
            });
            
            // View student report
            $('.view-student-report').click(function() {
                const studentId = $(this).data('student-id');
                const studentName = $(this).closest('tr').find('h6').text();
                
                // Load student details
                $('#studentDetailContent').html(`
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p>Loading student details...</p>
                    </div>
                `);
                
                $('#studentDetailModal .modal-title').text(`Attendance Report - ${studentName}`);
                $('#studentDetailModal').modal('show');
                
                // Simulate API call
                setTimeout(function() {
                    $('#studentDetailContent').html(`
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center mb-3">
                                    <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(studentName)}&background=007bff&color=fff&size=100" 
                                         class="rounded-circle mb-3" alt="${studentName}">
                                    <h5>${studentName}</h5>
                                    <p class="text-muted">Roll: 1-A-0${studentId}</p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6>Attendance Summary - November 2024</h6>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h3 class="text-success mb-0">20</h3>
                                                <small class="text-muted">Present Days</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h3 class="text-danger mb-0">2</h3>
                                                <small class="text-muted">Absent Days</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <h6 class="mt-4">Attendance Details</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Check In</th>
                                                <th>Check Out</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01 Nov 2024</td>
                                                <td><span class="badge badge-success">Present</span></td>
                                                <td>08:00</td>
                                                <td>14:00</td>
                                                <td></td>
                                            </tr>
                                            <tr class="table-danger">
                                                <td>05 Nov 2024</td>
                                                <td><span class="badge badge-danger">Absent</span></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>Sick Leave</td>
                                            </tr>
                                            <tr>
                                                <td>10 Nov 2024</td>
                                                <td><span class="badge badge-success">Present</span></td>
                                                <td>08:05</td>
                                                <td>14:00</td>
                                                <td></td>
                                            </tr>
                                            <tr class="table-danger">
                                                <td>15 Nov 2024</td>
                                                <td><span class="badge badge-danger">Absent</span></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>Family Function</td>
                                            </tr>
                                            <tr>
                                                <td>20 Nov 2024</td>
                                                <td><span class="badge badge-success">Present</span></td>
                                                <td>08:00</td>
                                                <td>14:00</td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="alert alert-info mt-3">
                                    <h6><i class="las la-info-circle mr-2"></i> Attendance Statistics</h6>
                                    <p class="mb-1"><strong>Overall Attendance:</strong> 90.9%</p>
                                    <p class="mb-1"><strong>Working Days:</strong> 22</p>
                                    <p class="mb-1"><strong>Present Days:</strong> 20</p>
                                    <p class="mb-1"><strong>Absent Days:</strong> 2</p>
                                    <p class="mb-0"><strong>Late Arrivals:</strong> 0</p>
                                </div>
                            </div>
                        </div>
                    `);
                }, 1000);
            });
            
            // Print student report
            $('#printStudentReport').click(function() {
                const studentName = $('#studentDetailModal .modal-title').text().replace('Attendance Report - ', '');
                alert(`Printing report for ${studentName}`);
            });
            
            // Export actions
            $('#printReport').click(function() {
                window.print();
            });
            
            $('#exportPDF').click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Exporting...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert('PDF report exported successfully!');
                }, 2000);
            });
            
            $('#exportExcel').click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Exporting...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert('Excel report exported successfully!');
                }, 2000);
            });
            
            $('#sendReportEmail').click(function() {
                $('#emailReportModal').modal('show');
            });
            
            // Main export button
            $('#generateReport').click(function() {
                const reportType = $('#reportType').val();
                const month = $('#reportMonth').val();
                const year = $('#reportYear').val();
                
                const monthNames = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];
                
                alert(`Exporting ${reportType} report for ${monthNames[month-1]} ${year}...`);
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
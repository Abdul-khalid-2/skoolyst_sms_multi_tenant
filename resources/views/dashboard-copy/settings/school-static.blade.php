<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .settings-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .settings-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .settings-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 20px;
            margin-right: 15px;
        }
        
        .logo-preview {
            width: 150px;
            height: 150px;
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            overflow: hidden;
        }
        
        .logo-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        
        .color-picker {
            width: 40px;
            height: 40px;
            border-radius: 5px;
            border: 2px solid #fff;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .settings-tabs .nav-link {
            padding: 12px 20px;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }
        
        .settings-tabs .nav-link.active {
            background-color: #007bff;
            color: white;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">School Settings</h4>
                <p class="mb-0">Configure school information, appearance, and system preferences</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">School Settings</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-primary" id="saveAllSettings">
                    <i class="las la-save mr-2"></i>Save All Settings
                </button>
            </div>
        </div>

        <div class="row">
            <!-- Left Sidebar - Settings Navigation -->
            <div class="col-lg-3">
                <div class="card settings-card mb-4">
                    <div class="card-body settings-tabs">
                        <div class="nav flex-column nav-pills" id="settingsTab" role="tablist">
                            <a class="nav-link active" data-toggle="pill" href="#general">
                                <i class="las la-cog mr-2"></i>General
                            </a>
                            <a class="nav-link" data-toggle="pill" href="#appearance">
                                <i class="las la-palette mr-2"></i>Appearance
                            </a>
                            <a class="nav-link" data-toggle="pill" href="#academic">
                                <i class="las la-graduation-cap mr-2"></i>Academic
                            </a>
                            <a class="nav-link" data-toggle="pill" href="#fee">
                                <i class="las la-money-bill-wave mr-2"></i>Fee Settings
                            </a>
                            <a class="nav-link" data-toggle="pill" href="#attendance">
                                <i class="las la-calendar-check mr-2"></i>Attendance
                            </a>
                            <a class="nav-link" data-toggle="pill" href="#notification">
                                <i class="las la-bell mr-2"></i>Notifications
                            </a>
                            <a class="nav-link" data-toggle="pill" href="#security">
                                <i class="las la-shield-alt mr-2"></i>Security
                            </a>
                            <a class="nav-link" data-toggle="pill" href="#backup">
                                <i class="las la-database mr-2"></i>Backup
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="card settings-card">
                    <div class="card-body">
                        <h6 class="card-title">Quick Actions</h6>
                        <button class="btn btn-sm btn-outline-primary btn-block mb-2">
                            <i class="las la-download mr-2"></i>Export Settings
                        </button>
                        <button class="btn btn-sm btn-outline-success btn-block mb-2">
                            <i class="las la-upload mr-2"></i>Import Settings
                        </button>
                        <button class="btn btn-sm btn-outline-warning btn-block mb-2">
                            <i class="las la-undo mr-2"></i>Reset to Default
                        </button>
                        <button class="btn btn-sm btn-outline-danger btn-block">
                            <i class="las la-trash mr-2"></i>Clear Cache
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Content - Settings Forms -->
            <div class="col-lg-9">
                <div class="tab-content" id="settingsTabContent">
                    <!-- General Settings Tab -->
                    <div class="tab-pane fade show active" id="general">
                        <div class="card settings-card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">General Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>School Name *</label>
                                            <input type="text" class="form-control" value="Bright Future School">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>School Code</label>
                                            <input type="text" class="form-control" value="BFS001">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address *</label>
                                            <input type="email" class="form-control" value="info@brightfuture.edu.pk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number *</label>
                                            <input type="text" class="form-control" value="+92 300 1234567">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" rows="3">123 Education Street, Lahore, Pakistan</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Website</label>
                                            <input type="url" class="form-control" value="https://www.brightfuture.edu.pk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Established Year</label>
                                            <input type="number" class="form-control" value="2010">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">School Logo & Branding</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>School Logo</label>
                                            <div class="logo-preview mb-3" id="logoPreview">
                                                <i class="las la-school fa-3x text-muted"></i>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="logoUpload">
                                                <label class="custom-file-label" for="logoUpload">Choose logo file</label>
                                            </div>
                                            <small class="form-text text-muted">Recommended: 300x300px PNG or JPG (max 2MB)</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Favicon</label>
                                            <div class="logo-preview mb-3" style="width: 100px; height: 100px;" id="faviconPreview">
                                                <i class="las la-flag fa-2x text-muted"></i>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="faviconUpload">
                                                <label class="custom-file-label" for="faviconUpload">Choose favicon file</label>
                                            </div>
                                            <small class="form-text text-muted">Recommended: 64x64px ICO or PNG (max 500KB)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Appearance Settings Tab -->
                    <div class="tab-pane fade" id="appearance">
                        <div class="card settings-card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Theme & Colors</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Primary Color</label>
                                            <div class="d-flex align-items-center">
                                                <div class="color-picker mr-3" style="background-color: #007bff;" id="primaryColor"></div>
                                                <input type="text" class="form-control" value="#007bff" id="primaryColorInput">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Secondary Color</label>
                                            <div class="d-flex align-items-center">
                                                <div class="color-picker mr-3" style="background-color: #6c757d;" id="secondaryColor"></div>
                                                <input type="text" class="form-control" value="#6c757d" id="secondaryColorInput">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Success Color</label>
                                            <div class="d-flex align-items-center">
                                                <div class="color-picker mr-3" style="background-color: #28a745;" id="successColor"></div>
                                                <input type="text" class="form-control" value="#28a745" id="successColorInput">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Danger Color</label>
                                            <div class="d-flex align-items-center">
                                                <div class="color-picker mr-3" style="background-color: #dc3545;" id="dangerColor"></div>
                                                <input type="text" class="form-control" value="#dc3545" id="dangerColorInput">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Theme</label>
                                            <select class="form-control">
                                                <option value="light" selected>Light Theme</option>
                                                <option value="dark">Dark Theme</option>
                                                <option value="auto">Auto (System Preference)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Layout & Display</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sidebar Style</label>
                                            <select class="form-control">
                                                <option value="default" selected>Default</option>
                                                <option value="compact">Compact</option>
                                                <option value="icon-only">Icons Only</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Dashboard Style</label>
                                            <select class="form-control">
                                                <option value="modern" selected>Modern</option>
                                                <option value="classic">Classic</option>
                                                <option value="minimal">Minimal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="fixedHeader" checked>
                                                <label class="custom-control-label" for="fixedHeader">
                                                    Fixed Header
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="fixedSidebar" checked>
                                                <label class="custom-control-label" for="fixedSidebar">
                                                    Fixed Sidebar
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="showBreadcrumb" checked>
                                                <label class="custom-control-label" for="showBreadcrumb">
                                                    Show Breadcrumb
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="animations" checked>
                                                <label class="custom-control-label" for="animations">
                                                    Enable Animations
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Settings Tab -->
                    <div class="tab-pane fade" id="academic">
                        <div class="card settings-card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Academic Configuration</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Current Academic Year *</label>
                                            <select class="form-control">
                                                <option value="2024-2025" selected>2024-2025</option>
                                                <option value="2023-2024">2023-2024</option>
                                                <option value="2022-2023">2022-2023</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Education System</label>
                                            <select class="form-control">
                                                <option value="matric" selected>Matriculation</option>
                                                <option value="cambridge">Cambridge</option>
                                                <option value="ib">International Baccalaureate</option>
                                                <option value="american">American Curriculum</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Default Class Capacity</label>
                                            <input type="number" class="form-control" value="30">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Max Students per Section</label>
                                            <input type="number" class="form-control" value="40">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Academic Session Start Month</label>
                                            <select class="form-control">
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8" selected>August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Academic Session End Month</label>
                                            <select class="form-control">
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6" selected>June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Exam & Grading System</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Grading System</label>
                                            <select class="form-control">
                                                <option value="percentage" selected>Percentage</option>
                                                <option value="letter">Letter Grades</option>
                                                <option value="gpa">GPA</option>
                                                <option value="cgpa">CGPA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Default Passing Percentage</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" value="40">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="autoPromote" checked>
                                                <label class="custom-control-label" for="autoPromote">
                                                    Auto-promote students
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="showPosition" checked>
                                                <label class="custom-control-label" for="showPosition">
                                                    Show position in results
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="publishResults">
                                                <label class="custom-control-label" for="publishResults">
                                                    Publish results online
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fee Settings Tab -->
                    <div class="tab-pane fade" id="fee">
                        <div class="card settings-card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Fee Configuration</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Currency *</label>
                                            <select class="form-control">
                                                <option value="PKR" selected>Pakistani Rupee (PKR)</option>
                                                <option value="USD">US Dollar (USD)</option>
                                                <option value="EUR">Euro (EUR)</option>
                                                <option value="GBP">British Pound (GBP)</option>
                                                <option value="AED">UAE Dirham (AED)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Currency Symbol</label>
                                            <input type="text" class="form-control" value="PKR">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Default Fee Due Days</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" value="10">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">days</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Late Fee Amount</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">PKR</span>
                                                </div>
                                                <input type="number" class="form-control" value="500">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Late Fee Type</label>
                                            <select class="form-control">
                                                <option value="fixed" selected>Fixed Amount</option>
                                                <option value="percentage">Percentage</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Late Fee Percentage</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" value="5">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Payment & Invoice Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="partialPayment" checked>
                                                <label class="custom-control-label" for="partialPayment">
                                                    Allow partial payments
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="autoGenerateInvoice">
                                                <label class="custom-control-label" for="autoGenerateInvoice">
                                                    Auto-generate monthly invoices
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="sendReceipt">
                                                <label class="custom-control-label" for="sendReceipt">
                                                    Auto-send payment receipts
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="reminderSMS">
                                                <label class="custom-control-label" for="reminderSMS">
                                                    Send SMS reminders for due payments
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Invoice Prefix</label>
                                            <input type="text" class="form-control" value="INV">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Receipt Prefix</label>
                                            <input type="text" class="form-control" value="RCPT">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Settings Tab -->
                    <div class="tab-pane fade" id="attendance">
                        <div class="card settings-card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Attendance Configuration</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Default Attendance Method</label>
                                            <select class="form-control">
                                                <option value="daily" selected>Daily Attendance</option>
                                                <option value="period">Period-wise</option>
                                                <option value="subject">Subject-wise</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Attendance Cut-off Time</label>
                                            <input type="time" class="form-control" value="09:30">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Default Present Mark</label>
                                            <input type="text" class="form-control" value="P">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Default Absent Mark</label>
                                            <input type="text" class="form-control" value="A">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Default Late Mark</label>
                                            <input type="text" class="form-control" value="L">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Default Half Day Mark</label>
                                            <input type="text" class="form-control" value="H">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">SMS Alerts Configuration</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="absentSMS" checked>
                                                <label class="custom-control-label" for="absentSMS">
                                                    Send SMS for absent students
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="dailySMS">
                                                <label class="custom-control-label" for="dailySMS">
                                                    Send daily attendance summary
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>SMS Send Time</label>
                                            <input type="time" class="form-control" value="16:00">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>SMS Provider</label>
                                            <select class="form-control">
                                                <option value="telenor" selected>Telenor</option>
                                                <option value="jazz">Jazz</option>
                                                <option value="zong">Zong</option>
                                                <option value="ufone">Ufone</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Absent SMS Template</label>
                                            <textarea class="form-control" rows="3">
Dear Parent, Your child {student_name} was absent from school today ({date}). Please contact school for more information.
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Settings Tab -->
                    <div class="tab-pane fade" id="notification">
                        <div class="card settings-card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Notification Preferences</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Email Notifications</h6>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="emailNewUser" checked>
                                                <label class="custom-control-label" for="emailNewUser">New user registration</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="emailPayment" checked>
                                                <label class="custom-control-label" for="emailPayment">Payment received</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="emailAttendance" checked>
                                                <label class="custom-control-label" for="emailAttendance">Daily attendance</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="emailExam" checked>
                                                <label class="custom-control-label" for="emailExam">Exam results</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>SMS Notifications</h6>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="smsFeeReminder" checked>
                                                <label class="custom-control-label" for="smsFeeReminder">Fee payment reminders</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="smsAttendance" checked>
                                                <label class="custom-control-label" for="smsAttendance">Attendance alerts</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="smsHoliday">
                                                <label class="custom-control-label" for="smsHoliday">Holiday announcements</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="smsEmergency">
                                                <label class="custom-control-label" for="smsEmergency">Emergency alerts</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Push Notifications</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="pushEnabled" checked>
                                                <label class="custom-control-label" for="pushEnabled">
                                                    Enable push notifications
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Firebase Server Key</label>
                                            <input type="password" class="form-control" placeholder="Enter Firebase server key">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sender ID</label>
                                            <input type="text" class="form-control" placeholder="Sender ID">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="las la-vial mr-2"></i> Test Notification
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Settings Tab -->
                    <div class="tab-pane fade" id="security">
                        <div class="card settings-card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Login & Authentication</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Session Timeout</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" value="30">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">minutes</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Max Login Attempts</label>
                                            <input type="number" class="form-control" value="5">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Lockout Duration</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" value="15">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">minutes</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password Expiry Days</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" value="90">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">days</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="twoFactorAuth">
                                                <label class="custom-control-label" for="twoFactorAuth">
                                                    Enable Two-Factor Authentication
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="captchaLogin">
                                                <label class="custom-control-label" for="captchaLogin">
                                                    Enable CAPTCHA on login
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="ipRestriction">
                                                <label class="custom-control-label" for="ipRestriction">
                                                    Restrict login by IP
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Data Security</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="dataEncryption" checked>
                                                <label class="custom-control-label" for="dataEncryption">
                                                    Encrypt sensitive data
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="auditLog">
                                                <label class="custom-control-label" for="auditLog">
                                                    Enable audit logging
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <i class="las la-info-circle mr-2"></i>
                                            <strong>Security Tip:</strong> Regular security audits and updates are recommended to protect your data.
                                        </div>
                                        <button class="btn btn-warning">
                                            <i class="las la-shield-alt mr-2"></i> Run Security Scan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Backup Settings Tab -->
                    <div class="tab-pane fade" id="backup">
                        <div class="card settings-card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Backup Configuration</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Backup Frequency</label>
                                            <select class="form-control">
                                                <option value="daily" selected>Daily</option>
                                                <option value="weekly">Weekly</option>
                                                <option value="monthly">Monthly</option>
                                                <option value="manual">Manual Only</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Backup Time</label>
                                            <input type="time" class="form-control" value="02:00">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Backup Retention</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" value="30">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">days</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Max Backup Size</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" value="1024">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MB</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Backup Storage</label>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="storageLocal" name="storage" class="custom-control-input" checked>
                                                <label class="custom-control-label" for="storageLocal">Local Server</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="storageGoogle" name="storage" class="custom-control-input">
                                                <label class="custom-control-label" for="storageGoogle">Google Drive</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="storageDropbox" name="storage" class="custom-control-input">
                                                <label class="custom-control-label" for="storageDropbox">Dropbox</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="autoBackup" checked>
                                                <label class="custom-control-label" for="autoBackup">
                                                    Enable automatic backups
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="emailBackup">
                                                <label class="custom-control-label" for="emailBackup">
                                                    Email backup notifications
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Backup Actions</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <button class="btn btn-primary btn-block">
                                            <i class="las la-download mr-2"></i> Create Backup Now
                                        </button>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <button class="btn btn-success btn-block">
                                            <i class="las la-upload mr-2"></i> Restore Backup
                                        </button>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <button class="btn btn-warning btn-block">
                                            <i class="las la-history mr-2"></i> View Backup History
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="alert alert-warning">
                                    <i class="las la-exclamation-triangle mr-2"></i>
                                    <strong>Important:</strong> Last backup was created on 24 Dec 2024 02:30 AM. Regular backups are essential for data security.
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
    
    <!-- School Settings Script -->
    <script>
        $(document).ready(function() {
            // File input labels
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
            
            // Color picker functionality
            $('.color-picker').click(function() {
                const colorInput = $(this).next('input');
                const currentColor = colorInput.val();
                
                // In a real app, this would open a color picker
                const newColor = prompt('Enter color code (hex):', currentColor);
                if (newColor && /^#[0-9A-F]{6}$/i.test(newColor)) {
                    $(this).css('background-color', newColor);
                    colorInput.val(newColor);
                }
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
            
            // Quick actions
            $('.btn-outline-primary').eq(0).click(function() {
                alert('Settings exported successfully!');
            });
            
            $('.btn-outline-success').eq(0).click(function() {
                alert('Please select a settings file to import.');
            });
            
            $('.btn-outline-warning').eq(0).click(function() {
                if (confirm('Are you sure you want to reset all settings to default? This action cannot be undone.')) {
                    alert('Settings reset to default values.');
                }
            });
            
            $('.btn-outline-danger').eq(0).click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Clearing...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert('Cache cleared successfully!');
                }, 1500);
            });
            
            // Backup actions
            $('.btn-primary').last().click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Creating...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert('Backup created successfully! File: backup_20241225_1430.zip');
                }, 3000);
            });
            
            $('.btn-success').last().click(function() {
                alert('Please select a backup file to restore.');
            });
            
            $('.btn-warning').last().click(function() {
                alert('Opening backup history...');
            });
            
            // Test notification
            $('.btn-sm.btn-primary').last().click(function() {
                alert('Test notification sent successfully!');
            });
            
            // Run security scan
            $('.btn-warning').last().click(function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Scanning...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    alert('Security scan completed. No issues found.');
                }, 2500);
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
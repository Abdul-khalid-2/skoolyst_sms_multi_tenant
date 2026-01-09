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
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
    </style>
    @endpush

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">School Settings</h4>
                <p class="mb-0">Configure school information, appearance, and system preferences</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">School Settings</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-primary" id="saveAllSettings">
                    <i class="las la-save mr-2"></i>Save All Settings
                </button>
            </div>
        </div>

        <form id="settingsForm">
            @csrf
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
                            <button type="button" class="btn btn-sm btn-outline-primary btn-block mb-2" id="exportSettings">
                                <i class="las la-download mr-2"></i>Export Settings
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-success btn-block mb-2" id="importSettings">
                                <i class="las la-upload mr-2"></i>Import Settings
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-warning btn-block mb-2" id="resetSettings">
                                <i class="las la-undo mr-2"></i>Reset to Default
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-block" id="clearCache">
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
                                                <input type="text" class="form-control" name="setting_general_school_name" 
                                                       value="{{ $groupedSettings['general']['school_name'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>School Code</label>
                                                <input type="text" class="form-control" name="setting_general_school_code"
                                                       value="{{ $groupedSettings['general']['school_code'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address *</label>
                                                <input type="email" class="form-control" name="setting_general_email"
                                                       value="{{ $groupedSettings['general']['email'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number *</label>
                                                <input type="text" class="form-control" name="setting_general_phone"
                                                       value="{{ $groupedSettings['general']['phone'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" rows="3" name="setting_general_address">{{ $groupedSettings['general']['address'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Website</label>
                                                <input type="url" class="form-control" name="setting_general_website"
                                                       value="{{ $groupedSettings['general']['website'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Established Year</label>
                                                <input type="number" class="form-control" name="setting_general_established_year"
                                                       value="{{ $groupedSettings['general']['established_year'] ?? '' }}">
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
                                                    @if(isset($groupedSettings['general']['logo']) && $groupedSettings['general']['logo'])
                                                        <img src="{{ Storage::url($groupedSettings['general']['logo']) }}" alt="School Logo">
                                                    @else
                                                        <i class="las la-school fa-3x text-muted"></i>
                                                    @endif
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="logoUpload" data-type="logo">
                                                    <label class="custom-file-label" for="logoUpload">Choose logo file</label>
                                                </div>
                                                <small class="form-text text-muted">Recommended: 300x300px PNG or JPG (max 2MB)</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Favicon</label>
                                                <div class="logo-preview mb-3" style="width: 100px; height: 100px;" id="faviconPreview">
                                                    @if(isset($groupedSettings['general']['favicon']) && $groupedSettings['general']['favicon'])
                                                        <img src="{{ Storage::url($groupedSettings['general']['favicon']) }}" alt="Favicon">
                                                    @else
                                                        <i class="las la-flag fa-2x text-muted"></i>
                                                    @endif
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="faviconUpload" data-type="favicon">
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
                                                    <div class="color-picker mr-3" id="primaryColorPicker" 
                                                         style="background-color: {{ $groupedSettings['appearance']['primary_color'] ?? '#007bff' }}"></div>
                                                    <input type="text" class="form-control" name="setting_appearance_primary_color" 
                                                           id="primaryColorInput" value="{{ $groupedSettings['appearance']['primary_color'] ?? '#007bff' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Secondary Color</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="color-picker mr-3" id="secondaryColorPicker"
                                                         style="background-color: {{ $groupedSettings['appearance']['secondary_color'] ?? '#6c757d' }}"></div>
                                                    <input type="text" class="form-control" name="setting_appearance_secondary_color"
                                                           id="secondaryColorInput" value="{{ $groupedSettings['appearance']['secondary_color'] ?? '#6c757d' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Success Color</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="color-picker mr-3" id="successColorPicker"
                                                         style="background-color: {{ $groupedSettings['appearance']['success_color'] ?? '#28a745' }}"></div>
                                                    <input type="text" class="form-control" name="setting_appearance_success_color"
                                                           id="successColorInput" value="{{ $groupedSettings['appearance']['success_color'] ?? '#28a745' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Danger Color</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="color-picker mr-3" id="dangerColorPicker"
                                                         style="background-color: {{ $groupedSettings['appearance']['danger_color'] ?? '#dc3545' }}"></div>
                                                    <input type="text" class="form-control" name="setting_appearance_danger_color"
                                                           id="dangerColorInput" value="{{ $groupedSettings['appearance']['danger_color'] ?? '#dc3545' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Theme</label>
                                                <select class="form-control" name="setting_appearance_theme">
                                                    <option value="light" {{ ($groupedSettings['appearance']['theme'] ?? 'light') == 'light' ? 'selected' : '' }}>Light Theme</option>
                                                    <option value="dark" {{ ($groupedSettings['appearance']['theme'] ?? 'light') == 'dark' ? 'selected' : '' }}>Dark Theme</option>
                                                    <option value="auto" {{ ($groupedSettings['appearance']['theme'] ?? 'light') == 'auto' ? 'selected' : '' }}>Auto (System Preference)</option>
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
                                                <select class="form-control" name="setting_appearance_sidebar_style">
                                                    <option value="default" {{ ($groupedSettings['appearance']['sidebar_style'] ?? 'default') == 'default' ? 'selected' : '' }}>Default</option>
                                                    <option value="compact" {{ ($groupedSettings['appearance']['sidebar_style'] ?? 'default') == 'compact' ? 'selected' : '' }}>Compact</option>
                                                    <option value="icon-only" {{ ($groupedSettings['appearance']['sidebar_style'] ?? 'default') == 'icon-only' ? 'selected' : '' }}>Icons Only</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Dashboard Style</label>
                                                <select class="form-control" name="setting_appearance_dashboard_style">
                                                    <option value="modern" {{ ($groupedSettings['appearance']['dashboard_style'] ?? 'modern') == 'modern' ? 'selected' : '' }}>Modern</option>
                                                    <option value="classic" {{ ($groupedSettings['appearance']['dashboard_style'] ?? 'modern') == 'classic' ? 'selected' : '' }}>Classic</option>
                                                    <option value="minimal" {{ ($groupedSettings['appearance']['dashboard_style'] ?? 'modern') == 'minimal' ? 'selected' : '' }}>Minimal</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="animations" name="setting_appearance_animations" value="1"
                                                           {{ ($groupedSettings['appearance']['animations'] ?? '0') == '1' ? 'checked' : '' }}>
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
                                                <select class="form-control" name="setting_academic_current_academic_year">
                                                    <option value="2024-2025" {{ ($groupedSettings['academic']['current_academic_year'] ?? '2024-2025') == '2024-2025' ? 'selected' : '' }}>2024-2025</option>
                                                    <option value="2023-2024" {{ ($groupedSettings['academic']['current_academic_year'] ?? '2024-2025') == '2023-2024' ? 'selected' : '' }}>2023-2024</option>
                                                    <option value="2022-2023" {{ ($groupedSettings['academic']['current_academic_year'] ?? '2024-2025') == '2022-2023' ? 'selected' : '' }}>2022-2023</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Education System</label>
                                                <select class="form-control" name="setting_academic_education_system">
                                                    <option value="matric" {{ ($groupedSettings['academic']['education_system'] ?? 'matric') == 'matric' ? 'selected' : '' }}>Matriculation</option>
                                                    <option value="cambridge" {{ ($groupedSettings['academic']['education_system'] ?? 'matric') == 'cambridge' ? 'selected' : '' }}>Cambridge</option>
                                                    <option value="ib" {{ ($groupedSettings['academic']['education_system'] ?? 'matric') == 'ib' ? 'selected' : '' }}>International Baccalaureate</option>
                                                    <option value="american" {{ ($groupedSettings['academic']['education_system'] ?? 'matric') == 'american' ? 'selected' : '' }}>American Curriculum</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Default Class Capacity</label>
                                                <input type="number" class="form-control" name="setting_academic_default_class_capacity" 
                                                       value="{{ $groupedSettings['academic']['default_class_capacity'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Max Students per Section</label>
                                                <input type="number" class="form-control" name="setting_academic_max_students_per_section"
                                                       value="{{ $groupedSettings['academic']['max_students_per_section'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Academic Session Start Month</label>
                                                <select class="form-control" name="setting_academic_academic_session_start_month">
                                                    @for($i = 1; $i <= 12; $i++)
                                                        <option value="{{ $i }}" {{ ($groupedSettings['academic']['academic_session_start_month'] ?? '1') == $i ? 'selected' : '' }}>
                                                            {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Academic Session End Month</label>
                                                <select class="form-control" name="setting_academic_academic_session_end_month">
                                                    @for($i = 1; $i <= 12; $i++)
                                                        <option value="{{ $i }}" {{ ($groupedSettings['academic']['academic_session_end_month'] ?? '1') == $i ? 'selected' : '' }}>
                                                            {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                                        </option>
                                                    @endfor
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
                                                <select class="form-control" name="setting_academic_grading_system">
                                                    <option value="percentage" {{ ($groupedSettings['academic']['grading_system'] ?? 'percentage') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                                    <option value="letter" {{ ($groupedSettings['academic']['grading_system'] ?? 'percentage') == 'letter' ? 'selected' : '' }}>Letter Grades</option>
                                                    <option value="gpa" {{ ($groupedSettings['academic']['grading_system'] ?? 'percentage') == 'gpa' ? 'selected' : '' }}>GPA</option>
                                                    <option value="cgpa" {{ ($groupedSettings['academic']['grading_system'] ?? 'percentage') == 'cgpa' ? 'selected' : '' }}>CGPA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Default Passing Percentage</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="setting_academic_default_passing_percentage" 
                                                           value="{{ $groupedSettings['academic']['default_passing_percentage'] ?? '' }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
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
                                                <select class="form-control" name="setting_fee_currency">
                                                    <option value="PKR" {{ ($groupedSettings['fee']['currency'] ?? 'PKR') == 'PKR' ? 'selected' : '' }}>Pakistani Rupee (PKR)</option>
                                                    <option value="USD" {{ ($groupedSettings['fee']['currency'] ?? 'PKR') == 'USD' ? 'selected' : '' }}>US Dollar (USD)</option>
                                                    <option value="EUR" {{ ($groupedSettings['fee']['currency'] ?? 'PKR') == 'EUR' ? 'selected' : '' }}>Euro (EUR)</option>
                                                    <option value="GBP" {{ ($groupedSettings['fee']['currency'] ?? 'PKR') == 'GBP' ? 'selected' : '' }}>British Pound (GBP)</option>
                                                    <option value="AED" {{ ($groupedSettings['fee']['currency'] ?? 'PKR') == 'AED' ? 'selected' : '' }}>UAE Dirham (AED)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Currency Symbol</label>
                                                <input type="text" class="form-control" name="setting_fee_currency_symbol" 
                                                       value="{{ $groupedSettings['fee']['currency_symbol'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Default Fee Due Days</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="setting_fee_default_fee_due_days" 
                                                           value="{{ $groupedSettings['fee']['default_fee_due_days'] ?? '' }}">
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
                                                        <span class="input-group-text">{{ $groupedSettings['fee']['currency_symbol'] ?? '' }}</span>
                                                    </div>
                                                    <input type="number" class="form-control" name="setting_fee_late_fee_amount" 
                                                           value="{{ $groupedSettings['fee']['late_fee_amount'] ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Late Fee Type</label>
                                                <select class="form-control" name="setting_fee_late_fee_type">
                                                    <option value="fixed" {{ ($groupedSettings['fee']['late_fee_type'] ?? 'fixed') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                                    <option value="percentage" {{ ($groupedSettings['fee']['late_fee_type'] ?? 'fixed') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Late Fee Percentage</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="setting_fee_late_fee_percentage" 
                                                           value="{{ $groupedSettings['fee']['late_fee_percentage'] ?? '' }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Invoice Prefix</label>
                                                <input type="text" class="form-control" name="setting_fee_invoice_prefix" 
                                                       value="{{ $groupedSettings['fee']['invoice_prefix'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Receipt Prefix</label>
                                                <input type="text" class="form-control" name="setting_fee_receipt_prefix" 
                                                       value="{{ $groupedSettings['fee']['receipt_prefix'] ?? '' }}">
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
                                                <select class="form-control" name="setting_attendance_default_attendance_method">
                                                    <option value="daily" {{ ($groupedSettings['attendance']['default_attendance_method'] ?? 'daily') == 'daily' ? 'selected' : '' }}>Daily Attendance</option>
                                                    <option value="period" {{ ($groupedSettings['attendance']['default_attendance_method'] ?? 'daily') == 'period' ? 'selected' : '' }}>Period-wise</option>
                                                    <option value="subject" {{ ($groupedSettings['attendance']['default_attendance_method'] ?? 'daily') == 'subject' ? 'selected' : '' }}>Subject-wise</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Attendance Cut-off Time</label>
                                                <input type="time" class="form-control" name="setting_attendance_attendance_cutoff_time" 
                                                       value="{{ $groupedSettings['attendance']['attendance_cutoff_time'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Default Present Mark</label>
                                                <input type="text" class="form-control" name="setting_attendance_default_present_mark" 
                                                       value="{{ $groupedSettings['attendance']['default_present_mark'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Default Absent Mark</label>
                                                <input type="text" class="form-control" name="setting_attendance_default_absent_mark" 
                                                       value="{{ $groupedSettings['attendance']['default_absent_mark'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Default Late Mark</label>
                                                <input type="text" class="form-control" name="setting_attendance_default_late_mark" 
                                                       value="{{ $groupedSettings['attendance']['default_late_mark'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Default Half Day Mark</label>
                                                <input type="text" class="form-control" name="setting_attendance_default_half_day_mark" 
                                                       value="{{ $groupedSettings['attendance']['default_half_day_mark'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>SMS Send Time</label>
                                                <input type="time" class="form-control" name="setting_attendance_sms_send_time" 
                                                       value="{{ $groupedSettings['attendance']['sms_send_time'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>SMS Provider</label>
                                                <select class="form-control" name="setting_attendance_sms_provider">
                                                    <option value="telenor" {{ ($groupedSettings['attendance']['sms_provider'] ?? 'telenor') == 'telenor' ? 'selected' : '' }}>Telenor</option>
                                                    <option value="jazz" {{ ($groupedSettings['attendance']['sms_provider'] ?? 'telenor') == 'jazz' ? 'selected' : '' }}>Jazz</option>
                                                    <option value="zong" {{ ($groupedSettings['attendance']['sms_provider'] ?? 'telenor') == 'zong' ? 'selected' : '' }}>Zong</option>
                                                    <option value="ufone" {{ ($groupedSettings['attendance']['sms_provider'] ?? 'telenor') == 'ufone' ? 'selected' : '' }}>Ufone</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Absent SMS Template</label>
                                                <textarea class="form-control" rows="3" name="setting_attendance_absent_sms_template">{{ $groupedSettings['attendance']['absent_sms_template'] ?? '' }}</textarea>
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
                                    <h5 class="card-title mb-0">Notification Configuration</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Firebase Server Key</label>
                                                <input type="password" class="form-control" name="setting_notification_firebase_key" 
                                                       value="{{ $groupedSettings['notification']['firebase_key'] ?? '' }}" 
                                                       placeholder="Enter Firebase server key">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sender ID</label>
                                                <input type="text" class="form-control" name="setting_notification_sender_id" 
                                                       value="{{ $groupedSettings['notification']['sender_id'] ?? '' }}" 
                                                       placeholder="Sender ID">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Security Settings Tab -->
                        <div class="tab-pane fade" id="security">
                            <div class="card settings-card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Security Configuration</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Session Timeout</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="setting_security_session_timeout" 
                                                           value="{{ $groupedSettings['security']['session_timeout'] ?? '' }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">minutes</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Max Login Attempts</label>
                                                <input type="number" class="form-control" name="setting_security_max_login_attempts" 
                                                       value="{{ $groupedSettings['security']['max_login_attempts'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Lockout Duration</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="setting_security_lockout_duration" 
                                                           value="{{ $groupedSettings['security']['lockout_duration'] ?? '' }}">
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
                                                    <input type="number" class="form-control" name="setting_security_password_expiry_days" 
                                                           value="{{ $groupedSettings['security']['password_expiry_days'] ?? '' }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">days</span>
                                                    </div>
                                                </div>
                                            </div>
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
                                                <select class="form-control" name="setting_backup_backup_frequency">
                                                    <option value="daily" {{ ($groupedSettings['backup']['backup_frequency'] ?? 'daily') == 'daily' ? 'selected' : '' }}>Daily</option>
                                                    <option value="weekly" {{ ($groupedSettings['backup']['backup_frequency'] ?? 'daily') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                                    <option value="monthly" {{ ($groupedSettings['backup']['backup_frequency'] ?? 'daily') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                                    <option value="manual" {{ ($groupedSettings['backup']['backup_frequency'] ?? 'daily') == 'manual' ? 'selected' : '' }}>Manual Only</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Backup Time</label>
                                                <input type="time" class="form-control" name="setting_backup_backup_time" 
                                                       value="{{ $groupedSettings['backup']['backup_time'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Backup Retention</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="setting_backup_backup_retention" 
                                                           value="{{ $groupedSettings['backup']['backup_retention'] ?? '' }}">
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
                                                    <input type="number" class="form-control" name="setting_backup_max_backup_size" 
                                                           value="{{ $groupedSettings['backup']['max_backup_size'] ?? '' }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">MB</span>
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
        </form>
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
                
                // Upload file immediately
                if (this.files && this.files[0]) {
                    uploadFile(this.files[0], $(this).data('type'));
                }
            });
            
            // Color picker functionality
            $('.color-picker').click(function() {
                const colorInput = $(this).next('input');
                const currentColor = colorInput.val();
                
                const newColor = prompt('Enter color code (hex):', currentColor);
                if (newColor && /^#[0-9A-F]{6}$/i.test(newColor)) {
                    $(this).css('background-color', newColor);
                    colorInput.val(newColor);
                }
            });
            
            // Update color picker when input changes
            $('input[id$="ColorInput"]').on('change', function() {
                const color = $(this).val();
                const pickerId = $(this).attr('id').replace('Input', 'Picker');
                if (/^#[0-9A-F]{6}$/i.test(color)) {
                    $('#' + pickerId).css('background-color', color);
                }
            });
            
            // Save all settings with AJAX
            $('#saveAllSettings').click(function() {
                saveAllSettings();
            });
            
            // Quick actions
            $('#exportSettings').click(function() {
                exportSettings();
            });
            
            $('#importSettings').click(function() {
                showAlert('info', 'Import feature coming soon!');
            });
            
            $('#resetSettings').click(function() {
                resetSettings();
            });
            
            $('#clearCache').click(function() {
                clearCache();
            });
            
            // Functions
            function showLoading() {
                $('#loadingOverlay').fadeIn();
            }
            
            function hideLoading() {
                $('#loadingOverlay').fadeOut();
            }
            
            function showAlert(type, message) {
                if (type === 'success') {
                    toastr.success(message);
                } else if (type === 'error') {
                    toastr.error(message);
                } else if (type === 'info') {
                    toastr.info(message);
                } else if (type === 'warning') {
                    toastr.warning(message);
                }
            }
            
            async function saveAllSettings() {
                const btn = $('#saveAllSettings');
                const originalText = btn.html();
                showLoading();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Saving...').prop('disabled', true);
                
                try {
                    // Collect all form data
                    const formData = new FormData(document.getElementById('settingsForm'));
                    
                    // Remove file inputs from FormData as they're handled separately
                    formData.delete('logoUpload');
                    formData.delete('faviconUpload');
                    
                    // Add _method for Laravel to recognize it as PUT request
                    formData.append('_method', 'PUT');
                    
                    console.log('FormData entries:');
                    for (let pair of formData.entries()) {
                        console.log(pair[0] + ': ' + pair[1]);
                    }
                    
                    const response = await fetch('{{ route("schools.settings.update", $school->id) }}', {
                        method: 'POST', // Use POST for FormData
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                            // Don't set Content-Type for FormData, let browser set it with boundary
                        },
                        body: formData
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        showAlert('success', result.message);
                    } else {
                        showAlert('error', result.message);
                    }
                } catch (error) {
                    showAlert('error', 'Error saving settings: ' + error.message);
                    console.error('Error details:', error);
                } finally {
                    hideLoading();
                    btn.html(originalText).prop('disabled', false);
                }
            }
            
            async function uploadFile(file, type) {
                showLoading();
                const formData = new FormData();
                formData.append('file', file);
                formData.append('type', type);
                formData.append('_token', '{{ csrf_token() }}');
                
                try {
                    const response = await fetch('{{ route("settings.upload") }}', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        const previewId = type + 'Preview';
                        $('#' + previewId).html(`<img src="${result.file_path}" alt="${type}">`);
                        showAlert('success', `${type} uploaded successfully!`);
                        
                        // Save the file path to settings
                        const settingKey = `setting_general_${type}`;
                        $('input[name="' + settingKey + '"]').val(result.file_path);
                    } else {
                        showAlert('error', result.message);
                    }
                } catch (error) {
                    showAlert('error', 'Error uploading file: ' + error.message);
                } finally {
                    hideLoading();
                }
            }
            
            async function exportSettings() {
                showLoading();
                try {
                    const response = await fetch('{{ route("settings.export") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });
                    
                    const data = await response.json();
                    
                    // Create download link
                    const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(data, null, 2));
                    const downloadAnchorNode = document.createElement('a');
                    downloadAnchorNode.setAttribute("href", dataStr);
                    downloadAnchorNode.setAttribute("download", "settings_export_" + new Date().toISOString().slice(0,10) + ".json");
                    document.body.appendChild(downloadAnchorNode);
                    downloadAnchorNode.click();
                    downloadAnchorNode.remove();
                    
                    showAlert('success', 'Settings exported successfully!');
                } catch (error) {
                    showAlert('error', 'Error exporting settings: ' + error.message);
                } finally {
                    hideLoading();
                }
            }
            
            async function resetSettings() {
                if (confirm('Are you sure you want to reset all settings to default? This action cannot be undone.')) {
                    showLoading();
                    try {
                        const response = await fetch('{{ route("settings.reset") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        });
                        
                        const result = await response.json();
                        
                        if (result.success) {
                            showAlert('success', result.message);
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            showAlert('error', result.message);
                        }
                    } catch (error) {
                        showAlert('error', 'Error resetting settings: ' + error.message);
                    } finally {
                        hideLoading();
                    }
                }
            }
            
            async function clearCache() {
                const btn = $('#clearCache');
                const originalText = btn.html();
                showLoading();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Clearing...').prop('disabled', true);
                
                try {
                    // Call your cache clearing endpoint
                    const response = await fetch('/clear-cache', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        showAlert('success', 'Cache cleared successfully!');
                    } else {
                        showAlert('error', result.message);
                    }
                } catch (error) {
                    showAlert('error', 'Error clearing cache: ' + error.message);
                } finally {
                    hideLoading();
                    btn.html(originalText).prop('disabled', false);
                }
            }
            
            // Initialize toastr
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000"
            };
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @endpush
</x-app-layout>
<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .module-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .module-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .module-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 24px;
            margin-right: 15px;
        }
        
        .module-status {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
        
        .module-status.active {
            background-color: #28a745;
        }
        
        .module-status.inactive {
            background-color: #dc3545;
        }
        
        .module-status.pending {
            background-color: #ffc107;
        }
        
        .permission-group {
            border-left: 3px solid #007bff;
            padding-left: 15px;
            margin-bottom: 20px;
        }
        
        .version-badge {
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 10px;
        }
        
        .bg-core { background-color: #007bff; }
        .bg-standard { background-color: #28a745; }
        .bg-premium { background-color: #6f42c1; }
        .bg-addon { background-color: #fd7e14; }
        .bg-plugin { background-color: #20c997; }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Module Settings</h4>
                <p class="mb-0">Manage and configure system modules and their permissions</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Modules</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#installModuleModal">
                    <i class="las la-plus mr-2"></i>Install Module
                </button>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Modules</h6>
                                <h2 class="mb-0 text-white">{{ $modules->count() }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-cubes fa-lg text-primary"></i>
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
                                <h6 class="text-white mb-0">Active</h6>
                                <h2 class="mb-0 text-white">{{ $modules->where('is_active', true)->count() }}</h2>
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
                                <h6 class="text-white mb-0">Inactive</h6>
                                <h2 class="mb-0 text-white">{{ $modules->where('is_active', false)->count() }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-toggle-off fa-lg text-warning"></i>
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
                                <h6 class="text-white mb-0">System Core</h6>
                                <h2 class="mb-0 text-white">{{ $modules->where('is_core', true)->count() }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-server fa-lg text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modules Grid -->
        <div class="row mb-4">
            @foreach($modules as $module)
            @php
                $moduleColor = match(true) {
                    $module->is_core => 'primary',
                    str_contains(strtolower($module->code), 'premium') => 'info',
                    str_contains(strtolower($module->code), 'standard') => 'success',
                    str_contains(strtolower($module->code), 'addon') => 'warning',
                    default => 'secondary'
                };
                
                $iconMap = [
                    'user' => 'la-users',
                    'academic' => 'la-graduation-cap',
                    'student' => 'la-user-graduate',
                    'teacher' => 'la-chalkboard-teacher',
                    'attendance' => 'la-calendar-check',
                    'fee' => 'la-money-bill-wave',
                    'exam' => 'la-clipboard-list',
                    'library' => 'la-book',
                    'transport' => 'la-bus',
                    'hostel' => 'la-home',
                    'inventory' => 'la-boxes',
                    'notice' => 'la-bullhorn',
                    'message' => 'la-envelope'
                ];
                
                $moduleIcon = 'la-cube';
                foreach($iconMap as $key => $icon) {
                    if(str_contains(strtolower($module->code), $key) || str_contains(strtolower($module->name), $key)) {
                        $moduleIcon = $icon;
                        break;
                    }
                }
                
                $schoolModule = $module->schoolModules->where('school_id', auth()->user()->school_id)->first();
                $isActiveForSchool = $schoolModule ? $schoolModule->is_active : $module->is_active;
            @endphp
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="module-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex align-items-center">
                                <div class="module-icon bg-{{ $moduleColor }} text-white">
                                    <i class="las {{ $moduleIcon }}"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $module->name }}</h5>
                                    <p class="text-muted mb-0">{{ $module->code }}</p>
                                </div>
                            </div>
                            <div>
                                <span class="module-status {{ $isActiveForSchool ? 'active' : 'inactive' }}"></span>
                                <small class="{{ $isActiveForSchool ? 'text-success' : 'text-danger' }}">
                                    {{ $isActiveForSchool ? 'Active' : 'Inactive' }}
                                </small>
                            </div>
                        </div>
                        
                        <p class="text-muted mb-3">{{ $module->description ?? 'No description available' }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <small class="text-muted">
                                    Last Updated: {{ $module->updated_at->format('d M Y') }}
                                </small>
                            </div>
                            <span class="version-badge bg-{{ $moduleColor }} text-white">
                                {{ $module->is_core ? 'Core' : 'Module' }}
                            </span>
                        </div>
                        
                        <div class="btn-group w-100">
                            <button class="btn btn-sm btn-outline-primary module-settings" data-module-id="{{ $module->id }}">
                                <i class="las la-cog mr-1"></i> Settings
                            </button>
                            <button class="btn btn-sm btn-outline-success module-permissions" data-module-id="{{ $module->id }}">
                                <i class="las la-key mr-1"></i> Permissions
                            </button>
                            @if($module->is_core)
                            <button class="btn btn-sm btn-outline-secondary" disabled>
                                <i class="las la-lock mr-1"></i> Core
                            </button>
                            @else
                            <button class="btn btn-sm {{ $isActiveForSchool ? 'btn-outline-warning' : 'btn-outline-success' }} toggle-module"
                                    data-module-id="{{ $module->id }}"
                                    data-action="{{ $isActiveForSchool ? 'disable' : 'enable' }}">
                                <i class="las {{ $isActiveForSchool ? 'la-toggle-on' : 'la-toggle-off' }} mr-1"></i>
                                {{ $isActiveForSchool ? 'Disable' : 'Enable' }}
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Module Permissions -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Module Permissions Configuration</h5>
            </div>
            <div class="card-body">
                <form id="permissionsForm" action="{{ route('modules.update-permissions') }}" method="POST">
                    @csrf
                    <div class="row">
                        @foreach($modules as $module)
                        @php
                            $permissions = $module->permission_list;
                            $moduleColor = $module->is_core ? 'primary' : 'secondary';
                        @endphp
                        @if(!empty($permissions))
                        <div class="col-md-4 mb-4">
                            <div class="permission-group">
                                <h6 class="mb-3">{{ $module->name }}</h6>
                                @foreach($permissions as $permission)
                                @php
                                    $permissionId = 'perm_' . $module->id . '_' . \Illuminate\Support\Str::slug($permission);
                                @endphp
                                <div class="form-check mb-2">
                                    <input class="form-check-input permission-checkbox" 
                                           type="checkbox" 
                                           id="{{ $permissionId }}"
                                           name="permissions[{{ $module->id }}][]"
                                           value="{{ $permission }}"
                                           {{ in_array($permission, $assignedPermissions[$module->id] ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $permissionId }}">
                                        {{ ucwords(str_replace('_', ' ', $permission)) }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary" id="savePermissions">
                            <i class="las la-save mr-2"></i> Save Permission Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- System Information -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">System Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">System Name</th>
                                <td>School Management System</td>
                            </tr>
                            <tr>
                                <th>Version</th>
                                <td>v5.2.0</td>
                            </tr>
                            <tr>
                                <th>License Type</th>
                                <td>Enterprise Edition</td>
                            </tr>
                            <tr>
                                <th>License Expiry</th>
                                <td class="text-success">31 Dec 2025</td>
                            </tr>
                            <tr>
                                <th>PHP Version</th>
                                <td>{{ phpversion() }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Laravel Version</th>
                                <td>{{ app()->version() }}</td>
                            </tr>
                            <tr>
                                <th>Database</th>
                                <td>MySQL 8.0</td>
                            </tr>
                            <tr>
                                <th>Server OS</th>
                                <td>{{ php_uname('s') }}</td>
                            </tr>
                            <tr>
                                <th>Last Backup</th>
                                <td class="text-warning">24 Dec 2024 02:30 AM</td>
                            </tr>
                            <tr>
                                <th>Modules Count</th>
                                <td class="text-info">{{ $modules->count() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="alert alert-warning mt-3">
                    <i class="las la-exclamation-triangle mr-2"></i>
                    <strong>Important:</strong> System updates and module installations should be performed during maintenance hours (12:00 AM - 4:00 AM) to avoid disruption.
                </div>
            </div>
        </div>
    </div>

    <!-- Install Module Modal -->
    <div class="modal fade" id="installModuleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Install New Module</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('modules.install') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Module Code *</label>
                                    <input type="text" class="form-control" name="code" placeholder="e.g., user_management" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Module Name *</label>
                                    <input type="text" class="form-control" name="name" placeholder="e.g., User Management" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Module Type</label>
                                    <select class="form-control" name="type">
                                        <option value="module">Standard Module</option>
                                        <option value="core">Core Module</option>
                                        <option value="premium">Premium Module</option>
                                        <option value="addon">Add-on Module</option>
                                        <option value="plugin">Plugin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Module File</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="module_file" id="moduleFile">
                                        <label class="custom-file-label" for="moduleFile">Choose .zip file</label>
                                    </div>
                                    <small class="form-text text-muted">Upload module zip file (max 50MB)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Icon Class</label>
                                    <input type="text" class="form-control" name="icon" placeholder="las la-cube" value="las la-cube">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Default Route</label>
                                    <input type="text" class="form-control" name="route" placeholder="e.g., users.index">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" rows="3" placeholder="Module description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Permissions (one per line)</label>
                                    <textarea class="form-control" name="permissions" rows="4" placeholder="create_users
                                        edit_users
                                        delete_users
                                        view_users"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="is_core" id="isCore">
                                        <label class="custom-control-label" for="isCore">
                                            Core Module (Cannot be disabled)
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="is_active" id="isActive" checked>
                                        <label class="custom-control-label" for="isActive">
                                            Enable after installation
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="installModuleBtn">
                            <i class="las la-download mr-2"></i> Install Module
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Module Settings Modal -->
    <div class="modal fade" id="moduleSettingsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Module Settings</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="moduleSettingsForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div id="moduleSettingsContent">
                            <!-- Content loaded via AJAX -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Module Settings Script -->
    <script>
        $(document).ready(function() {
            // CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // File input label
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            // Toggle module status
            $('.toggle-module').on('click', function() {
                const btn = $(this);
                const moduleId = btn.data('module-id');
                const action = btn.data('action');
                const card = btn.closest('.module-card');
                const statusSpan = card.find('.module-status');
                const statusText = card.find('.text-success, .text-danger');
                
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-1"></i> Processing...').prop('disabled', true);
                
                $.ajax({
                    url: '{{ route("modules.toggle") }}',
                    method: 'POST',
                    data: {
                        module_id: moduleId,
                        action: action
                    },
                    success: function(response) {
                        if (response.success) {
                            if (action === 'disable') {
                                statusSpan.removeClass('active').addClass('inactive');
                                statusText.removeClass('text-success').addClass('text-danger').text('Inactive');
                                btn.html('<i class="las la-toggle-off mr-1"></i> Enable')
                                    .removeClass('btn-outline-warning').addClass('btn-outline-success')
                                    .data('action', 'enable');
                            } else {
                                statusSpan.removeClass('inactive').addClass('active');
                                statusText.removeClass('text-danger').addClass('text-success').text('Active');
                                btn.html('<i class="las la-toggle-on mr-1"></i> Disable')
                                    .removeClass('btn-outline-success').addClass('btn-outline-warning')
                                    .data('action', 'disable');
                            }
                            
                            // Show success message
                            showToast(response.message, 'success');
                        }
                    },
                    error: function(xhr) {
                        btn.html(originalText).prop('disabled', false);
                        showToast('Error: ' + xhr.responseJSON?.message || 'Something went wrong', 'error');
                    },
                    complete: function() {
                        btn.prop('disabled', false);
                    }
                });
            });

            // Module settings
            $('.module-settings').on('click', function() {
                const moduleId = $(this).data('module-id');
                
                $.ajax({
                    url: '{{ route("modules.settings") }}',
                    method: 'GET',
                    data: { module_id: moduleId },
                    success: function(response) {
                        $('#moduleSettingsContent').html(response.html);
                        $('#moduleSettingsForm').attr('action', response.updateUrl);
                        $('#moduleSettingsModal').modal('show');
                    },
                    error: function() {
                        showToast('Failed to load module settings', 'error');
                    }
                });
            });

            // Module permissions
            $('.module-permissions').on('click', function() {
                const moduleId = $(this).data('module-id');
                const permissionsSection = $('#permissionsForm');
                
                // Scroll to permissions section
                $('html, body').animate({
                    scrollTop: permissionsSection.offset().top - 100
                }, 500);
                
                // Highlight the module's permissions
                $('.permission-group').removeClass('border-primary');
                $('.permission-group h6').each(function() {
                    if ($(this).text().includes(moduleId)) {
                        $(this).closest('.permission-group').addClass('border-primary');
                    }
                });
            });

            // Save module settings
            $('#moduleSettingsForm').on('submit', function(e) {
                e.preventDefault();
                
                const form = $(this);
                const submitBtn = form.find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.html('<i class="las la-spinner la-spin mr-2"></i>Saving...').prop('disabled', true);
                
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        showToast(response.message, 'success');
                        $('#moduleSettingsModal').modal('hide');
                    },
                    error: function(xhr) {
                        showToast('Error: ' + xhr.responseJSON?.message || 'Failed to save settings', 'error');
                    },
                    complete: function() {
                        submitBtn.html(originalText).prop('disabled', false);
                    }
                });
            });

            // Save all permissions
            $('#savePermissions').on('click', function(e) {
                e.preventDefault();
                
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Saving...').prop('disabled', true);
                
                $.ajax({
                    url: $('#permissionsForm').attr('action'),
                    method: 'POST',
                    data: $('#permissionsForm').serialize(),
                    success: function(response) {
                        showToast(response.message, 'success');
                    },
                    error: function(xhr) {
                        showToast('Error: ' + xhr.responseJSON?.message || 'Failed to save permissions', 'error');
                    },
                    complete: function() {
                        btn.html(originalText).prop('disabled', false);
                    }
                });
            });

            // Install module
            $('#installModuleBtn').on('click', function(e) {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Installing...').prop('disabled', true);
                
                // The form will handle submission, this just changes the button state
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                }, 3000);
            });

            // Toast notification function
            function showToast(message, type = 'success') {
                const toast = $(`
                    <div class="toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0 position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                ${message}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                `);
                
                $('body').append(toast);
                const bsToast = new bootstrap.Toast(toast[0]);
                bsToast.show();
                
                toast.on('hidden.bs.toast', function() {
                    $(this).remove();
                });
            }

            // Bulk select/deselect for module permissions
            $('.permission-group h6').each(function() {
                const group = $(this).closest('.permission-group');
                const checkboxes = group.find('.permission-checkbox');
                const allChecked = checkboxes.length === checkboxes.filter(':checked').length;
                
                $(this).append(`
                    <small class="float-right">
                        <a href="#" class="text-primary select-all">Select All</a>
                    </small>
                `);
                
                if (allChecked) {
                    group.find('.select-all').text('Deselect All');
                }
            });

            // Toggle select all for module permissions
            $(document).on('click', '.select-all', function(e) {
                e.preventDefault();
                const group = $(this).closest('.permission-group');
                const checkboxes = group.find('.permission-checkbox');
                const allChecked = checkboxes.length === checkboxes.filter(':checked').length;
                
                if (allChecked) {
                    checkboxes.prop('checked', false);
                    $(this).text('Select All');
                } else {
                    checkboxes.prop('checked', true);
                    $(this).text('Deselect All');
                }
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
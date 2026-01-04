@php
    use Illuminate\Support\Str;
    
    // Get module type display
    $moduleType = $module->is_core ? 'Core Module' : 'Standard Module';
    
    // Default settings structure with safe access
    $defaultSettings = [
        'is_active' => $schoolModule->is_active ?? true,
        'display_order' => $schoolModule->display_order ?? $module->order ?? 0,
        'permissions' => $settings['permissions'] ?? [],
        'submodules' => $settings['submodules'] ?? [],
        'access_level' => $settings['access_level'] ?? 'all',
        'config' => $settings['config'] ?? []
    ];
    
    // Merge with saved settings
    $currentSettings = array_merge($defaultSettings, $settings);
    
    // Safely get submodules from module
    $moduleSubmodules = $module->submodule_list ?? [];
    
    // Debug info (remove in production)
    // dd($moduleSubmodules, $currentSettings);
@endphp

<div class="module-settings-form">
    <div class="alert alert-info">
        <i class="las la-info-circle mr-2"></i>
        These settings are specific to your school. Other schools using the same module will have their own settings.
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="module_name">Module Name</label>
                <input type="text" class="form-control" id="module_name" value="{{ $module->name }}" readonly>
                <small class="form-text text-muted">Global module name (cannot be changed here)</small>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="module_code">Module Code</label>
                <input type="text" class="form-control" id="module_code" value="{{ $module->code }}" readonly>
                <small class="form-text text-muted">Unique identifier for the module</small>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="module_type">Module Type</label>
                <input type="text" class="form-control" id="module_type" value="{{ $moduleType }}" readonly>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="module_status">Module Status for Your School</label>
                <select class="form-control" id="module_status" name="settings[is_active]" {{ $module->is_core ? 'disabled' : '' }}>
                    <option value="1" {{ $schoolModule->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$schoolModule->is_active ? 'selected' : '' }}>Inactive</option>
                </select>
                @if($module->is_core)
                <small class="form-text text-muted">Core modules cannot be disabled</small>
                @endif
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="display_order">Display Order</label>
                <input type="number" class="form-control" id="display_order" name="settings[display_order]" 
                       value="{{ $currentSettings['display_order'] }}" min="0" max="100">
                <small class="form-text text-muted">Lower numbers appear first in menus</small>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="access_level">Access Level</label>
                <select class="form-control" id="access_level" name="settings[access_level]">
                    <option value="all" {{ $currentSettings['access_level'] == 'all' ? 'selected' : '' }}>All Users</option>
                    <option value="admins_only" {{ $currentSettings['access_level'] == 'admins_only' ? 'selected' : '' }}>Admins Only</option>
                    <option value="specific_roles" {{ $currentSettings['access_level'] == 'specific_roles' ? 'selected' : '' }}>Specific Roles</option>
                </select>
            </div>
        </div>
    </div>
    
    <!-- Module-specific permissions -->
    @php
        $modulePermissions = $module->permission_list ?? [];
    @endphp
    
    @if(!empty($modulePermissions))
    <div class="form-group">
        <label class="d-flex justify-content-between align-items-center">
            <span>Module Permissions</span>
            <button type="button" class="btn btn-sm btn-outline-primary toggle-all-perms">
                Toggle All
            </button>
        </label>
        <div class="border rounded p-3">
            @foreach($modulePermissions as $permission)
            @php
                $permissionId = 'perm_' . $module->id . '_' . Str::slug($permission);
                $isEnabled = in_array($permission, $currentSettings['permissions']);
            @endphp
            <div class="form-check mb-2">
                <input class="form-check-input module-perm-checkbox" 
                       type="checkbox" 
                       id="{{ $permissionId }}"
                       name="settings[permissions][]"
                       value="{{ $permission }}"
                       {{ $isEnabled ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $permissionId }}">
                    {{ ucwords(str_replace('_', ' ', $permission)) }}
                </label>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="alert alert-warning">
        <i class="las la-exclamation-triangle mr-2"></i>
        No permissions defined for this module.
    </div>
    @endif
    
    <!-- Submodule configuration -->
    @if(!empty($moduleSubmodules) && is_array($moduleSubmodules))
    <div class="form-group">
        <label>Submodules</label>
        <div class="border rounded p-3">
            @foreach($moduleSubmodules as $index => $submodule)
                @php
                    // Safely access submodule properties
                    $submoduleCode = $submodule['code'] ?? 'submodule_' . $index;
                    $submoduleName = $submodule['name'] ?? 'Submodule ' . ($index + 1);
                    $submoduleDesc = $submodule['description'] ?? null;
                    $isEnabled = in_array($submoduleCode, $currentSettings['submodules']);
                @endphp
                <div class="form-check mb-2">
                    <input class="form-check-input" 
                           type="checkbox" 
                           name="settings[submodules][]"
                           value="{{ $submoduleCode }}"
                           id="sub_{{ $submoduleCode }}"
                           {{ $isEnabled ? 'checked' : '' }}>
                    <label class="form-check-label" for="sub_{{ $submoduleCode }}">
                        {{ $submoduleName }}
                        @if($submoduleDesc)
                        <small class="d-block text-muted">{{ $submoduleDesc }}</small>
                        @endif
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    @endif
    
    <!-- Custom configuration (JSON editor) -->
    <div class="form-group">
        <label for="custom_config">Custom Configuration</label>
        <textarea class="form-control" id="custom_config" name="settings[config]" rows="6" 
                  placeholder='Enter custom configuration in JSON format
Example: {
    "max_records": 100,
    "auto_refresh": true,
    "theme": "light"
}'>@php
    if (!empty($currentSettings['config'])) {
        if (is_string($currentSettings['config'])) {
            echo $currentSettings['config'];
        } else {
            echo json_encode($currentSettings['config'], JSON_PRETTY_PRINT);
        }
    }
@endphp</textarea>
        <small class="form-text text-muted">Enter JSON configuration specific to this module</small>
    </div>
    
    <!-- Activation dates -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Activated At</label>
                <input type="text" class="form-control" 
                       value="{{ $schoolModule->activated_at ? $schoolModule->activated_at->format('Y-m-d H:i:s') : 'Never' }}" 
                       readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Deactivated At</label>
                <input type="text" class="form-control" 
                       value="{{ $schoolModule->deactivated_at ? $schoolModule->deactivated_at->format('Y-m-d H:i:s') : 'Never' }}" 
                       readonly>
            </div>
        </div>
    </div>
    
    <!-- Module info -->
    <div class="alert alert-light border">
        <h6 class="mb-2">Module Information</h6>
        <p class="mb-1"><strong>Description:</strong> {{ $module->description ?? 'No description available' }}</p>
        <p class="mb-1"><strong>Default Route:</strong> {{ $module->route ?? 'Not set' }}</p>
        <p class="mb-1"><strong>Icon:</strong> <i class="{{ $module->icon }}"></i> {{ $module->icon }}</p>
        <p class="mb-0"><strong>Created:</strong> {{ $module->created_at->format('Y-m-d') }}</p>
    </div>
</div>

<script>
$(document).ready(function() {
    // Toggle all permissions
    $('.toggle-all-perms').on('click', function() {
        const container = $(this).closest('.form-group').find('.border');
        const checkboxes = container.find('.module-perm-checkbox');
        const allChecked = checkboxes.length === checkboxes.filter(':checked').length;
        
        checkboxes.prop('checked', !allChecked);
    });
    
    // Validate JSON in custom config
    $('#custom_config').on('blur', function() {
        try {
            const jsonText = $(this).val().trim();
            if (jsonText) {
                JSON.parse(jsonText);
                $(this).removeClass('is-invalid').addClass('is-valid');
            } else {
                $(this).removeClass('is-invalid').removeClass('is-valid');
            }
        } catch (e) {
            $(this).removeClass('is-valid').addClass('is-invalid');
            showToast('Invalid JSON format in custom configuration', 'error');
        }
    });
});
</script>
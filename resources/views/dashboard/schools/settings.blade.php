<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <x-page-header 
            title="School Settings"
            subtitle="Manage school configuration"
            action="false"
            :breadcrumbs="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Schools', 'url' => route('schools.index')],
                ['label' => $school->name],
                ['label' => 'Settings']
            ]"
        />

        @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        <form action="#" method="POST">
            @csrf
            @method('PUT')

            <!-- General Settings Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="las la-cog mr-2"></i> General Settings
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Current Academic Year</label>
                                <select name="current_academic_year" class="form-control">
                                    <option value="">Select Academic Year</option>
                                    @for($year = date('Y')-5; $year <= date('Y')+5; $year++)
                                        <option value="{{ $year }}-{{ $year+1 }}"
                                            {{ old('current_academic_year', $settings['current_academic_year'] ?? '') == ($year . '-' . ($year+1)) ? 'selected' : '' }}>
                                            {{ $year }}-{{ $year+1 }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Default Class</label>
                                <select name="default_class" class="form-control">
                                    <option value="">Select Default Class</option>
                                    @foreach(['Nursery', 'KG', '1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th', '11th', '12th'] as $class)
                                        <option value="{{ $class }}"
                                            {{ old('default_class', $settings['default_class'] ?? '') == $class ? 'selected' : '' }}>
                                            {{ $class }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Timezone</label>
                                <select name="timezone" class="form-control">
                                    <option value="">Select Timezone</option>
                                    @foreach(timezone_identifiers_list() as $tz)
                                        <option value="{{ $tz }}"
                                            {{ old('timezone', $settings['timezone'] ?? '') == $tz ? 'selected' : '' }}>
                                            {{ $tz }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Currency</label>
                                <input type="text" name="currency" class="form-control" 
                                       placeholder="e.g., PKR, USD, EUR" 
                                       value="{{ old('currency', $settings['currency'] ?? 'PKR') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fee Settings Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="las la-money-bill-wave mr-2"></i> Fee Settings
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fee Due Days</label>
                                <input type="number" name="fee_due_days" class="form-control" 
                                       placeholder="e.g., 10" 
                                       value="{{ old('fee_due_days', $settings['fee_due_days'] ?? '10') }}" min="1" max="90">
                                <small class="form-text text-muted">Number of days after which fee is considered late</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Late Fee Amount</label>
                                <input type="number" step="0.01" name="late_fee_amount" class="form-control" 
                                       placeholder="e.g., 100.00" 
                                       value="{{ old('late_fee_amount', $settings['late_fee_amount'] ?? '0') }}" min="0">
                                <small class="form-text text-muted">Fixed late fee amount</small>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" 
                                           id="enable_partial_payment" name="enable_partial_payment" value="1"
                                           {{ old('enable_partial_payment', $settings['enable_partial_payment'] ?? false) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="enable_partial_payment">
                                        Enable Partial Payment
                                    </label>
                                </div>
                                <small class="form-text text-muted">Allow students to pay fees in installments</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Theme/Branding Settings Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="las la-palette mr-2"></i> Theme / Branding
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Primary Color</label>
                                <div class="input-group colorpickerinput">
                                    <input type="text" name="primary_color" class="form-control" 
                                           placeholder="#007bff" 
                                           value="{{ old('primary_color', $settings['primary_color'] ?? '#007bff') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon">
                                            <i></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Secondary Color</label>
                                <div class="input-group colorpickerinput">
                                    <input type="text" name="secondary_color" class="form-control" 
                                           placeholder="#6c757d" 
                                           value="{{ old('secondary_color', $settings['secondary_color'] ?? '#6c757d') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon">
                                            <i></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="las la-save mr-2"></i> Save Settings
                            </button>
                            <button type="reset" class="btn btn-danger">
                                <i class="las la-redo mr-2"></i> Reset Changes
                            </button>
                            <a href="{{ route('schools.index') }}" class="btn btn-secondary">
                                <i class="las la-arrow-left mr-2"></i> Back to Schools
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Color Picker -->
    <script>
        $(document).ready(function() {
            // Initialize color picker if available
            if($.fn.colorpicker) {
                $('.colorpickerinput').colorpicker();
            }
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
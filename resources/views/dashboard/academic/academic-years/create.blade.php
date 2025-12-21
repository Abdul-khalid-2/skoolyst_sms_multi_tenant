<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    @endpush

    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Create Academic Year</h4>
                            <p class="mb-0">Add a new academic year for organizing data</p>
                        </div>
                        <a href="#" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Back to Academic Years
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf
                            
                            <!-- Basic Information -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-calendar-alt mr-2"></i> Year Information
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Year Name *</label>
                                        <input type="text" name="name" class="form-control" 
                                               placeholder="e.g., 2024-2025" required>
                                        <small class="form-text text-muted">Format: YYYY-YYYY (e.g., 2024-2025)</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Short Code</label>
                                        <input type="text" name="code" class="form-control" 
                                               placeholder="e.g., AY24-25">
                                        <small class="form-text text-muted">Optional short code for reference</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date *</label>
                                        <input type="date" name="start_date" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Date *</label>
                                        <input type="date" name="end_date" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <h6><i class="las la-info-circle mr-2"></i> Date Range Information</h6>
                                        <p class="mb-0">Academic year typically runs for 12 months (e.g., April to March or August to July)</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Year Settings -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-cog mr-2"></i> Year Settings
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active">Active</option>
                                            <option value="inactive" selected>Inactive</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                        <small class="form-text text-muted">Only one year can be active at a time</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Year Type</label>
                                        <select name="year_type" class="form-control">
                                            <option value="regular" selected>Regular Academic Year</option>
                                            <option value="summer">Summer Session</option>
                                            <option value="winter">Winter Session</option>
                                            <option value="special">Special Term</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="copy_previous_data" name="copy_previous_data">
                                        <label class="custom-control-label" for="copy_previous_data">
                                            Copy class structure from previous academic year
                                        </label>
                                        <small class="form-text text-muted">This will copy classes, sections, and subjects from the last active year</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="auto_promote" name="auto_promote">
                                        <label class="custom-control-label" for="auto_promote">
                                            Auto-promote students when this year becomes active
                                        </label>
                                        <small class="form-text text-muted">Students will move to next class automatically</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Optional Description -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-file-alt mr-2"></i> Additional Information (Optional)
                                    </h5>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="3" 
                                                  placeholder="Add any notes or description about this academic year"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Important Notice -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        <h6><i class="las la-exclamation-triangle mr-2"></i> Important Notice</h6>
                                        <p class="mb-0">
                                            Once created, you cannot delete an academic year if it contains student data, 
                                            fee records, or exam results. You can only archive it to make it read-only.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="las la-save mr-2"></i> Create Academic Year
                                    </button>
                                    <button type="reset" class="btn btn-danger">
                                        <i class="las la-redo mr-2"></i> Reset Form
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Date Validation -->
    <script>
        $(document).ready(function() {
            // Set default dates
            var currentYear = new Date().getFullYear();
            var nextYear = currentYear + 1;
            
            // Set default start date (April 1st of current year)
            $('input[name="start_date"]').val(currentYear + '-04-01');
            $('input[name="end_date"]').val(nextYear + '-03-31');
            
            // Set default year name
            $('input[name="name"]').val(currentYear + '-' + nextYear);
            
            // Validate end date is after start date
            $('input[name="end_date"]').on('change', function() {
                var startDate = new Date($('input[name="start_date"]').val());
                var endDate = new Date($(this).val());
                
                if (endDate <= startDate) {
                    alert('End date must be after start date');
                    $(this).val('');
                }
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
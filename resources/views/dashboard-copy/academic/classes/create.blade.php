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
                            <h4 class="card-title">Create New Class</h4>
                            <p class="mb-0">Add a new class to the academic structure</p>
                        </div>
                        <a href="#" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Back to Classes
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf
                            
                            <!-- Class Information -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-chalkboard mr-2"></i> Class Information
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Class Name *</label>
                                        <input type="text" name="name" class="form-control" 
                                               placeholder="e.g., Class 1, Kindergarten, O-Level Year 1" required>
                                        <small class="form-text text-muted">Enter the display name of the class</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Class Code</label>
                                        <input type="text" name="code" class="form-control" 
                                               placeholder="e.g., C1, KG, OL1">
                                        <small class="form-text text-muted">Short code for internal reference</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Academic Year</label>
                                        <select name="academic_year_id" class="form-control">
                                            <option value="">Not Linked to Specific Year</option>
                                            <option value="2024-2025" selected>2024-2025</option>
                                            <option value="2023-2024">2023-2024</option>
                                            <option value="2022-2023">2022-2023</option>
                                        </select>
                                        <small class="form-text text-muted">Optional - Leave empty if class exists across years</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Education System</label>
                                        <select name="education_system" class="form-control">
                                            <option value="matric" selected>Matriculation (Pakistan)</option>
                                            <option value="cambridge">Cambridge (O/A Levels)</option>
                                            <option value="montessori">Montessori</option>
                                            <option value="american">American System</option>
                                            <option value="ib">International Baccalaureate</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Display Order *</label>
                                        <input type="number" name="order_no" class="form-control" 
                                               value="1" min="1" max="100" required>
                                        <small class="form-text text-muted">Determines position in class lists</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Age Group</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="number" name="min_age" class="form-control" 
                                                       placeholder="Min Age" min="2" max="20">
                                            </div>
                                            <div class="col-6">
                                                <input type="number" name="max_age" class="form-control" 
                                                       placeholder="Max Age" min="3" max="25">
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">Optional age range for this class</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active" selected>Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Next Class (For Promotion)</label>
                                        <select name="next_class_id" class="form-control">
                                            <option value="">No Promotion (Final Class)</option>
                                            <option value="">Class 1</option>
                                            <option value="">Class 2</option>
                                            <option value="">Class 3</option>
                                            <option value="">Class 4</option>
                                            <option value="">Class 5</option>
                                            <option value="">Class 6</option>
                                            <option value="">Class 7</option>
                                            <option value="">Class 8</option>
                                            <option value="">Class 9</option>
                                            <option value="">Class 10</option>
                                        </select>
                                        <small class="form-text text-muted">Select where students promote after this class</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Section Settings -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-layer-group mr-2"></i> Section Settings
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Default Section Capacity</label>
                                        <input type="number" name="default_capacity" class="form-control" 
                                               value="25" min="1" max="50">
                                        <small class="form-text text-muted">Default student capacity for each section</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Create Initial Sections</label>
                                        <select name="initial_sections" class="form-control">
                                            <option value="0">Don't Create Sections</option>
                                            <option value="1" selected>Create 1 Section (A)</option>
                                            <option value="2">Create 2 Sections (A, B)</option>
                                            <option value="3">Create 3 Sections (A, B, C)</option>
                                            <option value="4">Create 4 Sections (A, B, C, D)</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="enable_sections" name="enable_sections" checked>
                                        <label class="custom-control-label" for="enable_sections">
                                            Enable Sections for this Class
                                        </label>
                                        <small class="form-text text-muted">Uncheck if this class doesn't need sections</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Fee & Admission Settings -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-money-bill-wave mr-2"></i> Fee & Admission Settings (Optional)
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Default Admission Fee</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">PKR</span>
                                            </div>
                                            <input type="number" name="admission_fee" class="form-control" 
                                                   placeholder="e.g., 5000" min="0">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Default Monthly Fee</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">PKR</span>
                                            </div>
                                            <input type="number" name="monthly_fee" class="form-control" 
                                                   placeholder="e.g., 3000" min="0">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <h6><i class="las la-info-circle mr-2"></i> Note</h6>
                                        <p class="mb-0">These are default values. You can set specific fee structures later in the Fee Management module.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Additional Information -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-file-alt mr-2"></i> Additional Information
                                    </h5>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="3" 
                                                  placeholder="Add any notes about this class"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Important Notes -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        <h6><i class="las la-exclamation-triangle mr-2"></i> Important Notes</h6>
                                        <ul class="mb-0">
                                            <li>Once students are enrolled in this class, you cannot delete it</li>
                                            <li>You can deactivate the class if no longer needed</li>
                                            <li>Display order determines the sequence in reports and lists</li>
                                            <li>Age group helps in student admission filtering</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="las la-save mr-2"></i> Create Class
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
    
    <!-- Age Validation -->
    <script>
        $(document).ready(function() {
            // Validate age range
            $('input[name="max_age"]').on('change', function() {
                var minAge = parseInt($('input[name="min_age"]').val()) || 0;
                var maxAge = parseInt($(this).val()) || 0;
                
                if (minAge > 0 && maxAge > 0 && maxAge <= minAge) {
                    alert('Maximum age must be greater than minimum age');
                    $(this).val('');
                }
            });
            
            // Auto-generate class code from name
            $('input[name="name"]').on('blur', function() {
                var className = $(this).val();
                var codeInput = $('input[name="code"]');
                
                if (className && !codeInput.val()) {
                    // Extract first letters or create simple code
                    var code = '';
                    if (className.toLowerCase().includes('class')) {
                        var match = className.match(/\d+/);
                        code = match ? 'C' + match[0] : 'C';
                    } else if (className.toLowerCase().includes('kg') || className.toLowerCase().includes('kindergarten')) {
                        code = 'KG';
                    } else if (className.toLowerCase().includes('nursery')) {
                        code = 'NUR';
                    } else {
                        // Take first 3 letters
                        code = className.substring(0, 3).toUpperCase();
                    }
                    
                    codeInput.val(code);
                }
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
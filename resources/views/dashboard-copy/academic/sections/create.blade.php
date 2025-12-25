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
                            <h4 class="card-title">Create New Section</h4>
                            <p class="mb-0">Add a new section to manage parallel classes</p>
                        </div>
                        <a href="#" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Back to Sections
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf
                            
                            <!-- Feature Status Alert -->
                            <div class="alert alert-info mb-4">
                                <h6><i class="las la-toggle-on mr-2"></i> Sections Feature: Enabled</h6>
                                <p class="mb-0">You can disable sections feature from School Settings if not needed.</p>
                            </div>

                            <!-- Section Information -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-layer-group mr-2"></i> Section Information
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Class *</label>
                                        <select name="class_id" class="form-control" required>
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
                                            <optgroup label="Cambridge System">
                                                <option value="olevel1">O Level Year 1</option>
                                                <option value="olevel2">O Level Year 2</option>
                                            </optgroup>
                                        </select>
                                        <small class="form-text text-muted">Select the class for this section</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Name *</label>
                                        <input type="text" name="name" class="form-control" 
                                               placeholder="e.g., A, B, Red, Morning" required>
                                        <small class="form-text text-muted">Unique name for this section within the class</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Academic Year</label>
                                        <select name="academic_year_id" class="form-control">
                                            <option value="">All Years</option>
                                            <option value="2024-2025" selected>2024-2025</option>
                                            <option value="2023-2024">2023-2024</option>
                                        </select>
                                        <small class="form-text text-muted">Optional - Leave empty if section exists across years</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Code</label>
                                        <input type="text" name="code" class="form-control" 
                                               placeholder="e.g., SEC-A, RED-GRP">
                                        <small class="form-text text-muted">Auto-generated if left blank</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Capacity</label>
                                        <input type="number" name="capacity" class="form-control" 
                                               value="25" min="1" max="50">
                                        <small class="form-text text-muted">Maximum number of students allowed</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Shift</label>
                                        <select name="shift" class="form-control">
                                            <option value="morning" selected>Morning Shift</option>
                                            <option value="evening">Evening Shift</option>
                                            <option value="day">Full Day</option>
                                            <option value="weekend">Weekend Classes</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Room Number</label>
                                        <input type="text" name="room_number" class="form-control" 
                                               placeholder="e.g., Room 101, Lab 3">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active" selected>Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="full">Full (No Vacancy)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Section Teacher Assignment -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-chalkboard-teacher mr-2"></i> Teacher Assignment (Optional)
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Class Teacher</label>
                                        <select name="class_teacher_id" class="form-control">
                                            <option value="">No Class Teacher Assigned</option>
                                            <option value="teacher1">Ms. Sarah Smith (Math)</option>
                                            <option value="teacher2">Mr. John Doe (English)</option>
                                            <option value="teacher3">Ms. Emma Wilson (Science)</option>
                                            <option value="teacher4">Mr. Ahmed Khan (Urdu)</option>
                                            <option value="teacher5">Ms. Fatima Ali (Islamiat)</option>
                                        </select>
                                        <small class="form-text text-muted">Primary teacher responsible for this section</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Assistant Teacher</label>
                                        <select name="assistant_teacher_id" class="form-control">
                                            <option value="">No Assistant Teacher</option>
                                            <option value="teacher6">Ms. Sophia Brown</option>
                                            <option value="teacher7">Mr. David Miller</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <h6><i class="las la-info-circle mr-2"></i> Note</h6>
                                        <p class="mb-0">You can assign subject teachers later in the timetable module</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Schedule & Timing -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-clock mr-2"></i> Schedule & Timing (Optional)
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <input type="time" name="start_time" class="form-control" value="08:00">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <input type="time" name="end_time" class="form-control" value="14:00">
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Week Days</label>
                                        <div class="row">
                                            <div class="col-6 col-md-4 col-lg-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="monday" name="weekdays[]" value="monday" checked>
                                                    <label class="custom-control-label" for="monday">Monday</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4 col-lg-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="tuesday" name="weekdays[]" value="tuesday" checked>
                                                    <label class="custom-control-label" for="tuesday">Tuesday</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4 col-lg-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="wednesday" name="weekdays[]" value="wednesday" checked>
                                                    <label class="custom-control-label" for="wednesday">Wednesday</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4 col-lg-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="thursday" name="weekdays[]" value="thursday" checked>
                                                    <label class="custom-control-label" for="thursday">Thursday</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4 col-lg-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="friday" name="weekdays[]" value="friday" checked>
                                                    <label class="custom-control-label" for="friday">Friday</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4 col-lg-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="saturday" name="weekdays[]" value="saturday">
                                                    <label class="custom-control-label" for="saturday">Saturday</label>
                                                </div>
                                            </div>
                                        </div>
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
                                                  placeholder="Add any notes about this section"></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="enable_attendance" name="enable_attendance" checked>
                                        <label class="custom-control-label" for="enable_attendance">
                                            Enable attendance tracking for this section
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="enable_fee_collection" name="enable_fee_collection" checked>
                                        <label class="custom-control-label" for="enable_fee_collection">
                                            Enable fee collection for this section
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Important Notes -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        <h6><i class="las la-exclamation-triangle mr-2"></i> Important Notes</h6>
                                        <ul class="mb-0">
                                            <li>Section name must be unique within the same class</li>
                                            <li>You cannot delete a section with enrolled students</li>
                                            <li>Capacity helps in managing student admissions</li>
                                            <li>Schedule information helps in timetable planning</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="las la-save mr-2"></i> Create Section
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
    
    <!-- Auto-generate Section Code -->
    <script>
        $(document).ready(function() {
            // Auto-generate section code
            $('input[name="name"]').on('blur', function() {
                var sectionName = $(this).val();
                var classSelect = $('select[name="class_id"]');
                var selectedClass = classSelect.find('option:selected').text();
                var codeInput = $('input[name="code"]');
                
                if (sectionName && selectedClass && !codeInput.val()) {
                    // Extract class code (first word or abbreviation)
                    var classCode = selectedClass.split(' ')[0];
                    if (classCode.length > 3) classCode = classCode.substring(0, 3);
                    
                    // Generate section code
                    var sectionCode = classCode.toUpperCase() + '-' + sectionName.toUpperCase();
                    codeInput.val(sectionCode);
                }
            });
            
            // Validate time
            $('input[name="end_time"]').on('change', function() {
                var startTime = $('input[name="start_time"]').val();
                var endTime = $(this).val();
                
                if (startTime && endTime && endTime <= startTime) {
                    alert('End time must be after start time');
                    $(this).val('');
                }
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
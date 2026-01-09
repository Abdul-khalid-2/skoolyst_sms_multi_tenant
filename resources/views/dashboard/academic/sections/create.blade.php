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
                        <a href="{{ route('sections.index') }}" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Back to Sections
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sections.store') }}" method="POST">
                            @csrf
                            
                            <!-- Feature Status Alert -->
                            <div class="alert alert-info mb-4">
                                <h6><i class="las la-toggle-on mr-2"></i> Sections Feature: Enabled</h6>
                                <p class="mb-0">You can disable sections feature from School Settings if not needed.</p>
                            </div>

                            @if(session('error'))
                                <div class="alert alert-danger mb-4">
                                    <i class="las la-exclamation-triangle mr-2"></i>{{ session('error') }}
                                </div>
                            @endif

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
                                        <select name="class_id" class="form-control @error('class_id') is-invalid @enderror" required>
                                            <option value="">Select Class</option>
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}" 
                                                    {{ old('class_id', request('class_id')) == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <small class="form-text text-muted">Select the class for this section</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Name *</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                               placeholder="e.g., A, B, Red, Morning" 
                                               value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <small class="form-text text-muted">Unique name for this section within the class</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Academic Year</label>
                                        <select name="academic_year_id" class="form-control">
                                            <option value="">All Years</option>
                                            @foreach($academicYears as $year)
                                                <option value="{{ $year->id }}" 
                                                    {{ old('academic_year_id') == $year->id ? 'selected' : '' }}>
                                                    {{ $year->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Optional - Leave empty if section exists across years</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Code</label>
                                        <input type="text" name="code" class="form-control" 
                                               placeholder="e.g., SEC-A, RED-GRP"
                                               value="{{ old('code') }}">
                                        <small class="form-text text-muted">Auto-generated if left blank</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Capacity *</label>
                                        <input type="number" name="capacity" class="form-control @error('capacity') is-invalid @enderror" 
                                               value="{{ old('capacity', 25) }}" min="1" max="50" required>
                                        @error('capacity')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <small class="form-text text-muted">Maximum number of students allowed</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Shift *</label>
                                        <select name="shift" class="form-control @error('shift') is-invalid @enderror" required>
                                            <option value="">Select Shift</option>
                                            <option value="morning" {{ old('shift') == 'morning' ? 'selected' : 'selected' }}>Morning Shift</option>
                                            <option value="evening" {{ old('shift') == 'evening' ? 'selected' : '' }}>Evening Shift</option>
                                            <option value="day" {{ old('shift') == 'day' ? 'selected' : '' }}>Full Day</option>
                                            <option value="weekend" {{ old('shift') == 'weekend' ? 'selected' : '' }}>Weekend Classes</option>
                                        </select>
                                        @error('shift')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Room Number</label>
                                        <input type="text" name="room_number" class="form-control" 
                                               placeholder="e.g., Room 101, Lab 3"
                                               value="{{ old('room_number') }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status *</label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                            <option value="">Select Status</option>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : 'selected' }}>Active</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            <option value="full" {{ old('status') == 'full' ? 'selected' : '' }}>Full (No Vacancy)</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
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
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" 
                                                    {{ old('class_teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                    {{ $teacher->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Primary teacher responsible for this section</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Assistant Teacher</label>
                                        <select name="assistant_teacher_id" class="form-control">
                                            <option value="">No Assistant Teacher</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" 
                                                    {{ old('assistant_teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                    {{ $teacher->name }}
                                                </option>
                                            @endforeach
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
                                        <input type="time" name="start_time" class="form-control" 
                                               value="{{ old('start_time', '08:00') }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <input type="time" name="end_time" class="form-control" 
                                               value="{{ old('end_time', '14:00') }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Week Days</label>
                                        <div class="row">
                                            @php
                                                $weekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                                                $oldWeekdays = old('weekdays', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday']);
                                            @endphp
                                            @foreach($weekdays as $day)
                                                <div class="col-6 col-md-4 col-lg-2">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" 
                                                               id="{{ $day }}" name="weekdays[]" 
                                                               value="{{ $day }}"
                                                               {{ in_array($day, $oldWeekdays) ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="{{ $day }}">
                                                            {{ ucfirst($day) }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
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
                                                  placeholder="Add any notes about this section">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="enable_attendance" name="enable_attendance" 
                                               {{ old('enable_attendance', true) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="enable_attendance">
                                            Enable attendance tracking for this section
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="enable_fee_collection" name="enable_fee_collection" 
                                               {{ old('enable_fee_collection', true) ? 'checked' : '' }}>
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
            // Function to generate section code
            function generateSectionCode() {
                var sectionName = $('input[name="name"]').val();
                var classId = $('select[name="class_id"]').val();
                var classText = $('select[name="class_id"] option:selected').text();
                var codeInput = $('input[name="code"]');
                
                if (sectionName && classId && !codeInput.val()) {
                    // Extract class code (first word or abbreviation)
                    var classCode = classText.split(' ')[0];
                    if (classCode.length > 3) classCode = classCode.substring(0, 3);
                    
                    // Generate section code
                    var sectionCode = classCode.toUpperCase() + '-' + sectionName.toUpperCase();
                    codeInput.val(sectionCode);
                }
            }
            
            // Auto-generate section code
            $('input[name="name"]').on('blur', generateSectionCode);
            $('select[name="class_id"]').on('change', generateSectionCode);
            
            // Validate time
            $('input[name="end_time"]').on('change', function() {
                var startTime = $('input[name="start_time"]').val();
                var endTime = $(this).val();
                
                if (startTime && endTime && endTime <= startTime) {
                    alert('End time must be after start time');
                    $(this).val('');
                }
            });
            
            // Auto-select capacity based on shift
            $('select[name="shift"]').on('change', function() {
                var capacityInput = $('input[name="capacity"]');
                var shift = $(this).val();
                
                if (!capacityInput.val()) {
                    var defaultCapacity = 25;
                    if (shift === 'evening') defaultCapacity = 30;
                    if (shift === 'day') defaultCapacity = 20;
                    if (shift === 'weekend') defaultCapacity = 15;
                    
                    capacityInput.val(defaultCapacity);
                }
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
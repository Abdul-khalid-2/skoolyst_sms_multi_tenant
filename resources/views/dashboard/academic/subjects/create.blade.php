<!-- resources/views/dashboard/academic/subjects/create.blade.php -->
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
                            <h4 class="card-title">Create New Subject</h4>
                            <p class="mb-0">Add a new subject to the academic curriculum</p>
                        </div>
                        <a href="{{ route('subjects.index') }}" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Back to Subjects
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('subjects.store') }}" method="POST">
                            @csrf
                            
                            @if(session('error'))
                                <div class="alert alert-danger mb-4">
                                    <i class="las la-exclamation-triangle mr-2"></i>{{ session('error') }}
                                </div>
                            @endif

                            <!-- Subject Information -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-book-open mr-2"></i> Subject Information
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subject Name *</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                               placeholder="e.g., Mathematics, English Language, Physics" 
                                               value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <small class="form-text text-muted">Full name of the subject</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subject Code *</label>
                                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" 
                                               placeholder="e.g., MATH-101, ENG-102" 
                                               value="{{ old('code') }}" required>
                                        @error('code')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <small class="form-text text-muted">Unique code for identification</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subject Type *</label>
                                        <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                                            <option value="">Select Type</option>
                                            <option value="theory" {{ old('type') == 'theory' ? 'selected' : 'selected' }}>Theory</option>
                                            <option value="practical" {{ old('type') == 'practical' ? 'selected' : '' }}>Practical</option>
                                            <option value="both" {{ old('type') == 'both' ? 'selected' : '' }}>Theory & Practical</option>
                                            <option value="project" {{ old('type') == 'project' ? 'selected' : '' }}>Project Based</option>
                                            <option value="activity" {{ old('type') == 'activity' ? 'selected' : '' }}>Activity Based</option>
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subject Category</label>
                                        <select name="category" class="form-control">
                                            <option value="">Select Category</option>
                                            <option value="language" {{ old('category') == 'language' ? 'selected' : '' }}>Language</option>
                                            <option value="science" {{ old('category') == 'science' ? 'selected' : '' }}>Science & Mathematics</option>
                                            <option value="social" {{ old('category') == 'social' ? 'selected' : '' }}>Social Studies</option>
                                            <option value="arts" {{ old('category') == 'arts' ? 'selected' : '' }}>Arts & Creative</option>
                                            <option value="computer" {{ old('category') == 'computer' ? 'selected' : '' }}>Computer & IT</option>
                                            <option value="islamic" {{ old('category') == 'islamic' ? 'selected' : '' }}>Islamic Studies</option>
                                            <option value="physical" {{ old('category') == 'physical' ? 'selected' : '' }}>Physical Education</option>
                                            <option value="vocational" {{ old('category') == 'vocational' ? 'selected' : '' }}>Vocational</option>
                                            <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Credit Hours</label>
                                        <input type="number" name="credit_hours" class="form-control" 
                                               placeholder="e.g., 3" min="0" max="10" step="0.5"
                                               value="{{ old('credit_hours') }}">
                                        <small class="form-text text-muted">Number of credit hours (if applicable)</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status *</label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                            <option value="">Select Status</option>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : 'selected' }}>Active</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea name="short_description" class="form-control" rows="2" 
                                                  placeholder="Brief description of the subject">{{ old('short_description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Assign to Classes -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-chalkboard-teacher mr-2"></i> Assign to Classes
                                    </h5>
                                    <p class="text-muted">Select classes where this subject will be taught</p>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <!-- Group classes by level -->
                                                @php
                                                    $primaryClasses = $classes->filter(function($class) {
                                                        return preg_match('/Class\s+[1-5]\b/i', $class->name) ||
                                                            preg_match('/\b(Play|Nursery|KG|Kindergarten)\b/i', $class->name);
                                                    });

                                                    $middleClasses = $classes->filter(function($class) {
                                                        return preg_match('/Class\s+[6-8]\b/i', $class->name);
                                                    });

                                                    $secondaryClasses = $classes->filter(function($class) {
                                                        return preg_match('/Class\s+(9|10)\b/i', $class->name) ||
                                                            preg_match('/O\s*Level|A\s*Level|Cambridge/i', $class->name);
                                                    });

                                                    
                                                    $otherClasses = $classes->filter(function($class) use ($primaryClasses, $middleClasses, $secondaryClasses) {
                                                        return !$primaryClasses->contains($class) && 
                                                               !$middleClasses->contains($class) && 
                                                               !$secondaryClasses->contains($class);
                                                    });
                                                @endphp
                                                
                                                @if($primaryClasses->isNotEmpty())
                                                    <div class="col-md-4 mb-4">
                                                        <h6 class="mb-3">Pre-Primary & Primary</h6>
                                                        @foreach($primaryClasses as $class)
                                                            <div class="custom-control custom-checkbox mb-2">
                                                                <input type="checkbox" class="custom-control-input" 
                                                                       id="class_{{ $class->id }}" 
                                                                       name="classes[]" 
                                                                       value="{{ $class->id }}"
                                                                       {{ in_array($class->id, old('classes', [])) ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="class_{{ $class->id }}">
                                                                    {{ $class->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                
                                                @if($middleClasses->isNotEmpty())
                                                    <div class="col-md-4 mb-4">
                                                        <h6 class="mb-3">Middle Section</h6>
                                                        @foreach($middleClasses as $class)
                                                            <div class="custom-control custom-checkbox mb-2">
                                                                <input type="checkbox" class="custom-control-input" 
                                                                       id="class_{{ $class->id }}" 
                                                                       name="classes[]" 
                                                                       value="{{ $class->id }}"
                                                                       {{ in_array($class->id, old('classes', [])) ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="class_{{ $class->id }}">
                                                                    {{ $class->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                
                                                @if($secondaryClasses->isNotEmpty())
                                                    <div class="col-md-4 mb-4">
                                                        <h6 class="mb-3">Secondary & Cambridge</h6>
                                                        @foreach($secondaryClasses as $class)
                                                            <div class="custom-control custom-checkbox mb-2">
                                                                <input type="checkbox" class="custom-control-input" 
                                                                       id="class_{{ $class->id }}" 
                                                                       name="classes[]" 
                                                                       value="{{ $class->id }}"
                                                                       {{ in_array($class->id, old('classes', [])) ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="class_{{ $class->id }}">
                                                                    {{ $class->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            <!-- Quick Select Buttons -->
                                            <div class="mt-3">
                                                <button type="button" class="btn btn-sm btn-outline-primary mr-2" id="selectAll">
                                                    Select All
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" id="clearAll">
                                                    Clear All
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Academic Details -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-graduation-cap mr-2"></i> Academic Details
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Marks</label>
                                        <input type="number" name="total_marks" class="form-control" 
                                               placeholder="e.g., 100" min="0" max="500"
                                               value="{{ old('total_marks') }}">
                                        <small class="form-text text-muted">Maximum marks for this subject</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Passing Marks</label>
                                        <input type="number" name="passing_marks" class="form-control" 
                                               placeholder="e.g., 33" min="0" max="500"
                                               value="{{ old('passing_marks') }}">
                                        <small class="form-text text-muted">Minimum marks required to pass</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Weekly Periods</label>
                                        <input type="number" name="weekly_periods" class="form-control" 
                                               value="{{ old('weekly_periods', 5) }}" min="1" max="20">
                                        <small class="form-text text-muted">Number of periods per week</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Period Duration (minutes)</label>
                                        <input type="number" name="period_duration" class="form-control" 
                                               value="{{ old('period_duration', 40) }}" min="15" max="120">
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="is_optional" name="is_optional"
                                               {{ old('is_optional') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_optional">
                                            This is an optional/elective subject
                                        </label>
                                        <small class="form-text text-muted">Students can choose optional subjects</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="has_lab" name="has_lab"
                                               {{ old('has_lab') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="has_lab">
                                            This subject has laboratory work
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Teacher Assignment -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-user-tie mr-2"></i> Teacher Assignment (Optional)
                                    </h5>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <h6><i class="las la-info-circle mr-2"></i> Note</h6>
                                        <p class="mb-0">You can assign specific teachers to this subject for different classes later. This is just for default assignment.</p>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Default Teacher</label>
                                        <select name="default_teacher_id" class="form-control">
                                            <option value="">No Default Teacher</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" 
                                                    {{ old('default_teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                    {{ $teacher->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Primary teacher for this subject</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alternative Teacher</label>
                                        <select name="alternative_teacher_id" class="form-control">
                                            <option value="">No Alternative Teacher</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" 
                                                    {{ old('alternative_teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                    {{ $teacher->name }}
                                                </option>
                                            @endforeach
                                        </select>
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
                                        <label>Syllabus / Course Outline</label>
                                        <textarea name="syllabus" class="form-control" rows="3" 
                                                  placeholder="Brief syllabus or course outline">{{ old('syllabus') }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Learning Objectives</label>
                                        <textarea name="objectives" class="form-control" rows="3" 
                                                  placeholder="Learning objectives for this subject">{{ old('objectives') }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="enable_exams" name="enable_exams" 
                                               {{ old('enable_exams', true) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="enable_exams">
                                            Enable exams for this subject
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="enable_homework" name="enable_homework" 
                                               {{ old('enable_homework', true) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="enable_homework">
                                            Enable homework/assignments
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
                                            <li>Subject code must be unique across all subjects</li>
                                            <li>You cannot delete a subject with exam records</li>
                                            <li>Subject can be assigned to multiple classes</li>
                                            <li>Marks distribution helps in result calculation</li>
                                            <li>Optional subjects appear in student selection</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="las la-save mr-2"></i> Create Subject
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
    
    <!-- Class Selection Helpers -->
    <script>
        $(document).ready(function() {
            // Auto-generate subject code
            $('input[name="name"]').on('blur', function() {
                var subjectName = $(this).val();
                var codeInput = $('input[name="code"]');
                
                if (subjectName && !codeInput.val()) {
                    // Take first 3-4 letters and add numbers
                    var words = subjectName.split(' ');
                    var code = '';
                    
                    if (words.length >= 2) {
                        // Use first letters of first two words
                        code = words[0].substring(0, 3).toUpperCase() + '-' + 
                               words[1].substring(0, 2).toUpperCase() + '101';
                    } else {
                        // Use first 3 letters
                        code = subjectName.substring(0, 3).toUpperCase() + '-101';
                    }
                    
                    codeInput.val(code);
                }
            });
            
            // Quick select buttons
            $('#selectAll').click(function() {
                $('input[name="classes[]"]').prop('checked', true);
            });
            
            $('#clearAll').click(function() {
                $('input[name="classes[]"]').prop('checked', false);
            });
            
            // Validate passing marks
            $('input[name="passing_marks"]').on('change', function() {
                var totalMarks = parseInt($('input[name="total_marks"]').val()) || 0;
                var passingMarks = parseInt($(this).val()) || 0;
                
                if (totalMarks > 0 && passingMarks > totalMarks) {
                    alert('Passing marks cannot exceed total marks');
                    $(this).val('');
                }
            });
            
            // Auto-check lab for certain subject types
            $('select[name="type"]').on('change', function() {
                var type = $(this).val();
                var hasLabCheckbox = $('#has_lab');
                
                if (type === 'practical' || type === 'both') {
                    hasLabCheckbox.prop('checked', true);
                } else if (type === 'theory') {
                    hasLabCheckbox.prop('checked', false);
                }
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
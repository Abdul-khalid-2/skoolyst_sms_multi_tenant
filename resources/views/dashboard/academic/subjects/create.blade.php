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
                        <a href="#" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Back to Subjects
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf
                            
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
                                        <input type="text" name="name" class="form-control" 
                                               placeholder="e.g., Mathematics, English Language, Physics" required>
                                        <small class="form-text text-muted">Full name of the subject</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subject Code *</label>
                                        <input type="text" name="code" class="form-control" 
                                               placeholder="e.g., MATH-101, ENG-102" required>
                                        <small class="form-text text-muted">Unique code for identification</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subject Type *</label>
                                        <select name="type" class="form-control" required>
                                            <option value="theory" selected>Theory</option>
                                            <option value="practical">Practical</option>
                                            <option value="both">Theory & Practical</option>
                                            <option value="project">Project Based</option>
                                            <option value="activity">Activity Based</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subject Category</label>
                                        <select name="category" class="form-control">
                                            <option value="">Select Category</option>
                                            <option value="language">Language</option>
                                            <option value="science">Science & Mathematics</option>
                                            <option value="social">Social Studies</option>
                                            <option value="arts">Arts & Creative</option>
                                            <option value="computer">Computer & IT</option>
                                            <option value="islamic">Islamic Studies</option>
                                            <option value="physical">Physical Education</option>
                                            <option value="vocational">Vocational</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Credit Hours</label>
                                        <input type="number" name="credit_hours" class="form-control" 
                                               placeholder="e.g., 3" min="0" max="10" step="0.5">
                                        <small class="form-text text-muted">Number of credit hours (if applicable)</small>
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
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea name="short_description" class="form-control" rows="2" 
                                                  placeholder="Brief description of the subject"></textarea>
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
                                                <!-- Pre-Primary Classes -->
                                                <div class="col-md-4 mb-4">
                                                    <h6 class="mb-3">Pre-Primary Section</h6>
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox" class="custom-control-input" id="class_playgroup" name="classes[]" value="playgroup">
                                                        <label class="custom-control-label" for="class_playgroup">Play Group</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox" class="custom-control-input" id="class_nursery" name="classes[]" value="nursery">
                                                        <label class="custom-control-label" for="class_nursery">Nursery</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="class_kg" name="classes[]" value="kg">
                                                        <label class="custom-control-label" for="class_kg">Kindergarten (KG)</label>
                                                    </div>
                                                </div>
                                                
                                                <!-- Primary Classes -->
                                                <div class="col-md-4 mb-4">
                                                    <h6 class="mb-3">Primary Section (Class 1-5)</h6>
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox" class="custom-control-input" id="class1" name="classes[]" value="class1" checked>
                                                        <label class="custom-control-label" for="class1">Class 1</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox" class="custom-control-input" id="class2" name="classes[]" value="class2" checked>
                                                        <label class="custom-control-label" for="class2">Class 2</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox" class="custom-control-input" id="class3" name="classes[]" value="class3" checked>
                                                        <label class="custom-control-label" for="class3">Class 3</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox" class="custom-control-input" id="class4" name="classes[]" value="class4">
                                                        <label class="custom-control-label" for="class4">Class 4</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="class5" name="classes[]" value="class5">
                                                        <label class="custom-control-label" for="class5">Class 5</label>
                                                    </div>
                                                </div>
                                                
                                                <!-- Middle & Secondary -->
                                                <div class="col-md-4 mb-4">
                                                    <h6 class="mb-3">Middle & Secondary</h6>
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox" class="custom-control-input" id="class6" name="classes[]" value="class6">
                                                        <label class="custom-control-label" for="class6">Class 6</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox" class="custom-control-input" id="class7" name="classes[]" value="class7">
                                                        <label class="custom-control-label" for="class7">Class 7</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox" class="custom-control-input" id="class8" name="classes[]" value="class8">
                                                        <label class="custom-control-label" for="class8">Class 8</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox" class="custom-control-input" id="class9" name="classes[]" value="class9">
                                                        <label class="custom-control-label" for="class9">Class 9</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="class10" name="classes[]" value="class10">
                                                        <label class="custom-control-label" for="class10">Class 10</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Quick Select Buttons -->
                                            <div class="mt-3">
                                                <button type="button" class="btn btn-sm btn-outline-primary mr-2" id="selectAllPrimary">
                                                    Select All Primary
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-primary mr-2" id="selectAllSecondary">
                                                    Select All Secondary
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
                                               placeholder="e.g., 100" min="0" max="500">
                                        <small class="form-text text-muted">Maximum marks for this subject</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Passing Marks</label>
                                        <input type="number" name="passing_marks" class="form-control" 
                                               placeholder="e.g., 33" min="0" max="500">
                                        <small class="form-text text-muted">Minimum marks required to pass</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Weekly Periods</label>
                                        <input type="number" name="weekly_periods" class="form-control" 
                                               value="5" min="1" max="20">
                                        <small class="form-text text-muted">Number of periods per week</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Period Duration (minutes)</label>
                                        <input type="number" name="period_duration" class="form-control" 
                                               value="40" min="15" max="120">
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="is_optional" name="is_optional">
                                        <label class="custom-control-label" for="is_optional">
                                            This is an optional/elective subject
                                        </label>
                                        <small class="form-text text-muted">Students can choose optional subjects</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="has_lab" name="has_lab">
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
                                            <option value="teacher1">Ms. Sarah Smith (Mathematics)</option>
                                            <option value="teacher2">Mr. John Doe (English)</option>
                                            <option value="teacher3">Ms. Emma Wilson (Science)</option>
                                            <option value="teacher4">Mr. Ahmed Khan (Urdu)</option>
                                            <option value="teacher5">Ms. Fatima Ali (Islamiat)</option>
                                            <option value="teacher6">Mr. David Miller (Computer)</option>
                                        </select>
                                        <small class="form-text text-muted">Primary teacher for this subject</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alternative Teacher</label>
                                        <select name="alternative_teacher_id" class="form-control">
                                            <option value="">No Alternative Teacher</option>
                                            <option value="teacher7">Ms. Sophia Brown</option>
                                            <option value="teacher8">Mr. Robert Taylor</option>
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
                                                  placeholder="Brief syllabus or course outline"></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Learning Objectives</label>
                                        <textarea name="objectives" class="form-control" rows="3" 
                                                  placeholder="Learning objectives for this subject"></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="enable_exams" name="enable_exams" checked>
                                        <label class="custom-control-label" for="enable_exams">
                                            Enable exams for this subject
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="enable_homework" name="enable_homework" checked>
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
            $('#selectAllPrimary').click(function() {
                $('#class1, #class2, #class3, #class4, #class5').prop('checked', true);
            });
            
            $('#selectAllSecondary').click(function() {
                $('#class6, #class7, #class8, #class9, #class10').prop('checked', true);
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
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
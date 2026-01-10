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
                            <h4 class="card-title">Student Registration</h4>
                            <p class="mb-0">Register new student with complete information</p>
                        </div>
                        <a href="{{ route('students.index') }}" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Back to Students
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" id="studentForm">
                            @csrf
                            
                            <!-- Registration Progress -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="registration-progress">
                                        <div class="progress-steps">
                                            <div class="step active">
                                                <div class="step-number">1</div>
                                                <div class="step-label">Personal Info</div>
                                            </div>
                                            <div class="step">
                                                <div class="step-number">2</div>
                                                <div class="step-label">Guardian Info</div>
                                            </div>
                                            <div class="step">
                                                <div class="step-number">3</div>
                                                <div class="step-label">Academic Info</div>
                                            </div>
                                            <div class="step">
                                                <div class="step-number">4</div>
                                                <div class="step-label">Review & Submit</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Validation Errors -->
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Step 1: Personal Information -->
                            <div class="registration-step active" id="step1">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="las la-user-circle mr-2"></i> Personal Information
                                        </h5>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name *</label>
                                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" 
                                                   placeholder="Enter first name" value="{{ old('first_name') }}" required>
                                            @error('first_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name *</label>
                                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" 
                                                   placeholder="Enter last name" value="{{ old('last_name') }}" required>
                                            @error('last_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth *</label>
                                            <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                                   value="{{ old('date_of_birth') }}" required>
                                            @error('date_of_birth')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender *</label>
                                            <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                                <option value="">Select Gender</option>
                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nationality</label>
                                            <select name="nationality" class="form-control">
                                                <option value="">Select Nationality</option>
                                                <option value="pakistani" {{ old('nationality', 'pakistani') == 'pakistani' ? 'selected' : '' }}>Pakistani</option>
                                                <option value="indian" {{ old('nationality') == 'indian' ? 'selected' : '' }}>Indian</option>
                                                <option value="bangladeshi" {{ old('nationality') == 'bangladeshi' ? 'selected' : '' }}>Bangladeshi</option>
                                                <option value="sri_lankan" {{ old('nationality') == 'sri_lankan' ? 'selected' : '' }}>Sri Lankan</option>
                                                <option value="other" {{ old('nationality') == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Religion</label>
                                            <select name="religion" class="form-control">
                                                <option value="">Select Religion</option>
                                                <option value="islam" {{ old('religion', 'islam') == 'islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="christianity" {{ old('religion') == 'christianity' ? 'selected' : '' }}>Christianity</option>
                                                <option value="hinduism" {{ old('religion') == 'hinduism' ? 'selected' : '' }}>Hinduism</option>
                                                <option value="sikhism" {{ old('religion') == 'sikhism' ? 'selected' : '' }}>Sikhism</option>
                                                <option value="other" {{ old('religion') == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Blood Group</label>
                                            <select name="blood_group" class="form-control">
                                                <option value="">Unknown</option>
                                                <option value="a+" {{ old('blood_group') == 'a+' ? 'selected' : '' }}>A+</option>
                                                <option value="a-" {{ old('blood_group') == 'a-' ? 'selected' : '' }}>A-</option>
                                                <option value="b+" {{ old('blood_group') == 'b+' ? 'selected' : '' }}>B+</option>
                                                <option value="b-" {{ old('blood_group') == 'b-' ? 'selected' : '' }}>B-</option>
                                                <option value="ab+" {{ old('blood_group') == 'ab+' ? 'selected' : '' }}>AB+</option>
                                                <option value="ab-" {{ old('blood_group') == 'ab-' ? 'selected' : '' }}>AB-</option>
                                                <option value="o+" {{ old('blood_group') == 'o+' ? 'selected' : '' }}>O+</option>
                                                <option value="o-" {{ old('blood_group') == 'o-' ? 'selected' : '' }}>O-</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CNIC (if applicable)</label>
                                            <input type="text" name="cnic" class="form-control @error('cnic') is-invalid @enderror" 
                                                   placeholder="XXXXX-XXXXXXX-X" value="{{ old('cnic') }}">
                                            @error('cnic')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address *</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" 
                                                      placeholder="Enter current address" required>{{ old('address') }}</textarea>
                                            @error('address')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                                   placeholder="student@example.com" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                                   placeholder="+92 300 1234567" value="{{ old('phone') }}">
                                            @error('phone')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Student Photo</label>
                                            <div class="custom-file">
                                                <input type="file" name="photo" class="custom-file-input @error('photo') is-invalid @enderror" 
                                                       id="studentPhoto" accept="image/*">
                                                <label class="custom-file-label" for="studentPhoto">Choose file</label>
                                                @error('photo')
                                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <small class="form-text text-muted">Recommended: Passport size photo (300x300 px, max 2MB)</small>
                                            <div id="photoPreview" class="mt-3"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-primary next-step" data-next="step2">
                                            Next: Guardian Information <i class="las la-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Guardian Information -->
                            <div class="registration-step" id="step2">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="las la-users mr-2"></i> Guardian Information
                                        </h5>
                                        <p class="text-muted">Primary guardian information (Father/Mother)</p>
                                    </div>
                                    
                                    <!-- Father Information -->
                                    <div class="col-md-12">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-male mr-2"></i> Father's Information
                                        </h6>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father's Name *</label>
                                            <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror" 
                                                   placeholder="Enter father's full name" value="{{ old('father_name') }}" required>
                                            @error('father_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father's CNIC</label>
                                            <input type="text" name="father_cnic" class="form-control @error('father_cnic') is-invalid @enderror" 
                                                   placeholder="XXXXX-XXXXXXX-X" value="{{ old('father_cnic') }}">
                                            @error('father_cnic')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father's Occupation</label>
                                            <input type="text" name="father_occupation" class="form-control" 
                                                   placeholder="e.g., Business, Service, Doctor" value="{{ old('father_occupation') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father's Monthly Income (PKR)</label>
                                            <div class="input-group">
                                                <input type="number" name="father_income" class="form-control" 
                                                       placeholder="Approximate monthly income" value="{{ old('father_income') }}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father's Email</label>
                                            <input type="email" name="father_email" class="form-control @error('father_email') is-invalid @enderror" 
                                                   placeholder="father@example.com" value="{{ old('father_email') }}">
                                            @error('father_email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father's Phone *</label>
                                            <input type="text" name="father_phone" class="form-control @error('father_phone') is-invalid @enderror" 
                                                   placeholder="+92 300 1234567" value="{{ old('father_phone') }}" required>
                                            @error('father_phone')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- Mother Information -->
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-female mr-2"></i> Mother's Information
                                        </h6>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mother's Name</label>
                                            <input type="text" name="mother_name" class="form-control" 
                                                   placeholder="Enter mother's full name" value="{{ old('mother_name') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mother's CNIC</label>
                                            <input type="text" name="mother_cnic" class="form-control" 
                                                   placeholder="XXXXX-XXXXXXX-X" value="{{ old('mother_cnic') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mother's Occupation</label>
                                            <input type="text" name="mother_occupation" class="form-control" 
                                                   placeholder="e.g., Housewife, Teacher, Doctor" value="{{ old('mother_occupation') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mother's Email</label>
                                            <input type="email" name="mother_email" class="form-control" 
                                                   placeholder="mother@example.com" value="{{ old('mother_email') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mother's Phone</label>
                                            <input type="text" name="mother_phone" class="form-control" 
                                                   placeholder="+92 300 2345678" value="{{ old('mother_phone') }}">
                                        </div>
                                    </div>
                                    
                                    <!-- Emergency Contact -->
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-phone mr-2"></i> Emergency Contact (Other than Parents)
                                        </h6>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Emergency Contact Name</label>
                                            <input type="text" name="emergency_name" class="form-control" 
                                                   placeholder="Name of emergency contact" value="{{ old('emergency_name') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Emergency Contact Relation</label>
                                            <input type="text" name="emergency_relation" class="form-control" 
                                                   placeholder="e.g., Uncle, Aunt, Grandfather" value="{{ old('emergency_relation') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Emergency Contact Phone</label>
                                            <input type="text" name="emergency_phone" class="form-control" 
                                                   placeholder="+92 300 3456789" value="{{ old('emergency_phone') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Emergency Contact Address</label>
                                            <input type="text" name="emergency_address" class="form-control" 
                                                   placeholder="Address of emergency contact" value="{{ old('emergency_address') }}">
                                        </div>
                                    </div>
                                    
                                    <!-- Medical Information -->
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-heartbeat mr-2"></i> Medical Information
                                        </h6>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Medical Conditions/Allergies</label>
                                            <textarea name="medical_conditions" class="form-control" rows="2" 
                                                      placeholder="Any medical conditions, allergies, or special needs">{{ old('medical_conditions') }}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Current Medications</label>
                                            <textarea name="medications" class="form-control" rows="2" 
                                                      placeholder="List any current medications">{{ old('medications') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary prev-step" data-prev="step1">
                                            <i class="las la-arrow-left mr-2"></i> Previous
                                        </button>
                                        <button type="button" class="btn btn-primary next-step" data-next="step3">
                                            Next: Academic Information <i class="las la-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Academic Information -->
                            <div class="registration-step" id="step3">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="las la-graduation-cap mr-2"></i> Academic Information
                                        </h5>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Academic Year *</label>
                                            <select name="academic_year_id" class="form-control @error('academic_year_id') is-invalid @enderror" required>
                                                <option value="">Select Academic Year</option>
                                                @foreach($academicYears as $academicYear)
                                                    <option value="{{ $academicYear->id }}" 
                                                        {{ old('academic_year_id', $academicYears->first()->id ?? '') == $academicYear->id ? 'selected' : '' }}>
                                                        {{ $academicYear->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('academic_year_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Admission Date *</label>
                                            <input type="date" name="admission_date" class="form-control @error('admission_date') is-invalid @enderror" 
                                                   value="{{ old('admission_date', date('Y-m-d')) }}" required>
                                            @error('admission_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Class *</label>
                                            <select name="class_id" class="form-control @error('class_id') is-invalid @enderror" required>
                                                <option value="">Select Class</option>
                                                @foreach($classes as $class)
                                                    <option value="{{ $class->id }}" 
                                                        {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                        {{ $class->name }}
                                                        @if($class->code) ({{ $class->code }}) @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Section</label>
                                            <select name="section_id" class="form-control" id="sectionSelect">
                                                <option value="">Select Section</option>
                                                <!-- Sections will be loaded via AJAX -->
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <select name="branch_id" class="form-control">
                                                <option value="">Select Branch</option>
                                                @foreach($branches as $branch)
                                                    <option value="{{ $branch->id }}" 
                                                        {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                                        {{ $branch->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Roll Number</label>
                                            <input type="text" name="roll_no" class="form-control @error('roll_no') is-invalid @enderror" 
                                                   placeholder="Auto-generated if left blank" value="{{ old('roll_no') }}">
                                            @error('roll_no')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Previous School Information -->
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-school mr-2"></i> Previous School Information (If Applicable)
                                        </h6>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Previous School Name</label>
                                            <input type="text" name="previous_school" class="form-control" 
                                                   placeholder="Name of previous school" value="{{ old('previous_school') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Remarks/Additional Information</label>
                                            <textarea name="remarks" class="form-control" rows="2" 
                                                      placeholder="Any additional information">{{ old('remarks') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary prev-step" data-prev="step2">
                                            <i class="las la-arrow-left mr-2"></i> Previous
                                        </button>
                                        <button type="button" class="btn btn-primary next-step" data-next="step4">
                                            Next: Review & Submit <i class="las la-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4: Review & Submit -->
                            <div class="registration-step" id="step4">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="las la-clipboard-check mr-2"></i> Review & Submit
                                        </h5>
                                        <p class="text-muted">Review all information before submission</p>
                                    </div>
                                    
                                    <!-- Summary Cards -->
                                    <div class="col-md-12">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">
                                                    <i class="las la-user-circle mr-2"></i> Personal Information Summary
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Full Name:</label>
                                                            <p class="form-control-static" id="reviewFullName">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Date of Birth:</label>
                                                            <p class="form-control-static" id="reviewDOB">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Gender:</label>
                                                            <p class="form-control-static" id="reviewGender">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Contact:</label>
                                                            <p class="form-control-static" id="reviewContact">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nationality:</label>
                                                            <p class="form-control-static" id="reviewNationality">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Religion:</label>
                                                            <p class="form-control-static" id="reviewReligion">-</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">
                                                    <i class="las la-users mr-2"></i> Guardian Information Summary
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Father's Name:</label>
                                                            <p class="form-control-static" id="reviewFatherName">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Father's Phone:</label>
                                                            <p class="form-control-static" id="reviewFatherPhone">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Mother's Name:</label>
                                                            <p class="form-control-static" id="reviewMotherName">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Mother's Phone:</label>
                                                            <p class="form-control-static" id="reviewMotherPhone">-</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">
                                                    <i class="las la-graduation-cap mr-2"></i> Academic Information Summary
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Academic Year:</label>
                                                            <p class="form-control-static" id="reviewAcademicYear">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Class & Section:</label>
                                                            <p class="form-control-static" id="reviewClassSection">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Admission Date:</label>
                                                            <p class="form-control-static" id="reviewAdmissionDate">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Status:</label>
                                                            <p class="form-control-static" id="reviewStatus">-</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Terms & Conditions -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-title">Terms & Conditions</h6>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" 
                                                               id="termsConditions" name="terms_conditions" required>
                                                        <label class="custom-control-label" for="termsConditions">
                                                            I confirm that all information provided is accurate and complete. 
                                                            I agree to abide by the school rules and regulations.
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox mt-3">
                                                        <input type="checkbox" class="custom-control-input" 
                                                               id="feeAgreement" name="fee_agreement" required>
                                                        <label class="custom-control-label" for="feeAgreement">
                                                            I agree to pay all fees as per school fee structure and payment schedule.
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary prev-step" data-prev="step3">
                                            <i class="las la-arrow-left mr-2"></i> Previous
                                        </button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="las la-check-circle mr-2"></i> Submit Registration
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .registration-progress {
            margin-bottom: 30px;
        }
        
        .progress-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
        }
        
        .progress-steps::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #e9ecef;
            z-index: 1;
        }
        
        .step {
            text-align: center;
            position: relative;
            z-index: 2;
            flex: 1;
        }
        
        .step-number {
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            background-color: #e9ecef;
            color: #6c757d;
            margin: 0 auto 10px;
            font-weight: bold;
        }
        
        .step.active .step-number {
            background-color: #007bff;
            color: white;
        }
        
        .step-label {
            font-size: 12px;
            color: #6c757d;
        }
        
        .step.active .step-label {
            color: #007bff;
            font-weight: bold;
        }
        
        .registration-step {
            display: none;
        }
        
        .registration-step.active {
            display: block;
        }
        
        .form-control-static {
            min-height: 34px;
            padding-top: 7px;
            padding-bottom: 7px;
            margin-bottom: 0;
            border-bottom: 1px solid #e9ecef;
        }
    </style>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Multi-step Form Script -->
    <script>
        $(document).ready(function() {
            // Initialize first step
            $('.registration-step').first().addClass('active');
            
            // Load sections when class is selected
            $('select[name="class_id"]').change(function() {
                var classId = $(this).val();
                var sectionSelect = $('#sectionSelect');
                
                if (classId) {
                    sectionSelect.html('<option value="">Loading sections...</option>');
                    
                    $.ajax({
                        url: '{{ route("get.sections.by.class") }}',
                        type: 'GET',
                        data: { class_id: classId },
                        success: function(response) {
                            if (response.success && response.sections.length > 0) {
                                sectionSelect.html('<option value="">Select Section</option>');
                                $.each(response.sections, function(index, section) {
                                    sectionSelect.append('<option value="' + section.id + '">' + section.name + 
                                        (section.code ? ' (' + section.code + ')' : '') + 
                                        (section.capacity ? ' - Capacity: ' + section.capacity : '') + '</option>');
                                });
                            } else {
                                sectionSelect.html('<option value="">No sections available</option>');
                            }
                        },
                        error: function() {
                            sectionSelect.html('<option value="">Error loading sections</option>');
                        }
                    });
                } else {
                    sectionSelect.html('<option value="">Select Class First</option>');
                }
            });
            
            // Next step button
            $('.next-step').click(function() {
                var currentStep = $(this).closest('.registration-step');
                var nextStepId = $(this).data('next');
                
                // Validate current step before proceeding
                if (validateStep(currentStep.attr('id'))) {
                    currentStep.removeClass('active');
                    $('#' + nextStepId).addClass('active');
                    updateProgress(nextStepId);
                    updateReviewSummary();
                }
            });
            
            // Previous step button
            $('.prev-step').click(function() {
                var currentStep = $(this).closest('.registration-step');
                var prevStepId = $(this).data('prev');
                
                currentStep.removeClass('active');
                $('#' + prevStepId).addClass('active');
                updateProgress(prevStepId);
            });
            
            // Update progress bar
            function updateProgress(stepId) {
                $('.step').removeClass('active');
                var stepNumber = stepId.replace('step', '');
                $('.step').each(function(index) {
                    if (index < stepNumber) {
                        $(this).addClass('active');
                    }
                });
            }
            
            // Validate step
            function validateStep(stepId) {
                var isValid = true;
                var step = $('#' + stepId);
                
                // Check required fields
                step.find('input[required], select[required], textarea[required]').each(function() {
                    if (!$(this).val()) {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                
                if (!isValid) {
                    alert('Please fill all required fields in this section.');
                }
                
                return isValid;
            }
            
            // Update review summary
            function updateReviewSummary() {
                // Personal Information
                var firstName = $('input[name="first_name"]').val();
                var lastName = $('input[name="last_name"]').val();
                $('#reviewFullName').text(firstName + ' ' + lastName);
                $('#reviewDOB').text($('input[name="date_of_birth"]').val());
                $('#reviewGender').text($('select[name="gender"] option:selected').text());
                $('#reviewContact').text($('input[name="phone"]').val());
                $('#reviewNationality').text($('select[name="nationality"] option:selected').text());
                $('#reviewReligion').text($('select[name="religion"] option:selected').text());
                
                // Guardian Information
                $('#reviewFatherName').text($('input[name="father_name"]').val());
                $('#reviewFatherPhone').text($('input[name="father_phone"]').val());
                $('#reviewMotherName').text($('input[name="mother_name"]').val() || 'Not Provided');
                $('#reviewMotherPhone').text($('input[name="mother_phone"]').val() || 'Not Provided');
                
                // Academic Information
                var academicYear = $('select[name="academic_year_id"] option:selected').text();
                var className = $('select[name="class_id"] option:selected').text();
                var sectionName = $('#sectionSelect option:selected').text();
                $('#reviewAcademicYear').text(academicYear);
                $('#reviewClassSection').text(className + ' - ' + (sectionName || 'No Section'));
                $('#reviewAdmissionDate').text($('input[name="admission_date"]').val());
                $('#reviewStatus').text($('select[name="status"] option:selected').text());
            }
            
            // File input preview
            $('#studentPhoto').change(function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
                
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#photoPreview').html(
                            '<img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 150px;">'
                        );
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            
            // Trigger initial updates
            updateProgress('step1');
            
            // Trigger class change to load sections if class is pre-selected
            if ($('select[name="class_id"]').val()) {
                $('select[name="class_id"]').trigger('change');
            }
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
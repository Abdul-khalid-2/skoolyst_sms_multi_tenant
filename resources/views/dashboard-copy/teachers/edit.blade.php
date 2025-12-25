<!-- resources/views/dashboard/teachers/edit.blade.php -->
<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
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
        
        .qualification-row {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }
        
        .teacher-photo {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #dee2e6;
        }
        
        .document-status {
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .status-verified {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .profile-header {
            background: linear-gradient(135deg, #007bff, #6610f2);
            border-radius: 10px;
            padding: 20px;
            color: white;
            margin-bottom: 20px;
        }
    </style>
    @endpush

    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Edit Teacher Information</h4>
                            <p class="mb-0">Update teacher profile and information</p>
                        </div>
                        <a href="{{ route('teachers.index') }}" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Back to Teachers
                        </a>
                    </div>
                    <div class="card-body">
                        <!-- Teacher Profile Header -->
                        <div class="profile-header">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=fff&color=007bff&size=150" 
                                         class="teacher-photo" alt="Sarah Johnson">
                                </div>
                                <div class="col-md-8">
                                    <h3 class="text-white mb-1">Ms. Sarah Johnson</h3>
                                    <p class="text-white mb-1">Senior English Teacher | Department of English</p>
                                    <p class="text-white mb-0">
                                        <i class="las la-id-badge mr-2"></i> Employee ID: TEA-2412-001
                                        <span class="mx-3">|</span>
                                        <i class="las la-calendar-alt mr-2"></i> Joined: 15 Aug 2022
                                    </p>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span class="badge badge-success">Active</span>
                                </div>
                            </div>
                        </div>
                        
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
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
                                                <div class="step-label">Professional Info</div>
                                            </div>
                                            <div class="step">
                                                <div class="step-number">3</div>
                                                <div class="step-label">Qualifications</div>
                                            </div>
                                            <div class="step">
                                                <div class="step-number">4</div>
                                                <div class="step-label">Documents</div>
                                            </div>
                                            <div class="step">
                                                <div class="step-number">5</div>
                                                <div class="step-label">Review</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                            <input type="text" name="first_name" class="form-control" 
                                                   value="Sarah" placeholder="Enter first name" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name *</label>
                                            <input type="text" name="last_name" class="form-control" 
                                                   value="Johnson" placeholder="Enter last name" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth *</label>
                                            <input type="date" name="date_of_birth" class="form-control" 
                                                   value="1990-05-15" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender *</label>
                                            <select name="gender" class="form-control" required>
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female" selected>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nationality</label>
                                            <select name="nationality" class="form-control">
                                                <option value="">Select Nationality</option>
                                                <option value="pakistani" selected>Pakistani</option>
                                                <option value="indian">Indian</option>
                                                <option value="bangladeshi">Bangladeshi</option>
                                                <option value="sri_lankan">Sri Lankan</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Religion</label>
                                            <select name="religion" class="form-control">
                                                <option value="">Select Religion</option>
                                                <option value="islam" selected>Islam</option>
                                                <option value="christianity">Christianity</option>
                                                <option value="hinduism">Hinduism</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Marital Status</label>
                                            <select name="marital_status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="single" selected>Single</option>
                                                <option value="married">Married</option>
                                                <option value="divorced">Divorced</option>
                                                <option value="widowed">Widowed</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Blood Group</label>
                                            <select name="blood_group" class="form-control">
                                                <option value="">Unknown</option>
                                                <option value="a+">A+</option>
                                                <option value="a-">A-</option>
                                                <option value="b+">B+</option>
                                                <option value="b-" selected>B-</option>
                                                <option value="ab+">AB+</option>
                                                <option value="ab-">AB-</option>
                                                <option value="o+">O+</option>
                                                <option value="o-">O-</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Current Address *</label>
                                            <textarea name="current_address" class="form-control" rows="3" 
                                                      placeholder="Enter current address" required>House No. 123, Street 5, Gulberg, Lahore</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address *</label>
                                            <input type="email" name="email" class="form-control" 
                                                   value="sarah.johnson@school.edu.pk" placeholder="teacher@example.com" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number *</label>
                                            <input type="text" name="phone" class="form-control" 
                                                   value="+92 300 1234567" placeholder="+92 300 1234567" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Emergency Contact Name *</label>
                                            <input type="text" name="emergency_contact_name" class="form-control" 
                                                   value="Mr. Robert Johnson" placeholder="Emergency contact person" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Emergency Contact Phone *</label>
                                            <input type="text" name="emergency_contact_phone" class="form-control" 
                                                   value="+92 300 9876543" placeholder="+92 300 9876543" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Teacher Photo</label>
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=fff&color=007bff&size=150" 
                                                     class="teacher-photo mr-4" alt="Current Photo" id="currentPhoto">
                                                <div class="flex-grow-1">
                                                    <div class="custom-file">
                                                        <input type="file" name="photo" class="custom-file-input" 
                                                               id="teacherPhoto" accept="image/*">
                                                        <label class="custom-file-label" for="teacherPhoto">Choose new photo</label>
                                                    </div>
                                                    <small class="form-text text-muted">Leave empty to keep current photo</small>
                                                    <div id="photoPreview" class="mt-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-primary next-step" data-next="step2">
                                            Next: Professional Information <i class="las la-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Professional Information -->
                            <div class="registration-step" id="step2">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="las la-briefcase mr-2"></i> Professional Information
                                        </h5>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Employee ID</label>
                                            <input type="text" name="employee_id" class="form-control" 
                                                   value="TEA-2412-001" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Joining Date *</label>
                                            <input type="date" name="joining_date" class="form-control" 
                                                   value="2022-08-15" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Designation *</label>
                                            <select name="designation" class="form-control" required>
                                                <option value="">Select Designation</option>
                                                <option value="principal">Principal</option>
                                                <option value="vice-principal">Vice Principal</option>
                                                <option value="senior-teacher" selected>Senior Teacher</option>
                                                <option value="teacher">Teacher</option>
                                                <option value="assistant-teacher">Assistant Teacher</option>
                                                <option value="trainee">Trainee Teacher</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Department *</label>
                                            <select name="department" class="form-control" required>
                                                <option value="">Select Department</option>
                                                <option value="science">Science</option>
                                                <option value="arts">Arts</option>
                                                <option value="commerce">Commerce</option>
                                                <option value="computer">Computer Science</option>
                                                <option value="mathematics">Mathematics</option>
                                                <option value="english" selected>English</option>
                                                <option value="urdu">Urdu</option>
                                                <option value="islamiat">Islamiat</option>
                                                <option value="social-studies">Social Studies</option>
                                                <option value="physical-education">Physical Education</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Employment Type *</label>
                                            <select name="employment_type" class="form-control" required>
                                                <option value="">Select Type</option>
                                                <option value="permanent" selected>Permanent</option>
                                                <option value="contract">Contract</option>
                                                <option value="part-time">Part Time</option>
                                                <option value="visiting">Visiting Faculty</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Salary Scale/Grade</label>
                                            <select name="salary_grade" class="form-control">
                                                <option value="">Select Grade</option>
                                                <option value="b-ps1">BPS-1 to 5</option>
                                                <option value="b-ps6">BPS-6 to 10</option>
                                                <option value="b-ps11">BPS-11 to 15</option>
                                                <option value="b-ps16" selected>BPS-16 to 20</option>
                                                <option value="contractual">Contractual</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Basic Salary *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">PKR</span>
                                                </div>
                                                <input type="number" name="basic_salary" class="form-control" 
                                                       value="75000" placeholder="Basic monthly salary" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bank Account Number</label>
                                            <input type="text" name="bank_account" class="form-control" 
                                                   value="12345678901234" placeholder="For salary transfer">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bank Name</label>
                                            <input type="text" name="bank_name" class="form-control" 
                                                   value="HBL" placeholder="Bank name">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status *</label>
                                            <select name="status" class="form-control" required>
                                                <option value="active" selected>Active</option>
                                                <option value="probation">Probation</option>
                                                <option value="on-leave">On Leave</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Teaching Subjects -->
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-book mr-2"></i> Teaching Subjects (Currently Assigned)
                                        </h6>
                                        <div class="row">
                                            @php
                                                $currentSubjects = ['english', 'literature', 'creative-writing'];
                                            @endphp
                                            @foreach(['english', 'urdu', 'mathematics', 'science', 'computer', 'islamiat', 'social-studies', 'physics', 'chemistry', 'biology', 'literature', 'creative-writing'] as $subject)
                                            <div class="col-md-4 col-sm-6 mb-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" 
                                                           name="subjects[]" value="{{ $subject }}" 
                                                           id="subject_{{ $subject }}"
                                                           {{ in_array($subject, $currentSubjects) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="subject_{{ $subject }}">
                                                        {{ ucfirst(str_replace('-', ' ', $subject)) }}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="col-md-12 mt-2">
                                                <input type="text" name="other_subjects" class="form-control" 
                                                       placeholder="Add other subjects (comma separated)">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Class Teacher Assignment -->
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-users mr-2"></i> Class Teacher Assignment
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Assign as Class Teacher</label>
                                                    <select name="class_teacher_assigned" class="form-control">
                                                        <option value="">Not Assigned</option>
                                                        <optgroup label="Pre-Primary">
                                                            <option value="playgroup">Play Group</option>
                                                            <option value="nursery">Nursery</option>
                                                            <option value="kg">Kindergarten (KG)</option>
                                                        </optgroup>
                                                        <optgroup label="Primary (Class 1-5)">
                                                            <option value="class1-a">Class 1 - Section A</option>
                                                            <option value="class1-b">Class 1 - Section B</option>
                                                            <option value="class2-a">Class 2 - Section A</option>
                                                            <option value="class2-b">Class 2 - Section B</option>
                                                            <option value="class3-a">Class 3 - Section A</option>
                                                            <option value="class3-b">Class 3 - Section B</option>
                                                            <option value="class4-a" selected>Class 4 - Section A</option>
                                                            <option value="class4-b">Class 4 - Section B</option>
                                                            <option value="class5-a">Class 5 - Section A</option>
                                                            <option value="class5-b">Class 5 - Section B</option>
                                                        </optgroup>
                                                        <optgroup label="Middle (Class 6-8)">
                                                            <option value="class6-a">Class 6 - Section A</option>
                                                            <option value="class6-b">Class 6 - Section B</option>
                                                            <option value="class7-a">Class 7 - Section A</option>
                                                            <option value="class7-b">Class 7 - Section B</option>
                                                            <option value="class8-a">Class 8 - Section A</option>
                                                            <option value="class8-b">Class 8 - Section B</option>
                                                        </optgroup>
                                                        <optgroup label="Secondary (Class 9-10)">
                                                            <option value="class9-a">Class 9 - Section A</option>
                                                            <option value="class9-b">Class 9 - Section B</option>
                                                            <option value="class10-a">Class 10 - Section A</option>
                                                            <option value="class10-b">Class 10 - Section B</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Class Teacher Since</label>
                                                    <input type="date" name="class_teacher_since" class="form-control" 
                                                           value="2023-08-01">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 mt-4">
                                        <div class="form-group">
                                            <label>Work Experience (in years)</label>
                                            <input type="number" name="work_experience" class="form-control" 
                                                   value="8" placeholder="Total years of teaching experience" min="0" max="50">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary prev-step" data-prev="step1">
                                            <i class="las la-arrow-left mr-2"></i> Previous
                                        </button>
                                        <button type="button" class="btn btn-primary next-step" data-next="step3">
                                            Next: Qualifications <i class="las la-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Qualifications -->
                            <div class="registration-step" id="step3">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="las la-graduation-cap mr-2"></i> Educational Qualifications
                                        </h5>
                                        <p class="text-muted">Update teacher's educational qualifications</p>
                                    </div>
                                    
                                    <!-- Qualifications Container -->
                                    <div class="col-md-12" id="qualifications-container">
                                        <!-- Qualification 1 -->
                                        <div class="qualification-row">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Degree/Qualification *</label>
                                                        <select name="qualifications[0][degree]" class="form-control" required>
                                                            <option value="">Select Degree</option>
                                                            <option value="matric">Matric (SSC)</option>
                                                            <option value="intermediate">Intermediate (HSSC)</option>
                                                            <option value="bachelors" selected>Bachelor's Degree</option>
                                                            <option value="masters">Master's Degree</option>
                                                            <option value="m-phil">M.Phil</option>
                                                            <option value="phd">PhD</option>
                                                            <option value="b-ed">B.Ed</option>
                                                            <option value="m-ed">M.Ed</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Subject/Field *</label>
                                                        <input type="text" name="qualifications[0][subject]" 
                                                               class="form-control" value="English Literature" 
                                                               placeholder="e.g., Mathematics, English" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Institution *</label>
                                                        <input type="text" name="qualifications[0][institution]" 
                                                               class="form-control" value="University of Punjab" 
                                                               placeholder="University/College" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Year of Passing *</label>
                                                        <input type="number" name="qualifications[0][year]" 
                                                               class="form-control" value="2012" 
                                                               placeholder="2020" min="1900" max="2024" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Grade/Division</label>
                                                        <input type="text" name="qualifications[0][grade]" 
                                                               class="form-control" value="First Division" 
                                                               placeholder="A, First Division, 3.5/4.0">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Percentage/CGPA</label>
                                                        <input type="text" name="qualifications[0][percentage]" 
                                                               class="form-control" value="78%" 
                                                               placeholder="85%, 3.5">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Document</label>
                                                        <div class="d-flex align-items-center">
                                                            <span class="document-status status-verified mr-2">Verified</span>
                                                            <div class="custom-file">
                                                                <input type="file" name="qualifications[0][document]" 
                                                                       class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png">
                                                                <label class="custom-file-label">Update file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Qualification 2 -->
                                        <div class="qualification-row">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Degree/Qualification *</label>
                                                        <select name="qualifications[1][degree]" class="form-control" required>
                                                            <option value="">Select Degree</option>
                                                            <option value="matric">Matric (SSC)</option>
                                                            <option value="intermediate">Intermediate (HSSC)</option>
                                                            <option value="bachelors">Bachelor's Degree</option>
                                                            <option value="masters" selected>Master's Degree</option>
                                                            <option value="m-phil">M.Phil</option>
                                                            <option value="phd">PhD</option>
                                                            <option value="b-ed">B.Ed</option>
                                                            <option value="m-ed">M.Ed</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Subject/Field *</label>
                                                        <input type="text" name="qualifications[1][subject]" 
                                                               class="form-control" value="English Literature" 
                                                               placeholder="e.g., Mathematics, English" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Institution *</label>
                                                        <input type="text" name="qualifications[1][institution]" 
                                                               class="form-control" value="University of Punjab" 
                                                               placeholder="University/College" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Year of Passing *</label>
                                                        <input type="number" name="qualifications[1][year]" 
                                                               class="form-control" value="2014" 
                                                               placeholder="2020" min="1900" max="2024" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Grade/Division</label>
                                                        <input type="text" name="qualifications[1][grade]" 
                                                               class="form-control" value="First Division" 
                                                               placeholder="A, First Division, 3.5/4.0">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Percentage/CGPA</label>
                                                        <input type="text" name="qualifications[1][percentage]" 
                                                               class="form-control" value="82%" 
                                                               placeholder="85%, 3.5">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Document</label>
                                                        <div class="d-flex align-items-center">
                                                            <span class="document-status status-verified mr-2">Verified</span>
                                                            <div class="custom-file">
                                                                <input type="file" name="qualifications[1][document]" 
                                                                       class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png">
                                                                <label class="custom-file-label">Update file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Add More Qualifications Button -->
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-outline-primary" id="add-qualification">
                                            <i class="las la-plus mr-2"></i> Add Another Qualification
                                        </button>
                                    </div>
                                    
                                    <!-- Professional Certifications -->
                                    <div class="col-md-12 mt-5">
                                        <h6 class="mb-3 text-primary">
                                            <i class="las la-certificate mr-2"></i> Professional Certifications
                                        </h6>
                                    </div>
                                    
                                    <div class="col-md-12" id="certifications-container">
                                        <!-- Certification 1 -->
                                        <div class="qualification-row">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Certification Name</label>
                                                        <input type="text" name="certifications[0][name]" 
                                                               class="form-control" value="B.Ed" 
                                                               placeholder="e.g., B.Ed, M.Ed, TEFL">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Issuing Authority</label>
                                                        <input type="text" name="certifications[0][authority]" 
                                                               class="form-control" value="Allama Iqbal Open University" 
                                                               placeholder="Issuing organization">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Year Obtained</label>
                                                        <input type="number" name="certifications[0][year]" 
                                                               class="form-control" value="2015" 
                                                               placeholder="2022" min="1900" max="2024">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn btn-sm btn-danger remove-certification" 
                                                                style="margin-top: 8px;">
                                                            <i class="las la-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Certification 2 -->
                                        <div class="qualification-row">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Certification Name</label>
                                                        <input type="text" name="certifications[1][name]" 
                                                               class="form-control" value="TEFL" 
                                                               placeholder="e.g., B.Ed, M.Ed, TEFL">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Issuing Authority</label>
                                                        <input type="text" name="certifications[1][authority]" 
                                                               class="form-control" value="Cambridge University" 
                                                               placeholder="Issuing organization">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Year Obtained</label>
                                                        <input type="number" name="certifications[1][year]" 
                                                               class="form-control" value="2018" 
                                                               placeholder="2022" min="1900" max="2024">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn btn-sm btn-danger remove-certification" 
                                                                style="margin-top: 8px;">
                                                            <i class="las la-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Add More Certifications Button -->
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-outline-secondary" id="add-certification">
                                            <i class="las la-plus mr-2"></i> Add Certification
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary prev-step" data-prev="step2">
                                            <i class="las la-arrow-left mr-2"></i> Previous
                                        </button>
                                        <button type="button" class="btn btn-primary next-step" data-next="step4">
                                            Next: Documents <i class="las la-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4: Documents Upload -->
                            <div class="registration-step" id="step4">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="las la-file-upload mr-2"></i> Teacher Documents
                                        </h5>
                                        <p class="text-muted">View and update teacher documents</p>
                                    </div>
                                    
                                    <!-- Document Status Overview -->
                                    <div class="col-md-12 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Document Status</h6>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-3">
                                                                <i class="las la-check-circle text-success fa-2x"></i>
                                                            </div>
                                                            <div>
                                                                <h5 class="mb-0">7</h5>
                                                                <small class="text-muted">Verified</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-3">
                                                                <i class="las la-clock text-warning fa-2x"></i>
                                                            </div>
                                                            <div>
                                                                <h5 class="mb-0">1</h5>
                                                                <small class="text-muted">Pending</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-3">
                                                                <i class="las la-times-circle text-danger fa-2x"></i>
                                                            </div>
                                                            <div>
                                                                <h5 class="mb-0">0</h5>
                                                                <small class="text-muted">Rejected</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-3">
                                                                <i class="las la-file-alt text-info fa-2x"></i>
                                                            </div>
                                                            <div>
                                                                <h5 class="mb-0">8</h5>
                                                                <small class="text-muted">Total</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Document Upload Fields -->
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">CNIC Copy (Front & Back)</h6>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="document-status status-verified">Verified</span>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-eye mr-1"></i> View
                                                    </a>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" name="cnic_copy" class="custom-file-input" 
                                                           id="cnicCopy" accept=".pdf,.jpg,.jpeg,.png">
                                                    <label class="custom-file-label" for="cnicCopy">Update file</label>
                                                </div>
                                                <small class="form-text text-muted">Uploaded on: 10 Aug 2022</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">Teacher Photograph</h6>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="document-status status-verified">Verified</span>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-eye mr-1"></i> View
                                                    </a>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" name="teacher_photo_doc" class="custom-file-input" 
                                                           id="teacherPhotoDoc" accept="image/*">
                                                    <label class="custom-file-label" for="teacherPhotoDoc">Update photo</label>
                                                </div>
                                                <small class="form-text text-muted">Last updated: 05 Dec 2024</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">Educational Certificates</h6>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="document-status status-verified">Verified</span>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-eye mr-1"></i> View (3)
                                                    </a>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" name="educational_certificates[]" class="custom-file-input" 
                                                           id="educationalCertificates" multiple accept=".pdf,.jpg,.jpeg,.png">
                                                    <label class="custom-file-label" for="educationalCertificates">Add/Update files</label>
                                                </div>
                                                <small class="form-text text-muted">Last verified: 15 Aug 2022</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">Experience Certificates</h6>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="document-status status-verified">Verified</span>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-eye mr-1"></i> View (2)
                                                    </a>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" name="experience_certificates[]" class="custom-file-input" 
                                                           id="experienceCertificates" multiple accept=".pdf,.jpg,.jpeg,.png">
                                                    <label class="custom-file-label" for="experienceCertificates">Add/Update files</label>
                                                </div>
                                                <small class="form-text text-muted">Last verified: 15 Aug 2022</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">Police Clearance Certificate</h6>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="document-status status-pending">Pending</span>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-eye mr-1"></i> View
                                                    </a>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" name="police_clearance" class="custom-file-input" 
                                                           id="policeClearance" accept=".pdf,.jpg,.jpeg,.png">
                                                    <label class="custom-file-label" for="policeClearance">Update file</label>
                                                </div>
                                                <small class="form-text text-muted">Expires: 15 Dec 2024</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">Medical Fitness Certificate</h6>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="document-status status-verified">Verified</span>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-eye mr-1"></i> View
                                                    </a>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" name="medical_certificate" class="custom-file-input" 
                                                           id="medicalCertificate" accept=".pdf,.jpg,.jpeg,.png">
                                                    <label class="custom-file-label" for="medicalCertificate">Update file</label>
                                                </div>
                                                <small class="form-text text-muted">Expires: 15 Jun 2025</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">CV/Resume</h6>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="document-status status-verified">Verified</span>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-eye mr-1"></i> View
                                                    </a>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" name="cv" class="custom-file-input" 
                                                           id="cv" accept=".pdf,.doc,.docx">
                                                    <label class="custom-file-label" for="cv">Update CV</label>
                                                </div>
                                                <small class="form-text text-muted">Last updated: 01 Jan 2024</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">Other Documents</h6>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="document-status status-verified">Verified</span>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-eye mr-1"></i> View (1)
                                                    </a>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" name="other_documents[]" class="custom-file-input" 
                                                           id="otherDocuments" multiple accept=".pdf,.jpg,.jpeg,.png">
                                                    <label class="custom-file-label" for="otherDocuments">Add files</label>
                                                </div>
                                                <small class="form-text text-muted">Add any additional documents</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Document Notes -->
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Document Notes</h6>
                                                <textarea name="document_notes" class="form-control" rows="3" 
                                                          placeholder="Add any notes about document updates">Police clearance certificate needs renewal by Dec 2024.</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary prev-step" data-prev="step3">
                                            <i class="las la-arrow-left mr-2"></i> Previous
                                        </button>
                                        <button type="button" class="btn btn-primary next-step" data-next="step5">
                                            Next: Review & Update <i class="las la-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 5: Review & Submit -->
                            <div class="registration-step" id="step5">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="mb-3 text-primary">
                                            <i class="las la-clipboard-check mr-2"></i> Review & Update Changes
                                        </h5>
                                        <p class="text-muted">Review all changes before updating teacher information</p>
                                    </div>
                                    
                                    <!-- Summary Cards -->
                                    <div class="col-md-12">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">
                                                    <i class="las la-user-circle mr-2"></i> Personal Information Changes
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Full Name:</label>
                                                            <p class="form-control-static" id="reviewFullName">Sarah Johnson</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Updated Contact:</label>
                                                            <p class="form-control-static" id="reviewContact">+92 300 1234567</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Emergency Contact:</label>
                                                            <p class="form-control-static" id="reviewEmergencyContact">Mr. Robert Johnson - +92 300 9876543</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Address:</label>
                                                            <p class="form-control-static" id="reviewAddress">House No. 123, Street 5, Gulberg, Lahore</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">
                                                    <i class="las la-briefcase mr-2"></i> Professional Information Changes
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Designation:</label>
                                                            <p class="form-control-static" id="reviewDesignation">Senior Teacher</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Department:</label>
                                                            <p class="form-control-static" id="reviewDepartment">English</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Basic Salary:</label>
                                                            <p class="form-control-static" id="reviewSalary">PKR 75,000</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Class Teacher:</label>
                                                            <p class="form-control-static" id="reviewClassTeacher">Class 4 - Section A</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Teaching Subjects:</label>
                                                            <p class="form-control-static" id="reviewSubjects">English, Literature, Creative Writing</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">
                                                    <i class="las la-file-alt mr-2"></i> Document Updates
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="alert alert-info">
                                                    <i class="las la-info-circle mr-2"></i>
                                                    <strong>Note:</strong> 
                                                    <ul class="mb-0 mt-2">
                                                        <li>Police clearance certificate needs to be renewed</li>
                                                        <li>1 new photo uploaded</li>
                                                        <li>All other documents remain verified</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Update Notes -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-title">Update Notes</h6>
                                                    <textarea name="update_notes" class="form-control" rows="3" 
                                                              placeholder="Add notes about this update (optional)">Updated teacher's contact information and added new photo. Police clearance pending renewal.</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Confirmation -->
                                        <div class="col-md-12 mt-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-title">Confirmation</h6>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" 
                                                               id="confirmUpdate" required>
                                                        <label class="custom-control-label" for="confirmUpdate">
                                                            I confirm that all information updated is accurate and complete. 
                                                            I understand that this will update the teacher's profile immediately.
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary prev-step" data-prev="step4">
                                            <i class="las la-arrow-left mr-2"></i> Previous
                                        </button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="las la-save mr-2"></i> Update Teacher Information
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

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Multi-step Form Script -->
    <script>
        $(document).ready(function() {
            // Initialize first step
            $('.registration-step').first().addClass('active');
            
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
                $('#reviewContact').text($('input[name="phone"]').val());
                $('#reviewEmergencyContact').text($('input[name="emergency_contact_name"]').val() + ' - ' + 
                                                 $('input[name="emergency_contact_phone"]').val());
                $('#reviewAddress').text($('textarea[name="current_address"]').val());
                
                // Professional Information
                $('#reviewDesignation').text($('select[name="designation"] option:selected').text());
                $('#reviewDepartment').text($('select[name="department"] option:selected').text());
                $('#reviewSalary').text('PKR ' + $('input[name="basic_salary"]').val());
                $('#reviewClassTeacher').text($('select[name="class_teacher_assigned"] option:selected').text());
                
                // Teaching Subjects
                var subjects = [];
                $('input[name="subjects[]"]:checked').each(function() {
                    subjects.push($(this).next('label').text());
                });
                $('#reviewSubjects').text(subjects.join(', '));
            }
            
            // File input preview for new photo
            $('#teacherPhoto').change(function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
                
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#photoPreview').html(
                            '<div class="alert alert-info mt-2">' +
                            '<strong>New Photo Preview:</strong><br>' +
                            '<img src="' + e.target.result + '" class="img-thumbnail mt-2" style="max-width: 150px;">' +
                            '</div>'
                        );
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            
            // Add qualification row
            var qualIndex = 2; // Starting from 2 since we already have 2 qualifications
            $('#add-qualification').click(function() {
                var newRow = `
                    <div class="qualification-row">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Degree/Qualification *</label>
                                    <select name="qualifications[${qualIndex}][degree]" class="form-control" required>
                                        <option value="">Select Degree</option>
                                        <option value="matric">Matric (SSC)</option>
                                        <option value="intermediate">Intermediate (HSSC)</option>
                                        <option value="bachelors">Bachelor's Degree</option>
                                        <option value="masters">Master's Degree</option>
                                        <option value="m-phil">M.Phil</option>
                                        <option value="phd">PhD</option>
                                        <option value="b-ed">B.Ed</option>
                                        <option value="m-ed">M.Ed</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Subject/Field *</label>
                                    <input type="text" name="qualifications[${qualIndex}][subject]" 
                                           class="form-control" placeholder="e.g., Mathematics, English" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Institution *</label>
                                    <input type="text" name="qualifications[${qualIndex}][institution]" 
                                           class="form-control" placeholder="University/College" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Year of Passing *</label>
                                    <input type="number" name="qualifications[${qualIndex}][year]" 
                                           class="form-control" placeholder="2020" min="1900" max="2024" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Grade/Division</label>
                                    <input type="text" name="qualifications[${qualIndex}][grade]" 
                                           class="form-control" placeholder="A, First Division, 3.5/4.0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Percentage/CGPA</label>
                                    <input type="text" name="qualifications[${qualIndex}][percentage]" 
                                           class="form-control" placeholder="85%, 3.5">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Document</label>
                                    <div class="custom-file">
                                        <input type="file" name="qualifications[${qualIndex}][document]" 
                                               class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $('#qualifications-container').append(newRow);
                qualIndex++;
            });
            
            // Add certification row
            var certIndex = 2; // Starting from 2 since we already have 2 certifications
            $('#add-certification').click(function() {
                var newRow = `
                    <div class="qualification-row">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Certification Name</label>
                                    <input type="text" name="certifications[${certIndex}][name]" 
                                           class="form-control" placeholder="e.g., B.Ed, M.Ed, TEFL">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Issuing Authority</label>
                                    <input type="text" name="certifications[${certIndex}][authority]" 
                                           class="form-control" placeholder="Issuing organization">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Year Obtained</label>
                                    <input type="number" name="certifications[${certIndex}][year]" 
                                           class="form-control" placeholder="2022" min="1900" max="2024">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-sm btn-danger remove-certification" 
                                            style="margin-top: 8px;">
                                        <i class="las la-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $('#certifications-container').append(newRow);
                certIndex++;
            });
            
            // Remove certification row
            $(document).on('click', '.remove-certification', function() {
                if ($('#certifications-container .qualification-row').length > 1) {
                    $(this).closest('.qualification-row').remove();
                }
            });
            
            // File input label update for all custom file inputs
            $(document).on('change', '.custom-file-input', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });
            
            // Form submission
            $('form').submit(function(e) {
                e.preventDefault();
                
                if ($('#confirmUpdate').is(':checked')) {
                    // Show loading
                    const submitBtn = $(this).find('button[type="submit"]');
                    const originalText = submitBtn.html();
                    submitBtn.html('<i class="las la-spinner la-spin mr-2"></i>Updating...').prop('disabled', true);
                    
                    // Simulate API call
                    setTimeout(function() {
                        alert('Teacher information updated successfully!');
                        window.location.href = "{{ route('teachers.index') }}";
                    }, 2000);
                } else {
                    alert('Please confirm the update by checking the confirmation box.');
                }
            });
            
            // Trigger initial updates
            updateProgress('step1');
            updateReviewSummary();
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
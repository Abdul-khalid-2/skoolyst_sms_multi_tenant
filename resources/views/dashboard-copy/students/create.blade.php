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
                        <a href="#" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Back to Students
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
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
                                                   placeholder="Enter first name" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name *</label>
                                            <input type="text" name="last_name" class="form-control" 
                                                   placeholder="Enter last name" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth *</label>
                                            <input type="date" name="date_of_birth" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender *</label>
                                            <select name="gender" class="form-control" required>
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
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
                                                <option value="sikhism">Sikhism</option>
                                                <option value="other">Other</option>
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
                                                <option value="b-">B-</option>
                                                <option value="ab+">AB+</option>
                                                <option value="ab-">AB-</option>
                                                <option value="o+">O+</option>
                                                <option value="o-">O-</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Place of Birth</label>
                                            <input type="text" name="place_of_birth" class="form-control" 
                                                   placeholder="City of birth">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Current Address *</label>
                                            <textarea name="current_address" class="form-control" rows="3" 
                                                      placeholder="Enter current address" required></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Permanent Address</label>
                                            <textarea name="permanent_address" class="form-control" rows="2" 
                                                      placeholder="Enter permanent address (if different)"></textarea>
                                            <div class="custom-control custom-checkbox mt-2">
                                                <input type="checkbox" class="custom-control-input" id="sameAsCurrent">
                                                <label class="custom-control-label" for="sameAsCurrent">Same as current address</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control" 
                                                   placeholder="student@example.com">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone" class="form-control" 
                                                   placeholder="+92 300 1234567">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Student Photo</label>
                                            <div class="custom-file">
                                                <input type="file" name="photo" class="custom-file-input" 
                                                       id="studentPhoto" accept="image/*">
                                                <label class="custom-file-label" for="studentPhoto">Choose file</label>
                                            </div>
                                            <small class="form-text text-muted">Recommended: Passport size photo (300x300 px)</small>
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
                                            <input type="text" name="father_name" class="form-control" 
                                                   placeholder="Enter father's full name" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father's CNIC</label>
                                            <input type="text" name="father_cnic" class="form-control" 
                                                   placeholder="XXXXX-XXXXXXX-X">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father's Occupation</label>
                                            <input type="text" name="father_occupation" class="form-control" 
                                                   placeholder="e.g., Business, Service, Doctor">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father's Monthly Income</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">PKR</span>
                                                </div>
                                                <input type="number" name="father_income" class="form-control" 
                                                       placeholder="Approximate monthly income">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father's Email</label>
                                            <input type="email" name="father_email" class="form-control" 
                                                   placeholder="father@example.com">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father's Phone *</label>
                                            <input type="text" name="father_phone" class="form-control" 
                                                   placeholder="+92 300 1234567" required>
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
                                            <label>Mother's Name *</label>
                                            <input type="text" name="mother_name" class="form-control" 
                                                   placeholder="Enter mother's full name" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mother's CNIC</label>
                                            <input type="text" name="mother_cnic" class="form-control" 
                                                   placeholder="XXXXX-XXXXXXX-X">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mother's Occupation</label>
                                            <input type="text" name="mother_occupation" class="form-control" 
                                                   placeholder="e.g., Housewife, Teacher, Doctor">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mother's Email</label>
                                            <input type="email" name="mother_email" class="form-control" 
                                                   placeholder="mother@example.com">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mother's Phone</label>
                                            <input type="text" name="mother_phone" class="form-control" 
                                                   placeholder="+92 300 2345678">
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
                                                   placeholder="Name of emergency contact">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Emergency Contact Relation</label>
                                            <input type="text" name="emergency_relation" class="form-control" 
                                                   placeholder="e.g., Uncle, Aunt, Grandfather">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Emergency Contact Phone *</label>
                                            <input type="text" name="emergency_phone" class="form-control" 
                                                   placeholder="+92 300 3456789" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Emergency Contact Address</label>
                                            <input type="text" name="emergency_address" class="form-control" 
                                                   placeholder="Address of emergency contact">
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
                                            <select name="academic_year_id" class="form-control" required>
                                                <option value="">Select Academic Year</option>
                                                <option value="2024-2025" selected>2024-2025</option>
                                                <option value="2023-2024">2023-2024</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Admission Date *</label>
                                            <input type="date" name="admission_date" class="form-control" 
                                                   value="{{ date('Y-m-d') }}" required>
                                        </div>
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
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Section *</label>
                                            <select name="section_id" class="form-control" required>
                                                <option value="">Select Section</option>
                                                <option value="A" selected>Section A</option>
                                                <option value="B">Section B</option>
                                                <option value="C">Section C</option>
                                                <option value="D">Section D</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Roll Number</label>
                                            <input type="text" name="roll_number" class="form-control" 
                                                   placeholder="Auto-generated if left blank">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Admission Number</label>
                                            <input type="text" name="admission_number" class="form-control" 
                                                   placeholder="Auto-generated" readonly>
                                        </div>
                                    </div>
                                    
                                    <!-- Previous School Information -->
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-school mr-2"></i> Previous School Information (If Applicable)
                                        </h6>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Previous School Name</label>
                                            <input type="text" name="previous_school" class="form-control" 
                                                   placeholder="Name of previous school">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Previous Class</label>
                                            <input type="text" name="previous_class" class="form-control" 
                                                   placeholder="Class studied in previous school">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Transfer Certificate No</label>
                                            <input type="text" name="transfer_certificate" class="form-control" 
                                                   placeholder="TC number if applicable">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Leaving Date</label>
                                            <input type="date" name="leaving_date" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <!-- Special Information -->
                                    <div class="col-md-12 mt-4">
                                        <h6 class="mb-3 border-bottom pb-2">
                                            <i class="las la-info-circle mr-2"></i> Special Information
                                        </h6>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Medical Conditions/Allergies</label>
                                            <textarea name="medical_conditions" class="form-control" rows="2" 
                                                      placeholder="Any medical conditions, allergies, or special needs"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Remarks/Additional Information</label>
                                            <textarea name="remarks" class="form-control" rows="2" 
                                                      placeholder="Any additional information"></textarea>
                                        </div>
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
                                            <i class="las la-file-upload mr-2"></i> Documents Upload
                                        </h5>
                                        <p class="text-muted">Upload required documents for student registration</p>
                                    </div>
                                    
                                    <!-- Required Documents -->
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <h6><i class="las la-info-circle mr-2"></i> Required Documents</h6>
                                            <ul class="mb-0">
                                                <li>Birth Certificate (Mandatory)</li>
                                                <li>Father's CNIC Copy (Mandatory)</li>
                                                <li>Student Photograph (Mandatory)</li>
                                                <li>Previous School Certificate (If applicable)</li>
                                                <li>Medical Certificate (If required)</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <!-- Document Upload Fields -->
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">Birth Certificate *</h6>
                                                <div class="custom-file">
                                                    <input type="file" name="birth_certificate" class="custom-file-input" 
                                                           id="birthCertificate" accept=".pdf,.jpg,.jpeg,.png">
                                                    <label class="custom-file-label" for="birthCertificate">Choose file</label>
                                                </div>
                                                <small class="form-text text-muted">Upload scanned copy (PDF, JPG, PNG)</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">Father's CNIC Copy *</h6>
                                                <div class="custom-file">
                                                    <input type="file" name="father_cnic_copy" class="custom-file-input" 
                                                           id="fatherCnic" accept=".pdf,.jpg,.jpeg,.png">
                                                    <label class="custom-file-label" for="fatherCnic">Choose file</label>
                                                </div>
                                                <small class="form-text text-muted">Front & Back side (PDF, JPG, PNG)</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">Student Photograph *</h6>
                                                <div class="custom-file">
                                                    <input type="file" name="student_photo" class="custom-file-input" 
                                                           id="studentPhotoDoc" accept="image/*">
                                                    <label class="custom-file-label" for="studentPhotoDoc">Choose file</label>
                                                </div>
                                                <small class="form-text text-muted">Passport size photo (300x300 px)</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">Previous School Certificate</h6>
                                                <div class="custom-file">
                                                    <input type="file" name="previous_certificate" class="custom-file-input" 
                                                           id="previousCertificate" accept=".pdf,.jpg,.jpeg,.png">
                                                    <label class="custom-file-label" for="previousCertificate">Choose file</label>
                                                </div>
                                                <small class="form-text text-muted">Transfer/Migration Certificate</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">Medical Certificate</h6>
                                                <div class="custom-file">
                                                    <input type="file" name="medical_certificate" class="custom-file-input" 
                                                           id="medicalCertificate" accept=".pdf,.jpg,.jpeg,.png">
                                                    <label class="custom-file-label" for="medicalCertificate">Choose file</label>
                                                </div>
                                                <small class="form-text text-muted">If student has medical conditions</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">Other Documents</h6>
                                                <div class="custom-file">
                                                    <input type="file" name="other_documents[]" class="custom-file-input" 
                                                           id="otherDocuments" multiple accept=".pdf,.jpg,.jpeg,.png">
                                                    <label class="custom-file-label" for="otherDocuments">Choose files</label>
                                                </div>
                                                <small class="form-text text-muted">Any other relevant documents</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Document Status -->
                                    <div class="col-md-12 mt-4">
                                        <div class="alert alert-warning">
                                            <h6><i class="las la-exclamation-triangle mr-2"></i> Important</h6>
                                            <p class="mb-0">
                                                Student registration will be marked as "Pending" until all mandatory documents are verified. 
                                                Admission will be confirmed after document verification.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary prev-step" data-prev="step3">
                                            <i class="las la-arrow-left mr-2"></i> Previous
                                        </button>
                                        <button type="button" class="btn btn-primary next-step" data-next="step5">
                                            Next: Review & Submit <i class="las la-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 5: Review & Submit -->
                            <div class="registration-step" id="step5">
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
                                                               id="termsConditions" required>
                                                        <label class="custom-control-label" for="termsConditions">
                                                            I confirm that all information provided is accurate and complete. 
                                                            I agree to abide by the school rules and regulations.
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox mt-3">
                                                        <input type="checkbox" class="custom-control-input" 
                                                               id="feeAgreement">
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
                                        <button type="button" class="btn btn-secondary prev-step" data-prev="step4">
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
    </style>

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
                $('#reviewDOB').text($('input[name="date_of_birth"]').val());
                $('#reviewGender').text($('select[name="gender"]').val());
                $('#reviewContact').text($('input[name="phone"]').val());
                
                // Guardian Information
                $('#reviewFatherName').text($('input[name="father_name"]').val());
                $('#reviewFatherPhone').text($('input[name="father_phone"]').val());
                
                // Academic Information
                var className = $('select[name="class_id"] option:selected').text();
                var sectionName = $('select[name="section_id"] option:selected').text();
                $('#reviewClassSection').text(className + ' - ' + sectionName);
                $('#reviewAdmissionDate').text($('input[name="admission_date"]').val());
            }
            
            // Same address checkbox
            $('#sameAsCurrent').change(function() {
                if ($(this).is(':checked')) {
                    var currentAddress = $('textarea[name="current_address"]').val();
                    $('textarea[name="permanent_address"]').val(currentAddress).prop('disabled', true);
                } else {
                    $('textarea[name="permanent_address"]').prop('disabled', false);
                }
            });
            
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
            
            // Auto-generate admission number
            $('select[name="class_id"]').change(function() {
                var classCode = $(this).val();
                var date = new Date();
                var year = date.getFullYear();
                var randomNum = Math.floor(Math.random() * 1000);
                
                if (classCode) {
                    var admissionNo = 'ADM-' + year + '-' + classCode.toUpperCase() + randomNum;
                    $('input[name="admission_number"]').val(admissionNo);
                }
            });
            
            // Trigger initial updates
            updateProgress('step1');
            $('select[name="class_id"]').trigger('change');
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
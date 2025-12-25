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
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">My Profile</h4>
                <p class="mb-0">Manage your personal information, security and preferences</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-primary">
                    <i class="las la-save mr-2"></i>Save Changes
                </button>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Profile Info -->
            <div class="col-lg-4">
                <!-- Profile Card -->
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xxl mb-4">
                            <img src="https://ui-avatars.com/api/?name=John+Doe&background=007bff&color=fff&size=150" 
                                 class="rounded-circle border" alt="John Doe">
                        </div>
                        <div class="mb-4">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="las la-camera mr-2"></i>Change Photo
                            </button>
                            <button class="btn btn-outline-danger btn-sm ml-2">
                                <i class="las la-trash mr-2"></i>Remove
                            </button>
                        </div>
                        
                        <h5 class="mb-1">John Doe</h5>
                        <p class="text-muted mb-3">Super Administrator</p>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Member Since:</span>
                            <span class="font-weight-bold">15 Jan 2024</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Last Login:</span>
                            <span class="font-weight-bold">2 hours ago</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Status:</span>
                            <span class="badge badge-success">Active</span>
                        </div>
                    </div>
                </div>

                <!-- Security Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Security</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Change Password</h6>
                                    <i class="las la-chevron-right"></i>
                                </div>
                                <p class="mb-1 text-muted small">Update your login password</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Two-Factor Authentication</h6>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="2faToggle">
                                        <label class="custom-control-label" for="2faToggle"></label>
                                    </div>
                                </div>
                                <p class="mb-1 text-muted small">Add extra security to your account</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Login History</h6>
                                    <i class="las la-chevron-right"></i>
                                </div>
                                <p class="mb-1 text-muted small">View recent login activities</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Active Sessions</h6>
                                    <span class="badge badge-primary">2 Devices</span>
                                </div>
                                <p class="mb-1 text-muted small">Manage your active login sessions</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Profile Forms -->
            <div class="col-lg-8">
                <!-- Personal Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="las la-user mr-2"></i>Personal Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name *</label>
                                        <input type="text" class="form-control" value="John" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name *</label>
                                        <input type="text" class="form-control" value="Doe" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address *</label>
                                        <input type="email" class="form-control" value="john.doe@example.com" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" value="+92 300 1234567">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" class="form-control" value="1985-06-15">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control">
                                            <option value="male" selected>Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" rows="3">123 Main Street, Karachi, Pakistan</textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="las la-briefcase mr-2"></i>Professional Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Designation *</label>
                                        <input type="text" class="form-control" value="Super Administrator" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee ID</label>
                                        <input type="text" class="form-control" value="EMP-2024-001" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select class="form-control">
                                            <option value="administration" selected>Administration</option>
                                            <option value="academic">Academic</option>
                                            <option value="finance">Finance</option>
                                            <option value="it">IT Department</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Joining Date</label>
                                        <input type="date" class="form-control" value="2024-01-15">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>About Me</label>
                                        <textarea class="form-control" rows="3">Experienced administrator with 10+ years in educational management. Passionate about technology integration in education.</textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Account Settings -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="las la-cog mr-2"></i>Account Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username *</label>
                                        <input type="text" class="form-control" value="johndoe" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Language</label>
                                        <select class="form-control">
                                            <option value="en" selected>English</option>
                                            <option value="ur">Urdu</option>
                                            <option value="ar">Arabic</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Timezone</label>
                                        <select class="form-control">
                                            <option value="Asia/Karachi" selected>Asia/Karachi (UTC+5)</option>
                                            <option value="UTC">UTC</option>
                                            <option value="America/New_York">America/New_York</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date Format</label>
                                        <select class="form-control">
                                            <option value="d/m/Y">DD/MM/YYYY</option>
                                            <option value="m/d/Y" selected>MM/DD/YYYY</option>
                                            <option value="Y-m-d">YYYY-MM-DD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="emailNotifications" checked>
                                        <label class="custom-control-label" for="emailNotifications">
                                            Email Notifications
                                        </label>
                                        <small class="form-text text-muted">Receive email alerts for important updates</small>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="smsNotifications">
                                        <label class="custom-control-label" for="smsNotifications">
                                            SMS Notifications
                                        </label>
                                        <small class="form-text text-muted">Receive SMS alerts for urgent matters</small>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary mr-2">
                            <i class="las la-save mr-2"></i>Save Changes
                        </button>
                        <button class="btn btn-danger">
                            <i class="las la-redo mr-2"></i>Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
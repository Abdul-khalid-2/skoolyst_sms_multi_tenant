<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .fee-type-card {
            border-left: 4px solid #007bff;
            transition: all 0.3s ease;
        }
        
        .fee-type-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .fee-type-card.mandatory {
            border-left-color: #28a745;
        }
        
        .fee-type-card.optional {
            border-left-color: #ffc107;
        }
        
        .fee-type-card.one-time {
            border-left-color: #dc3545;
        }
        
        .fee-badge {
            font-size: 11px;
            padding: 3px 8px;
        }
        
        .amount-input {
            max-width: 150px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Fee Types Management</h4>
                <p class="mb-0">Define and manage different fee types and structures</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Fees Management</a></li>
                        <li class="breadcrumb-item active">Fee Types</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addFeeTypeModal">
                    <i class="las la-plus mr-2"></i>Add New Fee Type
                </button>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Fee Types</h6>
                                <h2 class="mb-0 text-white">12</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-money-check-alt fa-lg text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Mandatory Fees</h6>
                                <h2 class="mb-0 text-white">8</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-check-circle fa-lg text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Optional Fees</h6>
                                <h2 class="mb-0 text-white">3</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-toggle-off fa-lg text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">One-Time Fees</h6>
                                <h2 class="mb-0 text-white">1</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-calendar-day fa-lg text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fee Types Table -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">All Fee Types</h5>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                            data-toggle="dropdown">
                        <i class="las la-filter mr-2"></i>Filter
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">All Fee Types</a>
                        <a class="dropdown-item" href="#">Mandatory Only</a>
                        <a class="dropdown-item" href="#">Optional Only</a>
                        <a class="dropdown-item" href="#">One-Time Only</a>
                        <a class="dropdown-item" href="#">Recurring Only</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fee Type</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Frequency</th>
                                <th>Classes</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Tuition Fee -->
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded p-2 mr-3">
                                            <i class="las la-graduation-cap text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Tuition Fee</h6>
                                            <small class="text-muted">Monthly academic fee</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-light">TUI-001</span></td>
                                <td>
                                    <span class="badge badge-success fee-badge">Mandatory</span>
                                </td>
                                <td>
                                    <div class="input-group amount-input">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PKR</span>
                                        </div>
                                        <input type="number" class="form-control" value="3000">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">Monthly</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">All Classes</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-primary mr-2 edit-fee-type">
                                            <i class="las la-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-fee-type">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Admission Fee -->
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success rounded p-2 mr-3">
                                            <i class="las la-user-plus text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Admission Fee</h6>
                                            <small class="text-muted">One-time admission charge</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-light">ADM-001</span></td>
                                <td>
                                    <span class="badge badge-warning fee-badge">One-Time</span>
                                </td>
                                <td>
                                    <div class="input-group amount-input">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PKR</span>
                                        </div>
                                        <input type="number" class="form-control" value="5000">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">One Time</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">All Classes</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-primary mr-2 edit-fee-type">
                                            <i class="las la-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-fee-type">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Exam Fee -->
                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info rounded p-2 mr-3">
                                            <i class="las la-clipboard-check text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Exam Fee</h6>
                                            <small class="text-muted">Per exam charge</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-light">EXM-001</span></td>
                                <td>
                                    <span class="badge badge-success fee-badge">Mandatory</span>
                                </td>
                                <td>
                                    <div class="input-group amount-input">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PKR</span>
                                        </div>
                                        <input type="number" class="form-control" value="1000">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">Per Term</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">All Classes</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-primary mr-2 edit-fee-type">
                                            <i class="las la-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-fee-type">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Transport Fee -->
                            <tr>
                                <td>4</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-warning rounded p-2 mr-3">
                                            <i class="las la-bus text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Transport Fee</h6>
                                            <small class="text-muted">Monthly transportation charge</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-light">TRN-001</span></td>
                                <td>
                                    <span class="badge badge-info fee-badge">Optional</span>
                                </td>
                                <td>
                                    <div class="input-group amount-input">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PKR</span>
                                        </div>
                                        <input type="number" class="form-control" value="2000">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">Monthly</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">All Classes</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-primary mr-2 edit-fee-type">
                                            <i class="las la-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-fee-type">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Computer Lab Fee -->
                            <tr>
                                <td>5</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-danger rounded p-2 mr-3">
                                            <i class="las la-desktop text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Computer Lab Fee</h6>
                                            <small class="text-muted">Computer facility charge</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-light">COM-001</span></td>
                                <td>
                                    <span class="badge badge-info fee-badge">Optional</span>
                                </td>
                                <td>
                                    <div class="input-group amount-input">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PKR</span>
                                        </div>
                                        <input type="number" class="form-control" value="500">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">Monthly</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">Class 3-10</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-primary mr-2 edit-fee-type">
                                            <i class="las la-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-fee-type">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Sports Fee -->
                            <tr>
                                <td>6</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-secondary rounded p-2 mr-3">
                                            <i class="las la-running text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Sports Fee</h6>
                                            <small class="text-muted">Sports activities charge</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-light">SPT-001</span></td>
                                <td>
                                    <span class="badge badge-info fee-badge">Optional</span>
                                </td>
                                <td>
                                    <div class="input-group amount-input">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PKR</span>
                                        </div>
                                        <input type="number" class="form-control" value="300">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">Monthly</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">All Classes</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-primary mr-2 edit-fee-type">
                                            <i class="las la-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-fee-type">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Fee Structure by Class -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Fee Structure by Class</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Class</th>
                                <th>Tuition Fee</th>
                                <th>Admission Fee</th>
                                <th>Exam Fee</th>
                                <th>Transport Fee</th>
                                <th>Computer Fee</th>
                                <th>Sports Fee</th>
                                <th>Total Monthly</th>
                                <th>Total Annual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Class 1</strong></td>
                                <td>PKR 3,000</td>
                                <td>PKR 5,000</td>
                                <td>PKR 1,000</td>
                                <td>PKR 2,000</td>
                                <td>-</td>
                                <td>PKR 300</td>
                                <td><strong>PKR 6,300</strong></td>
                                <td><strong>PKR 63,000</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Class 5</strong></td>
                                <td>PKR 4,000</td>
                                <td>PKR 5,000</td>
                                <td>PKR 1,500</td>
                                <td>PKR 2,000</td>
                                <td>PKR 500</td>
                                <td>PKR 300</td>
                                <td><strong>PKR 8,300</strong></td>
                                <td><strong>PKR 83,000</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Class 8</strong></td>
                                <td>PKR 5,000</td>
                                <td>PKR 5,000</td>
                                <td>PKR 2,000</td>
                                <td>PKR 2,500</td>
                                <td>PKR 500</td>
                                <td>PKR 300</td>
                                <td><strong>PKR 10,300</strong></td>
                                <td><strong>PKR 103,000</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Class 10</strong></td>
                                <td>PKR 6,000</td>
                                <td>PKR 5,000</td>
                                <td>PKR 2,500</td>
                                <td>PKR 2,500</td>
                                <td>PKR 500</td>
                                <td>PKR 300</td>
                                <td><strong>PKR 11,800</strong></td>
                                <td><strong>PKR 118,000</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Fee Type Modal -->
    <div class="modal fade" id="addFeeTypeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Fee Type</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addFeeTypeForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fee Name *</label>
                                    <input type="text" class="form-control" placeholder="e.g., Tuition Fee, Admission Fee" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fee Code *</label>
                                    <input type="text" class="form-control" placeholder="e.g., TUI-001" required>
                                    <small class="form-text text-muted">Unique code for this fee type</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category *</label>
                                    <select class="form-control" required>
                                        <option value="">Select Category</option>
                                        <option value="mandatory">Mandatory</option>
                                        <option value="optional">Optional</option>
                                        <option value="one-time">One-Time</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Frequency *</label>
                                    <select class="form-control" required>
                                        <option value="">Select Frequency</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="quarterly">Quarterly</option>
                                        <option value="half-yearly">Half-Yearly</option>
                                        <option value="yearly">Yearly</option>
                                        <option value="per-term">Per Term</option>
                                        <option value="one-time">One Time</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Default Amount *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PKR</span>
                                        </div>
                                        <input type="number" class="form-control" required min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Late Fee Percentage</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" value="5" min="0" max="50">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Late fee percentage after due date</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Applicable Classes</label>
                                    <select class="form-control" multiple>
                                        <optgroup label="Pre-Primary">
                                            <option value="playgroup">Play Group</option>
                                            <option value="nursery">Nursery</option>
                                            <option value="kg">Kindergarten</option>
                                        </optgroup>
                                        <optgroup label="Primary">
                                            <option value="class1">Class 1</option>
                                            <option value="class2">Class 2</option>
                                            <option value="class3">Class 3</option>
                                            <option value="class4">Class 4</option>
                                            <option value="class5">Class 5</option>
                                        </optgroup>
                                        <optgroup label="Middle">
                                            <option value="class6">Class 6</option>
                                            <option value="class7">Class 7</option>
                                            <option value="class8">Class 8</option>
                                        </optgroup>
                                        <optgroup label="Secondary">
                                            <option value="class9">Class 9</option>
                                            <option value="class10">Class 10</option>
                                        </optgroup>
                                    </select>
                                    <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple classes</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Optional description about this fee type"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="isActive" checked>
                                        <label class="custom-control-label" for="isActive">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="hasDiscount">
                                        <label class="custom-control-label" for="hasDiscount">
                                            Allow Discounts
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveFeeType">Save Fee Type</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Fee Type Modal -->
    <div class="modal fade" id="editFeeTypeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Fee Type</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Content will be loaded dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="updateFeeType">Update Fee Type</button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Fee Types Script -->
    <script>
        $(document).ready(function() {
            // Save new fee type
            $('#saveFeeType').click(function() {
                const form = $('#addFeeTypeForm');
                if (form[0].checkValidity()) {
                    const btn = $(this);
                    const originalText = btn.html();
                    btn.html('<i class="las la-spinner la-spin mr-2"></i>Saving...').prop('disabled', true);
                    
                    setTimeout(function() {
                        btn.html(originalText).prop('disabled', false);
                        $('#addFeeTypeModal').modal('hide');
                        form[0].reset();
                        alert('Fee type added successfully!');
                    }, 1500);
                } else {
                    form[0].reportValidity();
                }
            });
            
            // Edit fee type
            $('.edit-fee-type').click(function() {
                // In real application, this would load data from backend
                $('#editFeeTypeModal .modal-body').html(`
                    <form id="editFeeTypeForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fee Name *</label>
                                    <input type="text" class="form-control" value="Tuition Fee" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fee Code *</label>
                                    <input type="text" class="form-control" value="TUI-001" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category *</label>
                                    <select class="form-control" required>
                                        <option value="mandatory" selected>Mandatory</option>
                                        <option value="optional">Optional</option>
                                        <option value="one-time">One-Time</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Frequency *</label>
                                    <select class="form-control" required>
                                        <option value="monthly" selected>Monthly</option>
                                        <option value="quarterly">Quarterly</option>
                                        <option value="half-yearly">Half-Yearly</option>
                                        <option value="yearly">Yearly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Default Amount *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PKR</span>
                                        </div>
                                        <input type="number" class="form-control" value="3000" required min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Late Fee Percentage</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" value="5" min="0" max="50">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="3">Monthly academic fee for all classes</textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                `);
                
                $('#editFeeTypeModal').modal('show');
            });
            
            // Update fee type
            $(document).on('click', '#updateFeeType', function() {
                const btn = $(this);
                const originalText = btn.html();
                btn.html('<i class="las la-spinner la-spin mr-2"></i>Updating...').prop('disabled', true);
                
                setTimeout(function() {
                    btn.html(originalText).prop('disabled', false);
                    $('#editFeeTypeModal').modal('hide');
                    alert('Fee type updated successfully!');
                }, 1500);
            });
            
            // Delete fee type
            $('.delete-fee-type').click(function() {
                if (confirm('Are you sure you want to delete this fee type? This action cannot be undone.')) {
                    const btn = $(this);
                    const originalHtml = btn.html();
                    btn.html('<i class="las la-spinner la-spin"></i>').prop('disabled', true);
                    
                    setTimeout(function() {
                        btn.html(originalHtml).prop('disabled', false);
                        alert('Fee type deleted successfully!');
                    }, 1500);
                }
            });
            
            // Amount input change
            $('.amount-input input').on('change', function() {
                const value = $(this).val();
                if (value < 0) {
                    $(this).val(0);
                }
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
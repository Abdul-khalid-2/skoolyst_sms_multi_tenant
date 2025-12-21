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
        <x-page-header 
            title="School Activation"
            subtitle="Activate or deactivate school"
            action="false"
            :breadcrumbs="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Schools', 'url' => route('schools.index')],
                ['label' => $school->name],
                ['label' => 'Activation']
            ]"
        />

        <!-- Warning Alert -->
        @if($school->status == 'active')
            <div class="alert alert-warning">
                <h5><i class="las la-exclamation-triangle mr-2"></i> Important Notice</h5>
                <p class="mb-0">If you deactivate this school:</p>
                <ul class="mb-0 mt-2">
                    <li>Teachers cannot login to the system</li>
                    <li>Students cannot access their portal</li>
                    <li>Fee collection will be disabled</li>
                    <li>Attendance tracking will be paused</li>
                </ul>
            </div>
        @endif

        <!-- School Info Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">School Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-bold">School Name</label>
                            <p>{{ $school->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-bold">Email</label>
                            <p>{{ $school->email }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="font-weight-bold">Total Branches</label>
                            <p><span class="badge badge-info">{{ $school->branches_count ?? 0 }}</span></p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="font-weight-bold">Total Users</label>
                            <p><span class="badge badge-info">{{ $school->users_count ?? 0 }}</span></p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="font-weight-bold">Current Status</label>
                            <p><x-status-badge :status="$school->status" /></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activation Form -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Activation Control</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('schools.activation.update', $school->id) }}" method="POST" id="activationForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-switch-lg">
                                    <input type="checkbox" class="custom-control-input" 
                                           id="status" name="status" value="active"
                                           {{ $school->status == 'active' ? 'checked' : '' }}
                                           data-toggle="modal" data-target="#confirmationModal">
                                    <label class="custom-control-label" for="status">
                                        <h5 class="mb-0">
                                            @if($school->status == 'active')
                                                Currently Active - Click to Deactivate
                                            @else
                                                Currently Inactive - Click to Activate
                                            @endif
                                        </h5>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <h6><i class="las la-info-circle mr-2"></i> Status Description:</h6>
                                <p class="mb-0">
                                    @if($school->status == 'active')
                                        <strong>Active:</strong> School is fully operational. All users can access the system normally.
                                    @else
                                        <strong>Inactive:</strong> School is disabled. Users cannot login and operations are paused.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
                
                <!-- Action Buttons -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <a href="{{ route('schools.index') }}" class="btn btn-secondary">
                            <i class="las la-arrow-left mr-2"></i> Back to Schools
                        </a>
                        <a href="#" class="btn btn-primary">
                            <i class="las la-cog mr-2"></i> Go to Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if($school->status == 'active')
                            Deactivate School
                        @else
                            Activate School
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($school->status == 'active')
                        <div class="alert alert-danger">
                            <h6><i class="las la-exclamation-triangle mr-2"></i> Warning!</h6>
                            <p>Are you sure you want to deactivate this school?</p>
                            <ul class="mb-0">
                                <li>All users will be logged out immediately</li>
                                <li>No new operations can be performed</li>
                                <li>Existing data will be preserved</li>
                            </ul>
                        </div>
                    @else
                        <div class="alert alert-success">
                            <h6><i class="las la-check-circle mr-2"></i> Confirmation</h6>
                            <p>Are you sure you want to activate this school?</p>
                            <ul class="mb-0">
                                <li>All users will be able to login again</li>
                                <li>Normal operations will resume</li>
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn 
                        @if($school->status == 'active')
                            btn-danger
                        @else
                            btn-success
                        @endif" 
                        onclick="document.getElementById('activationForm').submit();">
                        @if($school->status == 'active')
                            Yes, Deactivate School
                        @else
                            Yes, Activate School
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Toggle Switch Handler -->
    <script>
        $(document).ready(function() {
            $('#status').on('click', function(e) {
                if(!$(this).is(':checked') && "{{ $school->status }}" == 'active') {
                    // Show confirmation for deactivation
                    e.preventDefault();
                    $('#confirmationModal').modal('show');
                } else if($(this).is(':checked') && "{{ $school->status }}" == 'inactive') {
                    // Show confirmation for activation
                    e.preventDefault();
                    $('#confirmationModal').modal('show');
                }
            });
            
            // Reset checkbox if modal is closed without confirmation
            $('#confirmationModal').on('hidden.bs.modal', function () {
                var checkbox = $('#status');
                checkbox.prop('checked', "{{ $school->status }}" == 'active');
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
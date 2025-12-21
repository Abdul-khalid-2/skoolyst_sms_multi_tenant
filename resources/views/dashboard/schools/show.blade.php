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
            title="School Details"
            subtitle="View detailed information about school"
            action="false"
            :breadcrumbs="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Schools', 'url' => route('schools.index')],
                ['label' => $school->name]
            ]"
        />

        <div class="row">
            <!-- School Information -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">School Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                @if($school->logo)
                                    <img src="{{ asset('storage/' . $school->logo) }}" 
                                         alt="{{ $school->name }}" 
                                         class="img-fluid rounded-circle" 
                                         style="max-width: 200px;">
                                @else
                                    <div class="avatar-placeholder rounded-circle d-inline-flex align-items-center justify-content-center" 
                                         style="width: 200px; height: 200px; background: #f0f0f0;">
                                        <i class="las la-school fa-5x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">School Name</label>
                                            <p class="form-control-static">{{ $school->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Email Address</label>
                                            <p class="form-control-static">{{ $school->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Phone Number</label>
                                            <p class="form-control-static">{{ $school->phone ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Status</label>
                                            <p class="form-control-static"><x-status-badge :status="$school->status" /></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Address</label>
                                            <p class="form-control-static">{{ $school->address ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Created Date</label>
                                            <p class="form-control-static">{{ $school->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Last Updated</label>
                                            <p class="form-control-static">{{ $school->updated_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics & Actions -->
            <div class="col-lg-4">
                <!-- Statistics Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">School Statistics</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Total Branches:</span>
                            <span class="font-weight-bold badge badge-info">{{ $school->branches_count ?? 0 }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Total Users:</span>
                            <span class="font-weight-bold badge badge-info">{{ $school->users_count ?? 0 }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Active Users:</span>
                            <span class="font-weight-bold badge badge-success">{{ $school->active_users_count ?? 0 }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Inactive Users:</span>
                            <span class="font-weight-bold badge badge-danger">{{ $school->inactive_users_count ?? 0 }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-primary">
                                <i class="las la-edit mr-2"></i> Edit School
                            </a>
                            <a href="#" class="btn btn-secondary">
                                <i class="las la-cog mr-2"></i> School Settings
                            </a>
                            <a href="{{ route('schools.activation', $school->id) }}" class="btn 
                                {{ $school->status == 'active' ? 'btn-warning' : 'btn-success' }}">
                                <i class="las la-power-off mr-2"></i> 
                                {{ $school->status == 'active' ? 'Deactivate' : 'Activate' }} School
                            </a>
                            <a href="{{ route('schools.index') }}" class="btn btn-light">
                                <i class="las la-arrow-left mr-2"></i> Back to Schools
                            </a>
                        </div>
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
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
                ['label' => $school->name, 'url' => route('schools.show', $school->id)],
                ['label' => 'Activation']
            ]" />

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">School Activation Status</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                @if($school->logo)
                                <img src="{{ asset('website/' . $school->logo) }}"
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
                                            <label class="font-weight-bold">Current Status</label>
                                            <p class="form-control-static">
                                                <span class="badge {{ $school->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                                    {{ ucfirst($school->status) }}
                                                </span>
                                            </p>
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Address</label>
                                            <p class="form-control-static">{{ $school->address ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Activation Form -->
                        <form action="{{ route('schools.activation.update', $school->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-cogs mr-2"></i> Change Activation Status
                                    </h5>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>New Status *</label>
                                        <select name="status" class="form-control" required>
                                            <option value="active" {{ $school->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $school->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <small class="form-text text-muted">
                                            When deactivated, all school users will also be deactivated.
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <div class="form-group">
                                        <label>Reason for Change (Optional)</label>
                                        <textarea name="reason" class="form-control" rows="3"
                                            placeholder="Enter reason for activation status change"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn {{ $school->status == 'active' ? 'btn-warning' : 'btn-success' }}">
                                        <i class="las la-power-off mr-2"></i>
                                        {{ $school->status == 'active' ? 'Deactivate School' : 'Activate School' }}
                                    </button>
                                    <a href="{{ route('schools.show', $school->id) }}" class="btn btn-light">
                                        <i class="las la-arrow-left mr-2"></i> Back to School Details
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Information Sidebar -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="las la-info-circle mr-2"></i> What happens when deactivated?
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <h6>When a school is deactivated:</h6>
                            <ul class="mb-0">
                                <li>All users of this school cannot log in</li>
                                <li>No new admissions can be made</li>
                                <li>Existing students cannot access their portal</li>
                                <li>Staff cannot access their accounts</li>
                                <li>Fee collection is suspended</li>
                                <li>Attendance cannot be marked</li>
                            </ul>
                        </div>

                        <div class="alert alert-info mt-3">
                            <h6>When a school is activated:</h6>
                            <ul class="mb-0">
                                <li>All users can log in again</li>
                                <li>Normal operations resume</li>
                                <li>All features become available</li>
                            </ul>
                        </div>

                        <div class="alert alert-light mt-3">
                            <h6>Note:</h6>
                            <p class="mb-0">
                                School data is preserved when deactivated. You can reactivate anytime.
                            </p>
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
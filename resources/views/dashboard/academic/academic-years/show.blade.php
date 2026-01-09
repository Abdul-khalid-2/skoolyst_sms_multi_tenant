<!-- resources/views/dashboard/academic/academic-years/show.blade.php -->
<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    @endpush

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header -->
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Academic Year Details</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('academic-years.index') }}">Academic Years</a></li>
                                <li class="breadcrumb-item active">{{ $academicYear->name }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('academic-years.edit', $academicYear) }}" class="btn btn-primary mr-2">
                            <i class="las la-edit mr-2"></i>Edit
                        </a>
                        <a href="{{ route('academic-years.index') }}" class="btn btn-secondary">
                            <i class="las la-arrow-left mr-2"></i>Back
                        </a>
                    </div>
                </div>

                <!-- Year Status Badge -->
                <div class="alert {{ $academicYear->is_active ? 'alert-success' : 'alert-info' }} mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">{{ $academicYear->name }}</h5>
                            <p class="mb-0">{{ $academicYear->start_date->format('d M Y') }} - {{ $academicYear->end_date->format('d M Y') }}</p>
                        </div>
                        <span class="badge {{ $academicYear->is_active ? 'badge-success' : ($academicYear->status == 'archived' ? 'badge-secondary' : 'badge-warning') }} badge-pill p-2">
                            {{ ucfirst($academicYear->status) }}
                            @if($academicYear->is_active) (Active) @endif
                        </span>
                    </div>
                </div>

                <div class="row">
                    <!-- Left Column - Basic Info -->
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Academic Year Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="text-muted">Year Name</label>
                                            <p class="mb-0">{{ $academicYear->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="text-muted">Short Code</label>
                                            <p class="mb-0">{{ $academicYear->code ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="text-muted">Start Date</label>
                                            <p class="mb-0">{{ $academicYear->start_date->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="text-muted">End Date</label>
                                            <p class="mb-0">{{ $academicYear->end_date->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="text-muted">Duration</label>
                                            <p class="mb-0">{{ $academicYear->start_date->diffInDays($academicYear->end_date) }} days</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="text-muted">Current Status</label>
                                            <p class="mb-0">
                                                @if($academicYear->is_active)
                                                    <span class="badge badge-success">Currently Active</span>
                                                @else
                                                    <span class="badge badge-warning">Not Active</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                @if($academicYear->description)
                                    <div class="mt-3">
                                        <label class="text-muted">Description</label>
                                        <p class="mb-0">{{ $academicYear->description }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Statistics & Actions -->
                    <div class="col-lg-4">
                        <!-- Quick Stats -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Quick Statistics</h5>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <div class="p-3 bg-light rounded">
                                                <h3 class="mb-1">{{ $academicYear->students_count ?? 0 }}</h3>
                                                <small class="text-muted">Students</small>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="p-3 bg-light rounded">
                                                <h3 class="mb-1">{{ $academicYear->classes_count ?? 0 }}</h3>
                                                <small class="text-muted">Classes</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                @if(!$academicYear->is_active && $academicYear->status != 'archived')
                                    <form action="{{ route('academic-years.activate', $academicYear) }}" method="POST" class="mb-2">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-block" 
                                                onclick="return confirm('Are you sure you want to activate this academic year?')">
                                            <i class="las la-toggle-on mr-2"></i>Activate This Year
                                        </button>
                                    </form>
                                @endif

                                @if($academicYear->status != 'archived' && !$academicYear->is_active)
                                    <form action="{{ route('academic-years.archive', $academicYear) }}" method="POST" class="mb-2">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-block"
                                                onclick="return confirm('Are you sure you want to archive this academic year?')">
                                            <i class="las la-archive mr-2"></i>Archive Year
                                        </button>
                                    </form>
                                @endif

                                @if($academicYear->students_count == 0 && $academicYear->classes_count == 0)
                                    <form action="{{ route('academic-years.destroy', $academicYear) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block"
                                                onclick="return confirm('Are you sure you want to delete this academic year? This action cannot be undone.')">
                                            <i class="las la-trash mr-2"></i>Delete Year
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Activity Timeline</h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Created</h6>
                                    <small class="text-muted">{{ $academicYear->created_at->format('d M Y, h:i A') }}</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Last Updated</h6>
                                    <small class="text-muted">{{ $academicYear->updated_at->format('d M Y, h:i A') }}</small>
                                </div>
                            </div>
                            @if($academicYear->is_active)
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Activated</h6>
                                        <small class="text-muted">{{ $academicYear->updated_at->format('d M Y, h:i A') }}</small>
                                    </div>
                                </div>
                            @endif
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
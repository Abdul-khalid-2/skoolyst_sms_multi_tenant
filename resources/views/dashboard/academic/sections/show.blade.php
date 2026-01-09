<!-- resources/views/dashboard/academic/sections/show.blade.php -->
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
                        <h4 class="mb-3">Section Details</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('sections.index') }}">Sections</a></li>
                                <li class="breadcrumb-item active">{{ $section->name }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('sections.edit', $section) }}" class="btn btn-primary mr-2">
                            <i class="las la-edit mr-2"></i>Edit
                        </a>
                        <a href="{{ route('sections.index') }}" class="btn btn-secondary">
                            <i class="las la-arrow-left mr-2"></i>Back
                        </a>
                    </div>
                </div>

                <!-- Section Header -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="mb-2">{{ $section->name }} - {{ $section->class->name }}</h3>
                                <div class="d-flex flex-wrap align-items-center mb-3">
                                    <span class="badge {{ $section->status === 'active' ? 'badge-success' : 'badge-warning' }} mr-3 mb-2">
                                        {{ ucfirst($section->status) }}
                                    </span>
                                    <span class="badge badge-info mr-3 mb-2">{{ ucfirst($section->shift) }} Shift</span>
                                    @if($section->code)
                                        <span class="badge badge-secondary mb-2">Code: {{ $section->code }}</span>
                                    @endif
                                </div>
                                
                                @if($section->room_number)
                                    <p class="mb-2">
                                        <i class="las la-door-open mr-2"></i>
                                        <strong>Room:</strong> {{ $section->room_number }}
                                    </p>
                                @endif
                                
                                @if($section->description)
                                    <p class="mb-0">
                                        <strong>Description:</strong> {{ $section->description }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="text-right">
                                    <div class="h1 mb-0">{{ $studentCount }}</div>
                                    <small class="text-muted">Students Enrolled</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Left Column - Section Info -->
                    <div class="col-lg-8">
                        <!-- Statistics Card -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Section Statistics</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="text-center p-3 bg-light rounded">
                                            <h3 class="mb-1">{{ $section->capacity }}</h3>
                                            <small class="text-muted">Total Capacity</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="text-center p-3 bg-light rounded">
                                            <h3 class="mb-1">{{ $studentCount }}</h3>
                                            <small class="text-muted">Current Students</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="text-center p-3 bg-light rounded">
                                            <h3 class="mb-1 {{ $availableSeats > 0 ? 'text-success' : 'text-danger' }}">
                                                {{ $availableSeats > 0 ? $availableSeats : 'Full' }}
                                            </h3>
                                            <small class="text-muted">Available Seats</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <h6>Capacity Utilization</h6>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar {{ $occupancyPercentage >= 90 ? 'bg-danger' : ($occupancyPercentage >= 75 ? 'bg-warning' : 'bg-success') }}" 
                                             style="width: {{ $occupancyPercentage }}%"
                                             role="progressbar">
                                            {{ round($occupancyPercentage) }}%
                                        </div>
                                    </div>
                                    <small class="text-muted">{{ $studentCount }} of {{ $section->capacity }} seats filled</small>
                                </div>
                            </div>
                        </div>

                        <!-- Teacher Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Teacher Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if($section->classTeacher)
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="text-primary mb-2">Class Teacher</h6>
                                                <p class="mb-1"><strong>{{ $section->classTeacher->name }}</strong></p>
                                                <p class="mb-1 text-muted">Primary Responsibility</p>
                                                <a href="mailto:{{ $section->classTeacher->email }}" class="small">
                                                    <i class="las la-envelope mr-1"></i>{{ $section->classTeacher->email }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if($section->assistantTeacher)
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="text-primary mb-2">Assistant Teacher</h6>
                                                <p class="mb-1"><strong>{{ $section->assistantTeacher->name }}</strong></p>
                                                <p class="mb-1 text-muted">Assistant Responsibility</p>
                                                <a href="mailto:{{ $section->assistantTeacher->email }}" class="small">
                                                    <i class="las la-envelope mr-1"></i>{{ $section->assistantTeacher->email }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if(!$section->classTeacher && !$section->assistantTeacher)
                                        <div class="col-12">
                                            <div class="alert alert-info mb-0">
                                                <i class="las la-info-circle mr-2"></i>
                                                No teachers assigned to this section yet.
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Quick Info & Actions -->
                    <div class="col-lg-4">
                        <!-- Quick Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Quick Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <small class="text-muted">Academic Year</small>
                                    <p class="mb-0">
                                        {{ $section->academicYear->name ?? 'All Years' }}
                                    </p>
                                </div>
                                
                                @if($section->start_time && $section->end_time)
                                    <div class="mb-3">
                                        <small class="text-muted">Timing</small>
                                        <p class="mb-0">
                                            {{ \Carbon\Carbon::parse($section->start_time)->format('h:i A') }} - 
                                            {{ \Carbon\Carbon::parse($section->end_time)->format('h:i A') }}
                                        </p>
                                    </div>
                                @endif
                                
                                @if($section->weekdays)
                                    <div class="mb-3">
                                        <small class="text-muted">Week Days</small>
                                        <p class="mb-0">
                                            {{ implode(', ', array_map('ucfirst', json_decode($section->weekdays))) }}
                                        </p>
                                    </div>
                                @endif
                                
                                <div class="mb-3">
                                    <small class="text-muted">Features</small>
                                    <div class="mt-2">
                                        @if($section->enable_attendance)
                                            <span class="badge badge-success mr-2">Attendance</span>
                                        @endif
                                        @if($section->enable_fee_collection)
                                            <span class="badge badge-info">Fee Collection</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mb-0">
                                    <small class="text-muted">Created</small>
                                    <p class="mb-0">{{ $section->created_at->format('d M Y, h:i A') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                @if($section->status === 'active' && $studentCount == 0)
                                    <form action="{{ route('sections.toggle-status', $section) }}" method="POST" class="mb-2">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-block" 
                                                onclick="return confirm('Are you sure you want to deactivate this section?')">
                                            <i class="las la-toggle-off mr-2"></i>Deactivate Section
                                        </button>
                                    </form>
                                @elseif($section->status === 'inactive')
                                    <form action="{{ route('sections.toggle-status', $section) }}" method="POST" class="mb-2">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-block"
                                                onclick="return confirm('Are you sure you want to activate this section?')">
                                            <i class="las la-toggle-on mr-2"></i>Activate Section
                                        </button>
                                    </form>
                                @endif

                                @if($studentCount == 0)
                                    <form action="{{ route('sections.destroy', $section) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block"
                                                onclick="return confirm('Are you sure you want to delete this section? This action cannot be undone.')">
                                            <i class="las la-trash mr-2"></i>Delete Section
                                        </button>
                                    </form>
                                @else
                                    <div class="alert alert-warning mb-0">
                                        <i class="las la-exclamation-triangle mr-2"></i>
                                        Cannot delete section with enrolled students.
                                    </div>
                                @endif
                            </div>
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
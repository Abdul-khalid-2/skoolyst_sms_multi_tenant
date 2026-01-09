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
                <h4 class="mb-3">Sections Setup</h4>
                <p class="mb-0">Manage parallel sections for each class (A, B, C, etc.)</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Academic</a></li>
                        <li class="breadcrumb-item active">Sections</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('sections.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-3"></i>Add Section
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="las la-check-circle mr-2"></i>{{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="las la-exclamation-triangle mr-2"></i>{{ session('error') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Feature Toggle Alert -->
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <h6><i class="las la-toggle-on mr-2"></i>Feature Status: Enabled</h6>
            <p class="mb-0">Sections feature is currently enabled. You can disable it from School Settings if not needed.</p>
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('sections.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Search Section</label>
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Search section name"
                                       value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Class</label>
                                <select name="class_id" class="form-control">
                                    <option value="">All Classes</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}" 
                                            {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Academic Year</label>
                                <select name="academic_year_id" class="form-control">
                                    <option value="">All Years</option>
                                    @foreach($academicYears as $year)
                                        <option value="{{ $year->id }}" 
                                            {{ request('academic_year_id') == $year->id ? 'selected' : '' }}>
                                            {{ $year->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <div class="form-group w-100">
                                <button type="submit" class="btn btn-primary btn-block">Filter</button>
                                @if(request()->hasAny(['search', 'class_id', 'academic_year_id']))
                                    <a href="{{ route('sections.index') }}" class="btn btn-secondary btn-block mt-2">
                                        Clear Filters
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Class-wise Sections -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Sections by Class 
                    @if($activeYear)
                        - Academic Year: {{ $activeYear->name }}
                    @endif
                </h5>
            </div>
            <div class="card-body">
                @if($classes->isEmpty())
                    <div class="text-center py-5">
                        <i class="las la-layer-group fa-4x text-muted mb-3"></i>
                        <h5>No Classes with Sections Enabled</h5>
                        <p class="text-muted">Enable sections feature for classes to add sections</p>
                        <a href="{{ route('classes.index') }}" class="btn btn-primary mt-2">
                            <i class="las la-chalkboard mr-2"></i> Manage Classes
                        </a>
                    </div>
                @else
                    @foreach($classes as $class)
                        @if($class->sections_count > 0)
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="las la-chalkboard mr-2"></i>
                                        {{ $class->name }} Sections
                                        <span class="badge badge-primary ml-2">{{ $class->sections_count }} Sections</span>
                                        <span class="badge badge-info ml-2">{{ $class->students_count }} Students</span>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($class->sections as $section)
                                            @php
                                                $studentCount = $section->students_count ?? 0;
                                                $availableSeats = $section->capacity - $studentCount;
                                                $occupancyPercentage = $section->capacity > 0 ? ($studentCount / $section->capacity) * 100 : 0;
                                                
                                                // Determine border color based on shift
                                                $borderColor = match($section->shift) {
                                                    'morning' => 'border-primary',
                                                    'evening' => 'border-warning',
                                                    'day' => 'border-success',
                                                    'weekend' => 'border-info',
                                                    default => 'border-secondary'
                                                };
                                                
                                                // Determine progress bar color
                                                $progressColor = match(true) {
                                                    $occupancyPercentage >= 90 => 'bg-danger',
                                                    $occupancyPercentage >= 75 => 'bg-warning',
                                                    default => 'bg-success'
                                                };
                                            @endphp
                                            
                                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                                <div class="card h-100 {{ $borderColor }}">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                                            <div>
                                                                <h5 class="card-title mb-1">{{ $section->name }}</h5>
                                                                <p class="text-muted mb-0">{{ $class->name }} - {{ ucfirst($section->shift) }} Shift</p>
                                                                @if($section->room_number)
                                                                    <small class="text-muted">{{ $section->room_number }}</small>
                                                                @endif
                                                            </div>
                                                            <span class="badge {{ $section->status === 'active' ? 'badge-success' : 'badge-warning' }}">
                                                                {{ ucfirst($section->status) }}
                                                            </span>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <div class="d-flex justify-content-between mb-2">
                                                                <span>Capacity:</span>
                                                                <span class="font-weight-bold">{{ $section->capacity }} Students</span>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-2">
                                                                <span>Current:</span>
                                                                <span class="font-weight-bold">{{ $studentCount }} Students</span>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span>Remaining:</span>
                                                                <span class="font-weight-bold {{ $availableSeats > 0 ? 'text-success' : 'text-danger' }}">
                                                                    {{ $availableSeats > 0 ? $availableSeats . ' Seats' : 'Full' }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        @if($section->capacity > 0)
                                                            <div class="progress mb-3" style="height: 10px;">
                                                                <div class="progress-bar {{ $progressColor }}" 
                                                                     style="width: {{ $occupancyPercentage }}%"></div>
                                                            </div>
                                                        @endif
                                                        
                                                        @if($section->classTeacher)
                                                            <div class="mb-3">
                                                                <small class="text-muted">Class Teacher:</small>
                                                                <div>{{ $section->classTeacher->name }}</div>
                                                            </div>
                                                        @endif
                                                        
                                                        <div class="text-center">
                                                            <div class="btn-group w-100">
                                                                <a href="{{ route('sections.show', $section) }}" 
                                                                   class="btn btn-sm btn-outline-primary">View</a>
                                                                <a href="{{ route('sections.edit', $section) }}" 
                                                                   class="btn btn-sm btn-outline-primary">Edit</a>
                                                                
                                                                @if($section->status === 'active' && $studentCount == 0)
                                                                    <form action="{{ route('sections.toggle-status', $section) }}" 
                                                                          method="POST" class="d-inline">
                                                                        @csrf
                                                                        <button type="submit" 
                                                                                class="btn btn-sm btn-outline-warning">
                                                                            Deactivate
                                                                        </button>
                                                                    </form>
                                                                @elseif($section->status === 'inactive')
                                                                    <form action="{{ route('sections.toggle-status', $section) }}" 
                                                                          method="POST" class="d-inline">
                                                                        @csrf
                                                                        <button type="submit" 
                                                                                class="btn btn-sm btn-outline-success">
                                                                            Activate
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        <!-- Add New Section Card -->
                                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                            <div class="card h-100 border-dashed">
                                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                                    <div class="text-center mb-3">
                                                        <i class="las la-plus-circle fa-3x text-muted"></i>
                                                    </div>
                                                    <h5 class="text-muted mb-3">Add New Section</h5>
                                                    <a href="{{ route('sections.create', ['class_id' => $class->id]) }}" 
                                                       class="btn btn-primary btn-sm">
                                                        Add to {{ $class->name }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Class with no sections -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="las la-chalkboard mr-2"></i>
                                        {{ $class->name }}
                                        <span class="badge badge-secondary ml-2">No Sections</span>
                                    </h6>
                                </div>
                                <div class="card-body text-center py-4">
                                    <i class="las la-layer-group fa-3x text-muted mb-3"></i>
                                    <h5>No Sections Created Yet</h5>
                                    <p class="text-muted">Start by adding sections to this class</p>
                                    <a href="{{ route('sections.create', ['class_id' => $class->id]) }}" 
                                       class="btn btn-primary">
                                        <i class="las la-plus mr-2"></i> Add Section to {{ $class->name }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
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
<!-- resources/views/dashboard/academic/classes/index.blade.php -->
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
                <h4 class="mb-3">Classes Setup</h4>
                <p class="mb-0">Define school classes for different academic systems</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Academic</a></li>
                        <li class="breadcrumb-item active">Classes</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('classes.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-3"></i>Add Class
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

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('classes.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Search Class</label>
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Search class name"
                                       value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Academic Year</label>
                                <select name="academic_year_id" class="form-control">
                                    <option value="">All Academic Years</option>
                                    @foreach($academicYears as $year)
                                        <option value="{{ $year->id }}" 
                                            {{ request('academic_year_id') == $year->id ? 'selected' : '' }}>
                                            {{ $year->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">All Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <div class="form-group w-100">
                                <button type="submit" class="btn btn-primary btn-block">Filter</button>
                                @if(request()->hasAny(['search', 'academic_year_id', 'status']))
                                    <a href="{{ route('classes.index') }}" class="btn btn-secondary btn-block mt-2">
                                        Clear Filters
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Class Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Classes</h6>
                                <h2 class="mb-0 text-white">{{ $classes->count() }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-chalkboard-teacher fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">Active Classes</h6>
                                <h2 class="mb-0 text-white">{{ $classes->where('status', 'active')->count() }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-check-circle fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">Total Sections</h6>
                                <h2 class="mb-0 text-white">{{ $classes->sum('sections_count') }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-layer-group fa-2x text-info"></i>
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
                                <h6 class="text-white mb-0">Total Students</h6>
                                <h2 class="mb-0 text-white">{{ $classes->sum('students_count') }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-users fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Classes Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Classes List 
                    @if($activeYear)
                        - Academic Year: {{ $activeYear->name }}
                    @endif
                </h5>
            </div>
            <div class="card-body">
                @if($classes->isEmpty())
                    <div class="text-center py-5">
                        <i class="las la-chalkboard text-muted" style="font-size: 48px;"></i>
                        <h5 class="mt-3">No Classes Found</h5>
                        <p class="text-muted">Start by adding your first class</p>
                        <a href="{{ route('classes.create') }}" class="btn btn-primary mt-2">
                            <i class="las la-plus mr-2"></i>Add Class
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Class Name</th>
                                    <th>Academic Year</th>
                                    <th>Sections</th>
                                    <th>Students</th>
                                    <th>Display Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groupedClasses as $category => $categoryClasses)
                                    @if($categoryClasses->isNotEmpty())
                                        <tr class="table-light">
                                            <td colspan="8">
                                                <strong>
                                                    @php
                                                        $categories = [
                                                            'pre-primary' => 'Pre-Primary Section',
                                                            'primary' => 'Primary Section (Class 1-5)',
                                                            'middle' => 'Middle Section (Class 6-8)',
                                                            'secondary' => 'Secondary Section (Class 9-10)',
                                                            'cambridge' => 'Cambridge System (O/A Levels)',
                                                            'other' => 'Other Classes'
                                                        ];
                                                    @endphp
                                                    {{ $categories[$category] ?? ucfirst($category) }}
                                                </strong>
                                            </td>
                                        </tr>
                                        
                                        @foreach($categoryClasses as $class)
                                            <tr class="{{ $class->status !== 'active' ? 'table-secondary' : '' }}">
                                                <td>{{ $class->order_no }}</td>
                                                <td>
                                                    <strong>{{ $class->name }}</strong>
                                                    @if($class->code)
                                                        <div><small class="text-muted">Code: {{ $class->code }}</small></div>
                                                    @endif
                                                    @if($class->min_age && $class->max_age)
                                                        <div><small class="text-muted">Age: {{ $class->min_age }}-{{ $class->max_age }} years</small></div>
                                                    @endif
                                                    @if($class->education_system && $class->education_system !== 'matric')
                                                        <div><small class="text-muted">{{ ucfirst($class->education_system) }} System</small></div>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $class->academicYear->name ?? 'All Years' }}
                                                </td>
                                                <td>
                                                    @if($class->enable_sections)
                                                        <span class="badge badge-info">{{ $class->sections_count }} Sections</span>
                                                    @else
                                                        <span class="badge badge-secondary">No Sections</span>
                                                    @endif
                                                </td>
                                                <td><span class="badge badge-info">{{ $class->students_count }} Students</span></td>
                                                <td>{{ $class->order_no }}</td>
                                                <td>
                                                    @if($class->status === 'active')
                                                        <span class="badge badge-success">Active</span>
                                                    @elseif($class->status === 'inactive')
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @else
                                                        <span class="badge badge-secondary">{{ ucfirst($class->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('classes.show', $class) }}" class="btn btn-sm btn-info mr-2" title="View Details">
                                                            <i class="las la-eye"></i>
                                                        </a>
                                                        <a href="{{ route('classes.edit', $class) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                                            <i class="las la-edit"></i>
                                                        </a>
                                                        
                                                        @if($class->status === 'active' && $class->students_count == 0)
                                                            <form action="{{ route('classes.toggle-status', $class) }}" method="POST" class="mr-2">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-warning" title="Deactivate">
                                                                    <i class="las la-toggle-off"></i>
                                                                </button>
                                                            </form>
                                                        @elseif($class->status === 'inactive')
                                                            <form action="{{ route('classes.toggle-status', $class) }}" method="POST" class="mr-2">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-success" title="Activate">
                                                                    <i class="las la-toggle-on"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        
                                                        @if($class->students_count == 0)
                                                            <form action="{{ route('classes.destroy', $class) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                                        onclick="return confirm('Are you sure you want to delete this class?')">
                                                                    <i class="las la-trash"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-sm btn-danger" title="Delete" disabled>
                                                                <i class="las la-trash"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Deactivation Confirmation Modal -->
    <div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning">
                        <i class="las la-exclamation-triangle mr-2"></i>Deactivate Class
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h6><i class="las la-exclamation-circle mr-2"></i>Warning</h6>
                        <p class="mb-0">You cannot deactivate a class if it contains active students. Please transfer or graduate students first.</p>
                    </div>
                    <p>Are you sure you want to deactivate <strong>Class 1</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning">Deactivate Class</button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <!-- Tooltip Initialization -->
    <script>
        $(function () {
            $('[title]').tooltip();
        });
    </script>
    @endpush
</x-app-layout>
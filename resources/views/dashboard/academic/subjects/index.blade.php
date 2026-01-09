<!-- resources/views/dashboard/academic/subjects/index.blade.php -->
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
                <h4 class="mb-3">Subjects Setup</h4>
                <p class="mb-0">Manage subjects and assign them to different classes</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Academic</a></li>
                        <li class="breadcrumb-item active">Subjects</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('subjects.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-3"></i>Add Subject
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
                <form action="{{ route('subjects.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Search Subject</label>
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Search subject name or code"
                                       value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Subject Type</label>
                                <select name="type" class="form-control">
                                    <option value="">All Types</option>
                                    <option value="theory" {{ request('type') == 'theory' ? 'selected' : '' }}>Theory</option>
                                    <option value="practical" {{ request('type') == 'practical' ? 'selected' : '' }}>Practical</option>
                                    <option value="both" {{ request('type') == 'both' ? 'selected' : '' }}>Both</option>
                                    <option value="project" {{ request('type') == 'project' ? 'selected' : '' }}>Project</option>
                                    <option value="activity" {{ request('type') == 'activity' ? 'selected' : '' }}>Activity</option>
                                </select>
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
                        <div class="col-md-3 d-flex align-items-end">
                            <div class="form-group w-100">
                                <button type="submit" class="btn btn-primary btn-block">Filter</button>
                                @if(request()->hasAny(['search', 'type', 'class_id']))
                                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-block mt-2">
                                        Clear Filters
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Subject Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Subjects</h6>
                                <h2 class="mb-0 text-white">{{ $subjects->count() }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-book-open fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">Active Subjects</h6>
                                <h2 class="mb-0 text-white">{{ $subjects->where('status', 'active')->count() }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-book-reader fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">Practical Subjects</h6>
                                <h2 class="mb-0 text-white">{{ $subjects->where('type', 'practical')->count() }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-flask fa-2x text-info"></i>
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
                                <h6 class="text-white mb-0">Optional Subjects</h6>
                                <h2 class="mb-0 text-white">{{ $subjects->where('is_optional', true)->count() }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-chalkboard-teacher fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subjects Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">All Subjects</h5>
            </div>
            <div class="card-body">
                @if($subjects->isEmpty())
                    <div class="text-center py-5">
                        <i class="las la-book text-muted" style="font-size: 48px;"></i>
                        <h5 class="mt-3">No Subjects Found</h5>
                        <p class="text-muted">Start by adding your first subject</p>
                        <a href="{{ route('subjects.create') }}" class="btn btn-primary mt-2">
                            <i class="las la-plus mr-2"></i>Add Subject
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject Name</th>
                                    <th>Subject Code</th>
                                    <th>Type</th>
                                    <th>Classes Assigned</th>
                                    <th>Teachers</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $categories = [
                                        'language' => 'Language Subjects',
                                        'science' => 'Science & Mathematics',
                                        'social' => 'Social Studies',
                                        'arts' => 'Arts & Creative',
                                        'computer' => 'Computer & IT',
                                        'islamic' => 'Islamic Studies',
                                        'physical' => 'Physical Education',
                                        'vocational' => 'Vocational',
                                        '' => 'Other Subjects'
                                    ];
                                @endphp
                                
                                @foreach($categories as $categoryKey => $categoryTitle)
                                    @php
                                        $categorySubjects = $groupedSubjects->get($categoryKey, collect());
                                    @endphp
                                    
                                    @if($categorySubjects->isNotEmpty())
                                        <tr class="table-light">
                                            <td colspan="8"><strong>{{ $categoryTitle }}</strong></td>
                                        </tr>
                                        
                                        @foreach($categorySubjects as $index => $subject)
                                            @php
                                                $typeBadges = [
                                                    'theory' => 'badge-success',
                                                    'practical' => 'badge-warning',
                                                    'both' => 'badge-info',
                                                    'project' => 'badge-primary',
                                                    'activity' => 'badge-secondary'
                                                ];
                                            @endphp
                                            
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <strong>{{ $subject->name }}</strong>
                                                    @if($subject->short_description)
                                                        <div><small class="text-muted">{{ Str::limit($subject->short_description, 50) }}</small></div>
                                                    @endif
                                                    @if($subject->is_optional)
                                                        <div><small class="text-warning">Optional Subject</small></div>
                                                    @endif
                                                    @if($subject->has_lab)
                                                        <div><small class="text-info"><i class="las la-flask"></i> Lab Included</small></div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge badge-primary">{{ $subject->code }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge {{ $typeBadges[$subject->type] ?? 'badge-secondary' }}">
                                                        {{ ucfirst($subject->type) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="mb-1">
                                                        @if($subject->classes_count > 0)
                                                            @php
                                                                $classNames = $subject->classes->pluck('name')->take(2)->implode(', ');
                                                            @endphp
                                                            <span class="badge badge-info">{{ $subject->classes_count }} Classes</span>
                                                        @else
                                                            <span class="badge badge-secondary">No Classes</span>
                                                        @endif
                                                    </div>
                                                    @if($subject->classes_count > 0)
                                                        <small class="text-muted">{{ $classNames }}{{ $subject->classes_count > 2 ? '...' : '' }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($subject->defaultTeacher)
                                                        <span class="badge badge-secondary">{{ $subject->defaultTeacher->name }}</span>
                                                    @else
                                                        <span class="badge badge-light">No Teacher</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($subject->status === 'active')
                                                        <span class="badge badge-success">Active</span>
                                                    @elseif($subject->status === 'inactive')
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @else
                                                        <span class="badge badge-secondary">{{ ucfirst($subject->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('subjects.show', $subject) }}" 
                                                           class="btn btn-sm btn-info mr-2" title="View Details">
                                                            <i class="las la-eye"></i>
                                                        </a>
                                                        <a href="{{ route('subjects.edit', $subject) }}" 
                                                           class="btn btn-sm btn-primary mr-2" title="Edit">
                                                            <i class="las la-edit"></i>
                                                        </a>
                                                        
                                                        @if($subject->status === 'active' && $subject->exams_count == 0)
                                                            <form action="{{ route('subjects.toggle-status', $subject) }}" 
                                                                  method="POST" class="mr-2">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-warning" 
                                                                        title="Deactivate">
                                                                    <i class="las la-toggle-off"></i>
                                                                </button>
                                                            </form>
                                                        @elseif($subject->status === 'inactive')
                                                            <form action="{{ route('subjects.toggle-status', $subject) }}" 
                                                                  method="POST" class="mr-2">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-success" 
                                                                        title="Activate">
                                                                    <i class="las la-toggle-on"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        
                                                        @if($subject->canBeDeleted())
                                                            <form action="{{ route('subjects.destroy', $subject) }}" 
                                                                  method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                                        title="Delete"
                                                                        onclick="return confirm('Are you sure you want to delete this subject?')">
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
                        <i class="las la-exclamation-triangle mr-2"></i>Deactivate Subject
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h6><i class="las la-exclamation-circle mr-2"></i>Warning</h6>
                        <p class="mb-0">You cannot deactivate a subject if it is linked to active classes or has exam records.</p>
                    </div>
                    <p>Are you sure you want to deactivate <strong>English Language</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning">Deactivate Subject</button>
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
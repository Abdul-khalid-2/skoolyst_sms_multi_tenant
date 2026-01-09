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
                <h4 class="mb-3">Academic Years</h4>
                <p class="mb-0">Manage academic years to organize data year-wise</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Academic</a></li>
                        <li class="breadcrumb-item active">Academic Years</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('academic-years.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-3"></i>Add Academic Year
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

        <!-- Warning Alert -->
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <h6><i class="las la-exclamation-triangle mr-2"></i>Important Rule</h6>
            <p class="mb-0">Only one academic year can be active at a time. Changing the active year will affect all operations.</p>
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Active Year Highlight -->
        @if($activeYear)
        <div class="alert alert-success mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1"><i class="las la-star mr-2"></i>Currently Active Academic Year</h5>
                    <p class="mb-0">{{ $activeYear->name }} ({{ $activeYear->start_date->format('d M Y') }} - {{ $activeYear->end_date->format('d M Y') }})</p>
                </div>
                <span class="badge badge-success badge-pill p-2">Active</span>
            </div>
        </div>
        @endif

        <!-- Academic Years Table -->
        <div class="card">
            <div class="card-body">
                @if($academicYears->isEmpty())
                <div class="text-center py-5">
                    <i class="las la-calendar-times text-muted" style="font-size: 48px;"></i>
                    <h5 class="mt-3">No Academic Years Found</h5>
                    <p class="text-muted">Start by adding your first academic year</p>
                    <a href="{{ route('academic-years.create') }}" class="btn btn-primary mt-2">
                        <i class="las la-plus mr-2"></i>Add Academic Year
                    </a>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Year Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Classes</th>
                                <th>Students</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($academicYears as $index => $year)
                            <tr class="{{ $year->is_active ? 'table-success' : '' }}">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $year->name }}</strong>
                                    @if($year->is_active)
                                    <div><small class="text-muted">Current Academic Session</small></div>
                                    @elseif($year->start_date > now())
                                    <div><small class="text-muted">Upcoming Year</small></div>
                                    @endif
                                </td>
                                <td>{{ $year->start_date->format('d M Y') }}</td>
                                <td>{{ $year->end_date->format('d M Y') }}</td>
                                <td>
                                    @if($year->is_active)
                                    <span class="badge badge-success">Active</span>
                                    <div><small>Since: {{ $year->updated_at->format('d M Y') }}</small></div>
                                    @elseif($year->status == 'archived')
                                    <span class="badge badge-secondary">Archived</span>
                                    @else
                                    <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td><span class="badge badge-info">{{ $year->classes_count ?? 0 }} Classes</span></td>
                                <td><span class="badge badge-info">{{ $year->students_count ?? 0 }} Students</span></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('academic-years.show', $year) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('academic-years.edit', $year) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>

                                        @if(!$year->is_active && $year->status != 'archived')
                                        <form action="{{ route('academic-years.activate', $year) }}" method="POST" class="mr-2">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Set Active"
                                                onclick="return confirm('Are you sure you want to activate this academic year?')">
                                                <i class="las la-toggle-on"></i>
                                            </button>
                                        </form>
                                        @else
                                        <button class="btn btn-sm btn-secondary mr-2" title="Already Active" disabled>
                                            <i class="las la-check-circle"></i>
                                        </button>
                                        @endif

                                        @if($year->status != 'archived' && !$year->is_active)
                                        <form action="{{ route('academic-years.archive', $year) }}" method="POST" class="mr-2">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning" title="Archive"
                                                onclick="return confirm('Are you sure you want to archive this academic year?')">
                                                <i class="las la-archive"></i>
                                            </button>
                                        </form>
                                        @endif

                                        @if($year->students_count == 0 && $year->classes_count == 0)
                                        <form action="{{ route('academic-years.destroy', $year) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this academic year?')">
                                                <i class="las la-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
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
        $(function() {
            $('[title]').tooltip();
        });
    </script>
    @endpush
</x-app-layout>
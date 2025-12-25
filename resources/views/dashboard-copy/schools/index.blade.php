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
            title="School Management"
            subtitle="Manage all schools in your system"
            action="true"
            actionLabel="Add New School"
            actionRoute="{{ route('schools.create') }}"
            actionIcon="las la-plus mr-3"
            :breadcrumbs="[['label' => 'Dashboard', 'url' => route('dashboard')], ['label' => 'Schools']]"
        />

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('schools.index') }}" method="GET" class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Search by School Name</label>
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Enter school name..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status Filter</label>
                            <select name="status" class="form-control">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-group w-100">
                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Schools Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>School Logo</th>
                                <th>School Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Branches Count</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schools as $school)
                            <tr>
                                <td>{{ ($schools->currentPage() - 1) * $schools->perPage() + $loop->iteration }}</td>
                                <td>
                                    @if($school->logo)
                                    <img src="{{ asset('website/' . $school->logo) }}"
                                        alt="{{ $school->name }}"
                                        class="rounded-circle"
                                        width="40" height="40" style="object-fit: cover;">
                                    @else
                                    <div class="avatar-placeholder rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px; background: #f0f0f0;">
                                        <i class="las la-school text-muted"></i>
                                    </div>
                                    @endif
                                </td>
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->email }}</td>
                                <td>{{ $school->phone ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $school->branches_count ?? 0 }}</span>
                                </td>
                                <td>
                                    <span class="badge {{ $school->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                        {{ ucfirst($school->status) }}
                                    </span>
                                </td>
                                <td>{{ $school->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- View -->
                                        <a href="{{ route('schools.show', $school->id) }}"
                                            class="btn btn-sm btn-info mr-2"
                                            data-toggle="tooltip" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        
                                        <!-- Settings -->
                                        <a href="{{ route('schools.settings.show', $school->id) }}"
                                            class="btn btn-sm btn-secondary mr-2"
                                            data-toggle="tooltip" title="Settings">
                                            <i class="las la-cog"></i>
                                        </a>
                                        
                                        <!-- Activation -->
                                        <a href="{{ route('schools.activation', $school->id) }}"
                                            class="btn btn-sm {{ $school->status == 'active' ? 'btn-warning' : 'btn-success' }} mr-2"
                                            data-toggle="tooltip"
                                            title="{{ $school->status == 'active' ? 'Deactivate' : 'Activate' }}">
                                            <i class="las la-power-off"></i>
                                        </a>
                                        
                                        <!-- Edit -->
                                        <a href="{{ route('schools.edit', $school->id) }}"
                                            class="btn btn-sm btn-primary mr-2"
                                            data-toggle="tooltip" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        
                                        <!-- Delete (Soft Delete) -->
                                        <button type="button"
                                            class="btn btn-sm btn-danger"
                                            data-toggle="modal"
                                            data-target="#deleteModal"
                                            data-url="{{ route('schools.destroy', $school->id) }}"
                                            data-name="{{ $school->name }}"
                                            title="Delete">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    <div class="empty-state">
                                        <i class="las la-school fa-3x text-muted mb-3"></i>
                                        <h5>No Schools Found</h5>
                                        <p class="text-muted">Start by adding your first school</p>
                                        <a href="{{ route('schools.create') }}" class="btn btn-primary">
                                            <i class="las la-plus mr-2"></i> Add School
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <!-- Pagination -->
                    @if($schools->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $schools->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <x-confirm-modal 
        id="deleteModal"
        title="Delete School"
        message="Are you sure you want to delete this school? This action can be undone."
        confirmText="Delete"
        cancelText="Cancel"
        confirmColor="danger"
        method="DELETE"
    />

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Tooltip Initialization -->
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
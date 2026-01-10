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
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-3">Student Management</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('students.create') }}" class="btn btn-primary">
                    <i class="las la-plus mr-2"></i>Register New Student
                </a>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Students</h6>
                                <h2 class="mb-0 text-white">{{ $stats['total'] }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-user-graduate fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">Active Students</h6>
                                <h2 class="mb-0 text-white">{{ $stats['active'] }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-user-check fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">New This Month</h6>
                                <h2 class="mb-0 text-white">{{ $stats['new_this_month'] }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-user-plus fa-2x text-info"></i>
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
                                <h6 class="text-white mb-0">Inactive</h6>
                                <h2 class="mb-0 text-white">{{ $stats['inactive'] }}</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-user-slash fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Card -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('students.index') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Search</label>
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Name, Admission No, Phone" 
                                       value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
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
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Section</label>
                                <select name="section_id" class="form-control">
                                    <option value="">All Sections</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}"
                                            {{ request('section_id') == $section->id ? 'selected' : '' }}>
                                            {{ $section->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">All Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="transferred" {{ request('status') == 'transferred' ? 'selected' : '' }}>Transferred</option>
                                    <option value="graduated" {{ request('status') == 'graduated' ? 'selected' : '' }}>Graduated</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
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
                        <div class="col-md-1 d-flex align-items-end">
                            <div class="form-group w-100">
                                <button type="submit" class="btn btn-primary btn-block">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Students Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Students List</h5>
                <div>
                    <a href="{{ route('students.export') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="las la-download mr-1"></i> Export
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($students->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student</th>
                                    <th>Admission No</th>
                                    <th>Roll No</th>
                                    <th>Class/Section</th>
                                    <th>Gender</th>
                                    <th>Guardian</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-md mr-3">
                                                    @if($student->photo)
                                                        <img src="{{ asset('storage/' . $student->photo) }}" 
                                                             class="rounded-circle" alt="{{ $student->full_name }}">
                                                    @else
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($student->full_name) }}&background=007bff&color=fff" 
                                                             class="rounded-circle" alt="{{ $student->full_name }}">
                                                    @endif
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $student->full_name }}</h6>
                                                    <small class="text-muted">DOB: {{ $student->date_of_birth->format('d M Y') }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>{{ $student->admission_no }}</strong>
                                            <div><small class="text-muted">{{ $student->admission_date->format('d M Y') }}</small></div>
                                        </td>
                                        <td>
                                            @if($student->roll_no)
                                                <span class="badge badge-primary">{{ $student->roll_no }}</span>
                                            @else
                                                <span class="badge badge-secondary">Not Assigned</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $student->class->name ?? 'N/A' }}</span>
                                            @if($student->section)
                                                <span class="badge badge-secondary">{{ $student->section->name }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $student->gender == 'male' ? 'badge-primary' : ($student->gender == 'female' ? 'badge-danger' : 'badge-secondary') }}">
                                                {{ ucfirst($student->gender) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($student->guardians->count() > 0)
                                                <div>
                                                    <strong>{{ $student->guardians->first()->first_name }}</strong>
                                                    <div><small>{{ ucfirst($student->guardians->first()->relation) }}</small></div>
                                                </div>
                                            @else
                                                <span class="text-muted">Not Added</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($student->phone)
                                                <small>{{ $student->phone }}</small>
                                            @endif
                                            @if($student->email)
                                                <div><small>{{ $student->email }}</small></div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $student->status == 'active' ? 'badge-success' : ($student->status == 'inactive' ? 'badge-danger' : 'badge-warning') }}">
                                                {{ ucfirst($student->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('students.show', $student) }}" 
                                                   class="btn btn-sm btn-info mr-2" 
                                                   title="View Profile">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a href="{{ route('students.edit', $student) }}" 
                                                   class="btn btn-sm btn-primary mr-2" 
                                                   title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <form action="{{ route('students.destroy', $student) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this student?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger" 
                                                            title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $students->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="las la-user-graduate fa-4x text-muted mb-3"></i>
                        <h5>No Students Found</h5>
                        <p class="text-muted">No students match your search criteria.</p>
                        <a href="{{ route('students.create') }}" class="btn btn-primary">
                            <i class="las la-plus mr-2"></i>Add First Student
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 mb-3">
                                <a href="{{ route('students.create') }}" class="btn btn-primary btn-block">
                                    <i class="las la-user-plus mr-2"></i> New Admission
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#importModal">
                                    <i class="las la-file-import mr-2"></i> Bulk Import
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <a href="{{ route('students.export') }}" class="btn btn-info btn-block">
                                    <i class="las la-file-export mr-2"></i> Export List
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <a href="#" class="btn btn-warning btn-block">
                                    <i class="las la-print mr-2"></i> Print ID Cards
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Students</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Select File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="importFile" name="file" accept=".csv,.xlsx,.xls">
                                <label class="custom-file-label" for="importFile">Choose file</label>
                            </div>
                            <small class="form-text text-muted">
                                Supported formats: CSV, Excel. 
                                <a href="#">Download sample template</a>
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <script>
        $(function () {
            // File input label
            $('.custom-file-input').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });

            // Tooltip initialization
            $('[title]').tooltip();
        });
    </script>
    @endpush
</x-app-layout>
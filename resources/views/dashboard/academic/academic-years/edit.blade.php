<!-- resources/views/dashboard/academic/academic-years/edit.blade.php -->
<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    @endpush

    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Edit Academic Year</h4>
                            <p class="mb-0">Update academic year information</p>
                        </div>
                        <a href="{{ route('academic-years.index') }}" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Back to Academic Years
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('academic-years.update', $academicYear) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <!-- Basic Information -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-calendar-alt mr-2"></i> Year Information
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Year Name *</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                               placeholder="e.g., 2024-2025" required
                                               value="{{ old('name', $academicYear->name) }}">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Short Code</label>
                                        <input type="text" name="code" class="form-control" 
                                               placeholder="e.g., AY24-25"
                                               value="{{ old('code', $academicYear->code) }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date *</label>
                                        <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" 
                                               required value="{{ old('start_date', $academicYear->start_date->format('Y-m-d')) }}">
                                        @error('start_date')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Date *</label>
                                        <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" 
                                               required value="{{ old('end_date', $academicYear->end_date->format('Y-m-d')) }}">
                                        @error('end_date')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Year Settings -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-cog mr-2"></i> Year Settings
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                            <option value="active" {{ old('status', $academicYear->status) == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ old('status', $academicYear->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            <option value="archived" {{ old('status', $academicYear->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <small class="form-text text-muted">
                                            @if($academicYear->is_active)
                                                <span class="text-warning">This is currently active. Changing status will affect system operations.</span>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Optional Description -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-file-alt mr-2"></i> Additional Information
                                    </h5>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="3">{{ old('description', $academicYear->description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Stats -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <h6><i class="las la-info-circle mr-2"></i> Year Statistics</h6>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <small>Students: {{ $academicYear->students_count ?? 0 }}</small>
                                            </div>
                                            <div class="col-md-3">
                                                <small>Classes: {{ $academicYear->classes_count ?? 0 }}</small>
                                            </div>
                                            <div class="col-md-3">
                                                <small>Created: {{ $academicYear->created_at->format('d M Y') }}</small>
                                            </div>
                                            <div class="col-md-3">
                                                <small>Updated: {{ $academicYear->updated_at->format('d M Y') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="las la-save mr-2"></i> Update Academic Year
                                    </button>
                                    <a href="{{ route('academic-years.index') }}" class="btn btn-secondary">
                                        <i class="las la-times mr-2"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Date Validation -->
    <script>
        $(document).ready(function() {
            // Validate end date is after start date
            $('input[name="end_date"]').on('change', function() {
                var startDate = new Date($('input[name="start_date"]').val());
                var endDate = new Date($(this).val());
                
                if (endDate <= startDate) {
                    alert('End date must be after start date');
                    $(this).val('');
                }
            });
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
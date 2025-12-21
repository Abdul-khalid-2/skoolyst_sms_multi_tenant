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
                            <h4 class="card-title">Edit School</h4>
                        </div>
                        <a href="{{ route('schools.index') }}" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Back to Schools
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('schools.update', $school->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <!-- General Information -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-info-circle mr-2"></i> General Information
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>School Name *</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                               placeholder="Enter school name" value="{{ old('name', $school->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address *</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                               placeholder="Enter school email" value="{{ old('email', $school->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                               placeholder="Enter phone number" value="{{ old('phone', $school->phone) }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                                            <option value="active" {{ old('status', $school->status) == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ old('status', $school->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" 
                                                  rows="3" placeholder="Enter school address">{{ old('address', $school->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>School Logo</label>
                                        
                                        @if($school->logo)
                                            <div class="mb-3">
                                                <p class="mb-1">Current Logo:</p>
                                                <img src="{{ asset('storage/' . $school->logo) }}" 
                                                     alt="{{ $school->name }}" 
                                                     class="img-thumbnail" 
                                                     style="max-width: 150px;">
                                            </div>
                                        @endif
                                        
                                        <div class="custom-file">
                                            <input type="file" name="logo" class="custom-file-input @error('logo') is-invalid @enderror" 
                                                   id="logo" accept="image/*">
                                            <label class="custom-file-label" for="logo">Choose new logo (optional)</label>
                                            @error('logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted">
                                            Leave empty to keep current logo. Recommended size: 200x200 pixels. Max size: 2MB
                                        </small>
                                        <div id="logo-preview" class="mt-3"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="las la-save mr-2"></i> Update School
                                    </button>
                                    <a href="{{ route('schools.index') }}" class="btn btn-danger">
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
    
    <!-- File Input Preview -->
    <script>
        // File input label
        $('#logo').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
            
            // Image preview
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#logo-preview').html(
                        '<div class="alert alert-info">' +
                        '<h6>New Logo Preview:</h6>' +
                        '<img src="' + e.target.result + '" class="img-thumbnail mt-2" style="max-width: 200px;">' +
                        '</div>'
                    );
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
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
                                        <label>School Email *</label>
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
                                                <img src="{{ asset('website/' . $school->logo) }}" 
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
                            
                            <!-- Admin Account Information -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 text-primary">
                                        <i class="las la-user-shield mr-2"></i> School Admin Account
                                    </h5>
                                </div>
                                
                                @php
                                    $adminUser = $school->users()->role('admin')->first();
                                @endphp
                                
                                @if($adminUser)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Admin Name *</label>
                                            <input type="text" name="admin_name" class="form-control @error('admin_name') is-invalid @enderror" 
                                                   placeholder="Enter admin name" value="{{ old('admin_name', $adminUser->name) }}" required>
                                            @error('admin_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Admin Email *</label>
                                            <input type="email" name="admin_email" class="form-control @error('admin_email') is-invalid @enderror" 
                                                   placeholder="Enter admin email" value="{{ old('admin_email', $adminUser->email) }}" required>
                                            @error('admin_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Admin Status</label>
                                            <select name="admin_status" class="form-control @error('admin_status') is-invalid @enderror">
                                                <option value="active" {{ old('admin_status', $adminUser->status) == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ old('admin_status', $adminUser->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('admin_status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Admin Phone</label>
                                            <input type="text" name="admin_phone" class="form-control @error('admin_phone') is-invalid @enderror" 
                                                   placeholder="Enter admin phone" value="{{ old('admin_phone', $adminUser->phone) }}">
                                            @error('admin_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Change Password (Optional)</label>
                                            <div class="input-group">
                                                <input type="password" name="admin_password" class="form-control @error('admin_password') is-invalid @enderror" 
                                                       placeholder="Enter new password (leave empty to keep current)">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                        <i class="las la-eye"></i>
                                                    </button>
                                                </div>
                                                @error('admin_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="form-text text-muted">
                                                Leave empty to keep current password. Minimum 8 characters.
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" name="admin_password_confirmation" class="form-control" 
                                                   placeholder="Confirm new password">
                                        </div>
                                    </div>
                                    
                                @else
                                    <div class="col-md-12 mb-3">
                                        <div class="alert alert-warning">
                                            <strong>No admin account found for this school.</strong>
                                            <p class="mb-0 mt-2">Create a new admin account:</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Admin Name *</label>
                                            <input type="text" name="admin_name" class="form-control @error('admin_name') is-invalid @enderror" 
                                                   placeholder="Enter admin name" value="{{ old('admin_name', 'School Admin - ' . $school->name) }}" required>
                                            @error('admin_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Admin Email *</label>
                                            <input type="email" name="admin_email" class="form-control @error('admin_email') is-invalid @enderror" 
                                                   placeholder="Enter admin email" value="{{ old('admin_email', $school->email) }}" required>
                                            @error('admin_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Admin Phone</label>
                                            <input type="text" name="admin_phone" class="form-control @error('admin_phone') is-invalid @enderror" 
                                                   placeholder="Enter admin phone" value="{{ old('admin_phone', $school->phone) }}">
                                            @error('admin_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password *</label>
                                            <div class="input-group">
                                                <input type="password" name="admin_password" class="form-control @error('admin_password') is-invalid @enderror" 
                                                       placeholder="Enter password" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                        <i class="las la-eye"></i>
                                                    </button>
                                                </div>
                                                @error('admin_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="form-text text-muted">Minimum 8 characters</small>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Confirm Password *</label>
                                            <input type="password" name="admin_password_confirmation" class="form-control @error('admin_password') is-invalid @enderror" 
                                                   placeholder="Confirm password" required>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="create_admin" value="1">
                                @endif
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="las la-save mr-2"></i> Update School & Admin
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
        
        // Toggle password visibility
        $('#togglePassword').on('click', function() {
            const passwordInput = $(this).closest('.input-group').find('input[name*="password"]');
            const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
            passwordInput.attr('type', type);
            
            // Toggle eye icon
            const eyeIcon = $(this).find('i');
            if (type === 'text') {
                eyeIcon.removeClass('la-eye').addClass('la-eye-slash');
            } else {
                eyeIcon.removeClass('la-eye-slash').addClass('la-eye');
            }
        });
    </script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>
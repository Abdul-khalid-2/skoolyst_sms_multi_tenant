<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Branch;
use App\Models\User;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = School::withCount(['branches', 'users']);

        // Search filter
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
        }

        // Status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Get paginated results
        $schools = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.schools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchoolRequest $request)
    {
        try {
            $validatedData = $request->validated();

            // Generate slug
            $slug = Str::slug($validatedData['name']);
            $validatedData['slug'] = $slug . '-' . Str::random(6);

            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Create folder path: {slug}/images/
                $folderPath = $slug . '/images';

                // Generate unique filename
                $filename = 'logo-' . time() . '.' . $request->file('logo')->getClientOriginalExtension();

                // Full path including filename
                $fullPath = $folderPath . '/' . $filename;

                // Store file using Storage::put() method (like S3 example)
                Storage::disk('website')->put(
                    $fullPath, // Path: school-name/images/logo-timestamp.jpg
                    file_get_contents($request->file('logo')->getRealPath())
                );

                // Store relative path in database
                $validatedData['logo'] = $fullPath; // school-name/images/logo-1234567890.jpg
            }

            $school = School::create($validatedData);

            // Create default branch
            $branch = Branch::create([
                'school_id' => $school->id,
                'name' => 'Main Campus',
                'phone' => $school->phone,
                'address' => $school->address,
                'status' => 'active'
            ]);

            // ======================================
            // NEW CODE: Create School Admin User
            // ======================================

            // Check if email already exists in users table
            $existingUser = User::where('email', $school->email)->first();

            if ($existingUser) {
                // Email already exists, update the user with school info
                $existingUser->update([
                    'school_id' => $school->id,
                    'branch_id' => $branch->id,
                    'name' => 'School Admin - ' . $school->name,
                    'status' => 'active'
                ]);
                $user = $existingUser;
            } else {
                // Create new admin user
                $user = User::create([
                    'name' => 'School Admin - ' . $school->name,
                    'email' => $school->email,
                    'password' => Hash::make('password123'), // Default password
                    'school_id' => $school->id,
                    'branch_id' => $branch->id,
                    'phone' => $school->phone,
                    'address' => $school->address,
                    'status' => 'active'
                ]);
            }

            // Remove any existing roles (clean slate)
            $user->assignRole('admin');



            return redirect()->route('schools.index')
                ->with('success', 'School created successfully! School admin user has been created with default password: password123');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating school: ' . $e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(School $school)
    {
        // Load counts
        $school->loadCount([
            'branches',
            'users',
            'users as active_users_count' => function ($query) {
                $query->where('status', 'active');
            },
            'users as inactive_users_count' => function ($query) {
                $query->where('status', 'inactive');
            }
        ]);

        return view('dashboard.schools.show', compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school)
    {
        return view('dashboard.schools.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolRequest $request, School $school)
    {
        try {
            $validatedData = $request->validated();

            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($school->logo && Storage::disk('website')->exists($school->logo)) {
                    Storage::disk('website')->delete($school->logo);
                }

                // Get school slug (without random part)
                $slug = explode('-', $school->slug)[0];

                // Folder path: {slug}/images/
                $folderPath = $slug . '/images';

                // Generate unique filename
                $filename = 'logo-' . time() . '.' . $request->file('logo')->getClientOriginalExtension();

                // Full path including filename
                $fullPath = $folderPath . '/' . $filename;

                // Store file using Storage::put() method
                Storage::disk('website')->put(
                    $fullPath,
                    file_get_contents($request->file('logo')->getRealPath())
                );

                // Save path in DB
                $validatedData['logo'] = $fullPath;
            }

            $school->update($validatedData);

            // Handle admin account update/creation
            $adminUser = $school->users()->whereHas('roles', function ($q) use ($school) {
                $q->where('name', 'school_' . $school->id . '_admin');
            })->first();

            if ($adminUser) {
                // Update existing admin
                $adminData = [
                    'name' => $request->input('admin_name'),
                    'email' => $request->input('admin_email'),
                    'status' => $request->input('admin_status', $adminUser->status),
                    'phone' => $request->input('admin_phone', $adminUser->phone),
                    'address' => $school->address,
                ];

                // Update password if provided
                if ($request->filled('admin_password')) {
                    $adminData['password'] = Hash::make($request->input('admin_password'));
                }

                $adminUser->update($adminData);
            } else {
                // Create new admin if doesn't exist
                $branch = $school->branches()->first();

                $newAdmin = User::create([
                    'name' => $request->input('admin_name'),
                    'email' => $request->input('admin_email'),
                    'password' => Hash::make($request->input('admin_password')),
                    'school_id' => $school->id,
                    'branch_id' => $branch ? $branch->id : null,
                    'phone' => $request->input('admin_phone', $school->phone),
                    'address' => $school->address,
                    'status' => 'active'
                ]);

                // Create roles if they don't exist
                $this->createSchoolRoles($school->id);

                // Assign admin role
                $schoolAdminRole = Role::where('name', "school_{$school->id}_admin")->first();
                if ($schoolAdminRole) {
                    $newAdmin->assignRole($schoolAdminRole);
                }
            }

            return redirect()->route('schools.index')
                ->with('success', 'School and admin account updated successfully!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error updating school: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        try {
            // Check if school has users or branches
            if ($school->users()->count() > 0 || $school->branches()->count() > 1) {
                return redirect()->route('schools.index')
                    ->with('error', 'Cannot delete school with active users or multiple branches.');
            }

            // Delete logo if exists
            if ($school->logo && Storage::disk('public')->exists($school->logo)) {
                Storage::disk('public')->delete($school->logo);
            }

            $school->delete();

            return redirect()->route('schools.index')
                ->with('success', 'School deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('schools.index')
                ->with('error', 'Error deleting school: ' . $e->getMessage());
        }
    }

    /**
     * Show school activation page.
     */
    public function activation(School $school)
    {
        return view('dashboard.schools.activation', compact('school'));
    }

    /**
     * Update school activation status.
     */
    public function updateActivation(Request $request, School $school)
    {
        $request->validate([
            'status' => 'required|in:active,inactive'
        ]);

        try {
            $oldStatus = $school->status;
            $newStatus = $request->status;

            $school->update(['status' => $newStatus]);

            // Update all users status if needed
            if ($oldStatus !== $newStatus) {
                $school->users()->update(['status' => $newStatus]);
            }

            $statusText = $newStatus == 'active' ? 'activated' : 'deactivated';

            return redirect()->route('schools.activation', $school)
                ->with('success', "School {$statusText} successfully!");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating school status: ' . $e->getMessage());
        }
    }
}

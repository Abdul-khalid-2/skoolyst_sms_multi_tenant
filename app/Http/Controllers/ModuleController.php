<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\SchoolModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::with(['schoolModules' => function ($query) {
            $query->where('school_id', auth()->user()->school_id);
        }])->orderBy('order')->get();

        // Get assigned permissions for the current school/user
        $assignedPermissions = [];
        foreach ($modules as $module) {
            if ($module->permission_list) {
                $assignedPermissions[$module->id] = $this->getAssignedPermissions($module->id);
            }
        }

        return view('dashboard.settings.modules', compact('modules', 'assignedPermissions'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'action' => 'required|in:enable,disable'
        ]);

        DB::beginTransaction();
        try {
            $module = Module::findOrFail($request->module_id);

            // Check if it's a core module
            if ($module->is_core && $request->action == 'disable') {
                return response()->json([
                    'success' => false,
                    'message' => 'Core modules cannot be disabled'
                ], 400);
            }

            $schoolModule = SchoolModule::firstOrCreate([
                'school_id' => auth()->user()->school_id,
                'module_id' => $module->id
            ]);

            $schoolModule->is_active = $request->action == 'enable';

            if ($request->action == 'enable') {
                $schoolModule->activated_at = now();
                $schoolModule->deactivated_at = null;
            } else {
                $schoolModule->deactivated_at = now();
            }

            $schoolModule->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Module ' . ($request->action == 'enable' ? 'enabled' : 'disabled') . ' successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update module status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function settings(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id'
        ]);

        $module = Module::findOrFail($request->module_id);
        $schoolModule = SchoolModule::firstOrCreate([
            'school_id' => auth()->user()->school_id,
            'module_id' => $module->id
        ], [
            'is_active' => $module->is_active,
            'settings' => [],
            'permissions' => []
        ]);

        // Get settings with safe defaults
        $settings = $schoolModule->settings ?? [];

        // Ensure submodules is an array
        if (isset($settings['submodules']) && !is_array($settings['submodules'])) {
            $settings['submodules'] = [];
        }

        // Ensure permissions is an array
        if (isset($settings['permissions']) && !is_array($settings['permissions'])) {
            $settings['permissions'] = [];
        }

        $html = view('dashboard.settings.settings-form', compact('module', 'schoolModule', 'settings'))->render();

        return response()->json([
            'html' => $html,
            'updateUrl' => route('modules.update-settings', $module->id)
        ]);
    }

    public function updateSettings(Request $request, $id)
    {
        $request->validate([
            'settings' => 'nullable|array'
        ]);

        $schoolModule = SchoolModule::where([
            'school_id' => auth()->user()->school_id,
            'module_id' => $id
        ])->firstOrFail();

        $schoolModule->settings = $request->settings;
        $schoolModule->save();

        return response()->json([
            'success' => true,
            'message' => 'Module settings updated successfully'
        ]);
    }

    public function updatePermissions(Request $request)
    {
        $request->validate([
            'permissions' => 'nullable|array'
        ]);

        // Here you would sync permissions with roles
        // This is a simplified version - you might need to adjust based on your permission system
        $permissions = $request->permissions ?? [];

        // Example: Sync permissions for admin role
        // $adminRole = Role::where('name', 'admin')->first();
        // $adminRole->syncPermissions($this->flattenPermissions($permissions));

        return response()->json([
            'success' => true,
            'message' => 'Permissions updated successfully'
        ]);
    }

    public function install(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:modules,code',
            'name' => 'required|string',
            'type' => 'required|in:module,core,premium,addon,plugin',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'route' => 'nullable|string',
            'permissions' => 'nullable|string',
            'is_core' => 'boolean',
            'is_active' => 'boolean',
            'module_file' => 'nullable|file|mimes:zip|max:51200'
        ]);

        DB::beginTransaction();
        try {
            $module = Module::create([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'icon' => $request->icon ?? 'las la-cube',
                'route' => $request->route,
                'is_core' => $request->type == 'core',
                'is_active' => $request->is_active ?? true,
                'permissions' => $this->parsePermissions($request->permissions),
                'order' => Module::max('order') + 1
            ]);

            // Create school module entry for current school
            if (auth()->user()->school_id) {
                SchoolModule::create([
                    'school_id' => auth()->user()->school_id,
                    'module_id' => $module->id,
                    'is_active' => $request->is_active ?? true,
                    'activated_at' => $request->is_active ? now() : null
                ]);
            }

            // Handle file upload if provided
            if ($request->hasFile('module_file')) {
                $this->handleModuleUpload($request->file('module_file'), $module);
            }

            DB::commit();

            return redirect()->route('modules.index')
                ->with('success', 'Module installed successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to install module: ' . $e->getMessage())
                ->withInput();
        }
    }

    private function getAssignedPermissions($moduleId)
    {
        // Implement based on your permission system
        // This is a placeholder - adjust according to your setup
        return [];
    }

    private function parsePermissions($permissionsText)
    {
        if (empty($permissionsText)) {
            return null;
        }

        $permissions = array_filter(
            array_map('trim', explode("\n", $permissionsText))
        );

        return array_values($permissions);
    }

    private function handleModuleUpload($file, $module)
    {
        // Implement module file extraction and handling
        // This could extract files to specific directories, run migrations, etc.
        $filename = $module->code . '_' . time() . '.zip';
        $path = $file->storeAs('modules', $filename, 'local');

        // Extract and process the module
        // $zip = new \ZipArchive();
        // if ($zip->open(storage_path('app/' . $path)) === TRUE) {
        //     $zip->extractTo(base_path('modules/' . $module->code));
        //     $zip->close();
        // }

        // You might also want to run migrations or seeders if included
    }

    private function flattenPermissions($permissionsArray)
    {
        $flattened = [];
        foreach ($permissionsArray as $moduleId => $permissions) {
            if (is_array($permissions)) {
                $flattened = array_merge($flattened, $permissions);
            }
        }
        return $flattened;
    }
}

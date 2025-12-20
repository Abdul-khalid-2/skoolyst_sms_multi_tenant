<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\School;
use App\Models\SchoolModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ModuleController extends Controller
{
    // Show module settings for a school
    public function index(School $school = null)
    {
        // If no school specified, use current user's school
        $school = $school ?? auth()->user()->school;

        $allModules = Module::where('is_active', true)->orderBy('order')->get();
        $schoolModules = $school->schoolModules()->with('module')->get()->keyBy('module_id');

        return view('modules.index', compact('allModules', 'school', 'schoolModules'));
    }

    // Toggle module for school
    public function toggle(Request $request, School $school)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'status' => 'required|boolean',
        ]);

        $module = Module::findOrFail($request->module_id);

        // Check if module is core (cannot be disabled)
        if ($module->is_core && !$request->status) {
            return response()->json([
                'success' => false,
                'message' => 'Core modules cannot be disabled'
            ], 422);
        }

        $schoolModule = SchoolModule::updateOrCreate(
            [
                'school_id' => $school->id,
                'module_id' => $module->id,
            ],
            [
                'is_active' => $request->status,
                'activated_at' => $request->status ? now() : null,
                'deactivated_at' => $request->status ? null : now(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => $request->status
                ? "{$module->name} module activated for {$school->name}"
                : "{$module->name} module deactivated for {$school->name}",
            'data' => $schoolModule
        ]);
    }

    // Update module settings for school
    public function updateSettings(Request $request, School $school, Module $module)
    {
        $request->validate([
            'settings' => 'nullable|array',
        ]);

        $schoolModule = SchoolModule::firstOrCreate(
            [
                'school_id' => $school->id,
                'module_id' => $module->id,
            ]
        );

        $schoolModule->update([
            'settings' => array_merge($schoolModule->settings ?? [], $request->settings)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Module settings updated',
            'data' => $schoolModule
        ]);
    }

    // Get available modules for school
    public function getAvailableModules(School $school)
    {
        $modules = Module::where('is_active', true)
            ->with(['schoolModules' => function ($query) use ($school) {
                $query->where('school_id', $school->id);
            }])
            ->orderBy('order')
            ->get()
            ->map(function ($module) {
                return [
                    'id' => $module->id,
                    'code' => $module->code,
                    'name' => $module->name,
                    'description' => $module->description,
                    'icon' => $module->icon,
                    'is_core' => $module->is_core,
                    'is_active' => $module->schoolModules->first()->is_active ?? false,
                    'activated_at' => $module->schoolModules->first()->activated_at ?? null,
                    'settings' => $module->schoolModules->first()->settings ?? [],
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $modules
        ]);
    }
}

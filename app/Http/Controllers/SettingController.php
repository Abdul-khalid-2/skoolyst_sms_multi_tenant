<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schoolId = Auth::user()->school_id;

        // Get all settings for the school
        $settings = Setting::where('school_id', $schoolId)->get();

        // Get school info
        $school = School::find($schoolId);

        // Group settings by category
        $groupedSettings = [];
        foreach ($settings as $setting) {
            // Extract the actual value from the array
            $value = $setting->value;

            // Check if the value is JSON encoded
            if (is_string($value) && json_decode($value) !== null) {
                $value = json_decode($value, true);
            }

            // If value is an array, extract the first value
            if (is_array($value) && !empty($value)) {
                $value = reset($value); // Get first element
            }

            // Parse the key to get category and field name
            $keyParts = explode('_', $setting->key, 2);

            if (count($keyParts) === 2) {
                $category = $keyParts[0]; // e.g., "general"
                $field = $keyParts[1];    // e.g., "school_name"
                $groupedSettings[$category][$field] = $value;
            } else {
                // If no underscore found, use as-is
                $groupedSettings['other'][$setting->key] = $value;
            }
        }


        return view('dashboard.settings.school', compact('groupedSettings', 'school'));
    }

    /**
     * Save all settings
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $schoolId = Auth::user()->school_id;

        try {
            DB::beginTransaction();

            // Process all form data
            foreach ($request->all() as $key => $value) {
                // Skip CSRF token and non-setting fields
                if ($key === '_token' || $key === '_method') {
                    continue;
                }

                // Check if it's a setting field (starts with setting_)
                if (str_starts_with($key, 'setting_')) {
                    $settingKey = str_replace('setting_', '', $key);

                    Setting::updateOrCreate(
                        [
                            'school_id' => $schoolId,
                            'key' => $settingKey
                        ],
                        [
                            'value' => $value ?: ''
                        ]
                    );
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Settings saved successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error saving settings: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Save specific category settings
     */
    public function updateCategory(Request $request, $category)
    {
        $schoolId = Auth::user()->school_id;

        try {
            DB::beginTransaction();

            foreach ($request->except('_token') as $key => $value) {
                Setting::updateOrCreate(
                    [
                        'school_id' => $schoolId,
                        'key' => $category . '.' . $key
                    ],
                    [
                        'value' => $value ?: ''
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => ucfirst($category) . ' settings saved successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error saving settings: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle file uploads
     */
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,ico|max:2048',
            'type' => 'required|in:logo,favicon'
        ]);

        $schoolId = Auth::user()->school_id;
        $file = $request->file('file');
        $fileName = $request->type . '_' . time() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/settings', $fileName);

        // Remove 'public/' from path for database storage
        $dbPath = str_replace('public/', '', $filePath);

        // Save to settings table
        $key = 'general.' . $request->type;
        Setting::updateOrCreate(
            [
                'school_id' => $schoolId,
                'key' => $key
            ],
            [
                'value' => $dbPath
            ]
        );

        return response()->json([
            'success' => true,
            'file_path' => Storage::url($filePath)
        ]);
    }

    /**
     * Export settings
     */
    public function export()
    {
        $schoolId = Auth::user()->school_id;
        $settings = Setting::where('school_id', $schoolId)->get();

        return response()->json($settings);
    }

    /**
     * Reset settings to default
     */
    public function reset()
    {
        $schoolId = Auth::user()->school_id;
        Setting::where('school_id', $schoolId)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Settings reset to default successfully!'
        ]);
    }
}

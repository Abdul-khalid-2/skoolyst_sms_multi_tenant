<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolSettingsController extends Controller
{
    /**
     * Display school settings.
     */
    public function show(School $school)
    {
        $schoolId = $school->id;

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
        return view('dashboard.schools.settings', compact('school', 'groupedSettings'));
    }

    /**
     * Update school settings.
     */
    public function update(Request $request, School $school)
    {

        $schoolId = $school->id;

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
}

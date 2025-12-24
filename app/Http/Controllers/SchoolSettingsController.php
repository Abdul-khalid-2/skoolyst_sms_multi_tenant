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
        // Get all settings for this school
        $settings = Setting::where('school_id', $school->id)
            ->pluck('value', 'key')
            ->toArray();

        // Default settings if not exists
        $defaultSettings = [
            'current_academic_year' => date('Y') . '-' . (date('Y') + 1),
            'default_class' => '1st',
            'timezone' => 'Asia/Karachi',
            'currency' => 'PKR',
            'date_format' => 'd/m/Y',
            'time_format' => '12',
            'grading_system' => 'percentage',
            'passing_percentage' => '40',
            'enable_attendance' => '0',
            'enable_exams' => '0',
            'fee_due_days' => '10',
            'late_fee_amount' => '500',
            'late_fee_type' => 'fixed',
            'enable_partial_payment' => '0',
            'enable_online_payment' => '0',
            'enable_fee_waiver' => '0',
            'enable_sibling_discount' => '0',
            'enable_early_payment_discount' => '0',
            'enable_scholarship' => '0',
            'enable_parent_portal' => '0',
            'enable_student_portal' => '0',
            'enable_sms_notifications' => '0',
            'enable_teacher_portal' => '0',
            'enable_attendance_tracking' => '0',
            'enable_library' => '0',
            'enable_inventory' => '0',
            'enable_transport' => '0',
            'enable_two_factor' => '0',
            'enable_audit_log' => '0',
            'primary_color' => '#007bff',
            'secondary_color' => '#6c757d',
            'session_timeout' => '30',
            'max_login_attempts' => '5',
        ];

        // Merge with existing settings
        $settings = array_merge($defaultSettings, $settings);

        return view('dashboard.schools.settings', compact('school', 'settings'));
    }

    /**
     * Update school settings.
     */
    public function update(Request $request, School $school)
    {
        try {
            DB::beginTransaction();

            $allSettings = $request->except(['_token', '_method']);

            // Define all checkbox fields with their default values (0 for unchecked)
            $checkboxFields = [
                'enable_attendance',
                'enable_exams',
                'enable_partial_payment',
                'enable_online_payment',
                'enable_fee_waiver',
                'enable_sibling_discount',
                'enable_early_payment_discount',
                'enable_scholarship',
                'enable_parent_portal',
                'enable_student_portal',
                'enable_sms_notifications',
                'enable_teacher_portal',
                'enable_attendance_tracking',
                'enable_library',
                'enable_inventory',
                'enable_transport',
                'enable_two_factor',
                'enable_audit_log'
            ];

            // Initialize all checkbox fields to '0' first
            foreach ($checkboxFields as $field) {
                $allSettings[$field] = '0';
            }

            // Now override with submitted values if they exist
            foreach ($request->all() as $key => $value) {
                if (in_array($key, $checkboxFields)) {
                    $allSettings[$key] = $value == '1' ? '1' : '0';
                }
            }

            // Handle terms array
            if ($request->has('terms')) {
                $allSettings['terms'] = json_encode($request->terms);
            } else {
                $allSettings['terms'] = json_encode([]);
            }

            // Save all settings
            foreach ($allSettings as $key => $value) {
                // Convert arrays to JSON
                if (is_array($value)) {
                    $value = json_encode($value);
                }

                Setting::updateOrCreate(
                    [
                        'school_id' => $school->id,
                        'key' => $key
                    ],
                    ['value' => $value]
                );
            }

            DB::commit();

            return redirect()->route('schools.settings.show', $school)
                ->with('success', 'Settings updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Error updating settings: ' . $e->getMessage());
        }
    }
}

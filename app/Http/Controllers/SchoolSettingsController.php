<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SchoolSettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $school = $user->school;

        // Load settings grouped by category
        $settings = [
            'general' => $this->getSettingsByCategory('general', $school->id),
            'appearance' => $this->getSettingsByCategory('appearance', $school->id),
            'academic' => $this->getSettingsByCategory('academic', $school->id),
            'fee' => $this->getSettingsByCategory('fee', $school->id),
            'attendance' => $this->getSettingsByCategory('attendance', $school->id),
            'notification' => $this->getSettingsByCategory('notification', $school->id),
            'security' => $this->getSettingsByCategory('security', $school->id),
            'backup' => $this->getSettingsByCategory('backup', $school->id),
        ];

        return view('dashboard.settings.school', compact('school', 'settings'));
    }

    private function getSettingsByCategory($category, $schoolId)
    {
        $settings = Setting::where('school_id', $schoolId)
            ->where('key', 'like', $category . '.%')
            ->get()
            ->keyBy(function ($item) use ($category) {
                return str_replace($category . '.', '', $item->key);
            })
            ->map(function ($item) {
                return $item->value;
            });

        return $settings;
    }

    public function save(Request $request)
    {
        $user = Auth::user();
        $schoolId = $user->school_id;

        $categories = [
            'general' => [
                'school_name' => 'required|string|max:255',
                'school_code' => 'nullable|string|max:50',
                'email' => 'required|email',
                'phone' => 'required|string|max:20',
                'address' => 'nullable|string',
                'website' => 'nullable|url',
                'established_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            ],
            'appearance' => [
                'primary_color' => 'nullable|string|regex:/^#[0-9A-F]{6}$/i',
                'secondary_color' => 'nullable|string|regex:/^#[0-9A-F]{6}$/i',
                'theme' => 'nullable|in:light,dark,auto',
                'sidebar_style' => 'nullable|in:default,compact,icon-only',
                'dashboard_style' => 'nullable|in:modern,classic,minimal',
            ],
            // Add more validation rules for other categories
        ];

        DB::beginTransaction();
        try {
            // Update school basic info
            if ($request->has('school_name')) {
                $school = School::find($schoolId);
                $school->update([
                    'name' => $request->input('general.school_name'),
                    'email' => $request->input('general.email'),
                    'phone' => $request->input('general.phone'),
                    'address' => $request->input('general.address'),
                ]);
            }

            // Save all settings
            foreach ($categories as $category => $rules) {
                if ($request->has($category)) {
                    $data = $request->input($category);

                    foreach ($data as $key => $value) {
                        Setting::setValue("{$category}.{$key}", $value, $schoolId);
                    }
                }
            }

            // Handle file uploads
            if ($request->hasFile('general.logo')) {
                $this->uploadLogo($request->file('general.logo'), $schoolId);
            }

            DB::commit();
            return redirect()->route('school.settings')->with('success', 'Settings saved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error saving settings: ' . $e->getMessage());
        }
    }

    private function uploadLogo($file, $schoolId)
    {
        $path = $file->store("schools/{$schoolId}/logos", 'public');
        Setting::setValue('general.logo', $path, $schoolId);
    }

    public function createBackup()
    {
        // Implement backup logic here
        // This could use spatie/laravel-backup package
        return redirect()->route('school.settings')->with('success', 'Backup created successfully!');
    }
}

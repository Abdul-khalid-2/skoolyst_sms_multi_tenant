<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\School;

class DefaultSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all schools or create one for testing
        $schools = School::all();

        if ($schools->isEmpty()) {
            $school = School::create([
                'name' => 'Default School',
                'slug' => 'default-school',
                'email' => 'admin@school.com',
                'status' => 'active'
            ]);
            $schools = collect([$school]);
        }

        $defaultSettings = [
            'general' => [
                'school_name' => 'Bright Future School',
                'school_code' => 'BFS001',
                'email' => 'info@brightfuture.edu.pk',
                'phone' => '+92 300 1234567',
                'address' => '123 Education Street, Lahore, Pakistan',
                'website' => 'https://www.brightfuture.edu.pk',
                'established_year' => '2010',
            ],
            'appearance' => [
                'primary_color' => '#007bff',
                'secondary_color' => '#6c757d',
                'success_color' => '#28a745',
                'danger_color' => '#dc3545',
                'theme' => 'light',
                'sidebar_style' => 'default',
                'dashboard_style' => 'modern',
                'fixed_header' => '1',
                'fixed_sidebar' => '1',
                'show_breadcrumb' => '1',
                'animations' => '1',
            ],
        ];

        foreach ($schools as $school) {
            foreach ($defaultSettings as $category => $settings) {
                foreach ($settings as $key => $value) {
                    Setting::updateOrCreate(
                        [
                            'school_id' => $school->id,
                            'key' => $category . '_' . $key
                        ],
                        [
                            'value' => $value
                        ]
                    );
                }
            }
        }

        $this->command->info('Default settings seeded for all schools.');
    }
}

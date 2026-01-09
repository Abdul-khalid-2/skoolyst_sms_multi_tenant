<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Clazz;
use App\Models\AcademicYear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionSetupController extends Controller
{
    public function index()
    {
        $academicYears = AcademicYear::currentSchool()->get();
        $activeYear = AcademicYear::getActive();

        // Get classes that have sections enabled
        $classes = Clazz::with(['sections' => function ($query) {
            $query->withCount('students');
        }])
            ->withCount(['sections', 'students'])
            ->where('school_id', auth()->user()->school_id)
            ->where('enable_sections', true)
            ->where('status', 'active')
            ->orderBy('order_no')
            ->get();

        // Get all teachers for dropdown
        $teachers = User::where('school_id', auth()->user()->school_id)
            ->whereHas('roles', function ($q) {
                $q->where('name', 'teacher');
            })
            ->get();

        return view('dashboard.academic.sections.index', compact(
            'classes',
            'academicYears',
            'activeYear',
            'teachers'
        ));
    }

    public function create()
    {
        $academicYears = AcademicYear::currentSchool()->get();

        // Get only classes that have sections enabled
        $classes = Clazz::where('school_id', auth()->user()->school_id)
            ->where('enable_sections', true)
            ->where('status', 'active')
            ->orderBy('order_no')
            ->get();

        // Get teachers
        $teachers = User::where('school_id', auth()->user()->school_id)
            ->whereHas('roles', function ($q) {
                $q->where('name', 'teacher');
            })
            ->get();

        return view('dashboard.academic.sections.create', compact(
            'academicYears',
            'classes',
            'teachers'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1|max:50',
            'status' => 'required|in:active,inactive,full',
            'shift' => 'required|in:morning,evening,day,weekend'
        ]);

        // Check if class has sections enabled
        $class = Clazz::findOrFail($request->class_id);
        if (!$class->enable_sections) {
            return redirect()->back()
                ->with('error', 'Sections are not enabled for this class.')
                ->withInput();
        }

        // Check if section name is unique within class
        $exists = Section::where('class_id', $request->class_id)
            ->where('name', $request->name)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'A section with this name already exists in this class.')
                ->withInput();
        }

        try {
            // Generate section code if not provided
            $code = $request->code;
            if (empty($code)) {
                $classCode = substr($class->code ?? $class->name, 0, 3);
                $sectionCode = strtoupper($classCode . '-' . $request->name);
                $code = $sectionCode;
            }

            // Create section
            $section = Section::create([
                'school_id' => auth()->user()->school_id,
                'class_id' => $request->class_id,
                'academic_year_id' => $request->academic_year_id,
                'name' => $request->name,
                'code' => $code,
                'capacity' => $request->capacity,
                'shift' => $request->shift,
                'room_number' => $request->room_number,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'weekdays' => $request->weekdays ? json_encode($request->weekdays) : null,
                'class_teacher_id' => $request->class_teacher_id,
                'assistant_teacher_id' => $request->assistant_teacher_id,
                'enable_attendance' => $request->has('enable_attendance'),
                'enable_fee_collection' => $request->has('enable_fee_collection'),
                'status' => $request->status,
                'description' => $request->description
            ]);

            return redirect()->route('sections.index')
                ->with('success', 'Section created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating section: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Section $section)
    {
        // Check if section belongs to user's school
        if ($section->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        $section->load([
            'class',
            'academicYear',
            'classTeacher',
            'assistantTeacher',
            'students'
        ]);

        // Get section statistics
        $studentCount = $section->students()->count();
        $availableSeats = $section->capacity - $studentCount;
        $occupancyPercentage = $section->capacity > 0 ? ($studentCount / $section->capacity) * 100 : 0;

        return view('dashboard.academic.sections.show', compact(
            'section',
            'studentCount',
            'availableSeats',
            'occupancyPercentage'
        ));
    }

    public function edit(Section $section)
    {
        // Check if section belongs to user's school
        if ($section->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        $academicYears = AcademicYear::currentSchool()->get();
        $classes = Clazz::where('school_id', auth()->user()->school_id)
            ->where('enable_sections', true)
            ->orderBy('order_no')
            ->get();

        $teachers = User::where('school_id', auth()->user()->school_id)
            ->whereHas('roles', function ($q) {
                $q->where('name', 'teacher');
            })
            ->get();

        // Decode weekdays
        $section->weekdays = $section->weekdays ? json_decode($section->weekdays) : [];

        return view('dashboard.academic.sections.edit', compact(
            'section',
            'academicYears',
            'classes',
            'teachers'
        ));
    }

    public function update(Request $request, Section $section)
    {
        // Check if section belongs to user's school
        if ($section->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1|max:50',
            'status' => 'required|in:active,inactive,full',
            'shift' => 'required|in:morning,evening,day,weekend'
        ]);

        // Check if section name is unique within class (excluding current section)
        $exists = Section::where('class_id', $section->class_id)
            ->where('name', $request->name)
            ->where('id', '!=', $section->id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'A section with this name already exists in this class.')
                ->withInput();
        }

        try {
            $section->update([
                'name' => $request->name,
                'code' => $request->code,
                'capacity' => $request->capacity,
                'shift' => $request->shift,
                'room_number' => $request->room_number,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'weekdays' => $request->weekdays ? json_encode($request->weekdays) : null,
                'class_teacher_id' => $request->class_teacher_id,
                'assistant_teacher_id' => $request->assistant_teacher_id,
                'enable_attendance' => $request->has('enable_attendance'),
                'enable_fee_collection' => $request->has('enable_fee_collection'),
                'status' => $request->status,
                'description' => $request->description
            ]);

            // Update academic year if changed
            if ($request->academic_year_id != $section->academic_year_id) {
                $section->update(['academic_year_id' => $request->academic_year_id]);
            }

            return redirect()->route('sections.index')
                ->with('success', 'Section updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating section: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Section $section)
    {
        // Check if section belongs to user's school
        if ($section->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        // Check if section has students
        if ($section->students()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete section with enrolled students.');
        }

        try {
            $section->delete();

            return redirect()->route('sections.index')
                ->with('success', 'Section deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting section: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Section $section)
    {
        // Check if section belongs to user's school
        if ($section->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        try {
            $newStatus = $section->status === 'active' ? 'inactive' : 'active';

            $section->update(['status' => $newStatus]);

            $message = $newStatus === 'active'
                ? 'Section activated successfully.'
                : 'Section deactivated successfully.';

            return redirect()->route('sections.index')
                ->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating section status: ' . $e->getMessage());
        }
    }

    public function getSectionsByClass($classId)
    {
        $sections = Section::where('class_id', $classId)
            ->where('school_id', auth()->user()->school_id)
            ->where('status', 'active')
            ->get();

        return response()->json($sections);
    }
}

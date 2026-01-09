<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Clazz;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectSetupController extends Controller
{
    public function index()
    {
        $subjects = Subject::with(['classes', 'defaultTeacher'])
            ->withCount(['classes', 'examSchedules']) // Changed from 'exams' to 'examSchedules'
            ->where('school_id', auth()->user()->school_id)
            ->orderBy('name')
            ->get();

        // Group subjects by category
        $groupedSubjects = $subjects->groupBy('category');

        // Get categories for filter
        $categories = Subject::where('school_id', auth()->user()->school_id)
            ->distinct()
            ->pluck('category')
            ->filter()
            ->values();

        // Get classes for filter
        $classes = Clazz::where('school_id', auth()->user()->school_id) // Changed from Clazz to Classes
            ->where('status', 'active')
            ->orderBy('order_no')
            ->get();

        // Get teachers for filter
        $teachers = User::where('school_id', auth()->user()->school_id)
            ->whereHas('roles', function ($q) {
                $q->where('name', 'teacher');
            })
            ->get();

        return view('dashboard.academic.subjects.index', compact(
            'subjects',
            'groupedSubjects',
            'categories',
            'classes',
            'teachers'
        ));
    }

    public function create()
    {
        $classes = Clazz::where('school_id', auth()->user()->school_id)
            ->where('status', 'active')
            ->orderBy('order_no')
            ->get();

        $teachers = User::where('school_id', auth()->user()->school_id)
            ->whereHas('roles', function ($q) {
                $q->where('name', 'teacher');
            })
            ->get();

        return view('dashboard.academic.subjects.create', compact('classes', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:subjects,code,NULL,id,school_id,' . auth()->user()->school_id,
            'type' => 'required|in:theory,practical,both,project,activity',
            'status' => 'required|in:active,inactive,archived',
            'weekly_periods' => 'integer|min:1|max:20',
            'period_duration' => 'integer|min:15|max:120',
            'total_marks' => 'nullable|integer|min:0|max:500',
            'passing_marks' => 'nullable|integer|min:0|max:500'
        ]);

        // Validate passing marks
        if (
            $request->total_marks && $request->passing_marks &&
            $request->passing_marks > $request->total_marks
        ) {
            return redirect()->back()
                ->with('error', 'Passing marks cannot exceed total marks.')
                ->withInput();
        }

        try {
            // Create subject
            $subject = Subject::create([
                'school_id' => auth()->user()->school_id,
                'name' => $request->name,
                'code' => $request->code,
                'type' => $request->type,
                'category' => $request->category,
                'credit_hours' => $request->credit_hours,
                'total_marks' => $request->total_marks,
                'passing_marks' => $request->passing_marks,
                'weekly_periods' => $request->weekly_periods ?? 5,
                'period_duration' => $request->period_duration ?? 40,
                'is_optional' => $request->has('is_optional'),
                'has_lab' => $request->has('has_lab'),
                'enable_exams' => $request->has('enable_exams'),
                'enable_homework' => $request->has('enable_homework'),
                'default_teacher_id' => $request->default_teacher_id,
                'short_description' => $request->short_description,
                'syllabus' => $request->syllabus,
                'objectives' => $request->objectives,
                'status' => $request->status
            ]);

            // Attach classes
            if ($request->has('classes')) {
                $classData = [];
                foreach ($request->classes as $classId) {
                    $classData[$classId] = ['is_compulsory' => !$request->has('is_optional')];
                }
                $subject->classes()->attach($classData);
            }

            return redirect()->route('subjects.index')
                ->with('success', 'Subject created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating subject: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Subject $subject)
    {
        // Check if subject belongs to user's school
        if ($subject->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        $subject->load([
            'classes',
            'defaultTeacher',
            'classes.students'
        ]);

        // Get statistics
        $classesCount = $subject->classes->count();
        $studentsCount = $subject->getStudentsCountAttribute();

        return view('dashboard.academic.subjects.show', compact(
            'subject',
            'classesCount',
            'studentsCount'
        ));
    }

    public function edit(Subject $subject)
    {
        // Check if subject belongs to user's school
        if ($subject->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        $classes = Clazz::where('school_id', auth()->user()->school_id)
            ->where('status', 'active')
            ->orderBy('order_no')
            ->get();

        $teachers = User::where('school_id', auth()->user()->school_id)
            ->whereHas('roles', function ($q) {
                $q->where('name', 'teacher');
            })
            ->get();

        // Get already attached class IDs
        $attachedClassIds = $subject->classes->pluck('id')->toArray();

        return view('dashboard.academic.subjects.edit', compact(
            'subject',
            'classes',
            'teachers',
            'attachedClassIds'
        ));
    }

    public function update(Request $request, Subject $subject)
    {
        // Check if subject belongs to user's school
        if ($subject->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:subjects,code,' . $subject->id . ',id,school_id,' . auth()->user()->school_id,
            'type' => 'required|in:theory,practical,both,project,activity',
            'status' => 'required|in:active,inactive,archived',
            'weekly_periods' => 'integer|min:1|max:20',
            'period_duration' => 'integer|min:15|max:120',
            'total_marks' => 'nullable|integer|min:0|max:500',
            'passing_marks' => 'nullable|integer|min:0|max:500'
        ]);

        // Validate passing marks
        if (
            $request->total_marks && $request->passing_marks &&
            $request->passing_marks > $request->total_marks
        ) {
            return redirect()->back()
                ->with('error', 'Passing marks cannot exceed total marks.')
                ->withInput();
        }

        try {
            // Update subject
            $subject->update([
                'name' => $request->name,
                'code' => $request->code,
                'type' => $request->type,
                'category' => $request->category,
                'credit_hours' => $request->credit_hours,
                'total_marks' => $request->total_marks,
                'passing_marks' => $request->passing_marks,
                'weekly_periods' => $request->weekly_periods,
                'period_duration' => $request->period_duration,
                'is_optional' => $request->has('is_optional'),
                'has_lab' => $request->has('has_lab'),
                'enable_exams' => $request->has('enable_exams'),
                'enable_homework' => $request->has('enable_homework'),
                'default_teacher_id' => $request->default_teacher_id,
                'short_description' => $request->short_description,
                'syllabus' => $request->syllabus,
                'objectives' => $request->objectives,
                'status' => $request->status
            ]);

            // Sync classes
            if ($request->has('classes')) {
                $classData = [];
                foreach ($request->classes as $classId) {
                    $classData[$classId] = ['is_compulsory' => !$request->has('is_optional')];
                }
                $subject->classes()->sync($classData);
            } else {
                $subject->classes()->detach();
            }

            return redirect()->route('subjects.index')
                ->with('success', 'Subject updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating subject: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Subject $subject)
    {
        // Check if subject belongs to user's school
        if ($subject->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        // Check if subject can be deleted
        if (!$subject->canBeDeleted()) {
            return redirect()->back()
                ->with('error', 'Cannot delete subject with exam records or class assignments.');
        }

        try {
            $subject->delete();

            return redirect()->route('subjects.index')
                ->with('success', 'Subject deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting subject: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Subject $subject)
    {
        // Check if subject belongs to user's school
        if ($subject->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        try {
            $newStatus = $subject->status === 'active' ? 'inactive' : 'active';

            $subject->update(['status' => $newStatus]);

            $message = $newStatus === 'active'
                ? 'Subject activated successfully.'
                : 'Subject deactivated successfully.';

            return redirect()->route('subjects.index')
                ->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating subject status: ' . $e->getMessage());
        }
    }
}

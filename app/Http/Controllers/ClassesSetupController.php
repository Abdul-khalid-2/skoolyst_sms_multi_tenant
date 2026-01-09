<?php

namespace App\Http\Controllers;

use App\Models\Clazz;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ClassesSetupController extends Controller
{
    public function index()
    {
        $academicYears = AcademicYear::currentSchool()->active()->get();
        $activeYear = AcademicYear::getActive();

        // Get classes with counts
        $classes = Clazz::withCount(['students', 'sections'])
            ->with(['academicYear'])
            ->where('school_id', auth()->user()->school_id)
            ->orderBy('order_no')
            ->get();
            // dd('dsdfs');

        // Group classes by category for better organization
        $groupedClasses = $classes->groupBy(function ($class) {
            $name = strtolower($class->name);

            if (Str::contains($name, ['play', 'nursery', 'kg', 'kindergarten'])) {
                return 'pre-primary';

            } elseif (Str::contains($name, ['class 1', 'class 2', 'class 3', 'class 4', 'class 5'])) {
                return 'primary';

            } elseif (Str::contains($name, ['class 6', 'class 7', 'class 8'])) {
                return 'middle';

            } elseif (Str::contains($name, ['class 9', 'class 10'])) {
                return 'secondary';

            } elseif (Str::contains($name, ['o-level', 'a-level', 'cambridge'])) {
                return 'cambridge';

            } else {
                return 'other';
            }

        });

        return view('dashboard.academic.classes.index', compact(
            'groupedClasses',
            'academicYears',
            'activeYear',
            'classes'
        ));
    }

    public function create()
    {
        $academicYears = AcademicYear::currentSchool()->get();
        $classes = Clazz::where('school_id', auth()->user()->school_id)->get();

        return view('dashboard.academic.classes.create', compact('academicYears', 'classes'));
    }

    public function store(Request $request)
    {

        $request->merge([
            'enable_sections' => $request->has('enable_sections')
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'order_no' => 'required|integer|min:1',
            'education_system' => 'required|in:matric,cambridge,montessori,american,ib,other',
            'status' => 'required|in:active,inactive,archived',
            'enable_sections' => 'boolean'
        ]);

        try {
            $class = Clazz::create([
                'school_id' => auth()->user()->school_id,
                'academic_year_id' => $request->academic_year_id,
                'name' => $request->name,
                'code' => $request->code,
                'order_no' => $request->order_no,
                'education_system' => $request->education_system,
                'min_age' => $request->min_age,
                'max_age' => $request->max_age,
                'next_class_id' => $request->next_class_id,
                'enable_sections' => $request->enable_sections ?? true,
                'status' => $request->status,
                'description' => $request->description
            ]);

            // Create initial sections if requested
            if ($request->initial_sections > 0 && $class->enable_sections) {
                $this->createInitialSections($class, $request->initial_sections, $request->default_capacity);
            }

            return redirect()->route('classes.index')
                ->with('success', 'Class created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating class: ' . $e->getMessage())
                ->withInput();
        }
    }

    private function createInitialSections($class, $count, $capacity)
    {
        $sections = ['A', 'B', 'C', 'D', 'E', 'F'];

        for ($i = 0; $i < $count; $i++) {
            $class->sections()->create([
                'school_id' => $class->school_id,
                'academic_year_id' => $class->academic_year_id,
                'name' => 'Section ' . $sections[$i],
                'code' => $sections[$i],
                'capacity' => $capacity ?? 25,
                'status' => 'active'
            ]);
        }
    }

    public function show(Clazz $class)
    {
        // Check if class belongs to user's school
        if ($class->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        $class->load(['academicYear', 'sections', 'students', 'nextClass']);

        return view('dashboard.academic.classes.show', compact('class'));
    }

    public function edit(Clazz $class)
    {
        // Check if class belongs to user's school
        if ($class->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        $academicYears = AcademicYear::currentSchool()->get();
        $classes = Clazz::where('school_id', auth()->user()->school_id)
            ->where('id', '!=', $class->id)
            ->get();

        return view('dashboard.academic.classes.edit', compact('class', 'academicYears', 'classes'));
    }

    public function update(Request $request, Clazz $class)
    {
        // Check if class belongs to user's school
        if ($class->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'order_no' => 'required|integer|min:1',
            'education_system' => 'required|in:matric,cambridge,montessori,american,ib,other',
            'status' => 'required|in:active,inactive,archived'
        ]);

        try {
            // Can't change status to inactive if class has students
            if ($request->status === 'inactive' && $class->students()->count() > 0) {
                return redirect()->back()
                    ->with('error', 'Cannot deactivate class with active students.')
                    ->withInput();
            }

            $class->update([
                'academic_year_id' => $request->academic_year_id,
                'name' => $request->name,
                'code' => $request->code,
                'order_no' => $request->order_no,
                'education_system' => $request->education_system,
                'min_age' => $request->min_age,
                'max_age' => $request->max_age,
                'next_class_id' => $request->next_class_id,
                'enable_sections' => $request->enable_sections ?? true,
                'status' => $request->status,
                'description' => $request->description
            ]);

            return redirect()->route('classes.index')
                ->with('success', 'Class updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating class: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Clazz $class)
    {
        // Check if class belongs to user's school
        if ($class->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        // Check if class has students
        if ($class->students()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete class with students enrolled.');
        }

        try {
            $class->delete();

            return redirect()->route('classes.index')
                ->with('success', 'Class deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting class: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Clazz $class)
    {
        // Check if class belongs to user's school
        if ($class->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        try {
            $newStatus = $class->status === 'active' ? 'inactive' : 'active';

            // Can't deactivate if class has students
            if ($newStatus === 'inactive' && $class->students()->count() > 0) {
                return redirect()->back()
                    ->with('error', 'Cannot deactivate class with active students.');
            }

            $class->update(['status' => $newStatus]);

            $message = $newStatus === 'active'
                ? 'Class activated successfully.'
                : 'Class deactivated successfully.';

            return redirect()->route('classes.index')
                ->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating class status: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcademicYearController extends Controller
{
    public function index()
    {
        $academicYears = AcademicYear::withCount(['students', 'classes'])
            ->where('school_id', auth()->user()->school_id)
            ->orderBy('start_date', 'desc')
            ->get();

        $activeYear = AcademicYear::getActive(auth()->user()->school_id);

        return view('dashboard.academic.academic-years.index', compact('academicYears', 'activeYear'));
    }

    public function create()
    {
        return view('dashboard.academic.academic-years.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive,archived'
        ]);

        // try {
            $academicYear = AcademicYear::create([
                'school_id' => auth()->user()->school_id,
                'name' => $request->name,
                'code' => $request->code,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'is_active' => $request->status === 'active' ? true : false,
                'description' => $request->description
            ]);

            // If setting as active, deactivate others
            if ($request->status === 'active') {
                AcademicYear::where('school_id', auth()->user()->school_id)
                    ->where('id', '!=', $academicYear->id)
                    ->update(['is_active' => false]);
            }

            return redirect()->route('academic-years.index')
                ->with('success', 'Academic year created successfully.');
                
        // } catch (\Exception $e) {
        //     return redirect()->back()
        //         ->with('error', 'Error creating academic year: ' . $e->getMessage());
        // }
    }

    public function show(AcademicYear $academicYear)
    {
        // Check if academic year belongs to user's school
        if ($academicYear->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        return view('dashboard.academic.academic-years.show', compact('academicYear'));
    }

    public function edit(AcademicYear $academicYear)
    {
        // Check if academic year belongs to user's school
        if ($academicYear->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        return view('dashboard.academic.academic-years.edit', compact('academicYear'));
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        // Check if academic year belongs to user's school
        if ($academicYear->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive,archived'
        ]);

        try {
            $data = [
                'name' => $request->name,
                'code' => $request->code,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'description' => $request->description
            ];

            // Handle active status
            if ($request->status === 'active') {
                $data['is_active'] = true;
                // Deactivate other active years
                AcademicYear::where('school_id', auth()->user()->school_id)
                    ->where('id', '!=', $academicYear->id)
                    ->update(['is_active' => false]);
            } else {
                $data['is_active'] = false;
            }

            $academicYear->update($data);

            return redirect()->route('academic-years.index')
                ->with('success', 'Academic year updated successfully.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating academic year: ' . $e->getMessage());
        }
    }

    public function destroy(AcademicYear $academicYear)
    {
        // Check if academic year belongs to user's school
        if ($academicYear->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        // Check if year has data
        if ($academicYear->students()->count() > 0 || 
            $academicYear->exams()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete academic year with existing data. Archive it instead.');
        }

        try {
            $academicYear->delete();
            return redirect()->route('academic-years.index')
                ->with('success', 'Academic year deleted successfully.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting academic year: ' . $e->getMessage());
        }
    }

    public function activate(AcademicYear $academicYear)
    {
        if ($academicYear->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        try {
            // Deactivate all other years
            AcademicYear::where('school_id', auth()->user()->school_id)
                ->where('id', '!=', $academicYear->id)
                ->update(['is_active' => false]);

            // Activate this year
            $academicYear->update([
                'is_active' => true,
                'status' => 'active'
            ]);

            return redirect()->route('academic-years.index')
                ->with('success', 'Academic year activated successfully.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error activating academic year: ' . $e->getMessage());
        }
    }

    public function archive(AcademicYear $academicYear)
    {
        if ($academicYear->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        // Can't archive active year
        if ($academicYear->is_active) {
            return redirect()->back()
                ->with('error', 'Cannot archive active academic year. Deactivate it first.');
        }

        try {
            $academicYear->update([
                'status' => 'archived'
            ]);

            return redirect()->route('academic-years.index')
                ->with('success', 'Academic year archived successfully.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error archiving academic year: ' . $e->getMessage());
        }
    }
}
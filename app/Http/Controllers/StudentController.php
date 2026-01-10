<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Guardian;
use App\Models\AcademicYear;
use App\Models\Clazz;
use App\Models\Section;
use App\Models\Branch;
use App\Models\StudentGuardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Student::with(['class', 'section', 'guardians'])
            ->bySchool()
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('admission_no', 'like', "%{$search}%")
                        ->orWhere('roll_no', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('class_id'), function ($q) use ($request) {
                $q->where('class_id', $request->class_id);
            })
            ->when($request->filled('section_id'), function ($q) use ($request) {
                $q->where('section_id', $request->section_id);
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->filled('academic_year_id'), function ($q) use ($request) {
                $q->where('academic_year_id', $request->academic_year_id);
            });

        $students = $query->latest()->paginate(20);

        $classes = Clazz::bySchool()->active()->get();
        $sections = Section::bySchool()->active()->get();
        $academicYears = AcademicYear::bySchool()->active()->get();

        // Statistics
        $stats = [
            'total' => Student::bySchool()->count(),
            'active' => Student::bySchool()->active()->count(),
            'inactive' => Student::bySchool()->where('status', 'inactive')->count(),
            'new_this_month' => Student::bySchool()
                ->whereMonth('created_at', now()->month)
                ->count(),
        ];

        return view('dashboard.students.index', compact('students', 'classes', 'sections', 'academicYears', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $academicYears = AcademicYear::bySchool()->active()->get();
        $classes = Clazz::bySchool()->active()->get();
        $branches = Branch::bySchool()->active()->get();

        return view('dashboard.students.create', compact('academicYears', 'classes', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'admission_date' => 'required|date',
            'academic_year_id' => 'required|exists:academic_years,id',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'nullable|exists:sections,id',
            'branch_id' => 'nullable|exists:branches,id',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:students,email',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'father_name' => 'required|string|max:100',
            'father_phone' => 'required|string|max:20',
            'father_cnic' => 'nullable|string|max:15',
            'mother_name' => 'nullable|string|max:100',
            'mother_phone' => 'nullable|string|max:20',
            'emergency_contact' => 'nullable|string|max:20',
        ]);
        // dd($request->all());s

        DB::beginTransaction();

        // try {
        // Generate admission number
        $admissionNo = $this->generateAdmissionNo();

        $studentData = [
            'school_id' => auth()->user()->school_id,
            'academic_year_id' => $request->academic_year_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'branch_id' => $request->branch_id,
            'admission_no' => $admissionNo,
            'roll_no' => $request->roll_no,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
            'religion' => $request->religion,
            'nationality' => $request->nationality,
            'cnic' => $request->cnic,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'admission_date' => $request->admission_date,
            'status' => $request->status ?? 'active',
            'previous_school' => $request->previous_school,
            'medical_info' => [
                'conditions' => $request->medical_conditions,
                'allergies' => $request->allergies,
                'medications' => $request->medications,
            ],
        ];

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('students/photos', 'public');
            $studentData['photo'] = $path;
        }

        $student = Student::create($studentData);

        // Create guardians and attach to student
        $guardiansToAttach = [];

        $fatherNameParts = explode(' ', $request->father_name, 2);
        $motherNameParts = explode(' ', $request->mother_name, 2);
        $emergencyNameParts = explode(' ', $request->emergency_name, 2);
        // Father
        if ($request->father_name) {
            $father = Guardian::create([
                'school_id' => $student->school_id,
                'first_name' => $fatherNameParts[0],
                'last_name' => $fatherNameParts[1] ?? '',
                'relation' => 'father',
                'phone' => $request->father_phone,
                'email' => $request->father_email,
                'cnic' => $request->father_cnic,
                'occupation' => $request->father_occupation,
                'monthly_income' => $request->father_income,
                'address' => $request->address, // Same as student address
                'status' => 'active',
            ]);

            $guardiansToAttach[$father->id] = ['is_primary' => true];
        }

        // Mother
        if ($request->mother_name) {
            $mother = Guardian::create([
                'school_id' => $student->school_id,
                'first_name' => $motherNameParts[0],
                'last_name' => $motherNameParts[1] ?? '',
                'relation' => 'mother',
                'phone' => $request->mother_phone,
                'email' => $request->mother_email,
                'cnic' => $request->mother_cnic,
                'occupation' => $request->mother_occupation,
                'address' => $request->address,
                'status' => 'active',
            ]);

            $guardiansToAttach[$mother->id] = ['is_primary' => false];
        }

        // Emergency contact (if provided as guardian)
        if ($request->emergency_name && $request->emergency_phone) {
            $emergency = Guardian::create([
                'school_id' => $student->school_id,
                'first_name' => $emergencyNameParts[0],
                'last_name' => $emergencyNameParts[1] ?? '',
                'relation' => $request->emergency_relation ?? 'other',
                'phone' => $request->emergency_phone,
                'address' => $request->emergency_address,
                'status' => 'active',
            ]);

            $guardiansToAttach[$emergency->id] = ['is_primary' => false];
        }

        // Attach guardians to student
        if (!empty($guardiansToAttach)) {
            $student->guardians()->attach($guardiansToAttach);
        }

        // Create student academic record
        $student->academicRecords()->create([
            'academic_year_id' => $student->academic_year_id,
            'class_id' => $student->class_id,
            'section_id' => $student->section_id,
            'roll_no' => $student->roll_no,
            'start_date' => $student->admission_date,
            'result' => 'pending',
        ]);

        DB::commit();

        return redirect()->route('students.index')
            ->with('success', 'Student registered successfully! Admission No: ' . $admissionNo);
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return redirect()->back()
        //         ->with('error', 'Error creating student: ' . $e->getMessage())
        //         ->withInput();
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load([
            'class',
            'section',
            'academicYear',
            'guardians',
            'academicRecords',
            'feeTransactions' => function ($query) {
                $query->latest()->limit(10);
            },
            'attendances' => function ($query) {
                $query->latest()->limit(30);
            },
            'examResults' => function ($query) {
                $query->with('exam', 'subject')->latest();
            }
        ]);

        // Calculate attendance statistics
        $attendanceStats = $this->getAttendanceStats($student);

        return view('dashboard.students.show', compact('student', 'attendanceStats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $academicYears = AcademicYear::bySchool()->active()->get();
        $classes = Clazz::bySchool()->active()->get();
        $sections = Section::where('class_id', $student->class_id)->active()->get();
        $branches = Branch::bySchool()->active()->get();

        $student->load('guardians');

        return view('dashboard.students.edit', compact('student', 'academicYears', 'classes', 'sections', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'admission_date' => 'required|date',
            'academic_year_id' => 'required|exists:academic_years,id',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'nullable|exists:sections,id',
            'branch_id' => 'nullable|exists:branches,id',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:students,email,' . $student->id,
            'address' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $studentData = [
                'academic_year_id' => $request->academic_year_id,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'branch_id' => $request->branch_id,
                'roll_no' => $request->roll_no,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'blood_group' => $request->blood_group,
                'religion' => $request->religion,
                'nationality' => $request->nationality,
                'cnic' => $request->cnic,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'admission_date' => $request->admission_date,
                'status' => $request->status,
                'previous_school' => $request->previous_school,
                'medical_info' => [
                    'conditions' => $request->medical_conditions,
                    'allergies' => $request->allergies,
                    'medications' => $request->medications,
                ],
            ];

            // Handle photo upload
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($student->photo) {
                    Storage::disk('public')->delete($student->photo);
                }

                $path = $request->file('photo')->store('students/photos', 'public');
                $studentData['photo'] = $path;
            }

            $student->update($studentData);

            // Update guardians if provided
            if ($request->filled('guardians')) {
                foreach ($request->guardians as $guardianData) {
                    if (isset($guardianData['id'])) {
                        // Update existing guardian
                        $guardian = Guardian::find($guardianData['id']);
                        if ($guardian) {
                            $guardian->update([
                                'first_name' => $guardianData['first_name'],
                                'last_name' => $guardianData['last_name'],
                                'relation' => $guardianData['relation'],
                                'phone' => $guardianData['phone'],
                                'email' => $guardianData['email'],
                                'occupation' => $guardianData['occupation'],
                                'monthly_income' => $guardianData['monthly_income'],
                                'address' => $guardianData['address'],
                                'cnic' => $guardianData['cnic'],
                            ]);
                        }
                    } else {
                        // Create new guardian and attach
                        $newGuardian = Guardian::create([
                            'school_id' => $student->school_id,
                            'first_name' => $guardianData['first_name'],
                            'last_name' => $guardianData['last_name'],
                            'relation' => $guardianData['relation'],
                            'phone' => $guardianData['phone'],
                            'email' => $guardianData['email'],
                            'occupation' => $guardianData['occupation'],
                            'monthly_income' => $guardianData['monthly_income'],
                            'address' => $guardianData['address'],
                            'cnic' => $guardianData['cnic'],
                            'status' => 'active',
                        ]);

                        $student->guardians()->attach($newGuardian->id, [
                            'is_primary' => $guardianData['is_primary'] ?? false
                        ]);
                    }
                }
            }

            // Update academic record if class changed
            if ($student->wasChanged(['academic_year_id', 'class_id', 'section_id', 'roll_no'])) {
                $currentRecord = $student->academicRecords()
                    ->where('academic_year_id', $student->academic_year_id)
                    ->first();

                if ($currentRecord) {
                    $currentRecord->update([
                        'class_id' => $student->class_id,
                        'section_id' => $student->section_id,
                        'roll_no' => $student->roll_no,
                    ]);
                } else {
                    $student->academicRecords()->create([
                        'academic_year_id' => $student->academic_year_id,
                        'class_id' => $student->class_id,
                        'section_id' => $student->section_id,
                        'roll_no' => $student->roll_no,
                        'start_date' => $student->admission_date,
                        'result' => 'pending',
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('students.show', $student)
                ->with('success', 'Student updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error updating student: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            // Soft delete the student
            $student->delete();

            return redirect()->route('students.index')
                ->with('success', 'Student deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting student: ' . $e->getMessage());
        }
    }

    /**
     * Promote student to next class.
     */
    public function promote(Request $request, Student $student)
    {
        $request->validate([
            'next_class_id' => 'required|exists:classes,id',
            'next_academic_year_id' => 'required|exists:academic_years,id',
            'promotion_date' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            // Update current academic record end date
            $currentRecord = $student->academicRecords()
                ->where('academic_year_id', $student->academic_year_id)
                ->first();

            if ($currentRecord) {
                $currentRecord->update([
                    'end_date' => $request->promotion_date,
                    'result' => $request->result ?? 'promoted',
                    'percentage' => $request->percentage,
                    'grade' => $request->grade,
                    'position' => $request->position,
                    'remarks' => $request->remarks,
                ]);
            }

            // Update student for new academic year
            $student->update([
                'academic_year_id' => $request->next_academic_year_id,
                'class_id' => $request->next_class_id,
                'section_id' => null, // Reset section, to be assigned by admin
                'roll_no' => null, // Reset roll number
                'status' => 'active',
            ]);

            // Create new academic record
            $student->academicRecords()->create([
                'academic_year_id' => $request->next_academic_year_id,
                'class_id' => $request->next_class_id,
                'roll_no' => null,
                'start_date' => $request->promotion_date,
                'result' => 'pending',
            ]);

            DB::commit();

            return redirect()->route('students.show', $student)
                ->with('success', 'Student promoted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error promoting student: ' . $e->getMessage());
        }
    }

    /**
     * Generate admission number.
     */
    private function generateAdmissionNo(): string
    {
        $schoolId = auth()->user()->school_id;
        $year = date('Y');

        $lastAdmission = Student::where('school_id', $schoolId)
            ->whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        $serial = $lastAdmission ?
            (int) substr($lastAdmission->admission_no, -4) + 1 : 1;

        return sprintf('ADM-%s-%04d', $year, $serial);
    }

    /**
     * Get attendance statistics for student.
     */
    private function getAttendanceStats(Student $student): array
    {
        $currentMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $attendances = $student->attendances()
            ->whereBetween('date', [$currentMonth, $endOfMonth])
            ->get();

        $totalDays = $attendances->count();
        $present = $attendances->where('status', 'present')->count();
        $absent = $attendances->where('status', 'absent')->count();
        $late = $attendances->where('status', 'late')->count();

        return [
            'total_days' => $totalDays,
            'present' => $present,
            'absent' => $absent,
            'late' => $late,
            'percentage' => $totalDays > 0 ? round(($present / $totalDays) * 100, 2) : 0,
        ];
    }

    /**
     * Export students list.
     */
    public function export(Request $request)
    {
        $students = Student::with(['class', 'section', 'academicYear'])
            ->bySchool()
            ->when($request->filled('class_id'), function ($q) use ($request) {
                $q->where('class_id', $request->class_id);
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->get();

        // Return CSV or Excel file
        // Implementation depends on your export library
    }

    /**
     * Bulk import students.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls',
        ]);

        // Handle file import
        // Implementation depends on your import library
    }


    public function getSectionsByClass(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id'
        ]);

        try {
            $sections = Section::where('class_id', $request->class_id)
                ->where('status', 'active')
                ->orderBy('name')
                ->get()
                ->map(function ($section) {
                    return [
                        'id' => $section->id,
                        'name' => $section->name,
                        'code' => $section->code,
                        'capacity' => $section->capacity,
                        'students_count' => $section->students_count,
                        'available_seats' => $section->available_seats,
                        'shift' => $section->shift,
                        'class_teacher' => $section->classTeacher->name ?? null
                    ];
                });

            return response()->json([
                'success' => true,
                'sections' => $sections,
                'message' => $sections->count() . ' sections found'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching sections: ' . $e->getMessage()
            ], 500);
        }
    }
}

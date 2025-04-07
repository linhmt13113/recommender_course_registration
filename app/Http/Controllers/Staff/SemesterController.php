<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;

class SemesterController extends Controller
{
    //
    /**
     * Display the list of semesters.
     */
    public function index()
    {
        $semesters = Semester::paginate(10);
        return view('academic_staff.semesters.index', compact('semesters'));
    }

    /**
     * Display the form to add a new semester.
     */
    public function create()
    {
        return view('academic_staff.semesters.create');
    }

    /**
     * Store a new semester.
     */
    public function store(Request $request)
    {
        $request->validate([
            'semester_id' => 'required|unique:semesters,semester_id',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
        ]);

        $semester = new Semester();
        $semester->semester_id         = $request->input('semester_id');
        $semester->start_date          = $request->input('start_date');
        $semester->end_date            = $request->input('end_date');
        // Default registration_status is 'closed'
        $semester->registration_status = 'closed';
        $semester->save();

        return redirect()->route('semesters.index')
                         ->with('success', 'Successfully added the semester.');
    }

    /**
     * Display the form to edit a semester.
     */
    public function edit($id)
    {
        $semester = Semester::findOrFail($id);
        return view('academic_staff.semesters.edit', compact('semester'));
    }

    /**
     * Update a semester.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'semester_id' => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
        ]);

        $semester = Semester::findOrFail($id);
        $semester->semester_id = $request->input('semester_id');
        $semester->start_date  = $request->input('start_date');
        $semester->end_date    = $request->input('end_date');
        $semester->save();

        return redirect()->route('semesters.index')
                         ->with('success', 'Successfully updated the semester.');
    }

    /**
     * Delete a semester.
     */
    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();

        return redirect()->route('semesters.index')
                         ->with('success', 'Successfully deleted the semester.');
    }
}

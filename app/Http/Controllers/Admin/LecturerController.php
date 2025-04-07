<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\Course;

class LecturerController extends Controller
{
    /**
     * Display the list of lecturers.
     */
    public function index()
    {
        $lecturers = Lecturer::paginate(10);
        return view('admin.lecturers.index', compact('lecturers'));
    }

    /**
     * Display the form for adding a new lecturer.
     */
    public function create()
    {
        return view('admin.lecturers.create');
    }

    /**
     * Store a new lecturer.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lecturer_id'   => 'required|unique:lecturers,lecturer_id',
            'lecturer_name' => 'required',
        ]);

        $lecturer = new Lecturer();
        $lecturer->lecturer_id = $request->input('lecturer_id');
        $lecturer->lecturer_name = $request->input('lecturer_name');
        $lecturer->password      = bcrypt('lecturer123');
        $lecturer->save();

        return redirect()->route('ad_lecturer.index')
                         ->with('success', 'Lecturer added successfully.');
    }

    /**
     * Display the form for editing a lecturer.
     */
    public function edit($lecturer_id)
    {
        $lecturer = Lecturer::findOrFail($lecturer_id);
        return view('admin.lecturers.edit', compact('lecturer'));
    }

    /**
     * Update lecturer information.
     */
    public function update(Request $request, $lecturer_id)
    {
        $request->validate([
            'lecturer_name' => 'required',
            'password' => 'string|min:6'
        ]);

        $lecturer = Lecturer::findOrFail($lecturer_id);
        $lecturer->lecturer_name = $request->input('lecturer_name');
        $lecturer->password = bcrypt($request->input('password'));
        $lecturer->save();

        return redirect()->route('ad_lecturer.index')
                         ->with('success', 'Lecturer updated successfully.');
    }

    /**
     * Delete a lecturer.
     */
    public function destroy($lecturer_id)
    {
        $lecturer = Lecturer::findOrFail($lecturer_id);
        $lecturer->delete();

        return redirect()->route('ad_lecturer.index')
                         ->with('success', 'Lecturer deleted successfully.');
    }

    /**
     * Display the courses assigned to a lecturer.
     */
    public function courses($lecturer_id)
    {
        $lecturer = Lecturer::findOrFail($lecturer_id);
        $courses  = Course::where('lecturer_id', $lecturer_id)->get();

        return view('admin.lecturers.courses', compact('lecturer', 'courses'));
    }
}

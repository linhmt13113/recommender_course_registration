<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicStaff;

class AcademicStaffController extends Controller
{
    /**
     * Display the list of academic staff.
     */
    public function index()
    {
        $staffs = AcademicStaff::paginate(10);
        return view('admin.staff_management.index', compact('staffs'));
    }

    /**
     * Display the form for adding new academic staff.
     */
    public function create()
    {
        return view('admin.staff_management.create');
    }

    /**
     * Store a new academic staff member.
     */
    public function store(Request $request)
    {
        $request->validate([
            'staff_id'   => 'required|unique:academic_staff,staff_id',
            'staff_name' => 'required',
            'email'      => 'required|email|unique:academic_staff,email'
        ]);

        $staff = new AcademicStaff();
        $staff->staff_id = $request->input('staff_id');
        $staff->staff_name = $request->input('staff_name');
        $staff->email = $request->input('email');
        $staff->password = bcrypt('staff123');
        $staff->save();

        return redirect()->route('staff_management.index')
                         ->with('success', 'Academic staff added successfully.');
    }

    /**
     * Display the form for editing academic staff.
     */
    public function edit($staff_id)
    {
        $staff = AcademicStaff::findOrFail($staff_id);
        return view('admin.staff_management.edit', compact('staff'));
    }

    /**
     * Update the information of academic staff.
     */
    public function update(Request $request, $staff_id)
    {
        $request->validate([
            'staff_name' => 'required',
            'email'      => 'required|email|unique:academic_staff,email,' . $staff_id . ',staff_id',
            'password'   => 'nullable|string|min:6'
        ]);

        $staff = AcademicStaff::findOrFail($staff_id);
        $staff->staff_name = $request->input('staff_name');
        $staff->email = $request->input('email');

        // Update password if it's provided.
        if ($request->filled('password')) {
            $staff->password = bcrypt($request->input('password'));
        }

        $staff->save();

        return redirect()->route('staff_management.index')
                         ->with('success', 'Academic staff updated successfully.');
    }

    /**
     * Delete academic staff.
     */
    public function destroy($staff_id)
    {
        $staff = AcademicStaff::findOrFail($staff_id);
        $staff->delete();

        return redirect()->route('staff_management.index')
                         ->with('success', 'Academic staff deleted successfully.');
    }
}

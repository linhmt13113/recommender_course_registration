<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicStaff;

class AcademicStaffController extends Controller
{
    /**
     * Hiển thị danh sách cán bộ học vụ.
     */
    public function index()
    {
        $staffs = AcademicStaff::paginate(10);
        return view('admin.staff_management.index', compact('staffs'));
    }

    /**
     * Hiển thị form thêm cán bộ học vụ.
     */
    public function create()
    {
        return view('admin.staff_management.create');
    }

    /**
     * Lưu cán bộ học vụ mới.
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
                         ->with('success', 'Thêm cán bộ học vụ thành công.');
    }

    /**
     * Hiển thị form chỉnh sửa cán bộ học vụ.
     */
    public function edit($staff_id)
    {
        $staff = AcademicStaff::findOrFail($staff_id);
        return view('admin.staff_management.edit', compact('staff'));
    }

    /**
     * Cập nhật thông tin cán bộ học vụ.
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

        if ($request->filled('password')) {
            $staff->password = bcrypt($request->input('password'));
        }

        $staff->save();

        return redirect()->route('staff_management.index')
                         ->with('success', 'Cập nhật cán bộ học vụ thành công.');
    }

    /**
     * Xóa cán bộ học vụ.
     */
    public function destroy($staff_id)
    {
        $staff = AcademicStaff::findOrFail($staff_id);
        $staff->delete();

        return redirect()->route('staff_management.index')
                         ->with('success', 'Xóa cán bộ học vụ thành công.');
    }
}

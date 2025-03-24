<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;

class SemesterController extends Controller
{
    /**
     * Hiển thị danh sách học kỳ.
     */
    public function index()
    {
        $semesters = Semester::paginate(10);
        return view('admin.semesters.index', compact('semesters'));
    }

    /**
     * Hiển thị form thêm học kỳ.
     */
    public function create()
    {
        return view('admin.semesters.create');
    }

    /**
     * Lưu học kỳ mới.
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
        // registration_status mặc định là 'closed'
        $semester->registration_status = 'closed';
        $semester->save();

        return redirect()->route('hocki.index')
                         ->with('success', 'Thêm học kỳ thành công.');
    }

    /**
     * Hiển thị form chỉnh sửa học kỳ.
     */
    public function edit($id)
    {
        $semester = Semester::findOrFail($id);
        return view('admin.semesters.edit', compact('semester'));
    }

    /**
     * Cập nhật học kỳ.
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

        return redirect()->route('hocki.index')
                         ->with('success', 'Cập nhật học kỳ thành công.');
    }

    /**
     * Xóa học kỳ.
     */
    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();

        return redirect()->route('hocki.index')
                         ->with('success', 'Xóa học kỳ thành công.');
    }
}

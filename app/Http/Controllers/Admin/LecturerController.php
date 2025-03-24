<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lecturer;

class LecturerController extends Controller
{
    /**
     * Hiển thị danh sách giảng viên.
     */
    public function index()
    {
        $lecturers = Lecturer::paginate(10);
        return view('admin.lecturers.index', compact('lecturers'));
    }

    /**
     * Hiển thị form thêm giảng viên.
     */
    public function create()
    {
        return view('admin.lecturers.create');
    }

    /**
     * Lưu giảng viên mới.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lecturer_name' => 'required',
        ]);

        $lecturer = new Lecturer();
        $lecturer->lecturer_id   = 'GV' . time();
        $lecturer->lecturer_name = $request->input('lecturer_name');
        $lecturer->password      = bcrypt('defaultpassword');
        $lecturer->save();

        return redirect()->route('giangvien.index')
                         ->with('success', 'Thêm giảng viên thành công.');
    }

    /**
     * Hiển thị form chỉnh sửa giảng viên.
     */
    public function edit($lecturer_id)
    {
        $lecturer = Lecturer::findOrFail($lecturer_id);
        return view('admin.lecturers.edit', compact('lecturer'));
    }

    /**
     * Cập nhật thông tin giảng viên.
     */
    public function update(Request $request, $lecturer_id)
    {
        $request->validate([
            'lecturer_name' => 'required',
        ]);

        $lecturer = Lecturer::findOrFail($lecturer_id);
        $lecturer->lecturer_name = $request->input('lecturer_name');
        $lecturer->save();

        return redirect()->route('giangvien.index')
                         ->with('success', 'Cập nhật giảng viên thành công.');
    }

    /**
     * Xóa giảng viên.
     */
    public function destroy($lecturer_id)
    {
        $lecturer = Lecturer::findOrFail($lecturer_id);
        $lecturer->delete();

        return redirect()->route('giangvien.index')
                         ->with('success', 'Xóa giảng viên thành công.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CourseService;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        // Nếu cần middleware kiểm tra quyền admin, có thể thêm ở đây
        $this->courseService = $courseService;
    }

    /**
     * Hiển thị danh sách môn học.
     */
    public function index(Request $request)
    {
        $data = $this->courseService->index($request);
        // Giả sử view dành cho admin nằm trong admin/courses
        return view('admin.courses.index', $data);
    }

    /**
     * Xóa môn học.
     */
    public function destroy($course_id)
    {
        $this->courseService->destroy($course_id);
        return redirect()->route('viewmonhoc.index')
            ->with('success', 'Xóa môn học thành công.');
    }
}

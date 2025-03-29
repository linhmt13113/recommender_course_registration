@extends('student.dashboard')

@section('content')
    <h1>Chương trình đào tạo của ngành {{ $student->major->major_name }}</h1>
    @if($curriculum->isEmpty())
        <p>Không có dữ liệu chương trình đào tạo.</p>
    @else
        <table style="border: 1px solid black; border-collapse: collapse;" cellpadding="5">
            <thead>
                <tr>
                    <th>Mã môn</th>
                    <th>Tên môn</th>
                    <th>Loại môn</th>
                    <th>Học kỳ đề nghị</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mergedCurriculum as $item)
                    <tr>
                        <td>{{ $item['course']['course_id'] }}</td>
                        <td>{{ $item['course']['course_name'] }}</td>
                        <td>
                            @if(\Illuminate\Support\Str::startsWith($item['course']['course_id'], 'ELEC-'))
                                Elective
                            @else
                                {{ $item['is_elective'] == 1 ? 'Tự chọn' : 'Bắt buộc' }}
                            @endif
                        </td>
                        <td>{{ $item['recommended_semester'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

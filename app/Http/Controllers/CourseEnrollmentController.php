<?php

namespace App\Http\Controllers;

use App\Models\CourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseEnrollmentController extends Controller
{
    public function show(Request $request)
    {
        $courseType = $request->get('type', 'free');
        
        $courseInfo = $this->getCourseInfo($courseType);
        
        return view('course.enrollment', compact('courseType', 'courseInfo'));
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'course_type' => 'required|string|in:free,premium,n5,n4,n3,n2,n1'
        ]);

        $user = Auth::user();
        $courseType = $request->course_type;

        // Check if user already enrolled
        if ($user->hasEnrollment($courseType)) {
            return redirect()->route('dashboard')
                ->with('info', 'Bạn đã đăng ký khóa học này rồi.');
        }

        // Create enrollment
        CourseEnrollment::create([
            'user_id' => $user->id,
            'course_type' => $courseType,
            'status' => 'active',
            'enrolled_at' => now(),
            'expires_at' => $this->getExpirationDate($courseType)
        ]);

        $courseName = $this->getCourseName($courseType);
        
        return redirect()->route('dashboard')
            ->with('success', "Chúc mừng! Bạn đã đăng ký thành công khóa học {$courseName}.");
    }

    private function getCourseInfo($courseType)
    {
        $courses = [
            'free' => [
                'name' => 'Khóa học miễn phí',
                'description' => 'Truy cập các bài học N5 cơ bản',
                'features' => ['Bài học N5', 'Từ vựng cơ bản', 'Ngữ pháp N5', 'Bài tập N5'],
                'price' => 'Miễn phí',
                'duration' => 'Vĩnh viễn'
            ],
            'premium' => [
                'name' => 'Khóa học Premium',
                'description' => 'Truy cập tất cả khóa học từ N5 đến N1',
                'features' => ['Tất cả bài học N5-N1', '1000+ từ vựng', 'Audio phát âm', 'Analytics chi tiết'],
                'price' => 'Miễn phí',
                'duration' => 'Vĩnh viễn'
            ],
            'n5' => [
                'name' => 'JLPT N5',
                'description' => 'Khóa học luyện thi JLPT N5',
                'features' => ['25 bài học N5', '555 từ vựng', 'Ngữ pháp N5', 'Mock test N5'],
                'price' => 'Miễn phí',
                'duration' => 'Vĩnh viễn'
            ],
            'n4' => [
                'name' => 'JLPT N4',
                'description' => 'Khóa học luyện thi JLPT N4',
                'features' => ['20 bài học N4', 'Từ vựng N4', 'Ngữ pháp N4', 'Mock test N4'],
                'price' => 'Miễn phí',
                'duration' => 'Vĩnh viễn'
            ],
            'n3' => [
                'name' => 'JLPT N3',
                'description' => 'Khóa học luyện thi JLPT N3',
                'features' => ['20 bài học N3', 'Từ vựng N3', 'Ngữ pháp N3', 'Mock test N3'],
                'price' => 'Miễn phí',
                'duration' => 'Vĩnh viễn'
            ],
            'n2' => [
                'name' => 'JLPT N2',
                'description' => 'Khóa học luyện thi JLPT N2',
                'features' => ['20 bài học N2', 'Từ vựng N2', 'Ngữ pháp N2', 'Mock test N2'],
                'price' => 'Miễn phí',
                'duration' => 'Vĩnh viễn'
            ],
            'n1' => [
                'name' => 'JLPT N1',
                'description' => 'Khóa học luyện thi JLPT N1',
                'features' => ['20 bài học N1', 'Từ vựng N1', 'Ngữ pháp N1', 'Mock test N1'],
                'price' => 'Miễn phí',
                'duration' => 'Vĩnh viễn'
            ]
        ];

        return $courses[$courseType] ?? $courses['free'];
    }

    private function getExpirationDate($courseType)
    {
        // For free courses, no expiration
        if ($courseType === 'free') {
            return null;
        }

        // For premium courses, set 1 year expiration
        return now()->addYear();
    }

    private function getCourseName($courseType)
    {
        $courses = [
            'free' => 'Miễn phí',
            'premium' => 'Premium',
            'n5' => 'JLPT N5',
            'n4' => 'JLPT N4',
            'n3' => 'JLPT N3',
            'n2' => 'JLPT N2',
            'n1' => 'JLPT N1',
        ];

        return $courses[$courseType] ?? $courseType;
    }
}

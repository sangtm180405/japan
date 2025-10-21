<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCourseAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $courseType = null): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // If no specific course type required, allow access
        if (!$courseType) {
            return $next($request);
        }

        // Check if user has required enrollment
        if (!$user->hasEnrollment($courseType)) {
            return redirect()->route('course.enrollment', ['type' => $courseType])
                ->with('error', 'Bạn cần đăng ký khóa học để truy cập nội dung này.');
        }

        return $next($request);
    }
}

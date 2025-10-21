<?php

namespace App\Http\Controllers;

use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $progress = $user->progress()
            ->with('lesson')
            ->whereHas('lesson')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        $stats = [
            'total_score' => $user->total_score,
            'completed_lessons' => $user->completed_lessons_count,
            'average_accuracy' => $this->calculateAverageAccuracy($user),
        ];

        return view('profile.index', compact('user', 'progress', 'stats'));
    }

    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('profile.index')
            ->with('success', 'Thông tin cá nhân đã được cập nhật.');
    }

    private function calculateAverageAccuracy($user)
    {
        $progress = $user->progress()->where('total_questions', '>', 0)->get();
        
        if ($progress->isEmpty()) {
            return 0;
        }

        $totalAccuracy = $progress->sum(function ($p) {
            return $p->accuracy_percentage;
        });

        return round($totalAccuracy / $progress->count(), 2);
    }
}

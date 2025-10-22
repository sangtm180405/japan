<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlphabetController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;
use App\Http\Controllers\Admin\VocabularyController as AdminVocabularyController;
use App\Http\Controllers\Admin\ExerciseController as AdminExerciseController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Api\ImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Search routes
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions')
    ->middleware('rate.limit:search,30,1');

// API routes with security
Route::prefix('api')->middleware(['validate.input', 'rate.limit:api,100,1'])->group(function () {
    Route::post('/audio/generate', [\App\Http\Controllers\Api\AudioController::class, 'generateAudio'])->name('api.audio.generate');
});

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Course enrollment routes
Route::get('/course/enrollment', [App\Http\Controllers\CourseEnrollmentController::class, 'show'])->name('course.enrollment');
Route::post('/course/enroll', [App\Http\Controllers\CourseEnrollmentController::class, 'enroll'])->name('course.enroll');

// Protected routes
Route::middleware(['auth', 'validate.input'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    
    // Lessons with rate limiting
    Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
    Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
    Route::post('/lessons/{lesson}/start', [LessonController::class, 'start'])->name('lessons.start')
        ->middleware('rate.limit:lesson.start,10,1');
    Route::post('/lessons/{lesson}/complete', [LessonController::class, 'complete'])->name('lessons.complete')
        ->middleware('rate.limit:lesson.complete,5,1');
    
    // Exercises
    Route::get('/exercises/{exercise}', [ExerciseController::class, 'show'])->name('exercises.show');
    Route::post('/exercises/{exercise}/submit', [ExerciseController::class, 'submit'])->name('exercises.submit');
    
        // Profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        
        // Achievements
        Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
        
        // Analytics
        Route::get('/analytics', [\App\Http\Controllers\AnalyticsController::class, 'index'])->name('analytics.index');
        Route::get('/analytics/progress', [\App\Http\Controllers\AnalyticsController::class, 'getProgressAnalytics'])->name('analytics.progress');
        Route::get('/analytics/performance', [\App\Http\Controllers\AnalyticsController::class, 'getPerformanceAnalytics'])->name('analytics.performance');
        Route::get('/analytics/streak', [\App\Http\Controllers\AnalyticsController::class, 'getStreakAnalytics'])->name('analytics.streak');
        
        // Alphabets
        Route::get('/alphabets', [AlphabetController::class, 'index'])->name('alphabets.index');
        Route::get('/alphabets/{alphabet}', [AlphabetController::class, 'show'])->name('alphabets.show');
        Route::get('/alphabets-practice', [AlphabetController::class, 'practice'])->name('alphabets.practice');
        
        // Practice
        Route::get('/practice', [PracticeController::class, 'index'])->name('practice.index');
        Route::get('/practice/alphabet', [PracticeController::class, 'alphabetPractice'])->name('practice.alphabet');
        Route::get('/practice/vocabulary', [PracticeController::class, 'vocabularyPractice'])->name('practice.vocabulary');
        Route::get('/practice/kanji', [PracticeController::class, 'kanjiPractice'])->name('practice.kanji');
        Route::get('/practice/mixed', [PracticeController::class, 'mixedPractice'])->name('practice.mixed');
        Route::get('/practice/level-test', [PracticeController::class, 'levelTest'])->name('practice.level-test');
        Route::post('/practice/submit-test', [PracticeController::class, 'submitTest'])->name('practice.submit-test');
});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Lessons
    Route::resource('lessons', AdminLessonController::class);
    
    // Vocabularies
    Route::resource('vocabularies', AdminVocabularyController::class);
    
    // Exercises
    Route::resource('exercises', AdminExerciseController::class);
    
    // Videos
    Route::resource('videos', AdminVideoController::class);
});

// API routes for data management
Route::prefix('api')->group(function () {
    Route::post('/import', [ImportController::class, 'importFromJson'])->name('api.import');
    Route::get('/export', [ImportController::class, 'exportToJson'])->name('api.export');
    Route::get('/audio/generate', [App\Http\Controllers\Api\AudioController::class, 'generateAudio'])->name('api.audio.generate');
});

// Audio generator routes
Route::prefix('audio')->group(function () {
    Route::get('/generate', [App\Http\Controllers\AudioGeneratorController::class, 'generateAudioFiles'])->name('audio.generate');
    Route::get('/list', [App\Http\Controllers\AudioGeneratorController::class, 'listAudioFiles'])->name('audio.list');
    Route::get('/download/{type}/{filename}', [App\Http\Controllers\AudioGeneratorController::class, 'downloadAudio'])->name('audio.download');
});

// Admin audio management
Route::get('/admin/audio', function () {
    return view('admin.audio.index');
})->name('admin.audio.index');

// JLPT Practice Routes
Route::prefix('jlpt')->group(function () {
    Route::get('/', [App\Http\Controllers\JLPTController::class, 'index'])->name('jlpt.index');
    Route::get('/level-practice', [App\Http\Controllers\JLPTController::class, 'levelPractice'])->name('jlpt.level-practice');
    Route::get('/mock-test', [App\Http\Controllers\JLPTController::class, 'mockTest'])->name('jlpt.mock-test');
    Route::post('/submit-test', [App\Http\Controllers\JLPTController::class, 'submitMockTest'])->name('jlpt.submit-test');
    Route::get('/progress', [App\Http\Controllers\JLPTController::class, 'progress'])->name('jlpt.progress');
    Route::get('/study-plan', [App\Http\Controllers\JLPTController::class, 'studyPlan'])->name('jlpt.study-plan');
    Route::get('/vocabulary-bank', [App\Http\Controllers\JLPTController::class, 'vocabularyBank'])->name('jlpt.vocabulary-bank');
    Route::get('/topics', [App\Http\Controllers\JLPTController::class, 'topics'])->name('jlpt.topics');
    Route::get('/lessons', [App\Http\Controllers\JLPTController::class, 'lessons'])->name('jlpt.lessons');
    Route::get('/patterns', [App\Http\Controllers\JLPTController::class, 'patterns'])->name('jlpt.patterns');
    Route::get('/dialogues', [App\Http\Controllers\JLPTController::class, 'dialogues'])->name('jlpt.dialogues');
});

// Listening Practice Routes
Route::prefix('listening')->group(function () {
    Route::get('/', [App\Http\Controllers\ListeningController::class, 'index'])->name('listening.index');
    Route::get('/practice', [App\Http\Controllers\ListeningController::class, 'practice'])->name('listening.practice');
    Route::get('/level/{level}', [App\Http\Controllers\ListeningController::class, 'levelPractice'])->name('listening.level-practice');
    Route::get('/{listeningExercise}', [App\Http\Controllers\ListeningController::class, 'show'])->name('listening.show');
    Route::post('/{listeningExercise}/submit', [App\Http\Controllers\ListeningController::class, 'submit'])->name('listening.submit');
});

// Debug route
Route::get('/debug-buttons', function () {
    return view('debug-buttons');
})->name('debug.buttons');

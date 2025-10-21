<?php

require_once 'vendor/autoload.php';

use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Alphabet;

echo "🔍 Debug JLPT Stats:\n\n";

// Check lessons
echo "N5 Lessons (level=1): " . Lesson::where('level', 1)->where('is_active', true)->count() . "\n";
echo "N4 Lessons (level=2): " . Lesson::where('level', 2)->where('is_active', true)->count() . "\n";
echo "N3 Lessons (level=3): " . Lesson::where('level', 3)->where('is_active', true)->count() . "\n";

// Check vocabulary
$n5Vocab = Vocabulary::whereHas('lesson', function($q) {
    $q->where('level', 1);
})->where('is_active', true)->count();
echo "N5 Vocabulary: $n5Vocab\n";

$n4Vocab = Vocabulary::whereHas('lesson', function($q) {
    $q->where('level', 2);
})->where('is_active', true)->count();
echo "N4 Vocabulary: $n4Vocab\n";

// Check kanji
$n5Kanji = Alphabet::where('type', 'kanji')
    ->where('difficulty_level', 1)
    ->where('is_active', true)
    ->count();
echo "N5 Kanji: $n5Kanji\n";

$n4Kanji = Alphabet::where('type', 'kanji')
    ->where('difficulty_level', 2)
    ->where('is_active', true)
    ->count();
echo "N4 Kanji: $n4Kanji\n";

echo "\n✅ Debug completed!\n";

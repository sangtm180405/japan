<?php

require_once 'vendor/autoload.php';

use App\Models\Alphabet;
use App\Models\Lesson;
use App\Models\Vocabulary;

echo "🔍 Kiểm tra dữ liệu:\n\n";

// Alphabet
echo "📝 Bảng chữ cái:\n";
echo "- Tổng: " . Alphabet::count() . "\n";
echo "- Hiragana: " . Alphabet::where('type', 'hiragana')->count() . "\n";
echo "- Katakana: " . Alphabet::where('type', 'katakana')->count() . "\n\n";

// Lessons
echo "📚 Bài học:\n";
echo "- N5 (level=1): " . Lesson::where('level', 1)->count() . "\n";
echo "- N4 (level=2): " . Lesson::where('level', 2)->count() . "\n";
echo "- N3 (level=3): " . Lesson::where('level', 3)->count() . "\n";
echo "- N2 (level=4): " . Lesson::where('level', 4)->count() . "\n";
echo "- N1 (level=5): " . Lesson::where('level', 5)->count() . "\n\n";

// Vocabulary
echo "📖 Từ vựng:\n";
$n5Vocab = Vocabulary::whereHas('lesson', function($q) {
    $q->where('level', 1);
})->count();
echo "- N5: $n5Vocab\n";

$n4Vocab = Vocabulary::whereHas('lesson', function($q) {
    $q->where('level', 2);
})->count();
echo "- N4: $n4Vocab\n";

$n3Vocab = Vocabulary::whereHas('lesson', function($q) {
    $q->where('level', 3);
})->count();
echo "- N3: $n3Vocab\n";

$n2Vocab = Vocabulary::whereHas('lesson', function($q) {
    $q->where('level', 4);
})->count();
echo "- N2: $n2Vocab\n";

$n1Vocab = Vocabulary::whereHas('lesson', function($q) {
    $q->where('level', 5);
})->count();
echo "- N1: $n1Vocab\n\n";

echo "✅ Kiểm tra hoàn thành!\n";

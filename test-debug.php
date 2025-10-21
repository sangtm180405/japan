<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Testing JLPT data...\n";

$level = 1;
$kanji = \App\Models\Alphabet::where('type', 'kanji')
    ->where('difficulty_level', $level)
    ->where('is_active', true)
    ->count();

echo "N5 Kanji count: " . $kanji . "\n";

$vocab = \App\Models\Vocabulary::whereHas('lesson', function($q) use ($level) {
    $q->where('level', $level);
})->where('is_active', true)->count();

echo "N5 Vocabulary count: " . $vocab . "\n";

<?php

/**
 * Backup script for Japanese Learning App
 * Run this before making major changes
 */

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Grammar;
use App\Models\Exercise;
use App\Models\User;

echo "🔄 Creating backup...\n";

// Backup lessons
$lessons = Lesson::all()->toArray();
file_put_contents('backup_lessons.json', json_encode($lessons, JSON_PRETTY_PRINT));

// Backup vocabulary
$vocabulary = Vocabulary::all()->toArray();
file_put_contents('backup_vocabulary.json', json_encode($vocabulary, JSON_PRETTY_PRINT));

// Backup grammar
$grammar = Grammar::all()->toArray();
file_put_contents('backup_grammar.json', json_encode($grammar, JSON_PRETTY_PRINT));

// Backup exercises
$exercises = Exercise::all()->toArray();
file_put_contents('backup_exercises.json', json_encode($exercises, JSON_PRETTY_PRINT));

echo "✅ Backup completed!\n";
echo "📁 Files created:\n";
echo "- backup_lessons.json\n";
echo "- backup_vocabulary.json\n";
echo "- backup_grammar.json\n";
echo "- backup_exercises.json\n";

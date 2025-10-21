<?php

/**
 * 🚀 JAPANESE LEARNING APP - DATA RESTORE SCRIPT
 * 
 * Script khôi phục dữ liệu hoàn chỉnh cho ứng dụng học tiếng Nhật
 * Chạy: php restore_data.php
 * 
 * @author AI Assistant
 * @version 1.0
 */

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Artisan;
use App\Models\Alphabet;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Grammar;
use App\Models\Exercise;
use App\Models\Achievement;

class DataRestorer
{
    private $startTime;
    
    public function __construct()
    {
        $this->startTime = microtime(true);
        echo "🚀 JAPANESE LEARNING APP - DATA RESTORER\n";
        echo "==========================================\n\n";
    }
    
    public function run()
    {
        try {
            $this->clearCache();
            $this->runMigrations();
            $this->seedAlphabet();
            $this->seedJLPTContent();
            $this->seedAchievements();
            $this->verifyData();
            $this->showSummary();
        } catch (Exception $e) {
            echo "❌ Lỗi: " . $e->getMessage() . "\n";
            echo "📍 File: " . $e->getFile() . ":" . $e->getLine() . "\n";
            exit(1);
        }
    }
    
    private function clearCache()
    {
        echo "🧹 Xóa cache...\n";
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        echo "✅ Cache đã được xóa\n\n";
    }
    
    private function runMigrations()
    {
        echo "📊 Chạy migrations...\n";
        Artisan::call('migrate', ['--force' => true]);
        echo "✅ Migrations hoàn thành\n\n";
    }
    
    private function seedAlphabet()
    {
        echo "🔤 Khôi phục bảng chữ cái...\n";
        
        // Hiragana
        $hiragana = $this->getHiraganaData();
        foreach ($hiragana as $char) {
            Alphabet::updateOrCreate(
                ['character' => $char['character'], 'type' => 'hiragana'],
                $char
            );
        }
        echo "✅ Đã khôi phục " . count($hiragana) . " ký tự Hiragana\n";
        
        // Katakana
        $katakana = $this->getKatakanaData();
        foreach ($katakana as $char) {
            Alphabet::updateOrCreate(
                ['character' => $char['character'], 'type' => 'katakana'],
                $char
            );
        }
        echo "✅ Đã khôi phục " . count($katakana) . " ký tự Katakana\n";
        
        // Kanji
        $kanji = $this->getKanjiData();
        foreach ($kanji as $char) {
            Alphabet::updateOrCreate(
                ['character' => $char['character'], 'type' => 'kanji', 'difficulty_level' => $char['difficulty_level']],
                $char
            );
        }
        echo "✅ Đã khôi phục " . count($kanji) . " Kanji\n\n";
    }
    
    private function seedJLPTContent()
    {
        echo "📚 Khôi phục nội dung JLPT...\n";
        Artisan::call('db:seed', ['--class' => 'CompleteJLPTSeeder']);
        echo "✅ Nội dung JLPT đã được khôi phục\n\n";
    }
    
    private function seedAchievements()
    {
        echo "🏆 Khôi phục hệ thống thành tích...\n";
        Artisan::call('db:seed', ['--class' => 'AchievementSeeder']);
        echo "✅ Hệ thống thành tích đã được khôi phục\n\n";
    }
    
    private function verifyData()
    {
        echo "🔍 Kiểm tra dữ liệu...\n";
        
        $stats = [
            'hiragana' => Alphabet::where('type', 'hiragana')->count(),
            'katakana' => Alphabet::where('type', 'katakana')->count(),
            'kanji' => Alphabet::where('type', 'kanji')->count(),
            'lessons' => Lesson::count(),
            'vocabulary' => Vocabulary::count(),
            'grammar' => Grammar::count(),
            'exercises' => Exercise::count(),
            'achievements' => Achievement::count(),
        ];
        
        foreach ($stats as $type => $count) {
            echo "  - {$type}: {$count}\n";
        }
        echo "\n";
    }
    
    private function showSummary()
    {
        $endTime = microtime(true);
        $duration = round($endTime - $this->startTime, 2);
        
        echo "🎉 KHÔI PHỤC DỮ LIỆU HOÀN TẤT!\n";
        echo "===============================\n";
        echo "⏱️  Thời gian: {$duration} giây\n";
        echo "🌐 Truy cập: http://localhost:8000\n";
        echo "📊 JLPT Dashboard: http://localhost:8000/jlpt\n";
        echo "🔍 Analytics: http://localhost:8000/analytics\n";
        echo "🏆 Achievements: http://localhost:8000/achievements\n\n";
        echo "✨ App đã sẵn sàng để sử dụng!\n";
    }
    
    private function getHiraganaData()
    {
        return [
            ['character' => 'あ', 'romaji' => 'a', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'い', 'romaji' => 'i', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'う', 'romaji' => 'u', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'え', 'romaji' => 'e', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'お', 'romaji' => 'o', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'か', 'romaji' => 'ka', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'き', 'romaji' => 'ki', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'く', 'romaji' => 'ku', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'け', 'romaji' => 'ke', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'こ', 'romaji' => 'ko', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'さ', 'romaji' => 'sa', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'し', 'romaji' => 'shi', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'す', 'romaji' => 'su', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'せ', 'romaji' => 'se', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'そ', 'romaji' => 'so', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'た', 'romaji' => 'ta', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ち', 'romaji' => 'chi', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'つ', 'romaji' => 'tsu', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'て', 'romaji' => 'te', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'と', 'romaji' => 'to', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'な', 'romaji' => 'na', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'に', 'romaji' => 'ni', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ぬ', 'romaji' => 'nu', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ね', 'romaji' => 'ne', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'の', 'romaji' => 'no', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'は', 'romaji' => 'ha', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ひ', 'romaji' => 'hi', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ふ', 'romaji' => 'fu', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'へ', 'romaji' => 'he', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ほ', 'romaji' => 'ho', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ま', 'romaji' => 'ma', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'み', 'romaji' => 'mi', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'む', 'romaji' => 'mu', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'め', 'romaji' => 'me', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'も', 'romaji' => 'mo', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'や', 'romaji' => 'ya', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ゆ', 'romaji' => 'yu', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'よ', 'romaji' => 'yo', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ら', 'romaji' => 'ra', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'り', 'romaji' => 'ri', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'る', 'romaji' => 'ru', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'れ', 'romaji' => 're', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ろ', 'romaji' => 'ro', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'わ', 'romaji' => 'wa', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'を', 'romaji' => 'wo', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ん', 'romaji' => 'n', 'type' => 'hiragana', 'difficulty_level' => 1, 'is_active' => true],
        ];
    }
    
    private function getKatakanaData()
    {
        return [
            ['character' => 'ア', 'romaji' => 'a', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'イ', 'romaji' => 'i', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ウ', 'romaji' => 'u', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'エ', 'romaji' => 'e', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'オ', 'romaji' => 'o', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'カ', 'romaji' => 'ka', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'キ', 'romaji' => 'ki', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ク', 'romaji' => 'ku', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ケ', 'romaji' => 'ke', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'コ', 'romaji' => 'ko', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'サ', 'romaji' => 'sa', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'シ', 'romaji' => 'shi', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ス', 'romaji' => 'su', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'セ', 'romaji' => 'se', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ソ', 'romaji' => 'so', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'タ', 'romaji' => 'ta', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'チ', 'romaji' => 'chi', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ツ', 'romaji' => 'tsu', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'テ', 'romaji' => 'te', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ト', 'romaji' => 'to', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ナ', 'romaji' => 'na', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ニ', 'romaji' => 'ni', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ヌ', 'romaji' => 'nu', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ネ', 'romaji' => 'ne', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ノ', 'romaji' => 'no', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ハ', 'romaji' => 'ha', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ヒ', 'romaji' => 'hi', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'フ', 'romaji' => 'fu', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ヘ', 'romaji' => 'he', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ホ', 'romaji' => 'ho', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'マ', 'romaji' => 'ma', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ミ', 'romaji' => 'mi', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ム', 'romaji' => 'mu', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'メ', 'romaji' => 'me', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'モ', 'romaji' => 'mo', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ヤ', 'romaji' => 'ya', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ユ', 'romaji' => 'yu', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ヨ', 'romaji' => 'yo', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ラ', 'romaji' => 'ra', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'リ', 'romaji' => 'ri', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ル', 'romaji' => 'ru', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'レ', 'romaji' => 're', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ロ', 'romaji' => 'ro', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ワ', 'romaji' => 'wa', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ヲ', 'romaji' => 'wo', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ン', 'romaji' => 'n', 'type' => 'katakana', 'difficulty_level' => 1, 'is_active' => true],
        ];
    }
    
    private function getKanjiData()
    {
        return [
            // N5 Kanji (Basic)
            ['character' => '一', 'romaji' => 'ichi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '二', 'romaji' => 'ni', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '三', 'romaji' => 'san', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '四', 'romaji' => 'yon', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '五', 'romaji' => 'go', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '六', 'romaji' => 'roku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '七', 'romaji' => 'nana', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '八', 'romaji' => 'hachi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '九', 'romaji' => 'kyuu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '十', 'romaji' => 'juu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '人', 'romaji' => 'hito', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '大', 'romaji' => 'dai', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '小', 'romaji' => 'shou', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '中', 'romaji' => 'chuu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '上', 'romaji' => 'ue', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '下', 'romaji' => 'shita', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '左', 'romaji' => 'hidari', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '右', 'romaji' => 'migi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '前', 'romaji' => 'mae', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '後', 'romaji' => 'ushiro', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '年', 'romaji' => 'nen', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '月', 'romaji' => 'tsuki', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '日', 'romaji' => 'hi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '時', 'romaji' => 'toki', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '分', 'romaji' => 'fun', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '今', 'romaji' => 'ima', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '来', 'romaji' => 'kuru', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '行', 'romaji' => 'iku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '見', 'romaji' => 'miru', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '聞', 'romaji' => 'kiku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '話', 'romaji' => 'hanasu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '読', 'romaji' => 'yomu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '書', 'romaji' => 'kaku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '買', 'romaji' => 'kau', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '売', 'romaji' => 'uru', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '食', 'romaji' => 'taberu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '飲', 'romaji' => 'nomu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '住', 'romaji' => 'sumu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '家', 'romaji' => 'ie', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '学校', 'romaji' => 'gakkou', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '会社', 'romaji' => 'kaisha', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '病院', 'romaji' => 'byouin', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '銀行', 'romaji' => 'ginkou', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '駅', 'romaji' => 'eki', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '電車', 'romaji' => 'densha', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '車', 'romaji' => 'kuruma', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '自転車', 'romaji' => 'jitensha', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '飛行機', 'romaji' => 'hikouki', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '船', 'romaji' => 'fune', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '新', 'romaji' => 'atarashii', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '古', 'romaji' => 'furui', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '高', 'romaji' => 'takai', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '安', 'romaji' => 'yasui', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '長', 'romaji' => 'nagai', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '短', 'romaji' => 'mijikai', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '広', 'romaji' => 'hiroi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '狭', 'romaji' => 'semai', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '多', 'romaji' => 'ooi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '少', 'romaji' => 'sukunai', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '早', 'romaji' => 'hayai', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '遅', 'romaji' => 'osoi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '忙', 'romaji' => 'isogashii', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '暇', 'romaji' => 'hima', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '楽', 'romaji' => 'tanoshii', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '面白', 'romaji' => 'omoshiroi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '簡単', 'romaji' => 'kantan', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '難しい', 'romaji' => 'muzukashii', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '便利', 'romaji' => 'benri', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '不便', 'romaji' => 'fuben', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '元気', 'romaji' => 'genki', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '病気', 'romaji' => 'byouki', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '疲', 'romaji' => 'tsukareru', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '眠', 'romaji' => 'nemui', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '起', 'romaji' => 'okiru', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '寝', 'romaji' => 'neru', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '働', 'romaji' => 'hataraku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '勉強', 'romaji' => 'benkyou', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '練習', 'romaji' => 'renshuu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '仕事', 'romaji' => 'shigoto', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '休', 'romaji' => 'yasumu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '遊', 'romaji' => 'asobu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '会', 'romaji' => 'au', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '友達', 'romaji' => 'tomodachi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '家族', 'romaji' => 'kazoku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '父', 'romaji' => 'chichi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '母', 'romaji' => 'haha', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '兄', 'romaji' => 'ani', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '姉', 'romaji' => 'ane', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '弟', 'romaji' => 'otouto', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '妹', 'romaji' => 'imouto', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '子', 'romaji' => 'ko', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '先生', 'romaji' => 'sensei', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '学生', 'romaji' => 'gakusei', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '医者', 'romaji' => 'isha', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '看護師', 'romaji' => 'kangoshi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '警察', 'romaji' => 'keisatsu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '運転手', 'romaji' => 'untenshu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '店員', 'romaji' => 'tenin', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '客', 'romaji' => 'kyaku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '生徒', 'romaji' => 'seito', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '恋人', 'romaji' => 'koibito', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '結婚', 'romaji' => 'kekkon', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '離婚', 'romaji' => 'rikon', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '赤', 'romaji' => 'aka', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '青', 'romaji' => 'ao', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '白', 'romaji' => 'shiro', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '黒', 'romaji' => 'kuro', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '緑', 'romaji' => 'midori', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '黄色', 'romaji' => 'kiiro', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '茶色', 'romaji' => 'chairo', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '紫', 'romaji' => 'murasaki', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ピンク', 'romaji' => 'pinku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'グレー', 'romaji' => 'guree', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            
            // N4 Kanji (Elementary)
            ['character' => '学', 'romaji' => 'gaku', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '校', 'romaji' => 'kou', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '生', 'romaji' => 'sei', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '先', 'romaji' => 'sen', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '活', 'romaji' => 'katsu', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '動', 'romaji' => 'dou', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '物', 'romaji' => 'butsu', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '事', 'romaji' => 'koto', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '用', 'romaji' => 'you', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '方', 'romaji' => 'hou', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '法', 'romaji' => 'hou', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '式', 'romaji' => 'shiki', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '形', 'romaji' => 'katachi', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '色', 'romaji' => 'iro', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '音', 'romaji' => 'oto', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '声', 'romaji' => 'koe', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '味', 'romaji' => 'aji', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '香', 'romaji' => 'kaori', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '触', 'romaji' => 'sawaru', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '感', 'romaji' => 'kan', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '覚', 'romaji' => 'oboeru', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '思', 'romaji' => 'omou', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '考', 'romaji' => 'kangaeru', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '知', 'romaji' => 'shiru', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '分', 'romaji' => 'wakarimasu', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '理', 'romaji' => 'ri', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '解', 'romaji' => 'kai', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '答', 'romaji' => 'kotae', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '問', 'romaji' => 'toi', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '題', 'romaji' => 'dai', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '正', 'romaji' => 'tadashii', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '間', 'romaji' => 'aida', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '違', 'romaji' => 'chigau', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '同', 'romaji' => 'onaji', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '別', 'romaji' => 'betsu', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '他', 'romaji' => 'hoka', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '自', 'romaji' => 'jibun', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '私', 'romaji' => 'watashi', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '君', 'romaji' => 'kimi', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '彼', 'romaji' => 'kare', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '彼女', 'romaji' => 'kanojo', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '私達', 'romaji' => 'watashitachi', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '皆', 'romaji' => 'minna', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '全', 'romaji' => 'zen', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '部', 'romaji' => 'bu', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '分', 'romaji' => 'bun', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '半', 'romaji' => 'han', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            
            // N3-N1 Kanji (Intermediate to Advanced)
            ['character' => '語', 'romaji' => 'go', 'type' => 'kanji', 'difficulty_level' => 3, 'is_active' => true],
            ['character' => '言', 'romaji' => 'i', 'type' => 'kanji', 'difficulty_level' => 3, 'is_active' => true],
            ['character' => '話', 'romaji' => 'wa', 'type' => 'kanji', 'difficulty_level' => 3, 'is_active' => true],
            ['character' => '会', 'romaji' => 'kai', 'type' => 'kanji', 'difficulty_level' => 3, 'is_active' => true],
            ['character' => '社', 'romaji' => 'sha', 'type' => 'kanji', 'difficulty_level' => 3, 'is_active' => true],
            ['character' => '経', 'romaji' => 'kei', 'type' => 'kanji', 'difficulty_level' => 4, 'is_active' => true],
            ['character' => '済', 'romaji' => 'sai', 'type' => 'kanji', 'difficulty_level' => 4, 'is_active' => true],
            ['character' => '政', 'romaji' => 'sei', 'type' => 'kanji', 'difficulty_level' => 4, 'is_active' => true],
            ['character' => '治', 'romaji' => 'chi', 'type' => 'kanji', 'difficulty_level' => 4, 'is_active' => true],
            ['character' => '法', 'romaji' => 'hou', 'type' => 'kanji', 'difficulty_level' => 4, 'is_active' => true],
            ['character' => '複', 'romaji' => 'fuku', 'type' => 'kanji', 'difficulty_level' => 5, 'is_active' => true],
            ['character' => '雑', 'romaji' => 'zatsu', 'type' => 'kanji', 'difficulty_level' => 5, 'is_active' => true],
            ['character' => '難', 'romaji' => 'nan', 'type' => 'kanji', 'difficulty_level' => 5, 'is_active' => true],
            ['character' => '解', 'romaji' => 'kai', 'type' => 'kanji', 'difficulty_level' => 5, 'is_active' => true],
            ['character' => '析', 'romaji' => 'seki', 'type' => 'kanji', 'difficulty_level' => 5, 'is_active' => true],
        ];
    }
}

// Chạy script khôi phục
$restorer = new DataRestorer();
$restorer->run();

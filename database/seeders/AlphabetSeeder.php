<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alphabet;

class AlphabetSeeder extends Seeder
{
    public function run()
    {
        echo "🔤 Tạo bảng chữ cái Hiragana và Katakana...\n";

        // Hiragana characters
        $hiragana = [
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

        // Katakana characters
        $katakana = [
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

        // Insert Hiragana
        foreach ($hiragana as $char) {
            Alphabet::create($char);
        }
        echo "✅ Đã tạo " . count($hiragana) . " ký tự Hiragana\n";

        // Insert Katakana
        foreach ($katakana as $char) {
            Alphabet::create($char);
        }
        echo "✅ Đã tạo " . count($katakana) . " ký tự Katakana\n";

        echo "🎉 Hoàn thành tạo bảng chữ cái!\n";
    }
}
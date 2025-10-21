<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alphabet;

class CompleteAlphabetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ
        Alphabet::truncate();

        // HIRAGANA - Bảng chữ cái cơ bản (46 ký tự)
        $hiragana = [
            // Nguyên âm
            ['character' => 'あ', 'romaji' => 'a', 'type' => 'hiragana', 'category' => 'vowel', 'description' => 'Nguyên âm A', 'difficulty_level' => 1, 'order' => 1],
            ['character' => 'い', 'romaji' => 'i', 'type' => 'hiragana', 'category' => 'vowel', 'description' => 'Nguyên âm I', 'difficulty_level' => 1, 'order' => 2],
            ['character' => 'う', 'romaji' => 'u', 'type' => 'hiragana', 'category' => 'vowel', 'description' => 'Nguyên âm U', 'difficulty_level' => 1, 'order' => 3],
            ['character' => 'え', 'romaji' => 'e', 'type' => 'hiragana', 'category' => 'vowel', 'description' => 'Nguyên âm E', 'difficulty_level' => 1, 'order' => 4],
            ['character' => 'お', 'romaji' => 'o', 'type' => 'hiragana', 'category' => 'vowel', 'description' => 'Nguyên âm O', 'difficulty_level' => 1, 'order' => 5],
            
            // Phụ âm K
            ['character' => 'か', 'romaji' => 'ka', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm KA', 'difficulty_level' => 1, 'order' => 6],
            ['character' => 'き', 'romaji' => 'ki', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm KI', 'difficulty_level' => 1, 'order' => 7],
            ['character' => 'く', 'romaji' => 'ku', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm KU', 'difficulty_level' => 1, 'order' => 8],
            ['character' => 'け', 'romaji' => 'ke', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm KE', 'difficulty_level' => 1, 'order' => 9],
            ['character' => 'こ', 'romaji' => 'ko', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm KO', 'difficulty_level' => 1, 'order' => 10],
            
            // Phụ âm S
            ['character' => 'さ', 'romaji' => 'sa', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm SA', 'difficulty_level' => 1, 'order' => 11],
            ['character' => 'し', 'romaji' => 'shi', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm SHI', 'difficulty_level' => 1, 'order' => 12],
            ['character' => 'す', 'romaji' => 'su', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm SU', 'difficulty_level' => 1, 'order' => 13],
            ['character' => 'せ', 'romaji' => 'se', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm SE', 'difficulty_level' => 1, 'order' => 14],
            ['character' => 'そ', 'romaji' => 'so', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm SO', 'difficulty_level' => 1, 'order' => 15],
            
            // Phụ âm T
            ['character' => 'た', 'romaji' => 'ta', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm TA', 'difficulty_level' => 1, 'order' => 16],
            ['character' => 'ち', 'romaji' => 'chi', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm CHI', 'difficulty_level' => 1, 'order' => 17],
            ['character' => 'つ', 'romaji' => 'tsu', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm TSU', 'difficulty_level' => 1, 'order' => 18],
            ['character' => 'て', 'romaji' => 'te', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm TE', 'difficulty_level' => 1, 'order' => 19],
            ['character' => 'と', 'romaji' => 'to', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm TO', 'difficulty_level' => 1, 'order' => 20],
            
            // Phụ âm N
            ['character' => 'な', 'romaji' => 'na', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm NA', 'difficulty_level' => 1, 'order' => 21],
            ['character' => 'に', 'romaji' => 'ni', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm NI', 'difficulty_level' => 1, 'order' => 22],
            ['character' => 'ぬ', 'romaji' => 'nu', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm NU', 'difficulty_level' => 1, 'order' => 23],
            ['character' => 'ね', 'romaji' => 'ne', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm NE', 'difficulty_level' => 1, 'order' => 24],
            ['character' => 'の', 'romaji' => 'no', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm NO', 'difficulty_level' => 1, 'order' => 25],
            
            // Phụ âm H
            ['character' => 'は', 'romaji' => 'ha', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm HA', 'difficulty_level' => 1, 'order' => 26],
            ['character' => 'ひ', 'romaji' => 'hi', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm HI', 'difficulty_level' => 1, 'order' => 27],
            ['character' => 'ふ', 'romaji' => 'fu', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm FU', 'difficulty_level' => 1, 'order' => 28],
            ['character' => 'へ', 'romaji' => 'he', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm HE', 'difficulty_level' => 1, 'order' => 29],
            ['character' => 'ほ', 'romaji' => 'ho', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm HO', 'difficulty_level' => 1, 'order' => 30],
            
            // Phụ âm M
            ['character' => 'ま', 'romaji' => 'ma', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm MA', 'difficulty_level' => 1, 'order' => 31],
            ['character' => 'み', 'romaji' => 'mi', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm MI', 'difficulty_level' => 1, 'order' => 32],
            ['character' => 'む', 'romaji' => 'mu', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm MU', 'difficulty_level' => 1, 'order' => 33],
            ['character' => 'め', 'romaji' => 'me', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm ME', 'difficulty_level' => 1, 'order' => 34],
            ['character' => 'も', 'romaji' => 'mo', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm MO', 'difficulty_level' => 1, 'order' => 35],
            
            // Phụ âm Y
            ['character' => 'や', 'romaji' => 'ya', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm YA', 'difficulty_level' => 1, 'order' => 36],
            ['character' => 'ゆ', 'romaji' => 'yu', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm YU', 'difficulty_level' => 1, 'order' => 37],
            ['character' => 'よ', 'romaji' => 'yo', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm YO', 'difficulty_level' => 1, 'order' => 38],
            
            // Phụ âm R
            ['character' => 'ら', 'romaji' => 'ra', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm RA', 'difficulty_level' => 1, 'order' => 39],
            ['character' => 'り', 'romaji' => 'ri', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm RI', 'difficulty_level' => 1, 'order' => 40],
            ['character' => 'る', 'romaji' => 'ru', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm RU', 'difficulty_level' => 1, 'order' => 41],
            ['character' => 'れ', 'romaji' => 're', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm RE', 'difficulty_level' => 1, 'order' => 42],
            ['character' => 'ろ', 'romaji' => 'ro', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm RO', 'difficulty_level' => 1, 'order' => 43],
            
            // Phụ âm W và N
            ['character' => 'わ', 'romaji' => 'wa', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm WA', 'difficulty_level' => 1, 'order' => 44],
            ['character' => 'を', 'romaji' => 'wo', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm WO', 'difficulty_level' => 1, 'order' => 45],
            ['character' => 'ん', 'romaji' => 'n', 'type' => 'hiragana', 'category' => 'consonant', 'description' => 'Phụ âm N', 'difficulty_level' => 1, 'order' => 46],
        ];

        // KATAKANA - Bảng chữ cái cho từ nước ngoài (46 ký tự)
        $katakana = [
            // Nguyên âm
            ['character' => 'ア', 'romaji' => 'a', 'type' => 'katakana', 'category' => 'vowel', 'description' => 'Nguyên âm A (Katakana)', 'difficulty_level' => 1, 'order' => 1],
            ['character' => 'イ', 'romaji' => 'i', 'type' => 'katakana', 'category' => 'vowel', 'description' => 'Nguyên âm I (Katakana)', 'difficulty_level' => 1, 'order' => 2],
            ['character' => 'ウ', 'romaji' => 'u', 'type' => 'katakana', 'category' => 'vowel', 'description' => 'Nguyên âm U (Katakana)', 'difficulty_level' => 1, 'order' => 3],
            ['character' => 'エ', 'romaji' => 'e', 'type' => 'katakana', 'category' => 'vowel', 'description' => 'Nguyên âm E (Katakana)', 'difficulty_level' => 1, 'order' => 4],
            ['character' => 'オ', 'romaji' => 'o', 'type' => 'katakana', 'category' => 'vowel', 'description' => 'Nguyên âm O (Katakana)', 'difficulty_level' => 1, 'order' => 5],
            
            // Phụ âm K
            ['character' => 'カ', 'romaji' => 'ka', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm KA (Katakana)', 'difficulty_level' => 1, 'order' => 6],
            ['character' => 'キ', 'romaji' => 'ki', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm KI (Katakana)', 'difficulty_level' => 1, 'order' => 7],
            ['character' => 'ク', 'romaji' => 'ku', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm KU (Katakana)', 'difficulty_level' => 1, 'order' => 8],
            ['character' => 'ケ', 'romaji' => 'ke', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm KE (Katakana)', 'difficulty_level' => 1, 'order' => 9],
            ['character' => 'コ', 'romaji' => 'ko', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm KO (Katakana)', 'difficulty_level' => 1, 'order' => 10],
            
            // Phụ âm S
            ['character' => 'サ', 'romaji' => 'sa', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm SA (Katakana)', 'difficulty_level' => 1, 'order' => 11],
            ['character' => 'シ', 'romaji' => 'shi', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm SHI (Katakana)', 'difficulty_level' => 1, 'order' => 12],
            ['character' => 'ス', 'romaji' => 'su', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm SU (Katakana)', 'difficulty_level' => 1, 'order' => 13],
            ['character' => 'セ', 'romaji' => 'se', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm SE (Katakana)', 'difficulty_level' => 1, 'order' => 14],
            ['character' => 'ソ', 'romaji' => 'so', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm SO (Katakana)', 'difficulty_level' => 1, 'order' => 15],
            
            // Phụ âm T
            ['character' => 'タ', 'romaji' => 'ta', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm TA (Katakana)', 'difficulty_level' => 1, 'order' => 16],
            ['character' => 'チ', 'romaji' => 'chi', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm CHI (Katakana)', 'difficulty_level' => 1, 'order' => 17],
            ['character' => 'ツ', 'romaji' => 'tsu', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm TSU (Katakana)', 'difficulty_level' => 1, 'order' => 18],
            ['character' => 'テ', 'romaji' => 'te', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm TE (Katakana)', 'difficulty_level' => 1, 'order' => 19],
            ['character' => 'ト', 'romaji' => 'to', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm TO (Katakana)', 'difficulty_level' => 1, 'order' => 20],
            
            // Phụ âm N
            ['character' => 'ナ', 'romaji' => 'na', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm NA (Katakana)', 'difficulty_level' => 1, 'order' => 21],
            ['character' => 'ニ', 'romaji' => 'ni', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm NI (Katakana)', 'difficulty_level' => 1, 'order' => 22],
            ['character' => 'ヌ', 'romaji' => 'nu', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm NU (Katakana)', 'difficulty_level' => 1, 'order' => 23],
            ['character' => 'ネ', 'romaji' => 'ne', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm NE (Katakana)', 'difficulty_level' => 1, 'order' => 24],
            ['character' => 'ノ', 'romaji' => 'no', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm NO (Katakana)', 'difficulty_level' => 1, 'order' => 25],
            
            // Phụ âm H
            ['character' => 'ハ', 'romaji' => 'ha', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm HA (Katakana)', 'difficulty_level' => 1, 'order' => 26],
            ['character' => 'ヒ', 'romaji' => 'hi', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm HI (Katakana)', 'difficulty_level' => 1, 'order' => 27],
            ['character' => 'フ', 'romaji' => 'fu', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm FU (Katakana)', 'difficulty_level' => 1, 'order' => 28],
            ['character' => 'ヘ', 'romaji' => 'he', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm HE (Katakana)', 'difficulty_level' => 1, 'order' => 29],
            ['character' => 'ホ', 'romaji' => 'ho', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm HO (Katakana)', 'difficulty_level' => 1, 'order' => 30],
            
            // Phụ âm M
            ['character' => 'マ', 'romaji' => 'ma', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm MA (Katakana)', 'difficulty_level' => 1, 'order' => 31],
            ['character' => 'ミ', 'romaji' => 'mi', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm MI (Katakana)', 'difficulty_level' => 1, 'order' => 32],
            ['character' => 'ム', 'romaji' => 'mu', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm MU (Katakana)', 'difficulty_level' => 1, 'order' => 33],
            ['character' => 'メ', 'romaji' => 'me', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm ME (Katakana)', 'difficulty_level' => 1, 'order' => 34],
            ['character' => 'モ', 'romaji' => 'mo', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm MO (Katakana)', 'difficulty_level' => 1, 'order' => 35],
            
            // Phụ âm Y
            ['character' => 'ヤ', 'romaji' => 'ya', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm YA (Katakana)', 'difficulty_level' => 1, 'order' => 36],
            ['character' => 'ユ', 'romaji' => 'yu', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm YU (Katakana)', 'difficulty_level' => 1, 'order' => 37],
            ['character' => 'ヨ', 'romaji' => 'yo', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm YO (Katakana)', 'difficulty_level' => 1, 'order' => 38],
            
            // Phụ âm R
            ['character' => 'ラ', 'romaji' => 'ra', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm RA (Katakana)', 'difficulty_level' => 1, 'order' => 39],
            ['character' => 'リ', 'romaji' => 'ri', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm RI (Katakana)', 'difficulty_level' => 1, 'order' => 40],
            ['character' => 'ル', 'romaji' => 'ru', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm RU (Katakana)', 'difficulty_level' => 1, 'order' => 41],
            ['character' => 'レ', 'romaji' => 're', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm RE (Katakana)', 'difficulty_level' => 1, 'order' => 42],
            ['character' => 'ロ', 'romaji' => 'ro', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm RO (Katakana)', 'difficulty_level' => 1, 'order' => 43],
            
            // Phụ âm W và N
            ['character' => 'ワ', 'romaji' => 'wa', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm WA (Katakana)', 'difficulty_level' => 1, 'order' => 44],
            ['character' => 'ヲ', 'romaji' => 'wo', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm WO (Katakana)', 'difficulty_level' => 1, 'order' => 45],
            ['character' => 'ン', 'romaji' => 'n', 'type' => 'katakana', 'category' => 'consonant', 'description' => 'Phụ âm N (Katakana)', 'difficulty_level' => 1, 'order' => 46],
        ];

        // KANJI cơ bản - JLPT N5 (80 ký tự quan trọng)
        $kanji = [
            // Số đếm
            ['character' => '一', 'romaji' => 'ichi', 'type' => 'kanji', 'category' => 'number', 'description' => 'Số 1', 'stroke_order' => '1', 'difficulty_level' => 1, 'order' => 1],
            ['character' => '二', 'romaji' => 'ni', 'type' => 'kanji', 'category' => 'number', 'description' => 'Số 2', 'stroke_order' => '2', 'difficulty_level' => 1, 'order' => 2],
            ['character' => '三', 'romaji' => 'san', 'type' => 'kanji', 'category' => 'number', 'description' => 'Số 3', 'stroke_order' => '3', 'difficulty_level' => 1, 'order' => 3],
            ['character' => '四', 'romaji' => 'yon', 'type' => 'kanji', 'category' => 'number', 'description' => 'Số 4', 'stroke_order' => '5', 'difficulty_level' => 1, 'order' => 4],
            ['character' => '五', 'romaji' => 'go', 'type' => 'kanji', 'category' => 'number', 'description' => 'Số 5', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 5],
            ['character' => '六', 'romaji' => 'roku', 'type' => 'kanji', 'category' => 'number', 'description' => 'Số 6', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 6],
            ['character' => '七', 'romaji' => 'nana', 'type' => 'kanji', 'category' => 'number', 'description' => 'Số 7', 'stroke_order' => '2', 'difficulty_level' => 1, 'order' => 7],
            ['character' => '八', 'romaji' => 'hachi', 'type' => 'kanji', 'category' => 'number', 'description' => 'Số 8', 'stroke_order' => '2', 'difficulty_level' => 1, 'order' => 8],
            ['character' => '九', 'romaji' => 'kyuu', 'type' => 'kanji', 'category' => 'number', 'description' => 'Số 9', 'stroke_order' => '2', 'difficulty_level' => 1, 'order' => 9],
            ['character' => '十', 'romaji' => 'juu', 'type' => 'kanji', 'category' => 'number', 'description' => 'Số 10', 'stroke_order' => '2', 'difficulty_level' => 1, 'order' => 10],
            ['character' => '百', 'romaji' => 'hyaku', 'type' => 'kanji', 'category' => 'number', 'description' => 'Số 100', 'stroke_order' => '6', 'difficulty_level' => 1, 'order' => 11],
            ['character' => '千', 'romaji' => 'sen', 'type' => 'kanji', 'category' => 'number', 'description' => 'Số 1000', 'stroke_order' => '3', 'difficulty_level' => 1, 'order' => 12],
            ['character' => '万', 'romaji' => 'man', 'type' => 'kanji', 'category' => 'number', 'description' => 'Số 10000', 'stroke_order' => '3', 'difficulty_level' => 1, 'order' => 13],
            
            // Thời gian
            ['character' => '年', 'romaji' => 'nen', 'type' => 'kanji', 'category' => 'time', 'description' => 'Năm', 'stroke_order' => '6', 'difficulty_level' => 1, 'order' => 14],
            ['character' => '月', 'romaji' => 'tsuki', 'type' => 'kanji', 'category' => 'time', 'description' => 'Tháng, mặt trăng', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 15],
            ['character' => '日', 'romaji' => 'hi', 'type' => 'kanji', 'category' => 'time', 'description' => 'Ngày, mặt trời', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 16],
            ['character' => '時', 'romaji' => 'ji', 'type' => 'kanji', 'category' => 'time', 'description' => 'Giờ, thời gian', 'stroke_order' => '10', 'difficulty_level' => 1, 'order' => 17],
            ['character' => '分', 'romaji' => 'fun', 'type' => 'kanji', 'category' => 'time', 'description' => 'Phút, phần', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 18],
            
            // Người và gia đình
            ['character' => '人', 'romaji' => 'hito', 'type' => 'kanji', 'category' => 'person', 'description' => 'Người', 'stroke_order' => '2', 'difficulty_level' => 1, 'order' => 19],
            ['character' => '男', 'romaji' => 'otoko', 'type' => 'kanji', 'category' => 'person', 'description' => 'Nam giới', 'stroke_order' => '7', 'difficulty_level' => 1, 'order' => 20],
            ['character' => '女', 'romaji' => 'onna', 'type' => 'kanji', 'category' => 'person', 'description' => 'Nữ giới', 'stroke_order' => '3', 'difficulty_level' => 1, 'order' => 21],
            ['character' => '子', 'romaji' => 'ko', 'type' => 'kanji', 'category' => 'person', 'description' => 'Con', 'stroke_order' => '3', 'difficulty_level' => 1, 'order' => 22],
            ['character' => '父', 'romaji' => 'chichi', 'type' => 'kanji', 'category' => 'person', 'description' => 'Cha', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 23],
            ['character' => '母', 'romaji' => 'haha', 'type' => 'kanji', 'category' => 'person', 'description' => 'Mẹ', 'stroke_order' => '5', 'difficulty_level' => 1, 'order' => 24],
            
            // Tự nhiên
            ['character' => '山', 'romaji' => 'yama', 'type' => 'kanji', 'category' => 'nature', 'description' => 'Núi', 'stroke_order' => '3', 'difficulty_level' => 1, 'order' => 25],
            ['character' => '川', 'romaji' => 'kawa', 'type' => 'kanji', 'category' => 'nature', 'description' => 'Sông', 'stroke_order' => '3', 'difficulty_level' => 1, 'order' => 26],
            ['character' => '海', 'romaji' => 'umi', 'type' => 'kanji', 'category' => 'nature', 'description' => 'Biển', 'stroke_order' => '9', 'difficulty_level' => 1, 'order' => 27],
            ['character' => '空', 'romaji' => 'sora', 'type' => 'kanji', 'category' => 'nature', 'description' => 'Bầu trời', 'stroke_order' => '8', 'difficulty_level' => 1, 'order' => 28],
            ['character' => '木', 'romaji' => 'ki', 'type' => 'kanji', 'category' => 'nature', 'description' => 'Cây', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 29],
            ['character' => '花', 'romaji' => 'hana', 'type' => 'kanji', 'category' => 'nature', 'description' => 'Hoa', 'stroke_order' => '7', 'difficulty_level' => 1, 'order' => 30],
            
            // Màu sắc
            ['character' => '白', 'romaji' => 'shiro', 'type' => 'kanji', 'category' => 'color', 'description' => 'Màu trắng', 'stroke_order' => '5', 'difficulty_level' => 1, 'order' => 31],
            ['character' => '黒', 'romaji' => 'kuro', 'type' => 'kanji', 'category' => 'color', 'description' => 'Màu đen', 'stroke_order' => '11', 'difficulty_level' => 1, 'order' => 32],
            ['character' => '赤', 'romaji' => 'aka', 'type' => 'kanji', 'category' => 'color', 'description' => 'Màu đỏ', 'stroke_order' => '7', 'difficulty_level' => 1, 'order' => 33],
            ['character' => '青', 'romaji' => 'ao', 'type' => 'kanji', 'category' => 'color', 'description' => 'Màu xanh', 'stroke_order' => '8', 'difficulty_level' => 1, 'order' => 34],
            
            // Kích thước
            ['character' => '大', 'romaji' => 'dai', 'type' => 'kanji', 'category' => 'size', 'description' => 'Lớn', 'stroke_order' => '3', 'difficulty_level' => 1, 'order' => 35],
            ['character' => '小', 'romaji' => 'shou', 'type' => 'kanji', 'category' => 'size', 'description' => 'Nhỏ', 'stroke_order' => '3', 'difficulty_level' => 1, 'order' => 36],
            ['character' => '長', 'romaji' => 'nagai', 'type' => 'kanji', 'category' => 'size', 'description' => 'Dài', 'stroke_order' => '8', 'difficulty_level' => 1, 'order' => 37],
            ['character' => '短', 'romaji' => 'mijikai', 'type' => 'kanji', 'category' => 'size', 'description' => 'Ngắn', 'stroke_order' => '12', 'difficulty_level' => 1, 'order' => 38],
            
            // Động từ cơ bản
            ['character' => '行', 'romaji' => 'iku', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Đi', 'stroke_order' => '6', 'difficulty_level' => 1, 'order' => 39],
            ['character' => '来', 'romaji' => 'kuru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Đến', 'stroke_order' => '7', 'difficulty_level' => 1, 'order' => 40],
            ['character' => '見', 'romaji' => 'miru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Nhìn, xem', 'stroke_order' => '7', 'difficulty_level' => 1, 'order' => 41],
            ['character' => '聞', 'romaji' => 'kiku', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Nghe', 'stroke_order' => '14', 'difficulty_level' => 1, 'order' => 42],
            ['character' => '話', 'romaji' => 'hanasu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Nói chuyện', 'stroke_order' => '13', 'difficulty_level' => 1, 'order' => 43],
            ['character' => '読', 'romaji' => 'yomu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Đọc', 'stroke_order' => '14', 'difficulty_level' => 1, 'order' => 44],
            ['character' => '書', 'romaji' => 'kaku', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Viết', 'stroke_order' => '10', 'difficulty_level' => 1, 'order' => 45],
            ['character' => '食', 'romaji' => 'taberu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Ăn', 'stroke_order' => '9', 'difficulty_level' => 1, 'order' => 46],
            ['character' => '飲', 'romaji' => 'nomu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Uống', 'stroke_order' => '12', 'difficulty_level' => 1, 'order' => 47],
            ['character' => '買', 'romaji' => 'kau', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Mua', 'stroke_order' => '12', 'difficulty_level' => 1, 'order' => 48],
            
            // Địa điểm
            ['character' => '家', 'romaji' => 'ie', 'type' => 'kanji', 'category' => 'place', 'description' => 'Nhà', 'stroke_order' => '10', 'difficulty_level' => 1, 'order' => 49],
            ['character' => '学校', 'romaji' => 'gakkou', 'type' => 'kanji', 'category' => 'place', 'description' => 'Trường học', 'stroke_order' => '8+6', 'difficulty_level' => 1, 'order' => 50],
            ['character' => '店', 'romaji' => 'mise', 'type' => 'kanji', 'category' => 'place', 'description' => 'Cửa hàng', 'stroke_order' => '8', 'difficulty_level' => 1, 'order' => 51],
            ['character' => '病院', 'romaji' => 'byouin', 'type' => 'kanji', 'category' => 'place', 'description' => 'Bệnh viện', 'stroke_order' => '10+4', 'difficulty_level' => 1, 'order' => 52],
            
            // Tính từ
            ['character' => '新', 'romaji' => 'atarashii', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Mới', 'stroke_order' => '13', 'difficulty_level' => 1, 'order' => 53],
            ['character' => '古', 'romaji' => 'furui', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Cũ', 'stroke_order' => '5', 'difficulty_level' => 1, 'order' => 54],
            ['character' => '高', 'romaji' => 'takai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Cao, đắt', 'stroke_order' => '10', 'difficulty_level' => 1, 'order' => 55],
            ['character' => '安', 'romaji' => 'yasui', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Rẻ, an toàn', 'stroke_order' => '6', 'difficulty_level' => 1, 'order' => 56],
            ['character' => '多', 'romaji' => 'ooi', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Nhiều', 'stroke_order' => '6', 'difficulty_level' => 1, 'order' => 57],
            ['character' => '少', 'romaji' => 'sukunai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Ít', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 58],
            
            // Thức ăn
            ['character' => '米', 'romaji' => 'kome', 'type' => 'kanji', 'category' => 'food', 'description' => 'Gạo', 'stroke_order' => '6', 'difficulty_level' => 1, 'order' => 59],
            ['character' => '水', 'romaji' => 'mizu', 'type' => 'kanji', 'category' => 'food', 'description' => 'Nước', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 60],
            ['character' => '茶', 'romaji' => 'cha', 'type' => 'kanji', 'category' => 'food', 'description' => 'Trà', 'stroke_order' => '9', 'difficulty_level' => 1, 'order' => 61],
            ['character' => '肉', 'romaji' => 'niku', 'type' => 'kanji', 'category' => 'food', 'description' => 'Thịt', 'stroke_order' => '6', 'difficulty_level' => 1, 'order' => 62],
            ['character' => '魚', 'romaji' => 'sakana', 'type' => 'kanji', 'category' => 'food', 'description' => 'Cá', 'stroke_order' => '11', 'difficulty_level' => 1, 'order' => 63],
            
            // Cảm xúc
            ['character' => '好', 'romaji' => 'suki', 'type' => 'kanji', 'category' => 'emotion', 'description' => 'Thích', 'stroke_order' => '6', 'difficulty_level' => 1, 'order' => 64],
            ['character' => '悪', 'romaji' => 'warui', 'type' => 'kanji', 'category' => 'emotion', 'description' => 'Xấu', 'stroke_order' => '11', 'difficulty_level' => 1, 'order' => 65],
            ['character' => '楽', 'romaji' => 'tanoshii', 'type' => 'kanji', 'category' => 'emotion', 'description' => 'Vui vẻ', 'stroke_order' => '13', 'difficulty_level' => 1, 'order' => 66],
            ['character' => '忙', 'romaji' => 'isogashii', 'type' => 'kanji', 'category' => 'emotion', 'description' => 'Bận rộn', 'stroke_order' => '6', 'difficulty_level' => 1, 'order' => 67],
            
            // Các từ quan trọng khác
            ['character' => '何', 'romaji' => 'nani', 'type' => 'kanji', 'category' => 'question', 'description' => 'Cái gì', 'stroke_order' => '7', 'difficulty_level' => 1, 'order' => 68],
            ['character' => '誰', 'romaji' => 'dare', 'type' => 'kanji', 'category' => 'question', 'description' => 'Ai', 'stroke_order' => '11', 'difficulty_level' => 1, 'order' => 69],
            ['character' => 'どこ', 'romaji' => 'doko', 'type' => 'kanji', 'category' => 'question', 'description' => 'Ở đâu', 'stroke_order' => '9+2', 'difficulty_level' => 1, 'order' => 70],
            ['character' => 'いつ', 'romaji' => 'itsu', 'type' => 'kanji', 'category' => 'question', 'description' => 'Khi nào', 'stroke_order' => '4+2', 'difficulty_level' => 1, 'order' => 71],
            ['character' => 'どう', 'romaji' => 'dou', 'type' => 'kanji', 'category' => 'question', 'description' => 'Như thế nào', 'stroke_order' => '7+2', 'difficulty_level' => 1, 'order' => 72],
            ['character' => 'なぜ', 'romaji' => 'naze', 'type' => 'kanji', 'category' => 'question', 'description' => 'Tại sao', 'stroke_order' => '9+2', 'difficulty_level' => 1, 'order' => 73],
            
            // Trạng từ
            ['character' => '今', 'romaji' => 'ima', 'type' => 'kanji', 'category' => 'adverb', 'description' => 'Bây giờ', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 74],
            ['character' => '今', 'romaji' => 'kyou', 'type' => 'kanji', 'category' => 'adverb', 'description' => 'Hôm nay', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 75],
            ['character' => '今', 'romaji' => 'kinou', 'type' => 'kanji', 'category' => 'adverb', 'description' => 'Hôm qua', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 76],
            ['character' => '今', 'romaji' => 'ashita', 'type' => 'kanji', 'category' => 'adverb', 'description' => 'Ngày mai', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 77],
            ['character' => '今', 'romaji' => 'mata', 'type' => 'kanji', 'category' => 'adverb', 'description' => 'Lại', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 78],
            ['character' => '今', 'romaji' => 'mou', 'type' => 'kanji', 'category' => 'adverb', 'description' => 'Đã', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 79],
            ['character' => '今', 'romaji' => 'totemo', 'type' => 'kanji', 'category' => 'adverb', 'description' => 'Rất', 'stroke_order' => '4', 'difficulty_level' => 1, 'order' => 80],
        ];

        // Tạo tất cả ký tự
        $allAlphabets = array_merge($hiragana, $katakana, $kanji);

        foreach ($allAlphabets as $alphabet) {
            Alphabet::create($alphabet);
        }

        $this->command->info('Đã tạo ' . count($allAlphabets) . ' ký tự bảng chữ cái chuẩn:');
        $this->command->info('- Hiragana: ' . count($hiragana) . ' ký tự');
        $this->command->info('- Katakana: ' . count($katakana) . ' ký tự');
        $this->command->info('- Kanji N5: ' . count($kanji) . ' ký tự');
    }
}

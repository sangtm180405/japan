<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alphabet;

class RomajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Romaji cơ bản - Nguyên âm
        $romajiVowels = [
            ['character' => 'A', 'romaji' => 'a', 'type' => 'romaji', 'category' => 'vowel', 'description' => 'Nguyên âm A (Romaji)', 'difficulty_level' => 1, 'order' => 1],
            ['character' => 'I', 'romaji' => 'i', 'type' => 'romaji', 'category' => 'vowel', 'description' => 'Nguyên âm I (Romaji)', 'difficulty_level' => 1, 'order' => 2],
            ['character' => 'U', 'romaji' => 'u', 'type' => 'romaji', 'category' => 'vowel', 'description' => 'Nguyên âm U (Romaji)', 'difficulty_level' => 1, 'order' => 3],
            ['character' => 'E', 'romaji' => 'e', 'type' => 'romaji', 'category' => 'vowel', 'description' => 'Nguyên âm E (Romaji)', 'difficulty_level' => 1, 'order' => 4],
            ['character' => 'O', 'romaji' => 'o', 'type' => 'romaji', 'category' => 'vowel', 'description' => 'Nguyên âm O (Romaji)', 'difficulty_level' => 1, 'order' => 5],
        ];

        // Romaji - Phụ âm K
        $romajiK = [
            ['character' => 'KA', 'romaji' => 'ka', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm KA (Romaji)', 'difficulty_level' => 1, 'order' => 6],
            ['character' => 'KI', 'romaji' => 'ki', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm KI (Romaji)', 'difficulty_level' => 1, 'order' => 7],
            ['character' => 'KU', 'romaji' => 'ku', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm KU (Romaji)', 'difficulty_level' => 1, 'order' => 8],
            ['character' => 'KE', 'romaji' => 'ke', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm KE (Romaji)', 'difficulty_level' => 1, 'order' => 9],
            ['character' => 'KO', 'romaji' => 'ko', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm KO (Romaji)', 'difficulty_level' => 1, 'order' => 10],
        ];

        // Romaji - Phụ âm S
        $romajiS = [
            ['character' => 'SA', 'romaji' => 'sa', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm SA (Romaji)', 'difficulty_level' => 1, 'order' => 11],
            ['character' => 'SHI', 'romaji' => 'shi', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm SHI (Romaji)', 'difficulty_level' => 1, 'order' => 12],
            ['character' => 'SU', 'romaji' => 'su', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm SU (Romaji)', 'difficulty_level' => 1, 'order' => 13],
            ['character' => 'SE', 'romaji' => 'se', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm SE (Romaji)', 'difficulty_level' => 1, 'order' => 14],
            ['character' => 'SO', 'romaji' => 'so', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm SO (Romaji)', 'difficulty_level' => 1, 'order' => 15],
        ];

        // Romaji - Phụ âm T
        $romajiT = [
            ['character' => 'TA', 'romaji' => 'ta', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm TA (Romaji)', 'difficulty_level' => 1, 'order' => 16],
            ['character' => 'CHI', 'romaji' => 'chi', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm CHI (Romaji)', 'difficulty_level' => 1, 'order' => 17],
            ['character' => 'TSU', 'romaji' => 'tsu', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm TSU (Romaji)', 'difficulty_level' => 1, 'order' => 18],
            ['character' => 'TE', 'romaji' => 'te', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm TE (Romaji)', 'difficulty_level' => 1, 'order' => 19],
            ['character' => 'TO', 'romaji' => 'to', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm TO (Romaji)', 'difficulty_level' => 1, 'order' => 20],
        ];

        // Romaji - Phụ âm N
        $romajiN = [
            ['character' => 'NA', 'romaji' => 'na', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm NA (Romaji)', 'difficulty_level' => 1, 'order' => 21],
            ['character' => 'NI', 'romaji' => 'ni', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm NI (Romaji)', 'difficulty_level' => 1, 'order' => 22],
            ['character' => 'NU', 'romaji' => 'nu', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm NU (Romaji)', 'difficulty_level' => 1, 'order' => 23],
            ['character' => 'NE', 'romaji' => 'ne', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm NE (Romaji)', 'difficulty_level' => 1, 'order' => 24],
            ['character' => 'NO', 'romaji' => 'no', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm NO (Romaji)', 'difficulty_level' => 1, 'order' => 25],
        ];

        // Romaji - Phụ âm H
        $romajiH = [
            ['character' => 'HA', 'romaji' => 'ha', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm HA (Romaji)', 'difficulty_level' => 1, 'order' => 26],
            ['character' => 'HI', 'romaji' => 'hi', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm HI (Romaji)', 'difficulty_level' => 1, 'order' => 27],
            ['character' => 'FU', 'romaji' => 'fu', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm FU (Romaji)', 'difficulty_level' => 1, 'order' => 28],
            ['character' => 'HE', 'romaji' => 'he', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm HE (Romaji)', 'difficulty_level' => 1, 'order' => 29],
            ['character' => 'HO', 'romaji' => 'ho', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm HO (Romaji)', 'difficulty_level' => 1, 'order' => 30],
        ];

        // Romaji - Phụ âm M
        $romajiM = [
            ['character' => 'MA', 'romaji' => 'ma', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm MA (Romaji)', 'difficulty_level' => 1, 'order' => 31],
            ['character' => 'MI', 'romaji' => 'mi', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm MI (Romaji)', 'difficulty_level' => 1, 'order' => 32],
            ['character' => 'MU', 'romaji' => 'mu', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm MU (Romaji)', 'difficulty_level' => 1, 'order' => 33],
            ['character' => 'ME', 'romaji' => 'me', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm ME (Romaji)', 'difficulty_level' => 1, 'order' => 34],
            ['character' => 'MO', 'romaji' => 'mo', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm MO (Romaji)', 'difficulty_level' => 1, 'order' => 35],
        ];

        // Romaji - Phụ âm Y
        $romajiY = [
            ['character' => 'YA', 'romaji' => 'ya', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm YA (Romaji)', 'difficulty_level' => 1, 'order' => 36],
            ['character' => 'YU', 'romaji' => 'yu', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm YU (Romaji)', 'difficulty_level' => 1, 'order' => 37],
            ['character' => 'YO', 'romaji' => 'yo', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm YO (Romaji)', 'difficulty_level' => 1, 'order' => 38],
        ];

        // Romaji - Phụ âm R
        $romajiR = [
            ['character' => 'RA', 'romaji' => 'ra', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm RA (Romaji)', 'difficulty_level' => 1, 'order' => 39],
            ['character' => 'RI', 'romaji' => 'ri', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm RI (Romaji)', 'difficulty_level' => 1, 'order' => 40],
            ['character' => 'RU', 'romaji' => 'ru', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm RU (Romaji)', 'difficulty_level' => 1, 'order' => 41],
            ['character' => 'RE', 'romaji' => 're', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm RE (Romaji)', 'difficulty_level' => 1, 'order' => 42],
            ['character' => 'RO', 'romaji' => 'ro', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm RO (Romaji)', 'difficulty_level' => 1, 'order' => 43],
        ];

        // Romaji - Phụ âm W và N
        $romajiWN = [
            ['character' => 'WA', 'romaji' => 'wa', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm WA (Romaji)', 'difficulty_level' => 1, 'order' => 44],
            ['character' => 'WO', 'romaji' => 'wo', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm WO (Romaji)', 'difficulty_level' => 1, 'order' => 45],
            ['character' => 'N', 'romaji' => 'n', 'type' => 'romaji', 'category' => 'consonant', 'description' => 'Phụ âm N (Romaji)', 'difficulty_level' => 1, 'order' => 46],
        ];

        // Tạo tất cả Romaji
        $allRomaji = array_merge(
            $romajiVowels, $romajiK, $romajiS, $romajiT, $romajiN,
            $romajiH, $romajiM, $romajiY, $romajiR, $romajiWN
        );

        foreach ($allRomaji as $romaji) {
            Alphabet::create($romaji);
        }

        $this->command->info('Đã tạo ' . count($allRomaji) . ' ký tự Romaji.');
    }
}

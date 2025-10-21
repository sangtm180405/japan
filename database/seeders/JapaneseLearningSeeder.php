<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Grammar;
use App\Models\Exercise;

class JapaneseLearningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo bài học N5 - Cơ bản
        $lesson1 = Lesson::create([
            'title' => 'Hiragana cơ bản - Bảng chữ cái',
            'description' => 'Học bảng chữ cái Hiragana cơ bản, bao gồm các nguyên âm và phụ âm đầu tiên.',
            'level' => 1,
            'order' => 1,
            'is_active' => true,
        ]);

        // Từ vựng cho bài học 1
        $vocabularies1 = [
            [
                'japanese' => 'あ',
                'hiragana' => 'あ',
                'romaji' => 'a',
                'vietnamese' => 'chữ cái a',
                'example_sentence' => 'あお (ao) - màu xanh',
                'example_translation' => 'màu xanh',
            ],
            [
                'japanese' => 'い',
                'hiragana' => 'い',
                'romaji' => 'i',
                'vietnamese' => 'chữ cái i',
                'example_sentence' => 'いぬ (inu) - con chó',
                'example_translation' => 'con chó',
            ],
            [
                'japanese' => 'う',
                'hiragana' => 'う',
                'romaji' => 'u',
                'vietnamese' => 'chữ cái u',
                'example_sentence' => 'うま (uma) - con ngựa',
                'example_translation' => 'con ngựa',
            ],
            [
                'japanese' => 'え',
                'hiragana' => 'え',
                'romaji' => 'e',
                'vietnamese' => 'chữ cái e',
                'example_sentence' => 'えき (eki) - nhà ga',
                'example_translation' => 'nhà ga',
            ],
            [
                'japanese' => 'お',
                'hiragana' => 'お',
                'romaji' => 'o',
                'vietnamese' => 'chữ cái o',
                'example_sentence' => 'おかね (okane) - tiền',
                'example_translation' => 'tiền',
            ],
        ];

        foreach ($vocabularies1 as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson1->id]));
        }

        // Ngữ pháp cho bài học 1
        Grammar::create([
            'lesson_id' => $lesson1->id,
            'title' => 'Cách đọc Hiragana',
            'explanation' => 'Hiragana là bảng chữ cái cơ bản của tiếng Nhật, được sử dụng để viết các từ thuần Nhật và các phần ngữ pháp.',
            'structure' => 'あ (a) - い (i) - う (u) - え (e) - お (o)',
            'examples' => [
                ['japanese' => 'あお', 'translation' => 'màu xanh'],
                ['japanese' => 'いぬ', 'translation' => 'con chó'],
                ['japanese' => 'うま', 'translation' => 'con ngựa'],
            ],
            'usage_notes' => [
                'Hiragana được viết từ trái sang phải, từ trên xuống dưới',
                'Mỗi ký tự đại diện cho một âm tiết',
                'Cần luyện tập viết thường xuyên để nhớ mặt chữ',
            ],
        ]);

        // Bài tập cho bài học 1
        $exercises1 = [
            [
                'type' => 'multiple_choice',
                'question' => 'Chữ cái "あ" được đọc như thế nào?',
                'options' => ['a', 'i', 'u', 'e'],
                'correct_answer' => 'a',
                'explanation' => 'Chữ cái "あ" được đọc là "a" trong tiếng Nhật.',
                'points' => 1,
            ],
            [
                'type' => 'multiple_choice',
                'question' => 'Chữ cái "い" được đọc như thế nào?',
                'options' => ['a', 'i', 'u', 'e'],
                'correct_answer' => 'i',
                'explanation' => 'Chữ cái "い" được đọc là "i" trong tiếng Nhật.',
                'points' => 1,
            ],
            [
                'type' => 'fill_blank',
                'question' => 'Điền chữ cái còn thiếu: あ_うえお',
                'correct_answer' => 'い',
                'explanation' => 'Thứ tự đúng là: あいうえお (a-i-u-e-o)',
                'points' => 2,
            ],
        ];

        foreach ($exercises1 as $exercise) {
            Exercise::create(array_merge($exercise, ['lesson_id' => $lesson1->id]));
        }

        // Tạo bài học N5 - Số đếm
        $lesson2 = Lesson::create([
            'title' => 'Số đếm từ 1-10',
            'description' => 'Học cách đếm số từ 1 đến 10 trong tiếng Nhật.',
            'level' => 1,
            'order' => 2,
            'is_active' => true,
        ]);

        // Từ vựng cho bài học 2
        $vocabularies2 = [
            [
                'japanese' => 'いち',
                'hiragana' => 'いち',
                'romaji' => 'ichi',
                'vietnamese' => 'số 1',
                'example_sentence' => 'いちがつ (ichigatsu) - tháng 1',
                'example_translation' => 'tháng 1',
            ],
            [
                'japanese' => 'に',
                'hiragana' => 'に',
                'romaji' => 'ni',
                'vietnamese' => 'số 2',
                'example_sentence' => 'にがつ (nigatsu) - tháng 2',
                'example_translation' => 'tháng 2',
            ],
            [
                'japanese' => 'さん',
                'hiragana' => 'さん',
                'romaji' => 'san',
                'vietnamese' => 'số 3',
                'example_sentence' => 'さんがつ (sangatsu) - tháng 3',
                'example_translation' => 'tháng 3',
            ],
            [
                'japanese' => 'よん',
                'hiragana' => 'よん',
                'romaji' => 'yon',
                'vietnamese' => 'số 4',
                'example_sentence' => 'よんがつ (yongatsu) - tháng 4',
                'example_translation' => 'tháng 4',
            ],
            [
                'japanese' => 'ご',
                'hiragana' => 'ご',
                'romaji' => 'go',
                'vietnamese' => 'số 5',
                'example_sentence' => 'ごがつ (gogatsu) - tháng 5',
                'example_translation' => 'tháng 5',
            ],
        ];

        foreach ($vocabularies2 as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson2->id]));
        }

        // Ngữ pháp cho bài học 2
        Grammar::create([
            'lesson_id' => $lesson2->id,
            'title' => 'Cách đếm số trong tiếng Nhật',
            'explanation' => 'Trong tiếng Nhật, cách đếm số có thể thay đổi tùy thuộc vào vật được đếm.',
            'structure' => 'いち (1) - に (2) - さん (3) - よん/し (4) - ご (5)',
            'examples' => [
                ['japanese' => 'いちがつ', 'translation' => 'tháng 1'],
                ['japanese' => 'にがつ', 'translation' => 'tháng 2'],
                ['japanese' => 'さんがつ', 'translation' => 'tháng 3'],
            ],
            'usage_notes' => [
                'Số 4 có thể đọc là "よん" hoặc "し"',
                'Số 7 có thể đọc là "なな" hoặc "しち"',
                'Số 9 có thể đọc là "きゅう" hoặc "く"',
            ],
        ]);

        // Bài tập cho bài học 2
        $exercises2 = [
            [
                'type' => 'multiple_choice',
                'question' => 'Số 1 trong tiếng Nhật là gì?',
                'options' => ['いち', 'に', 'さん', 'よん'],
                'correct_answer' => 'いち',
                'explanation' => 'Số 1 trong tiếng Nhật là "いち" (ichi).',
                'points' => 1,
            ],
            [
                'type' => 'translation',
                'question' => 'Dịch "tháng 3" sang tiếng Nhật',
                'correct_answer' => 'さんがつ',
                'explanation' => '"Tháng 3" trong tiếng Nhật là "さんがつ" (sangatsu).',
                'points' => 2,
            ],
        ];

        foreach ($exercises2 as $exercise) {
            Exercise::create(array_merge($exercise, ['lesson_id' => $lesson2->id]));
        }

        // Tạo bài học N4 - Chào hỏi
        $lesson3 = Lesson::create([
            'title' => 'Chào hỏi cơ bản',
            'description' => 'Học các cách chào hỏi cơ bản trong tiếng Nhật.',
            'level' => 2,
            'order' => 1,
            'is_active' => true,
        ]);

        // Từ vựng cho bài học 3
        $vocabularies3 = [
            [
                'japanese' => 'こんにちは',
                'hiragana' => 'こんにちは',
                'romaji' => 'konnichiwa',
                'vietnamese' => 'xin chào (ban ngày)',
                'example_sentence' => 'こんにちは、田中さん。',
                'example_translation' => 'Xin chào, anh Tanaka.',
            ],
            [
                'japanese' => 'おはよう',
                'hiragana' => 'おはよう',
                'romaji' => 'ohayou',
                'vietnamese' => 'chào buổi sáng',
                'example_sentence' => 'おはようございます。',
                'example_translation' => 'Chào buổi sáng (lịch sự).',
            ],
            [
                'japanese' => 'こんばんは',
                'hiragana' => 'こんばんは',
                'romaji' => 'konbanwa',
                'vietnamese' => 'chào buổi tối',
                'example_sentence' => 'こんばんは、お疲れ様です。',
                'example_translation' => 'Chào buổi tối, anh/chị đã vất vả rồi.',
            ],
        ];

        foreach ($vocabularies3 as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson3->id]));
        }

        // Ngữ pháp cho bài học 3
        Grammar::create([
            'lesson_id' => $lesson3->id,
            'title' => 'Cách chào hỏi theo thời gian',
            'explanation' => 'Trong tiếng Nhật, cách chào hỏi thay đổi tùy thuộc vào thời gian trong ngày.',
            'structure' => 'おはよう (sáng) - こんにちは (trưa) - こんばんは (tối)',
            'examples' => [
                ['japanese' => 'おはようございます', 'translation' => 'Chào buổi sáng (lịch sự)'],
                ['japanese' => 'こんにちは', 'translation' => 'Xin chào (ban ngày)'],
                ['japanese' => 'こんばんは', 'translation' => 'Chào buổi tối'],
            ],
            'usage_notes' => [
                'おはよう được dùng từ sáng đến 10h',
                'こんにちは được dùng từ 10h đến chiều tối',
                'こんばんは được dùng từ chiều tối đến đêm',
            ],
        ]);

        // Bài tập cho bài học 3
        $exercises3 = [
            [
                'type' => 'multiple_choice',
                'question' => 'Cách chào buổi sáng lịch sự trong tiếng Nhật là gì?',
                'options' => ['おはよう', 'おはようございます', 'こんにちは', 'こんばんは'],
                'correct_answer' => 'おはようございます',
                'explanation' => '"おはようございます" là cách chào buổi sáng lịch sự.',
                'points' => 1,
            ],
            [
                'type' => 'translation',
                'question' => 'Dịch "Xin chào" (ban ngày) sang tiếng Nhật',
                'correct_answer' => 'こんにちは',
                'explanation' => '"Xin chào" ban ngày trong tiếng Nhật là "こんにちは".',
                'points' => 2,
            ],
        ];

        foreach ($exercises3 as $exercise) {
            Exercise::create(array_merge($exercise, ['lesson_id' => $lesson3->id]));
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Grammar;
use App\Models\Exercise;

class StandardJapaneseLessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ theo thứ tự để tránh lỗi foreign key
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        Exercise::truncate();
        Grammar::truncate();
        Vocabulary::truncate();
        Lesson::truncate();
        
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // N5 - Bài 1: Hiragana cơ bản
        $lesson1 = Lesson::create([
            'title' => 'Hiragana - Nguyên âm và phụ âm cơ bản',
            'description' => 'Học bảng chữ cái Hiragana cơ bản, bao gồm 5 nguyên âm và các phụ âm đầu tiên.',
            'level' => 1,
            'order' => 1,
            'is_active' => true,
        ]);

        // Từ vựng cho bài 1
        $vocabularies1 = [
            // Nguyên âm
            ['japanese' => 'あ', 'hiragana' => 'あ', 'romaji' => 'a', 'vietnamese' => 'chữ cái a', 'example_sentence' => 'あお (ao) - màu xanh', 'example_translation' => 'màu xanh', 'difficulty_level' => 1],
            ['japanese' => 'い', 'hiragana' => 'い', 'romaji' => 'i', 'vietnamese' => 'chữ cái i', 'example_sentence' => 'いぬ (inu) - con chó', 'example_translation' => 'con chó', 'difficulty_level' => 1],
            ['japanese' => 'う', 'hiragana' => 'う', 'romaji' => 'u', 'vietnamese' => 'chữ cái u', 'example_sentence' => 'うま (uma) - con ngựa', 'example_translation' => 'con ngựa', 'difficulty_level' => 1],
            ['japanese' => 'え', 'hiragana' => 'え', 'romaji' => 'e', 'vietnamese' => 'chữ cái e', 'example_sentence' => 'えき (eki) - nhà ga', 'example_translation' => 'nhà ga', 'difficulty_level' => 1],
            ['japanese' => 'お', 'hiragana' => 'お', 'romaji' => 'o', 'vietnamese' => 'chữ cái o', 'example_sentence' => 'おかね (okane) - tiền', 'example_translation' => 'tiền', 'difficulty_level' => 1],
            
            // Phụ âm K
            ['japanese' => 'か', 'hiragana' => 'か', 'romaji' => 'ka', 'vietnamese' => 'chữ cái ka', 'example_sentence' => 'かばん (kaban) - cặp sách', 'example_translation' => 'cặp sách', 'difficulty_level' => 1],
            ['japanese' => 'き', 'hiragana' => 'き', 'romaji' => 'ki', 'vietnamese' => 'chữ cái ki', 'example_sentence' => 'き (ki) - cây', 'example_translation' => 'cây', 'difficulty_level' => 1],
            ['japanese' => 'く', 'hiragana' => 'く', 'romaji' => 'ku', 'vietnamese' => 'chữ cái ku', 'example_sentence' => 'くつ (kutsu) - giày', 'example_translation' => 'giày', 'difficulty_level' => 1],
            ['japanese' => 'け', 'hiragana' => 'け', 'romaji' => 'ke', 'vietnamese' => 'chữ cái ke', 'example_sentence' => 'けん (ken) - thanh kiếm', 'example_translation' => 'thanh kiếm', 'difficulty_level' => 1],
            ['japanese' => 'こ', 'hiragana' => 'こ', 'romaji' => 'ko', 'vietnamese' => 'chữ cái ko', 'example_sentence' => 'こども (kodomo) - trẻ em', 'example_translation' => 'trẻ em', 'difficulty_level' => 1],
        ];

        foreach ($vocabularies1 as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson1->id]));
        }

        // Ngữ pháp cho bài 1
        Grammar::create([
            'lesson_id' => $lesson1->id,
            'title' => 'Cách đọc và viết Hiragana',
            'explanation' => 'Hiragana là bảng chữ cái cơ bản của tiếng Nhật, được sử dụng để viết các từ thuần Nhật và các phần ngữ pháp. Mỗi ký tự đại diện cho một âm tiết.',
            'structure' => 'あ (a) - い (i) - う (u) - え (e) - お (o)',
            'examples' => [
                ['japanese' => 'あお', 'translation' => 'màu xanh'],
                ['japanese' => 'いぬ', 'translation' => 'con chó'],
                ['japanese' => 'うま', 'translation' => 'con ngựa'],
                ['japanese' => 'えき', 'translation' => 'nhà ga'],
                ['japanese' => 'おかね', 'translation' => 'tiền'],
            ],
            'usage_notes' => [
                'Hiragana được viết từ trái sang phải, từ trên xuống dưới',
                'Mỗi ký tự đại diện cho một âm tiết',
                'Cần luyện tập viết thường xuyên để nhớ mặt chữ',
                'Thứ tự viết nét rất quan trọng trong tiếng Nhật',
            ],
            'difficulty_level' => 1,
        ]);

        // Bài tập cho bài 1
        $exercises1 = [
            [
                'type' => 'multiple_choice',
                'question' => 'Chữ cái "あ" được đọc như thế nào?',
                'options' => ['a', 'i', 'u', 'e'],
                'correct_answer' => 'a',
                'explanation' => 'Chữ cái "あ" được đọc là "a" trong tiếng Nhật.',
                'points' => 1,
                'difficulty_level' => 1,
            ],
            [
                'type' => 'multiple_choice',
                'question' => 'Chữ cái "い" được đọc như thế nào?',
                'options' => ['a', 'i', 'u', 'e'],
                'correct_answer' => 'i',
                'explanation' => 'Chữ cái "い" được đọc là "i" trong tiếng Nhật.',
                'points' => 1,
                'difficulty_level' => 1,
            ],
            [
                'type' => 'fill_blank',
                'question' => 'Điền chữ cái còn thiếu: あ_うえお',
                'correct_answer' => 'い',
                'explanation' => 'Thứ tự đúng là: あいうえお (a-i-u-e-o)',
                'points' => 2,
                'difficulty_level' => 1,
            ],
            [
                'type' => 'translation',
                'question' => 'Dịch "con chó" sang tiếng Nhật',
                'correct_answer' => 'いぬ',
                'explanation' => '"Con chó" trong tiếng Nhật là "いぬ" (inu).',
                'points' => 2,
                'difficulty_level' => 1,
            ],
        ];

        foreach ($exercises1 as $exercise) {
            Exercise::create(array_merge($exercise, ['lesson_id' => $lesson1->id]));
        }

        // N5 - Bài 2: Số đếm cơ bản
        $lesson2 = Lesson::create([
            'title' => 'Số đếm từ 1-10',
            'description' => 'Học cách đếm số từ 1 đến 10 trong tiếng Nhật và cách sử dụng chúng.',
            'level' => 1,
            'order' => 2,
            'is_active' => true,
        ]);

        // Từ vựng cho bài 2
        $vocabularies2 = [
            ['japanese' => 'いち', 'hiragana' => 'いち', 'romaji' => 'ichi', 'vietnamese' => 'số 1', 'example_sentence' => 'いちがつ (ichigatsu) - tháng 1', 'example_translation' => 'tháng 1', 'difficulty_level' => 1],
            ['japanese' => 'に', 'hiragana' => 'に', 'romaji' => 'ni', 'vietnamese' => 'số 2', 'example_sentence' => 'にがつ (nigatsu) - tháng 2', 'example_translation' => 'tháng 2', 'difficulty_level' => 1],
            ['japanese' => 'さん', 'hiragana' => 'さん', 'romaji' => 'san', 'vietnamese' => 'số 3', 'example_sentence' => 'さんがつ (sangatsu) - tháng 3', 'example_translation' => 'tháng 3', 'difficulty_level' => 1],
            ['japanese' => 'よん', 'hiragana' => 'よん', 'romaji' => 'yon', 'vietnamese' => 'số 4', 'example_sentence' => 'よんがつ (yongatsu) - tháng 4', 'example_translation' => 'tháng 4', 'difficulty_level' => 1],
            ['japanese' => 'ご', 'hiragana' => 'ご', 'romaji' => 'go', 'vietnamese' => 'số 5', 'example_sentence' => 'ごがつ (gogatsu) - tháng 5', 'example_translation' => 'tháng 5', 'difficulty_level' => 1],
            ['japanese' => 'ろく', 'hiragana' => 'ろく', 'romaji' => 'roku', 'vietnamese' => 'số 6', 'example_sentence' => 'ろくがつ (rokugatsu) - tháng 6', 'example_translation' => 'tháng 6', 'difficulty_level' => 1],
            ['japanese' => 'なな', 'hiragana' => 'なな', 'romaji' => 'nana', 'vietnamese' => 'số 7', 'example_sentence' => 'なながつ (nanagatsu) - tháng 7', 'example_translation' => 'tháng 7', 'difficulty_level' => 1],
            ['japanese' => 'はち', 'hiragana' => 'はち', 'romaji' => 'hachi', 'vietnamese' => 'số 8', 'example_sentence' => 'はちがつ (hachigatsu) - tháng 8', 'example_translation' => 'tháng 8', 'difficulty_level' => 1],
            ['japanese' => 'きゅう', 'hiragana' => 'きゅう', 'romaji' => 'kyuu', 'vietnamese' => 'số 9', 'example_sentence' => 'きゅうがつ (kyuugatsu) - tháng 9', 'example_translation' => 'tháng 9', 'difficulty_level' => 1],
            ['japanese' => 'じゅう', 'hiragana' => 'じゅう', 'romaji' => 'juu', 'vietnamese' => 'số 10', 'example_sentence' => 'じゅうがつ (juugatsu) - tháng 10', 'example_translation' => 'tháng 10', 'difficulty_level' => 1],
        ];

        foreach ($vocabularies2 as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson2->id]));
        }

        // Ngữ pháp cho bài 2
        Grammar::create([
            'lesson_id' => $lesson2->id,
            'title' => 'Cách đếm số trong tiếng Nhật',
            'explanation' => 'Trong tiếng Nhật, cách đếm số có thể thay đổi tùy thuộc vào vật được đếm. Đối với tháng, chúng ta sử dụng số + がつ (gatsu).',
            'structure' => 'いち (1) - に (2) - さん (3) - よん/し (4) - ご (5) - ろく (6) - なな/しち (7) - はち (8) - きゅう/く (9) - じゅう (10)',
            'examples' => [
                ['japanese' => 'いちがつ', 'translation' => 'tháng 1'],
                ['japanese' => 'にがつ', 'translation' => 'tháng 2'],
                ['japanese' => 'さんがつ', 'translation' => 'tháng 3'],
                ['japanese' => 'よんがつ', 'translation' => 'tháng 4'],
                ['japanese' => 'ごがつ', 'translation' => 'tháng 5'],
            ],
            'usage_notes' => [
                'Số 4 có thể đọc là "よん" hoặc "し"',
                'Số 7 có thể đọc là "なな" hoặc "しち"',
                'Số 9 có thể đọc là "きゅう" hoặc "く"',
                'Khi đếm tháng, luôn thêm "がつ" (gatsu)',
            ],
            'difficulty_level' => 1,
        ]);

        // Bài tập cho bài 2
        $exercises2 = [
            [
                'type' => 'multiple_choice',
                'question' => 'Số 1 trong tiếng Nhật là gì?',
                'options' => ['いち', 'に', 'さん', 'よん'],
                'correct_answer' => 'いち',
                'explanation' => 'Số 1 trong tiếng Nhật là "いち" (ichi).',
                'points' => 1,
                'difficulty_level' => 1,
            ],
            [
                'type' => 'translation',
                'question' => 'Dịch "tháng 3" sang tiếng Nhật',
                'correct_answer' => 'さんがつ',
                'explanation' => '"Tháng 3" trong tiếng Nhật là "さんがつ" (sangatsu).',
                'points' => 2,
                'difficulty_level' => 1,
            ],
            [
                'type' => 'multiple_choice',
                'question' => 'Số 7 có thể đọc là gì?',
                'options' => ['なな', 'しち', 'Cả hai đều đúng', 'Cả hai đều sai'],
                'correct_answer' => 'Cả hai đều đúng',
                'explanation' => 'Số 7 có thể đọc là "なな" hoặc "しち" tùy thuộc vào ngữ cảnh.',
                'points' => 2,
                'difficulty_level' => 1,
            ],
        ];

        foreach ($exercises2 as $exercise) {
            Exercise::create(array_merge($exercise, ['lesson_id' => $lesson2->id]));
        }

        // N5 - Bài 3: Chào hỏi cơ bản
        $lesson3 = Lesson::create([
            'title' => 'Chào hỏi cơ bản',
            'description' => 'Học các cách chào hỏi cơ bản trong tiếng Nhật theo thời gian và tình huống.',
            'level' => 1,
            'order' => 3,
            'is_active' => true,
        ]);

        // Từ vựng cho bài 3
        $vocabularies3 = [
            ['japanese' => 'おはよう', 'hiragana' => 'おはよう', 'romaji' => 'ohayou', 'vietnamese' => 'chào buổi sáng', 'example_sentence' => 'おはようございます。', 'example_translation' => 'Chào buổi sáng (lịch sự).', 'difficulty_level' => 1],
            ['japanese' => 'こんにちは', 'hiragana' => 'こんにちは', 'romaji' => 'konnichiwa', 'vietnamese' => 'xin chào (ban ngày)', 'example_sentence' => 'こんにちは、田中さん。', 'example_translation' => 'Xin chào, anh Tanaka.', 'difficulty_level' => 1],
            ['japanese' => 'こんばんは', 'hiragana' => 'こんばんは', 'romaji' => 'konbanwa', 'vietnamese' => 'chào buổi tối', 'example_sentence' => 'こんばんは、お疲れ様です。', 'example_translation' => 'Chào buổi tối, anh/chị đã vất vả rồi.', 'difficulty_level' => 1],
            ['japanese' => 'さようなら', 'hiragana' => 'さようなら', 'romaji' => 'sayounara', 'vietnamese' => 'tạm biệt', 'example_sentence' => 'さようなら、また明日。', 'example_translation' => 'Tạm biệt, hẹn gặp lại ngày mai.', 'difficulty_level' => 1],
            ['japanese' => 'ありがとう', 'hiragana' => 'ありがとう', 'romaji' => 'arigatou', 'vietnamese' => 'cảm ơn', 'example_sentence' => 'ありがとうございます。', 'example_translation' => 'Cảm ơn (lịch sự).', 'difficulty_level' => 1],
            ['japanese' => 'すみません', 'hiragana' => 'すみません', 'romaji' => 'sumimasen', 'vietnamese' => 'xin lỗi', 'example_sentence' => 'すみません、道を教えてください。', 'example_translation' => 'Xin lỗi, hãy chỉ đường cho tôi.', 'difficulty_level' => 1],
            ['japanese' => 'はい', 'hiragana' => 'はい', 'romaji' => 'hai', 'vietnamese' => 'vâng, có', 'example_sentence' => 'はい、そうです。', 'example_translation' => 'Vâng, đúng vậy.', 'difficulty_level' => 1],
            ['japanese' => 'いいえ', 'hiragana' => 'いいえ', 'romaji' => 'iie', 'vietnamese' => 'không', 'example_sentence' => 'いいえ、違います。', 'example_translation' => 'Không, không đúng.', 'difficulty_level' => 1],
        ];

        foreach ($vocabularies3 as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson3->id]));
        }

        // Ngữ pháp cho bài 3
        Grammar::create([
            'lesson_id' => $lesson3->id,
            'title' => 'Cách chào hỏi theo thời gian',
            'explanation' => 'Trong tiếng Nhật, cách chào hỏi thay đổi tùy thuộc vào thời gian trong ngày và mức độ lịch sự.',
            'structure' => 'おはよう (sáng) - こんにちは (trưa) - こんばんは (tối) - さようなら (tạm biệt)',
            'examples' => [
                ['japanese' => 'おはようございます', 'translation' => 'Chào buổi sáng (lịch sự)'],
                ['japanese' => 'こんにちは', 'translation' => 'Xin chào (ban ngày)'],
                ['japanese' => 'こんばんは', 'translation' => 'Chào buổi tối'],
                ['japanese' => 'さようなら', 'translation' => 'Tạm biệt'],
            ],
            'usage_notes' => [
                'おはよう được dùng từ sáng đến 10h',
                'こんにちは được dùng từ 10h đến chiều tối',
                'こんばんは được dùng từ chiều tối đến đêm',
                'Thêm ございます để thể hiện sự lịch sự',
            ],
            'difficulty_level' => 1,
        ]);

        // Bài tập cho bài 3
        $exercises3 = [
            [
                'type' => 'multiple_choice',
                'question' => 'Cách chào buổi sáng lịch sự trong tiếng Nhật là gì?',
                'options' => ['おはよう', 'おはようございます', 'こんにちは', 'こんばんは'],
                'correct_answer' => 'おはようございます',
                'explanation' => '"おはようございます" là cách chào buổi sáng lịch sự.',
                'points' => 1,
                'difficulty_level' => 1,
            ],
            [
                'type' => 'translation',
                'question' => 'Dịch "Xin chào" (ban ngày) sang tiếng Nhật',
                'correct_answer' => 'こんにちは',
                'explanation' => '"Xin chào" ban ngày trong tiếng Nhật là "こんにちは".',
                'points' => 2,
                'difficulty_level' => 1,
            ],
            [
                'type' => 'multiple_choice',
                'question' => '"ありがとう" có nghĩa là gì?',
                'options' => ['Xin lỗi', 'Cảm ơn', 'Tạm biệt', 'Xin chào'],
                'correct_answer' => 'Cảm ơn',
                'explanation' => '"ありがとう" có nghĩa là "cảm ơn".',
                'points' => 1,
                'difficulty_level' => 1,
            ],
        ];

        foreach ($exercises3 as $exercise) {
            Exercise::create(array_merge($exercise, ['lesson_id' => $lesson3->id]));
        }

        // N4 - Bài 4: Động từ cơ bản
        $lesson4 = Lesson::create([
            'title' => 'Động từ cơ bản - Thể từ điển',
            'description' => 'Học các động từ cơ bản trong tiếng Nhật và cách sử dụng thể từ điển.',
            'level' => 2,
            'order' => 1,
            'is_active' => true,
        ]);

        // Từ vựng cho bài 4
        $vocabularies4 = [
            ['japanese' => 'する', 'hiragana' => 'する', 'romaji' => 'suru', 'vietnamese' => 'làm', 'example_sentence' => '勉強する (benkyou suru) - học', 'example_translation' => 'học', 'difficulty_level' => 2],
            ['japanese' => 'いく', 'hiragana' => 'いく', 'romaji' => 'iku', 'vietnamese' => 'đi', 'example_sentence' => '学校に行く (gakkou ni iku) - đi học', 'example_translation' => 'đi học', 'difficulty_level' => 2],
            ['japanese' => 'くる', 'hiragana' => 'くる', 'romaji' => 'kuru', 'vietnamese' => 'đến', 'example_sentence' => '家に来る (ie ni kuru) - đến nhà', 'example_translation' => 'đến nhà', 'difficulty_level' => 2],
            ['japanese' => 'たべる', 'hiragana' => 'たべる', 'romaji' => 'taberu', 'vietnamese' => 'ăn', 'example_sentence' => 'ご飯を食べる (gohan wo taberu) - ăn cơm', 'example_translation' => 'ăn cơm', 'difficulty_level' => 2],
            ['japanese' => 'のむ', 'hiragana' => 'のむ', 'romaji' => 'nomu', 'vietnamese' => 'uống', 'example_sentence' => '水を飲む (mizu wo nomu) - uống nước', 'example_translation' => 'uống nước', 'difficulty_level' => 2],
            ['japanese' => 'みる', 'hiragana' => 'みる', 'romaji' => 'miru', 'vietnamese' => 'xem', 'example_sentence' => 'テレビを見る (terebi wo miru) - xem TV', 'example_translation' => 'xem TV', 'difficulty_level' => 2],
            ['japanese' => 'きく', 'hiragana' => 'きく', 'romaji' => 'kiku', 'vietnamese' => 'nghe', 'example_sentence' => '音楽を聞く (ongaku wo kiku) - nghe nhạc', 'example_translation' => 'nghe nhạc', 'difficulty_level' => 2],
            ['japanese' => 'よむ', 'hiragana' => 'よむ', 'romaji' => 'yomu', 'vietnamese' => 'đọc', 'example_sentence' => '本を読む (hon wo yomu) - đọc sách', 'example_translation' => 'đọc sách', 'difficulty_level' => 2],
        ];

        foreach ($vocabularies4 as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson4->id]));
        }

        // Ngữ pháp cho bài 4
        Grammar::create([
            'lesson_id' => $lesson4->id,
            'title' => 'Động từ thể từ điển',
            'explanation' => 'Thể từ điển (辞書形) là dạng cơ bản của động từ, thường kết thúc bằng う, る, hoặc する. Đây là dạng động từ được tìm thấy trong từ điển.',
            'structure' => 'Danh từ + を + Động từ thể từ điển',
            'examples' => [
                ['japanese' => 'ご飯を食べる', 'translation' => 'ăn cơm'],
                ['japanese' => '水を飲む', 'translation' => 'uống nước'],
                ['japanese' => 'テレビを見る', 'translation' => 'xem TV'],
                ['japanese' => '音楽を聞く', 'translation' => 'nghe nhạc'],
            ],
            'usage_notes' => [
                'Trợ từ を (wo) được dùng để chỉ đối tượng của động từ',
                'Thể từ điển thường dùng trong câu khẳng định',
                'Có thể dùng để diễn tả thói quen hoặc sự thật chung',
                'Một số động từ kết thúc bằng る, một số kết thúc bằng う',
            ],
            'difficulty_level' => 2,
        ]);

        // Bài tập cho bài 4
        $exercises4 = [
            [
                'type' => 'multiple_choice',
                'question' => '"食べる" có nghĩa là gì?',
                'options' => ['uống', 'ăn', 'xem', 'nghe'],
                'correct_answer' => 'ăn',
                'explanation' => '"食べる" (taberu) có nghĩa là "ăn".',
                'points' => 1,
                'difficulty_level' => 2,
            ],
            [
                'type' => 'translation',
                'question' => 'Dịch "uống nước" sang tiếng Nhật',
                'correct_answer' => '水を飲む',
                'explanation' => '"Uống nước" trong tiếng Nhật là "水を飲む" (mizu wo nomu).',
                'points' => 2,
                'difficulty_level' => 2,
            ],
            [
                'type' => 'fill_blank',
                'question' => 'Điền động từ thích hợp: テレビを___ (xem TV)',
                'correct_answer' => '見る',
                'explanation' => 'Động từ "xem" trong tiếng Nhật là "見る" (miru).',
                'points' => 2,
                'difficulty_level' => 2,
            ],
        ];

        foreach ($exercises4 as $exercise) {
            Exercise::create(array_merge($exercise, ['lesson_id' => $lesson4->id]));
        }

        // N4 - Bài 5: Tính từ
        $lesson5 = Lesson::create([
            'title' => 'Tính từ - Tính từ đuôi い và な',
            'description' => 'Học cách sử dụng tính từ đuôi い (i-adjective) và tính từ đuôi な (na-adjective) trong tiếng Nhật.',
            'level' => 2,
            'order' => 2,
            'is_active' => true,
        ]);

        // Từ vựng cho bài 5
        $vocabularies5 = [
            // Tính từ đuôi い
            ['japanese' => 'おおきい', 'hiragana' => 'おおきい', 'romaji' => 'ookii', 'vietnamese' => 'to, lớn', 'example_sentence' => '大きい家 (ookii ie) - ngôi nhà lớn', 'example_translation' => 'ngôi nhà lớn', 'difficulty_level' => 2],
            ['japanese' => 'ちいさい', 'hiragana' => 'ちいさい', 'romaji' => 'chiisai', 'vietnamese' => 'nhỏ, bé', 'example_sentence' => '小さい車 (chiisai kuruma) - chiếc xe nhỏ', 'example_translation' => 'chiếc xe nhỏ', 'difficulty_level' => 2],
            ['japanese' => 'あたらしい', 'hiragana' => 'あたらしい', 'romaji' => 'atarashii', 'vietnamese' => 'mới', 'example_sentence' => '新しい本 (atarashii hon) - cuốn sách mới', 'example_translation' => 'cuốn sách mới', 'difficulty_level' => 2],
            ['japanese' => 'ふるい', 'hiragana' => 'ふるい', 'romaji' => 'furui', 'vietnamese' => 'cũ', 'example_sentence' => '古い建物 (furui tatemono) - tòa nhà cũ', 'example_translation' => 'tòa nhà cũ', 'difficulty_level' => 2],
            ['japanese' => 'たかい', 'hiragana' => 'たかい', 'romaji' => 'takai', 'vietnamese' => 'cao, đắt', 'example_sentence' => '高い山 (takai yama) - ngọn núi cao', 'example_translation' => 'ngọn núi cao', 'difficulty_level' => 2],
            
            // Tính từ đuôi な
            ['japanese' => 'きれい', 'hiragana' => 'きれい', 'romaji' => 'kirei', 'vietnamese' => 'đẹp, sạch', 'example_sentence' => 'きれいな花 (kirei na hana) - bông hoa đẹp', 'example_translation' => 'bông hoa đẹp', 'difficulty_level' => 2],
            ['japanese' => 'しずか', 'hiragana' => 'しずか', 'romaji' => 'shizuka', 'vietnamese' => 'yên tĩnh', 'example_sentence' => '静かな部屋 (shizuka na heya) - căn phòng yên tĩnh', 'example_translation' => 'căn phòng yên tĩnh', 'difficulty_level' => 2],
            ['japanese' => 'にぎやか', 'hiragana' => 'にぎやか', 'romaji' => 'nigiyaka', 'vietnamese' => 'náo nhiệt', 'example_sentence' => 'にぎやかな街 (nigiyaka na machi) - thành phố náo nhiệt', 'example_translation' => 'thành phố náo nhiệt', 'difficulty_level' => 2],
        ];

        foreach ($vocabularies5 as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson5->id]));
        }

        // Ngữ pháp cho bài 5
        Grammar::create([
            'lesson_id' => $lesson5->id,
            'title' => 'Tính từ đuôi い và な',
            'explanation' => 'Trong tiếng Nhật có hai loại tính từ: tính từ đuôi い (i-adjective) và tính từ đuôi な (na-adjective). Cách sử dụng chúng khác nhau khi bổ nghĩa cho danh từ.',
            'structure' => 'Tính từ đuôi い + Danh từ / Tính từ đuôi な + な + Danh từ',
            'examples' => [
                ['japanese' => '大きい家', 'translation' => 'ngôi nhà lớn'],
                ['japanese' => 'きれいな花', 'translation' => 'bông hoa đẹp'],
                ['japanese' => '新しい本', 'translation' => 'cuốn sách mới'],
                ['japanese' => '静かな部屋', 'translation' => 'căn phòng yên tĩnh'],
            ],
            'usage_notes' => [
                'Tính từ đuôi い kết thúc bằng い và đứng trực tiếp trước danh từ',
                'Tính từ đuôi な cần thêm な khi bổ nghĩa cho danh từ',
                'Một số tính từ như きれい kết thúc bằng い nhưng là tính từ đuôi な',
                'Cần học thuộc từng tính từ thuộc loại nào',
            ],
            'difficulty_level' => 2,
        ]);

        // Bài tập cho bài 5
        $exercises5 = [
            [
                'type' => 'multiple_choice',
                'question' => '"大きい" là loại tính từ gì?',
                'options' => ['Tính từ đuôi い', 'Tính từ đuôi な', 'Cả hai', 'Không phải tính từ'],
                'correct_answer' => 'Tính từ đuôi い',
                'explanation' => '"大きい" (ookii) là tính từ đuôi い vì kết thúc bằng い.',
                'points' => 1,
                'difficulty_level' => 2,
            ],
            [
                'type' => 'translation',
                'question' => 'Dịch "bông hoa đẹp" sang tiếng Nhật',
                'correct_answer' => 'きれいな花',
                'explanation' => '"Bông hoa đẹp" trong tiếng Nhật là "きれいな花" (kirei na hana).',
                'points' => 2,
                'difficulty_level' => 2,
            ],
            [
                'type' => 'fill_blank',
                'question' => 'Điền từ thích hợp: ___ な部屋 (căn phòng yên tĩnh)',
                'correct_answer' => '静か',
                'explanation' => '"Yên tĩnh" trong tiếng Nhật là "静か" (shizuka) - tính từ đuôi な.',
                'points' => 2,
                'difficulty_level' => 2,
            ],
        ];

        foreach ($exercises5 as $exercise) {
            Exercise::create(array_merge($exercise, ['lesson_id' => $lesson5->id]));
        }
    }
}

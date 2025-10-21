<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Grammar;
use App\Models\Exercise;
use Illuminate\Support\Facades\DB;

class CompleteN5LessonsSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing N5 lessons
        Lesson::where('level', 1)->delete();
        Vocabulary::where('lesson_id', '>', 0)->whereHas('lesson', function($query) {
            $query->where('level', 1);
        })->delete();
        Grammar::where('lesson_id', '>', 0)->whereHas('lesson', function($query) {
            $query->where('level', 1);
        })->delete();
        Exercise::where('lesson_id', '>', 0)->whereHas('lesson', function($query) {
            $query->where('level', 1);
        })->delete();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $n5Lessons = [
            // Bài 1-5: Hiragana cơ bản
            [
                'title' => 'Hiragana - Nguyên âm cơ bản (あいうえお)',
                'description' => 'Học 5 nguyên âm cơ bản trong bảng chữ cái Hiragana',
                'level' => 1,
                'order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Hiragana - Hàng K (かきくけこ)',
                'description' => 'Học các ký tự Hiragana hàng K với nguyên âm',
                'level' => 1,
                'order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Hiragana - Hàng S (さしすせそ)',
                'description' => 'Học các ký tự Hiragana hàng S',
                'content' => 'Bài học về hàng S: さ (sa), し (shi), す (su), せ (se), そ (so)',
                'level' => 1,
                'order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'Hiragana - Hàng T (たちつてと)',
                'description' => 'Học các ký tự Hiragana hàng T',
                'content' => 'Bài học về hàng T: た (ta), ち (chi), つ (tsu), て (te), と (to)',
                'level' => 1,
                'order' => 4,
                'is_active' => true
            ],
            [
                'title' => 'Hiragana - Hàng N (なにぬねの)',
                'description' => 'Học các ký tự Hiragana hàng N',
                'content' => 'Bài học về hàng N: な (na), に (ni), ぬ (nu), ね (ne), の (no)',
                'level' => 1,
                'order' => 5,
                'is_active' => true
            ],

            // Bài 6-10: Hiragana tiếp theo
            [
                'title' => 'Hiragana - Hàng H (はひふへほ)',
                'description' => 'Học các ký tự Hiragana hàng H',
                'content' => 'Bài học về hàng H: は (ha), ひ (hi), ふ (fu), へ (he), ほ (ho)',
                'level' => 1,
                'order' => 6,
                'is_active' => true
            ],
            [
                'title' => 'Hiragana - Hàng M (まみむめも)',
                'description' => 'Học các ký tự Hiragana hàng M',
                'content' => 'Bài học về hàng M: ま (ma), み (mi), む (mu), め (me), も (mo)',
                'level' => 1,
                'order' => 7,
                'is_active' => true
            ],
            [
                'title' => 'Hiragana - Hàng Y (やゆよ)',
                'description' => 'Học các ký tự Hiragana hàng Y',
                'content' => 'Bài học về hàng Y: や (ya), ゆ (yu), よ (yo)',
                'level' => 1,
                'order' => 8,
                'is_active' => true
            ],
            [
                'title' => 'Hiragana - Hàng R (らりるれろ)',
                'description' => 'Học các ký tự Hiragana hàng R',
                'content' => 'Bài học về hàng R: ら (ra), り (ri), る (ru), れ (re), ろ (ro)',
                'level' => 1,
                'order' => 9,
                'is_active' => true
            ],
            [
                'title' => 'Hiragana - Hàng W (わをん)',
                'description' => 'Học các ký tự Hiragana hàng W và ん',
                'content' => 'Bài học về hàng W: わ (wa), を (wo), ん (n)',
                'level' => 1,
                'order' => 10,
                'is_active' => true
            ],

            // Bài 11-15: Số đếm và thời gian
            [
                'title' => 'Số đếm từ 1-10',
                'description' => 'Học cách đếm số từ 1 đến 10 trong tiếng Nhật',
                'content' => 'Bài học về số đếm: いち (1), に (2), さん (3), よん (4), ご (5), ろく (6), なな (7), はち (8), きゅう (9), じゅう (10)',
                'level' => 1,
                'order' => 11,
                'is_active' => true
            ],
            [
                'title' => 'Số đếm từ 11-100',
                'description' => 'Học cách đếm số từ 11 đến 100',
                'content' => 'Bài học về số đếm lớn hơn: じゅういち (11), にじゅう (20), ひゃく (100)',
                'level' => 1,
                'order' => 12,
                'is_active' => true
            ],
            [
                'title' => 'Thời gian - Giờ và phút',
                'description' => 'Học cách nói giờ và phút trong tiếng Nhật',
                'content' => 'Bài học về thời gian: いま (bây giờ), じ (giờ), ふん (phút)',
                'level' => 1,
                'order' => 13,
                'is_active' => true
            ],
            [
                'title' => 'Ngày trong tuần',
                'description' => 'Học tên các ngày trong tuần',
                'content' => 'Bài học về ngày trong tuần: げつようび (thứ 2), かようび (thứ 3), すいようび (thứ 4), もくようび (thứ 5), きんようび (thứ 6), どようび (thứ 7), にちようび (chủ nhật)',
                'level' => 1,
                'order' => 14,
                'is_active' => true
            ],
            [
                'title' => 'Tháng trong năm',
                'description' => 'Học tên các tháng trong năm',
                'content' => 'Bài học về tháng: いちがつ (tháng 1), にがつ (tháng 2), さんがつ (tháng 3), しがつ (tháng 4), ごがつ (tháng 5), ろくがつ (tháng 6), しちがつ (tháng 7), はちがつ (tháng 8), くがつ (tháng 9), じゅうがつ (tháng 10), じゅういちがつ (tháng 11), じゅうにがつ (tháng 12)',
                'level' => 1,
                'order' => 15,
                'is_active' => true
            ],

            // Bài 16-20: Từ vựng cơ bản
            [
                'title' => 'Gia đình - かぞく',
                'description' => 'Học từ vựng về gia đình',
                'content' => 'Bài học về gia đình: おとうさん (bố), おかあさん (mẹ), おにいさん (anh trai), おねえさん (chị gái), いもうと (em gái), おとうと (em trai)',
                'level' => 1,
                'order' => 16,
                'is_active' => true
            ],
            [
                'title' => 'Màu sắc - いろ',
                'description' => 'Học từ vựng về màu sắc',
                'content' => 'Bài học về màu sắc: あか (đỏ), あお (xanh), きいろ (vàng), くろ (đen), しろ (trắng), みどり (xanh lá)',
                'level' => 1,
                'order' => 17,
                'is_active' => true
            ],
            [
                'title' => 'Đồ ăn - たべもの',
                'description' => 'Học từ vựng về đồ ăn cơ bản',
                'content' => 'Bài học về đồ ăn: ごはん (cơm), みず (nước), パン (bánh mì), りんご (táo), バナナ (chuối)',
                'level' => 1,
                'order' => 18,
                'is_active' => true
            ],
            [
                'title' => 'Động vật - どうぶつ',
                'description' => 'Học từ vựng về động vật',
                'content' => 'Bài học về động vật: いぬ (chó), ねこ (mèo), とり (chim), うま (ngựa), うし (bò)',
                'level' => 1,
                'order' => 19,
                'is_active' => true
            ],
            [
                'title' => 'Nghề nghiệp - しごと',
                'description' => 'Học từ vựng về nghề nghiệp',
                'content' => 'Bài học về nghề nghiệp: せんせい (giáo viên), いしゃ (bác sĩ), エンジニア (kỹ sư), がくせい (học sinh)',
                'level' => 1,
                'order' => 20,
                'is_active' => true
            ],

            // Bài 21-25: Ngữ pháp cơ bản
            [
                'title' => 'Đại từ nhân xưng - だいめいし',
                'description' => 'Học các đại từ nhân xưng cơ bản',
                'content' => 'Bài học về đại từ: わたし (tôi), あなた (bạn), かれ (anh ấy), かのじょ (cô ấy), わたしたち (chúng tôi)',
                'level' => 1,
                'order' => 21,
                'is_active' => true
            ],
            [
                'title' => 'Động từ です/だ',
                'description' => 'Học cách sử dụng động từ です và だ',
                'content' => 'Bài học về động từ: です (là - lịch sự), だ (là - thân mật)',
                'level' => 1,
                'order' => 22,
                'is_active' => true
            ],
            [
                'title' => 'Câu hỏi với なん/だれ/どこ',
                'description' => 'Học cách đặt câu hỏi cơ bản',
                'content' => 'Bài học về câu hỏi: なん (cái gì), だれ (ai), どこ (ở đâu), いつ (khi nào)',
                'level' => 1,
                'order' => 23,
                'is_active' => true
            ],
            [
                'title' => 'Tính từ cơ bản - けいようし',
                'description' => 'Học các tính từ cơ bản',
                'content' => 'Bài học về tính từ: おおきい (to), ちいさい (nhỏ), たかい (cao/đắt), やすい (rẻ), あたらしい (mới), ふるい (cũ)',
                'level' => 1,
                'order' => 24,
                'is_active' => true
            ],
            [
                'title' => 'Ôn tập N5 - ふくしゅう',
                'description' => 'Ôn tập toàn bộ kiến thức N5',
                'content' => 'Bài học ôn tập: Tổng hợp tất cả kiến thức đã học trong 24 bài trước',
                'level' => 1,
                'order' => 25,
                'is_active' => true
            ]
        ];

        foreach ($n5Lessons as $lessonData) {
            $lesson = Lesson::create($lessonData);
            
            // Tạo từ vựng mẫu cho mỗi bài học
            $this->createSampleVocabulary($lesson);
            
            // Tạo ngữ pháp mẫu cho mỗi bài học
            $this->createSampleGrammar($lesson);
            
            // Tạo bài tập mẫu cho mỗi bài học
            $this->createSampleExercises($lesson);
        }

        $this->command->info('Đã tạo ' . count($n5Lessons) . ' bài học N5 theo giáo trình phổ biến');
    }

    private function createSampleVocabulary($lesson)
    {
        $vocabularies = [];
        
        switch ($lesson->order) {
            case 1: // Nguyên âm
                $vocabularies = [
                    ['japanese' => 'あ', 'hiragana' => 'あ', 'romaji' => 'a', 'vietnamese' => 'a', 'topic' => 'Hiragana'],
                    ['japanese' => 'い', 'hiragana' => 'い', 'romaji' => 'i', 'vietnamese' => 'i', 'topic' => 'Hiragana'],
                    ['japanese' => 'う', 'hiragana' => 'う', 'romaji' => 'u', 'vietnamese' => 'u', 'topic' => 'Hiragana'],
                    ['japanese' => 'え', 'hiragana' => 'え', 'romaji' => 'e', 'vietnamese' => 'e', 'topic' => 'Hiragana'],
                    ['japanese' => 'お', 'hiragana' => 'お', 'romaji' => 'o', 'vietnamese' => 'o', 'topic' => 'Hiragana']
                ];
                break;
            case 11: // Số đếm
                $vocabularies = [
                    ['japanese' => '一', 'hiragana' => 'いち', 'vietnamese' => 'một', 'topic' => 'Số đếm'],
                    ['japanese' => '二', 'hiragana' => 'に', 'vietnamese' => 'hai', 'topic' => 'Số đếm'],
                    ['japanese' => '三', 'hiragana' => 'さん', 'vietnamese' => 'ba', 'topic' => 'Số đếm'],
                    ['japanese' => '四', 'hiragana' => 'よん', 'vietnamese' => 'bốn', 'topic' => 'Số đếm'],
                    ['japanese' => '五', 'hiragana' => 'ご', 'vietnamese' => 'năm', 'topic' => 'Số đếm']
                ];
                break;
            case 16: // Gia đình
                $vocabularies = [
                    ['japanese' => '父', 'hiragana' => 'おとうさん', 'vietnamese' => 'bố', 'topic' => 'Gia đình'],
                    ['japanese' => '母', 'hiragana' => 'おかあさん', 'vietnamese' => 'mẹ', 'topic' => 'Gia đình'],
                    ['japanese' => '兄', 'hiragana' => 'おにいさん', 'vietnamese' => 'anh trai', 'topic' => 'Gia đình'],
                    ['japanese' => '姉', 'hiragana' => 'おねえさん', 'vietnamese' => 'chị gái', 'topic' => 'Gia đình'],
                    ['japanese' => '弟', 'hiragana' => 'おとうと', 'vietnamese' => 'em trai', 'topic' => 'Gia đình']
                ];
                break;
            default:
                $vocabularies = [
                    ['japanese' => '例', 'hiragana' => 'れい', 'vietnamese' => 'ví dụ', 'topic' => 'Từ vựng'],
                    ['japanese' => '単語', 'hiragana' => 'たんご', 'vietnamese' => 'từ vựng', 'topic' => 'Từ vựng']
                ];
        }

        foreach ($vocabularies as $vocab) {
            Vocabulary::create([
                'lesson_id' => $lesson->id,
                'japanese' => $vocab['japanese'],
                'hiragana' => $vocab['hiragana'],
                'vietnamese' => $vocab['vietnamese'],
                'topic' => $vocab['topic'],
                'is_active' => true
            ]);
        }
    }

    private function createSampleGrammar($lesson)
    {
        if ($lesson->order >= 21) { // Chỉ tạo ngữ pháp cho bài 21 trở đi
            Grammar::create([
                'lesson_id' => $lesson->id,
                'title' => 'Ngữ pháp cơ bản',
                'content' => 'Giải thích ngữ pháp cơ bản cho bài học này',
                'examples' => 'Ví dụ sử dụng ngữ pháp',
                'is_active' => true
            ]);
        }
    }

    private function createSampleExercises($lesson)
    {
        Exercise::create([
            'lesson_id' => $lesson->id,
            'title' => 'Bài tập ' . $lesson->title,
            'content' => 'Nội dung bài tập cho ' . $lesson->title,
            'type' => 'multiple_choice',
            'is_active' => true
        ]);
    }
}

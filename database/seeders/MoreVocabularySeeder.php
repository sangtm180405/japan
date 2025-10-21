<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Vocabulary;

class MoreVocabularySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo bài học về thời gian
        $lesson8 = Lesson::create([
            'title' => 'Thời gian và ngày tháng',
            'description' => 'Học các từ vựng về thời gian, ngày tháng và các thứ trong tuần.',
            'level' => 1,
            'order' => 6,
            'is_active' => true,
        ]);

        $timeVocab = [
            ['japanese' => 'じかん', 'hiragana' => 'じかん', 'romaji' => 'jikan', 'vietnamese' => 'thời gian', 'example_sentence' => '時間があります (jikan ga arimasu) - có thời gian', 'example_translation' => 'có thời gian', 'difficulty_level' => 1],
            ['japanese' => 'いま', 'hiragana' => 'いま', 'romaji' => 'ima', 'vietnamese' => 'bây giờ', 'example_sentence' => '今何時ですか (ima nanji desu ka) - bây giờ mấy giờ?', 'example_translation' => 'bây giờ mấy giờ?', 'difficulty_level' => 1],
            ['japanese' => 'きょう', 'hiragana' => 'きょう', 'romaji' => 'kyou', 'vietnamese' => 'hôm nay', 'example_sentence' => '今日はいい天気です (kyou wa ii tenki desu) - hôm nay trời đẹp', 'example_translation' => 'hôm nay trời đẹp', 'difficulty_level' => 1],
            ['japanese' => 'きのう', 'hiragana' => 'きのう', 'romaji' => 'kinou', 'vietnamese' => 'hôm qua', 'example_sentence' => '昨日は雨でした (kinou wa ame deshita) - hôm qua trời mưa', 'example_translation' => 'hôm qua trời mưa', 'difficulty_level' => 1],
            ['japanese' => 'あした', 'hiragana' => 'あした', 'romaji' => 'ashita', 'vietnamese' => 'ngày mai', 'example_sentence' => '明日は学校です (ashita wa gakkou desu) - ngày mai đi học', 'example_translation' => 'ngày mai đi học', 'difficulty_level' => 1],
            ['japanese' => 'げつようび', 'hiragana' => 'げつようび', 'romaji' => 'getsuyoubi', 'vietnamese' => 'thứ hai', 'example_sentence' => '月曜日に会いましょう (getsuyoubi ni aimashou) - hẹn gặp thứ hai', 'example_translation' => 'hẹn gặp thứ hai', 'difficulty_level' => 1],
            ['japanese' => 'かようび', 'hiragana' => 'かようび', 'romaji' => 'kayoubi', 'vietnamese' => 'thứ ba', 'example_sentence' => '火曜日は忙しいです (kayoubi wa isogashii desu) - thứ ba bận', 'example_translation' => 'thứ ba bận', 'difficulty_level' => 1],
            ['japanese' => 'すいようび', 'hiragana' => 'すいようび', 'romaji' => 'suiyoubi', 'vietnamese' => 'thứ tư', 'example_sentence' => '水曜日に映画を見ます (suiyoubi ni eiga wo mimasu) - thứ tư xem phim', 'example_translation' => 'thứ tư xem phim', 'difficulty_level' => 1],
            ['japanese' => 'もくようび', 'hiragana' => 'もくようび', 'romaji' => 'mokuyoubi', 'vietnamese' => 'thứ năm', 'example_sentence' => '木曜日は休みです (mokuyoubi wa yasumi desu) - thứ năm nghỉ', 'example_translation' => 'thứ năm nghỉ', 'difficulty_level' => 1],
            ['japanese' => 'きんようび', 'hiragana' => 'きんようび', 'romaji' => 'kinyoubi', 'vietnamese' => 'thứ sáu', 'example_sentence' => '金曜日は楽しいです (kinyoubi wa tanoshii desu) - thứ sáu vui', 'example_translation' => 'thứ sáu vui', 'difficulty_level' => 1],
            ['japanese' => 'どようび', 'hiragana' => 'どようび', 'romaji' => 'doyoubi', 'vietnamese' => 'thứ bảy', 'example_sentence' => '土曜日に買い物します (doyoubi ni kaimono shimasu) - thứ bảy đi mua sắm', 'example_translation' => 'thứ bảy đi mua sắm', 'difficulty_level' => 1],
            ['japanese' => 'にちようび', 'hiragana' => 'にちようび', 'romaji' => 'nichiyoubi', 'vietnamese' => 'chủ nhật', 'example_sentence' => '日曜日は家族と過ごします (nichiyoubi wa kazoku to sugoshimasu) - chủ nhật ở với gia đình', 'example_translation' => 'chủ nhật ở với gia đình', 'difficulty_level' => 1],
        ];

        foreach ($timeVocab as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson8->id]));
        }

        // Tạo bài học về thức ăn
        $lesson9 = Lesson::create([
            'title' => 'Thức ăn và đồ uống',
            'description' => 'Học các từ vựng về thức ăn và đồ uống trong tiếng Nhật.',
            'level' => 1,
            'order' => 7,
            'is_active' => true,
        ]);

        $foodVocab = [
            ['japanese' => 'ごはん', 'hiragana' => 'ごはん', 'romaji' => 'gohan', 'vietnamese' => 'cơm', 'example_sentence' => 'ご飯を食べます (gohan wo tabemasu) - ăn cơm', 'example_translation' => 'ăn cơm', 'difficulty_level' => 1],
            ['japanese' => 'みず', 'hiragana' => 'みず', 'romaji' => 'mizu', 'vietnamese' => 'nước', 'example_sentence' => '水を飲みます (mizu wo nomimasu) - uống nước', 'example_translation' => 'uống nước', 'difficulty_level' => 1],
            ['japanese' => 'おちゃ', 'hiragana' => 'おちゃ', 'romaji' => 'ocha', 'vietnamese' => 'trà', 'example_sentence' => 'お茶を飲みます (ocha wo nomimasu) - uống trà', 'example_translation' => 'uống trà', 'difficulty_level' => 1],
            ['japanese' => 'コーヒー', 'hiragana' => 'コーヒー', 'romaji' => 'koohii', 'vietnamese' => 'cà phê', 'example_sentence' => 'コーヒーが好きです (koohii ga suki desu) - thích cà phê', 'example_translation' => 'thích cà phê', 'difficulty_level' => 1],
            ['japanese' => 'パン', 'hiragana' => 'パン', 'romaji' => 'pan', 'vietnamese' => 'bánh mì', 'example_sentence' => 'パンを食べます (pan wo tabemasu) - ăn bánh mì', 'example_translation' => 'ăn bánh mì', 'difficulty_level' => 1],
            ['japanese' => 'たまご', 'hiragana' => 'たまご', 'romaji' => 'tamago', 'vietnamese' => 'trứng', 'example_sentence' => '卵を食べます (tamago wo tabemasu) - ăn trứng', 'example_translation' => 'ăn trứng', 'difficulty_level' => 1],
            ['japanese' => 'にく', 'hiragana' => 'にく', 'romaji' => 'niku', 'vietnamese' => 'thịt', 'example_sentence' => '肉が好きです (niku ga suki desu) - thích thịt', 'example_translation' => 'thích thịt', 'difficulty_level' => 1],
            ['japanese' => 'さかな', 'hiragana' => 'さかな', 'romaji' => 'sakana', 'vietnamese' => 'cá', 'example_sentence' => '魚を食べます (sakana wo tabemasu) - ăn cá', 'example_translation' => 'ăn cá', 'difficulty_level' => 1],
            ['japanese' => 'やさい', 'hiragana' => 'やさい', 'romaji' => 'yasai', 'vietnamese' => 'rau', 'example_sentence' => '野菜を食べます (yasai wo tabemasu) - ăn rau', 'example_translation' => 'ăn rau', 'difficulty_level' => 1],
            ['japanese' => 'くだもの', 'hiragana' => 'くだもの', 'romaji' => 'kudamono', 'vietnamese' => 'trái cây', 'example_sentence' => '果物が好きです (kudamono ga suki desu) - thích trái cây', 'example_translation' => 'thích trái cây', 'difficulty_level' => 1],
            ['japanese' => 'りんご', 'hiragana' => 'りんご', 'romaji' => 'ringo', 'vietnamese' => 'táo', 'example_sentence' => 'りんごを食べます (ringo wo tabemasu) - ăn táo', 'example_translation' => 'ăn táo', 'difficulty_level' => 1],
            ['japanese' => 'みかん', 'hiragana' => 'みかん', 'romaji' => 'mikan', 'vietnamese' => 'cam', 'example_sentence' => 'みかんが甘いです (mikan ga amai desu) - cam ngọt', 'example_translation' => 'cam ngọt', 'difficulty_level' => 1],
        ];

        foreach ($foodVocab as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson9->id]));
        }

        // Tạo bài học về nghề nghiệp
        $lesson10 = Lesson::create([
            'title' => 'Nghề nghiệp',
            'description' => 'Học các từ vựng về nghề nghiệp và công việc trong tiếng Nhật.',
            'level' => 2,
            'order' => 3,
            'is_active' => true,
        ]);

        $jobVocab = [
            ['japanese' => 'しごと', 'hiragana' => 'しごと', 'romaji' => 'shigoto', 'vietnamese' => 'công việc', 'example_sentence' => '仕事をします (shigoto wo shimasu) - làm việc', 'example_translation' => 'làm việc', 'difficulty_level' => 2],
            ['japanese' => 'かいしゃいん', 'hiragana' => 'かいしゃいん', 'romaji' => 'kaishain', 'vietnamese' => 'nhân viên công ty', 'example_sentence' => '会社員です (kaishain desu) - là nhân viên công ty', 'example_translation' => 'là nhân viên công ty', 'difficulty_level' => 2],
            ['japanese' => 'せんせい', 'hiragana' => 'せんせい', 'romaji' => 'sensei', 'vietnamese' => 'giáo viên', 'example_sentence' => '先生です (sensei desu) - là giáo viên', 'example_translation' => 'là giáo viên', 'difficulty_level' => 2],
            ['japanese' => 'いしゃ', 'hiragana' => 'いしゃ', 'romaji' => 'isha', 'vietnamese' => 'bác sĩ', 'example_sentence' => '医者です (isha desu) - là bác sĩ', 'example_translation' => 'là bác sĩ', 'difficulty_level' => 2],
            ['japanese' => 'かんごし', 'hiragana' => 'かんごし', 'romaji' => 'kangoshi', 'vietnamese' => 'y tá', 'example_sentence' => '看護師です (kangoshi desu) - là y tá', 'example_translation' => 'là y tá', 'difficulty_level' => 2],
            ['japanese' => 'エンジニア', 'hiragana' => 'エンジニア', 'romaji' => 'enjinia', 'vietnamese' => 'kỹ sư', 'example_sentence' => 'エンジニアです (enjinia desu) - là kỹ sư', 'example_translation' => 'là kỹ sư', 'difficulty_level' => 2],
            ['japanese' => 'デザイナー', 'hiragana' => 'デザイナー', 'romaji' => 'dezainaa', 'vietnamese' => 'nhà thiết kế', 'example_sentence' => 'デザイナーです (dezainaa desu) - là nhà thiết kế', 'example_translation' => 'là nhà thiết kế', 'difficulty_level' => 2],
            ['japanese' => 'コック', 'hiragana' => 'コック', 'romaji' => 'kokku', 'vietnamese' => 'đầu bếp', 'example_sentence' => 'コックです (kokku desu) - là đầu bếp', 'example_translation' => 'là đầu bếp', 'difficulty_level' => 2],
            ['japanese' => 'うんてんしゅ', 'hiragana' => 'うんてんしゅ', 'romaji' => 'untenshu', 'vietnamese' => 'tài xế', 'example_sentence' => '運転手です (untenshu desu) - là tài xế', 'example_translation' => 'là tài xế', 'difficulty_level' => 2],
            ['japanese' => 'けいさつかん', 'hiragana' => 'けいさつかん', 'romaji' => 'keisatsukan', 'vietnamese' => 'cảnh sát', 'example_sentence' => '警察官です (keisatsukan desu) - là cảnh sát', 'example_translation' => 'là cảnh sát', 'difficulty_level' => 2],
        ];

        foreach ($jobVocab as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson10->id]));
        }

        $this->command->info('Đã thêm ' . Vocabulary::count() . ' từ vựng vào cơ sở dữ liệu.');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Vocabulary;

class FinalVocabularySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo bài học về địa điểm
        $lesson11 = Lesson::create([
            'title' => 'Địa điểm và phương hướng',
            'description' => 'Học các từ vựng về địa điểm và phương hướng trong tiếng Nhật.',
            'level' => 1,
            'order' => 8,
            'is_active' => true,
        ]);

        $placeVocab = [
            ['japanese' => 'ばしょ', 'hiragana' => 'ばしょ', 'romaji' => 'basho', 'vietnamese' => 'nơi, địa điểm', 'example_sentence' => '場所を教えてください (basho wo oshiete kudasai) - hãy chỉ nơi', 'example_translation' => 'hãy chỉ nơi', 'difficulty_level' => 1],
            ['japanese' => 'いえ', 'hiragana' => 'いえ', 'romaji' => 'ie', 'vietnamese' => 'nhà', 'example_sentence' => '家に帰ります (ie ni kaerimasu) - về nhà', 'example_translation' => 'về nhà', 'difficulty_level' => 1],
            ['japanese' => 'がっこう', 'hiragana' => 'がっこう', 'romaji' => 'gakkou', 'vietnamese' => 'trường học', 'example_sentence' => '学校に行きます (gakkou ni ikimasu) - đi học', 'example_translation' => 'đi học', 'difficulty_level' => 1],
            ['japanese' => 'びょういん', 'hiragana' => 'びょういん', 'romaji' => 'byouin', 'vietnamese' => 'bệnh viện', 'example_sentence' => '病院に行きます (byouin ni ikimasu) - đi bệnh viện', 'example_translation' => 'đi bệnh viện', 'difficulty_level' => 1],
            ['japanese' => 'ぎんこう', 'hiragana' => 'ぎんこう', 'romaji' => 'ginkou', 'vietnamese' => 'ngân hàng', 'example_sentence' => '銀行でお金を下ろします (ginkou de okane wo oroshimasu) - rút tiền ở ngân hàng', 'example_translation' => 'rút tiền ở ngân hàng', 'difficulty_level' => 1],
            ['japanese' => 'ゆうびんきょく', 'hiragana' => 'ゆうびんきょく', 'romaji' => 'yuubinkyoku', 'vietnamese' => 'bưu điện', 'example_sentence' => '郵便局で手紙を出します (yuubinkyoku de tegami wo dashimasu) - gửi thư ở bưu điện', 'example_translation' => 'gửi thư ở bưu điện', 'difficulty_level' => 1],
            ['japanese' => 'みせ', 'hiragana' => 'みせ', 'romaji' => 'mise', 'vietnamese' => 'cửa hàng', 'example_sentence' => '店で買い物します (mise de kaimono shimasu) - mua sắm ở cửa hàng', 'example_translation' => 'mua sắm ở cửa hàng', 'difficulty_level' => 1],
            ['japanese' => 'レストラン', 'hiragana' => 'レストラン', 'romaji' => 'resutoran', 'vietnamese' => 'nhà hàng', 'example_sentence' => 'レストランで食事します (resutoran de shokuji shimasu) - ăn ở nhà hàng', 'example_translation' => 'ăn ở nhà hàng', 'difficulty_level' => 1],
            ['japanese' => 'みち', 'hiragana' => 'みち', 'romaji' => 'michi', 'vietnamese' => 'đường', 'example_sentence' => '道を歩きます (michi wo arukimasu) - đi bộ trên đường', 'example_translation' => 'đi bộ trên đường', 'difficulty_level' => 1],
            ['japanese' => 'みぎ', 'hiragana' => 'みぎ', 'romaji' => 'migi', 'vietnamese' => 'bên phải', 'example_sentence' => '右に曲がります (migi ni magarimasu) - rẽ phải', 'example_translation' => 'rẽ phải', 'difficulty_level' => 1],
            ['japanese' => 'ひだり', 'hiragana' => 'ひだり', 'romaji' => 'hidari', 'vietnamese' => 'bên trái', 'example_sentence' => '左に曲がります (hidari ni magarimasu) - rẽ trái', 'example_translation' => 'rẽ trái', 'difficulty_level' => 1],
            ['japanese' => 'まえ', 'hiragana' => 'まえ', 'romaji' => 'mae', 'vietnamese' => 'phía trước', 'example_sentence' => '前に進みます (mae ni susumimasu) - tiến về phía trước', 'example_translation' => 'tiến về phía trước', 'difficulty_level' => 1],
            ['japanese' => 'うしろ', 'hiragana' => 'うしろ', 'romaji' => 'ushiro', 'vietnamese' => 'phía sau', 'example_sentence' => '後ろを見ます (ushiro wo mimasu) - nhìn phía sau', 'example_translation' => 'nhìn phía sau', 'difficulty_level' => 1],
        ];

        foreach ($placeVocab as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson11->id]));
        }

        // Tạo bài học về thời tiết
        $lesson12 = Lesson::create([
            'title' => 'Thời tiết và mùa',
            'description' => 'Học các từ vựng về thời tiết và các mùa trong tiếng Nhật.',
            'level' => 1,
            'order' => 9,
            'is_active' => true,
        ]);

        $weatherVocab = [
            ['japanese' => 'てんき', 'hiragana' => 'てんき', 'romaji' => 'tenki', 'vietnamese' => 'thời tiết', 'example_sentence' => '天気がいいです (tenki ga ii desu) - thời tiết đẹp', 'example_translation' => 'thời tiết đẹp', 'difficulty_level' => 1],
            ['japanese' => 'はれ', 'hiragana' => 'はれ', 'romaji' => 'hare', 'vietnamese' => 'nắng', 'example_sentence' => '晴れです (hare desu) - trời nắng', 'example_translation' => 'trời nắng', 'difficulty_level' => 1],
            ['japanese' => 'あめ', 'hiragana' => 'あめ', 'romaji' => 'ame', 'vietnamese' => 'mưa', 'example_sentence' => '雨が降ります (ame ga furimasu) - trời mưa', 'example_translation' => 'trời mưa', 'difficulty_level' => 1],
            ['japanese' => 'ゆき', 'hiragana' => 'ゆき', 'romaji' => 'yuki', 'vietnamese' => 'tuyết', 'example_sentence' => '雪が降ります (yuki ga furimasu) - trời tuyết', 'example_translation' => 'trời tuyết', 'difficulty_level' => 1],
            ['japanese' => 'くもり', 'hiragana' => 'くもり', 'romaji' => 'kumori', 'vietnamese' => 'có mây', 'example_sentence' => '曇りです (kumori desu) - trời có mây', 'example_translation' => 'trời có mây', 'difficulty_level' => 1],
            ['japanese' => 'かぜ', 'hiragana' => 'かぜ', 'romaji' => 'kaze', 'vietnamese' => 'gió', 'example_sentence' => '風が強いです (kaze ga tsuyoi desu) - gió mạnh', 'example_translation' => 'gió mạnh', 'difficulty_level' => 1],
            ['japanese' => 'はる', 'hiragana' => 'はる', 'romaji' => 'haru', 'vietnamese' => 'mùa xuân', 'example_sentence' => '春は暖かいです (haru wa atatakai desu) - mùa xuân ấm áp', 'example_translation' => 'mùa xuân ấm áp', 'difficulty_level' => 1],
            ['japanese' => 'なつ', 'hiragana' => 'なつ', 'romaji' => 'natsu', 'vietnamese' => 'mùa hè', 'example_sentence' => '夏は暑いです (natsu wa atsui desu) - mùa hè nóng', 'example_translation' => 'mùa hè nóng', 'difficulty_level' => 1],
            ['japanese' => 'あき', 'hiragana' => 'あき', 'romaji' => 'aki', 'vietnamese' => 'mùa thu', 'example_sentence' => '秋は涼しいです (aki wa suzushii desu) - mùa thu mát mẻ', 'example_translation' => 'mùa thu mát mẻ', 'difficulty_level' => 1],
            ['japanese' => 'ふゆ', 'hiragana' => 'ふゆ', 'romaji' => 'fuyu', 'vietnamese' => 'mùa đông', 'example_sentence' => '冬は寒いです (fuyu wa samui desu) - mùa đông lạnh', 'example_translation' => 'mùa đông lạnh', 'difficulty_level' => 1],
        ];

        foreach ($weatherVocab as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson12->id]));
        }

        // Tạo bài học về cảm xúc
        $lesson13 = Lesson::create([
            'title' => 'Cảm xúc và tính cách',
            'description' => 'Học các từ vựng về cảm xúc và tính cách trong tiếng Nhật.',
            'level' => 2,
            'order' => 4,
            'is_active' => true,
        ]);

        $emotionVocab = [
            ['japanese' => 'きもち', 'hiragana' => 'きもち', 'romaji' => 'kimochi', 'vietnamese' => 'cảm xúc', 'example_sentence' => '気持ちがいいです (kimochi ga ii desu) - cảm thấy tốt', 'example_translation' => 'cảm thấy tốt', 'difficulty_level' => 2],
            ['japanese' => 'うれしい', 'hiragana' => 'うれしい', 'romaji' => 'ureshii', 'vietnamese' => 'vui mừng', 'example_sentence' => '嬉しいです (ureshii desu) - tôi vui mừng', 'example_translation' => 'tôi vui mừng', 'difficulty_level' => 2],
            ['japanese' => 'かなしい', 'hiragana' => 'かなしい', 'romaji' => 'kanashii', 'vietnamese' => 'buồn', 'example_sentence' => '悲しいです (kanashii desu) - tôi buồn', 'example_translation' => 'tôi buồn', 'difficulty_level' => 2],
            ['japanese' => 'おこる', 'hiragana' => 'おこる', 'romaji' => 'okoru', 'vietnamese' => 'tức giận', 'example_sentence' => '怒ります (okorimasu) - tôi tức giận', 'example_translation' => 'tôi tức giận', 'difficulty_level' => 2],
            ['japanese' => 'こわい', 'hiragana' => 'こわい', 'romaji' => 'kowai', 'vietnamese' => 'sợ hãi', 'example_sentence' => '怖いです (kowai desu) - tôi sợ', 'example_translation' => 'tôi sợ', 'difficulty_level' => 2],
            ['japanese' => 'びっくり', 'hiragana' => 'びっくり', 'romaji' => 'bikkuri', 'vietnamese' => 'ngạc nhiên', 'example_sentence' => 'びっくりしました (bikkuri shimashita) - tôi ngạc nhiên', 'example_translation' => 'tôi ngạc nhiên', 'difficulty_level' => 2],
            ['japanese' => 'しんぱい', 'hiragana' => 'しんぱい', 'romaji' => 'shinpai', 'vietnamese' => 'lo lắng', 'example_sentence' => '心配です (shinpai desu) - tôi lo lắng', 'example_translation' => 'tôi lo lắng', 'difficulty_level' => 2],
            ['japanese' => 'やすらか', 'hiragana' => 'やすらか', 'romaji' => 'yasuragi', 'vietnamese' => 'bình yên', 'example_sentence' => '安らかです (yasuragi desu) - bình yên', 'example_translation' => 'bình yên', 'difficulty_level' => 2],
            ['japanese' => 'たのしい', 'hiragana' => 'たのしい', 'romaji' => 'tanoshii', 'vietnamese' => 'vui vẻ', 'example_sentence' => '楽しいです (tanoshii desu) - vui vẻ', 'example_translation' => 'vui vẻ', 'difficulty_level' => 2],
            ['japanese' => 'つまらない', 'hiragana' => 'つまらない', 'romaji' => 'tsumaranai', 'vietnamese' => 'nhàm chán', 'example_sentence' => 'つまらないです (tsumaranai desu) - nhàm chán', 'example_translation' => 'nhàm chán', 'difficulty_level' => 2],
        ];

        foreach ($emotionVocab as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson13->id]));
        }

        // Tạo bài học về thể thao
        $lesson14 = Lesson::create([
            'title' => 'Thể thao và hoạt động',
            'description' => 'Học các từ vựng về thể thao và hoạt động trong tiếng Nhật.',
            'level' => 2,
            'order' => 5,
            'is_active' => true,
        ]);

        $sportVocab = [
            ['japanese' => 'スポーツ', 'hiragana' => 'スポーツ', 'romaji' => 'supootsu', 'vietnamese' => 'thể thao', 'example_sentence' => 'スポーツが好きです (supootsu ga suki desu) - thích thể thao', 'example_translation' => 'thích thể thao', 'difficulty_level' => 2],
            ['japanese' => 'サッカー', 'hiragana' => 'サッカー', 'romaji' => 'sakkaa', 'vietnamese' => 'bóng đá', 'example_sentence' => 'サッカーをします (sakkaa wo shimasu) - chơi bóng đá', 'example_translation' => 'chơi bóng đá', 'difficulty_level' => 2],
            ['japanese' => 'テニス', 'hiragana' => 'テニス', 'romaji' => 'tenisu', 'vietnamese' => 'tennis', 'example_sentence' => 'テニスをします (tenisu wo shimasu) - chơi tennis', 'example_translation' => 'chơi tennis', 'difficulty_level' => 2],
            ['japanese' => 'バスケットボール', 'hiragana' => 'バスケットボール', 'romaji' => 'basukettobooru', 'vietnamese' => 'bóng rổ', 'example_sentence' => 'バスケットボールをします (basukettobooru wo shimasu) - chơi bóng rổ', 'example_translation' => 'chơi bóng rổ', 'difficulty_level' => 2],
            ['japanese' => 'すいえい', 'hiragana' => 'すいえい', 'romaji' => 'suiei', 'vietnamese' => 'bơi lội', 'example_sentence' => '水泳をします (suiei wo shimasu) - bơi lội', 'example_translation' => 'bơi lội', 'difficulty_level' => 2],
            ['japanese' => 'ランニング', 'hiragana' => 'ランニング', 'romaji' => 'ranningu', 'vietnamese' => 'chạy bộ', 'example_sentence' => 'ランニングをします (ranningu wo shimasu) - chạy bộ', 'example_translation' => 'chạy bộ', 'difficulty_level' => 2],
            ['japanese' => 'サイクリング', 'hiragana' => 'サイクリング', 'romaji' => 'saikuringu', 'vietnamese' => 'đạp xe', 'example_sentence' => 'サイクリングをします (saikuringu wo shimasu) - đạp xe', 'example_translation' => 'đạp xe', 'difficulty_level' => 2],
            ['japanese' => 'ダンス', 'hiragana' => 'ダンス', 'romaji' => 'dansu', 'vietnamese' => 'nhảy múa', 'example_sentence' => 'ダンスをします (dansu wo shimasu) - nhảy múa', 'example_translation' => 'nhảy múa', 'difficulty_level' => 2],
            ['japanese' => 'ヨガ', 'hiragana' => 'ヨガ', 'romaji' => 'yoga', 'vietnamese' => 'yoga', 'example_sentence' => 'ヨガをします (yoga wo shimasu) - tập yoga', 'example_translation' => 'tập yoga', 'difficulty_level' => 2],
            ['japanese' => 'ジム', 'hiragana' => 'ジム', 'romaji' => 'jimu', 'vietnamese' => 'phòng gym', 'example_sentence' => 'ジムに行きます (jimu ni ikimasu) - đi phòng gym', 'example_translation' => 'đi phòng gym', 'difficulty_level' => 2],
        ];

        foreach ($sportVocab as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson14->id]));
        }

        $this->command->info('Đã thêm ' . Vocabulary::count() . ' từ vựng vào cơ sở dữ liệu.');
    }
}

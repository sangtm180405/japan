<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Vocabulary;

class ExtendedVocabularySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy các bài học đã có
        $lessons = Lesson::all();
        
        if ($lessons->count() == 0) {
            $this->command->info('Không có bài học nào. Vui lòng chạy StandardJapaneseLessonsSeeder trước.');
            return;
        }

        // Mở rộng từ vựng cho bài Hiragana (N5 - Bài 1)
        $lesson1 = $lessons->where('title', 'Hiragana - Nguyên âm và phụ âm cơ bản')->first();
        if ($lesson1) {
            $additionalVocab1 = [
                // Phụ âm S
                ['japanese' => 'さ', 'hiragana' => 'さ', 'romaji' => 'sa', 'vietnamese' => 'chữ cái sa', 'example_sentence' => 'さくら (sakura) - hoa anh đào', 'example_translation' => 'hoa anh đào', 'difficulty_level' => 1],
                ['japanese' => 'し', 'hiragana' => 'し', 'romaji' => 'shi', 'vietnamese' => 'chữ cái shi', 'example_sentence' => 'しろ (shiro) - màu trắng', 'example_translation' => 'màu trắng', 'difficulty_level' => 1],
                ['japanese' => 'す', 'hiragana' => 'す', 'romaji' => 'su', 'vietnamese' => 'chữ cái su', 'example_sentence' => 'すし (sushi) - sushi', 'example_translation' => 'sushi', 'difficulty_level' => 1],
                ['japanese' => 'せ', 'hiragana' => 'せ', 'romaji' => 'se', 'vietnamese' => 'chữ cái se', 'example_sentence' => 'せんせい (sensei) - thầy cô', 'example_translation' => 'thầy cô', 'difficulty_level' => 1],
                ['japanese' => 'そ', 'hiragana' => 'そ', 'romaji' => 'so', 'vietnamese' => 'chữ cái so', 'example_sentence' => 'そら (sora) - bầu trời', 'example_translation' => 'bầu trời', 'difficulty_level' => 1],
                
                // Phụ âm T
                ['japanese' => 'た', 'hiragana' => 'た', 'romaji' => 'ta', 'vietnamese' => 'chữ cái ta', 'example_sentence' => 'たべる (taberu) - ăn', 'example_translation' => 'ăn', 'difficulty_level' => 1],
                ['japanese' => 'ち', 'hiragana' => 'ち', 'romaji' => 'chi', 'vietnamese' => 'chữ cái chi', 'example_sentence' => 'ちいさい (chiisai) - nhỏ', 'example_translation' => 'nhỏ', 'difficulty_level' => 1],
                ['japanese' => 'つ', 'hiragana' => 'つ', 'romaji' => 'tsu', 'vietnamese' => 'chữ cái tsu', 'example_sentence' => 'つくえ (tsukue) - bàn học', 'example_translation' => 'bàn học', 'difficulty_level' => 1],
                ['japanese' => 'て', 'hiragana' => 'て', 'romaji' => 'te', 'vietnamese' => 'chữ cái te', 'example_sentence' => 'て (te) - tay', 'example_translation' => 'tay', 'difficulty_level' => 1],
                ['japanese' => 'と', 'hiragana' => 'と', 'romaji' => 'to', 'vietnamese' => 'chữ cái to', 'example_sentence' => 'とけい (tokei) - đồng hồ', 'example_translation' => 'đồng hồ', 'difficulty_level' => 1],
                
                // Phụ âm N
                ['japanese' => 'な', 'hiragana' => 'な', 'romaji' => 'na', 'vietnamese' => 'chữ cái na', 'example_sentence' => 'なまえ (namae) - tên', 'example_translation' => 'tên', 'difficulty_level' => 1],
                ['japanese' => 'に', 'hiragana' => 'に', 'romaji' => 'ni', 'vietnamese' => 'chữ cái ni', 'example_sentence' => 'にほん (nihon) - Nhật Bản', 'example_translation' => 'Nhật Bản', 'difficulty_level' => 1],
                ['japanese' => 'ぬ', 'hiragana' => 'ぬ', 'romaji' => 'nu', 'vietnamese' => 'chữ cái nu', 'example_sentence' => 'ぬの (nuno) - vải', 'example_translation' => 'vải', 'difficulty_level' => 1],
                ['japanese' => 'ね', 'hiragana' => 'ね', 'romaji' => 'ne', 'vietnamese' => 'chữ cái ne', 'example_sentence' => 'ねこ (neko) - con mèo', 'example_translation' => 'con mèo', 'difficulty_level' => 1],
                ['japanese' => 'の', 'hiragana' => 'の', 'romaji' => 'no', 'vietnamese' => 'chữ cái no', 'example_sentence' => 'のる (noru) - lên xe', 'example_translation' => 'lên xe', 'difficulty_level' => 1],
            ];

            foreach ($additionalVocab1 as $vocab) {
                Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson1->id]));
            }
        }

        // Mở rộng từ vựng cho bài Số đếm (N5 - Bài 2)
        $lesson2 = $lessons->where('title', 'Số đếm từ 1-10')->first();
        if ($lesson2) {
            $additionalVocab2 = [
                // Số đếm 11-20
                ['japanese' => 'じゅういち', 'hiragana' => 'じゅういち', 'romaji' => 'juuichi', 'vietnamese' => 'số 11', 'example_sentence' => 'じゅういちがつ (juuichigatsu) - tháng 11', 'example_translation' => 'tháng 11', 'difficulty_level' => 1],
                ['japanese' => 'じゅうに', 'hiragana' => 'じゅうに', 'romaji' => 'juuni', 'vietnamese' => 'số 12', 'example_sentence' => 'じゅうにがつ (juunigatsu) - tháng 12', 'example_translation' => 'tháng 12', 'difficulty_level' => 1],
                ['japanese' => 'にじゅう', 'hiragana' => 'にじゅう', 'romaji' => 'nijuu', 'vietnamese' => 'số 20', 'example_sentence' => 'にじゅうさい (nijuusai) - 20 tuổi', 'example_translation' => '20 tuổi', 'difficulty_level' => 1],
                
                // Số đếm đặc biệt
                ['japanese' => 'ゼロ', 'hiragana' => 'ゼロ', 'romaji' => 'zero', 'vietnamese' => 'số 0', 'example_sentence' => 'ゼロてん (zero ten) - 0 điểm', 'example_translation' => '0 điểm', 'difficulty_level' => 1],
                ['japanese' => 'ひゃく', 'hiragana' => 'ひゃく', 'romaji' => 'hyaku', 'vietnamese' => 'số 100', 'example_sentence' => 'ひゃくえん (hyaku en) - 100 yên', 'example_translation' => '100 yên', 'difficulty_level' => 1],
                ['japanese' => 'せん', 'hiragana' => 'せん', 'romaji' => 'sen', 'vietnamese' => 'số 1000', 'example_sentence' => 'せんえん (sen en) - 1000 yên', 'example_translation' => '1000 yên', 'difficulty_level' => 1],
            ];

            foreach ($additionalVocab2 as $vocab) {
                Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson2->id]));
            }
        }

        // Mở rộng từ vựng cho bài Chào hỏi (N5 - Bài 3)
        $lesson3 = $lessons->where('title', 'Chào hỏi cơ bản')->first();
        if ($lesson3) {
            $additionalVocab3 = [
                // Chào hỏi nâng cao
                ['japanese' => 'おはようございます', 'hiragana' => 'おはようございます', 'romaji' => 'ohayou gozaimasu', 'vietnamese' => 'chào buổi sáng (lịch sự)', 'example_sentence' => 'おはようございます、先生。', 'example_translation' => 'Chào buổi sáng, thầy/cô.', 'difficulty_level' => 1],
                ['japanese' => 'こんにちは', 'hiragana' => 'こんにちは', 'romaji' => 'konnichiwa', 'vietnamese' => 'xin chào (ban ngày)', 'example_sentence' => 'こんにちは、元気ですか？', 'example_translation' => 'Xin chào, bạn có khỏe không?', 'difficulty_level' => 1],
                ['japanese' => 'こんばんは', 'hiragana' => 'こんばんは', 'romaji' => 'konbanwa', 'vietnamese' => 'chào buổi tối', 'example_sentence' => 'こんばんは、お疲れ様です。', 'example_translation' => 'Chào buổi tối, anh/chị đã vất vả rồi.', 'difficulty_level' => 1],
                ['japanese' => 'おやすみなさい', 'hiragana' => 'おやすみなさい', 'romaji' => 'oyasuminasai', 'vietnamese' => 'chúc ngủ ngon', 'example_sentence' => 'おやすみなさい、お母さん。', 'example_translation' => 'Chúc mẹ ngủ ngon.', 'difficulty_level' => 1],
                ['japanese' => 'また明日', 'hiragana' => 'またあした', 'romaji' => 'mata ashita', 'vietnamese' => 'hẹn gặp lại ngày mai', 'example_sentence' => 'また明日、学校で。', 'example_translation' => 'Hẹn gặp lại ngày mai ở trường.', 'difficulty_level' => 1],
                
                // Cảm ơn và xin lỗi
                ['japanese' => 'ありがとうございます', 'hiragana' => 'ありがとうございます', 'romaji' => 'arigatou gozaimasu', 'vietnamese' => 'cảm ơn (lịch sự)', 'example_sentence' => 'ありがとうございます、助かりました。', 'example_translation' => 'Cảm ơn, đã giúp tôi rất nhiều.', 'difficulty_level' => 1],
                ['japanese' => 'すみません', 'hiragana' => 'すみません', 'romaji' => 'sumimasen', 'vietnamese' => 'xin lỗi', 'example_sentence' => 'すみません、道を教えてください。', 'example_translation' => 'Xin lỗi, hãy chỉ đường cho tôi.', 'difficulty_level' => 1],
                ['japanese' => 'ごめんなさい', 'hiragana' => 'ごめんなさい', 'romaji' => 'gomennasai', 'vietnamese' => 'xin lỗi (thân mật)', 'example_sentence' => 'ごめんなさい、遅れました。', 'example_translation' => 'Xin lỗi, tôi đã đến muộn.', 'difficulty_level' => 1],
                
                // Câu hỏi cơ bản
                ['japanese' => 'お元気ですか', 'hiragana' => 'おげんきですか', 'romaji' => 'ogenki desu ka', 'vietnamese' => 'bạn có khỏe không?', 'example_sentence' => 'お元気ですか、田中さん？', 'example_translation' => 'Anh Tanaka có khỏe không?', 'difficulty_level' => 1],
                ['japanese' => 'はい', 'hiragana' => 'はい', 'romaji' => 'hai', 'vietnamese' => 'vâng, có', 'example_sentence' => 'はい、元気です。', 'example_translation' => 'Vâng, tôi khỏe.', 'difficulty_level' => 1],
                ['japanese' => 'いいえ', 'hiragana' => 'いいえ', 'romaji' => 'iie', 'vietnamese' => 'không', 'example_sentence' => 'いいえ、違います。', 'example_translation' => 'Không, không đúng.', 'difficulty_level' => 1],
            ];

            foreach ($additionalVocab3 as $vocab) {
                Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson3->id]));
            }
        }

        // Mở rộng từ vựng cho bài Động từ (N4 - Bài 1)
        $lesson4 = $lessons->where('title', 'Động từ cơ bản - Thể từ điển')->first();
        if ($lesson4) {
            $additionalVocab4 = [
                // Động từ cơ bản thêm
                ['japanese' => 'かく', 'hiragana' => 'かく', 'romaji' => 'kaku', 'vietnamese' => 'viết', 'example_sentence' => '手紙を書く (tegami wo kaku) - viết thư', 'example_translation' => 'viết thư', 'difficulty_level' => 2],
                ['japanese' => 'はなす', 'hiragana' => 'はなす', 'romaji' => 'hanasu', 'vietnamese' => 'nói chuyện', 'example_sentence' => '友達と話す (tomodachi to hanasu) - nói chuyện với bạn', 'example_translation' => 'nói chuyện với bạn', 'difficulty_level' => 2],
                ['japanese' => 'きく', 'hiragana' => 'きく', 'romaji' => 'kiku', 'vietnamese' => 'nghe', 'example_sentence' => '音楽を聞く (ongaku wo kiku) - nghe nhạc', 'example_translation' => 'nghe nhạc', 'difficulty_level' => 2],
                ['japanese' => 'よむ', 'hiragana' => 'よむ', 'romaji' => 'yomu', 'vietnamese' => 'đọc', 'example_sentence' => '本を読む (hon wo yomu) - đọc sách', 'example_translation' => 'đọc sách', 'difficulty_level' => 2],
                ['japanese' => 'かう', 'hiragana' => 'かう', 'romaji' => 'kau', 'vietnamese' => 'mua', 'example_sentence' => '服を買う (fuku wo kau) - mua quần áo', 'example_translation' => 'mua quần áo', 'difficulty_level' => 2],
                ['japanese' => 'うる', 'hiragana' => 'うる', 'romaji' => 'uru', 'vietnamese' => 'bán', 'example_sentence' => '車を売る (kuruma wo uru) - bán xe', 'example_translation' => 'bán xe', 'difficulty_level' => 2],
                ['japanese' => 'つくる', 'hiragana' => 'つくる', 'romaji' => 'tsukuru', 'vietnamese' => 'làm, tạo', 'example_sentence' => '料理を作る (ryouri wo tsukuru) - nấu ăn', 'example_translation' => 'nấu ăn', 'difficulty_level' => 2],
                ['japanese' => 'あう', 'hiragana' => 'あう', 'romaji' => 'au', 'vietnamese' => 'gặp', 'example_sentence' => '友達に会う (tomodachi ni au) - gặp bạn', 'example_translation' => 'gặp bạn', 'difficulty_level' => 2],
                ['japanese' => 'わかる', 'hiragana' => 'わかる', 'romaji' => 'wakaru', 'vietnamese' => 'hiểu', 'example_sentence' => '日本語が分かる (nihongo ga wakaru) - hiểu tiếng Nhật', 'example_translation' => 'hiểu tiếng Nhật', 'difficulty_level' => 2],
                ['japanese' => 'しる', 'hiragana' => 'しる', 'romaji' => 'shiru', 'vietnamese' => 'biết', 'example_sentence' => '答えを知る (kotae wo shiru) - biết câu trả lời', 'example_translation' => 'biết câu trả lời', 'difficulty_level' => 2],
            ];

            foreach ($additionalVocab4 as $vocab) {
                Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson4->id]));
            }
        }

        // Mở rộng từ vựng cho bài Tính từ (N4 - Bài 2)
        $lesson5 = $lessons->where('title', 'Tính từ - Tính từ đuôi い và な')->first();
        if ($lesson5) {
            $additionalVocab5 = [
                // Tính từ đuôi い thêm
                ['japanese' => 'おおきい', 'hiragana' => 'おおきい', 'romaji' => 'ookii', 'vietnamese' => 'to, lớn', 'example_sentence' => '大きい家 (ookii ie) - ngôi nhà lớn', 'example_translation' => 'ngôi nhà lớn', 'difficulty_level' => 2],
                ['japanese' => 'ちいさい', 'hiragana' => 'ちいさい', 'romaji' => 'chiisai', 'vietnamese' => 'nhỏ, bé', 'example_sentence' => '小さい車 (chiisai kuruma) - chiếc xe nhỏ', 'example_translation' => 'chiếc xe nhỏ', 'difficulty_level' => 2],
                ['japanese' => 'あたらしい', 'hiragana' => 'あたらしい', 'romaji' => 'atarashii', 'vietnamese' => 'mới', 'example_sentence' => '新しい本 (atarashii hon) - cuốn sách mới', 'example_translation' => 'cuốn sách mới', 'difficulty_level' => 2],
                ['japanese' => 'ふるい', 'hiragana' => 'ふるい', 'romaji' => 'furui', 'vietnamese' => 'cũ', 'example_sentence' => '古い建物 (furui tatemono) - tòa nhà cũ', 'example_translation' => 'tòa nhà cũ', 'difficulty_level' => 2],
                ['japanese' => 'たかい', 'hiragana' => 'たかい', 'romaji' => 'takai', 'vietnamese' => 'cao, đắt', 'example_sentence' => '高い山 (takai yama) - ngọn núi cao', 'example_translation' => 'ngọn núi cao', 'difficulty_level' => 2],
                ['japanese' => 'ひくい', 'hiragana' => 'ひくい', 'romaji' => 'hikui', 'vietnamese' => 'thấp, rẻ', 'example_sentence' => '低い価格 (hikui kakaku) - giá rẻ', 'example_translation' => 'giá rẻ', 'difficulty_level' => 2],
                ['japanese' => 'ながい', 'hiragana' => 'ながい', 'romaji' => 'nagai', 'vietnamese' => 'dài', 'example_sentence' => '長い道 (nagai michi) - con đường dài', 'example_translation' => 'con đường dài', 'difficulty_level' => 2],
                ['japanese' => 'みじかい', 'hiragana' => 'みじかい', 'romaji' => 'mijikai', 'vietnamese' => 'ngắn', 'example_sentence' => '短い髪 (mijikai kami) - tóc ngắn', 'example_translation' => 'tóc ngắn', 'difficulty_level' => 2],
                ['japanese' => 'あつい', 'hiragana' => 'あつい', 'romaji' => 'atsui', 'vietnamese' => 'nóng', 'example_sentence' => '暑い日 (atsui hi) - ngày nóng', 'example_translation' => 'ngày nóng', 'difficulty_level' => 2],
                ['japanese' => 'さむい', 'hiragana' => 'さむい', 'romaji' => 'samui', 'vietnamese' => 'lạnh', 'example_sentence' => '寒い冬 (samui fuyu) - mùa đông lạnh', 'example_translation' => 'mùa đông lạnh', 'difficulty_level' => 2],
                
                // Tính từ đuôi な thêm
                ['japanese' => 'きれい', 'hiragana' => 'きれい', 'romaji' => 'kirei', 'vietnamese' => 'đẹp, sạch', 'example_sentence' => 'きれいな花 (kirei na hana) - bông hoa đẹp', 'example_translation' => 'bông hoa đẹp', 'difficulty_level' => 2],
                ['japanese' => 'しずか', 'hiragana' => 'しずか', 'romaji' => 'shizuka', 'vietnamese' => 'yên tĩnh', 'example_sentence' => '静かな部屋 (shizuka na heya) - căn phòng yên tĩnh', 'example_translation' => 'căn phòng yên tĩnh', 'difficulty_level' => 2],
                ['japanese' => 'にぎやか', 'hiragana' => 'にぎやか', 'romaji' => 'nigiyaka', 'vietnamese' => 'náo nhiệt', 'example_sentence' => 'にぎやかな街 (nigiyaka na machi) - thành phố náo nhiệt', 'example_translation' => 'thành phố náo nhiệt', 'difficulty_level' => 2],
                ['japanese' => 'ゆうめい', 'hiragana' => 'ゆうめい', 'romaji' => 'yuumei', 'vietnamese' => 'nổi tiếng', 'example_sentence' => '有名な人 (yuumei na hito) - người nổi tiếng', 'example_translation' => 'người nổi tiếng', 'difficulty_level' => 2],
                ['japanese' => 'べんり', 'hiragana' => 'べんり', 'romaji' => 'benri', 'vietnamese' => 'tiện lợi', 'example_sentence' => '便利な道具 (benri na dougu) - dụng cụ tiện lợi', 'example_translation' => 'dụng cụ tiện lợi', 'difficulty_level' => 2],
                ['japanese' => 'ふべん', 'hiragana' => 'ふべん', 'romaji' => 'fuben', 'vietnamese' => 'bất tiện', 'example_sentence' => '不便な場所 (fuben na basho) - nơi bất tiện', 'example_translation' => 'nơi bất tiện', 'difficulty_level' => 2],
                ['japanese' => 'げんき', 'hiragana' => 'げんき', 'romaji' => 'genki', 'vietnamese' => 'khỏe mạnh', 'example_sentence' => '元気な子供 (genki na kodomo) - đứa trẻ khỏe mạnh', 'example_translation' => 'đứa trẻ khỏe mạnh', 'difficulty_level' => 2],
                ['japanese' => 'しんせつ', 'hiragana' => 'しんせつ', 'romaji' => 'shinsetsu', 'vietnamese' => 'tốt bụng', 'example_sentence' => '親切な人 (shinsetsu na hito) - người tốt bụng', 'example_translation' => 'người tốt bụng', 'difficulty_level' => 2],
            ];

            foreach ($additionalVocab5 as $vocab) {
                Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson5->id]));
            }
        }

        // Tạo bài học mới với từ vựng gia đình
        $lesson6 = Lesson::create([
            'title' => 'Từ vựng gia đình',
            'description' => 'Học các từ vựng về gia đình và mối quan hệ trong tiếng Nhật.',
            'level' => 1,
            'order' => 4,
            'is_active' => true,
        ]);

        $familyVocab = [
            ['japanese' => 'かぞく', 'hiragana' => 'かぞく', 'romaji' => 'kazoku', 'vietnamese' => 'gia đình', 'example_sentence' => '私の家族 (watashi no kazoku) - gia đình tôi', 'example_translation' => 'gia đình tôi', 'difficulty_level' => 1],
            ['japanese' => 'おとうさん', 'hiragana' => 'おとうさん', 'romaji' => 'otousan', 'vietnamese' => 'bố', 'example_sentence' => 'お父さんは会社員です (otousan wa kaishain desu) - bố là nhân viên công ty', 'example_translation' => 'bố là nhân viên công ty', 'difficulty_level' => 1],
            ['japanese' => 'おかあさん', 'hiragana' => 'おかあさん', 'romaji' => 'okaasan', 'vietnamese' => 'mẹ', 'example_sentence' => 'お母さんは料理が上手です (okaasan wa ryouri ga jouzu desu) - mẹ nấu ăn giỏi', 'example_translation' => 'mẹ nấu ăn giỏi', 'difficulty_level' => 1],
            ['japanese' => 'おにいさん', 'hiragana' => 'おにいさん', 'romaji' => 'oniisan', 'vietnamese' => 'anh trai', 'example_sentence' => 'お兄さんは大学生です (oniisan wa daigakusei desu) - anh trai là sinh viên đại học', 'example_translation' => 'anh trai là sinh viên đại học', 'difficulty_level' => 1],
            ['japanese' => 'おねえさん', 'hiragana' => 'おねえさん', 'romaji' => 'oneesan', 'vietnamese' => 'chị gái', 'example_sentence' => 'お姉さんは看護師です (oneesan wa kangoshi desu) - chị gái là y tá', 'example_translation' => 'chị gái là y tá', 'difficulty_level' => 1],
            ['japanese' => 'おとうと', 'hiragana' => 'おとうと', 'romaji' => 'otouto', 'vietnamese' => 'em trai', 'example_sentence' => '弟は中学生です (otouto wa chuugakusei desu) - em trai là học sinh cấp 2', 'example_translation' => 'em trai là học sinh cấp 2', 'difficulty_level' => 1],
            ['japanese' => 'いもうと', 'hiragana' => 'いもうと', 'romaji' => 'imouto', 'vietnamese' => 'em gái', 'example_sentence' => '妹は小学生です (imouto wa shougakusei desu) - em gái là học sinh tiểu học', 'example_translation' => 'em gái là học sinh tiểu học', 'difficulty_level' => 1],
            ['japanese' => 'おじいさん', 'hiragana' => 'おじいさん', 'romaji' => 'ojiisan', 'vietnamese' => 'ông', 'example_sentence' => 'おじいさんは元気です (ojiisan wa genki desu) - ông khỏe mạnh', 'example_translation' => 'ông khỏe mạnh', 'difficulty_level' => 1],
            ['japanese' => 'おばあさん', 'hiragana' => 'おばあさん', 'romaji' => 'obaasan', 'vietnamese' => 'bà', 'example_sentence' => 'おばあさんは優しいです (obaasan wa yasashii desu) - bà hiền lành', 'example_translation' => 'bà hiền lành', 'difficulty_level' => 1],
            ['japanese' => 'いぬ', 'hiragana' => 'いぬ', 'romaji' => 'inu', 'vietnamese' => 'con chó', 'example_sentence' => '犬は可愛いです (inu wa kawaii desu) - con chó dễ thương', 'example_translation' => 'con chó dễ thương', 'difficulty_level' => 1],
            ['japanese' => 'ねこ', 'hiragana' => 'ねこ', 'romaji' => 'neko', 'vietnamese' => 'con mèo', 'example_sentence' => '猫は静かです (neko wa shizuka desu) - con mèo yên tĩnh', 'example_translation' => 'con mèo yên tĩnh', 'difficulty_level' => 1],
        ];

        foreach ($familyVocab as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson6->id]));
        }

        // Tạo bài học về màu sắc
        $lesson7 = Lesson::create([
            'title' => 'Màu sắc cơ bản',
            'description' => 'Học các từ vựng về màu sắc trong tiếng Nhật.',
            'level' => 1,
            'order' => 5,
            'is_active' => true,
        ]);

        $colorVocab = [
            ['japanese' => 'あか', 'hiragana' => 'あか', 'romaji' => 'aka', 'vietnamese' => 'màu đỏ', 'example_sentence' => '赤い花 (akai hana) - bông hoa đỏ', 'example_translation' => 'bông hoa đỏ', 'difficulty_level' => 1],
            ['japanese' => 'あお', 'hiragana' => 'あお', 'romaji' => 'ao', 'vietnamese' => 'màu xanh dương', 'example_sentence' => '青い空 (aoi sora) - bầu trời xanh', 'example_translation' => 'bầu trời xanh', 'difficulty_level' => 1],
            ['japanese' => 'きいろ', 'hiragana' => 'きいろ', 'romaji' => 'kiiro', 'vietnamese' => 'màu vàng', 'example_sentence' => '黄色い太陽 (kiiroi taiyou) - mặt trời vàng', 'example_translation' => 'mặt trời vàng', 'difficulty_level' => 1],
            ['japanese' => 'みどり', 'hiragana' => 'みどり', 'romaji' => 'midori', 'vietnamese' => 'màu xanh lá', 'example_sentence' => '緑の木 (midori no ki) - cây xanh', 'example_translation' => 'cây xanh', 'difficulty_level' => 1],
            ['japanese' => 'しろ', 'hiragana' => 'しろ', 'romaji' => 'shiro', 'vietnamese' => 'màu trắng', 'example_sentence' => '白い雲 (shiroi kumo) - mây trắng', 'example_translation' => 'mây trắng', 'difficulty_level' => 1],
            ['japanese' => 'くろ', 'hiragana' => 'くろ', 'romaji' => 'kuro', 'vietnamese' => 'màu đen', 'example_sentence' => '黒い車 (kuroi kuruma) - xe đen', 'example_translation' => 'xe đen', 'difficulty_level' => 1],
            ['japanese' => 'ピンク', 'hiragana' => 'ピンク', 'romaji' => 'pinku', 'vietnamese' => 'màu hồng', 'example_sentence' => 'ピンクの花 (pinku no hana) - bông hoa hồng', 'example_translation' => 'bông hoa hồng', 'difficulty_level' => 1],
            ['japanese' => 'オレンジ', 'hiragana' => 'オレンジ', 'romaji' => 'orenji', 'vietnamese' => 'màu cam', 'example_sentence' => 'オレンジの果物 (orenji no kudamono) - trái cây cam', 'example_translation' => 'trái cây cam', 'difficulty_level' => 1],
            ['japanese' => 'むらさき', 'hiragana' => 'むらさき', 'romaji' => 'murasaki', 'vietnamese' => 'màu tím', 'example_sentence' => '紫の花 (murasaki no hana) - bông hoa tím', 'example_translation' => 'bông hoa tím', 'difficulty_level' => 1],
            ['japanese' => 'ちゃいろ', 'hiragana' => 'ちゃいろ', 'romaji' => 'chairo', 'vietnamese' => 'màu nâu', 'example_sentence' => '茶色の目 (chairo no me) - mắt nâu', 'example_translation' => 'mắt nâu', 'difficulty_level' => 1],
        ];

        foreach ($colorVocab as $vocab) {
            Vocabulary::create(array_merge($vocab, ['lesson_id' => $lesson7->id]));
        }

        $this->command->info('Đã thêm ' . Vocabulary::count() . ' từ vựng vào cơ sở dữ liệu.');
    }
}

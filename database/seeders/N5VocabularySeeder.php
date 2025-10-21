<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Vocabulary;
use Illuminate\Support\Facades\DB;

class N5VocabularySeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing N5 vocabulary
        Vocabulary::whereHas('lesson', function($query) {
            $query->where('level', 1);
        })->delete();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $n5Lessons = Lesson::where('level', 1)->orderBy('order')->get();

        foreach ($n5Lessons as $lesson) {
            $this->createVocabularyForLesson($lesson);
        }

        $this->command->info('Đã tạo từ vựng cho ' . $n5Lessons->count() . ' bài học N5');
    }

    private function createVocabularyForLesson($lesson)
    {
        $vocabularies = [];

        switch ($lesson->order) {
            case 1: // Nguyên âm
                $vocabularies = [
                    ['japanese' => 'あ', 'hiragana' => 'あ', 'vietnamese' => 'a', 'topic' => 'Hiragana'],
                    ['japanese' => 'い', 'hiragana' => 'い', 'vietnamese' => 'i', 'topic' => 'Hiragana'],
                    ['japanese' => 'う', 'hiragana' => 'う', 'vietnamese' => 'u', 'topic' => 'Hiragana'],
                    ['japanese' => 'え', 'hiragana' => 'え', 'vietnamese' => 'e', 'topic' => 'Hiragana'],
                    ['japanese' => 'お', 'hiragana' => 'お', 'vietnamese' => 'o', 'topic' => 'Hiragana']
                ];
                break;

            case 2: // Hàng K
                $vocabularies = [
                    ['japanese' => 'か', 'hiragana' => 'か', 'vietnamese' => 'ka', 'topic' => 'Hiragana'],
                    ['japanese' => 'き', 'hiragana' => 'き', 'vietnamese' => 'ki', 'topic' => 'Hiragana'],
                    ['japanese' => 'く', 'hiragana' => 'く', 'vietnamese' => 'ku', 'topic' => 'Hiragana'],
                    ['japanese' => 'け', 'hiragana' => 'け', 'vietnamese' => 'ke', 'topic' => 'Hiragana'],
                    ['japanese' => 'こ', 'hiragana' => 'こ', 'vietnamese' => 'ko', 'topic' => 'Hiragana']
                ];
                break;

            case 3: // Hàng S
                $vocabularies = [
                    ['japanese' => 'さ', 'hiragana' => 'さ', 'vietnamese' => 'sa', 'topic' => 'Hiragana'],
                    ['japanese' => 'し', 'hiragana' => 'し', 'vietnamese' => 'shi', 'topic' => 'Hiragana'],
                    ['japanese' => 'す', 'hiragana' => 'す', 'vietnamese' => 'su', 'topic' => 'Hiragana'],
                    ['japanese' => 'せ', 'hiragana' => 'せ', 'vietnamese' => 'se', 'topic' => 'Hiragana'],
                    ['japanese' => 'そ', 'hiragana' => 'そ', 'vietnamese' => 'so', 'topic' => 'Hiragana']
                ];
                break;

            case 4: // Hàng T
                $vocabularies = [
                    ['japanese' => 'た', 'hiragana' => 'た', 'vietnamese' => 'ta', 'topic' => 'Hiragana'],
                    ['japanese' => 'ち', 'hiragana' => 'ち', 'vietnamese' => 'chi', 'topic' => 'Hiragana'],
                    ['japanese' => 'つ', 'hiragana' => 'つ', 'vietnamese' => 'tsu', 'topic' => 'Hiragana'],
                    ['japanese' => 'て', 'hiragana' => 'て', 'vietnamese' => 'te', 'topic' => 'Hiragana'],
                    ['japanese' => 'と', 'hiragana' => 'と', 'vietnamese' => 'to', 'topic' => 'Hiragana']
                ];
                break;

            case 5: // Hàng N
                $vocabularies = [
                    ['japanese' => 'な', 'hiragana' => 'な', 'vietnamese' => 'na', 'topic' => 'Hiragana'],
                    ['japanese' => 'に', 'hiragana' => 'に', 'vietnamese' => 'ni', 'topic' => 'Hiragana'],
                    ['japanese' => 'ぬ', 'hiragana' => 'ぬ', 'vietnamese' => 'nu', 'topic' => 'Hiragana'],
                    ['japanese' => 'ね', 'hiragana' => 'ね', 'vietnamese' => 'ne', 'topic' => 'Hiragana'],
                    ['japanese' => 'の', 'hiragana' => 'の', 'vietnamese' => 'no', 'topic' => 'Hiragana']
                ];
                break;

            case 6: // Hàng H
                $vocabularies = [
                    ['japanese' => 'は', 'hiragana' => 'は', 'vietnamese' => 'ha', 'topic' => 'Hiragana'],
                    ['japanese' => 'ひ', 'hiragana' => 'ひ', 'vietnamese' => 'hi', 'topic' => 'Hiragana'],
                    ['japanese' => 'ふ', 'hiragana' => 'ふ', 'vietnamese' => 'fu', 'topic' => 'Hiragana'],
                    ['japanese' => 'へ', 'hiragana' => 'へ', 'vietnamese' => 'he', 'topic' => 'Hiragana'],
                    ['japanese' => 'ほ', 'hiragana' => 'ほ', 'vietnamese' => 'ho', 'topic' => 'Hiragana']
                ];
                break;

            case 7: // Hàng M
                $vocabularies = [
                    ['japanese' => 'ま', 'hiragana' => 'ま', 'vietnamese' => 'ma', 'topic' => 'Hiragana'],
                    ['japanese' => 'み', 'hiragana' => 'み', 'vietnamese' => 'mi', 'topic' => 'Hiragana'],
                    ['japanese' => 'む', 'hiragana' => 'む', 'vietnamese' => 'mu', 'topic' => 'Hiragana'],
                    ['japanese' => 'め', 'hiragana' => 'め', 'vietnamese' => 'me', 'topic' => 'Hiragana'],
                    ['japanese' => 'も', 'hiragana' => 'も', 'vietnamese' => 'mo', 'topic' => 'Hiragana']
                ];
                break;

            case 8: // Hàng Y
                $vocabularies = [
                    ['japanese' => 'や', 'hiragana' => 'や', 'vietnamese' => 'ya', 'topic' => 'Hiragana'],
                    ['japanese' => 'ゆ', 'hiragana' => 'ゆ', 'vietnamese' => 'yu', 'topic' => 'Hiragana'],
                    ['japanese' => 'よ', 'hiragana' => 'よ', 'vietnamese' => 'yo', 'topic' => 'Hiragana']
                ];
                break;

            case 9: // Hàng R
                $vocabularies = [
                    ['japanese' => 'ら', 'hiragana' => 'ら', 'vietnamese' => 'ra', 'topic' => 'Hiragana'],
                    ['japanese' => 'り', 'hiragana' => 'り', 'vietnamese' => 'ri', 'topic' => 'Hiragana'],
                    ['japanese' => 'る', 'hiragana' => 'る', 'vietnamese' => 'ru', 'topic' => 'Hiragana'],
                    ['japanese' => 'れ', 'hiragana' => 'れ', 'vietnamese' => 're', 'topic' => 'Hiragana'],
                    ['japanese' => 'ろ', 'hiragana' => 'ろ', 'vietnamese' => 'ro', 'topic' => 'Hiragana']
                ];
                break;

            case 10: // Hàng W
                $vocabularies = [
                    ['japanese' => 'わ', 'hiragana' => 'わ', 'vietnamese' => 'wa', 'topic' => 'Hiragana'],
                    ['japanese' => 'を', 'hiragana' => 'を', 'vietnamese' => 'wo', 'topic' => 'Hiragana'],
                    ['japanese' => 'ん', 'hiragana' => 'ん', 'vietnamese' => 'n', 'topic' => 'Hiragana']
                ];
                break;

            case 11: // Số đếm 1-10
                $vocabularies = [
                    ['japanese' => '一', 'hiragana' => 'いち', 'vietnamese' => 'một', 'topic' => 'Số đếm'],
                    ['japanese' => '二', 'hiragana' => 'に', 'vietnamese' => 'hai', 'topic' => 'Số đếm'],
                    ['japanese' => '三', 'hiragana' => 'さん', 'vietnamese' => 'ba', 'topic' => 'Số đếm'],
                    ['japanese' => '四', 'hiragana' => 'よん', 'vietnamese' => 'bốn', 'topic' => 'Số đếm'],
                    ['japanese' => '五', 'hiragana' => 'ご', 'vietnamese' => 'năm', 'topic' => 'Số đếm'],
                    ['japanese' => '六', 'hiragana' => 'ろく', 'vietnamese' => 'sáu', 'topic' => 'Số đếm'],
                    ['japanese' => '七', 'hiragana' => 'なな', 'vietnamese' => 'bảy', 'topic' => 'Số đếm'],
                    ['japanese' => '八', 'hiragana' => 'はち', 'vietnamese' => 'tám', 'topic' => 'Số đếm'],
                    ['japanese' => '九', 'hiragana' => 'きゅう', 'vietnamese' => 'chín', 'topic' => 'Số đếm'],
                    ['japanese' => '十', 'hiragana' => 'じゅう', 'vietnamese' => 'mười', 'topic' => 'Số đếm']
                ];
                break;

            case 12: // Số đếm 11-100
                $vocabularies = [
                    ['japanese' => '十一', 'hiragana' => 'じゅういち', 'vietnamese' => 'mười một', 'topic' => 'Số đếm'],
                    ['japanese' => '二十', 'hiragana' => 'にじゅう', 'vietnamese' => 'hai mươi', 'topic' => 'Số đếm'],
                    ['japanese' => '三十', 'hiragana' => 'さんじゅう', 'vietnamese' => 'ba mươi', 'topic' => 'Số đếm'],
                    ['japanese' => '四十', 'hiragana' => 'よんじゅう', 'vietnamese' => 'bốn mươi', 'topic' => 'Số đếm'],
                    ['japanese' => '五十', 'hiragana' => 'ごじゅう', 'vietnamese' => 'năm mươi', 'topic' => 'Số đếm'],
                    ['japanese' => '百', 'hiragana' => 'ひゃく', 'vietnamese' => 'một trăm', 'topic' => 'Số đếm']
                ];
                break;

            case 13: // Thời gian
                $vocabularies = [
                    ['japanese' => '今', 'hiragana' => 'いま', 'vietnamese' => 'bây giờ', 'topic' => 'Thời gian'],
                    ['japanese' => '時', 'hiragana' => 'じ', 'vietnamese' => 'giờ', 'topic' => 'Thời gian'],
                    ['japanese' => '分', 'hiragana' => 'ふん', 'vietnamese' => 'phút', 'topic' => 'Thời gian'],
                    ['japanese' => '午前', 'hiragana' => 'ごぜん', 'vietnamese' => 'sáng', 'topic' => 'Thời gian'],
                    ['japanese' => '午後', 'hiragana' => 'ごご', 'vietnamese' => 'chiều', 'topic' => 'Thời gian']
                ];
                break;

            case 14: // Ngày trong tuần
                $vocabularies = [
                    ['japanese' => '月曜日', 'hiragana' => 'げつようび', 'vietnamese' => 'thứ hai', 'topic' => 'Ngày trong tuần'],
                    ['japanese' => '火曜日', 'hiragana' => 'かようび', 'vietnamese' => 'thứ ba', 'topic' => 'Ngày trong tuần'],
                    ['japanese' => '水曜日', 'hiragana' => 'すいようび', 'vietnamese' => 'thứ tư', 'topic' => 'Ngày trong tuần'],
                    ['japanese' => '木曜日', 'hiragana' => 'もくようび', 'vietnamese' => 'thứ năm', 'topic' => 'Ngày trong tuần'],
                    ['japanese' => '金曜日', 'hiragana' => 'きんようび', 'vietnamese' => 'thứ sáu', 'topic' => 'Ngày trong tuần'],
                    ['japanese' => '土曜日', 'hiragana' => 'どようび', 'vietnamese' => 'thứ bảy', 'topic' => 'Ngày trong tuần'],
                    ['japanese' => '日曜日', 'hiragana' => 'にちようび', 'vietnamese' => 'chủ nhật', 'topic' => 'Ngày trong tuần']
                ];
                break;

            case 15: // Tháng trong năm
                $vocabularies = [
                    ['japanese' => '一月', 'hiragana' => 'いちがつ', 'vietnamese' => 'tháng một', 'topic' => 'Tháng'],
                    ['japanese' => '二月', 'hiragana' => 'にがつ', 'vietnamese' => 'tháng hai', 'topic' => 'Tháng'],
                    ['japanese' => '三月', 'hiragana' => 'さんがつ', 'vietnamese' => 'tháng ba', 'topic' => 'Tháng'],
                    ['japanese' => '四月', 'hiragana' => 'しがつ', 'vietnamese' => 'tháng tư', 'topic' => 'Tháng'],
                    ['japanese' => '五月', 'hiragana' => 'ごがつ', 'vietnamese' => 'tháng năm', 'topic' => 'Tháng'],
                    ['japanese' => '六月', 'hiragana' => 'ろくがつ', 'vietnamese' => 'tháng sáu', 'topic' => 'Tháng']
                ];
                break;

            case 16: // Gia đình
                $vocabularies = [
                    ['japanese' => '父', 'hiragana' => 'おとうさん', 'vietnamese' => 'bố', 'topic' => 'Gia đình'],
                    ['japanese' => '母', 'hiragana' => 'おかあさん', 'vietnamese' => 'mẹ', 'topic' => 'Gia đình'],
                    ['japanese' => '兄', 'hiragana' => 'おにいさん', 'vietnamese' => 'anh trai', 'topic' => 'Gia đình'],
                    ['japanese' => '姉', 'hiragana' => 'おねえさん', 'vietnamese' => 'chị gái', 'topic' => 'Gia đình'],
                    ['japanese' => '弟', 'hiragana' => 'おとうと', 'vietnamese' => 'em trai', 'topic' => 'Gia đình'],
                    ['japanese' => '妹', 'hiragana' => 'いもうと', 'vietnamese' => 'em gái', 'topic' => 'Gia đình']
                ];
                break;

            case 17: // Màu sắc
                $vocabularies = [
                    ['japanese' => '赤', 'hiragana' => 'あか', 'vietnamese' => 'đỏ', 'topic' => 'Màu sắc'],
                    ['japanese' => '青', 'hiragana' => 'あお', 'vietnamese' => 'xanh', 'topic' => 'Màu sắc'],
                    ['japanese' => '黄色', 'hiragana' => 'きいろ', 'vietnamese' => 'vàng', 'topic' => 'Màu sắc'],
                    ['japanese' => '黒', 'hiragana' => 'くろ', 'vietnamese' => 'đen', 'topic' => 'Màu sắc'],
                    ['japanese' => '白', 'hiragana' => 'しろ', 'vietnamese' => 'trắng', 'topic' => 'Màu sắc'],
                    ['japanese' => '緑', 'hiragana' => 'みどり', 'vietnamese' => 'xanh lá', 'topic' => 'Màu sắc']
                ];
                break;

            case 18: // Đồ ăn
                $vocabularies = [
                    ['japanese' => 'ご飯', 'hiragana' => 'ごはん', 'vietnamese' => 'cơm', 'topic' => 'Đồ ăn'],
                    ['japanese' => '水', 'hiragana' => 'みず', 'vietnamese' => 'nước', 'topic' => 'Đồ ăn'],
                    ['japanese' => 'パン', 'hiragana' => 'パン', 'vietnamese' => 'bánh mì', 'topic' => 'Đồ ăn'],
                    ['japanese' => 'りんご', 'hiragana' => 'りんご', 'vietnamese' => 'táo', 'topic' => 'Đồ ăn'],
                    ['japanese' => 'バナナ', 'hiragana' => 'バナナ', 'vietnamese' => 'chuối', 'topic' => 'Đồ ăn'],
                    ['japanese' => '牛乳', 'hiragana' => 'ぎゅうにゅう', 'vietnamese' => 'sữa', 'topic' => 'Đồ ăn']
                ];
                break;

            case 19: // Động vật
                $vocabularies = [
                    ['japanese' => '犬', 'hiragana' => 'いぬ', 'vietnamese' => 'chó', 'topic' => 'Động vật'],
                    ['japanese' => '猫', 'hiragana' => 'ねこ', 'vietnamese' => 'mèo', 'topic' => 'Động vật'],
                    ['japanese' => '鳥', 'hiragana' => 'とり', 'vietnamese' => 'chim', 'topic' => 'Động vật'],
                    ['japanese' => '馬', 'hiragana' => 'うま', 'vietnamese' => 'ngựa', 'topic' => 'Động vật'],
                    ['japanese' => '牛', 'hiragana' => 'うし', 'vietnamese' => 'bò', 'topic' => 'Động vật'],
                    ['japanese' => '魚', 'hiragana' => 'さかな', 'vietnamese' => 'cá', 'topic' => 'Động vật']
                ];
                break;

            case 20: // Nghề nghiệp
                $vocabularies = [
                    ['japanese' => '先生', 'hiragana' => 'せんせい', 'vietnamese' => 'giáo viên', 'topic' => 'Nghề nghiệp'],
                    ['japanese' => '医者', 'hiragana' => 'いしゃ', 'vietnamese' => 'bác sĩ', 'topic' => 'Nghề nghiệp'],
                    ['japanese' => 'エンジニア', 'hiragana' => 'エンジニア', 'vietnamese' => 'kỹ sư', 'topic' => 'Nghề nghiệp'],
                    ['japanese' => '学生', 'hiragana' => 'がくせい', 'vietnamese' => 'học sinh', 'topic' => 'Nghề nghiệp'],
                    ['japanese' => '会社員', 'hiragana' => 'かいしゃいん', 'vietnamese' => 'nhân viên công ty', 'topic' => 'Nghề nghiệp'],
                    ['japanese' => '看護師', 'hiragana' => 'かんごし', 'vietnamese' => 'y tá', 'topic' => 'Nghề nghiệp']
                ];
                break;

            case 21: // Đại từ nhân xưng
                $vocabularies = [
                    ['japanese' => '私', 'hiragana' => 'わたし', 'vietnamese' => 'tôi', 'topic' => 'Đại từ'],
                    ['japanese' => 'あなた', 'hiragana' => 'あなた', 'vietnamese' => 'bạn', 'topic' => 'Đại từ'],
                    ['japanese' => '彼', 'hiragana' => 'かれ', 'vietnamese' => 'anh ấy', 'topic' => 'Đại từ'],
                    ['japanese' => '彼女', 'hiragana' => 'かのじょ', 'vietnamese' => 'cô ấy', 'topic' => 'Đại từ'],
                    ['japanese' => '私たち', 'hiragana' => 'わたしたち', 'vietnamese' => 'chúng tôi', 'topic' => 'Đại từ'],
                    ['japanese' => 'あなたたち', 'hiragana' => 'あなたたち', 'vietnamese' => 'các bạn', 'topic' => 'Đại từ']
                ];
                break;

            case 22: // Động từ です/だ
                $vocabularies = [
                    ['japanese' => 'です', 'hiragana' => 'です', 'vietnamese' => 'là (lịch sự)', 'topic' => 'Động từ'],
                    ['japanese' => 'だ', 'hiragana' => 'だ', 'vietnamese' => 'là (thân mật)', 'topic' => 'Động từ'],
                    ['japanese' => 'ではありません', 'hiragana' => 'ではありません', 'vietnamese' => 'không phải là', 'topic' => 'Động từ'],
                    ['japanese' => 'じゃない', 'hiragana' => 'じゃない', 'vietnamese' => 'không phải là (thân mật)', 'topic' => 'Động từ']
                ];
                break;

            case 23: // Câu hỏi
                $vocabularies = [
                    ['japanese' => '何', 'hiragana' => 'なん', 'vietnamese' => 'cái gì', 'topic' => 'Câu hỏi'],
                    ['japanese' => '誰', 'hiragana' => 'だれ', 'vietnamese' => 'ai', 'topic' => 'Câu hỏi'],
                    ['japanese' => 'どこ', 'hiragana' => 'どこ', 'vietnamese' => 'ở đâu', 'topic' => 'Câu hỏi'],
                    ['japanese' => 'いつ', 'hiragana' => 'いつ', 'vietnamese' => 'khi nào', 'topic' => 'Câu hỏi'],
                    ['japanese' => 'どう', 'hiragana' => 'どう', 'vietnamese' => 'như thế nào', 'topic' => 'Câu hỏi'],
                    ['japanese' => 'なぜ', 'hiragana' => 'なぜ', 'vietnamese' => 'tại sao', 'topic' => 'Câu hỏi']
                ];
                break;

            case 24: // Tính từ
                $vocabularies = [
                    ['japanese' => '大きい', 'hiragana' => 'おおきい', 'vietnamese' => 'to', 'topic' => 'Tính từ'],
                    ['japanese' => '小さい', 'hiragana' => 'ちいさい', 'vietnamese' => 'nhỏ', 'topic' => 'Tính từ'],
                    ['japanese' => '高い', 'hiragana' => 'たかい', 'vietnamese' => 'cao/đắt', 'topic' => 'Tính từ'],
                    ['japanese' => '安い', 'hiragana' => 'やすい', 'vietnamese' => 'rẻ', 'topic' => 'Tính từ'],
                    ['japanese' => '新しい', 'hiragana' => 'あたらしい', 'vietnamese' => 'mới', 'topic' => 'Tính từ'],
                    ['japanese' => '古い', 'hiragana' => 'ふるい', 'vietnamese' => 'cũ', 'topic' => 'Tính từ']
                ];
                break;

            case 25: // Ôn tập
                $vocabularies = [
                    ['japanese' => '復習', 'hiragana' => 'ふくしゅう', 'vietnamese' => 'ôn tập', 'topic' => 'Ôn tập'],
                    ['japanese' => '練習', 'hiragana' => 'れんしゅう', 'vietnamese' => 'luyện tập', 'topic' => 'Ôn tập'],
                    ['japanese' => '勉強', 'hiragana' => 'べんきょう', 'vietnamese' => 'học tập', 'topic' => 'Ôn tập']
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
                'romaji' => $vocab['hiragana'], // Sử dụng hiragana làm romaji
                'vietnamese' => $vocab['vietnamese'],
                'topic' => $vocab['topic'],
                'is_active' => true
            ]);
        }
    }
}
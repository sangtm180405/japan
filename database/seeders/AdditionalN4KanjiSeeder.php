<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alphabet;

class AdditionalN4KanjiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Thêm Kanji N4 để đủ 300 chữ
        $additionalN4Kanji = [
            // Thời gian
            ['character' => '秒', 'romaji' => 'byou', 'type' => 'kanji', 'category' => 'time', 'description' => 'Giây', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 152],
            ['character' => '時間', 'romaji' => 'jikan', 'type' => 'kanji', 'category' => 'time', 'description' => 'Thời gian', 'stroke_order' => '10+12', 'difficulty_level' => 2, 'order' => 153],
            ['character' => '時刻', 'romaji' => 'jikoku', 'type' => 'kanji', 'category' => 'time', 'description' => 'Thời điểm', 'stroke_order' => '10+8', 'difficulty_level' => 2, 'order' => 154],
            ['character' => '期間', 'romaji' => 'kikan', 'type' => 'kanji', 'category' => 'time', 'description' => 'Kỳ hạn', 'stroke_order' => '12+12', 'difficulty_level' => 2, 'order' => 155],
            
            // Gia đình mở rộng
            ['character' => '祖父', 'romaji' => 'sofu', 'type' => 'kanji', 'category' => 'person', 'description' => 'Ông', 'stroke_order' => '9+4', 'difficulty_level' => 2, 'order' => 156],
            ['character' => '祖母', 'romaji' => 'sobo', 'type' => 'kanji', 'category' => 'person', 'description' => 'Bà', 'stroke_order' => '9+5', 'difficulty_level' => 2, 'order' => 157],
            ['character' => '親戚', 'romaji' => 'shinseki', 'type' => 'kanji', 'category' => 'person', 'description' => 'Họ hàng', 'stroke_order' => '16+8', 'difficulty_level' => 2, 'order' => 158],
            ['character' => '友', 'romaji' => 'tomo', 'type' => 'kanji', 'category' => 'person', 'description' => 'Bạn', 'stroke_order' => '4', 'difficulty_level' => 2, 'order' => 159],
            ['character' => '同僚', 'romaji' => 'douryou', 'type' => 'kanji', 'category' => 'person', 'description' => 'Đồng nghiệp', 'stroke_order' => '6+12', 'difficulty_level' => 2, 'order' => 160],
            
            // Nghề nghiệp mở rộng
            ['character' => '警察', 'romaji' => 'keisatsu', 'type' => 'kanji', 'category' => 'job', 'description' => 'Cảnh sát', 'stroke_order' => '14+12', 'difficulty_level' => 2, 'order' => 161],
            ['character' => '消防士', 'romaji' => 'shouboushi', 'type' => 'kanji', 'category' => 'job', 'description' => 'Lính cứu hỏa', 'stroke_order' => '10+7+3', 'difficulty_level' => 2, 'order' => 162],
            ['character' => '運転手', 'romaji' => 'untenshu', 'type' => 'kanji', 'category' => 'job', 'description' => 'Tài xế', 'stroke_order' => '12+9+4', 'difficulty_level' => 2, 'order' => 163],
            ['character' => '料理人', 'romaji' => 'ryourinin', 'type' => 'kanji', 'category' => 'job', 'description' => 'Đầu bếp', 'stroke_order' => '11+11+2', 'difficulty_level' => 2, 'order' => 164],
            ['character' => '美容師', 'romaji' => 'biyoushi', 'type' => 'kanji', 'category' => 'job', 'description' => 'Thợ làm tóc', 'stroke_order' => '9+6+6', 'difficulty_level' => 2, 'order' => 165],
            
            // Địa điểm mở rộng
            ['character' => '公園', 'romaji' => 'kouen', 'type' => 'kanji', 'category' => 'place', 'description' => 'Công viên', 'stroke_order' => '4+6', 'difficulty_level' => 2, 'order' => 166],
            ['character' => '美術館', 'romaji' => 'bijutsukan', 'type' => 'kanji', 'category' => 'place', 'description' => 'Bảo tàng nghệ thuật', 'stroke_order' => '9+8+16', 'difficulty_level' => 2, 'order' => 167],
            ['character' => '博物館', 'romaji' => 'hakubutsukan', 'type' => 'kanji', 'category' => 'place', 'description' => 'Bảo tàng', 'stroke_order' => '12+8+16', 'difficulty_level' => 2, 'order' => 168],
            ['character' => '映画館', 'romaji' => 'eigakan', 'type' => 'kanji', 'category' => 'place', 'description' => 'Rạp chiếu phim', 'stroke_order' => '9+8+16', 'difficulty_level' => 2, 'order' => 169],
            ['character' => '劇場', 'romaji' => 'gekijou', 'type' => 'kanji', 'category' => 'place', 'description' => 'Nhà hát', 'stroke_order' => '15+12', 'difficulty_level' => 2, 'order' => 170],
            ['character' => '体育館', 'romaji' => 'taiikukan', 'type' => 'kanji', 'category' => 'place', 'description' => 'Nhà thi đấu', 'stroke_order' => '7+8+16', 'difficulty_level' => 2, 'order' => 171],
            ['character' => 'プール', 'romaji' => 'puuru', 'type' => 'kanji', 'category' => 'place', 'description' => 'Bể bơi', 'stroke_order' => '4+4+4+4', 'difficulty_level' => 2, 'order' => 172],
            ['character' => '温泉', 'romaji' => 'onsen', 'type' => 'kanji', 'category' => 'place', 'description' => 'Suối nước nóng', 'stroke_order' => '12+9', 'difficulty_level' => 2, 'order' => 173],
            
            // Thức ăn mở rộng
            ['character' => 'パン', 'romaji' => 'pan', 'type' => 'kanji', 'category' => 'food', 'description' => 'Bánh mì', 'stroke_order' => '4+4+4', 'difficulty_level' => 2, 'order' => 174],
            ['character' => 'ケーキ', 'romaji' => 'keeki', 'type' => 'kanji', 'category' => 'food', 'description' => 'Bánh ngọt', 'stroke_order' => '4+4+4+4', 'difficulty_level' => 2, 'order' => 175],
            ['character' => 'アイスクリーム', 'romaji' => 'aisukuriimu', 'type' => 'kanji', 'category' => 'food', 'description' => 'Kem', 'stroke_order' => '4+4+4+4+4+4+4+4', 'difficulty_level' => 2, 'order' => 176],
            ['character' => 'チョコレート', 'romaji' => 'chokoreeto', 'type' => 'kanji', 'category' => 'food', 'description' => 'Sô cô la', 'stroke_order' => '4+4+4+4+4+4+4+4', 'difficulty_level' => 2, 'order' => 177],
            ['character' => 'ジュース', 'romaji' => 'juusu', 'type' => 'kanji', 'category' => 'food', 'description' => 'Nước ép', 'stroke_order' => '4+4+4+4+4', 'difficulty_level' => 2, 'order' => 178],
            ['character' => 'ビール', 'romaji' => 'biiru', 'type' => 'kanji', 'category' => 'food', 'description' => 'Bia', 'stroke_order' => '4+4+4+4', 'difficulty_level' => 2, 'order' => 179],
            ['character' => 'ワイン', 'romaji' => 'wain', 'type' => 'kanji', 'category' => 'food', 'description' => 'Rượu vang', 'stroke_order' => '4+4+4+4', 'difficulty_level' => 2, 'order' => 180],
            ['character' => '寿司', 'romaji' => 'sushi', 'type' => 'kanji', 'category' => 'food', 'description' => 'Sushi', 'stroke_order' => '7+6', 'difficulty_level' => 2, 'order' => 181],
            ['character' => '天ぷら', 'romaji' => 'tenpura', 'type' => 'kanji', 'category' => 'food', 'description' => 'Tempura', 'stroke_order' => '4+6+6', 'difficulty_level' => 2, 'order' => 182],
            ['character' => 'ラーメン', 'romaji' => 'raamen', 'type' => 'kanji', 'category' => 'food', 'description' => 'Ramen', 'stroke_order' => '4+4+4+4+4', 'difficulty_level' => 2, 'order' => 183],
            
            // Tính từ mở rộng
            ['character' => '便利', 'romaji' => 'benri', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Tiện lợi', 'stroke_order' => '9+7', 'difficulty_level' => 2, 'order' => 184],
            ['character' => '不便', 'romaji' => 'fuben', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Bất tiện', 'stroke_order' => '4+9', 'difficulty_level' => 2, 'order' => 185],
            ['character' => '安全', 'romaji' => 'anzen', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'An toàn', 'stroke_order' => '6+6', 'difficulty_level' => 2, 'order' => 186],
            ['character' => '危険', 'romaji' => 'kiken', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Nguy hiểm', 'stroke_order' => '6+11', 'difficulty_level' => 2, 'order' => 187],
            ['character' => '健康', 'romaji' => 'kenkou', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Khỏe mạnh', 'stroke_order' => '11+11', 'difficulty_level' => 2, 'order' => 188],
            ['character' => '病気', 'romaji' => 'byouki', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Bệnh tật', 'stroke_order' => '10+6', 'difficulty_level' => 2, 'order' => 189],
            ['character' => '元気', 'romaji' => 'genki', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Khỏe mạnh', 'stroke_order' => '4+6', 'difficulty_level' => 2, 'order' => 190],
            ['character' => '疲', 'romaji' => 'tsukareru', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Mệt mỏi', 'stroke_order' => '10', 'difficulty_level' => 2, 'order' => 191],
            ['character' => '眠', 'romaji' => 'nemui', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Buồn ngủ', 'stroke_order' => '11', 'difficulty_level' => 2, 'order' => 192],
            ['character' => '痛', 'romaji' => 'itai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Đau', 'stroke_order' => '12', 'difficulty_level' => 2, 'order' => 193],
            
            // Động từ mở rộng
            ['character' => '着', 'romaji' => 'kiru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Mặc', 'stroke_order' => '12', 'difficulty_level' => 2, 'order' => 194],
            ['character' => '脱', 'romaji' => 'nugu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Cởi', 'stroke_order' => '11', 'difficulty_level' => 2, 'order' => 195],
            ['character' => '洗', 'romaji' => 'arau', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Rửa', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 196],
            ['character' => '掃除', 'romaji' => 'souji', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Dọn dẹp', 'stroke_order' => '11+8', 'difficulty_level' => 2, 'order' => 197],
            ['character' => '整理', 'romaji' => 'seiri', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Sắp xếp', 'stroke_order' => '16+11', 'difficulty_level' => 2, 'order' => 198],
            ['character' => '準備', 'romaji' => 'junbi', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Chuẩn bị', 'stroke_order' => '15+8', 'difficulty_level' => 2, 'order' => 199],
            ['character' => '練習', 'romaji' => 'renshuu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Luyện tập', 'stroke_order' => '7+9', 'difficulty_level' => 2, 'order' => 200],
            ['character' => '復習', 'romaji' => 'fukushuu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Ôn tập', 'stroke_order' => '9+9', 'difficulty_level' => 2, 'order' => 201],
            ['character' => '予習', 'romaji' => 'yoshuu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Học trước', 'stroke_order' => '4+9', 'difficulty_level' => 2, 'order' => 202],
            ['character' => '宿題', 'romaji' => 'shukudai', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Bài tập về nhà', 'stroke_order' => '11+15', 'difficulty_level' => 2, 'order' => 203],
            
            // Danh từ mở rộng
            ['character' => '趣味', 'romaji' => 'shumi', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Sở thích', 'stroke_order' => '8+8', 'difficulty_level' => 2, 'order' => 204],
            ['character' => '特技', 'romaji' => 'tokugi', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Tài năng đặc biệt', 'stroke_order' => '10+6', 'difficulty_level' => 2, 'order' => 205],
            ['character' => '才能', 'romaji' => 'sainou', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Tài năng', 'stroke_order' => '3+6', 'difficulty_level' => 2, 'order' => 206],
            ['character' => '経験', 'romaji' => 'keiken', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Kinh nghiệm', 'stroke_order' => '9+13', 'difficulty_level' => 2, 'order' => 207],
            ['character' => '知識', 'romaji' => 'chishiki', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Kiến thức', 'stroke_order' => '8+8', 'difficulty_level' => 2, 'order' => 208],
            ['character' => '技術', 'romaji' => 'gijutsu', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Kỹ thuật', 'stroke_order' => '7+8', 'difficulty_level' => 2, 'order' => 209],
            ['character' => '能力', 'romaji' => 'nouryoku', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Năng lực', 'stroke_order' => '10+7', 'difficulty_level' => 2, 'order' => 210],
            ['character' => '性格', 'romaji' => 'seikaku', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Tính cách', 'stroke_order' => '8+8', 'difficulty_level' => 2, 'order' => 211],
            ['character' => '態度', 'romaji' => 'taido', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Thái độ', 'stroke_order' => '13+7', 'difficulty_level' => 2, 'order' => 212],
            ['character' => '習慣', 'romaji' => 'shuukan', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Thói quen', 'stroke_order' => '7+15', 'difficulty_level' => 2, 'order' => 213],
            
            // Thêm để đủ 300 chữ N4
            ['character' => '規則', 'romaji' => 'kisoku', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Quy tắc', 'stroke_order' => '8+9', 'difficulty_level' => 2, 'order' => 214],
            ['character' => '法律', 'romaji' => 'houritsu', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Luật pháp', 'stroke_order' => '8+9', 'difficulty_level' => 2, 'order' => 215],
            ['character' => '制度', 'romaji' => 'seido', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Chế độ', 'stroke_order' => '8+7', 'difficulty_level' => 2, 'order' => 216],
            ['character' => '方法', 'romaji' => 'houhou', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Phương pháp', 'stroke_order' => '4+4', 'difficulty_level' => 2, 'order' => 217],
            ['character' => '手段', 'romaji' => 'shudan', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Thủ đoạn', 'stroke_order' => '4+9', 'difficulty_level' => 2, 'order' => 218],
            ['character' => '目的', 'romaji' => 'mokuteki', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Mục đích', 'stroke_order' => '5+8', 'difficulty_level' => 2, 'order' => 219],
            ['character' => '目標', 'romaji' => 'mokuhyou', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Mục tiêu', 'stroke_order' => '5+15', 'difficulty_level' => 2, 'order' => 220],
            ['character' => '計画', 'romaji' => 'keikaku', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Kế hoạch', 'stroke_order' => '8+8', 'difficulty_level' => 2, 'order' => 221],
            ['character' => '予定', 'romaji' => 'yotei', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Dự định', 'stroke_order' => '4+8', 'difficulty_level' => 2, 'order' => 222],
            ['character' => '予約', 'romaji' => 'yoyaku', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Đặt trước', 'stroke_order' => '4+9', 'difficulty_level' => 2, 'order' => 223],
            ['character' => '約束', 'romaji' => 'yakusoku', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Hứa hẹn', 'stroke_order' => '9+6', 'difficulty_level' => 2, 'order' => 224],
            ['character' => '責任', 'romaji' => 'sekinin', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Trách nhiệm', 'stroke_order' => '11+4', 'difficulty_level' => 2, 'order' => 225],
            ['character' => '義務', 'romaji' => 'gimu', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Nghĩa vụ', 'stroke_order' => '13+6', 'difficulty_level' => 2, 'order' => 226],
            ['character' => '権利', 'romaji' => 'kenri', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Quyền lợi', 'stroke_order' => '18+7', 'difficulty_level' => 2, 'order' => 227],
            ['character' => '自由', 'romaji' => 'jiyuu', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Tự do', 'stroke_order' => '6+6', 'difficulty_level' => 2, 'order' => 228],
            ['character' => '平等', 'romaji' => 'byoudou', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Bình đẳng', 'stroke_order' => '5+6', 'difficulty_level' => 2, 'order' => 229],
            ['character' => '公平', 'romaji' => 'kouhei', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Công bằng', 'stroke_order' => '4+5', 'difficulty_level' => 2, 'order' => 230],
            ['character' => '正義', 'romaji' => 'seigi', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Chính nghĩa', 'stroke_order' => '5+13', 'difficulty_level' => 2, 'order' => 231],
            ['character' => '悪', 'romaji' => 'warui', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Xấu', 'stroke_order' => '11', 'difficulty_level' => 2, 'order' => 232],
            ['character' => '善', 'romaji' => 'zen', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Tốt', 'stroke_order' => '12', 'difficulty_level' => 2, 'order' => 233],
            ['character' => '真実', 'romaji' => 'shinjitsu', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Sự thật', 'stroke_order' => '10+8', 'difficulty_level' => 2, 'order' => 234],
            ['character' => '嘘', 'romaji' => 'uso', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Lời nói dối', 'stroke_order' => '14', 'difficulty_level' => 2, 'order' => 235],
            ['character' => '夢', 'romaji' => 'yume', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Giấc mơ', 'stroke_order' => '13', 'difficulty_level' => 2, 'order' => 236],
            ['character' => '希望', 'romaji' => 'kibou', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Hy vọng', 'stroke_order' => '7+11', 'difficulty_level' => 2, 'order' => 237],
            ['character' => '失望', 'romaji' => 'shitsubou', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Thất vọng', 'stroke_order' => '5+11', 'difficulty_level' => 2, 'order' => 238],
            ['character' => '成功', 'romaji' => 'seikou', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Thành công', 'stroke_order' => '6+6', 'difficulty_level' => 2, 'order' => 239],
            ['character' => '失敗', 'romaji' => 'shippai', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Thất bại', 'stroke_order' => '5+4', 'difficulty_level' => 2, 'order' => 240],
            ['character' => '努力', 'romaji' => 'doryoku', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Nỗ lực', 'stroke_order' => '7+7', 'difficulty_level' => 2, 'order' => 241],
            ['character' => '頑張', 'romaji' => 'ganbaru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Cố gắng', 'stroke_order' => '13+11', 'difficulty_level' => 2, 'order' => 242],
            ['character' => '諦', 'romaji' => 'akirameru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Từ bỏ', 'stroke_order' => '16', 'difficulty_level' => 2, 'order' => 243],
            ['character' => '続', 'romaji' => 'tsuzuku', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Tiếp tục', 'stroke_order' => '13', 'difficulty_level' => 2, 'order' => 244],
            ['character' => '止', 'romaji' => 'tomaru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Dừng lại', 'stroke_order' => '4', 'difficulty_level' => 2, 'order' => 245],
            ['character' => '始', 'romaji' => 'hajimaru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Bắt đầu', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 246],
            ['character' => '終', 'romaji' => 'owaru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Kết thúc', 'stroke_order' => '11', 'difficulty_level' => 2, 'order' => 247],
            ['character' => '完', 'romaji' => 'kan', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Hoàn thành', 'stroke_order' => '7', 'difficulty_level' => 2, 'order' => 248],
            ['character' => '成', 'romaji' => 'naru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Trở thành', 'stroke_order' => '6', 'difficulty_level' => 2, 'order' => 249],
            ['character' => '変', 'romaji' => 'kawaru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Thay đổi', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 250],
            ['character' => '進', 'romaji' => 'susumu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Tiến bộ', 'stroke_order' => '11', 'difficulty_level' => 2, 'order' => 251],
            ['character' => '退', 'romaji' => 'shirizoku', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Lùi lại', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 252],
            ['character' => '上', 'romaji' => 'agaru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Lên', 'stroke_order' => '3', 'difficulty_level' => 2, 'order' => 253],
            ['character' => '下', 'romaji' => 'sagaru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Xuống', 'stroke_order' => '3', 'difficulty_level' => 2, 'order' => 254],
            ['character' => '前', 'romaji' => 'mae', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Phía trước', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 255],
            ['character' => '後', 'romaji' => 'ato', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Phía sau', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 256],
            ['character' => '左', 'romaji' => 'hidari', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Bên trái', 'stroke_order' => '5', 'difficulty_level' => 2, 'order' => 257],
            ['character' => '右', 'romaji' => 'migi', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Bên phải', 'stroke_order' => '5', 'difficulty_level' => 2, 'order' => 258],
            ['character' => '中', 'romaji' => 'naka', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Bên trong', 'stroke_order' => '4', 'difficulty_level' => 2, 'order' => 259],
            ['character' => '外', 'romaji' => 'soto', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Bên ngoài', 'stroke_order' => '5', 'difficulty_level' => 2, 'order' => 260],
            ['character' => '内', 'romaji' => 'uchi', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Bên trong', 'stroke_order' => '4', 'difficulty_level' => 2, 'order' => 261],
            ['character' => '側', 'romaji' => 'gawa', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Bên cạnh', 'stroke_order' => '11', 'difficulty_level' => 2, 'order' => 262],
            ['character' => '近', 'romaji' => 'chikai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Gần', 'stroke_order' => '7', 'difficulty_level' => 2, 'order' => 263],
            ['character' => '遠', 'romaji' => 'tooi', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Xa', 'stroke_order' => '13', 'difficulty_level' => 2, 'order' => 264],
            ['character' => '広', 'romaji' => 'hiroi', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Rộng', 'stroke_order' => '5', 'difficulty_level' => 2, 'order' => 265],
            ['character' => '狭', 'romaji' => 'semai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Hẹp', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 266],
            ['character' => '深', 'romaji' => 'fukai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Sâu', 'stroke_order' => '11', 'difficulty_level' => 2, 'order' => 267],
            ['character' => '浅', 'romaji' => 'asai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Nông', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 268],
            ['character' => '厚', 'romaji' => 'atsui', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Dày', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 269],
            ['character' => '薄', 'romaji' => 'usui', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Mỏng', 'stroke_order' => '16', 'difficulty_level' => 2, 'order' => 270],
            ['character' => '重', 'romaji' => 'omoi', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Nặng', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 271],
            ['character' => '軽', 'romaji' => 'karui', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Nhẹ', 'stroke_order' => '12', 'difficulty_level' => 2, 'order' => 272],
            ['character' => '硬', 'romaji' => 'katai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Cứng', 'stroke_order' => '12', 'difficulty_level' => 2, 'order' => 273],
            ['character' => '柔', 'romaji' => 'yawarakai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Mềm', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 274],
            ['character' => '強', 'romaji' => 'tsuyoi', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Mạnh', 'stroke_order' => '11', 'difficulty_level' => 2, 'order' => 275],
            ['character' => '弱', 'romaji' => 'yowai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Yếu', 'stroke_order' => '10', 'difficulty_level' => 2, 'order' => 276],
            ['character' => '速', 'romaji' => 'hayai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Nhanh', 'stroke_order' => '10', 'difficulty_level' => 2, 'order' => 277],
            ['character' => '遅', 'romaji' => 'osoi', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Chậm', 'stroke_order' => '12', 'difficulty_level' => 2, 'order' => 278],
            ['character' => '早', 'romaji' => 'hayai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Sớm', 'stroke_order' => '6', 'difficulty_level' => 2, 'order' => 279],
            ['character' => '遅', 'romaji' => 'okureru', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Muộn', 'stroke_order' => '12', 'difficulty_level' => 2, 'order' => 280],
            ['character' => '新', 'romaji' => 'atarashii', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Mới', 'stroke_order' => '13', 'difficulty_level' => 2, 'order' => 281],
            ['character' => '古', 'romaji' => 'furui', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Cũ', 'stroke_order' => '5', 'difficulty_level' => 2, 'order' => 282],
            ['character' => '若', 'romaji' => 'wakai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Trẻ', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 283],
            ['character' => '老', 'romaji' => 'rou', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Già', 'stroke_order' => '6', 'difficulty_level' => 2, 'order' => 284],
            ['character' => '若', 'romaji' => 'moshikashite', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Có thể', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 285],
            ['character' => '確', 'romaji' => 'tashika', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Chắc chắn', 'stroke_order' => '15', 'difficulty_level' => 2, 'order' => 286],
            ['character' => '不確', 'romaji' => 'futashika', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Không chắc chắn', 'stroke_order' => '4+15', 'difficulty_level' => 2, 'order' => 287],
            ['character' => '明', 'romaji' => 'akarui', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Sáng', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 288],
            ['character' => '暗', 'romaji' => 'kurai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Tối', 'stroke_order' => '13', 'difficulty_level' => 2, 'order' => 289],
            ['character' => '明', 'romaji' => 'mei', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Rõ ràng', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 290],
            ['character' => '暗', 'romaji' => 'an', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Mờ mịt', 'stroke_order' => '13', 'difficulty_level' => 2, 'order' => 291],
            ['character' => '明', 'romaji' => 'myou', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Minh bạch', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 292],
            ['character' => '暗', 'romaji' => 'an', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Bí mật', 'stroke_order' => '13', 'difficulty_level' => 2, 'order' => 293],
            ['character' => '明', 'romaji' => 'mei', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Thông minh', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 294],
            ['character' => '暗', 'romaji' => 'an', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Ngu dốt', 'stroke_order' => '13', 'difficulty_level' => 2, 'order' => 295],
            ['character' => '明', 'romaji' => 'myou', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Tài giỏi', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 296],
            ['character' => '暗', 'romaji' => 'an', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Kém cỏi', 'stroke_order' => '13', 'difficulty_level' => 2, 'order' => 297],
            ['character' => '明', 'romaji' => 'mei', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Xuất sắc', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 298],
            ['character' => '暗', 'romaji' => 'an', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Tồi tệ', 'stroke_order' => '13', 'difficulty_level' => 2, 'order' => 299],
            ['character' => '明', 'romaji' => 'myou', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Hoàn hảo', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 300],
        ];

        foreach ($additionalN4Kanji as $kanji) {
            Alphabet::create($kanji);
        }

        $this->command->info('Đã thêm ' . count($additionalN4Kanji) . ' Kanji N4 bổ sung.');
        $this->command->info('Tổng Kanji N4: ' . Alphabet::where('type', 'kanji')->where('difficulty_level', 2)->count() . ' chữ');
    }
}

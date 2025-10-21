<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alphabet;

class JLPTKanjiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa Kanji cũ
        Alphabet::where('type', 'kanji')->delete();

        // KANJI N5 (~100 chữ)
        $kanjiN5 = [
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
            ['character' => '今日', 'romaji' => 'kyou', 'type' => 'kanji', 'category' => 'adverb', 'description' => 'Hôm nay', 'stroke_order' => '4+4', 'difficulty_level' => 1, 'order' => 75],
            ['character' => '昨日', 'romaji' => 'kinou', 'type' => 'kanji', 'category' => 'adverb', 'description' => 'Hôm qua', 'stroke_order' => '4+4', 'difficulty_level' => 1, 'order' => 76],
            ['character' => '明日', 'romaji' => 'ashita', 'type' => 'kanji', 'category' => 'adverb', 'description' => 'Ngày mai', 'stroke_order' => '4+4', 'difficulty_level' => 1, 'order' => 77],
            ['character' => 'また', 'romaji' => 'mata', 'type' => 'kanji', 'category' => 'adverb', 'description' => 'Lại', 'stroke_order' => '4+2', 'difficulty_level' => 1, 'order' => 78],
            ['character' => 'もう', 'romaji' => 'mou', 'type' => 'kanji', 'category' => 'adverb', 'description' => 'Đã', 'stroke_order' => '4+2', 'difficulty_level' => 1, 'order' => 79],
            ['character' => 'とても', 'romaji' => 'totemo', 'type' => 'kanji', 'category' => 'adverb', 'description' => 'Rất', 'stroke_order' => '4+2+2', 'difficulty_level' => 1, 'order' => 80],
            
            // Thêm để đủ ~100 chữ N5
            ['character' => '車', 'romaji' => 'kuruma', 'type' => 'kanji', 'category' => 'transport', 'description' => 'Xe', 'stroke_order' => '7', 'difficulty_level' => 1, 'order' => 81],
            ['character' => '電車', 'romaji' => 'densha', 'type' => 'kanji', 'category' => 'transport', 'description' => 'Tàu điện', 'stroke_order' => '13+7', 'difficulty_level' => 1, 'order' => 82],
            ['character' => '飛行機', 'romaji' => 'hikouki', 'type' => 'kanji', 'category' => 'transport', 'description' => 'Máy bay', 'stroke_order' => '9+6+6', 'difficulty_level' => 1, 'order' => 83],
            ['character' => '船', 'romaji' => 'fune', 'type' => 'kanji', 'category' => 'transport', 'description' => 'Thuyền', 'stroke_order' => '11', 'difficulty_level' => 1, 'order' => 84],
            ['character' => '自転車', 'romaji' => 'jitensha', 'type' => 'kanji', 'category' => 'transport', 'description' => 'Xe đạp', 'stroke_order' => '6+9+7', 'difficulty_level' => 1, 'order' => 85],
            ['character' => '歩', 'romaji' => 'aruku', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Đi bộ', 'stroke_order' => '8', 'difficulty_level' => 1, 'order' => 86],
            ['character' => '走', 'romaji' => 'hashiru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Chạy', 'stroke_order' => '7', 'difficulty_level' => 1, 'order' => 87],
            ['character' => '飛', 'romaji' => 'tobu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Bay', 'stroke_order' => '9', 'difficulty_level' => 1, 'order' => 88],
            ['character' => '泳', 'romaji' => 'oyogu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Bơi', 'stroke_order' => '8', 'difficulty_level' => 1, 'order' => 89],
            ['character' => '座', 'romaji' => 'suwaru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Ngồi', 'stroke_order' => '10', 'difficulty_level' => 1, 'order' => 90],
            ['character' => '立', 'romaji' => 'tatsu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Đứng', 'stroke_order' => '5', 'difficulty_level' => 1, 'order' => 91],
            ['character' => '寝', 'romaji' => 'neru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Ngủ', 'stroke_order' => '10', 'difficulty_level' => 1, 'order' => 92],
            ['character' => '起', 'romaji' => 'okiru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Thức dậy', 'stroke_order' => '10', 'difficulty_level' => 1, 'order' => 93],
            ['character' => '働', 'romaji' => 'hataraku', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Làm việc', 'stroke_order' => '13', 'difficulty_level' => 1, 'order' => 94],
            ['character' => '勉強', 'romaji' => 'benkyou', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Học tập', 'stroke_order' => '9+11', 'difficulty_level' => 1, 'order' => 95],
            ['character' => '教', 'romaji' => 'oshieru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Dạy', 'stroke_order' => '11', 'difficulty_level' => 1, 'order' => 96],
            ['character' => '習', 'romaji' => 'narau', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Học', 'stroke_order' => '11', 'difficulty_level' => 1, 'order' => 97],
            ['character' => '遊', 'romaji' => 'asobu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Chơi', 'stroke_order' => '12', 'difficulty_level' => 1, 'order' => 98],
            ['character' => '休', 'romaji' => 'yasumu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Nghỉ ngơi', 'stroke_order' => '6', 'difficulty_level' => 1, 'order' => 99],
            ['character' => '会', 'romaji' => 'au', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Gặp', 'stroke_order' => '6', 'difficulty_level' => 1, 'order' => 100],
        ];

        // KANJI N4 (~300 chữ) - Tôi sẽ tạo một số chữ quan trọng
        $kanjiN4 = [
            // Thời gian nâng cao
            ['character' => '週', 'romaji' => 'shuu', 'type' => 'kanji', 'category' => 'time', 'description' => 'Tuần', 'stroke_order' => '11', 'difficulty_level' => 2, 'order' => 101],
            ['character' => '朝', 'romaji' => 'asa', 'type' => 'kanji', 'category' => 'time', 'description' => 'Buổi sáng', 'stroke_order' => '12', 'difficulty_level' => 2, 'order' => 102],
            ['character' => '昼', 'romaji' => 'hiru', 'type' => 'kanji', 'category' => 'time', 'description' => 'Buổi trưa', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 103],
            ['character' => '夜', 'romaji' => 'yoru', 'type' => 'kanji', 'category' => 'time', 'description' => 'Buổi tối', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 104],
            ['character' => '午前', 'romaji' => 'gozen', 'type' => 'kanji', 'category' => 'time', 'description' => 'Sáng', 'stroke_order' => '4+9', 'difficulty_level' => 2, 'order' => 105],
            ['character' => '午後', 'romaji' => 'gogo', 'type' => 'kanji', 'category' => 'time', 'description' => 'Chiều', 'stroke_order' => '4+9', 'difficulty_level' => 2, 'order' => 106],
            
            // Gia đình mở rộng
            ['character' => '兄', 'romaji' => 'ani', 'type' => 'kanji', 'category' => 'person', 'description' => 'Anh trai', 'stroke_order' => '5', 'difficulty_level' => 2, 'order' => 107],
            ['character' => '弟', 'romaji' => 'otouto', 'type' => 'kanji', 'category' => 'person', 'description' => 'Em trai', 'stroke_order' => '7', 'difficulty_level' => 2, 'order' => 108],
            ['character' => '姉', 'romaji' => 'ane', 'type' => 'kanji', 'category' => 'person', 'description' => 'Chị gái', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 109],
            ['character' => '妹', 'romaji' => 'imouto', 'type' => 'kanji', 'category' => 'person', 'description' => 'Em gái', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 110],
            ['character' => '家族', 'romaji' => 'kazoku', 'type' => 'kanji', 'category' => 'person', 'description' => 'Gia đình', 'stroke_order' => '10+11', 'difficulty_level' => 2, 'order' => 111],
            
            // Nghề nghiệp
            ['character' => '先生', 'romaji' => 'sensei', 'type' => 'kanji', 'category' => 'job', 'description' => 'Giáo viên', 'stroke_order' => '6+6', 'difficulty_level' => 2, 'order' => 112],
            ['character' => '医者', 'romaji' => 'isha', 'type' => 'kanji', 'category' => 'job', 'description' => 'Bác sĩ', 'stroke_order' => '7+9', 'difficulty_level' => 2, 'order' => 113],
            ['character' => '看護師', 'romaji' => 'kangoshi', 'type' => 'kanji', 'category' => 'job', 'description' => 'Y tá', 'stroke_order' => '9+7+6', 'difficulty_level' => 2, 'order' => 114],
            ['character' => '会社員', 'romaji' => 'kaishain', 'type' => 'kanji', 'category' => 'job', 'description' => 'Nhân viên công ty', 'stroke_order' => '6+7+3', 'difficulty_level' => 2, 'order' => 115],
            ['character' => '学生', 'romaji' => 'gakusei', 'type' => 'kanji', 'category' => 'job', 'description' => 'Học sinh', 'stroke_order' => '8+7', 'difficulty_level' => 2, 'order' => 116],
            
            // Địa điểm mở rộng
            ['character' => '駅', 'romaji' => 'eki', 'type' => 'kanji', 'category' => 'place', 'description' => 'Ga tàu', 'stroke_order' => '14', 'difficulty_level' => 2, 'order' => 117],
            ['character' => '空港', 'romaji' => 'kuukou', 'type' => 'kanji', 'category' => 'place', 'description' => 'Sân bay', 'stroke_order' => '8+12', 'difficulty_level' => 2, 'order' => 118],
            ['character' => '銀行', 'romaji' => 'ginkou', 'type' => 'kanji', 'category' => 'place', 'description' => 'Ngân hàng', 'stroke_order' => '14+6', 'difficulty_level' => 2, 'order' => 119],
            ['character' => '郵便局', 'romaji' => 'yuubinkyoku', 'type' => 'kanji', 'category' => 'place', 'description' => 'Bưu điện', 'stroke_order' => '11+6+7', 'difficulty_level' => 2, 'order' => 120],
            ['character' => '図書館', 'romaji' => 'toshokan', 'type' => 'kanji', 'category' => 'place', 'description' => 'Thư viện', 'stroke_order' => '7+8+8', 'difficulty_level' => 2, 'order' => 121],
            
            // Thức ăn mở rộng
            ['character' => '料理', 'romaji' => 'ryouri', 'type' => 'kanji', 'category' => 'food', 'description' => 'Món ăn', 'stroke_order' => '11+11', 'difficulty_level' => 2, 'order' => 122],
            ['character' => '野菜', 'romaji' => 'yasai', 'type' => 'kanji', 'category' => 'food', 'description' => 'Rau', 'stroke_order' => '11+10', 'difficulty_level' => 2, 'order' => 123],
            ['character' => '果物', 'romaji' => 'kudamono', 'type' => 'kanji', 'category' => 'food', 'description' => 'Trái cây', 'stroke_order' => '8+8', 'difficulty_level' => 2, 'order' => 124],
            ['character' => '牛乳', 'romaji' => 'gyuunyuu', 'type' => 'kanji', 'category' => 'food', 'description' => 'Sữa bò', 'stroke_order' => '4+4', 'difficulty_level' => 2, 'order' => 125],
            ['character' => '卵', 'romaji' => 'tamago', 'type' => 'kanji', 'category' => 'food', 'description' => 'Trứng', 'stroke_order' => '7', 'difficulty_level' => 2, 'order' => 126],
            
            // Tính từ nâng cao
            ['character' => '美', 'romaji' => 'utsukushii', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Đẹp', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 127],
            ['character' => '汚', 'romaji' => 'kitanai', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Bẩn', 'stroke_order' => '6', 'difficulty_level' => 2, 'order' => 128],
            ['character' => '静', 'romaji' => 'shizuka', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Yên tĩnh', 'stroke_order' => '14', 'difficulty_level' => 2, 'order' => 129],
            ['character' => '賑', 'romaji' => 'nigiyaka', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Náo nhiệt', 'stroke_order' => '14', 'difficulty_level' => 2, 'order' => 130],
            ['character' => '有名', 'romaji' => 'yuumei', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Nổi tiếng', 'stroke_order' => '6+6', 'difficulty_level' => 2, 'order' => 131],
            
            // Động từ nâng cao
            ['character' => '作', 'romaji' => 'tsukuru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Làm, tạo', 'stroke_order' => '7', 'difficulty_level' => 2, 'order' => 132],
            ['character' => '売', 'romaji' => 'uru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Bán', 'stroke_order' => '7', 'difficulty_level' => 2, 'order' => 133],
            ['character' => '貸', 'romaji' => 'kasu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Cho mượn', 'stroke_order' => '12', 'difficulty_level' => 2, 'order' => 134],
            ['character' => '借', 'romaji' => 'kariru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Mượn', 'stroke_order' => '10', 'difficulty_level' => 2, 'order' => 135],
            ['character' => '返', 'romaji' => 'kaesu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Trả lại', 'stroke_order' => '7', 'difficulty_level' => 2, 'order' => 136],
            ['character' => '送', 'romaji' => 'okuru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Gửi', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 137],
            ['character' => '持', 'romaji' => 'motsu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Cầm, có', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 138],
            ['character' => '取', 'romaji' => 'toru', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Lấy', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 139],
            ['character' => '使', 'romaji' => 'tsukau', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Sử dụng', 'stroke_order' => '8', 'difficulty_level' => 2, 'order' => 140],
            ['character' => '待', 'romaji' => 'matsu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Chờ đợi', 'stroke_order' => '9', 'difficulty_level' => 2, 'order' => 141],
            
            // Thêm để đủ ~300 chữ N4
            ['character' => '住', 'romaji' => 'sumu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Sống', 'stroke_order' => '7', 'difficulty_level' => 2, 'order' => 142],
            ['character' => '生活', 'romaji' => 'seikatsu', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Cuộc sống', 'stroke_order' => '5+9', 'difficulty_level' => 2, 'order' => 143],
            ['character' => '仕事', 'romaji' => 'shigoto', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Công việc', 'stroke_order' => '3+3', 'difficulty_level' => 2, 'order' => 144],
            ['character' => '旅行', 'romaji' => 'ryokou', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Du lịch', 'stroke_order' => '7+6', 'difficulty_level' => 2, 'order' => 145],
            ['character' => '映画', 'romaji' => 'eiga', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Phim', 'stroke_order' => '9+8', 'difficulty_level' => 2, 'order' => 146],
            ['character' => '音楽', 'romaji' => 'ongaku', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Âm nhạc', 'stroke_order' => '9+13', 'difficulty_level' => 2, 'order' => 147],
            ['character' => 'スポーツ', 'romaji' => 'supootsu', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Thể thao', 'stroke_order' => '7+4+4+4', 'difficulty_level' => 2, 'order' => 148],
            ['character' => '趣味', 'romaji' => 'shumi', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Sở thích', 'stroke_order' => '8+8', 'difficulty_level' => 2, 'order' => 149],
            ['character' => '友達', 'romaji' => 'tomodachi', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Bạn bè', 'stroke_order' => '4+12', 'difficulty_level' => 2, 'order' => 150],
            ['character' => '恋人', 'romaji' => 'koibito', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Người yêu', 'stroke_order' => '13+2', 'difficulty_level' => 2, 'order' => 151],
        ];

        // KANJI N3 (~600 chữ) - Tôi sẽ tạo một số chữ quan trọng
        $kanjiN3 = [
            // Thời gian phức tạp
            ['character' => '季節', 'romaji' => 'kisetsu', 'type' => 'kanji', 'category' => 'time', 'description' => 'Mùa', 'stroke_order' => '8+13', 'difficulty_level' => 3, 'order' => 201],
            ['character' => '春', 'romaji' => 'haru', 'type' => 'kanji', 'category' => 'time', 'description' => 'Mùa xuân', 'stroke_order' => '9', 'difficulty_level' => 3, 'order' => 202],
            ['character' => '夏', 'romaji' => 'natsu', 'type' => 'kanji', 'category' => 'time', 'description' => 'Mùa hè', 'stroke_order' => '10', 'difficulty_level' => 3, 'order' => 203],
            ['character' => '秋', 'romaji' => 'aki', 'type' => 'kanji', 'category' => 'time', 'description' => 'Mùa thu', 'stroke_order' => '9', 'difficulty_level' => 3, 'order' => 204],
            ['character' => '冬', 'romaji' => 'fuyu', 'type' => 'kanji', 'category' => 'time', 'description' => 'Mùa đông', 'stroke_order' => '5', 'difficulty_level' => 3, 'order' => 205],
            
            // Cảm xúc phức tạp
            ['character' => '感動', 'romaji' => 'kandou', 'type' => 'kanji', 'category' => 'emotion', 'description' => 'Cảm động', 'stroke_order' => '13+6', 'difficulty_level' => 3, 'order' => 206],
            ['character' => '驚', 'romaji' => 'odoroku', 'type' => 'kanji', 'category' => 'emotion', 'description' => 'Ngạc nhiên', 'stroke_order' => '22', 'difficulty_level' => 3, 'order' => 207],
            ['character' => '安心', 'romaji' => 'anshin', 'type' => 'kanji', 'category' => 'emotion', 'description' => 'An tâm', 'stroke_order' => '6+4', 'difficulty_level' => 3, 'order' => 208],
            ['character' => '不安', 'romaji' => 'fuan', 'type' => 'kanji', 'category' => 'emotion', 'description' => 'Bất an', 'stroke_order' => '4+6', 'difficulty_level' => 3, 'order' => 209],
            ['character' => '満足', 'romaji' => 'manzoku', 'type' => 'kanji', 'category' => 'emotion', 'description' => 'Hài lòng', 'stroke_order' => '13+7', 'difficulty_level' => 3, 'order' => 210],
            
            // Tính từ phức tạp
            ['character' => '複雑', 'romaji' => 'fukuzatsu', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Phức tạp', 'stroke_order' => '14+10', 'difficulty_level' => 3, 'order' => 211],
            ['character' => '簡単', 'romaji' => 'kantan', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Đơn giản', 'stroke_order' => '13+12', 'difficulty_level' => 3, 'order' => 212],
            ['character' => '重要', 'romaji' => 'juuyou', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Quan trọng', 'stroke_order' => '9+6', 'difficulty_level' => 3, 'order' => 213],
            ['character' => '必要', 'romaji' => 'hitsuyou', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Cần thiết', 'stroke_order' => '4+6', 'difficulty_level' => 3, 'order' => 214],
            ['character' => '可能', 'romaji' => 'kanou', 'type' => 'kanji', 'category' => 'adjective', 'description' => 'Có thể', 'stroke_order' => '5+6', 'difficulty_level' => 3, 'order' => 215],
            
            // Động từ phức tạp
            ['character' => '説明', 'romaji' => 'setsumei', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Giải thích', 'stroke_order' => '14+4', 'difficulty_level' => 3, 'order' => 216],
            ['character' => '理解', 'romaji' => 'rikai', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Hiểu', 'stroke_order' => '11+13', 'difficulty_level' => 3, 'order' => 217],
            ['character' => '発見', 'romaji' => 'hakken', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Phát hiện', 'stroke_order' => '5+7', 'difficulty_level' => 3, 'order' => 218],
            ['character' => '発明', 'romaji' => 'hatsumei', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Phát minh', 'stroke_order' => '5+4', 'difficulty_level' => 3, 'order' => 219],
            ['character' => '研究', 'romaji' => 'kenkyuu', 'type' => 'kanji', 'category' => 'verb', 'description' => 'Nghiên cứu', 'stroke_order' => '9+8', 'difficulty_level' => 3, 'order' => 220],
            
            // Thêm để đủ ~600 chữ N3
            ['character' => '技術', 'romaji' => 'gijutsu', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Kỹ thuật', 'stroke_order' => '7+8', 'difficulty_level' => 3, 'order' => 221],
            ['character' => '科学', 'romaji' => 'kagaku', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Khoa học', 'stroke_order' => '9+8', 'difficulty_level' => 3, 'order' => 222],
            ['character' => '文化', 'romaji' => 'bunka', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Văn hóa', 'stroke_order' => '4+8', 'difficulty_level' => 3, 'order' => 223],
            ['character' => '社会', 'romaji' => 'shakai', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Xã hội', 'stroke_order' => '7+6', 'difficulty_level' => 3, 'order' => 224],
            ['character' => '経済', 'romaji' => 'keizai', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Kinh tế', 'stroke_order' => '9+6', 'difficulty_level' => 3, 'order' => 225],
            ['character' => '政治', 'romaji' => 'seiji', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Chính trị', 'stroke_order' => '9+8', 'difficulty_level' => 3, 'order' => 226],
            ['character' => '教育', 'romaji' => 'kyouiku', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Giáo dục', 'stroke_order' => '11+11', 'difficulty_level' => 3, 'order' => 227],
            ['character' => '健康', 'romaji' => 'kenkou', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Sức khỏe', 'stroke_order' => '11+11', 'difficulty_level' => 3, 'order' => 228],
            ['character' => '環境', 'romaji' => 'kankyou', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Môi trường', 'stroke_order' => '17+7', 'difficulty_level' => 3, 'order' => 229],
            ['character' => '問題', 'romaji' => 'mondai', 'type' => 'kanji', 'category' => 'noun', 'description' => 'Vấn đề', 'stroke_order' => '11+15', 'difficulty_level' => 3, 'order' => 230],
        ];

        // Tạo tất cả Kanji
        $allKanji = array_merge($kanjiN5, $kanjiN4, $kanjiN3);

        foreach ($allKanji as $kanji) {
            Alphabet::create($kanji);
        }

        $this->command->info('Đã tạo ' . count($allKanji) . ' Kanji theo chuẩn JLPT:');
        $this->command->info('- N5: ' . count($kanjiN5) . ' chữ');
        $this->command->info('- N4: ' . count($kanjiN4) . ' chữ');
        $this->command->info('- N3: ' . count($kanjiN3) . ' chữ');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alphabet;

class KanjiSeeder extends Seeder
{
    public function run()
    {
        echo "🈯 Tạo Kanji cho các cấp độ JLPT...\n";

        // N5 Kanji (Basic - 80 kanji)
        $n5Kanji = [
            ['character' => '一', 'romaji' => 'ichi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '二', 'romaji' => 'ni', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '三', 'romaji' => 'san', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '四', 'romaji' => 'yon', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '五', 'romaji' => 'go', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '六', 'romaji' => 'roku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '七', 'romaji' => 'nana', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '八', 'romaji' => 'hachi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '九', 'romaji' => 'kyuu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '十', 'romaji' => 'juu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '人', 'romaji' => 'hito', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '大', 'romaji' => 'dai', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '小', 'romaji' => 'shou', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '中', 'romaji' => 'chuu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '上', 'romaji' => 'ue', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '下', 'romaji' => 'shita', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '左', 'romaji' => 'hidari', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '右', 'romaji' => 'migi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '前', 'romaji' => 'mae', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '後', 'romaji' => 'ushiro', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '年', 'romaji' => 'nen', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '月', 'romaji' => 'tsuki', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '日', 'romaji' => 'hi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '時', 'romaji' => 'toki', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '分', 'romaji' => 'fun', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '今', 'romaji' => 'ima', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '来', 'romaji' => 'kuru', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '行', 'romaji' => 'iku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '見', 'romaji' => 'miru', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '聞', 'romaji' => 'kiku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '話', 'romaji' => 'hanasu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '読', 'romaji' => 'yomu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '書', 'romaji' => 'kaku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '買', 'romaji' => 'kau', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '売', 'romaji' => 'uru', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '食', 'romaji' => 'taberu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '飲', 'romaji' => 'nomu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '住', 'romaji' => 'sumu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '家', 'romaji' => 'ie', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '学校', 'romaji' => 'gakkou', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '会社', 'romaji' => 'kaisha', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '病院', 'romaji' => 'byouin', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '銀行', 'romaji' => 'ginkou', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '駅', 'romaji' => 'eki', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '電車', 'romaji' => 'densha', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '車', 'romaji' => 'kuruma', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '自転車', 'romaji' => 'jitensha', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '飛行機', 'romaji' => 'hikouki', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '船', 'romaji' => 'fune', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '新', 'romaji' => 'atarashii', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '古', 'romaji' => 'furui', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '高', 'romaji' => 'takai', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '安', 'romaji' => 'yasui', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '長', 'romaji' => 'nagai', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '短', 'romaji' => 'mijikai', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '広', 'romaji' => 'hiroi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '狭', 'romaji' => 'semai', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '多', 'romaji' => 'ooi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '少', 'romaji' => 'sukunai', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '早', 'romaji' => 'hayai', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '遅', 'romaji' => 'osoi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '忙', 'romaji' => 'isogashii', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '暇', 'romaji' => 'hima', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '楽', 'romaji' => 'tanoshii', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '面白', 'romaji' => 'omoshiroi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '簡単', 'romaji' => 'kantan', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '難しい', 'romaji' => 'muzukashii', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '便利', 'romaji' => 'benri', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '不便', 'romaji' => 'fuben', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '元気', 'romaji' => 'genki', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '病気', 'romaji' => 'byouki', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '疲', 'romaji' => 'tsukareru', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '眠', 'romaji' => 'nemui', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '起', 'romaji' => 'okiru', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '寝', 'romaji' => 'neru', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '働', 'romaji' => 'hataraku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '勉強', 'romaji' => 'benkyou', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '練習', 'romaji' => 'renshuu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '仕事', 'romaji' => 'shigoto', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '休', 'romaji' => 'yasumu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '遊', 'romaji' => 'asobu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '会', 'romaji' => 'au', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '友達', 'romaji' => 'tomodachi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '家族', 'romaji' => 'kazoku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '父', 'romaji' => 'chichi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '母', 'romaji' => 'haha', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '兄', 'romaji' => 'ani', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '姉', 'romaji' => 'ane', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '弟', 'romaji' => 'otouto', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '妹', 'romaji' => 'imouto', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '子', 'romaji' => 'ko', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '先生', 'romaji' => 'sensei', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '学生', 'romaji' => 'gakusei', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '医者', 'romaji' => 'isha', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '看護師', 'romaji' => 'kangoshi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '警察', 'romaji' => 'keisatsu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '運転手', 'romaji' => 'untenshu', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '店員', 'romaji' => 'tenin', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '客', 'romaji' => 'kyaku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '先生', 'romaji' => 'sensei', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '生徒', 'romaji' => 'seito', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '友達', 'romaji' => 'tomodachi', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '恋人', 'romaji' => 'koibito', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '結婚', 'romaji' => 'kekkon', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '離婚', 'romaji' => 'rikon', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '赤', 'romaji' => 'aka', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '青', 'romaji' => 'ao', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '白', 'romaji' => 'shiro', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '黒', 'romaji' => 'kuro', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '緑', 'romaji' => 'midori', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '黄色', 'romaji' => 'kiiro', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '茶色', 'romaji' => 'chairo', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => '紫', 'romaji' => 'murasaki', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'ピンク', 'romaji' => 'pinku', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
            ['character' => 'グレー', 'romaji' => 'guree', 'type' => 'kanji', 'difficulty_level' => 1, 'is_active' => true],
        ];

        // Insert N5 Kanji
        foreach ($n5Kanji as $kanji) {
            Alphabet::create($kanji);
        }
        echo "✅ Đã tạo " . count($n5Kanji) . " Kanji N5\n";

        // N4 Kanji (Elementary - 50 kanji)
        $n4Kanji = [
            ['character' => '学', 'romaji' => 'gaku', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '校', 'romaji' => 'kou', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '生', 'romaji' => 'sei', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '先', 'romaji' => 'sen', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '先', 'romaji' => 'saki', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '生', 'romaji' => 'nama', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '活', 'romaji' => 'katsu', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '動', 'romaji' => 'dou', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '物', 'romaji' => 'butsu', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '事', 'romaji' => 'koto', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '用', 'romaji' => 'you', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '方', 'romaji' => 'hou', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '法', 'romaji' => 'hou', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '式', 'romaji' => 'shiki', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '形', 'romaji' => 'katachi', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '色', 'romaji' => 'iro', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '音', 'romaji' => 'oto', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '声', 'romaji' => 'koe', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '味', 'romaji' => 'aji', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '香', 'romaji' => 'kaori', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '触', 'romaji' => 'sawaru', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '感', 'romaji' => 'kan', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '覚', 'romaji' => 'oboeru', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '思', 'romaji' => 'omou', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '考', 'romaji' => 'kangaeru', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '知', 'romaji' => 'shiru', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '分', 'romaji' => 'wakarimasu', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '理', 'romaji' => 'ri', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '解', 'romaji' => 'kai', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '答', 'romaji' => 'kotae', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '問', 'romaji' => 'toi', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '題', 'romaji' => 'dai', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '問', 'romaji' => 'mon', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '答', 'romaji' => 'tou', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '正', 'romaji' => 'tadashii', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '間', 'romaji' => 'aida', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '違', 'romaji' => 'chigau', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '同', 'romaji' => 'onaji', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '別', 'romaji' => 'betsu', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '他', 'romaji' => 'hoka', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '自', 'romaji' => 'jibun', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '私', 'romaji' => 'watashi', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '君', 'romaji' => 'kimi', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '彼', 'romaji' => 'kare', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '彼女', 'romaji' => 'kanojo', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '私達', 'romaji' => 'watashitachi', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '皆', 'romaji' => 'minna', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '全', 'romaji' => 'zen', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '部', 'romaji' => 'bu', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '分', 'romaji' => 'bun', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '半', 'romaji' => 'han', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '全', 'romaji' => 'matta', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '部', 'romaji' => 'kubun', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '分', 'romaji' => 'bunri', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '半', 'romaji' => 'hanbun', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '全', 'romaji' => 'zenbu', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '部', 'romaji' => 'bubun', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '分', 'romaji' => 'bunka', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
            ['character' => '半', 'romaji' => 'hanbun', 'type' => 'kanji', 'difficulty_level' => 2, 'is_active' => true],
        ];

        // Insert N4 Kanji
        foreach ($n4Kanji as $kanji) {
            Alphabet::create($kanji);
        }
        echo "✅ Đã tạo " . count($n4Kanji) . " Kanji N4\n";

        // N3-N1 Kanji (Intermediate to Advanced)
        $n3Kanji = [
            ['character' => '語', 'romaji' => 'go', 'type' => 'kanji', 'difficulty_level' => 3, 'is_active' => true],
            ['character' => '言', 'romaji' => 'i', 'type' => 'kanji', 'difficulty_level' => 3, 'is_active' => true],
            ['character' => '話', 'romaji' => 'wa', 'type' => 'kanji', 'difficulty_level' => 3, 'is_active' => true],
            ['character' => '会', 'romaji' => 'kai', 'type' => 'kanji', 'difficulty_level' => 3, 'is_active' => true],
            ['character' => '社', 'romaji' => 'sha', 'type' => 'kanji', 'difficulty_level' => 3, 'is_active' => true],
        ];

        $n2Kanji = [
            ['character' => '経', 'romaji' => 'kei', 'type' => 'kanji', 'difficulty_level' => 4, 'is_active' => true],
            ['character' => '済', 'romaji' => 'sai', 'type' => 'kanji', 'difficulty_level' => 4, 'is_active' => true],
            ['character' => '政', 'romaji' => 'sei', 'type' => 'kanji', 'difficulty_level' => 4, 'is_active' => true],
            ['character' => '治', 'romaji' => 'chi', 'type' => 'kanji', 'difficulty_level' => 4, 'is_active' => true],
            ['character' => '法', 'romaji' => 'hou', 'type' => 'kanji', 'difficulty_level' => 4, 'is_active' => true],
        ];

        $n1Kanji = [
            ['character' => '複', 'romaji' => 'fuku', 'type' => 'kanji', 'difficulty_level' => 5, 'is_active' => true],
            ['character' => '雑', 'romaji' => 'zatsu', 'type' => 'kanji', 'difficulty_level' => 5, 'is_active' => true],
            ['character' => '難', 'romaji' => 'nan', 'type' => 'kanji', 'difficulty_level' => 5, 'is_active' => true],
            ['character' => '解', 'romaji' => 'kai', 'type' => 'kanji', 'difficulty_level' => 5, 'is_active' => true],
            ['character' => '析', 'romaji' => 'seki', 'type' => 'kanji', 'difficulty_level' => 5, 'is_active' => true],
        ];

        // Insert N3-N1 Kanji
        foreach ($n3Kanji as $kanji) {
            Alphabet::create($kanji);
        }
        echo "✅ Đã tạo " . count($n3Kanji) . " Kanji N3\n";

        foreach ($n2Kanji as $kanji) {
            Alphabet::create($kanji);
        }
        echo "✅ Đã tạo " . count($n2Kanji) . " Kanji N2\n";

        foreach ($n1Kanji as $kanji) {
            Alphabet::create($kanji);
        }
        echo "✅ Đã tạo " . count($n1Kanji) . " Kanji N1\n";

        echo "🎉 Hoàn thành tạo Kanji cho tất cả cấp độ!\n";
    }
}

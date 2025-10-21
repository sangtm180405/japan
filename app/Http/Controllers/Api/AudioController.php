<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TTSService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AudioController extends Controller
{
    private $ttsService;

    public function __construct(TTSService $ttsService)
    {
        $this->ttsService = $ttsService;
    }

    /**
     * Generate audio for Japanese text using TTS
     */
    public function generateAudio(Request $request)
    {
        $text = $request->get('text');
        $type = $request->get('type', 'vocabulary');
        
        if (!$text) {
            return response()->json(['error' => 'Text is required'], 400);
        }

        // Generate audio using TTS service
        $audioUrl = $this->ttsService->generateVocabularyAudio($text, $type);
        $pronunciationGuide = $this->getPronunciationGuide($text, $type);
        
        return response()->json([
            'text' => $text,
            'type' => $type,
            'pronunciation_guide' => $pronunciationGuide,
            'audio_url' => $audioUrl,
            'tts_available' => $this->ttsService->isAvailable(),
            'message' => $audioUrl ? 'Audio generated successfully' : 'Using browser TTS fallback'
        ]);
    }

    /**
     * Get pronunciation guide for Japanese text
     */
    private function getPronunciationGuide($text, $type)
    {
        $guides = [
            'hiragana' => [
                'あ' => 'a (như "a" trong "ba")',
                'い' => 'i (như "i" trong "bi")',
                'う' => 'u (như "u" trong "bu")',
                'え' => 'e (như "e" trong "be")',
                'お' => 'o (như "o" trong "bo")',
                'か' => 'ka (như "ca" trong "cá")',
                'き' => 'ki (như "ki" trong "kính")',
                'く' => 'ku (như "ku" trong "khu")',
                'け' => 'ke (như "ke" trong "kẻ")',
                'こ' => 'ko (như "ko" trong "kho")',
                'さ' => 'sa (như "sa" trong "sá")',
                'し' => 'shi (như "shi" trong "shin")',
                'す' => 'su (như "su" trong "sú")',
                'せ' => 'se (như "se" trong "sẻ")',
                'そ' => 'so (như "so" trong "só")',
                'た' => 'ta (như "ta" trong "tá")',
                'ち' => 'chi (như "chi" trong "chí")',
                'つ' => 'tsu (như "tsu" trong "tsú")',
                'て' => 'te (như "te" trong "tẻ")',
                'と' => 'to (như "to" trong "tó")',
                'な' => 'na (như "na" trong "ná")',
                'に' => 'ni (như "ni" trong "ní")',
                'ぬ' => 'nu (như "nu" trong "nú")',
                'ね' => 'ne (như "ne" trong "nẻ")',
                'の' => 'no (như "no" trong "nó")',
                'は' => 'ha (như "ha" trong "há")',
                'ひ' => 'hi (như "hi" trong "hí")',
                'ふ' => 'fu (như "fu" trong "fú")',
                'へ' => 'he (như "he" trong "hẻ")',
                'ほ' => 'ho (như "ho" trong "hó")',
                'ま' => 'ma (như "ma" trong "má")',
                'み' => 'mi (như "mi" trong "mí")',
                'む' => 'mu (như "mu" trong "mú")',
                'め' => 'me (như "me" trong "mẻ")',
                'も' => 'mo (như "mo" trong "mó")',
                'や' => 'ya (như "ya" trong "yá")',
                'ゆ' => 'yu (như "yu" trong "yú")',
                'よ' => 'yo (như "yo" trong "yó")',
                'ら' => 'ra (như "ra" trong "rá")',
                'り' => 'ri (như "ri" trong "rí")',
                'る' => 'ru (như "ru" trong "rú")',
                'れ' => 're (như "re" trong "rẻ")',
                'ろ' => 'ro (như "ro" trong "ró")',
                'わ' => 'wa (như "wa" trong "wá")',
                'を' => 'wo (như "wo" trong "wó")',
                'ん' => 'n (như "n" trong "n")',
            ],
            'katakana' => [
                'ア' => 'a (như "a" trong "ba")',
                'イ' => 'i (như "i" trong "bi")',
                'ウ' => 'u (như "u" trong "bu")',
                'エ' => 'e (như "e" trong "be")',
                'オ' => 'o (như "o" trong "bo")',
                'カ' => 'ka (như "ca" trong "cá")',
                'キ' => 'ki (như "ki" trong "kính")',
                'ク' => 'ku (như "ku" trong "khu")',
                'ケ' => 'ke (như "ke" trong "kẻ")',
                'コ' => 'ko (như "ko" trong "kho")',
                'サ' => 'sa (như "sa" trong "sá")',
                'シ' => 'shi (như "shi" trong "shin")',
                'ス' => 'su (như "su" trong "sú")',
                'セ' => 'se (như "se" trong "sẻ")',
                'ソ' => 'so (như "so" trong "só")',
                'タ' => 'ta (như "ta" trong "tá")',
                'チ' => 'chi (như "chi" trong "chí")',
                'ツ' => 'tsu (như "tsu" trong "tsú")',
                'テ' => 'te (như "te" trong "tẻ")',
                'ト' => 'to (như "to" trong "tó")',
                'ナ' => 'na (như "na" trong "ná")',
                'ニ' => 'ni (như "ni" trong "ní")',
                'ヌ' => 'nu (như "nu" trong "nú")',
                'ネ' => 'ne (như "ne" trong "nẻ")',
                'ノ' => 'no (như "no" trong "nó")',
                'ハ' => 'ha (như "ha" trong "há")',
                'ヒ' => 'hi (như "hi" trong "hí")',
                'フ' => 'fu (như "fu" trong "fú")',
                'ヘ' => 'he (như "he" trong "hẻ")',
                'ホ' => 'ho (như "ho" trong "hó")',
                'マ' => 'ma (như "ma" trong "má")',
                'ミ' => 'mi (như "mi" trong "mí")',
                'ム' => 'mu (như "mu" trong "mú")',
                'メ' => 'me (như "me" trong "mẻ")',
                'モ' => 'mo (như "mo" trong "mó")',
                'ヤ' => 'ya (như "ya" trong "yá")',
                'ユ' => 'yu (như "yu" trong "yú")',
                'ヨ' => 'yo (như "yo" trong "yó")',
                'ラ' => 'ra (như "ra" trong "rá")',
                'リ' => 'ri (như "ri" trong "rí")',
                'ル' => 'ru (như "ru" trong "rú")',
                'レ' => 're (như "re" trong "rẻ")',
                'ロ' => 'ro (như "ro" trong "ró")',
                'ワ' => 'wa (như "wa" trong "wá")',
                'ヲ' => 'wo (như "wo" trong "wó")',
                'ン' => 'n (như "n" trong "n")',
            ]
        ];

        // For single characters
        if (mb_strlen($text) === 1) {
            return $guides[$type][$text] ?? "{$text} - Phát âm tiếng Nhật";
        }

        // For longer text (vocabulary)
        return "{$text} - Từ vựng tiếng Nhật";
    }
}

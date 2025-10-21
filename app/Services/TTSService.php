<?php

namespace App\Services;

use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class TTSService
{
    private $client;
    private $config;

    public function __construct()
    {
        $this->config = [
            'credentials' => config('services.google.credentials_path'),
            'project_id' => config('services.google.project_id'),
        ];
        
        try {
            // Only initialize if Google TTS is available
            if (class_exists('Google\Cloud\TextToSpeech\V1\TextToSpeechClient')) {
                $this->client = new TextToSpeechClient($this->config);
            } else {
                $this->client = null;
            }
        } catch (\Exception $e) {
            Log::error('TTS Client initialization failed: ' . $e->getMessage());
            $this->client = null;
        }
    }

    /**
     * Generate audio for Japanese text
     */
    public function generateAudio(string $text, string $voiceName = 'ja-JP-Standard-A'): ?string
    {
        if (!$this->client) {
            return $this->fallbackTTS($text);
        }

        try {
            // Create synthesis input
            $synthesisInput = new SynthesisInput();
            $synthesisInput->setText($text);

            // Create voice selection
            $voice = new VoiceSelectionParams();
            $voice->setLanguageCode('ja-JP');
            $voice->setName($voiceName);
            $voice->setSsmlGender(SsmlVoiceGender::FEMALE);

            // Create audio config
            $audioConfig = new AudioConfig();
            $audioConfig->setAudioEncoding(\Google\Cloud\TextToSpeech\V1\AudioEncoding::MP3);
            $audioConfig->setSpeakingRate(0.9);
            $audioConfig->setPitch(0.0);

            // Perform synthesis
            $response = $this->client->synthesizeSpeech($synthesisInput, $voice, $audioConfig);
            $audioContent = $response->getAudioContent();

            // Save audio file
            $filename = $this->generateFilename($text);
            $path = "audio/generated/{$filename}";
            
            Storage::disk('public')->put($path, $audioContent);
            
            return Storage::url($path);
            
        } catch (\Exception $e) {
            Log::error('TTS generation failed: ' . $e->getMessage());
            return $this->fallbackTTS($text);
        }
    }

    /**
     * Generate audio for vocabulary with different voices
     */
    public function generateVocabularyAudio(string $japanese, string $type = 'vocabulary'): ?string
    {
        $voiceMap = [
            'hiragana' => 'ja-JP-Standard-A',
            'katakana' => 'ja-JP-Standard-B', 
            'vocabulary' => 'ja-JP-Standard-C',
            'kanji' => 'ja-JP-Standard-D'
        ];

        $voiceName = $voiceMap[$type] ?? 'ja-JP-Standard-A';
        return $this->generateAudio($japanese, $voiceName);
    }

    /**
     * Generate multiple audio files for a lesson
     */
    public function generateLessonAudio(array $vocabularies): array
    {
        $results = [];
        
        foreach ($vocabularies as $vocab) {
            $audioUrl = $this->generateVocabularyAudio($vocab['japanese'], $vocab['type'] ?? 'vocabulary');
            $results[] = [
                'japanese' => $vocab['japanese'],
                'audio_url' => $audioUrl,
                'type' => $vocab['type'] ?? 'vocabulary'
            ];
        }
        
        return $results;
    }

    /**
     * Fallback to browser TTS
     */
    private function fallbackTTS(string $text): ?string
    {
        // Return null to trigger browser TTS
        return null;
    }

    /**
     * Generate filename for audio
     */
    private function generateFilename(string $text): string
    {
        $hash = md5($text);
        $sanitized = preg_replace('/[^a-zA-Z0-9\-_]/', '', $text);
        return substr($sanitized, 0, 20) . '_' . $hash . '.mp3';
    }

    /**
     * Get available Japanese voices
     */
    public function getAvailableVoices(): array
    {
        return [
            'ja-JP-Standard-A' => 'Female Standard',
            'ja-JP-Standard-B' => 'Male Standard', 
            'ja-JP-Standard-C' => 'Female WaveNet',
            'ja-JP-Standard-D' => 'Male WaveNet',
            'ja-JP-Wavenet-A' => 'Female WaveNet Premium',
            'ja-JP-Wavenet-B' => 'Male WaveNet Premium',
            'ja-JP-Wavenet-C' => 'Female WaveNet Premium 2',
            'ja-JP-Wavenet-D' => 'Male WaveNet Premium 2'
        ];
    }

    /**
     * Check if TTS service is available
     */
    public function isAvailable(): bool
    {
        return $this->client !== null;
    }
}

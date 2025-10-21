<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class AudioControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_generate_audio_for_japanese_text()
    {
        $response = $this->postJson('/api/audio/generate', [
            'text' => 'こんにちは',
            'type' => 'vocabulary'
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'text',
                    'type',
                    'pronunciation_guide',
                    'audio_url',
                    'tts_available',
                    'message'
                ]);
    }

    /** @test */
    public function it_requires_text_parameter()
    {
        $response = $this->postJson('/api/audio/generate', [
            'type' => 'vocabulary'
        ]);

        $response->assertStatus(400)
                ->assertJson([
                    'error' => 'Text is required'
                ]);
    }

    /** @test */
    public function it_handles_different_text_types()
    {
        $types = ['hiragana', 'katakana', 'vocabulary', 'kanji'];
        
        foreach ($types as $type) {
            $response = $this->postJson('/api/audio/generate', [
                'text' => 'テスト',
                'type' => $type
            ]);

            $response->assertStatus(200)
                    ->assertJson([
                        'text' => 'テスト',
                        'type' => $type
                    ]);
        }
    }

    /** @test */
    public function it_returns_pronunciation_guide()
    {
        $response = $this->postJson('/api/audio/generate', [
            'text' => 'こんにちは',
            'type' => 'vocabulary'
        ]);

        $response->assertStatus(200);
        
        $data = $response->json();
        $this->assertArrayHasKey('pronunciation_guide', $data);
        $this->assertIsString($data['pronunciation_guide']);
    }

    /** @test */
    public function it_handles_long_text()
    {
        $longText = 'これは長い日本語のテキストです。音声生成のテストを行います。';
        
        $response = $this->postJson('/api/audio/generate', [
            'text' => $longText,
            'type' => 'sentence'
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'text' => $longText,
                    'type' => 'sentence'
                ]);
    }

    /** @test */
    public function it_handles_special_characters()
    {
        $specialText = 'ひらがな・カタカナ・漢字';
        
        $response = $this->postJson('/api/audio/generate', [
            'text' => $specialText,
            'type' => 'vocabulary'
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'text' => $specialText
                ]);
    }
}
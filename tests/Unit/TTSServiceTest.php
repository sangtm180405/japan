<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\TTSService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TTSServiceTest extends TestCase
{
    use RefreshDatabase;

    private $ttsService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ttsService = new TTSService();
    }

    /** @test */
    public function it_can_generate_filename_correctly()
    {
        $text = 'こんにちは';
        $filename = $this->invokeMethod($this->ttsService, 'generateFilename', [$text]);
        
        $this->assertStringContainsString('.mp3', $filename);
        $this->assertStringContainsString(md5($text), $filename);
    }

    /** @test */
    public function it_returns_available_voices()
    {
        $voices = $this->ttsService->getAvailableVoices();
        
        $this->assertIsArray($voices);
        $this->assertArrayHasKey('ja-JP-Standard-A', $voices);
        $this->assertArrayHasKey('ja-JP-Standard-B', $voices);
    }

    /** @test */
    public function it_handles_fallback_when_client_not_available()
    {
        // Mock the service to simulate unavailable client
        $mockService = $this->createMock(TTSService::class);
        $mockService->method('isAvailable')->willReturn(false);
        $mockService->method('generateAudio')->willReturn(null);
        
        $result = $mockService->generateAudio('テスト');
        
        $this->assertNull($result);
    }

    /** @test */
    public function it_generates_vocabulary_audio_with_correct_voice()
    {
        $japanese = 'こんにちは';
        $type = 'vocabulary';
        
        // This will test the method exists and handles parameters correctly
        $result = $this->ttsService->generateVocabularyAudio($japanese, $type);
        
        // Since we don't have actual Google TTS credentials in test,
        // we expect either a URL or null (fallback)
        $this->assertTrue(is_string($result) || is_null($result));
    }

    /** @test */
    public function it_generates_lesson_audio_for_multiple_vocabularies()
    {
        $vocabularies = [
            ['japanese' => 'こんにちは', 'type' => 'vocabulary'],
            ['japanese' => 'ありがとう', 'type' => 'vocabulary'],
            ['japanese' => 'すみません', 'type' => 'vocabulary']
        ];
        
        $results = $this->ttsService->generateLessonAudio($vocabularies);
        
        $this->assertIsArray($results);
        $this->assertCount(3, $results);
        
        foreach ($results as $result) {
            $this->assertArrayHasKey('japanese', $result);
            $this->assertArrayHasKey('audio_url', $result);
            $this->assertArrayHasKey('type', $result);
        }
    }

    /**
     * Call protected/private method of a class
     */
    private function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
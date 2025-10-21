<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class AudioGeneratorController extends Controller
{
    /**
     * Generate audio files for Japanese characters
     */
    public function generateAudioFiles()
    {
        $results = [];
        
        // Generate Hiragana audio files
        $hiraganaChars = ['あ', 'い', 'う', 'え', 'お', 'か', 'き', 'く', 'け', 'こ'];
        foreach ($hiraganaChars as $char) {
            $results[] = $this->createAudioFile($char, 'hiragana');
        }
        
        // Generate Katakana audio files
        $katakanaChars = ['ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ'];
        foreach ($katakanaChars as $char) {
            $results[] = $this->createAudioFile($char, 'katakana');
        }
        
        // Generate vocabulary audio files
        $vocabularies = ['こんにちは', 'ありがとう', 'すみません', 'はい', 'いいえ'];
        foreach ($vocabularies as $vocab) {
            $results[] = $this->createAudioFile($vocab, 'vocabulary');
        }
        
        return response()->json([
            'message' => 'Audio files generated successfully',
            'results' => $results,
            'total' => count($results)
        ]);
    }
    
    /**
     * Create a placeholder audio file
     */
    private function createAudioFile($text, $type)
    {
        $filename = $text . '.mp3';
        $directory = "audio/{$type}";
        $path = "{$directory}/{$filename}";
        
        // Create directory if it doesn't exist
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }
        
        // Create a simple audio file (silent MP3)
        $audioData = $this->generateSilentMp3($text);
        
        // Save the file
        Storage::disk('public')->put($path, $audioData);
        
        return [
            'character' => $text,
            'type' => $type,
            'filename' => $filename,
            'path' => $path,
            'url' => Storage::url($path),
            'size' => strlen($audioData)
        ];
    }
    
    /**
     * Generate a silent MP3 file with metadata
     */
    private function generateSilentMp3($text)
    {
        // This is a minimal MP3 header for a silent audio file
        // In a real implementation, you would use a proper audio generation library
        $mp3Header = "\xFF\xFB\x90\x00"; // MP3 frame header
        $silentData = str_repeat("\x00", 1000); // Silent audio data
        
        // Add text as metadata (this won't be playable, just for demo)
        $metadata = "TEXT:{$text}";
        
        return $mp3Header . $silentData . $metadata;
    }
    
    /**
     * Download audio file
     */
    public function downloadAudio($type, $filename)
    {
        $path = "audio/{$type}/{$filename}";
        
        if (!Storage::disk('public')->exists($path)) {
            return response()->json(['error' => 'Audio file not found'], 404);
        }
        
        $file = Storage::disk('public')->get($path);
        
        return response($file, 200, [
            'Content-Type' => 'audio/mpeg',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
            'Content-Length' => strlen($file)
        ]);
    }
    
    /**
     * List all audio files
     */
    public function listAudioFiles()
    {
        $audioFiles = [];
        
        $types = ['hiragana', 'katakana', 'vocabulary'];
        
        foreach ($types as $type) {
            $directory = "audio/{$type}";
            if (Storage::disk('public')->exists($directory)) {
                $files = Storage::disk('public')->files($directory);
                foreach ($files as $file) {
                    $filename = basename($file);
                    $audioFiles[] = [
                        'type' => $type,
                        'filename' => $filename,
                        'character' => pathinfo($filename, PATHINFO_FILENAME),
                        'url' => Storage::url($file),
                        'size' => Storage::disk('public')->size($file)
                    ];
                }
            }
        }
        
        return response()->json([
            'audio_files' => $audioFiles,
            'total' => count($audioFiles)
        ]);
    }
}
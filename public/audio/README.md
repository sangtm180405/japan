# Audio Files for Japanese Learning App

This directory contains audio files for Japanese pronunciation.

## Directory Structure

```
audio/
├── hiragana/          # Hiragana character pronunciations
├── katakana/          # Katakana character pronunciations
├── vocabulary/        # Vocabulary pronunciations
└── README.md         # This file
```

## File Naming Convention

- **Hiragana**: `あ.mp3`, `い.mp3`, `う.mp3`, etc.
- **Katakana**: `ア.mp3`, `イ.mp3`, `ウ.mp3`, etc.
- **Vocabulary**: Use the Japanese text as filename, e.g., `こんにちは.mp3`

## Audio Requirements

- **Format**: MP3
- **Quality**: 44.1kHz, 16-bit
- **Duration**: 1-3 seconds per character/word
- **Voice**: Native Japanese speaker preferred

## Adding Audio Files

1. Record or obtain audio files for Japanese characters/words
2. Save them in the appropriate directory with the correct filename
3. Ensure the filename matches the Japanese character exactly
4. Test the audio playback in the application

## Fallback

If audio files are not available, the application will use:
1. Text-to-Speech (TTS) with Japanese voice
2. Pronunciation guide text
3. Error notification

## Current Status

- Audio directories created ✅
- Audio player JavaScript implemented ✅
- TTS fallback implemented ✅
- Ready for audio file uploads ⏳

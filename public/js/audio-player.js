/**
 * Japanese Learning App - Audio Player
 * Handles pronunciation and audio playback for Japanese characters and vocabulary
 */

class JapaneseAudioPlayer {
    constructor() {
        this.audioContext = null;
        this.isInitialized = false;
        this.audioCache = new Map();
        this.init();
    }

    async init() {
        try {
            // Initialize Web Audio API
            this.audioContext = new (window.AudioContext || window.webkitAudioContext)();
            this.isInitialized = true;
            console.log('Audio player initialized successfully');
        } catch (error) {
            console.error('Failed to initialize audio player:', error);
            this.fallbackToTextToSpeech();
        }
    }

    /**
     * Play pronunciation for Japanese characters
     */
    async playCharacter(character, type = 'hiragana') {
        if (!this.isInitialized) {
            await this.init();
        }

        try {
            // Try to play from audio files first
            const audioFile = await this.getAudioFile(character, type);
            if (audioFile) {
                await this.playAudioFile(audioFile);
                return;
            }

            // Fallback to text-to-speech
            await this.playTextToSpeech(character, type);
        } catch (error) {
            console.error('Error playing character:', error);
            this.showAudioError(character);
        }
    }

    /**
     * Play pronunciation for vocabulary
     */
    async playVocabulary(vocabulary, audioFile = null) {
        if (!this.isInitialized) {
            await this.init();
        }

        try {
            // Try to play from audio file if provided
            if (audioFile) {
                await this.playAudioFile(audioFile);
                return;
            }

            // Fallback to text-to-speech
            await this.playTextToSpeech(vocabulary.japanese || vocabulary, 'vocabulary');
        } catch (error) {
            console.error('Error playing vocabulary:', error);
            this.showAudioError(vocabulary);
        }
    }

    /**
     * Get audio file path for character
     */
    async getAudioFile(character, type) {
        const cacheKey = `${type}_${character}`;
        
        if (this.audioCache.has(cacheKey)) {
            return this.audioCache.get(cacheKey);
        }

        // Try to find audio file in public/audio directory
        const audioPath = `/audio/${type}/${character}.mp3`;
        
        try {
            const response = await fetch(audioPath, { method: 'HEAD' });
            if (response.ok) {
                this.audioCache.set(cacheKey, audioPath);
                return audioPath;
            }
        } catch (error) {
            console.log(`Audio file not found: ${audioPath}`);
        }

        return null;
    }

    /**
     * Play audio file
     */
    async playAudioFile(audioPath) {
        return new Promise((resolve, reject) => {
            const audio = new Audio(audioPath);
            
            audio.onloadeddata = () => {
                audio.play()
                    .then(() => {
                        console.log(`Playing audio: ${audioPath}`);
                        resolve();
                    })
                    .catch(reject);
            };

            audio.onerror = (error) => {
                console.error(`Error loading audio: ${audioPath}`, error);
                reject(error);
            };

            audio.onended = () => {
                resolve();
            };
        });
    }

    /**
     * Play text-to-speech with enhanced Japanese support
     */
    async playTextToSpeech(text, type = 'vocabulary') {
        if (!('speechSynthesis' in window)) {
            throw new Error('Speech synthesis not supported');
        }

        return new Promise((resolve, reject) => {
            // Cancel any ongoing speech
            speechSynthesis.cancel();

            const utterance = new SpeechSynthesisUtterance(text);
            
            // Configure voice settings based on type
            utterance.lang = 'ja-JP';
            utterance.rate = this.getRateForType(type);
            utterance.pitch = this.getPitchForType(type);
            utterance.volume = 0.8;

            // Try to find Japanese voice
            const voices = speechSynthesis.getVoices();
            const japaneseVoice = voices.find(voice => 
                voice.lang.startsWith('ja') || 
                voice.name.includes('Japanese') ||
                voice.name.includes('ja')
            );

            if (japaneseVoice) {
                utterance.voice = japaneseVoice;
            }

            utterance.onend = () => {
                console.log(`TTS completed: ${text} (${type})`);
                resolve();
            };

            utterance.onerror = (error) => {
                console.error('TTS error:', error);
                reject(error);
            };

            speechSynthesis.speak(utterance);
        });
    }

    /**
     * Get speaking rate based on type
     */
    getRateForType(type) {
        const rates = {
            'hiragana': 0.7,
            'katakana': 0.7,
            'vocabulary': 0.8,
            'kanji': 0.9,
            'sentence': 0.8
        };
        return rates[type] || 0.8;
    }

    /**
     * Get pitch based on type
     */
    getPitchForType(type) {
        const pitches = {
            'hiragana': 1.2,
            'katakana': 1.2,
            'vocabulary': 1.0,
            'kanji': 0.9,
            'sentence': 1.0
        };
        return pitches[type] || 1.0;
    }

    /**
     * Fallback to text-to-speech if Web Audio API fails
     */
    fallbackToTextToSpeech() {
        console.log('Using text-to-speech fallback');
        this.isInitialized = true;
    }

    /**
     * Show audio error message
     */
    showAudioError(text) {
        // Create a temporary notification
        const notification = document.createElement('div');
        notification.className = 'alert alert-warning position-fixed';
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            <i class="fas fa-exclamation-triangle me-2"></i>
            Không thể phát âm thanh cho: <strong>${text}</strong>
        `;

        document.body.appendChild(notification);

        // Remove notification after 3 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 3000);
    }

    /**
     * Get pronunciation guide for character
     */
    getPronunciationGuide(character, type) {
        const guides = {
            'hiragana': {
                'あ': 'a (như "a" trong "ba")',
                'い': 'i (như "i" trong "bi")',
                'う': 'u (như "u" trong "bu")',
                'え': 'e (như "e" trong "be")',
                'お': 'o (như "o" trong "bo")',
                'か': 'ka (như "ca" trong "cá")',
                'き': 'ki (như "ki" trong "kính")',
                'く': 'ku (như "ku" trong "khu")',
                'け': 'ke (như "ke" trong "kẻ")',
                'こ': 'ko (như "ko" trong "kho")',
            },
            'katakana': {
                'ア': 'a (như "a" trong "ba")',
                'イ': 'i (như "i" trong "bi")',
                'ウ': 'u (như "u" trong "bu")',
                'エ': 'e (như "e" trong "be")',
                'オ': 'o (như "o" trong "bo")',
                'カ': 'ka (như "ca" trong "cá")',
                'キ': 'ki (như "ki" trong "kính")',
                'ク': 'ku (như "ku" trong "khu")',
                'ケ': 'ke (như "ke" trong "kẻ")',
                'コ': 'ko (như "ko" trong "kho")',
            }
        };

        return guides[type]?.[character] || `${character} - Phát âm tiếng Nhật`;
    }
}

// Initialize global audio player
window.japaneseAudioPlayer = new JapaneseAudioPlayer();

// Utility functions for easy use
window.playCharacterAudio = function(character, type = 'hiragana') {
    return window.japaneseAudioPlayer.playCharacter(character, type);
};

window.playVocabularyAudio = function(vocabulary, audioFile = null) {
    return window.japaneseAudioPlayer.playVocabulary(vocabulary, audioFile);
};

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Load voices for TTS
    if ('speechSynthesis' in window) {
        speechSynthesis.getVoices();
        
        // Some browsers need this event to load voices
        speechSynthesis.addEventListener('voiceschanged', function() {
            console.log('Voices loaded:', speechSynthesis.getVoices().length);
        });
    }
});

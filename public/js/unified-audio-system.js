// Unified Audio System - Combines all audio functionality
class UnifiedAudioSystem {
    constructor() {
        this.audioPlayer = null;
        this.ttsSystem = null;
        this.visualizer = null;
        this.isInitialized = false;
        this.audioCache = new Map();
        this.preloadQueue = [];
        this.init();
    }

    async init() {
        try {
            // Initialize components
            this.audioPlayer = window.enhancedPlayer;
            this.ttsSystem = window.enhancedTTS;
            this.visualizer = window.audioVisualizer;
            
            // Setup event listeners
            this.setupEventListeners();
            
            // Preload common audio files
            await this.preloadCommonAudio();
            
            this.isInitialized = true;
            console.log('Unified Audio System initialized');
        } catch (error) {
            console.error('Failed to initialize Unified Audio System:', error);
        }
    }

    setupEventListeners() {
        // Listen for audio requests
        document.addEventListener('click', (e) => {
            if (e.target.closest('.play-audio')) {
                this.handleAudioRequest(e.target.closest('.play-audio'));
            }
        });

        // Listen for TTS requests
        document.addEventListener('click', (e) => {
            if (e.target.closest('.play-tts')) {
                this.handleTTSRequest(e.target.closest('.play-tts'));
            }
        });
    }

    async handleAudioRequest(button) {
        const character = button.getAttribute('data-character');
        const type = button.getAttribute('data-type') || 'hiragana';
        const title = button.getAttribute('data-title') || character;

        // Show loading state
        this.showLoadingState(button);

        try {
            // Try to play audio file first
            const audioPath = await this.getAudioPath(character, type);
            if (audioPath) {
                await this.playAudioFile(audioPath, title);
            } else {
                // Fallback to TTS
                await this.playTTS(character, type);
            }
        } catch (error) {
            console.error('Audio playback error:', error);
            this.showError(button, error.message);
        } finally {
            this.hideLoadingState(button);
        }
    }

    async handleTTSRequest(button) {
        const text = button.getAttribute('data-text');
        const type = button.getAttribute('data-type') || 'vocabulary';

        this.showLoadingState(button);

        try {
            await this.playTTS(text, type);
        } catch (error) {
            console.error('TTS error:', error);
            this.showError(button, error.message);
        } finally {
            this.hideLoadingState(button);
        }
    }

    async getAudioPath(character, type) {
        const cacheKey = `${type}_${character}`;
        
        if (this.audioCache.has(cacheKey)) {
            return this.audioCache.get(cacheKey);
        }

        const audioPath = `/audio/${type}/${character}.mp3`;
        
        try {
            const response = await fetch(audioPath, { method: 'HEAD' });
            if (response.ok) {
                this.audioCache.set(cacheKey, audioPath);
                return audioPath;
            }
        } catch (error) {
            // Silently handle missing audio files - this is expected
            // Audio files don't exist, will use TTS fallback instead
            // No need to log 404 errors as they're expected
        }

        return null;
    }

    async playAudioFile(audioPath, title) {
        if (this.audioPlayer) {
            await this.audioPlayer.playAudio(audioPath, title);
            
            // Connect to visualizer if available
            if (this.visualizer && this.audioPlayer.audioElement) {
                this.visualizer.connectAudio(this.audioPlayer.audioElement);
            }
        }
    }

    async playTTS(text, type) {
        if (this.ttsSystem) {
            await this.ttsSystem.speakCharacter(text, type);
        }
    }

    async preloadCommonAudio() {
        console.log('🎵 Audio preloading disabled - using TTS fallback only');
        
        // Skip preloading completely to prevent 404 errors
        // Audio files don't exist, TTS fallback works perfectly
        return;
        
        // Original preloading code commented out
        /*
        const commonCharacters = {
            hiragana: ['あ', 'い', 'う', 'え', 'お', 'か', 'き', 'く', 'け', 'こ'],
            katakana: ['ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ'],
            vocabulary: ['こんにちは', 'ありがとう', 'すみません', 'はい', 'いいえ']
        };

        for (const [type, characters] of Object.entries(commonCharacters)) {
            for (const character of characters) {
                const audioPath = await this.getAudioPath(character, type);
                if (audioPath) {
                    this.preloadQueue.push(audioPath);
                }
            }
        }

        // Preload audio files
        await this.preloadAudioFiles();
        */
    }

    async preloadAudioFiles() {
        const preloadPromises = this.preloadQueue.map(audioPath => {
            return new Promise((resolve) => {
                const audio = new Audio(audioPath);
                audio.preload = 'auto';
                audio.oncanplaythrough = () => resolve();
                audio.onerror = () => resolve(); // Continue even if error
            });
        });

        await Promise.all(preloadPromises);
        console.log(`Preloaded ${this.preloadQueue.length} audio files`);
    }

    showLoadingState(button) {
        const originalHTML = button.innerHTML;
        button.setAttribute('data-original-html', originalHTML);
        button.innerHTML = '<span class="audio-loading"></span> Đang phát...';
        button.disabled = true;
    }

    hideLoadingState(button) {
        const originalHTML = button.getAttribute('data-original-html');
        if (originalHTML) {
            button.innerHTML = originalHTML;
            button.removeAttribute('data-original-html');
        }
        button.disabled = false;
    }

    showError(button, message) {
        const notification = document.createElement('div');
        notification.className = 'alert alert-warning position-fixed';
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Lỗi phát audio:</strong> ${message}
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 3000);
    }

    // Public API methods
    async playCharacter(character, type = 'hiragana') {
        const audioPath = await this.getAudioPath(character, type);
        if (audioPath) {
            await this.playAudioFile(audioPath, character);
        } else {
            await this.playTTS(character, type);
        }
    }

    async playVocabulary(vocabulary) {
        await this.playTTS(vocabulary, 'vocabulary');
    }

    async playSentence(sentence) {
        await this.playTTS(sentence, 'sentence');
    }

    // Settings management
    setVolume(volume) {
        if (this.audioPlayer) {
            this.audioPlayer.setVolume(volume);
        }
        if (this.ttsSystem) {
            this.ttsSystem.setVolume(volume);
        }
    }

    setSpeed(speed) {
        if (this.audioPlayer) {
            this.audioPlayer.setSpeed(speed);
        }
        if (this.ttsSystem) {
            this.ttsSystem.setRate(speed);
        }
    }

    setVoice(voiceIndex) {
        if (this.ttsSystem) {
            this.ttsSystem.selectedVoice = this.ttsSystem.voices[voiceIndex];
        }
    }

    // Utility methods
    getAvailableVoices() {
        return this.ttsSystem ? this.ttsSystem.getVoices() : [];
    }

    getSettings() {
        return {
            audioPlayer: this.audioPlayer ? this.audioPlayer.getSettings() : null,
            tts: this.ttsSystem ? this.ttsSystem.getSettings() : null
        };
    }

    toggleVisualization() {
        if (this.visualizer) {
            this.visualizer.toggleVisualization();
        }
    }

    stopAll() {
        if (this.audioPlayer) {
            this.audioPlayer.stop();
        }
        if (this.ttsSystem) {
            this.ttsSystem.stop();
        }
    }
}

// Initialize unified audio system
document.addEventListener('DOMContentLoaded', () => {
    window.unifiedAudio = new UnifiedAudioSystem();
});

// Global utility functions
window.playCharacterAudio = function(character, type = 'hiragana') {
    return window.unifiedAudio.playCharacter(character, type);
};

window.playVocabularyAudio = function(vocabulary) {
    return window.unifiedAudio.playVocabulary(vocabulary);
};

window.playSentenceAudio = function(sentence) {
    return window.unifiedAudio.playSentence(sentence);
};

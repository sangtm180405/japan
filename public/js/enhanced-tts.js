// Enhanced TTS System
class EnhancedTTSSystem {
    constructor() {
        this.currentUtterance = null;
        this.isPlaying = false;
        this.voices = [];
        this.selectedVoice = null;
        this.settings = {
            rate: 0.8,
            pitch: 1.0,
            volume: 1.0,
            lang: 'ja-JP'
        };
        this.init();
    }

    async init() {
        await this.loadVoices();
        this.setupVoiceSelection();
    }

    async loadVoices() {
        return new Promise((resolve) => {
            if ('speechSynthesis' in window) {
                // Load voices
                this.voices = speechSynthesis.getVoices();
                
                if (this.voices.length === 0) {
                    // Some browsers need this event
                    speechSynthesis.addEventListener('voiceschanged', () => {
                        this.voices = speechSynthesis.getVoices();
                        this.selectBestJapaneseVoice();
                        resolve();
                    });
                } else {
                    this.selectBestJapaneseVoice();
                    resolve();
                }
            } else {
                resolve();
            }
        });
    }

    selectBestJapaneseVoice() {
        // Priority order for Japanese voices
        const voicePriority = [
            'ja-JP', 'ja', 'Japanese',
            'Yuki', 'Kyoko', 'Sayaka',
            'Microsoft Haruka', 'Microsoft Ichiro'
        ];

        for (const priority of voicePriority) {
            const voice = this.voices.find(v => 
                v.lang.includes(priority) || 
                v.name.includes(priority)
            );
            if (voice) {
                this.selectedVoice = voice;
                console.log('Selected Japanese voice:', voice.name);
                break;
            }
        }
    }

    setupVoiceSelection() {
        // Create voice selector if not exists
        if (!document.querySelector('.voice-selector')) {
            const voiceSelector = document.createElement('select');
            voiceSelector.className = 'voice-selector';
            voiceSelector.innerHTML = '<option value="">Auto-select</option>';
            
            this.voices.forEach((voice, index) => {
                const option = document.createElement('option');
                option.value = index;
                option.textContent = `${voice.name} (${voice.lang})`;
                if (voice === this.selectedVoice) {
                    option.selected = true;
                }
                voiceSelector.appendChild(option);
            });

            voiceSelector.addEventListener('change', (e) => {
                if (e.target.value) {
                    this.selectedVoice = this.voices[e.target.value];
                } else {
                    this.selectBestJapaneseVoice();
                }
            });

            // Add to audio controls if exists
            const controls = document.querySelector('.enhanced-audio-controls');
            if (controls) {
                controls.querySelector('.speed-container').after(voiceSelector);
            }
        }
    }

    async speak(text, options = {}) {
        if (!('speechSynthesis' in window)) {
            throw new Error('Speech synthesis not supported');
        }

        return new Promise((resolve, reject) => {
            // Cancel any ongoing speech
            this.stop();

            const utterance = new SpeechSynthesisUtterance(text);
            
            // Apply settings
            utterance.lang = options.lang || this.settings.lang;
            utterance.rate = options.rate || this.settings.rate;
            utterance.pitch = options.pitch || this.settings.pitch;
            utterance.volume = options.volume || this.settings.volume;

            // Use selected voice
            if (this.selectedVoice) {
                utterance.voice = this.selectedVoice;
            }

            // Event handlers
            utterance.onstart = () => {
                this.isPlaying = true;
                this.updatePlayPauseButton();
                console.log('TTS started:', text);
            };

            utterance.onend = () => {
                this.isPlaying = false;
                this.currentUtterance = null;
                this.updatePlayPauseButton();
                console.log('TTS ended');
                resolve();
            };

            utterance.onerror = (event) => {
                this.isPlaying = false;
                this.currentUtterance = null;
                this.updatePlayPauseButton();
                console.error('TTS error:', event.error);
                reject(new Error(event.error));
            };

            utterance.onpause = () => {
                this.isPlaying = false;
                this.updatePlayPauseButton();
            };

            utterance.onresume = () => {
                this.isPlaying = true;
                this.updatePlayPauseButton();
            };

            this.currentUtterance = utterance;
            speechSynthesis.speak(utterance);
        });
    }

    pause() {
        if (this.isPlaying && speechSynthesis.speaking) {
            speechSynthesis.pause();
        }
    }

    resume() {
        if (speechSynthesis.paused) {
            speechSynthesis.resume();
        }
    }

    stop() {
        speechSynthesis.cancel();
        this.isPlaying = false;
        this.currentUtterance = null;
        this.updatePlayPauseButton();
    }

    setRate(rate) {
        this.settings.rate = parseFloat(rate);
        if (this.currentUtterance) {
            this.currentUtterance.rate = this.settings.rate;
        }
    }

    setPitch(pitch) {
        this.settings.pitch = parseFloat(pitch);
        if (this.currentUtterance) {
            this.currentUtterance.pitch = this.settings.pitch;
        }
    }

    setVolume(volume) {
        this.settings.volume = parseFloat(volume);
        if (this.currentUtterance) {
            this.currentUtterance.volume = this.settings.volume;
        }
    }

    updatePlayPauseButton() {
        // Update TTS-specific play/pause buttons
        const ttsButtons = document.querySelectorAll('.tts-play-btn, .tts-pause-btn');
        ttsButtons.forEach(btn => {
            if (this.isPlaying) {
                btn.querySelector('.play-icon')?.classList.add('d-none');
                btn.querySelector('.pause-icon')?.classList.remove('d-none');
            } else {
                btn.querySelector('.play-icon')?.classList.remove('d-none');
                btn.querySelector('.pause-icon')?.classList.add('d-none');
            }
        });
    }

    // Enhanced pronunciation for different character types
    async speakCharacter(character, type = 'hiragana') {
        const settings = this.getSettingsForType(type);
        return this.speak(character, settings);
    }

    async speakVocabulary(vocabulary) {
        const settings = this.getSettingsForType('vocabulary');
        return this.speak(vocabulary, settings);
    }

    async speakSentence(sentence) {
        const settings = this.getSettingsForType('sentence');
        return this.speak(sentence, settings);
    }

    getSettingsForType(type) {
        const typeSettings = {
            'hiragana': { rate: 0.7, pitch: 1.2 },
            'katakana': { rate: 0.7, pitch: 1.2 },
            'kanji': { rate: 0.9, pitch: 0.9 },
            'vocabulary': { rate: 0.8, pitch: 1.0 },
            'sentence': { rate: 0.8, pitch: 1.0 }
        };
        
        return { ...this.settings, ...typeSettings[type] };
    }

    // Get available voices
    getVoices() {
        return this.voices;
    }

    // Get current settings
    getSettings() {
        return { ...this.settings };
    }
}

// Initialize enhanced TTS
window.enhancedTTS = new EnhancedTTSSystem();

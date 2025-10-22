// Enhanced Audio Controls Component
class EnhancedAudioPlayer {
    constructor() {
        this.audioElement = null;
        this.isPlaying = false;
        this.currentAudio = null;
        this.volume = 0.8;
        this.playbackRate = 1.0;
        this.init();
    }

    init() {
        this.createAudioControls();
        this.setupEventListeners();
    }

    createAudioControls() {
        const controlsHTML = `
            <div class="enhanced-audio-controls" style="display: none;">
                <div class="audio-player">
                    <div class="audio-info">
                        <span class="audio-title">Đang phát...</span>
                        <span class="audio-time">0:00 / 0:00</span>
                    </div>
                    
                    <div class="audio-controls">
                        <button class="btn-audio btn-play" onclick="enhancedPlayer.play()">
                            <i class="fas fa-play"></i>
                        </button>
                        <button class="btn-audio btn-pause" onclick="enhancedPlayer.pause()" style="display: none;">
                            <i class="fas fa-pause"></i>
                        </button>
                        <button class="btn-audio btn-stop" onclick="enhancedPlayer.stop()">
                            <i class="fas fa-stop"></i>
                        </button>
                        
                        <div class="progress-container">
                            <div class="progress-bar" onclick="enhancedPlayer.seek(event)">
                                <div class="progress-fill"></div>
                            </div>
                        </div>
                        
                        <div class="volume-container">
                            <button class="btn-volume" onclick="enhancedPlayer.toggleMute()">
                                <i class="fas fa-volume-up"></i>
                            </button>
                            <input type="range" class="volume-slider" min="0" max="1" step="0.1" 
                                   value="0.8" onchange="enhancedPlayer.setVolume(this.value)">
                        </div>
                        
                        <div class="speed-container">
                            <select class="speed-selector" onchange="enhancedPlayer.setSpeed(this.value)">
                                <option value="0.5">0.5x</option>
                                <option value="0.75">0.75x</option>
                                <option value="1" selected>1x</option>
                                <option value="1.25">1.25x</option>
                                <option value="1.5">1.5x</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', controlsHTML);
    }

    async playAudio(audioPath, title = 'Audio') {
        try {
            // Hide TTS controls, show enhanced controls
            this.showEnhancedControls();
            
            // Create audio element
            this.audioElement = new Audio(audioPath);
            this.audioElement.volume = this.volume;
            this.audioElement.playbackRate = this.playbackRate;
            
            // Update title
            document.querySelector('.audio-title').textContent = title;
            
            // Setup event listeners
            this.setupAudioEvents();
            
            // Play audio
            await this.audioElement.play();
            this.isPlaying = true;
            this.updatePlayPauseButton();
            
        } catch (error) {
            console.error('Error playing audio:', error);
            this.fallbackToTTS(title);
        }
    }

    setupAudioEvents() {
        if (!this.audioElement) return;

        this.audioElement.addEventListener('timeupdate', () => {
            this.updateProgress();
            this.updateTimeDisplay();
        });

        this.audioElement.addEventListener('ended', () => {
            this.isPlaying = false;
            this.updatePlayPauseButton();
            this.resetProgress();
        });

        this.audioElement.addEventListener('error', (error) => {
            console.error('Audio error:', error);
            this.fallbackToTTS();
        });
    }

    updateProgress() {
        if (!this.audioElement) return;
        
        const progress = (this.audioElement.currentTime / this.audioElement.duration) * 100;
        document.querySelector('.progress-fill').style.width = progress + '%';
    }

    updateTimeDisplay() {
        if (!this.audioElement) return;
        
        const current = this.formatTime(this.audioElement.currentTime);
        const duration = this.formatTime(this.audioElement.duration);
        document.querySelector('.audio-time').textContent = `${current} / ${duration}`;
    }

    formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs.toString().padStart(2, '0')}`;
    }

    play() {
        if (this.audioElement) {
            this.audioElement.play();
            this.isPlaying = true;
            this.updatePlayPauseButton();
        }
    }

    pause() {
        if (this.audioElement) {
            this.audioElement.pause();
            this.isPlaying = false;
            this.updatePlayPauseButton();
        }
    }

    stop() {
        if (this.audioElement) {
            this.audioElement.pause();
            this.audioElement.currentTime = 0;
            this.isPlaying = false;
            this.updatePlayPauseButton();
            this.resetProgress();
        }
    }

    seek(event) {
        if (!this.audioElement) return;
        
        const progressBar = event.currentTarget;
        const rect = progressBar.getBoundingClientRect();
        const clickX = event.clientX - rect.left;
        const percentage = clickX / rect.width;
        const newTime = percentage * this.audioElement.duration;
        
        this.audioElement.currentTime = newTime;
    }

    setVolume(volume) {
        this.volume = parseFloat(volume);
        if (this.audioElement) {
            this.audioElement.volume = this.volume;
        }
        
        // Update volume icon
        const icon = document.querySelector('.btn-volume i');
        if (this.volume === 0) {
            icon.className = 'fas fa-volume-mute';
        } else if (this.volume < 0.5) {
            icon.className = 'fas fa-volume-down';
        } else {
            icon.className = 'fas fa-volume-up';
        }
    }

    setSpeed(speed) {
        this.playbackRate = parseFloat(speed);
        if (this.audioElement) {
            this.audioElement.playbackRate = this.playbackRate;
        }
    }

    toggleMute() {
        if (this.audioElement) {
            this.audioElement.muted = !this.audioElement.muted;
            const icon = document.querySelector('.btn-volume i');
            icon.className = this.audioElement.muted ? 'fas fa-volume-mute' : 'fas fa-volume-up';
        }
    }

    updatePlayPauseButton() {
        const playBtn = document.querySelector('.btn-play');
        const pauseBtn = document.querySelector('.btn-pause');
        
        if (this.isPlaying) {
            playBtn.style.display = 'none';
            pauseBtn.style.display = 'inline-block';
        } else {
            playBtn.style.display = 'inline-block';
            pauseBtn.style.display = 'none';
        }
    }

    resetProgress() {
        document.querySelector('.progress-fill').style.width = '0%';
        document.querySelector('.audio-time').textContent = '0:00 / 0:00';
    }

    showEnhancedControls() {
        document.querySelector('.enhanced-audio-controls').style.display = 'block';
    }

    hideEnhancedControls() {
        document.querySelector('.enhanced-audio-controls').style.display = 'none';
    }

    fallbackToTTS(text) {
        console.log('Falling back to TTS');
        // Use existing TTS functionality
        if (window.playCharacterAudio) {
            window.playCharacterAudio(text);
        }
    }
}

// Initialize enhanced player
window.enhancedPlayer = new EnhancedAudioPlayer();

// Audio Visualization Component
class AudioVisualizer {
    constructor() {
        this.canvas = null;
        this.ctx = null;
        this.audioContext = null;
        this.analyser = null;
        this.dataArray = null;
        this.animationId = null;
        this.isVisualizing = false;
        this.init();
    }

    init() {
        this.createCanvas();
        this.setupAudioContext();
    }

    createCanvas() {
        const canvasHTML = `
            <div class="audio-visualizer" style="display: none;">
                <canvas id="audioCanvas" width="300" height="100"></canvas>
                <div class="visualizer-controls">
                    <button class="btn btn-sm btn-outline-primary" onclick="audioVisualizer.toggleVisualization()">
                        <i class="fas fa-eye"></i> Toggle Visualization
                    </button>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', canvasHTML);
        this.canvas = document.getElementById('audioCanvas');
        this.ctx = this.canvas.getContext('2d');
    }

    async setupAudioContext() {
        try {
            this.audioContext = new (window.AudioContext || window.webkitAudioContext)();
            this.analyser = this.audioContext.createAnalyser();
            this.analyser.fftSize = 256;
            
            const bufferLength = this.analyser.frequencyBinCount;
            this.dataArray = new Uint8Array(bufferLength);
            
            console.log('Audio visualizer initialized');
        } catch (error) {
            console.error('Failed to initialize audio visualizer:', error);
        }
    }

    connectAudio(audioElement) {
        if (!this.audioContext || !this.analyser) return;
        
        try {
            const source = this.audioContext.createMediaElementSource(audioElement);
            source.connect(this.analyser);
            this.analyser.connect(this.audioContext.destination);
            
            console.log('Audio connected to visualizer');
        } catch (error) {
            console.error('Failed to connect audio:', error);
        }
    }

    startVisualization() {
        if (this.isVisualizing) return;
        
        this.isVisualizing = true;
        this.draw();
    }

    stopVisualization() {
        this.isVisualizing = false;
        if (this.animationId) {
            cancelAnimationFrame(this.animationId);
        }
        this.clearCanvas();
    }

    draw() {
        if (!this.isVisualizing || !this.analyser) return;
        
        this.animationId = requestAnimationFrame(() => this.draw());
        
        this.analyser.getByteFrequencyData(this.dataArray);
        
        this.clearCanvas();
        this.drawBars();
        this.drawWaveform();
    }

    clearCanvas() {
        this.ctx.fillStyle = '#000';
        this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
    }

    drawBars() {
        const barWidth = (this.canvas.width / this.dataArray.length) * 2.5;
        let barHeight;
        let x = 0;

        for (let i = 0; i < this.dataArray.length; i++) {
            barHeight = (this.dataArray[i] / 255) * this.canvas.height;
            
            // Create gradient
            const gradient = this.ctx.createLinearGradient(0, this.canvas.height, 0, this.canvas.height - barHeight);
            gradient.addColorStop(0, '#4f46e5');
            gradient.addColorStop(1, '#06b6d4');
            
            this.ctx.fillStyle = gradient;
            this.ctx.fillRect(x, this.canvas.height - barHeight, barWidth, barHeight);
            
            x += barWidth + 1;
        }
    }

    drawWaveform() {
        this.ctx.strokeStyle = '#ffffff';
        this.ctx.lineWidth = 2;
        this.ctx.beginPath();
        
        const sliceWidth = this.canvas.width / this.dataArray.length;
        let x = 0;
        
        for (let i = 0; i < this.dataArray.length; i++) {
            const v = this.dataArray[i] / 128.0;
            const y = v * this.canvas.height / 2;
            
            if (i === 0) {
                this.ctx.moveTo(x, y);
            } else {
                this.ctx.lineTo(x, y);
            }
            
            x += sliceWidth;
        }
        
        this.ctx.stroke();
    }

    toggleVisualization() {
        const visualizer = document.querySelector('.audio-visualizer');
        if (visualizer.style.display === 'none') {
            visualizer.style.display = 'block';
            this.startVisualization();
        } else {
            visualizer.style.display = 'none';
            this.stopVisualization();
        }
    }

    showVisualizer() {
        document.querySelector('.audio-visualizer').style.display = 'block';
    }

    hideVisualizer() {
        document.querySelector('.audio-visualizer').style.display = 'none';
        this.stopVisualization();
    }
}

// Initialize audio visualizer
window.audioVisualizer = new AudioVisualizer();

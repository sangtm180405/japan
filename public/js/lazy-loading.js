// Lazy Loading Implementation
class LazyLoader {
    constructor() {
        this.imageObserver = null;
        this.init();
    }

    init() {
        if ('IntersectionObserver' in window) {
            this.imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        this.loadImage(img);
                        observer.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.01
            });

            this.observeImages();
        } else {
            // Fallback for older browsers
            this.loadAllImages();
        }
    }

    observeImages() {
        const lazyImages = document.querySelectorAll('img[data-src]');
        lazyImages.forEach(img => this.imageObserver.observe(img));
    }

    loadImage(img) {
        const src = img.getAttribute('data-src');
        if (src) {
            img.src = src;
            img.classList.remove('lazy');
            img.classList.add('loaded');
            
            // Add fade-in animation
            img.style.opacity = '0';
            img.style.transition = 'opacity 0.3s ease';
            
            img.onload = () => {
                img.style.opacity = '1';
            };
        }
    }

    loadAllImages() {
        const lazyImages = document.querySelectorAll('img[data-src]');
        lazyImages.forEach(img => this.loadImage(img));
    }
}

// Initialize lazy loading when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new LazyLoader();
});

// Progressive Image Loading
class ProgressiveImageLoader {
    constructor() {
        this.images = document.querySelectorAll('.progressive-image');
        this.init();
    }

    init() {
        this.images.forEach(img => {
            this.loadProgressiveImage(img);
        });
    }

    loadProgressiveImage(img) {
        const lowResSrc = img.getAttribute('data-low-res');
        const highResSrc = img.getAttribute('data-high-res');
        
        if (lowResSrc) {
            img.src = lowResSrc;
            img.classList.add('low-res');
        }
        
        if (highResSrc) {
            const highResImg = new Image();
            highResImg.onload = () => {
                img.src = highResSrc;
                img.classList.remove('low-res');
                img.classList.add('high-res');
            };
            highResImg.src = highResSrc;
        }
    }
}

// Initialize progressive loading
document.addEventListener('DOMContentLoaded', () => {
    new ProgressiveImageLoader();
});

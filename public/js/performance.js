// Performance Optimization Scripts
class PerformanceOptimizer {
    constructor() {
        this.init();
    }

    init() {
        this.optimizeImages();
        this.preloadCriticalResources();
        this.optimizeAnimations();
        this.setupIntersectionObserver();
    }

    optimizeImages() {
        // Add loading="lazy" to all images without it
        const images = document.querySelectorAll('img:not([loading])');
        images.forEach(img => {
            img.setAttribute('loading', 'lazy');
        });
    }

    preloadCriticalResources() {
        // Only preload hero assets on pages that actually display the hero
        const hasHeroSection = document.querySelector('.hero-section');
        if (!hasHeroSection) {
            return;
        }

        const criticalImages = [
            '/images/hero-bg.jpg',
            '/images/logo.png'
        ];

        criticalImages.forEach(src => {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.as = 'image';
            link.href = src;
            document.head.appendChild(link);
        });
    }

    optimizeAnimations() {
        // Reduce animations on low-end devices
        if (navigator.hardwareConcurrency && navigator.hardwareConcurrency < 4) {
            document.documentElement.style.setProperty('--animation-duration', '0.1s');
        }

        // Pause animations when tab is not visible
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                document.body.style.animationPlayState = 'paused';
            } else {
                document.body.style.animationPlayState = 'running';
            }
        });
    }

    setupIntersectionObserver() {
        // Lazy load non-critical content
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    
                    // Load background images
                    if (element.dataset.bgImage) {
                        element.style.backgroundImage = `url(${element.dataset.bgImage})`;
                        observer.unobserve(element);
                    }
                    
                    // Load iframes
                    if (element.dataset.src) {
                        element.src = element.dataset.src;
                        observer.unobserve(element);
                    }
                }
            });
        }, {
            rootMargin: '50px'
        });

        // Observe elements with data attributes
        document.querySelectorAll('[data-bg-image], [data-src]').forEach(el => {
            observer.observe(el);
        });
    }
}

// Resource Hints
class ResourceHints {
    constructor() {
        this.addResourceHints();
    }

    addResourceHints() {
        // DNS prefetch for external domains
        const externalDomains = [
            'fonts.googleapis.com',
            'fonts.gstatic.com',
            'cdn.jsdelivr.net',
            'cdnjs.cloudflare.com',
            'images.unsplash.com'
        ];

        externalDomains.forEach(domain => {
            const link = document.createElement('link');
            link.rel = 'dns-prefetch';
            link.href = `//${domain}`;
            document.head.appendChild(link);
        });
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new PerformanceOptimizer();
    new ResourceHints();
});

// Service Worker Registration (if available)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => {
                console.log('SW registered: ', registration);
            })
            .catch(registrationError => {
                console.log('SW registration failed: ', registrationError);
            });
    });
}

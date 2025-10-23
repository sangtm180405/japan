// ========================================
// MOBILE NAVIGATION ENHANCEMENTS
// ========================================

class MobileNavigationManager {
    constructor() {
        this.isMobileSearchOpen = false;
        this.isMenuOpen = false;
        this.touchStartX = 0;
        this.touchEndX = 0;
        this.lastScrollTop = 0;
        this.navbar = null;
        this.mobileSearchToggle = null;
        this.mobileSearchBar = null;
        this.navbarToggler = null;
        this.navbarCollapse = null;
        
        this.init();
    }

    init() {
        this.setupElements();
        this.setupEventListeners();
        this.setupTouchGestures();
        this.setupScrollBehavior();
        this.setupAccessibility();
        
        console.log('📱 Mobile Navigation Manager initialized');
    }

    setupElements() {
        this.navbar = document.querySelector('.mobile-nav');
        this.mobileSearchToggle = document.getElementById('mobileSearchToggle');
        this.mobileSearchBar = document.getElementById('mobileSearchBar');
        this.navbarToggler = document.querySelector('.navbar-toggler');
        this.navbarCollapse = document.querySelector('.navbar-collapse');
    }

    setupEventListeners() {
        // Mobile Search Toggle
        if (this.mobileSearchToggle && this.mobileSearchBar) {
            this.mobileSearchToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                this.toggleMobileSearch();
            }, true);
            
            // Prevent clicks inside the bar from bubbling
            this.mobileSearchBar.addEventListener('click', (e) => {
                e.stopPropagation();
            }, true);
        }
        
        // Close mobile search when clicking outside
        document.addEventListener('click', (event) => {
            if (window.innerWidth < 992 && this.isMobileSearchOpen) {
                if (this.mobileSearchBar && this.mobileSearchToggle) {
                    if (!this.mobileSearchBar.contains(event.target) && 
                        !this.mobileSearchToggle.contains(event.target)) {
                        this.closeMobileSearch();
                    }
                }
            }
        });
        
        // Auto-close mobile menu when clicking on a link
        if (this.navbarCollapse) {
            const mobileMenuLinks = document.querySelectorAll('.mobile-nav .nav-link');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992 && this.navbarCollapse.classList.contains('show')) {
                        this.closeMobileMenu();
                    }
                });
            });
        }
        
        // Handle window resize
        window.addEventListener('resize', () => {
            this.handleResize();
        });
        
        // Handle orientation change
        window.addEventListener('orientationchange', () => {
            setTimeout(() => {
                this.handleOrientationChange();
            }, 100);
        });
    }

    setupTouchGestures() {
        // Touch gestures for mobile
        document.addEventListener('touchstart', (e) => {
            this.touchStartX = e.changedTouches[0].screenX;
        });
        
        document.addEventListener('touchend', (e) => {
            this.touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe();
        });
    }

    setupScrollBehavior() {
        // Navbar scroll effect
        if (this.navbar) {
            window.addEventListener('scroll', () => {
                this.handleScroll();
            });
        }
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(anchor.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    setupAccessibility() {
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeMobileSearch();
                this.closeMobileMenu();
            }
        });
        
        // Focus management
        if (this.mobileSearchToggle) {
            this.mobileSearchToggle.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.toggleMobileSearch();
                }
            });
        }
    }

    toggleMobileSearch() {
        if (!this.isMobileSearchOpen) {
            this.openMobileSearch();
        } else {
            this.closeMobileSearch();
        }
    }

    openMobileSearch() {
        if (!this.mobileSearchBar || !this.mobileSearchToggle) return;
        
        // Position just below navbar height dynamically
        if (this.navbar) {
            const navHeight = this.navbar.getBoundingClientRect().height;
            this.mobileSearchBar.style.top = navHeight + 'px';
        }
        
        this.mobileSearchBar.style.display = 'block';
        const input = this.mobileSearchBar.querySelector('input');
        if (input) {
            input.focus();
            input.select();
        }
        
        this.mobileSearchToggle.innerHTML = '<i class="fas fa-times"></i>';
        this.mobileSearchToggle.classList.add('active');
        this.isMobileSearchOpen = true;
        
        // Add body class to prevent scrolling
        document.body.classList.add('mobile-search-open');
        
        // Trigger custom event
        window.dispatchEvent(new CustomEvent('mobileSearchOpened'));
    }

    closeMobileSearch() {
        if (!this.mobileSearchBar || !this.mobileSearchToggle) return;
        
        this.mobileSearchBar.style.display = 'none';
        this.mobileSearchToggle.innerHTML = '<i class="fas fa-search"></i>';
        this.mobileSearchToggle.classList.remove('active');
        this.isMobileSearchOpen = false;
        
        // Remove body class
        document.body.classList.remove('mobile-search-open');
        
        // Trigger custom event
        window.dispatchEvent(new CustomEvent('mobileSearchClosed'));
    }

    closeMobileMenu() {
        if (this.navbarCollapse && this.navbarCollapse.classList.contains('show')) {
            const bsCollapse = new bootstrap.Collapse(this.navbarCollapse);
            bsCollapse.hide();
            this.isMenuOpen = false;
        }
    }

    handleSwipe() {
        const swipeThreshold = 50;
        const diff = this.touchStartX - this.touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                // Swipe left - could open search
                if (window.innerWidth < 992 && !this.isMobileSearchOpen) {
                    this.openMobileSearch();
                }
            } else {
                // Swipe right - could close search
                if (window.innerWidth < 992 && this.isMobileSearchOpen) {
                    this.closeMobileSearch();
                }
            }
        }
    }

    handleScroll() {
        if (!this.navbar) return;
        
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > this.lastScrollTop && scrollTop > 100) {
            // Scrolling down
            this.navbar.style.transform = 'translateY(-100%)';
        } else {
            // Scrolling up
            this.navbar.style.transform = 'translateY(0)';
        }
        
        this.lastScrollTop = scrollTop;
    }

    handleResize() {
        // Close mobile search on desktop
        if (window.innerWidth >= 992 && this.isMobileSearchOpen) {
            this.closeMobileSearch();
        }
        
        // Close mobile menu on desktop
        if (window.innerWidth >= 992 && this.isMenuOpen) {
            this.closeMobileMenu();
        }
    }

    handleOrientationChange() {
        // Recalculate positions after orientation change
        if (this.isMobileSearchOpen && this.mobileSearchBar && this.navbar) {
            const navHeight = this.navbar.getBoundingClientRect().height;
            this.mobileSearchBar.style.top = navHeight + 'px';
        }
    }

    // Public methods
    isSearchOpen() {
        return this.isMobileSearchOpen;
    }

    isMenuOpen() {
        return this.isMenuOpen;
    }

    openSearch() {
        this.openMobileSearch();
    }

    closeSearch() {
        this.closeMobileSearch();
    }
}

// ========================================
// MOBILE UTILITIES
// ========================================

class MobileUtils {
    constructor() {
        this.init();
    }

    init() {
        this.setupTouchOptimizations();
        this.setupViewportOptimizations();
        this.setupPerformanceOptimizations();
        
        console.log('📱 Mobile Utils initialized');
    }

    setupTouchOptimizations() {
        // Prevent double-tap zoom
        let lastTouchEnd = 0;
        document.addEventListener('touchend', (e) => {
            const now = (new Date()).getTime();
            if (now - lastTouchEnd <= 300) {
                e.preventDefault();
            }
            lastTouchEnd = now;
        }, false);
        
        // Improve touch responsiveness
        document.addEventListener('touchstart', () => {}, { passive: true });
        document.addEventListener('touchmove', () => {}, { passive: true });
    }

    setupViewportOptimizations() {
        // Handle viewport changes
        const viewport = document.querySelector('meta[name="viewport"]');
        if (viewport) {
            // Ensure proper viewport for mobile
            viewport.content = 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no';
        }
        
        // Handle safe areas for notched devices
        const style = document.createElement('style');
        style.textContent = `
            .safe-area-top {
                padding-top: env(safe-area-inset-top);
            }
            .safe-area-bottom {
                padding-bottom: env(safe-area-inset-bottom);
            }
            .safe-area-left {
                padding-left: env(safe-area-inset-left);
            }
            .safe-area-right {
                padding-right: env(safe-area-inset-right);
            }
        `;
        document.head.appendChild(style);
    }

    setupPerformanceOptimizations() {
        // Lazy load images on mobile
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        observer.unobserve(img);
                    }
                });
            });
            
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
        
        // Optimize animations for mobile
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.documentElement.style.setProperty('--animation-duration', '0.01ms');
        }
    }

    // Utility methods
    isMobile() {
        return window.innerWidth < 992;
    }

    isTablet() {
        return window.innerWidth >= 768 && window.innerWidth < 992;
    }

    isDesktop() {
        return window.innerWidth >= 992;
    }

    getDeviceType() {
        if (this.isMobile()) return 'mobile';
        if (this.isTablet()) return 'tablet';
        return 'desktop';
    }
}

// ========================================
// INITIALIZATION
// ========================================

document.addEventListener('DOMContentLoaded', () => {
    // Initialize mobile navigation
    window.mobileNavigation = new MobileNavigationManager();
    
    // Initialize mobile utilities
    window.mobileUtils = new MobileUtils();
    
    // Add device class to body
    document.body.classList.add(`device-${window.mobileUtils.getDeviceType()}`);
    
    // Handle device type changes
    window.addEventListener('resize', () => {
        const newDeviceType = window.mobileUtils.getDeviceType();
        document.body.className = document.body.className.replace(/device-\w+/, `device-${newDeviceType}`);
    });
});

// Export for global access
window.MobileNavigationManager = MobileNavigationManager;
window.MobileUtils = MobileUtils;

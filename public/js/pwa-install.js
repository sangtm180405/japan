/**
 * PWA Install Prompt Handler
 * Handles PWA installation and offline capabilities
 */

class PWAInstaller {
    constructor() {
        this.deferredPrompt = null;
        this.isInstalled = false;
        this.isOnline = navigator.onLine;
        
        this.init();
    }
    
    init() {
        this.setupInstallPrompt();
        this.setupOfflineDetection();
        this.setupServiceWorker();
        this.setupUpdateNotification();
    }
    
    // Setup install prompt
    setupInstallPrompt() {
        // Listen for beforeinstallprompt event
        window.addEventListener('beforeinstallprompt', (e) => {
            console.log('PWA: Install prompt available');
            // Prevent default mini-infobar and keep the event for later
            e.preventDefault();
            this.deferredPrompt = e;
            this.showInstallButton();

            // Auto-prompt once per session when eligible
            try {
                const alreadyPrompted = sessionStorage.getItem('pwaPromptShown') === '1';
                if (!alreadyPrompted) {
                    sessionStorage.setItem('pwaPromptShown', '1');
                    // Defer slightly to allow UI to settle
                    setTimeout(() => this.installApp(), 250);
                }
            } catch (err) {
                // Ignore storage errors and rely on the button
            }
        });
        
        // Listen for appinstalled event
        window.addEventListener('appinstalled', () => {
            console.log('PWA: App installed successfully');
            this.isInstalled = true;
            this.hideInstallButton();
            this.showInstallSuccess();
        });
        
        // Check if already installed
        if (window.matchMedia('(display-mode: standalone)').matches) {
            this.isInstalled = true;
            console.log('PWA: Running as installed app');
        }
    }
    
    // Setup offline detection
    setupOfflineDetection() {
        window.addEventListener('online', () => {
            this.isOnline = true;
            this.hideOfflineIndicator();
            this.showOnlineNotification();
        });
        
        window.addEventListener('offline', () => {
            this.isOnline = false;
            this.showOfflineIndicator();
            this.showOfflineNotification();
        });
        
        // Initial check
        if (!this.isOnline) {
            this.showOfflineIndicator();
        }
    }
    
    // Setup Service Worker
    setupServiceWorker() {
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js')
                .then(registration => {
                    console.log('PWA: Service Worker registered', registration);
                    this.setupUpdateNotification(registration);
                })
                .catch(error => {
                    console.error('PWA: Service Worker registration failed', error);
                });
        }
    }
    
    // Setup update notification
    setupUpdateNotification(registration) {
        if (registration) {
            registration.addEventListener('updatefound', () => {
                const newWorker = registration.installing;
                newWorker.addEventListener('statechange', () => {
                    if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                        this.showUpdateNotification();
                    }
                });
            });
        }
    }
    
    // Show install button
    showInstallButton() {
        if (this.isInstalled) return;
        
        // Create install button
        const installBtn = document.createElement('button');
        installBtn.id = 'pwa-install-btn';
        installBtn.className = 'btn btn-primary position-fixed';
        installBtn.style.cssText = `
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            border-radius: 50px;
            padding: 12px 24px;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            animation: slideInUp 0.5s ease-out;
        `;
        installBtn.innerHTML = '📱 Cài đặt App';
        
        // Add animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInUp {
                from { transform: translateY(100px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
            @keyframes slideOutDown {
                from { transform: translateY(0); opacity: 1; }
                to { transform: translateY(100px); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
        
        // Add click handler
        installBtn.addEventListener('click', () => {
            this.installApp();
        });
        
        document.body.appendChild(installBtn);
    }
    
    // Hide install button
    hideInstallButton() {
        const installBtn = document.getElementById('pwa-install-btn');
        if (installBtn) {
            installBtn.style.animation = 'slideOutDown 0.5s ease-out';
            setTimeout(() => {
                installBtn.remove();
            }, 500);
        }
    }
    
    // Install app
    async installApp() {
        if (!this.deferredPrompt) return;
        
        try {
            // Show install prompt
            this.deferredPrompt.prompt();
            
            // Wait for user response
            const { outcome } = await this.deferredPrompt.userChoice;
            
            if (outcome === 'accepted') {
                console.log('PWA: User accepted install prompt');
            } else {
                console.log('PWA: User dismissed install prompt');
            }
            
            // Clear the deferred prompt
            this.deferredPrompt = null;
            this.hideInstallButton();
            
        } catch (error) {
            console.error('PWA: Install failed', error);
        }
    }
    
    // Show offline indicator
    showOfflineIndicator() {
        let indicator = document.getElementById('offline-indicator');
        if (!indicator) {
            indicator = document.createElement('div');
            indicator.id = 'offline-indicator';
            indicator.className = 'alert alert-warning position-fixed';
            indicator.style.cssText = `
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 1000;
                border-radius: 25px;
                padding: 10px 20px;
                font-weight: bold;
                animation: slideInDown 0.5s ease-out;
            `;
            indicator.innerHTML = '📡 Đang offline - Một số tính năng có thể bị hạn chế';
            document.body.appendChild(indicator);
        }
    }
    
    // Hide offline indicator
    hideOfflineIndicator() {
        const indicator = document.getElementById('offline-indicator');
        if (indicator) {
            indicator.style.animation = 'slideOutUp 0.5s ease-out';
            setTimeout(() => {
                indicator.remove();
            }, 500);
        }
    }
    
    // Show online notification
    showOnlineNotification() {
        this.showNotification('🟢 Đã kết nối lại internet!', 'success');
    }
    
    // Show offline notification
    showOfflineNotification() {
        this.showNotification('🔴 Mất kết nối internet', 'warning');
    }
    
    // Show install success
    showInstallSuccess() {
        this.showNotification('🎉 App đã được cài đặt thành công!', 'success');
    }
    
    // Show update notification
    showUpdateNotification() {
        const updateBtn = document.createElement('button');
        updateBtn.className = 'btn btn-info position-fixed';
        updateBtn.style.cssText = `
            top: 20px;
            right: 20px;
            z-index: 1000;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: bold;
            animation: slideInRight 0.5s ease-out;
        `;
        updateBtn.innerHTML = '🔄 Cập nhật App';
        
        updateBtn.addEventListener('click', () => {
            window.location.reload();
        });
        
        document.body.appendChild(updateBtn);
        
        // Auto remove after 10 seconds
        setTimeout(() => {
            updateBtn.remove();
        }, 10000);
    }
    
    // Show notification
    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} position-fixed`;
        notification.style.cssText = `
            top: 80px;
            right: 20px;
            z-index: 1000;
            border-radius: 25px;
            padding: 15px 25px;
            font-weight: bold;
            max-width: 300px;
            animation: slideInRight 0.5s ease-out;
        `;
        notification.innerHTML = message;
        
        document.body.appendChild(notification);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.5s ease-out';
            setTimeout(() => {
                notification.remove();
            }, 500);
        }, 3000);
    }
    
    // Check if app is installed
    isAppInstalled() {
        return this.isInstalled || window.matchMedia('(display-mode: standalone)').matches;
    }
    
    // Get app info
    getAppInfo() {
        return {
            isInstalled: this.isAppInstalled(),
            isOnline: this.isOnline,
            canInstall: !!this.deferredPrompt,
            userAgent: navigator.userAgent,
            platform: navigator.platform
        };
    }
}

// Initialize PWA installer when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.pwaInstaller = new PWAInstaller();
    
    // Add PWA info to console
    console.log('PWA Info:', window.pwaInstaller.getAppInfo());
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = PWAInstaller;
}

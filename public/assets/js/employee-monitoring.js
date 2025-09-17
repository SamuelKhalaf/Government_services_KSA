/**
 * Employee Monitoring JavaScript
 * Handles click tracking, screen time monitoring, and screenshot capture
 */

class EmployeeMonitoring {
    constructor() {
        this.isEmployee = false;
        this.sessionStartTime = Date.now();
        this.lastActivityTime = Date.now();
        this.idleThreshold = 300000; // 5 minutes in milliseconds
        this.activityData = {
            clicks: 0,
            keypresses: 0,
            scrolls: 0,
            activeSeconds: 0,
            idleSeconds: 0
        };
        this.isIdle = false;
        this.idleTimer = null;
        this.activityTimer = null;
        
        this.init();
    }

    init() {
        // Check if user is an employee
        this.checkUserRole();
        
        if (this.isEmployee) {
            this.setupEventListeners();
            this.startScreenTimeTracking();
            this.startActivityTracking();
        }
    }

    checkUserRole() {
        // This would typically be set by the backend
        // For now, we'll check if the user has employee role
        const userRole = document.querySelector('meta[name="user-role"]');
        this.isEmployee = userRole && userRole.getAttribute('content') === 'employee';
    }

    setupEventListeners() {
        // Click tracking
        document.addEventListener('click', (e) => {
            this.trackClick(e);
            this.updateActivity();
        });

        // Keyboard tracking
        document.addEventListener('keydown', (e) => {
            this.trackKeypress(e);
            this.updateActivity();
        });

        // Scroll tracking
        document.addEventListener('scroll', (e) => {
            this.trackScroll(e);
            this.updateActivity();
        });

        // Mouse movement tracking
        document.addEventListener('mousemove', (e) => {
            this.updateActivity();
        });

        // Window focus/blur tracking
        window.addEventListener('focus', () => {
            this.updateActivity();
        });

        window.addEventListener('blur', () => {
            this.handleIdle();
        });

        // Page visibility change
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.handleIdle();
            } else {
                this.updateActivity();
            }
        });
    }

    trackClick(event) {
        this.activityData.clicks++;
        
        const clickData = {
            element_type: event.target.tagName.toLowerCase(),
            element_id: event.target.id || null,
            element_class: event.target.className || null,
            element_text: event.target.textContent?.trim().substring(0, 500) || null,
            page_url: window.location.href,
            x_position: event.clientX,
            y_position: event.clientY
        };

        this.sendClickData(clickData);
    }

    trackKeypress(event) {
        // Skip certain keys that don't represent meaningful activity
        const skipKeys = ['Shift', 'Control', 'Alt', 'Meta', 'CapsLock', 'Tab'];
        if (!skipKeys.includes(event.key)) {
            this.activityData.keypresses++;
        }
    }

    trackScroll(event) {
        this.activityData.scrolls++;
    }

    updateActivity() {
        this.lastActivityTime = Date.now();
        
        if (this.isIdle) {
            this.isIdle = false;
            this.clearIdleTimer();
        }
    }

    handleIdle() {
        if (!this.isIdle) {
            this.isIdle = true;
            this.idleTimer = setTimeout(() => {
                this.startIdleTime();
            }, this.idleThreshold);
        }
    }

    startIdleTime() {
        this.idleStartTime = Date.now();
    }

    clearIdleTimer() {
        if (this.idleTimer) {
            clearTimeout(this.idleTimer);
            this.idleTimer = null;
        }
    }

    startScreenTimeTracking() {
        this.activityTimer = setInterval(() => {
            this.updateScreenTime();
        }, 1000); // Update every second
    }

    updateScreenTime() {
        const now = Date.now();
        const timeDiff = now - this.lastActivityTime;
        
        if (this.isIdle || timeDiff > this.idleThreshold) {
            this.activityData.idleSeconds++;
        } else {
            this.activityData.activeSeconds++;
        }
    }

    startActivityTracking() {
        // Send activity data every 5 minutes
        setInterval(() => {
            this.sendActivityData();
        }, 300000);
    }


    sendClickData(clickData) {
        fetch('/api/employee-monitoring/track-click', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(clickData)
        }).catch(error => {
            console.error('Error tracking click:', error);
        });
    }

    sendActivityData() {
        const activityData = {
            active_seconds: this.activityData.activeSeconds,
            idle_seconds: this.activityData.idleSeconds,
            clicks: this.activityData.clicks,
            keypresses: this.activityData.keypresses,
            scrolls: this.activityData.scrolls,
            breaks: this.getActivityBreaks()
        };

        fetch('/api/employee-monitoring/update-screen-time', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(activityData)
        }).then(response => {
            if (response.ok) {
                // Reset counters after successful send
                this.resetActivityCounters();
            }
        }).catch(error => {
            console.error('Error sending activity data:', error);
        });
    }


    getActivityBreaks() {
        // This would track periods of inactivity
        // For now, return empty array
        return [];
    }

    resetActivityCounters() {
        this.activityData = {
            clicks: 0,
            keypresses: 0,
            scrolls: 0,
            activeSeconds: 0,
            idleSeconds: 0
        };
    }

    // Public methods for manual control
    pauseMonitoring() {
        if (this.activityTimer) {
            clearInterval(this.activityTimer);
        }
        if (this.idleTimer) {
            clearTimeout(this.idleTimer);
        }
    }

    resumeMonitoring() {
        this.startScreenTimeTracking();
    }

    getStatistics() {
        return fetch('/api/employee-monitoring/my-statistics')
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching statistics:', error);
                return null;
            });
    }

    // Cleanup on page unload
    destroy() {
        this.pauseMonitoring();
        
        // Send final activity data
        this.sendActivityData();
    }
}

// Initialize monitoring when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.employeeMonitoring = new EmployeeMonitoring();
});

// Cleanup on page unload
window.addEventListener('beforeunload', () => {
    if (window.employeeMonitoring) {
        window.employeeMonitoring.destroy();
    }
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = EmployeeMonitoring;
}

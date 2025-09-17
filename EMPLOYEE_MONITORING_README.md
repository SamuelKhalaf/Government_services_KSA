# Employee Monitoring Module

This module provides comprehensive monitoring capabilities for tracking employee activities in the management system.

## Features

### 1. Login/Logout Tracking
- Records exact login and logout times
- Tracks IP addresses and user agents
- Calculates session duration
- Monitors active sessions

### 2. Activity Tracking
- Logs all CRUD operations (Create, Read, Update, Delete)
- Tracks model changes with old/new values
- Records page views and actions
- Captures IP addresses and URLs

### 3. Click Tracking
- Monitors all user clicks and interactions
- Records element types, IDs, classes, and text
- Tracks mouse positions
- Logs page URLs where clicks occurred

### 4. Active Screen Time
- Monitors active vs idle time
- Tracks clicks, keypresses, and scrolls
- Calculates productivity percentages
- Records activity breaks

### 5. Screenshot Capture
- Takes screenshots every 10 minutes
- Stores screenshots with metadata
- Links screenshots to specific pages
- Provides download and view capabilities

## Database Tables

- `employee_login_logs` - Login/logout sessions
- `employee_activity_logs` - User activities and actions
- `employee_click_tracking` - Click interactions
- `employee_active_screen_time` - Screen time and productivity data
- `employee_screenshots` - Captured screenshots

## Permissions

The module includes the following permissions:

- `view_employee_monitoring` - Access to main dashboard
- `view_employee_login_logs` - View login/logout records
- `view_employee_activity_logs` - View activity logs
- `view_employee_click_tracking` - View click tracking data
- `view_employee_screen_time` - View screen time reports
- `view_employee_screenshots` - View screenshots
- `manage_employee_monitoring` - Manage monitoring data (delete screenshots, etc.)

## Usage

### For Administrators

1. **Access the Dashboard**: Navigate to "Employee Monitoring" in the sidebar
2. **View Reports**: Use the various report sections to analyze employee activity
3. **Filter Data**: Use date ranges, employee filters, and other criteria
4. **Export Data**: Download reports in CSV format
5. **View Screenshots**: Browse and download employee screenshots

### For Employees

- Monitoring is automatic and transparent
- No additional action required
- Data is collected in the background

## Frontend Monitoring

The system includes JavaScript that automatically:

- Tracks all clicks and interactions
- Monitors keyboard activity
- Records scroll events
- Captures screenshots periodically
- Sends data to the backend via API

## API Endpoints

- `POST /api/employee-monitoring/track-click` - Track click events
- `POST /api/employee-monitoring/update-screen-time` - Update screen time data
- `POST /api/employee-monitoring/capture-screenshot` - Capture screenshots
- `GET /api/employee-monitoring/my-statistics` - Get employee statistics

## Configuration

### Screenshot Capture
- Interval: 10 minutes (configurable in JavaScript)
- Storage: `storage/app/public/screenshots/`
- Formats: PNG images

### Activity Tracking
- Idle threshold: 5 minutes
- Data sync interval: 5 minutes
- Automatic cleanup of old data

### Privacy Considerations

- Screenshots are taken only for employees with the "employee" role
- All monitoring data is stored securely
- Access is controlled by permissions
- Data can be exported and deleted as needed

## Installation

1. Run migrations: `php artisan migrate`
2. Seed permissions: `php artisan db:seed --class=EmployeeMonitoringPermissionsSeeder`
3. Assign permissions to admins: `php artisan db:seed --class=AssignMonitoringPermissionsToAdminSeeder`

## Maintenance

- Screenshots are automatically cleaned up after 30 days (configurable)
- Old activity logs can be archived or deleted
- Monitor storage usage for screenshots
- Regular backup of monitoring data

## Security

- All monitoring data is encrypted in transit
- Access is restricted by role-based permissions
- Screenshots are stored securely
- API endpoints require authentication

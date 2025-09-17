# Document Expiration Alert System

## Overview

This system automatically monitors all document types in the management system and sends notifications to users when documents are approaching their expiration dates. The system supports both admin and employee user types with different notification strategies.

## Document Types Supported

### 1. Company Documents
- **CompanyDocument**: Uses `custom_fields` JSON column with `expiry_date` field
- **BranchCommercialRegistration**: Uses direct `expiry_date` column
- **CivilDefenseLicense**: Uses direct `expiry_date` column  
- **MunicipalityLicense**: Uses direct `expiry_date` column

### 2. Employee Documents
- **EmployeeDocument**: Uses `custom_fields` JSON column with `expiry_date` field

## User Types & Notification Strategy

### Admin Users
- **Receive notifications for ALL expiring documents** across the entire system
- **Individual notifications** for each expiring document
- **Summary notification** with total counts of expiring documents
- **Document types included**: All company documents + all employee documents

### Employee Users
- **Receive notifications ONLY for documents assigned to them** through tasks
- **Document assignment**: Through `TaskDocument` model linking documents to tasks
- **Document types included**: 
  - Employee documents assigned to their tasks
  - Company documents assigned to their tasks
  - Basic company documents (Branch, Civil Defense, Municipality) assigned to their tasks

## Reminder Settings

Each document type now supports:
- **`enable_reminder`**: Boolean field to enable/disable reminders
- **`reminder_days`**: Integer field (1-365) specifying how many days before expiry to send alerts

### Database Schema
```sql
-- Added to all document tables
ALTER TABLE table_name ADD COLUMN enable_reminder BOOLEAN DEFAULT FALSE;
ALTER TABLE table_name ADD COLUMN reminder_days INTEGER NULL;
```

## Notification Types

### 1. Document Expiring Soon (Employee)
- **Type**: `document_expiring_soon`
- **Recipients**: Employee users
- **Content**: Document type, days until expiry, expiry date
- **Icon**: `fas fa-file-exclamation`
- **Color**: Warning (yellow)

### 2. Admin Document Alert
- **Type**: `admin_document_expiring_soon`
- **Recipients**: Admin users
- **Content**: Document type, entity name, days until expiry, expiry date
- **Icon**: `fas fa-file-exclamation`
- **Color**: Warning (yellow)

### 3. Expiring Documents Summary
- **Type**: `expiring_documents_summary`
- **Recipients**: Admin users
- **Content**: Total count, employee docs count, company docs count
- **Icon**: `fas fa-list-alt`
- **Color**: Info (blue)

## Automated Scheduling

The system runs automatically via Laravel's task scheduler:
- **Frequency**: Daily at 9:00 AM
- **Command**: `documents:check-expiration-alerts`
- **Overlap Protection**: Enabled to prevent multiple instances
- **Background Execution**: Enabled for performance

## Manual Testing

### Test Command
```bash
php artisan documents:test-alerts
```

### Test with Dry Run
```bash
php artisan documents:test-alerts --dry-run
```

### Test for Specific User
```bash
php artisan documents:test-alerts --user-id=123
```

## Implementation Files

### Console Commands
- `app/Console/Commands/CheckDocumentExpirationAlerts.php` - Main alert checking logic
- `app/Console/Commands/TestDocumentAlerts.php` - Testing command

### Models Updated
- `app/Models/CompanyDocument.php` - Added reminder fields and methods
- `app/Models/EmployeeDocument.php` - Added reminder fields and methods
- `app/Models/BranchCommercialRegistration.php` - Added reminder fields and methods
- `app/Models/CivilDefenseLicense.php` - Added reminder fields and methods
- `app/Models/MunicipalityLicense.php` - Added reminder fields and methods
- `app/Models/Notification.php` - Added new notification types

### Services
- `app/Services/NotificationService.php` - Enhanced with document alert methods

### Language Files
- `resources/lang/en/notifications.php` - English notification messages
- `resources/lang/ar/notifications.php` - Arabic notification messages

### Views Updated
All create and edit views for the three basic company document types now include:
- Enable reminder checkbox
- Reminder days input field
- JavaScript for conditional display
- Validation error handling

## Configuration

### Scheduler Setup
Ensure Laravel's scheduler is running by adding this to your crontab:
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

### Database Migration
The reminder fields are added via migration:
```bash
php artisan migrate
```

## Usage Examples

### For Admins
1. Login as admin
2. View notifications panel
3. See individual alerts for each expiring document
4. See summary notification with total counts

### For Employees
1. Login as employee
2. View notifications panel
3. See alerts only for documents assigned to their tasks
4. Take action on assigned documents

### Setting Up Reminders
1. Create or edit any document
2. Check "Enable Expiry Reminder" checkbox
3. Set number of days (1-365) before expiry to receive alert
4. Save document

## Technical Details

### Expiry Date Handling
- **CompanyDocument/EmployeeDocument**: `custom_fields->expiry_date` (JSON)
- **Basic Company Documents**: `expiry_date` (direct column)

### Document Assignment Logic
Documents are assigned to employees through:
1. Task creation with document attachments
2. `TaskDocument` model linking documents to tasks
3. Task assignment to employee users

### Notification Data Structure
```php
[
    'document_id' => 123,
    'document_type' => 'Passport',
    'days_until_expiry' => 15,
    'expiry_date' => '2024-02-15',
    'document_category' => 'employee|company|branch_registration|etc'
]
```

## Troubleshooting

### No Notifications Sent
1. Check if documents have `enable_reminder = true`
2. Check if `reminder_days` is set
3. Verify expiry dates are valid
4. Check if documents are assigned to employees (for employee notifications)

### Scheduler Not Running
1. Verify crontab is set up correctly
2. Check Laravel logs for scheduler errors
3. Test manually with `php artisan schedule:run`

### Performance Issues
1. The command runs in background to avoid blocking
2. Consider adding database indexes on expiry date fields
3. Monitor notification table size and clean old notifications

## Future Enhancements

1. **Email Notifications**: Add email alerts alongside in-app notifications
2. **SMS Notifications**: Add SMS alerts for critical documents
3. **Escalation Rules**: Add escalation for overdue documents
4. **Custom Reminder Schedules**: Allow different reminder schedules per document type
5. **Bulk Actions**: Allow bulk reminder settings for multiple documents

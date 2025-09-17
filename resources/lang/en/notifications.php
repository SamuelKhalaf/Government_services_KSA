<?php

return [
    // Notification types
    'task_created' => 'Task Created',
    'task_assigned' => 'Task Assigned',
    'task_status_changed' => 'Status Changed',
    'task_updated' => 'Task Updated',
    'task_due_soon' => 'Due Soon',
    'task_overdue' => 'Overdue',

    // Task created notifications
    'task_created_title' => 'New Task Assigned',
    'task_created_message' => 'A new task "{title}" has been assigned to you.',

    // Task assigned notifications
    'task_assigned_title' => 'Task Assignment',
    'task_assigned_message' => 'You have been assigned to task "{title}" by {assigned_by}.',

    // Task status changed notifications
    'task_status_changed_title' => 'Task Status Updated',
    'task_status_changed_message' => 'Task "{title}" status changed from "{old_status}" to "{new_status}" by {changed_by}.',

    // Task updated notifications
    'task_updated_title' => 'Task Updated',
    'task_updated_message' => 'Task "{title}" has been updated by {updated_by}.',

    // Task due soon notifications
    'task_due_soon_title' => 'Task Due Soon',
    'task_due_soon_message' => 'Task "{title}" is due on {due_date}. Please complete it soon.',

    // Task overdue notifications
    'task_overdue_title' => 'Task Overdue',
    'task_overdue_message' => 'Task "{title}" was due on {due_date} and is now overdue.',

    // General notification messages
    'no_notifications' => 'No notifications',
    'mark_all_read' => 'Mark all as read',
    'view_all' => 'View all notifications',
    'unread_count' => 'unread notifications',
    'notifications' => 'Notifications',
    'notification_center' => 'Notification Center',
    'recent_notifications' => 'Recent Notifications',
    'all_notifications' => 'All Notifications',
    'read_notifications' => 'Read Notifications',
    'unread_notifications' => 'Unread Notification',
    'mark_as_read' => 'Mark as read',
    'mark_as_unread' => 'Mark as unread',
    'delete_notification' => 'Delete notification',
    'notification_deleted' => 'Notification deleted successfully',
    'all_marked_read' => 'All notifications marked as read',
    'notification_marked_read' => 'Notification marked as read',
    'notification_marked_unread' => 'Notification marked as unread',
    'error_loading_notifications' => 'Error loading notifications',
    'no_more_notifications' => 'No more notifications to load',
    'confirm_mark_all_read' => 'Are you sure you want to mark all notifications as read?',
    'confirm_delete' => 'Are you sure you want to delete this notification?',
    'changed_by' => 'Changed by',
    
    // Additional notification keys
    'notification_created' => 'Notification created',
    'notification_updated' => 'Notification updated',
    'notification_sent' => 'Notification sent',
    'notification_failed' => 'Failed to send notification',
    'mark_all_unread' => 'Mark all as unread',
    'clear_all' => 'Clear all',
    'notification_settings' => 'Notification Settings',
    'email_notifications' => 'Email Notifications',
    'push_notifications' => 'Push Notifications',
    'notification_preferences' => 'Notification Preferences',
    'enable_notifications' => 'Enable Notifications',
    'disable_notifications' => 'Disable Notifications',
    'notification_types' => 'Notification Types',
    'task_notifications' => 'Task Notifications',
    'system_notifications' => 'System Notifications',
    'notification_frequency' => 'Notification Frequency',
    'immediate' => 'Immediate',
    'daily' => 'Daily',
    'weekly' => 'Weekly',
    'monthly' => 'Monthly',
    'never' => 'Never',

    // Document expiration notifications
    'document_expiring_soon' => 'Document Expiring Soon',
    'admin_document_expiring_soon' => 'Admin Document Alert',
    'expiring_documents_summary' => 'Expiring Documents Summary',

    // Document expiration notification messages
    'document_expiring_soon_title' => 'Document Expiring Soon',
    'document_expiring_soon_message' => 'The document ":document_type" will expire in :days days on :expiry_date. Please take necessary action.',
    
    'admin_document_expiring_soon_title' => 'Document Expiring Soon Alert',
    'admin_document_expiring_soon_message' => 'Document ":document_type" for ":entity_name" will expire in :days days on :expiry_date.',
    
    'expiring_documents_summary_title' => 'Expiring Documents Summary',
    'expiring_documents_summary_message' => 'There are :total documents expiring within the next :days days. Employee documents: :employee_docs, Company documents: :company_docs.',
];

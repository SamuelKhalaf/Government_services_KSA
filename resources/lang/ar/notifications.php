<?php

return [
    // Notification types
    'task_created' => 'تم إنشاء مهمة',
    'task_assigned' => 'تم تكليف مهمة',
    'task_status_changed' => 'تم تغيير الحالة',
    'task_updated' => 'تم تحديث المهمة',
    'task_due_soon' => 'قريب الاستحقاق',
    'task_overdue' => 'متأخرة',

    // Task created notifications
    'task_created_title' => 'مهمة جديدة مُكلفة',
    'task_created_message' => 'تم تكليفك بمهمة جديدة "{title}".',

    // Task assigned notifications
    'task_assigned_title' => 'تكليف مهمة',
    'task_assigned_message' => 'تم تكليفك بمهمة "{title}" من قبل {assigned_by}.',

    // Task status changed notifications
    'task_status_changed_title' => 'تم تحديث حالة المهمة',
    'task_status_changed_message' => 'تم تغيير حالة المهمة "{title}" من "{old_status}" إلى "{new_status}" من قبل {changed_by}.',

    // Task updated notifications
    'task_updated_title' => 'تم تحديث المهمة',
    'task_updated_message' => 'تم تحديث المهمة "{title}" من قبل {updated_by}.',

    // Task due soon notifications
    'task_due_soon_title' => 'مهمة قريبة الاستحقاق',
    'task_due_soon_message' => 'المهمة "{title}" مستحقة في {due_date}. يرجى إكمالها قريباً.',

    // Task overdue notifications
    'task_overdue_title' => 'مهمة متأخرة',
    'task_overdue_message' => 'المهمة "{title}" كانت مستحقة في {due_date} وهي الآن متأخرة.',

    // General notification messages
    'no_notifications' => 'لا توجد إشعارات',
    'mark_all_read' => 'تحديد الكل كمقروء',
    'view_all' => 'عرض جميع الإشعارات',
    'unread_count' => 'إشعارات غير مقروءة',
    'notifications' => 'الإشعارات',
    'notification_center' => 'مركز الإشعارات',
    'recent_notifications' => 'الإشعارات الأخيرة',
    'all_notifications' => 'جميع الإشعارات',
    'read_notifications' => 'الإشعارات المقروءة',
    'unread_notifications' => ' غير مقروءة',
    'mark_as_read' => 'تحديد كمقروء',
    'mark_as_unread' => 'تحديد كغير مقروء',
    'delete_notification' => 'حذف الإشعار',
    'notification_deleted' => 'تم حذف الإشعار بنجاح',
    'all_marked_read' => 'تم تحديد جميع الإشعارات كمقروءة',
    'notification_marked_read' => 'تم تحديد الإشعار كمقروء',
    'notification_marked_unread' => 'تم تحديد الإشعار كغير مقروء',
    'error_loading_notifications' => 'خطأ في تحميل الإشعارات',
    'no_more_notifications' => 'لا توجد إشعارات أخرى للتحميل',
    'confirm_mark_all_read' => 'هل أنت متأكد من تحديد جميع الإشعارات كمقروءة؟',
    'confirm_delete' => 'هل أنت متأكد من حذف هذا الإشعار؟',
    'changed_by' => 'بواسطة',
    
    // Additional notification keys
    'notification_created' => 'تم إنشاء الإشعار',
    'notification_updated' => 'تم تحديث الإشعار',
    'notification_sent' => 'تم إرسال الإشعار',
    'notification_failed' => 'فشل في إرسال الإشعار',
    'mark_all_unread' => 'تحديد الكل كغير مقروء',
    'clear_all' => 'مسح الكل',
    'notification_settings' => 'إعدادات الإشعارات',
    'email_notifications' => 'إشعارات البريد الإلكتروني',
    'push_notifications' => 'الإشعارات الفورية',
    'notification_preferences' => 'تفضيلات الإشعارات',
    'enable_notifications' => 'تفعيل الإشعارات',
    'disable_notifications' => 'إلغاء تفعيل الإشعارات',
    'notification_types' => 'أنواع الإشعارات',
    'task_notifications' => 'إشعارات المهام',
    'system_notifications' => 'إشعارات النظام',
    'notification_frequency' => 'تكرار الإشعارات',
    'immediate' => 'فوري',
    'daily' => 'يومي',
    'weekly' => 'أسبوعي',
    'monthly' => 'شهري',
    'never' => 'أبداً',

    // Document expiration notifications
    'document_expiring_soon' => 'وثيقة ستنتهي قريباً',
    'admin_document_expiring_soon' => 'تنبيه وثيقة للمدير',
    'expiring_documents_summary' => 'ملخص الوثائق المنتهية الصلاحية',

    // Document expiration notification messages
    'document_expiring_soon_title' => 'وثيقة ستنتهي قريباً',
    'document_expiring_soon_message' => 'الوثيقة ":document_type" ستنتهي خلال :days أيام في :expiry_date. يرجى اتخاذ الإجراءات اللازمة.',
    
    'admin_document_expiring_soon_title' => 'تنبيه وثيقة ستنتهي قريباً',
    'admin_document_expiring_soon_message' => 'الوثيقة ":document_type" لـ ":entity_name" ستنتهي خلال :days أيام في :expiry_date.',
    
    'expiring_documents_summary_title' => 'ملخص الوثائق المنتهية الصلاحية',
    'expiring_documents_summary_message' => 'يوجد :total وثيقة ستنتهي خلال :days أيام القادمة. وثائق الموظفين: :employee_docs، وثائق الشركات: :company_docs.',
];

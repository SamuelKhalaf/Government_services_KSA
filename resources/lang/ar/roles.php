<?php

return [
    // Role names
    'admin' => 'مدير النظام',
    'employee' => 'موظف',

    // Page titles
    'roles_list' => 'قائمة الأدوار',
    'add_role' => 'إضافة دور',
    'edit_role' => 'تعديل دور',
    'view_role_details' => 'عرض تفاصيل الدور',
    'role_details' => 'تفاصيل الدور',

    // Fields
    'role_name' => 'اسم الدور',
    'permissions' => 'الصلاحيات',
    'assigned_users' => 'المستخدمون المُعيَّنون',
    'total_users' => 'إجمالي المستخدمين بهذا الدور',
    'no_permissions_assigned' => 'لا توجد صلاحيات مُعيَّنة',

    // Actions
    'view_role' => 'عرض الدور',
    'edit_role' => 'تعديل الدور',
    'delete_role' => 'حذف الدور',
    'add_new_role' => 'إضافة دور جديد',

    // Messages
    'role_created' => 'تم إنشاء الدور بنجاح!',
    'role_updated' => 'تم تحديث الدور بنجاح!',
    'role_deleted' => 'تم حذف الدور بنجاح!',
    'role_detached' => 'تم إزالة المستخدم من هذا الدور بنجاح!',
    'role_has_users' => 'هذا الدور مُعيَّن لمستخدمين. يمكنك الحذف القسري لإزالة جميع المستخدمين من هذا الدور.',
    'delete_confirmation' => 'هل أنت متأكد؟',
    'delete_confirmation_text' => 'حذف هذا الدور قد يؤثر على المستخدمين الحاليين. هل تريد المتابعة؟',
    'soft_delete' => 'حذف',
    'force_delete' => 'حذف قسري',
    'no_cancel' => 'لا، إلغاء',
    
    // Validation and error messages
    'role_name_required' => 'اسم الدور مطلوب',
    'error_saving_role' => 'خطأ في حفظ الدور. يرجى المحاولة مرة أخرى.',
    'role_updated_successfully' => 'تم تحديث الدور والصلاحيات بنجاح!',
    'failed_to_update_role' => 'فشل في تحديث الدور والصلاحيات.',
    'error_updating_role' => 'حدث خطأ أثناء تحديث الدور والصلاحيات.',

    // Common
    'administrator_access' => 'الوصول كمدير',
    'administrator_access_help' => 'يسمح بالوصول الكامل للنظام',
    'select_all' => 'تحديد الكل',
    'management' => 'الإدارة',
    'discard' => 'إلغاء',
    'submit' => 'إرسال',
    'please_wait' => 'يرجى الانتظار...',
    'search_users' => 'البحث عن المستخدمين',
    'selected' => 'مُحدد',
    'delete_selected' => 'حذف المحدد',

    // Breadcrumbs
    'breadcrumb_roles' => 'الأدوار',
    'breadcrumb_system_management' => 'إدارة النظام',
    'breadcrumb_user_management' => 'إدارة المستخدمين',
    'breadcrumb_home' => 'الرئيسية',

    // Table headers
    'table_user' => 'المستخدم',
    'table_joined_date' => 'تاريخ الانضمام',
    'table_actions' => 'الإجراءات',
    'table_name' => 'الاسم',
    'table_assigned_to' => 'مُعيَّن لـ',
    'table_created_date' => 'تاريخ الإنشاء',
    'table_permissions' => 'الصلاحيات',
];

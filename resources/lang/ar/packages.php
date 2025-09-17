<?php

return [
    // Page titles
    'packages_management' => 'إدارة الباقات',
    'packages' => 'الباقات',
    'package' => 'الباقة',
    'add_package' => 'إضافة باقة',
    'edit_package' => 'تعديل الباقة',
    'package_details' => 'تفاصيل الباقة',
    'package_list' => 'قائمة الباقات',
    'create_new_package' => 'إنشاء باقة جديدة',
    'current_package_status' => 'حالة الباقة الحالية وحدود الاستخدام',
    'limit_reached' => 'تم الوصول للحد الأقصى',
    'assign_package_to_continue' => 'يرجى تخصيص باقة لهذه الشركة لمتابعة استخدام النظام.',
    'usage_statistics' => 'إحصائيات الاستخدام',
    'package_timeline' => 'الجدولة الزمنية للباقة',

    // Package fields
    'name' => 'اسم الباقة',
    'description' => 'الوصف',
    'max_employees' => 'الحد الأقصى للموظفين',
    'max_employee_documents' => 'الحد الأقصى لمستندات الموظفين',
    'max_company_documents' => 'الحد الأقصى لمستندات الشركة',
    'price' => 'السعر',
    'duration' => 'المدة (بالأشهر)',
    'status' => 'الحالة',
    'created_at' => 'تاريخ الإنشاء',
    'updated_at' => 'تاريخ التحديث',

    // Actions
    'create' => 'إنشاء',
    'edit' => 'تعديل',
    'delete' => 'حذف',
    'view' => 'عرض',
    'save' => 'حفظ',
    'cancel' => 'إلغاء',
    'back' => 'رجوع',
    'confirm_delete' => 'تأكيد الحذف',
    'are_you_sure_delete' => 'هل أنت متأكد من حذف هذه الباقة؟',

    // Status values
    'active' => 'نشط',
    'inactive' => 'غير نشط',

    // Messages
    'messages' => [
        'created_successfully' => 'تم إنشاء الباقة بنجاح',
        'updated_successfully' => 'تم تحديث الباقة بنجاح',
        'deleted_successfully' => 'تم حذف الباقة بنجاح',
        'cannot_delete_active_package' => 'لا يمكن حذف الباقة التي لديها عملاء نشطين',
        'no_packages_found' => 'لم يتم العثور على باقات',
    ],

    // Validation messages
    'validation' => [
        'name_required' => 'اسم الباقة مطلوب',
        'name_max' => 'اسم الباقة لا يمكن أن يتجاوز 255 حرف',
        'max_employees_integer' => 'الحد الأقصى للموظفين يجب أن يكون رقماً',
        'max_employees_min' => 'الحد الأقصى للموظفين يجب أن يكون على الأقل 1',
        'max_employee_documents_integer' => 'الحد الأقصى لمستندات الموظفين يجب أن يكون رقماً',
        'max_employee_documents_min' => 'الحد الأقصى لمستندات الموظفين يجب أن يكون على الأقل 1',
        'max_company_documents_integer' => 'الحد الأقصى لمستندات الشركة يجب أن يكون رقماً',
        'max_company_documents_min' => 'الحد الأقصى لمستندات الشركة يجب أن يكون على الأقل 1',
        'price_required' => 'السعر مطلوب',
        'price_numeric' => 'السعر يجب أن يكون رقماً',
        'price_min' => 'السعر يجب أن يكون على الأقل 0',
        'duration_required' => 'المدة مطلوبة',
        'duration_integer' => 'المدة يجب أن تكون رقماً',
        'duration_min' => 'المدة يجب أن تكون على الأقل شهر واحد',
        
        // Package limit validation messages
        'no_active_package' => 'هذه الشركة لا تملك باقة نشطة. يرجى تخصيص باقة أولاً.',
        'package_expired' => 'انتهت صلاحية باقة الشركة. يرجى التجديد أو تخصيص باقة جديدة.',
        'package_expired_detailed' => 'انتهت صلاحية الباقة منذ :days أيام في :date. جميع العمليات محظورة حتى التجديد.',
        'package_expired_grace' => 'انتهت صلاحية الباقة مؤخراً. لديك فترة سماح :grace_days أيام للتجديد.',
        'expired_package_notice' => 'انتهت صلاحية هذه الباقة في :date. جدد للوصول لجميع الميزات.',
        'employee_limit_exceeded' => 'لا يمكن إضافة موظف. العدد الحالي: :current، الحد الأقصى المسموح: :max',
        'employee_document_limit_exceeded' => 'لا يمكن إضافة مستند موظف. العدد الحالي: :current، الحد الأقصى المسموح: :max',
        'company_document_limit_exceeded' => 'لا يمكن إضافة مستند شركة. العدد الحالي: :current، الحد الأقصى المسموح: :max',
        'employee_addition_allowed' => 'يمكن إضافة موظف ضمن حدود الباقة.',
        'employee_document_addition_allowed' => 'يمكن إضافة مستند موظف ضمن حدود الباقة.',
        'company_document_addition_allowed' => 'يمكن إضافة مستند شركة ضمن حدود الباقة.',
        
        // Warning messages
        'package_expiring_soon' => 'تنتهي صلاحية الباقة خلال :days أيام. يرجى التجديد لتجنب انقطاع الخدمة.',
        'employee_limit_warning' => 'اقتراب من حد الموظفين. الحالي: :current، الأقصى: :max',
        'employee_document_limit_warning' => 'اقتراب من حد مستندات الموظفين. الحالي: :current، الحد الأقصى: :max',
        'company_document_limit_warning' => 'اقتراب من حد مستندات الشركة. الحالي: :current، الحد الأقصى: :max',
    ],

    // Table headers
    'table' => [
        'name' => 'الاسم',
        'price' => 'السعر',
        'duration' => 'المدة',
        'max_employees' => 'الحد الأقصى للموظفين',
        'max_employee_documents' => 'مستندات الموظفين',
        'max_company_documents' => 'مستندات الشركة',
        'actions' => 'الإجراءات',
    ],

    // Form placeholders
    'placeholders' => [
        'name' => 'أدخل اسم الباقة',
        'description' => 'أدخل وصف الباقة',
        'max_employees' => 'أدخل الحد الأقصى لعدد الموظفين',
        'max_employee_documents' => 'أدخل الحد الأقصى لعدد مستندات الموظفين',
        'max_company_documents' => 'أدخل الحد الأقصى لعدد مستندات الشركة',
        'price' => 'أدخل سعر الباقة',
        'duration' => 'أدخل المدة بالأشهر',
    ],

    // Help text
    'help' => [
        'max_employees' => 'الحد الأقصى لعدد الموظفين المسموح بهذه الباقة',
        'max_employee_documents' => 'الحد الأقصى لعدد مستندات الموظفين المسموح بهذه الباقة',
        'max_company_documents' => 'الحد الأقصى لعدد مستندات الشركة المسموح بهذه الباقة',
        'duration' => 'مدة الباقة بالأشهر',
        'price' => 'سعر الباقة بعملتك',
    ],
];

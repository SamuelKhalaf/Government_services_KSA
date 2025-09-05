<?php

return [
    // Page Titles
    'management' => 'إدارة أنواع الوثائق',
    'create' => 'إنشاء نوع وثيقة',
    'edit' => 'تعديل نوع الوثيقة',
    'list' => 'قائمة أنواع الوثائق',

    // Actions
    'add_document_type' => 'إضافة نوع وثيقة',
    'create_document_type' => 'إنشاء نوع الوثيقة',
    'update_document_type' => 'تحديث نوع الوثيقة',
    'back_to_list' => 'العودة إلى القائمة',
    'cancel' => 'إلغاء',
    'save' => 'حفظ',
    'edit_document_type' => 'تعديل نوع الوثيقة',
    'delete_document_type' => 'حذف نوع الوثيقة',

    // Form Sections
    'basic_information' => 'المعلومات الأساسية',
    'document_requirements' => 'متطلبات الوثيقة',
    'visual_elements' => 'العناصر المرئية',
    'descriptions' => 'الوصف',
    'status' => 'الحالة',

    // Form Fields
    'name_en' => 'الاسم (الإنجليزية)',
    'name_ar' => 'الاسم (العربية)',
    'code' => 'الرمز',
    'category' => 'الفئة',
    'entity_type' => 'نوع الكيان',
    'sort_order' => 'ترتيب الفرز',
    'requires_expiry_date' => 'يتطلب تاريخ انتهاء الصلاحية',
    'requires_file_upload' => 'يتطلب رفع ملف',
    'has_auto_reminder' => 'تذكير تلقائي',
    'reminder_days_before' => 'أيام التذكير قبل الانتهاء',
    'icon_class' => 'فئة الأيقونة',
    'color' => 'اللون',
    'description_en' => 'الوصف (الإنجليزية)',
    'description_ar' => 'الوصف (العربية)',
    'is_active' => 'نشط',

    // Form Options
    'select_category' => 'اختر الفئة',
    'select_entity_type' => 'اختر نوع الكيان',
    'employee' => 'موظف',
    'company' => 'شركة',
    'saudi' => 'سعودي',
    'expat' => 'مقيم',
    'both' => 'كليهما',

    // Table Headers
    'name' => 'الاسم',
    'code' => 'الرمز',
    'category' => 'الفئة',
    'entity_type' => 'نوع الكيان',
    'requirements' => 'المتطلبات',
    'status' => 'الحالة',
    'actions' => 'الإجراءات',

    // Table Data
    'all_categories' => 'جميع الفئات',
    'all_types' => 'جميع الأنواع',
    'all_status' => 'جميع الحالات',
    'active' => 'نشط',
    'inactive' => 'غير نشط',
    'expiry_date' => 'تاريخ انتهاء الصلاحية',
    'file_upload' => 'رفع ملف',
    'auto_reminder' => 'تذكير تلقائي',

    // Filters
    'filter' => 'تصفية',
    'reset' => 'إعادة تعيين',

    // Messages
    'no_document_types_found' => 'لم يتم العثور على أنواع وثائق',
    'document_type_created_successfully' => 'تم إنشاء نوع الوثيقة بنجاح.',
    'document_type_updated_successfully' => 'تم تحديث نوع الوثيقة بنجاح.',
    'document_type_deleted_successfully' => 'تم حذف نوع الوثيقة بنجاح.',
    'error_creating_document_type' => 'حدث خطأ أثناء إنشاء نوع الوثيقة. يرجى المحاولة مرة أخرى.',
    'error_updating_document_type' => 'حدث خطأ أثناء تحديث نوع الوثيقة. يرجى المحاولة مرة أخرى.',
    'error_deleting_document_type' => 'حدث خطأ أثناء حذف نوع الوثيقة. يرجى المحاولة مرة أخرى.',
    'cannot_delete_document_type' => 'لا يمكن حذف نوع الوثيقة. يتم استخدامه بواسطة وثائق موجودة.',
    'confirm_delete_document_type' => 'هل أنت متأكد من أنك تريد حذف نوع الوثيقة هذا؟',

    // Validation Messages
    'name_en_required' => 'الاسم (الإنجليزية) مطلوب.',
    'name_ar_required' => 'الاسم (العربية) مطلوب.',
    'code_required' => 'الرمز مطلوب.',
    'code_unique' => 'يجب أن يكون الرمز فريداً.',
    'category_required' => 'الفئة مطلوبة.',
    'entity_type_required' => 'نوع الكيان مطلوب.',
    'sort_order_numeric' => 'ترتيب الفرز يجب أن يكون رقماً.',
    'reminder_days_between' => 'أيام التذكير يجب أن تكون بين 1 و 365.',
    'icon_max_length' => 'فئة الأيقونة يجب ألا تتجاوز 100 حرف.',
    'color_max_length' => 'اللون يجب ألا يتجاوز 7 أحرف.',

    // Placeholders
    'icon_placeholder' => 'ki-duotone ki-document',
    'code_placeholder' => 'أدخل رمز فريد',
    'name_en_placeholder' => 'أدخل الاسم بالإنجليزية',
    'name_ar_placeholder' => 'أدخل الاسم بالعربية',
    'description_en_placeholder' => 'أدخل الوصف بالإنجليزية',
    'description_ar_placeholder' => 'أدخل الوصف بالعربية',

    // Help Text
    'code_help' => 'معرف فريد لهذا النوع من الوثائق',
    'category_help' => 'ما إذا كان نوع الوثيقة هذا للموظفين أم للشركات',
    'entity_type_help' => 'ما إذا كان نوع الوثيقة هذا ينطبق على السعوديين أم المقيمين أم كليهما',
    'sort_order_help' => 'الترتيب الذي يظهر به نوع الوثيقة هذا في القوائم',
    'reminder_days_help' => 'عدد الأيام قبل انتهاء الصلاحية لإرسال التذكير',
    'icon_help' => 'فئة CSS للأيقونة (مثل: ki-duotone ki-document)',
    'color_help' => 'اللون للأيقونة والعناصر المرئية',
];

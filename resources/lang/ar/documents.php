<?php

return [
    // Success Messages
    'document_uploaded_successfully' => 'تم رفع الوثيقة بنجاح.',
    'document_updated_successfully' => 'تم تحديث الوثيقة بنجاح.',
    'document_deleted_successfully' => 'تم حذف الوثيقة بنجاح.',
    'document_downloaded_successfully' => 'تم تحميل الوثيقة بنجاح.',

    // Error Messages
    'error_uploading_document' => 'حدث خطأ أثناء رفع الوثيقة. يرجى المحاولة مرة أخرى.',
    'error_updating_document' => 'حدث خطأ أثناء تحديث الوثيقة. يرجى المحاولة مرة أخرى.',
    'error_deleting_document' => 'حدث خطأ أثناء حذف الوثيقة. يرجى المحاولة مرة أخرى.',
    'error_downloading_document' => 'حدث خطأ أثناء تحميل الوثيقة. يرجى المحاولة مرة أخرى.',
    'document_file_not_found' => 'ملف الوثيقة غير موجود.',
    'document_type_not_found' => 'نوع الوثيقة غير موجود.',
    'file_upload_required' => 'رفع الملف مطلوب لهذا النوع من الوثائق.',
    'document_type_not_for_employees' => 'نوع الوثيقة هذا ليس للموظفين.',
    'document_type_not_compatible_saudi' => 'نوع الوثيقة هذا غير متوافق مع الموظفين السعوديين.',
    'document_type_not_compatible_expat' => 'نوع الوثيقة هذا غير متوافق مع الموظفين المغتربين.',
    'document_type_inactive' => 'نوع الوثيقة هذا غير نشط.',
    'required_field_missing' => 'الحقل المطلوب ":field" مفقود.',
    'no_compatible_document_types' => 'لم يتم العثور على أنواع وثائق متوافقة لهذا الموظف.',
    'reminder_help_text' => 'عدد الأيام قبل انتهاء الصلاحية لإرسال إشعار التذكير.',
    'file_upload_instructions' => 'رفع ملفات PDF أو JPG أو JPEG أو PNG (الحد الأقصى 10 ميجابايت).',
    'current_file' => 'الملف الحالي',
    'previously_selected' => 'تم اختياره مسبقاً',
    'select' => 'اختر',
    'status_active' => 'نشط',
    'status_expired' => 'منتهي الصلاحية',
    'status_cancelled' => 'ملغي',
    'status_pending' => 'معلق',
    'days_before_expiry' => 'أيام قبل انتهاء الصلاحية',
    'edit_document' => 'تعديل الوثيقة',
    'document_information' => 'معلومات الوثيقة',
    'document_fields' => 'حقول الوثيقة',
    'reminder_settings' => 'إعدادات التذكير',
    'enable_expiry_reminder' => 'تفعيل تذكير انتهاء الصلاحية',
    'remind_before_days' => 'تذكير قبل الأيام',
    'update_document' => 'تحديث الوثيقة',
    'please_wait' => 'يرجى الانتظار...',
    'active' => 'نشط',
    'expired' => 'منتهي الصلاحية',
    'cancelled' => 'ملغي',
    'pending' => 'معلق',
    'required_field_missing' => 'حقل :field مطلوب.',
    'invalid_email_format' => 'حقل :field يجب أن يكون عنوان بريد إلكتروني صحيح.',
    'invalid_date_format' => 'حقل :field يجب أن يكون تاريخ صحيح.',
    'invalid_number_format' => 'حقل :field يجب أن يكون رقم صحيح.',
    'invalid_file_format' => 'حقل :field يجب أن يكون ملف صحيح.',
    'invalid_file_type' => 'حقل :field يجب أن يكون ملف من نوع: pdf, jpg, jpeg, png.',
    'file_too_large' => 'حقل :field يجب ألا يتجاوز حجم الملف 10 ميجابايت.',
    'invalid_selection' => 'الاختيار المحدد في حقل :field غير صحيح.',
    'invalid_text_format' => 'حقل :field يجب أن يكون نص صحيح.',
    'text_too_long' => 'حقل :field يجب ألا يتجاوز 255 حرف.',
    'view_file' => 'عرض الملف',
    'document_dashboard' => 'لوحة إدارة الوثائق',
    'all_documents' => 'جميع الوثائق',
    'status_values' => [
        'active' => 'نشط',
        'expired' => 'منتهي الصلاحية',
        'cancelled' => 'ملغي',
        'pending' => 'في الانتظار',
        'under_process' => 'قيد المعالجة',
    ],

    // Validation Messages
    'document_type_required' => 'نوع الوثيقة مطلوب.',
    'document_type_exists' => 'نوع الوثيقة المحدد غير موجود.',
    'expiry_date_required' => 'تاريخ انتهاء الصلاحية مطلوب لهذا النوع من الوثائق.',
    'expiry_date_future' => 'تاريخ انتهاء الصلاحية يجب أن يكون في المستقبل.',
    'file_required' => 'الملف مطلوب لهذا النوع من الوثائق.',
    'file_type_invalid' => 'نوع ملف غير صحيح. الأنواع المسموحة: PDF, JPG, JPEG, PNG.',
    'file_size_exceeded' => 'حجم الملف يتجاوز الحد الأقصى البالغ 10 ميجابايت.',

    // Document Status
    'status_active' => 'نشط',
    'status_expired' => 'منتهي الصلاحية',
    'status_cancelled' => 'ملغي',
    'status_pending' => 'في الانتظار',
    'status_under_process' => 'قيد المعالجة',

    // Document Status (English)
    'status_active_en' => 'Active',
    'status_expired_en' => 'Expired',
    'status_cancelled_en' => 'Cancelled',
    'status_pending_en' => 'Pending',
    'status_under_process_en' => 'Under Process',

    // Document Status Values
    'status_values' => [
        'active' => 'نشط',
        'expired' => 'منتهي الصلاحية',
        'cancelled' => 'ملغي',
        'pending' => 'في الانتظار',
        'under_process' => 'قيد المعالجة',
    ],

    // Document Status Values (English)
    'status_values_en' => [
        'active' => 'Active',
        'expired' => 'Expired',
        'cancelled' => 'Cancelled',
        'pending' => 'Pending',
        'under_process' => 'Under Process',
    ],

    // Document Status Badge Colors
    'status_colors' => [
        'active' => 'success',
        'expired' => 'danger',
        'cancelled' => 'warning',
        'pending' => 'info',
        'under_process' => 'primary',
    ],

    // Document Types
    'document_types' => [
        'employee' => 'وثائق الموظفين',
        'company' => 'وثائق المنشأت',
        'saudi' => 'وثائق السعوديين',
        'expat' => 'وثائق المغتربين',
        'both' => 'وثائق عامة',
    ],

    // Document Types (English)
    'document_types_en' => [
        'employee' => 'Employee Documents',
        'company' => 'Company Documents',
        'saudi' => 'Saudi Documents',
        'expat' => 'Expat Documents',
        'both' => 'Universal Documents',
    ],

    // File Information
    'file_information' => 'معلومات الملف',
    'file_path' => 'مسار الملف',
    'original_filename' => 'اسم الملف الأصلي',
    'file_type' => 'نوع الملف',
    'file_size' => 'حجم الملف',
    'upload_date' => 'تاريخ الرفع',
    'last_modified' => 'آخر تعديل',

    // Document Information
    'document_information' => 'معلومات الوثيقة',
    'document_number' => 'رقم الوثيقة',
    'issue_date' => 'تاريخ الإصدار',
    'expiry_date' => 'تاريخ انتهاء الصلاحية',
    'issuing_authority' => 'جهة الإصدار',
    'place_of_issue' => 'مكان الإصدار',
    'status' => 'الحالة',
    'notes' => 'ملاحظات',
    'renewal_notes' => 'ملاحظات التجديد',
    'search_documents' => 'البحث في الوثائق',
    'documents_list' => 'قائمة الوثائق',
    'document_type' => 'نوع الوثيقة',
    'no_documents_found' => 'لم يتم العثور على وثائق',

    // Actions
    'actions' => 'الإجراءات',
    'view' => 'عرض',
    'edit' => 'تعديل',
    'delete' => 'حذف',
    'download' => 'تحميل',
    'upload' => 'رفع',
    'renew' => 'تجديد',
    'extend' => 'تمديد',

    // Confirmation Messages
    'confirm_delete' => 'هل أنت متأكد من أنك تريد حذف هذه الوثيقة؟',
    'confirm_renew' => 'هل أنت متأكد من أنك تريد تجديد هذه الوثيقة؟',
    'confirm_extend' => 'هل أنت متأكد من أنك تريد تمديد هذه الوثيقة؟',
    'delete_document_warning' => 'هل أنت متأكد من أنك تريد حذف هذه الوثيقة؟ لا يمكن التراجع عن هذا الإجراء.',

    // Reminder Information
    'reminder_information' => 'معلومات التذكير',
    'auto_reminder' => 'تذكير تلقائي',
    'reminder_date' => 'تاريخ التذكير',
    'reminder_days_before' => 'أيام التذكير قبل انتهاء الصلاحية',
    'reminder_enabled' => 'التذكير مفعل',
    'reminder_disabled' => 'التذكير معطل',

    // Expiry Information
    'expiry_information' => 'معلومات انتهاء الصلاحية',
    'days_until_expiry' => 'الأيام حتى انتهاء الصلاحية',
    'expired_days_ago' => 'انتهت الصلاحية منذ :days يوم',
    'expires_in_days' => 'تنتهي الصلاحية خلال :days يوم',
    'expires_today' => 'تنتهي الصلاحية اليوم',
    'expired_today' => 'انتهت الصلاحية اليوم',

    // Document Categories
    'categories' => [
        'visa' => 'وثائق التأشيرة',
        'passport' => 'وثائق جواز السفر',
        'work_permit' => 'وثائق تصريح العمل',
        'medical' => 'وثائق طبية',
        'insurance' => 'وثائق التأمين',
        'contract' => 'وثائق العقد',
        'other' => 'وثائق أخرى',
    ],

    // Document Categories (English)
    'categories_en' => [
        'visa' => 'Visa Documents',
        'passport' => 'Passport Documents',
        'work_permit' => 'Work Permit Documents',
        'medical' => 'Medical Documents',
        'insurance' => 'Insurance Documents',
        'contract' => 'Contract Documents',
        'other' => 'Other Documents',
    ],

    // Field Labels
    'fields' => [
        'visa_type' => 'نوع التأشيرة',
        'sponsor_name' => 'اسم الكفيل',
        'sponsor_id' => 'رقم الكفيل',
        'visa_purpose' => 'غرض التأشيرة',
        'duration_days' => 'المدة (أيام)',
        'travel_type' => 'نوع السفر',
        'travel_date' => 'تاريخ السفر',
        'return_date' => 'تاريخ العودة',
        'destination_country' => 'بلد الوجهة',
        'fees_paid' => 'الرسوم المدفوعة',
        'payment_method' => 'طريقة الدفع',
        'receipt_number' => 'رقم الإيصال',
    ],

    // Field Labels (English)
    'fields_en' => [
        'visa_type' => 'Visa Type',
        'sponsor_name' => 'Sponsor Name',
        'sponsor_id' => 'Sponsor ID',
        'visa_purpose' => 'Visa Purpose',
        'duration_days' => 'Duration (Days)',
        'travel_type' => 'Travel Type',
        'travel_date' => 'Travel Date',
        'return_date' => 'Return Date',
        'destination_country' => 'Destination Country',
        'fees_paid' => 'Fees Paid',
        'payment_method' => 'Payment Method',
        'receipt_number' => 'Receipt Number',
    ],

    // Travel Types
    'travel_types' => [
        'single' => 'دخول واحد',
        'multiple' => 'دخول متعدد',
    ],

    // Travel Types (English)
    'travel_types_en' => [
        'single' => 'Single Entry',
        'multiple' => 'Multiple Entry',
    ],

    // Document Status Values
    'document_status_values' => [
        'original' => 'أصلي',
        'copy' => 'نسخة',
        'certified_copy' => 'نسخة مصدقة',
    ],

    // Document Status Values (English)
    'document_status_values_en' => [
        'original' => 'Original',
        'copy' => 'Copy',
        'certified_copy' => 'Certified Copy',
    ],

    // Additional missing keys for document views
    'add_document' => 'إضافة وثيقة',
    'edit_document' => 'تعديل الوثيقة',
    'delete_document' => 'حذف الوثيقة',
    'view_document' => 'عرض الوثيقة',
    'download_file' => 'تحميل الملف',
    'add_document_for' => 'إضافة وثيقة لـ',
    'select_document_type' => 'اختر نوع الوثيقة',
    'document_details' => 'تفاصيل الوثيقة',
    'document_fields' => 'حقول الوثيقة',
    'additional_info' => 'معلومات إضافية',
    'additional_information' => 'معلومات إضافية',
    'document_file' => 'ملف الوثيقة',
    'pdf_document' => 'وثيقة PDF',
    'click_download_to_view' => 'اضغط للتحميل لعرض',
    'confirm_delete_document' => 'تأكيد حذف الوثيقة',
    'type' => 'النوع',
    'delete_warning' => 'لا يمكن التراجع عن هذا الإجراء.',
    'update_document' => 'تحديث الوثيقة',
    'please_wait' => 'يرجى الانتظار...',
    'employee' => 'الموظف',
    'company' => 'الشركة',
    'expiring_soon' => 'تنتهي قريباً',
    'already_expired' => 'منتهية الصلاحية',
    'valid' => 'صالح',
    'fees' => 'الرسوم',
    'fees_amount' => 'مبلغ الرسوم',
    'reference_number' => 'رقم المرجع',
    'reminder_settings' => 'إعدادات التذكير',
    'days_before_expiry' => 'أيام قبل انتهاء الصلاحية',
    'enable_expiry_reminder' => 'تفعيل تذكير انتهاء الصلاحية',
    'remind_before_days' => 'تذكير قبل (أيام)',
    'active' => 'نشط',
    'expired' => 'منتهي الصلاحية',
    'cancelled' => 'ملغي',
    'pending' => 'في الانتظار',
    'under_process' => 'قيد المعالجة',
    'filter_options' => 'خيارات التصفية',
    'all_types' => 'جميع الأنواع',
    'all_statuses' => 'جميع الحالات',
    'documents_list' => 'قائمة الوثائق',
    'employee_documents' => 'وثائق الموظفين',
    'company_documents' => 'وثائق الشركات',
    'document' => 'الوثيقة',
];

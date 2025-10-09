<?php

return [
    // Success Messages
    'document_uploaded_successfully' => 'Document uploaded successfully.',
    'document_updated_successfully' => 'Document updated successfully.',
    'document_deleted_successfully' => 'Document deleted successfully.',
    'document_downloaded_successfully' => 'Document downloaded successfully.',

    // Error Messages
    'error_uploading_document' => 'An error occurred while uploading the document. Please try again.',
    'error_updating_document' => 'An error occurred while updating the document. Please try again.',
    'error_deleting_document' => 'An error occurred while deleting the document. Please try again.',
    'error_downloading_document' => 'An error occurred while downloading the document. Please try again.',
    'document_file_not_found' => 'Document file not found.',
    'document_type_not_found' => 'Document type not found.',
    'file_upload_required' => 'File upload is required for this document type.',
    'document_type_not_for_employees' => 'This document type is not for employees.',
    'document_type_not_compatible_saudi' => 'This document type is not compatible with Saudi employees.',
    'document_type_not_compatible_expat' => 'This document type is not compatible with expat employees.',
    'document_type_inactive' => 'This document type is inactive.',
    'required_field_missing' => 'Required field ":field" is missing.',
    'no_compatible_document_types' => 'No compatible document types found for this employee.',
    'reminder_help_text' => 'Number of days before expiry to send reminder notification.',
    'file_upload_instructions' => 'Upload PDF, JPG, JPEG, or PNG files (max 10MB).',
    'current_file' => 'Current file',
    'previously_selected' => 'Previously selected',
    'select' => 'Select',
    'status_active' => 'Active',
    'status_expired' => 'Expired',
    'status_cancelled' => 'Cancelled',
    'status_pending' => 'Pending',
    'days_before_expiry' => 'days before expiry',
    'edit_document' => 'Edit Document',
    'document_information' => 'Document Information',
    'document_fields' => 'Document Fields',
    'reminder_settings' => 'Reminder Settings',
    'enable_expiry_reminder' => 'Enable Expiry Reminder',
    'remind_before_days' => 'Remind Before Days',
    'update_document' => 'Update Document',
    'please_wait' => 'Please wait...',
    'active' => 'Active',
    'expired' => 'Expired',
    'cancelled' => 'Cancelled',
    'pending' => 'Pending',
    'required_field_missing' => 'The :field field is required.',
    'invalid_email_format' => 'The :field field must be a valid email address.',
    'invalid_date_format' => 'The :field field must be a valid date.',
    'invalid_number_format' => 'The :field field must be a valid number.',
    'invalid_file_format' => 'The :field field must be a valid file.',
    'invalid_file_type' => 'The :field field must be a file of type: pdf, jpg, jpeg, png.',
    'file_too_large' => 'The :field field file size must not exceed 10MB.',
    'invalid_selection' => 'The selected :field field is invalid.',
    'invalid_text_format' => 'The :field field must be a valid text.',
    'text_too_long' => 'The :field field must not exceed 255 characters.',
    'view_file' => 'View file',
    'document_dashboard' => 'Document Dashboard',
    'all_documents' => 'All Documents',
    'status_values' => [
        'active' => 'Active',
        'expired' => 'Expired',
        'cancelled' => 'Cancelled',
        'pending' => 'Pending',
        'under_process' => 'Under Process',
    ],

    // Validation Messages
    'document_type_required' => 'Document type is required.',
    'document_type_exists' => 'Selected document type does not exist.',
    'expiry_date_required' => 'Expiry date is required for this document type.',
    'expiry_date_future' => 'Expiry date must be in the future.',
    'file_required' => 'File is required for this document type.',
    'file_type_invalid' => 'Invalid file type. Allowed types: PDF, JPG, JPEG, PNG.',
    'file_size_exceeded' => 'File size exceeds the maximum limit of 10MB.',

    // Document Status
    'status_active' => 'Active',
    'status_expired' => 'Expired',
    'status_cancelled' => 'Cancelled',
    'status_pending' => 'Pending',
    'status_under_process' => 'Under Process',

    // Document Status (Arabic)
    'status_active_ar' => 'نشط',
    'status_expired_ar' => 'منتهي الصلاحية',
    'status_cancelled_ar' => 'ملغي',
    'status_pending_ar' => 'في الانتظار',
    'status_under_process_ar' => 'قيد المعالجة',

    // Document Status Values
    'status_values' => [
        'active' => 'Active',
        'expired' => 'Expired',
        'cancelled' => 'Cancelled',
        'pending' => 'Pending',
        'under_process' => 'Under Process',
    ],

    // Document Status Values (Arabic)
    'status_values_ar' => [
        'active' => 'نشط',
        'expired' => 'منتهي الصلاحية',
        'cancelled' => 'ملغي',
        'pending' => 'في الانتظار',
        'under_process' => 'قيد المعالجة',
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
        'employee' => 'Employee Documents',
        'company' => 'Company Documents',
        'saudi' => 'Saudi Documents',
        'expat' => 'Expat Documents',
        'both' => 'Universal Documents',
    ],

    // Document Types (Arabic)
    'document_types_ar' => [
        'employee' => 'وثائق الموظفين',
        'company' => 'وثائق الشركات',
        'saudi' => 'وثائق السعوديين',
        'expat' => 'وثائق المقيمين',
        'both' => 'وثائق عامة',
    ],

    // File Information
    'file_information' => 'File Information',
    'file_path' => 'File Path',
    'original_filename' => 'Original Filename',
    'file_type' => 'File Type',
    'file_size' => 'File Size',
    'upload_date' => 'Upload Date',
    'last_modified' => 'Last Modified',

    // Document Information
    'document_information' => 'Document Information',
    'document_number' => 'Document Number',
    'issue_date' => 'Issue Date',
    'expiry_date' => 'Expiry Date',
    'issuing_authority' => 'Issuing Authority',
    'place_of_issue' => 'Place of Issue',
    'status' => 'Status',
    'notes' => 'Notes',
    'renewal_notes' => 'Renewal Notes',
    'search_documents' => 'Search Documents',
    'documents_list' => 'Documents List',
    'document_type' => 'Document Type',
    'no_documents_found' => 'No documents found',
    // Actions
    'actions' => 'Actions',
    'view' => 'View',
    'edit' => 'Edit',
    'delete' => 'Delete',
    'download' => 'Download',
    'upload' => 'Upload',
    'renew' => 'Renew',
    'extend' => 'Extend',

    // Confirmation Messages
    'confirm_delete' => 'Are you sure you want to delete this document?',
    'confirm_renew' => 'Are you sure you want to renew this document?',
    'confirm_extend' => 'Are you sure you want to extend this document?',
    'delete_document_warning' => 'Are you sure you want to delete this document? This action cannot be undone.',

    // Reminder Information
    'reminder_information' => 'Reminder Information',
    'auto_reminder' => 'Auto Reminder',
    'reminder_date' => 'Reminder Date',
    'reminder_days_before' => 'Reminder Days Before Expiry',
    'reminder_enabled' => 'Reminder Enabled',
    'reminder_disabled' => 'Reminder Disabled',

    // Expiry Information
    'expiry_information' => 'Expiry Information',
    'days_until_expiry' => 'Days Until Expiry',
    'expired_days_ago' => 'Expired :days days ago',
    'expires_in_days' => 'Expires in :days days',
    'expires_today' => 'Expires today',
    'expired_today' => 'Expired today',

    // Document Categories
    'categories' => [
        'visa' => 'Visa Documents',
        'passport' => 'Passport Documents',
        'work_permit' => 'Work Permit Documents',
        'medical' => 'Medical Documents',
        'insurance' => 'Insurance Documents',
        'contract' => 'Contract Documents',
        'other' => 'Other Documents',
    ],

    // Document Categories (Arabic)
    'categories_ar' => [
        'visa' => 'وثائق التأشيرة',
        'passport' => 'وثائق جواز السفر',
        'work_permit' => 'وثائق تصريح العمل',
        'medical' => 'وثائق طبية',
        'insurance' => 'وثائق التأمين',
        'contract' => 'وثائق العقد',
        'other' => 'وثائق أخرى',
    ],

    // Field Labels
    'fields' => [
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

    // Field Labels (Arabic)
    'fields_ar' => [
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

    // Travel Types
    'travel_types' => [
        'single' => 'Single Entry',
        'multiple' => 'Multiple Entry',
    ],

    // Travel Types (Arabic)
    'travel_types_ar' => [
        'single' => 'دخول واحد',
        'multiple' => 'دخول متعدد',
    ],

    // Document Status Values
    'document_status_values' => [
        'original' => 'Original',
        'copy' => 'Copy',
        'certified_copy' => 'Certified Copy',
    ],

    // Document Status Values (Arabic)
    'document_status_values_ar' => [
        'original' => 'أصلي',
        'copy' => 'نسخة',
        'certified_copy' => 'نسخة مصدقة',
    ],

    // Additional missing keys for document views
    'add_document' => 'Add Document',
    'edit_document' => 'Edit Document',
    'delete_document' => 'Delete Document',
    'view_document' => 'View Document',
    'download_file' => 'Download File',
    'add_document_for' => 'Add Document for',
    'select_document_type' => 'Select Document Type',
    'document_details' => 'Document Details',
    'document_fields' => 'Document Fields',
    'additional_info' => 'Additional Information',
    'additional_information' => 'Additional Information',
    'document_file' => 'Document File',
    'pdf_document' => 'PDF Document',
    'click_download_to_view' => 'Click download to view',
    'confirm_delete_document' => 'Confirm Delete Document',
    'type' => 'Type',
    'delete_warning' => 'This action cannot be undone.',
    'update_document' => 'Update Document',
    'please_wait' => 'Please wait...',
    'employee' => 'Employee',
    'company' => 'Company',
    'expiring_soon' => 'Expiring Soon',
    'already_expired' => 'Already Expired',
    'valid' => 'Valid',
    'fees' => 'Fees',
    'fees_amount' => 'Fees Amount',
    'reference_number' => 'Reference Number',
    'reminder_settings' => 'Reminder Settings',
    'days_before_expiry' => 'days before expiry',
    'enable_expiry_reminder' => 'Enable Expiry Reminder',
    'remind_before_days' => 'Remind Before (Days)',
    'active' => 'Active',
    'expired' => 'Expired',
    'cancelled' => 'Cancelled',
    'pending' => 'Pending',
    'under_process' => 'Under Process',
    'filter_options' => 'Filter Options',
    'all_types' => 'All Types',
    'all_statuses' => 'All Statuses',
    'documents_list' => 'Documents List',
    'employee_documents' => 'Employee Documents',
    'company_documents' => 'Company Documents',
    'document' => 'Document',
];

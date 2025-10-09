<?php

return [
    'add_payment' => 'إضافة دفعة',
    'add_payment_for_invoice' => 'إضافة دفعة للفاتورة',
    'payment_history' => 'تاريخ المدفوعات',
    'payment_history_for_invoice' => 'تاريخ المدفوعات للفاتورة',
    'payment_details' => 'تفاصيل الدفعة',
    'invoice_summary' => 'ملخص الفاتورة',
    'payment_status' => 'حالة الدفع',
    'total_paid' => 'إجمالي المدفوع',
    'remaining_balance' => 'الرصيد المتبقي',
    'amount' => 'المبلغ',
    'payment_date' => 'تاريخ الدفع',
    'payment_method' => 'طريقة الدفع',
    'reference_number' => 'رقم المرجع',
    'notes' => 'ملاحظات',
    'record_payment' => 'تسجيل الدفعة',
    'pay' => 'دفع',
    'history' => 'التاريخ',
    'partial_payment_detected' => 'هذه الفاتورة لديها مدفوعات جزئية',
    'max_amount' => 'الحد الأقصى للمبلغ',
    'reference_placeholder' => 'مرجع البنك، رقم الشيك، إلخ',
    'reference_help' => 'رقم مرجع اختياري للمتابعة',
    'notes_placeholder' => 'ملاحظات إضافية حول هذه الدفعة',
    'select_payment_method' => 'اختر طريقة الدفع',
    
    'methods' => [
        'cash' => 'نقداً',
        'bank_transfer' => 'تحويل بنكي',
        'credit_card' => 'بطاقة ائتمان',
        'check' => 'شيك',
        'other' => 'أخرى',
    ],
    
    'messages' => [
        'payment_recorded' => 'تم تسجيل الدفعة بنجاح',
        'payment_completed_invoice_paid' => 'تم تسجيل الدفعة بنجاح. الفاتورة مدفوعة بالكامل الآن!',
        'payment_failed' => 'فشل في تسجيل الدفعة. يرجى المحاولة مرة أخرى.',
        'payment_deleted' => 'تم حذف الدفعة بنجاح',
        'payment_delete_failed' => 'فشل في حذف الدفعة. يرجى المحاولة مرة أخرى.',
        'cannot_pay_cancelled_invoice' => 'لا يمكن الدفع للفواتير الملغية',
        'invoice_already_paid' => 'هذه الفاتورة مدفوعة بالكامل بالفعل',
        'no_payments_found' => 'لم يتم العثور على مدفوعات',
        'no_payments_description' => 'هذه الفاتورة لا تحتوي على سجلات دفع بعد.',
        'confirm_delete_payment' => 'هل أنت متأكد من أنك تريد حذف هذه الدفعة؟ لا يمكن التراجع عن هذا الإجراء.',
    ],
    
    'validation' => [
        'amount_exceeds_balance' => 'مبلغ الدفع لا يمكن أن يتجاوز الرصيد المتبقي',
    ],
];

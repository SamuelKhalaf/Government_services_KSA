<?php

return [
    'add_payment' => 'Add Payment',
    'add_payment_for_invoice' => 'Add Payment for Invoice',
    'payment_history' => 'Payment History',
    'payment_history_for_invoice' => 'Payment History for Invoice',
    'payment_details' => 'Payment Details',
    'invoice_summary' => 'Invoice Summary',
    'payment_status' => 'Payment Status',
    'total_paid' => 'Total Paid',
    'remaining_balance' => 'Remaining Balance',
    'amount' => 'Amount',
    'payment_date' => 'Payment Date',
    'payment_method' => 'Payment Method',
    'reference_number' => 'Reference Number',
    'notes' => 'Notes',
    'record_payment' => 'Record Payment',
    'pay' => 'Pay',
    'history' => 'History',
    'partial_payment_detected' => 'This invoice has partial payments',
    'max_amount' => 'Maximum amount',
    'reference_placeholder' => 'Bank reference, check number, etc.',
    'reference_help' => 'Optional reference number for tracking',
    'notes_placeholder' => 'Additional notes about this payment',
    'select_payment_method' => 'Select Payment Method',
    
    'methods' => [
        'cash' => 'Cash',
        'bank_transfer' => 'Bank Transfer',
        'credit_card' => 'Credit Card',
        'check' => 'Check',
        'other' => 'Other',
    ],
    
    'messages' => [
        'payment_recorded' => 'Payment recorded successfully',
        'payment_completed_invoice_paid' => 'Payment recorded successfully. Invoice is now fully paid!',
        'payment_failed' => 'Failed to record payment. Please try again.',
        'payment_deleted' => 'Payment deleted successfully',
        'payment_delete_failed' => 'Failed to delete payment. Please try again.',
        'cannot_pay_cancelled_invoice' => 'Cannot make payments on cancelled invoices',
        'invoice_already_paid' => 'This invoice is already fully paid',
        'no_payments_found' => 'No payments found',
        'no_payments_description' => 'This invoice has no payment records yet.',
        'confirm_delete_payment' => 'Are you sure you want to delete this payment? This action cannot be undone.',
    ],
    
    'validation' => [
        'amount_exceeds_balance' => 'Payment amount cannot exceed the remaining balance',
    ],
];

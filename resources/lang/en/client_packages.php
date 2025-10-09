<?php

return [
    // Titles
    'assign_package' => 'Assign Package',
    'renew_package' => 'Renew Package',
    'cancel_package' => 'Cancel Package',
    'change_package' => 'Change Package',
    'current_package' => 'Current Package',
    'package_assignment' => 'Package Assignment',
    'invoice' => 'Invoice',
    'invoices' => 'Invoices',

    // Form Labels
    'select_package' => 'Select Package',
    'package_details' => 'Package Details',
    'start_date' => 'Start Date',
    'end_date' => 'End Date',
    'new_end_date' => 'New End Date',
    'confirm_renewal' => 'I confirm that I want to renew this package',

    // Buttons
    'assign' => 'Assign Package',
    'renew' => 'Renew Package',
    'cancel' => 'Cancel Package',
    'change' => 'Change Package',

    // Status
    'active' => 'Active',
    'expired' => 'Expired',
    'canceled' => 'Canceled',

    // Messages
    'messages' => [
        'package_assigned_successfully' => 'Package assigned successfully',
        'package_renewed_successfully' => 'Package renewed successfully',
        'package_canceled_successfully' => 'Package canceled successfully',
        'package_changed_successfully' => 'Package changed successfully',
        'client_has_active_package' => 'Client already has an active package',
        'no_package_assigned' => 'No package assigned to this client',
        'package_expires_on' => 'Package expires on',
        'package_renewed_until' => 'Package renewed until',
        'confirm_cancel_package' => 'Are you sure you want to cancel this package?',
        'package_required_notice' => 'A package is required to add employees, upload documents, and use system features.',
    ],

    // Validation
    'validation' => [
        'package_required' => 'Please select a package',
        'package_exists' => 'Selected package does not exist',
        'confirm_renewal_required' => 'Please confirm the renewal',
        'confirm_renewal_accepted' => 'You must confirm the renewal',
    ],

    // Help Text
    'help' => [
        'select_package' => 'Choose a package to assign to this client',
        'renewal_info' => 'Renewing will extend the package duration by the original period',
        'change_info' => 'Changing package will cancel the current one and assign the new one',
    ],

    // Labels
    'package' => 'Package',

    // Additional Messages
    'messages_no_invoices_found' => 'No invoices found for this client',
    'messages' => [
        // keep existing keys and add missing
        'package_assigned_successfully' => 'Package assigned successfully',
        'package_renewed_successfully' => 'Package renewed successfully',
        'package_canceled_successfully' => 'Package canceled successfully',
        'package_changed_successfully' => 'Package changed successfully',
        'client_has_active_package' => 'Client already has an active package',
        'no_package_assigned' => 'No package assigned to this client',
        'package_expires_on' => 'Package expires on',
        'package_renewed_until' => 'Package renewed until',
        'confirm_cancel_package' => 'Are you sure you want to cancel this package?',
        'package_required_notice' => 'A package is required to add employees, upload documents, and use system features.',
        'no_invoices_found' => 'No invoices found',
    ],
];

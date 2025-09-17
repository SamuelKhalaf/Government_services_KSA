<?php

return [
    // Page titles
    'packages_management' => 'Packages Management',
    'packages' => 'Packages',
    'package' => 'Package',
    'add_package' => 'Add Package',
    'edit_package' => 'Edit Package',
    'package_details' => 'Package Details',
    'package_list' => 'Package List',
    'create_new_package' => 'Create New Package',
    'current_package_status' => 'Current package status and usage limits',
    'limit_reached' => 'Limit Reached',
    'assign_package_to_continue' => 'Please assign a package to this company to continue using the system.',
    'usage_statistics' => 'Usage Statistics',
    'package_timeline' => 'Package Timeline',

    // Package fields
    'name' => 'Package Name',
    'description' => 'Description',
    'max_employees' => 'Max Employees',
    'max_employee_documents' => 'Max Employee Documents',
    'max_company_documents' => 'Max Company Documents',
    'price' => 'Price',
    'duration' => 'Duration (Months)',
    'status' => 'Status',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',

    // Actions
    'create' => 'Create',
    'edit' => 'Edit',
    'delete' => 'Delete',
    'view' => 'View',
    'save' => 'Save',
    'cancel' => 'Cancel',
    'back' => 'Back',
    'confirm_delete' => 'Confirm Delete',
    'are_you_sure_delete' => 'Are you sure you want to delete this package?',

    // Status values
    'active' => 'Active',
    'inactive' => 'Inactive',

    // Messages
    'messages' => [
        'created_successfully' => 'Package created successfully',
        'updated_successfully' => 'Package updated successfully',
        'deleted_successfully' => 'Package deleted successfully',
        'cannot_delete_active_package' => 'Cannot delete package with active client assignments',
        'no_packages_found' => 'No packages found',
    ],

    // Validation messages
    'validation' => [
        'name_required' => 'Package name is required',
        'name_max' => 'Package name cannot exceed 255 characters',
        'max_employees_integer' => 'Max employees must be a number',
        'max_employees_min' => 'Max employees must be at least 1',
        'max_employee_documents_integer' => 'Max employee documents must be a number',
        'max_employee_documents_min' => 'Max employee documents must be at least 1',
        'max_company_documents_integer' => 'Max company documents must be a number',
        'max_company_documents_min' => 'Max company documents must be at least 1',
        'price_required' => 'Price is required',
        'price_numeric' => 'Price must be a number',
        'price_min' => 'Price must be at least 0',
        'duration_required' => 'Duration is required',
        'duration_integer' => 'Duration must be a number',
        'duration_min' => 'Duration must be at least 1 month',
        
        // Package limit validation messages
        'no_active_package' => 'This company does not have an active package. Please assign a package first.',
        'package_expired' => 'The company\'s package has expired. Please renew or assign a new package.',
        'package_expired_detailed' => 'Package expired :days days ago on :date. All operations are blocked until renewal.',
        'package_expired_grace' => 'Package expired recently. You have a :grace_days day grace period to renew.',
        'expired_package_notice' => 'This package expired on :date. Renew to restore access to all features.',
        'employee_limit_exceeded' => 'Cannot add employee. Current count: :current, Maximum allowed: :max',
        'employee_document_limit_exceeded' => 'Cannot add employee document. Current count: :current, Maximum allowed: :max',
        'company_document_limit_exceeded' => 'Cannot add company document. Current count: :current, Maximum allowed: :max',
        'employee_addition_allowed' => 'Employee can be added within package limits.',
        'employee_document_addition_allowed' => 'Employee document can be added within package limits.',
        'company_document_addition_allowed' => 'Company document can be added within package limits.',
        
        // Warning messages
        'package_expiring_soon' => 'Package expires in :days days. Please renew to avoid service interruption.',
        'employee_limit_warning' => 'Approaching employee limit. Current: :current, Maximum: :max',
        'employee_document_limit_warning' => 'Approaching employee document limit. Current: :current, Maximum: :max',
        'company_document_limit_warning' => 'Approaching company document limit. Current: :current, Maximum: :max',
    ],

    // Table headers
    'table' => [
        'name' => 'Name',
        'price' => 'Price',
        'duration' => 'Duration',
        'max_employees' => 'Max Employees',
        'max_employee_documents' => 'Employee Documents',
        'max_company_documents' => 'Company Documents',
        'actions' => 'Actions',
    ],

    // Form placeholders
    'placeholders' => [
        'name' => 'Enter package name',
        'description' => 'Enter package description',
        'max_employees' => 'Enter maximum number of employees',
        'max_employee_documents' => 'Enter maximum number of employee documents',
        'max_company_documents' => 'Enter maximum number of company documents',
        'price' => 'Enter package price',
        'duration' => 'Enter duration in months',
    ],

    // Help text
    'help' => [
        'max_employees' => 'Maximum number of employees this package allows',
        'max_employee_documents' => 'Maximum number of employee documents this package allows',
        'max_company_documents' => 'Maximum number of company documents this package allows',
        'duration' => 'Package duration in months',
        'price' => 'Package price in your currency',
    ],
];

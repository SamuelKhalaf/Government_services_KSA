<?php

return [
    // Page titles
    'tasks_management' => 'Tasks Management',
    'tasks' => 'Tasks',
    'task' => 'Task',
    'add_task' => 'Add Task',
    'edit_task' => 'Edit Task',
    'task_details' => 'Task Details',
    'task_list' => 'Task List',
    'my_tasks' => 'My Tasks',
    'all_tasks' => 'All Tasks',

    // Task fields
    'title' => 'Title',
    'description' => 'Description',
    'client' => 'Client',
    'document_type' => 'Document Type',
    'document' => 'Document',
    'company_document' => 'Company Document',
    'employee_document' => 'Employee Document',
    'civil_defense_license' => 'Civil Defense License',
    'municipality_license' => 'Municipality License',
    'branch_registration' => 'Branch Registration',
    'assigned_to' => 'Assigned To',
    'assigned_user' => 'Assigned User',
    'created_by' => 'Created By',
    'creator' => 'Creator',
    'due_date' => 'Due Date',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',

    // Task statuses
    'status' => 'Status',
    'new' => 'New',
    'in_progress' => 'In Progress',
    'completed' => 'Completed',
    'pending' => 'Pending',

    // Task actions
    'create_task' => 'Create Task',
    'update_task' => 'Update Task',
    'delete_task' => 'Delete Task',
    'view_task' => 'View Task',
    'edit_task' => 'Edit Task',
    'assign_task' => 'Assign Task',
    'complete_task' => 'Complete Task',
    'start_task' => 'Start Task',
    'pause_task' => 'Pause Task',

    // Task history
    'task_history' => 'Task History',
    'history' => 'History',
    'activity_log' => 'Activity Log',
    'changes' => 'Changes',
    'action' => 'Action',
    'changed_by' => 'Changed By',
    'old_value' => 'Old Value',
    'new_value' => 'New Value',
    'note' => 'Note',
    'notes' => 'Notes',
    'add_note' => 'Add Note',

    // History actions
    'created' => 'Created',
    'updated' => 'Updated',
    'status_changed' => 'Status Changed',
    'note_added' => 'Note Added',
    'deleted' => 'Deleted',

    // Messages
    'task_created_successfully' => 'Task created successfully!',
    'task_updated_successfully' => 'Task updated successfully!',
    'task_deleted_successfully' => 'Task deleted successfully!',
    'bulk_tasks_created_successfully' => ':count tasks created and assigned successfully!',
    'note_added_successfully' => 'Note added successfully!',
    'status_updated_successfully' => 'Status updated successfully!',
    'task_not_found' => 'Task not found.',
    'access_denied' => 'Access denied. You do not have permission to view this task.',
    'cannot_view_tasks' => 'You do not have permission to view tasks.',
    'cannot_create_tasks' => 'You do not have permission to create tasks.',
    'cannot_update_tasks' => 'You do not have permission to update tasks.',
    'cannot_delete_tasks' => 'You do not have permission to delete tasks.',
    'cannot_manage_task_documents' => 'You do not have permission to manage task documents.',

    // Validation messages
    'title_required' => 'Task title is required.',
    'title_max' => 'Task title must be less than 255 characters.',
    'document_type_required' => 'Document type is required.',
    'document_type_invalid' => 'Invalid document type.',
    'document_required' => 'Document is required.',
    'document_invalid' => 'Invalid document selection.',
    'company_document_not_found' => 'Selected company document not found.',
    'employee_document_not_found' => 'Selected employee document not found.',
    'civil_defense_license_not_found' => 'Selected civil defense license not found.',
    'municipality_license_not_found' => 'Selected municipality license not found.',
    'branch_registration_not_found' => 'Selected branch registration not found.',
    'user_must_be_employee' => 'Only employees can be assigned to tasks.',
    'document_not_found' => 'Document not found.',
    'unknown_document' => 'Unknown document type.',
    'client_required' => 'Client is required.',
    'client_not_found' => 'Selected client not found.',
    'assigned_to_required' => 'Assigned user is required.',
    'assigned_to_not_found' => 'Selected assigned user not found.',
    'status_invalid' => 'Invalid task status.',
    'due_date_invalid' => 'Invalid due date.',
    'due_date_future' => 'Due date must be today or in the future.',
    'note_required' => 'Note is required.',
    'note_max' => 'Note must be less than 1000 characters.',

    // Filters and search
    'filter_by_status' => 'Filter by Status',
    'filter_by_client' => 'Filter by Client',
    'filter_by_assigned_to' => 'Filter by Assigned To',
    'filter_by_due_date' => 'Filter by Due Date',
    'search_tasks' => 'Search Tasks',
    'overdue_tasks' => 'Overdue Tasks',
    'due_soon_tasks' => 'Due Soon Tasks',
    'no_tasks_found' => 'No tasks found.',
    'no_tasks_assigned' => 'No tasks assigned to you.',

    // Task statistics
    'total_tasks' => 'Total Tasks',
    'new_tasks' => 'New Tasks',
    'in_progress_tasks' => 'In Progress Tasks',
    'completed_tasks' => 'Completed Tasks',
    'pending_tasks' => 'Pending Tasks',
    'overdue_count' => 'Overdue',
    'due_soon_count' => 'Due Soon',

    // Task properties
    'is_overdue' => 'Overdue',
    'is_due_soon' => 'Due Soon',
    'days_remaining' => 'Days Remaining',
    'days_overdue' => 'Days Overdue',
    'no_due_date' => 'No Due Date',

    // Form placeholders
    'enter_task_title' => 'Enter task title...',
    'enter_task_description' => 'Enter task description...',
    'select_client' => 'Select Client',
    'select_document_type' => 'Select Document Type',
    'select_document' => 'Select Document',
    'select_assigned_user' => 'Select Assigned User',
    'select_status' => 'Select Status',
    'enter_note' => 'Enter note...',

    // Confirmation messages
    'confirm_delete_task' => 'Are you sure you want to delete this task?',
    'confirm_complete_task' => 'Are you sure you want to mark this task as completed?',
    'confirm_start_task' => 'Are you sure you want to start this task?',

    // Task workflow
    'workflow' => 'Workflow',
    'start_work' => 'Start Work',
    'mark_complete' => 'Mark Complete',
    'mark_pending' => 'Mark Pending',
    'reopen_task' => 'Reopen Task',

    // Priority (if needed in future)
    'priority' => 'Priority',
    'high' => 'High',
    'medium' => 'Medium',
    'low' => 'Low',

    // Categories (if needed in future)
    'category' => 'Category',
    'categories' => 'Categories',
    'uncategorized' => 'Uncategorized',
    
    // Additional keys for show view
    'task_info' => 'Task Information',
    'no_history_found' => 'No history found for this task.',
    'confirm_status_change' => 'Are you sure you want to change the status?',
    'old_value' => 'Old Value',
    'new_value' => 'New Value',
    'changed_by' => 'Changed By',
    
    // Employee edit restrictions
    'employee_edit_notice_title' => 'Employee Notice',
    'employee_edit_notice_message' => 'As an employee, you can only edit the task status. Other details are protected from modification.',
    
    // Multiple documents
    'mixed_documents' => 'Mixed Documents',
    'documents_count' => '{0}no documents|{1}:count document|[2,*]:count documents',
    'documents_required' => 'At least one document must be selected.',
    'documents_min_one' => 'You must select at least one document.',
    'select_company_first' => 'Please select a company first',
    'select_employee_first' => 'Please select an employee first',
    'no_documents_available' => 'No documents available',
    'no_employees_available' => 'No employees available for this company',
    'add_document' => 'Add Document',
    'selected_documents' => 'Selected Documents',
    'current_documents' => 'Current Documents',
    'remove_document' => 'Remove Document',
    'please_select_document' => 'Please select a document first.',
    'document_management_restricted_title' => 'Document Management Restricted',
    'document_management_restricted_message' => 'You do not have permission to manage task documents. Only administrators can add or remove documents from tasks.',
    
    // Document selection
    'company_selection' => 'Company Selection',
    'employee_selection' => 'Employee Selection',
    'document_selection' => 'Document Selection',
    'select_document_type' => 'Select Document Type',
    'company_documents' => 'Company Documents',
    'employee_documents' => 'Employee Documents',
    'document_already_selected' => 'This document is already selected.',
    
    // Task show/edit additional keys
    'document_summary' => 'Document Summary',
    'total_documents_assigned' => '{0}no documents assigned|{1}:count document assigned|[2,*]:count documents assigned',
    'all_company_documents' => 'All company documents',
    'all_employee_documents' => 'All employee documents',
    'no_documents_assigned' => 'No Documents Assigned',
    'no_documents_assigned_message' => 'This task has no documents assigned to it.',
    'current_documents' => 'Current Documents',
    'add_new_documents' => 'Add New Documents',
    'new_documents_to_add' => 'New Documents to Add',
    'confirm_remove_document' => 'Are you sure you want to remove this document from the task?',
    'note_about_documents' => 'Note About Documents',
    'document_edit_limitation_message' => 'To modify documents assigned to this task, please create a new task or contact an administrator.',
];

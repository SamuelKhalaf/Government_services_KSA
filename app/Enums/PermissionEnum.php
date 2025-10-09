<?php

namespace App\Enums;

enum PermissionEnum : string
{
    // Dashboard & System
    case VIEW_DASHBOARD = 'view_dashboard';

    // Users Management
    case VIEW_USERS = 'view_users';
    case CREATE_USERS = 'create_users';
    case UPDATE_USERS = 'update_users';
    case DELETE_USERS = 'delete_users';

    // Roles & Permissions
    case VIEW_ROLES = 'view_roles';
    case CREATE_ROLES = 'create_roles';
    case UPDATE_ROLES = 'update_roles';
    case DELETE_ROLES = 'delete_roles';
    case VIEW_PERMISSIONS = 'view_permissions';
    case CREATE_PERMISSIONS = 'create_permissions';
    case DELETE_PERMISSIONS = 'delete_permissions';
    case ASSIGN_PERMISSIONS = 'assign_permissions';

    // Clients Management
    case VIEW_ALL_CLIENTS = 'view_all_clients';
    case VIEW_ASSIGNED_CLIENTS = 'view_assigned_clients';
    case CREATE_CLIENTS = 'create_clients';
    case UPDATE_CLIENTS = 'update_clients';
    case DELETE_CLIENTS = 'delete_clients';

    // Client Employees Management
    case VIEW_CLIENT_EMPLOYEES = 'view_client_employees';
    case CREATE_CLIENT_EMPLOYEES = 'create_client_employees';
    case UPDATE_CLIENT_EMPLOYEES = 'update_client_employees';
    case DELETE_CLIENT_EMPLOYEES = 'delete_client_employees';

    // Company Documents Management
    case VIEW_COMPANY_DOCUMENTS = 'view_company_documents';
    case CREATE_COMPANY_DOCUMENTS = 'create_company_documents';
    case UPDATE_COMPANY_DOCUMENTS = 'update_company_documents';
    case DELETE_COMPANY_DOCUMENTS = 'delete_company_documents';
    case MANAGE_CIVIL_DEFENSE_LICENSES = 'manage_civil_defense_licenses';
    case MANAGE_MUNICIPALITY_LICENSES = 'manage_municipality_licenses';
    case MANAGE_BRANCH_REGISTRATIONS = 'manage_branch_registrations';

    // Documents Management
    case VIEW_ALL_DOCUMENTS = 'view_all_documents';
    case VIEW_ASSIGNED_DOCUMENTS = 'view_assigned_documents';
    case UPLOAD_DOCUMENTS = 'upload_documents';
    case UPDATE_DOCUMENTS = 'update_documents';
    case DELETE_DOCUMENTS = 'delete_documents';
    case DOWNLOAD_DOCUMENTS = 'download_documents';
    case VIEW_DOCUMENT_DASHBOARD = 'view_document_dashboard';

    // Document Types Management
    case VIEW_DOCUMENT_TYPES = 'view_document_types';
    case CREATE_DOCUMENT_TYPES = 'create_document_types';
    case UPDATE_DOCUMENT_TYPES = 'update_document_types';
    case DELETE_DOCUMENT_TYPES = 'delete_document_types';

    // Tasks Management
    case VIEW_ALL_TASKS = 'view_all_tasks';
    case VIEW_ASSIGNED_TASKS = 'view_assigned_tasks';
    case CREATE_TASKS = 'create_tasks';
    case UPDATE_TASKS = 'update_tasks';
    case DELETE_TASKS = 'delete_tasks';
    case COMPLETE_TASKS = 'complete_tasks';
    case MANAGE_TASK_DOCUMENTS = 'manage_task_documents';

    // Notifications Management
    case VIEW_OWN_NOTIFICATIONS = 'view_own_notifications';
    case MARK_NOTIFICATIONS_READ = 'mark_notifications_read';
    case DELETE_NOTIFICATIONS = 'delete_notifications';

    // Financial Packages Management
    case VIEW_FINANCIAL_PACKAGES = 'view_financial_packages';
    case CREATE_FINANCIAL_PACKAGES = 'create_financial_packages';
    case UPDATE_FINANCIAL_PACKAGES = 'update_financial_packages';
    case DELETE_FINANCIAL_PACKAGES = 'delete_financial_packages';
    case ASSIGN_PACKAGES_TO_CLIENTS = 'assign_packages_to_clients';
    case RENEW_CLIENT_PACKAGES = 'renew_client_packages';
    case CANCEL_CLIENT_PACKAGES = 'cancel_client_packages';

    // Reports & Analytics
    // case VIEW_CLIENT_REPORTS = 'view_client_reports';

    // Employee Activity Tracking
    case VIEW_EMPLOYEE_MONITORING = 'view_employee_monitoring';
    case VIEW_EMPLOYEE_LOGIN_LOGS = 'view_employee_login_logs';
    case VIEW_EMPLOYEE_ACTIVITY_LOGS = 'view_employee_activity_logs';
    case VIEW_EMPLOYEE_CLICK_TRACKING = 'view_employee_click_tracking';
    case VIEW_EMPLOYEE_SCREEN_TIME = 'view_employee_screen_time';
    case VIEW_EMPLOYEE_SCREENSHOTS = 'view_employee_screenshots';
    case MANAGE_EMPLOYEE_MONITORING = 'manage_employee_monitoring';

    // Database Backup Management
    case MANAGE_DATABASE_BACKUP = 'manage_database_backup';

    /**
     * @return array
     */
    public static function all(): array
    {
        return array_column(PermissionEnum::cases(), 'value');
    }

    /**
     * Get permissions for Admin role (all permissions)
     */
    public static function adminPermissions(): array
    {
        return self::all();
    }

    /**
     * Get permissions for Employee role (restricted access)
     */
    public static function employeePermissions(): array
    {
        return [
            self::VIEW_DASHBOARD->value,
            self::VIEW_ASSIGNED_CLIENTS->value,
            self::UPDATE_CLIENTS->value,
            self::VIEW_CLIENT_EMPLOYEES->value,
            self::CREATE_CLIENT_EMPLOYEES->value,
            self::UPDATE_CLIENT_EMPLOYEES->value,
            self::VIEW_ASSIGNED_DOCUMENTS->value,
            self::UPLOAD_DOCUMENTS->value,
            self::UPDATE_DOCUMENTS->value,
            self::DOWNLOAD_DOCUMENTS->value,
            self::VIEW_ASSIGNED_TASKS->value,
            self::UPDATE_TASKS->value,
            self::COMPLETE_TASKS->value,
            self::VIEW_OWN_NOTIFICATIONS->value,
            self::MARK_NOTIFICATIONS_READ->value,
            // self::VIEW_CLIENT_REPORTS->value,
        ];
    }

    /**
     * Get permission display name in Arabic and English
     */
    public function getDisplayName(string $lang = 'en'): string
    {
        return match($this) {
            // Dashboard & System
            self::VIEW_DASHBOARD => $lang === 'ar' ? 'عرض لوحة التحكم' : 'View Dashboard',

            // Users Management
            self::VIEW_USERS => $lang === 'ar' ? 'عرض المستخدمين' : 'View Users',
            self::CREATE_USERS => $lang === 'ar' ? 'إنشاء مستخدمين' : 'Create Users',
            self::UPDATE_USERS => $lang === 'ar' ? 'تحديث المستخدمين' : 'Update Users',
            self::DELETE_USERS => $lang === 'ar' ? 'حذف المستخدمين' : 'Delete Users',

            // Roles & Permissions
            self::VIEW_ROLES => $lang === 'ar' ? 'عرض الأدوار' : 'View Roles',
            self::CREATE_ROLES => $lang === 'ar' ? 'إنشاء أدوار' : 'Create Roles',
            self::UPDATE_ROLES => $lang === 'ar' ? 'تحديث الأدوار' : 'Update Roles',
            self::DELETE_ROLES => $lang === 'ar' ? 'حذف الأدوار' : 'Delete Roles',
            self::VIEW_PERMISSIONS => $lang === 'ar' ? 'عرض الصلاحيات' : 'View Permissions',
            self::CREATE_PERMISSIONS => $lang === 'ar' ? 'إنشاء الصلاحيات' : 'Create Permissions',
            self::DELETE_PERMISSIONS => $lang === 'ar' ? 'حذف الصلاحيات' : 'Delete Permissions',
            self::ASSIGN_PERMISSIONS => $lang === 'ar' ? 'تعيين الصلاحيات' : 'Assign Permissions',

            // Clients Management
            self::VIEW_ALL_CLIENTS => $lang === 'ar' ? 'عرض جميع المنشأت' : 'View All Clients',
            self::VIEW_ASSIGNED_CLIENTS => $lang === 'ar' ? 'عرض المنشأت المخصصين' : 'View Assigned Clients',
            self::CREATE_CLIENTS => $lang === 'ar' ? 'إنشاء منشأت' : 'Create Clients',
            self::UPDATE_CLIENTS => $lang === 'ar' ? 'تحديث المنشأت' : 'Update Clients',
            self::DELETE_CLIENTS => $lang === 'ar' ? 'حذف المنشأت' : 'Delete Clients',

            // Client Employees Management
            self::VIEW_CLIENT_EMPLOYEES => $lang === 'ar' ? 'عرض موظفي المنشأت' : 'View Client Employees',
            self::CREATE_CLIENT_EMPLOYEES => $lang === 'ar' ? 'إنشاء موظفي منشأت' : 'Create Client Employees',
            self::UPDATE_CLIENT_EMPLOYEES => $lang === 'ar' ? 'تحديث موظفي المنشأت' : 'Update Client Employees',
            self::DELETE_CLIENT_EMPLOYEES => $lang === 'ar' ? 'حذف موظفي المنشأت' : 'Delete Client Employees',

            // Company Documents Management
            self::VIEW_COMPANY_DOCUMENTS => $lang === 'ar' ? 'عرض وثائق المنشأت' : 'View Company Documents',
            self::CREATE_COMPANY_DOCUMENTS => $lang === 'ar' ? 'إنشاء وثائق المنشأت' : 'Create Company Documents',
            self::UPDATE_COMPANY_DOCUMENTS => $lang === 'ar' ? 'تحديث وثائق المنشأت' : 'Update Company Documents',
            self::DELETE_COMPANY_DOCUMENTS => $lang === 'ar' ? 'حذف وثائق المنشأت' : 'Delete Company Documents',
            self::MANAGE_CIVIL_DEFENSE_LICENSES => $lang === 'ar' ? 'إدارة تراخيص الدفاع المدني' : 'Manage Civil Defense Licenses',
            self::MANAGE_MUNICIPALITY_LICENSES => $lang === 'ar' ? 'إدارة تراخيص البلدية' : 'Manage Municipality Licenses',
            self::MANAGE_BRANCH_REGISTRATIONS => $lang === 'ar' ? 'إدارة تسجيل الفروع' : 'Manage Branch Registrations',

            // Documents Management
            self::VIEW_ALL_DOCUMENTS => $lang === 'ar' ? 'عرض جميع الوثائق' : 'View All Documents',
            self::VIEW_ASSIGNED_DOCUMENTS => $lang === 'ar' ? 'عرض الوثائق المخصصة' : 'View Assigned Documents',
            self::UPLOAD_DOCUMENTS => $lang === 'ar' ? 'رفع الوثائق' : 'Upload Documents',
            self::UPDATE_DOCUMENTS => $lang === 'ar' ? 'تحديث الوثائق' : 'Update Documents',
            self::DELETE_DOCUMENTS => $lang === 'ar' ? 'حذف الوثائق' : 'Delete Documents',
            self::DOWNLOAD_DOCUMENTS => $lang === 'ar' ? 'تحميل الوثائق' : 'Download Documents',
            self::VIEW_DOCUMENT_DASHBOARD => $lang === 'ar' ? 'عرض لوحة الوثائق' : 'View Document Dashboard',

            // Document Types Management
            self::VIEW_DOCUMENT_TYPES => $lang === 'ar' ? 'عرض أنواع الوثائق' : 'View Document Types',
            self::CREATE_DOCUMENT_TYPES => $lang === 'ar' ? 'إنشاء أنواع الوثائق' : 'Create Document Types',
            self::UPDATE_DOCUMENT_TYPES => $lang === 'ar' ? 'تحديث أنواع الوثائق' : 'Update Document Types',
            self::DELETE_DOCUMENT_TYPES => $lang === 'ar' ? 'حذف أنواع الوثائق' : 'Delete Document Types',

            // Tasks Management
            self::VIEW_ALL_TASKS => $lang === 'ar' ? 'عرض جميع المهام' : 'View All Tasks',
            self::VIEW_ASSIGNED_TASKS => $lang === 'ar' ? 'عرض المهام المخصصة' : 'View Assigned Tasks',
            self::CREATE_TASKS => $lang === 'ar' ? 'إنشاء مهام' : 'Create Tasks',
            self::UPDATE_TASKS => $lang === 'ar' ? 'تحديث المهام' : 'Update Tasks',
            self::DELETE_TASKS => $lang === 'ar' ? 'حذف المهام' : 'Delete Tasks',
            self::COMPLETE_TASKS => $lang === 'ar' ? 'إكمال المهام' : 'Complete Tasks',
            self::MANAGE_TASK_DOCUMENTS => $lang === 'ar' ? 'إدارة وثائق المهام' : 'Manage Task Documents',

            // Notifications Management
            self::VIEW_OWN_NOTIFICATIONS => $lang === 'ar' ? 'عرض الإشعارات الخاصة' : 'View Own Notifications',
            self::MARK_NOTIFICATIONS_READ => $lang === 'ar' ? 'تعيين الإشعارات كمقروءة' : 'Mark Notifications Read',
            self::DELETE_NOTIFICATIONS => $lang === 'ar' ? 'حذف الإشعارات' : 'Delete Notifications',

            // Financial Packages Management
            self::VIEW_FINANCIAL_PACKAGES => $lang === 'ar' ? 'عرض الباقات المالية' : 'View Financial Packages',
            self::CREATE_FINANCIAL_PACKAGES => $lang === 'ar' ? 'إنشاء باقات مالية' : 'Create Financial Packages',
            self::UPDATE_FINANCIAL_PACKAGES => $lang === 'ar' ? 'تحديث الباقات المالية' : 'Update Financial Packages',
            self::DELETE_FINANCIAL_PACKAGES => $lang === 'ar' ? 'حذف الباقات المالية' : 'Delete Financial Packages',
            self::ASSIGN_PACKAGES_TO_CLIENTS => $lang === 'ar' ? 'تعيين الباقات للمنشأت' : 'Assign Packages to Clients',
            self::RENEW_CLIENT_PACKAGES => $lang === 'ar' ? 'تجديد باقات المنشأت' : 'Renew Client Packages',
            self::CANCEL_CLIENT_PACKAGES => $lang === 'ar' ? 'إلغاء باقات المنشأت' : 'Cancel Client Packages',

            // Reports & Analytics
            // self::VIEW_CLIENT_REPORTS => $lang === 'ar' ? 'عرض تقارير المنشأت' : 'View Client Reports',

            // Employee Activity Tracking
            self::VIEW_EMPLOYEE_MONITORING => $lang === 'ar' ? 'عرض تتبع نشاط الموظفين' : 'View Employee Activity Tracking',
            self::VIEW_EMPLOYEE_LOGIN_LOGS => $lang === 'ar' ? 'عرض سجلات تسجيل الدخول' : 'View Employee Login Logs',
            self::VIEW_EMPLOYEE_ACTIVITY_LOGS => $lang === 'ar' ? 'عرض سجلات الأنشطة' : 'View Employee Activity Logs',
            self::VIEW_EMPLOYEE_CLICK_TRACKING => $lang === 'ar' ? 'عرض تتبع النقرات' : 'View Employee Click Tracking',
            self::VIEW_EMPLOYEE_SCREEN_TIME => $lang === 'ar' ? 'عرض وقت الشاشة النشط' : 'View Employee Screen Time',
            self::VIEW_EMPLOYEE_SCREENSHOTS => $lang === 'ar' ? 'عرض لقطات الشاشة' : 'View Employee Screenshots',
            self::MANAGE_EMPLOYEE_MONITORING => $lang === 'ar' ? 'إدارة تتبع نشاط الموظفين' : 'Manage Employee Activity Tracking',

            // Database Backup Management
            self::MANAGE_DATABASE_BACKUP => $lang === 'ar' ? 'إدارة نسخ احتياطية قاعدة البيانات' : 'Manage Database Backup',
        };
    }

    /**
     * Get permission group/category
     */
    public function getCategory(string $lang = 'en'): string
    {
        return match($this) {
            self::VIEW_DASHBOARD
                => $lang === 'ar' ? 'لوحة التحكم والنظام' : 'Dashboard & System',

            self::VIEW_USERS, self::CREATE_USERS, self::UPDATE_USERS, self::DELETE_USERS
                => $lang === 'ar' ? 'إدارة المستخدمين' : 'Users Management',

            self::VIEW_ROLES, self::CREATE_ROLES, self::UPDATE_ROLES, self::DELETE_ROLES, self::VIEW_PERMISSIONS, self::CREATE_PERMISSIONS, self::DELETE_PERMISSIONS, self::ASSIGN_PERMISSIONS
                => $lang === 'ar' ? 'الأدوار والصلاحيات' : 'Roles & Permissions',

            self::VIEW_ALL_CLIENTS, self::VIEW_ASSIGNED_CLIENTS, self::CREATE_CLIENTS, self::UPDATE_CLIENTS, self::DELETE_CLIENTS
                => $lang === 'ar' ? 'إدارة المنشأت' : 'Clients Management',

            self::VIEW_CLIENT_EMPLOYEES, self::CREATE_CLIENT_EMPLOYEES, self::UPDATE_CLIENT_EMPLOYEES, self::DELETE_CLIENT_EMPLOYEES
                => $lang === 'ar' ? 'إدارة موظفي المنشأت' : 'Client Employees Management',

            self::VIEW_COMPANY_DOCUMENTS, self::CREATE_COMPANY_DOCUMENTS, self::UPDATE_COMPANY_DOCUMENTS, self::DELETE_COMPANY_DOCUMENTS, self::MANAGE_CIVIL_DEFENSE_LICENSES, self::MANAGE_MUNICIPALITY_LICENSES, self::MANAGE_BRANCH_REGISTRATIONS
                => $lang === 'ar' ? 'إدارة وثائق المنشأت' : 'Company Documents Management',

            self::VIEW_ALL_DOCUMENTS, self::VIEW_ASSIGNED_DOCUMENTS, self::UPLOAD_DOCUMENTS, self::UPDATE_DOCUMENTS, self::DELETE_DOCUMENTS, self::DOWNLOAD_DOCUMENTS, self::VIEW_DOCUMENT_DASHBOARD
                => $lang === 'ar' ? 'إدارة الوثائق' : 'Documents Management',

            self::VIEW_DOCUMENT_TYPES, self::CREATE_DOCUMENT_TYPES, self::UPDATE_DOCUMENT_TYPES, self::DELETE_DOCUMENT_TYPES
                => $lang === 'ar' ? 'إدارة أنواع الوثائق' : 'Document Types Management',

            self::VIEW_ALL_TASKS, self::VIEW_ASSIGNED_TASKS, self::CREATE_TASKS, self::UPDATE_TASKS, self::DELETE_TASKS, self::COMPLETE_TASKS, self::MANAGE_TASK_DOCUMENTS
                => $lang === 'ar' ? 'إدارة المهام' : 'Tasks Management',

            self::VIEW_OWN_NOTIFICATIONS, self::MARK_NOTIFICATIONS_READ, self::DELETE_NOTIFICATIONS
                => $lang === 'ar' ? 'إدارة الإشعارات' : 'Notifications Management',

            self::VIEW_FINANCIAL_PACKAGES, self::CREATE_FINANCIAL_PACKAGES, self::UPDATE_FINANCIAL_PACKAGES, self::DELETE_FINANCIAL_PACKAGES, self::ASSIGN_PACKAGES_TO_CLIENTS, self::RENEW_CLIENT_PACKAGES, self::CANCEL_CLIENT_PACKAGES
                => $lang === 'ar' ? 'إدارة الباقات المالية' : 'Financial Packages Management',

            // self::VIEW_CLIENT_REPORTS
            //     => $lang === 'ar' ? 'التقارير والتحليلات' : 'Reports & Analytics',

            self::VIEW_EMPLOYEE_MONITORING, self::VIEW_EMPLOYEE_LOGIN_LOGS, self::VIEW_EMPLOYEE_ACTIVITY_LOGS, self::VIEW_EMPLOYEE_CLICK_TRACKING, self::VIEW_EMPLOYEE_SCREEN_TIME, self::VIEW_EMPLOYEE_SCREENSHOTS, self::MANAGE_EMPLOYEE_MONITORING
                => $lang === 'ar' ? 'تتبع نشاط الموظفين' : 'Employee Activity Tracking',

            self::MANAGE_DATABASE_BACKUP
                => $lang === 'ar' ? 'إدارة النسخ الاحتياطية' : 'Database Backup Management',
        };
    }
}
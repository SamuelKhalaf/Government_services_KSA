<?php

namespace App\Enums;

enum PermissionEnum : string
{
    // Dashboard & System
    case VIEW_DASHBOARD = 'view_dashboard';
    case VIEW_ANALYTICS = 'view_analytics';
    case MANAGE_SYSTEM_SETTINGS = 'manage_system_settings';

    // Users Management
    case VIEW_USERS = 'view_users';
    case CREATE_USERS = 'create_users';
    case UPDATE_USERS = 'update_users';
    case DELETE_USERS = 'delete_users';
    case ACTIVATE_DEACTIVATE_USERS = 'activate_deactivate_users';

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
    case ASSIGN_CLIENTS_TO_EMPLOYEES = 'assign_clients_to_employees';

    // Client Employees Management
    case VIEW_CLIENT_EMPLOYEES = 'view_client_employees';
    case CREATE_CLIENT_EMPLOYEES = 'create_client_employees';
    case UPDATE_CLIENT_EMPLOYEES = 'update_client_employees';
    case DELETE_CLIENT_EMPLOYEES = 'delete_client_employees';

    // Documents Management
    case VIEW_ALL_DOCUMENTS = 'view_all_documents';
    case VIEW_ASSIGNED_DOCUMENTS = 'view_assigned_documents';
    case UPLOAD_DOCUMENTS = 'upload_documents';
    case UPDATE_DOCUMENTS = 'update_documents';
    case DELETE_DOCUMENTS = 'delete_documents';
    case DOWNLOAD_DOCUMENTS = 'download_documents';
    case APPROVE_DOCUMENTS = 'approve_documents';

    // Tasks Management
    case VIEW_ALL_TASKS = 'view_all_tasks';
    case VIEW_ASSIGNED_TASKS = 'view_assigned_tasks';
    case CREATE_TASKS = 'create_tasks';
    case UPDATE_TASKS = 'update_tasks';
    case DELETE_TASKS = 'delete_tasks';
    case ASSIGN_TASKS = 'assign_tasks';
    case COMPLETE_TASKS = 'complete_tasks';

    // Notifications Management
    case VIEW_ALL_NOTIFICATIONS = 'view_all_notifications';
    case VIEW_OWN_NOTIFICATIONS = 'view_own_notifications';
    case CREATE_NOTIFICATIONS = 'create_notifications';
    case MARK_NOTIFICATIONS_READ = 'mark_notifications_read';
    case DELETE_NOTIFICATIONS = 'delete_notifications';

    // Financial Packages Management
    case VIEW_FINANCIAL_PACKAGES = 'view_financial_packages';
    case CREATE_FINANCIAL_PACKAGES = 'create_financial_packages';
    case UPDATE_FINANCIAL_PACKAGES = 'update_financial_packages';
    case DELETE_FINANCIAL_PACKAGES = 'delete_financial_packages';
    case ASSIGN_PACKAGES_TO_CLIENTS = 'assign_packages_to_clients';

    // Reports & Analytics
    case VIEW_REPORTS = 'view_reports';
    case EXPORT_REPORTS = 'export_reports';
    case VIEW_CLIENT_REPORTS = 'view_client_reports';
    case VIEW_EMPLOYEE_PERFORMANCE = 'view_employee_performance';

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
            self::VIEW_CLIENT_REPORTS->value,
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
            self::VIEW_ANALYTICS => $lang === 'ar' ? 'عرض التحليلات' : 'View Analytics',
            self::MANAGE_SYSTEM_SETTINGS => $lang === 'ar' ? 'إدارة إعدادات النظام' : 'Manage System Settings',

            // Users Management
            self::VIEW_USERS => $lang === 'ar' ? 'عرض المستخدمين' : 'View Users',
            self::CREATE_USERS => $lang === 'ar' ? 'إنشاء مستخدمين' : 'Create Users',
            self::UPDATE_USERS => $lang === 'ar' ? 'تحديث المستخدمين' : 'Update Users',
            self::DELETE_USERS => $lang === 'ar' ? 'حذف المستخدمين' : 'Delete Users',
            self::ACTIVATE_DEACTIVATE_USERS => $lang === 'ar' ? 'تفعيل/إلغاء تفعيل المستخدمين' : 'Activate/Deactivate Users',

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
            self::VIEW_ALL_CLIENTS => $lang === 'ar' ? 'عرض جميع العملاء' : 'View All Clients',
            self::VIEW_ASSIGNED_CLIENTS => $lang === 'ar' ? 'عرض العملاء المخصصين' : 'View Assigned Clients',
            self::CREATE_CLIENTS => $lang === 'ar' ? 'إنشاء عملاء' : 'Create Clients',
            self::UPDATE_CLIENTS => $lang === 'ar' ? 'تحديث العملاء' : 'Update Clients',
            self::DELETE_CLIENTS => $lang === 'ar' ? 'حذف العملاء' : 'Delete Clients',
            self::ASSIGN_CLIENTS_TO_EMPLOYEES => $lang === 'ar' ? 'تعيين العملاء للموظفين' : 'Assign Clients to Employees',

            // Client Employees Management
            self::VIEW_CLIENT_EMPLOYEES => $lang === 'ar' ? 'عرض موظفي العملاء' : 'View Client Employees',
            self::CREATE_CLIENT_EMPLOYEES => $lang === 'ar' ? 'إنشاء موظفي عملاء' : 'Create Client Employees',
            self::UPDATE_CLIENT_EMPLOYEES => $lang === 'ar' ? 'تحديث موظفي العملاء' : 'Update Client Employees',
            self::DELETE_CLIENT_EMPLOYEES => $lang === 'ar' ? 'حذف موظفي العملاء' : 'Delete Client Employees',

            // Documents Management
            self::VIEW_ALL_DOCUMENTS => $lang === 'ar' ? 'عرض جميع الوثائق' : 'View All Documents',
            self::VIEW_ASSIGNED_DOCUMENTS => $lang === 'ar' ? 'عرض الوثائق المخصصة' : 'View Assigned Documents',
            self::UPLOAD_DOCUMENTS => $lang === 'ar' ? 'رفع الوثائق' : 'Upload Documents',
            self::UPDATE_DOCUMENTS => $lang === 'ar' ? 'تحديث الوثائق' : 'Update Documents',
            self::DELETE_DOCUMENTS => $lang === 'ar' ? 'حذف الوثائق' : 'Delete Documents',
            self::DOWNLOAD_DOCUMENTS => $lang === 'ar' ? 'تحميل الوثائق' : 'Download Documents',
            self::APPROVE_DOCUMENTS => $lang === 'ar' ? 'اعتماد الوثائق' : 'Approve Documents',

            // Tasks Management
            self::VIEW_ALL_TASKS => $lang === 'ar' ? 'عرض جميع المهام' : 'View All Tasks',
            self::VIEW_ASSIGNED_TASKS => $lang === 'ar' ? 'عرض المهام المخصصة' : 'View Assigned Tasks',
            self::CREATE_TASKS => $lang === 'ar' ? 'إنشاء مهام' : 'Create Tasks',
            self::UPDATE_TASKS => $lang === 'ar' ? 'تحديث المهام' : 'Update Tasks',
            self::DELETE_TASKS => $lang === 'ar' ? 'حذف المهام' : 'Delete Tasks',
            self::ASSIGN_TASKS => $lang === 'ar' ? 'تعيين المهام' : 'Assign Tasks',
            self::COMPLETE_TASKS => $lang === 'ar' ? 'إكمال المهام' : 'Complete Tasks',

            // Notifications Management
            self::VIEW_ALL_NOTIFICATIONS => $lang === 'ar' ? 'عرض جميع الإشعارات' : 'View All Notifications',
            self::VIEW_OWN_NOTIFICATIONS => $lang === 'ar' ? 'عرض الإشعارات الخاصة' : 'View Own Notifications',
            self::CREATE_NOTIFICATIONS => $lang === 'ar' ? 'إنشاء إشعارات' : 'Create Notifications',
            self::MARK_NOTIFICATIONS_READ => $lang === 'ar' ? 'تعيين الإشعارات كمقروءة' : 'Mark Notifications Read',
            self::DELETE_NOTIFICATIONS => $lang === 'ar' ? 'حذف الإشعارات' : 'Delete Notifications',

            // Financial Packages Management
            self::VIEW_FINANCIAL_PACKAGES => $lang === 'ar' ? 'عرض الحزم المالية' : 'View Financial Packages',
            self::CREATE_FINANCIAL_PACKAGES => $lang === 'ar' ? 'إنشاء حزم مالية' : 'Create Financial Packages',
            self::UPDATE_FINANCIAL_PACKAGES => $lang === 'ar' ? 'تحديث الحزم المالية' : 'Update Financial Packages',
            self::DELETE_FINANCIAL_PACKAGES => $lang === 'ar' ? 'حذف الحزم المالية' : 'Delete Financial Packages',
            self::ASSIGN_PACKAGES_TO_CLIENTS => $lang === 'ar' ? 'تعيين الحزم للعملاء' : 'Assign Packages to Clients',

            // Reports & Analytics
            self::VIEW_REPORTS => $lang === 'ar' ? 'عرض التقارير' : 'View Reports',
            self::EXPORT_REPORTS => $lang === 'ar' ? 'تصدير التقارير' : 'Export Reports',
            self::VIEW_CLIENT_REPORTS => $lang === 'ar' ? 'عرض تقارير العملاء' : 'View Client Reports',
            self::VIEW_EMPLOYEE_PERFORMANCE => $lang === 'ar' ? 'عرض أداء الموظفين' : 'View Employee Performance',
        };
    }

    /**
     * Get permission group/category
     */
    public function getCategory(string $lang = 'en'): string
    {
        return match($this) {
            self::VIEW_DASHBOARD, self::VIEW_ANALYTICS, self::MANAGE_SYSTEM_SETTINGS 
                => $lang === 'ar' ? 'لوحة التحكم والنظام' : 'Dashboard & System',
            
            self::VIEW_USERS, self::CREATE_USERS, self::UPDATE_USERS, self::DELETE_USERS, self::ACTIVATE_DEACTIVATE_USERS 
                => $lang === 'ar' ? 'إدارة المستخدمين' : 'Users Management',
            
            self::VIEW_ROLES, self::CREATE_ROLES, self::UPDATE_ROLES, self::DELETE_ROLES, self::VIEW_PERMISSIONS, self::CREATE_PERMISSIONS, self::DELETE_PERMISSIONS, self::ASSIGN_PERMISSIONS 
                => $lang === 'ar' ? 'الأدوار والصلاحيات' : 'Roles & Permissions',
            
            self::VIEW_ALL_CLIENTS, self::VIEW_ASSIGNED_CLIENTS, self::CREATE_CLIENTS, self::UPDATE_CLIENTS, self::DELETE_CLIENTS, self::ASSIGN_CLIENTS_TO_EMPLOYEES 
                => $lang === 'ar' ? 'إدارة العملاء' : 'Clients Management',
            
            self::VIEW_CLIENT_EMPLOYEES, self::CREATE_CLIENT_EMPLOYEES, self::UPDATE_CLIENT_EMPLOYEES, self::DELETE_CLIENT_EMPLOYEES 
                => $lang === 'ar' ? 'إدارة موظفي العملاء' : 'Client Employees Management',
            
            self::VIEW_ALL_DOCUMENTS, self::VIEW_ASSIGNED_DOCUMENTS, self::UPLOAD_DOCUMENTS, self::UPDATE_DOCUMENTS, self::DELETE_DOCUMENTS, self::DOWNLOAD_DOCUMENTS, self::APPROVE_DOCUMENTS 
                => $lang === 'ar' ? 'إدارة الوثائق' : 'Documents Management',
            
            self::VIEW_ALL_TASKS, self::VIEW_ASSIGNED_TASKS, self::CREATE_TASKS, self::UPDATE_TASKS, self::DELETE_TASKS, self::ASSIGN_TASKS, self::COMPLETE_TASKS 
                => $lang === 'ar' ? 'إدارة المهام' : 'Tasks Management',
            
            self::VIEW_ALL_NOTIFICATIONS, self::VIEW_OWN_NOTIFICATIONS, self::CREATE_NOTIFICATIONS, self::MARK_NOTIFICATIONS_READ, self::DELETE_NOTIFICATIONS 
                => $lang === 'ar' ? 'إدارة الإشعارات' : 'Notifications Management',
            
            self::VIEW_FINANCIAL_PACKAGES, self::CREATE_FINANCIAL_PACKAGES, self::UPDATE_FINANCIAL_PACKAGES, self::DELETE_FINANCIAL_PACKAGES, self::ASSIGN_PACKAGES_TO_CLIENTS 
                => $lang === 'ar' ? 'إدارة الحزم المالية' : 'Financial Packages Management',
            
            self::VIEW_REPORTS, self::EXPORT_REPORTS, self::VIEW_CLIENT_REPORTS, self::VIEW_EMPLOYEE_PERFORMANCE 
                => $lang === 'ar' ? 'التقارير والتحليلات' : 'Reports & Analytics',
        };
    }
}

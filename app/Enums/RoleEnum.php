<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case EMPLOYEE = 'employee';

    /**
     * @return array
     */
    public static function all(): array
    {
        return array_column(RoleEnum::cases(), 'value');
    }

    /**
     * Get role display name in Arabic and English
     */
    public function getDisplayName(string $lang = 'en'): string
    {
        return match($this) {
            self::ADMIN => $lang === 'ar' ? 'مدير النظام' : 'System Administrator',
            self::EMPLOYEE => $lang === 'ar' ? 'موظف إدخال البيانات' : 'Data Entry Employee',
        };
    }

    /**
     * Get role description
     */
    public function getDescription(string $lang = 'en'): string
    {
        return match($this) {
            self::ADMIN => $lang === 'ar' 
                ? 'صلاحيات كاملة لإدارة النظام والمستخدمين والعملاء والوثائق والمهام والحزم المالية'
                : 'Full system access to manage users, clients, documents, tasks, and financial packages',
            self::EMPLOYEE => $lang === 'ar'
                ? 'صلاحيات محدودة لإدارة العملاء المخصصين وتحديث الوثائق والمهام المكلف بها فقط'
                : 'Limited access to manage assigned clients, update documents and assigned tasks only',
        };
    }
}

<?php

namespace App\Enums;

enum UserStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    /**
     * @return array
     */
    public static function all(): array
    {
        return array_column(UserStatusEnum::cases(), 'value');
    }

    /**
     * Get status display name in Arabic and English
     */
    public function getDisplayName(string $lang = 'en'): string
    {
        return match($this) {
            self::ACTIVE => $lang === 'ar' ? 'نشط' : 'Active',
            self::INACTIVE => $lang === 'ar' ? 'غير نشط' : 'Inactive',
        };
    }

    /**
     * Get status color for UI
     */
    public function getColor(): string
    {
        return match($this) {
            self::ACTIVE => 'success',
            self::INACTIVE => 'danger',
        };
    }

    /**
     * Get status icon
     */
    public function getIcon(): string
    {
        return match($this) {
            self::ACTIVE => 'check-circle',
            self::INACTIVE => 'x-circle',
        };
    }
}

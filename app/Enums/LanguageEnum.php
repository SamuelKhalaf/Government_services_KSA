<?php

namespace App\Enums;

enum LanguageEnum: string
{
    case ARABIC = 'ar';
    case ENGLISH = 'en';

    /**
     * @return array
     */
    public static function all(): array
    {
        return array_column(LanguageEnum::cases(), 'value');
    }

    /**
     * Get language display name
     */
    public function getDisplayName(string $lang = 'en'): string
    {
        return match($this) {
            self::ARABIC => $lang === 'ar' ? 'العربية' : 'Arabic',
            self::ENGLISH => $lang === 'ar' ? 'الإنجليزية' : 'English',
        };
    }

    /**
     * Get language native name
     */
    public function getNativeName(): string
    {
        return match($this) {
            self::ARABIC => 'العربية',
            self::ENGLISH => 'English',
        };
    }

    /**
     * Get language flag icon
     */
    public function getFlagIcon(): string
    {
        return match($this) {
            self::ARABIC => 'flag-icon-sa',
            self::ENGLISH => 'flag-icon-us',
        };
    }

    /**
     * Get text direction
     */
    public function getDirection(): string
    {
        return match($this) {
            self::ARABIC => 'rtl',
            self::ENGLISH => 'ltr',
        };
    }

    /**
     * Check if language is RTL
     */
    public function isRTL(): bool
    {
        return $this === self::ARABIC;
    }
}

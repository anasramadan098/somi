<?php

namespace App\Enums;

enum UserRole: string
{
    case OWNER = 'owner';
    case EMPLOYEE = 'employee';

    /**
     * Get all role values
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get role label for display
     */
    public function label(): string
    {
        return match($this) {
            self::OWNER => 'Owner',
            self::EMPLOYEE => 'Employee',
        };
    }
}

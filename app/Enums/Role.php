<?php

namespace App\Enums;

enum Role: string {
    case Admin = 'admin';
    case Teacher = 'teacher';
    case Student = 'student';

    public function is(Role $role): bool
    {
        return $this->value === $role->value;
    }

    public static function values(): array
    {
        return [
            self::Admin->value,
            self::Teacher->value,
            self::Student->value,
        ];
    }
}
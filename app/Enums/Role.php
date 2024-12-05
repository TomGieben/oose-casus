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
}
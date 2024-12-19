<?php

use App\Enums\Role;

function can(...$roles): bool
{
    $all = '*';

    if (in_array($all, $roles)) {
        return true;
    }

    $systemRoles = Role::values();

    foreach ($roles as $role) {
        if (!in_array($role, $systemRoles )) {
            return false;
        }

        if (auth()->user()->role->value === $role) {
            return true;
        }
    }

    return false;
}
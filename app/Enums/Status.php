<?php

namespace App\Enums;

enum Status: string {
    case Draft = 'draft';
    case Planable = 'planable';

    public static function getValues(): array
    {
        return [
            self::Draft->value,
            self::Planable->value,
        ];
    }
}
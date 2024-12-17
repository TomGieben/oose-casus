<?php

namespace App\Enums;

enum Status: string {
    case Draft = 'draft';
    case Plannable = 'plannable';

    public static function getValues(): array
    {
        return [
            self::Draft->value,
            self::Plannable->value,
        ];
    }

    public function is(Status $status): bool
    {
        return $this->value === $status->value;
    }
}
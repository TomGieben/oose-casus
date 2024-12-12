<?php

namespace App\Enums;

enum Week: int
{
    case WEEK_1 = 1;
    case WEEK_2 = 2;
    case WEEK_3 = 3;
    case WEEK_4 = 4;
    case WEEK_5 = 5;
    case WEEK_6 = 6;
    case WEEK_7 = 7;
    case WEEK_8 = 8;
    case WEEK_9 = 9;
    case WEEK_10 = 10;

    public static function asArray(): array
    {
        return self::cases();
    }

    public static function values(): array
    {
        return array_map(fn($week) => $week->value, self::cases());
    }

    public function label(): string
    {
        return match($this) {
            self::WEEK_1 => 'Week 1',
            self::WEEK_2 => 'Week 2',
            self::WEEK_3 => 'Week 3',
            self::WEEK_4 => 'Week 4',
            self::WEEK_5 => 'Week 5',
            self::WEEK_6 => 'Week 6',
            self::WEEK_7 => 'Week 7',
            self::WEEK_8 => 'Week 8',
            self::WEEK_9 => 'Week 9',
            self::WEEK_10 => 'Week 10',
        };
    }
}
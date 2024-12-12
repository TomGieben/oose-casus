<?php

namespace App\Enums;

use App\EducationElements\Lesson;
use App\EducationElements\Test;

enum EducationElementType: string
{
    case Lesson = Lesson::class;
    case Test = Test::class;

    public static function values(): array
    {
        return [
            self::Lesson->value,
            self::Test->value,
        ];
    }

    public static function asArray(): array
    {
        return [
            self::Lesson,
            self::Test,
        ];
    }

    public function label(): string
    {
        return match ($this) {
            self::Lesson => __('Lesson'),
            self::Test => __('Test'),
        };
    }
}

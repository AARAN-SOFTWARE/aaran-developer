<?php

namespace App\Enums;

enum Priority : int
{
    case NORMAL = 1;
    case IMPORTANT = 2;
    case PRIORITY = 3;
    case TOPMOST = 4;
    case MOST_IMPORTANT = 5;
    case URGENT = 6;
    case MOST_URGENT = 7;

    public function getName(): string
    {
        return match ($this) {
            self::NORMAL => 'Normal',
            self::IMPORTANT => 'Important',
            self::PRIORITY => 'Priority',
            self::TOPMOST => 'Topmost',
            self::MOST_IMPORTANT => 'Most Important',
            self::URGENT => 'Urgent',
            self::MOST_URGENT => 'Most Urgent',
        };
    }

    public function getStyle(): string
    {
        return match ($this) {
            self::NORMAL => 'text-white bg-amber-500',
            self::IMPORTANT => 'text-white bg-orange-500',
            self::PRIORITY => 'text-white bg-pink-500',
            self::TOPMOST => 'text-white bg-red-500',
            self::MOST_IMPORTANT => 'text-white bg-green-500',
            self::URGENT => 'text-white bg-sky-500',
            self::MOST_URGENT => 'text-white bg-violet-500',
        };
    }

}

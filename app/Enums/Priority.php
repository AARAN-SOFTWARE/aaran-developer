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
            self::NORMAL => 'text-gray-700 bg-gray-500',
            self::IMPORTANT => 'text-yellow-700 bg-yellow-500',
            self::PRIORITY => 'text-white bg-yellow-600',
            self::TOPMOST => 'text-red-700 bg-red-300',
            self::MOST_IMPORTANT => 'text-zinc-200 bg-red-700',
            self::URGENT => 'text-sky-200 bg-sky-700',
            self::MOST_URGENT => 'text-orange-200 bg-orange-700',
        };
    }

}

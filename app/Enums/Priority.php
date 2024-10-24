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
            self::NORMAL => 'text-green-100 bg-green-500 border border-green-9800',
            self::IMPORTANT => 'text-cyan-100 bg-cyan-500 border border-cyan-400',
            self::PRIORITY => 'text-sky-100 bg-sky-500 border border-sky-400',
            self::TOPMOST => 'text-orange-100 bg-orange-500 border border-orange-400',
            self::MOST_IMPORTANT => 'text-rose-100 bg-rose-500 border border-rose-400',
            self::URGENT => 'text-red-100 bg-red-500 border border-red-400',
            self::MOST_URGENT => 'text-fuchsia-100 bg-fuchsia-500 border border-fuchsia-400',
        };
    }

}

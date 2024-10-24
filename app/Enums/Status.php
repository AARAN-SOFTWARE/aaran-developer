<?php

namespace App\Enums;

enum Status : int
{
    case NEW = 1;
    case PENDING = 2;
    case ONPROGRESS = 3;
    case NOTSTARTED = 4;
    case ARCHIVED = 5;
    case FINISHED = 6;
    case CLOSED = 7;
    case NOTACTIVE = 8;
    case RECEIVED = 9;
    case ADMINCLOSED = 10;

    public function getName(): string
    {
        return match ($this) {
            self::NEW => 'New',
            self::PENDING => 'Pending',
            self::ONPROGRESS => 'On Progress',
            self::NOTSTARTED => 'Notstarted',
            self::ARCHIVED => 'Archived',
            self::FINISHED => 'Finished',
            self::CLOSED => 'Closed',
            self::NOTACTIVE => 'NotActive',
            self::RECEIVED => 'Received',
            self::ADMINCLOSED => 'Sundar Closed',
        };
    }

    public function getStyle(): string
    {
        return match ($this) {
            self::NEW => 'text-white bg-green-500',
            self::PENDING => 'text-white bg-red-500',
            self::ONPROGRESS => 'text-white bg-orange-500',
            self::NOTSTARTED => 'text-white bg-amber-500',
            self::ARCHIVED => 'text-white bg-emerald-500',
            self::FINISHED => 'text-white bg-gray-500',
            self::CLOSED => 'text-white bg-sky-500',
            self::NOTACTIVE => 'text-white bg-rose-500',
            self::RECEIVED => 'text-white bg-indigo-600',
            self::ADMINCLOSED => 'text-white bg-violet-100',
        };
    }

}
//lime
//cyan
//purple
//fuchsia
//slate
//stone


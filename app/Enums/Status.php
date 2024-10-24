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
            self::NOTSTARTED => 'Not started',
            self::ARCHIVED => 'Archived',
            self::FINISHED => 'Finished',
            self::CLOSED => 'Closed',
            self::NOTACTIVE => 'Not Active',
            self::RECEIVED => 'Received',
            self::ADMINCLOSED => 'Sundar Closed',
        };
    }

    public function getStyle(): string
    {
        return match ($this) {
            self::NEW => 'text-cyan-700 bg-cyan-100 border border-cyan-400',
            self::PENDING => 'text-yellow-700 bg-yellow-100  border border-yellow-400',
            self::ONPROGRESS => 'text-green-700 bg-green-50 border border-green-400',
            self::NOTSTARTED => 'text-slate-700 bg-slate-100 border border-slate-400',
            self::ARCHIVED => 'text-gray-700 bg-gray-200 border border-gray-400',
            self::FINISHED => 'text-red-700 bg-red-100 border border-red-200',
            self::CLOSED => 'text-slate-700 bg-slate-200 border border-slate-400',
            self::NOTACTIVE => 'text-purple-700 bg-purple-100 border border-purple-400',
            self::RECEIVED => 'text-sky-700 bg-sky-100 border border-sky-400',
            self::ADMINCLOSED => 'text-rose-700 bg-rose-100 border border-rose-400',
        };
    }

}
//lime
//cyan
//purple
//fuchsia
//slate
//stone


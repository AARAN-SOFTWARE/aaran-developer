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
            self::NEW => 'text-gray-500 bg-gray-300',
            self::PENDING => 'text-white bg-gray-600',
            self::ONPROGRESS => 'text-black bg-blue-300',
            self::NOTSTARTED => 'text-gray-100 bg-gray-500',
            self::ARCHIVED => 'text-red-200 bg-slate-300',
            self::FINISHED => 'text-white bg-green-500',
            self::CLOSED => 'text-black bg-green-400',
            self::NOTACTIVE => 'text-zinc-200 bg-red-700',
            self::RECEIVED => 'text-white bg-green-600',
            self::ADMINCLOSED => 'text-blue-100 bg-purple-100',
        };
    }

}

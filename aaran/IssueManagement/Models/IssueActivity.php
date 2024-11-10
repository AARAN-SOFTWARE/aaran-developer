<?php

namespace Aaran\IssueManagement\Models;

use Aaran\IssueManagement\Database\Factories\IssueActivityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueActivity extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

    protected static function newFactory(): IssueActivityFactory
    {
        return new IssueActivityFactory();
    }

}

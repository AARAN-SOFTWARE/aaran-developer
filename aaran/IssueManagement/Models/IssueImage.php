<?php

namespace Aaran\IssueManagement\Models;

use Aaran\IssueManagement\Database\Factories\IssueImageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

    protected static function newFactory(): IssueImageFactory
    {
        return new IssueImageFactory();
    }

}

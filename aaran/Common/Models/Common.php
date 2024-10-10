<?php

namespace Aaran\Common\Models;

use Aaran\Blog\Models\BlogTag;
use Aaran\Common\Database\Factories\CommonFactory;
use Aaran\Master\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Common extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

    public static function name($id)
    {
        return self::find($id)->vname;
    }

    protected static function newFactory(): CommonFactory
    {
        return new CommonFactory();
    }

}

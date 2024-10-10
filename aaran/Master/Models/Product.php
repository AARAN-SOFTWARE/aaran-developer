<?php

namespace Aaran\Master\Models;

use Aaran\Common\Models\Common;
use Aaran\Master\Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];



    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

    public function producttype(): BelongsTo
    {
        return $this->belongsTo(Common::class, 'producttype_id', 'id');
    }
    public function hsncode(): BelongsTo
    {
        return $this->belongsTo(Common::class, 'hsncode_id', 'id');
    }


    public function unit(): BelongsTo
    {
        return $this->belongsTo(Common::class, 'unit_id', 'id');
    }

    public function gstpercent(): BelongsTo
    {
        return $this->belongsTo(Common::class, 'gstpercent_id', 'id');
    }

    protected static function newFactory(): ProductFactory
    {
        return new ProductFactory();
    }

}

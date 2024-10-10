<?php

namespace Aaran\Entries\Models;

use Aaran\Common\Models\Colour;
use Aaran\Common\Models\Common;
use Aaran\Common\Models\Size;
use Aaran\Entries\Database\Factories\PurchaseitemFactory;
use Aaran\Master\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchaseitem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps=false;

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function common(): BelongsTo
    {
        return $this->belongsTo(Common::class);
    }
    protected static function newFactory(): PurchaseitemFactory
    {
        return new PurchaseitemFactory();
    }

    public function purchase():BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }
}

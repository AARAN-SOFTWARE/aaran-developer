<?php

namespace Aaran\Crm\Models;

use Aaran\Common\Models\Common;
use Aaran\Crm\Database\Factories\EnquiryFactory;
use Aaran\Master\Models\Lead;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FollowUp extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }


    public function lead():BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    protected static function newFactory(): EnquiryFactory
    {
        return new FollowUpFactory();
    }
    public function action():BelongsTo
    {
        return $this->belongsTo(Common::class);
    }
}

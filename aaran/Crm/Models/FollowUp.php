<?php

namespace Aaran\Crm\Models;

use Aaran\Common\Models\Common;
use Aaran\Crm\Database\Factories\EnquiryFactory;
use Aaran\Crm\Database\Factories\FollowUpFactory;
use Aaran\Crm\Models\Lead;
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


    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }


    public function action(): BelongsTo
    {
        return $this->belongsTo(Common::class, 'action_id');
    }
}

<?php

namespace Aaran\Crm\Models;

use Aaran\Common\Models\Common;
use Aaran\Crm\Database\Factories\EnquiryFactory;
use Aaran\Crm\Database\Factories\FollowUpFactory;
use Aaran\Crm\Models\Lead;
use App\Models\User;
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
        return $this->belongsTo(User::class);
    }


    public function action(): BelongsTo
    {
        return $this->belongsTo(Common::class, 'action_id');
    }

    public function verified(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    protected $dates = ['start_date', 'end_date'];


}

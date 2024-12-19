<?php

namespace Aaran\Crm\Models;

use Aaran\Crm\Database\Factories\AttemptFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attempt extends Model
{
    /** @use HasFactory<AttemptFactory> */
    use HasFactory;

    protected $guarded=[];

    public function verified(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lead_id');
    }
}

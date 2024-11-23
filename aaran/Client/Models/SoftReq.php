<?php

namespace Aaran\Client\Models;

use Aaran\Common\Models\Common;
use Aaran\Master\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoftReq extends Model
{
    protected $table = 'soft_reqs';

    protected $guarded = [];

    public function contact(): BelongsTo
    {
        return $this->belongsTo( Contact::class , 'contact_id' );
    }

    public function software(): BelongsTo
    {
        return $this->belongsTo( Common::class , 'softType_id' );
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo( Common::class , 'planType_id' );
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo( Common::class , 'serviceType_id' );
    }
}

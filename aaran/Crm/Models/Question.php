<?php

namespace Aaran\Crm\Models;

use Aaran\Common\Models\Common;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Aaran\Crm\Database\Factories\QuestionFactory> */
    use HasFactory;

    protected $guarded = [];

    public function softwareType()
    {
        return $this->belongsTo(Common::class, 'softwareType_id');
    }
}

<?php

namespace Aaran\Common\Models;

use Aaran\Blog\Models\BlogTag;
use Aaran\Common\Database\Factories\CommonFactory;
use Aaran\Common\Database\Factories\LabelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Label extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    protected static function newFactory(): LabelFactory
    {
        return new LabelFactory();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Common::class);
    }

    public static function type($str)
    {
        if ($str) {
            return Common::find($str)->vname;
        } else return '';
    }
}

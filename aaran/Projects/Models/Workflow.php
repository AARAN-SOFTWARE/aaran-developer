<?php

namespace Aaran\Projects\Models;

use Aaran\Common\Models\Common;
use Aaran\Common\Models\Label;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Workflow extends Model
{

    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

    public function Project():BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function label():BelongsTo
    {
        return $this->belongsTo(Label::class);
    }

    public function model():BelongsTo
    {
        return $this->belongsTo(Common::class);
    }


}

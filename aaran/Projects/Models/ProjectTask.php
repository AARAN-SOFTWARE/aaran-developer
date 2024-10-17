<?php

namespace Aaran\Projects\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectTask extends Model
{

    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

    public static function assignee($str)
    {
        return User::find($str)->name;
    }

    public function Workflow():BelongsTo
    {
        return $this->belongsTo(Workflow::class);
    }

    public function ProjectImage():HasMany
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function ProjectActivity():HasMany
    {
        return $this->hasMany(ProjectActivity::class);
    }
}

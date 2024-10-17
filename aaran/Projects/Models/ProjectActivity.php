<?php

namespace Aaran\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectActivity extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function ProjectTask(): BelongsTo
    {
        return $this->belongsTo(ProjectTask::class);
    }
}

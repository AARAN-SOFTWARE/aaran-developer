<?php

namespace Aaran\Projects\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectImage extends Model
{
    protected $guarded=[];

    public function ProjectTask(): BelongsTo
    {
        return $this->belongsTo(ProjectTask::class);
    }

    public static function image($id)
    {
        return self::where('project_task_id',$id)->get();
    }
}

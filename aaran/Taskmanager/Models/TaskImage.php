<?php

namespace Aaran\Taskmanager\Models;

use Aaran\Taskmanager\Database\Factories\TaskImageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory(): TaskImageFactory
    {
        return new TaskImageFactory();
    }

    public function task(): BelongsTo
    {
        return  $this->belongsTo(Task::class);
    }
}

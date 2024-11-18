<?php

namespace Aaran\Taskmanager\Models;

use Aaran\Common\Models\Common;
use Aaran\Taskmanager\Database\Factories\TaskFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function allocated(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function reply() :HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function TaskImage() :HasMany
    {
        return $this->hasMany(TaskImage::class);
    }

    public static function common($id)
    {
        return Common::find($id)->vname;
    }

    protected static function newFactory(): TaskFactory
    {
        return new TaskFactory();
    }
}

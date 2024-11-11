<?php

namespace Aaran\IssueManagement\Models;

use Aaran\Common\Models\Common;
use Aaran\IssueManagement\Database\Factories\IssueFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Issue extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Common::class);
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function allocate($str)
    {
        return User::find($str)->name;
    }
    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function newFactory(): IssueFactory
    {
        return new IssueFactory();
    }

}

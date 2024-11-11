<?php

namespace Aaran\IssueManagement\Models;

use Aaran\IssueManagement\Database\Factories\IssueActivityFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IssueActivity extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

    public static function allocate($str)
    {
        return User::find($str)->name;
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function newFactory(): IssueActivityFactory
    {
        return new IssueActivityFactory();
    }

}

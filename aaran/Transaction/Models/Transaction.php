<?php

namespace Aaran\Transaction\Models;

use Aaran\Common\Models\Common;
use Aaran\Master\Models\Contact;
use Aaran\Transaction\Database\Factories\TransactionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
    public static function common($id)
    {
        return Common::find($id)->vname;
    }

    protected static function newFactory():TransactionFactory
    {
        return new TransactionFactory();
    }

}

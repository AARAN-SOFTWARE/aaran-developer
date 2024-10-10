<?php

namespace Aaran\Entries\Models;

use Aaran\Common\Models\Bank;
use Aaran\Common\Models\Common;
use Aaran\Common\Models\Receipttype;
use Aaran\Entries\Database\Factories\PaymentFactory;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('payment_amount', 'like', '%' . $searches . '%');
    }

    public static function nextNo()
    {
        return static::where('company_id', '=', session()->get('company_id'))->max('entry_no') + 1;
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function receipttype(): BelongsTo
    {
        return $this->belongsTo(Receipttype::class);
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public static function common($id)
    {
        return Common::find($id)->vname;
    }

    protected static function newFactory(): PaymentFactory
    {
        return new PaymentFactory();
    }
}

<?php

namespace Aaran\Crm\Models;

use Aaran\Crm\Database\Factories\EnquiryFactory;
use Aaran\Master\Models\Contact;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enquiry extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }


    public function contact():BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    protected static function newFactory(): EnquiryFactory
    {
        return new EnquiryFactory();
    }
}

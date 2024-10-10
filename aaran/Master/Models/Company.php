<?php

namespace Aaran\Master\Models;

use Aaran\Common\Models\Common;
use Aaran\Master\Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

    public static function printDetails($ids): Collection
    {
        $obj = self::find($ids);

        return collect([
            'company_name' => $obj->display_name,
            'address_1' => $obj->address_1,
            'address_2' => $obj->address_2,
            'city' => Common::find($obj->city_id)->vname . ' - ' .  Common::find($obj->pincode_id)->vname,
            'city_name' => Common::find($obj->city_id)->vname ,
            'state' =>  Common::find($obj->state_id)->vname . ' - ' .  Common::find($obj->state_id)->desc,
            'contact' => ' Contact : ' . $obj->mobile,
            'email' => 'Email : ' . $obj->email,
            'gstin' => 'GST : ' . $obj->gstin,
            'gst' => $obj->gstin,
            'msme' => 'MSME No : ' . $obj->msme_no,
            'logo' => $obj->logo,
            'bank' => $obj->bank,
            'acc_no' => $obj->acc_no,
            'ifsc_code' => $obj->ifsc_code,
            'branch' => $obj->branch,
        ]);
    }

    public function commons(): HasOne
    {
        return $this->hasOne(Common::class, 'id', 'city_id')
            ->orWhere('id', 'state_id')
            ->orWhere('id', 'pincode_id');
    }

    public static function common($id)
    {
        return Common::find($id)->vname;
    }

    protected static function newFactory(): CompanyFactory
    {
        return new CompanyFactory();
    }

}

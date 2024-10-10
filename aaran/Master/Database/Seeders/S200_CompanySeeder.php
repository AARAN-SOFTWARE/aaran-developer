<?php

namespace Aaran\Master\Database\Seeders;

use Aaran\Master\Models\Company;
use Illuminate\Database\Seeder;

class S200_CompanySeeder extends Seeder
{
    public static function run(): void
    {
        Company::create([
            'vname' => 'ABC company pvt ltd',
            'display_name' => '-',
            'address_1' => '5th block',
            'address_2' => 'kuvempu layout',
            'mobile' => '-',
            'landline' => '-',
            'msme_type_id' => '126',
            'gstin' => '29AABCT1332L000',
            'pan' => '-',
            'email' => '-',
            'website' => '-',
            'city_id'=>'128',
            'state_id'=>'47',
            'pincode_id'=>'129',
            'country_id'=>'60',
            'active_id' => '1',
            'user_id' => '1',
            'tenant_id' => '1',
            'logo' => 'no_image'
        ]);
    }
}

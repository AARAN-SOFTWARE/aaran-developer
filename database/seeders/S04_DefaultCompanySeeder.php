<?php

namespace Database\Seeders;

use App\Models\DefaultCompany;
use Illuminate\Database\Seeder;

class S04_DefaultCompanySeeder extends Seeder
{
    public static function run(): void
    {
        DefaultCompany::create([
            'company_id' => '1',
            'tenant_id'=>'1',
            'acyear' => '116',
        ]);
    }
}

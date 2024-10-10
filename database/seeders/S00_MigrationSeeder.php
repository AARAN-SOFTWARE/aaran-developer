<?php

namespace Database\Seeders;

use Aaran\Aadmin\Database\Migrations\RefactorMigrationTable;
use Illuminate\Database\Seeder;

class S00_MigrationSeeder extends Seeder
{
    public static function run(): void
    {
        RefactorMigrationTable::clear('2024_03_01_000001_create_tenants_table');
    }
}

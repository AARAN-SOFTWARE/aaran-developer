<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\Label;
use Illuminate\Database\Seeder;

class S101_LabelSeeder extends Seeder
{
    public static function run(): void
    {
        #1
        Label::create([
            'id' => 1,
            'vname' => '-',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #2
        Label::create([
            'id' => 2,
            'vname' => 'City ',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #3
        Label::create([
            'id' => 3,
            'vname' => 'State ',
            'cols' => 2,
            'active_id' => '1'
        ]);

        #4
        Label::create([
            'id' => 4,
            'vname' => 'PinCode ',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #5
        Label::create([
            'id' => 5,
            'vname' => 'Country ',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #6
        Label::create([
            'id' => 6,
            'vname' => 'Software Type',
            'cols' => 2,
            'active_id' => '1'
        ]);

        #7
        Label::create([
            'id' => 7,
            'vname' => 'Plan Type ',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #8
        Label::create([
            'id' => 8,
            'vname' => 'Service ',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #9
        Label::create([
            'id' => 9,
            'vname' => 'Bank ',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #10
        Label::create([
            'id' => 10,
            'vname' => 'Staff ',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #11
        Label::create([
            'id' => 11,
            'vname' => 'Receipt Type ',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #12
        Label::create([
            'id' => 12,
            'vname' => 'GST Percent',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #13
        Label::create([
            'id' => 13,
            'vname' => 'Blog Category',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #14
        Label::create([
            'id' => 14,
            'vname' => 'Transaction Type',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #15
        Label::create([
            'id' => 15,
            'vname' => 'Mode of Payment',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #16
        Label::create([
            'id' => 16,
            'vname' => 'AccYear',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #17
        Label::create([
            'id' => 17,
            'vname' => 'Contact Type',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #18
        Label::create([
            'id' => 18,
            'vname' => 'MSME Type',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #19
        Label::create([
            'id' => 19,
            'vname' => 'Module',
            'cols' => 1,
            'active_id' => '1'
        ]);

        #20
        Label::create([
            'id' => 20,
            'vname' => 'Job',
            'cols' => 1,
            'active_id' => '1'
        ]);
    }
}

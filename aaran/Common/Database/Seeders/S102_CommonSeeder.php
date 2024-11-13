<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Common\Models\Common;
use Illuminate\Database\Seeder;

class S102_CommonSeeder extends Seeder
{
    public static function run(): void
    {
        self::noRecord();
        self::city();
        self::state();
        self::pinCode();
        self::country();
        self::hsncode();
        self::colour();
        self::size();
        self::bank();
        self::ledger();
        self::receiptType();
        self::productType();
        self::units();
        self::gstPercent();
        self::salesType();
        self::transaction();
        self::mode();
        self::accyear();
        self::Transport();
        self::contactType();
        self::msmeType();
        self::GstApiData();
        self::AddNew();
    }

    #region[noRecord]
    private static function noRecord(): void
    {
        Common::create([
            'label_id' => '1',
            'vname' => '-',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[City]
    private static function city(): void
    {
        Common::create([
            'label_id' => '2',
            'vname' => 'Tiruppur',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Erode',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Salem',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Coimbatore',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Chennai',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Kanchipuram',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Madurai',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Thanjavur',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Tiruchirappalli',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Vellore',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Tirunelveli',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Thoothukkudi',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Dindigul',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Rajapalayam',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Pudukkottai',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '2',
            'vname' => 'Karaikkudi',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[State]
    private static function state(): void
    {
        Common::create([
            'label_id' => '3',
            'vname' => 'TAMIL NADU',
            'desc' => '33',
            'desc_1' => '-',
            'active_id' => '1'
        ]);

        Common::create([
            'label_id' => '3',
            'vname' => 'KERALA',
            'desc' => '32',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'PUDUCHERRY',
            'desc' => '34',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'JAMMU AND KASHMIR',
            'desc' => '1',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'HIMACHAL PRADESH',
            'desc' => '2',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'PUNJAB',
            'desc' => '3',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'CHANDIGARH',
            'desc' => '4',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'UTTARAKHAND',
            'desc' => '5',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'HARYANA',
            'desc' => '6',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'DELHI',
            'desc' => '7',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'RAJASTHAN',
            'desc' => '8',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'UTTAR PRADESH',
            'desc' => '9',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'BIHAR',
            'desc' => '10',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'SIKKIM',
            'desc' => '11',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'ARUNACHAL PRADESH',
            'desc' => '12',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'NAGALAND',
            'desc' => '13',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'MANIPUR',
            'desc' => '14',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'MIZORAM',
            'desc' => '15',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'TRIPURA',
            'desc' => '16',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'MEGHALAYA',
            'desc' => '17',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'ASSAM',
            'desc' => '18',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'WEST BENGAL',
            'desc' => '19',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'JHARKHAND',
            'desc' => '20',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'ODISHA',
            'desc' => '21',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'CHATTISGARH',
            'desc' => '22',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'MADHYA PRADESH',
            'desc' => '23',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'GUJARAT',
            'desc' => '24',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'DADRA AND NAGAR HAVELI AND DAMAN AND DIU',
            'desc' => '26',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'MAHARASHTRA',
            'desc' => '27',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'KARNATAKA',
            'desc' => '29',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'GOA',
            'desc' => '30',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'ANDAMAN AND NICOBAR ISLANDS',
            'desc' => '35',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'LAKSHADWEEP',
            'desc' => '31',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'TELANGANA',
            'desc' => '36',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'LADAKH',
            'desc' => '38',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '3',
            'vname' => 'Andhra Pradesh',
            'desc' => '37',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[Pincode]
    private static function pinCode(): void
    {
        Common::create([
            'label_id' => '4',
            'vname' => '641601',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);

        Common::create([
            'label_id' => '4',
            'vname' => '641602',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '4',
            'vname' => '641603',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '4',
            'vname' => '641604',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '4',
            'vname' => '641605',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '4',
            'vname' => '641606',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[Country]
    private static function country(): void
    {
        Common::create([
            'label_id' => '5',
            'vname' => 'INDIA',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[Hsncode]
    private static function hsncode(): void
    {
        Common::create([
            'label_id' => '6',
            'vname' => '61099090',
            'desc' => 'T-shirts, singlets and other vests, knitted or crocheted -of other textile materials : other.',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '6',
            'vname' => '61091000',
            'desc' => 'T-shirts, singlets and other vests, knitted or crocheted - of cotton.',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[colour]
    private static function colour(): void
    {
        Common::create([
            'label_id' => '7',
            'vname' => 'Red',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '7',
            'vname' => 'Pink',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '7',
            'vname' => 'Black',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '7',
            'vname' => 'Navy',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '7',
            'vname' => 'White',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '7',
            'vname' => 'Orange',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[size]
    private static function size(): void
    {
        Common::create([
            'label_id' => '8',
            'vname' => 'S',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '8',
            'vname' => 'M',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '8',
            'vname' => 'L',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '8',
            'vname' => 'XL',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '8',
            'vname' => '2XL',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '8',
            'vname' => 'AllSize',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[Bank]
    private static function bank(): void
    {
        Common::create([
            'label_id' => '9',
            'vname' => 'State Bank Of India',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '9',
            'vname' => 'AXIS Bank',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '9',
            'vname' => 'ICICI Bank',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '9',
            'vname' => 'Indusind Bank',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '9',
            'vname' => 'Indian Overseas Bank',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '9',
            'vname' => 'Hdfc Bank',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[ledger]
    private static function ledger(): void
    {
        Common::create([
            'label_id' => '10',
            'vname' => 'Auto Charges',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '10',
            'vname' => 'Loading & Unloading Charges',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '10',
            'vname' => 'Courier Charges',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '10',
            'vname' => 'Discount',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[receipt type]
    private static function receiptType(): void
    {
        Common::create([
            'label_id' => '14',
            'vname' => 'Cash',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '14',
            'vname' => 'Cheque',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '14',
            'vname' => 'RTGS',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '14',
            'vname' => 'NEFT',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '14',
            'vname' => 'IMPS',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '14',
            'vname' => 'PhonePe',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '14',
            'vname' => 'GPay',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);

    }
    #endregion

    #region[Product Type]
    private static function productType(): void
    {
        Common::create([
            'label_id' => '15',
            'vname' => 'Goods',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '15',
            'vname' => 'Service',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[Units]
    private static function units(): void
    {
        Common::create([
            'label_id' => '16',
            'vname' => 'Kgs',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '16',
            'vname' => 'Mts',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '16',
            'vname' => 'Pcs',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '16',
            'vname' => 'Nos',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '16',
            'vname' => 'Lts',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[gstPercent]
    private static function gstPercent(): void
    {
        Common::create([
            'label_id' => '17',
            'vname' => '0',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '17',
            'vname' => '5',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '17',
            'vname' => '12',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '17',
            'vname' => '18',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '17',
            'vname' => '24',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[SalesType]
    private static function salesType(): void
    {
        Common::create([
            'label_id' => '18',
            'vname' => 'Invoice',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '18',
            'vname' => 'Billing',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '18',
            'vname' => 'Sales',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '18',
            'vname' => 'GST',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[transaction]
    private static function transaction(): void
    {
        Common::create([
            'label_id' => '19',
            'vname' => 'Cash Book',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '19',
            'vname' => 'Bank Book',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }

    #endregion

    #region[Mode]
    private static function mode(): void
    {
        Common::create([
            'label_id' => '20',
            'vname' => 'Payment',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '20',
            'vname' => 'Receipt',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[accyear]
    private static function accyear(): void
    {
        Common::create([
            'label_id' => '21',
            'vname' => '2020_2021',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '21',
            'vname' => '2021_2022',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '21',
            'vname' => '2022_2023',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '21',
            'vname' => '2023_2024',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '21',
            'vname' => '2024_2025',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '21',
            'vname' => '2025_2026',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '21',
            'vname' => '2026_2027',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '21',
            'vname' => '2027_2028',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '21',
            'vname' => '2028_2029',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '21',
            'vname' => '2029_2030',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[Transport]
    private static function Transport(): void
    {
        Common::create([
            'label_id' => '11',
            'vname' => 'XYZ EXPORTS',
            'desc' => '12AWGPV7107B1Z1',
            'desc_1' => 'DOC01',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[Contact Type]
    private static function contactType(): void
    {
        Common::create([
            'label_id' => '22',
            'vname' => 'Creditor',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '22',
            'vname' => 'Debtor',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion

    #region[MSME Type]
    private static function msmeType(): void
    {
        Common::create([
            'label_id' => '23',
            'vname' => 'Micro',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '23',
            'vname' => 'Small',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '23',
            'vname' => 'Medium',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
    #endregion
    #region[GstApiData]
    private static function GstApiData(): void
    {
        Common::create([
            'label_id' => '2',
            'vname' => 'GANDHINAGAR',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '4',
            'vname' => '560001',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '6',
            'vname' => '1001',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }

    #endregion

    public static function AddNew()
    {
        Common::create([
            'label_id' => '21',
            'vname' => '2017_2018',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '21',
            'vname' => '2018_2019',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
        Common::create([
            'label_id' => '21',
            'vname' => '2019_2020',
            'desc' => '-',
            'desc_1' => '-',
            'active_id' => '1'
        ]);
    }
}

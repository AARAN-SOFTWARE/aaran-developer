<?php

use Aaran\Aadmin\Src\Customise;
use Aaran\Aadmin\Src\SaleEntry;

return [

    'customise' => [
        Customise::common(),
        Customise::master(),
        Customise::entries(),
        Customise::core(),
        Customise::blog(),
        Customise::gstapi(),
        Customise::transaction(),
        Customise::demodata(),
        Customise::taskManager(),
        Customise::exportsales(),
    ],
    'SalesEntry' => [
        SaleEntry::order(),
        SaleEntry::billingAddress(),
        SaleEntry::shippingAddress(),
        SaleEntry::style(),
//        SaleEntry::despatch(),
        SaleEntry::transport(),
        SaleEntry::destination(),
        SaleEntry::bundle(),

        SaleEntry::productDescription(),
        SaleEntry::colour(),
        SaleEntry::size(),

    ],
];

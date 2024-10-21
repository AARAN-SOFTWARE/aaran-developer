<?php

use Aaran\Aadmin\Src\Customise;
use Aaran\Aadmin\Src\SaleEntry;

return [

    'customise' => [
        Customise::common(),
        Customise::master(),
        Customise::core(),
        Customise::blog(),
        Customise::taskManager(),
        Customise::projects(),
        Customise::installations(),
    ],

];

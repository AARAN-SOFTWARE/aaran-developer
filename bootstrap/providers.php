<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FortifyServiceProvider::class,
    App\Providers\JetstreamServiceProvider::class,
    App\Providers\EventServiceProvider::class,

    Aaran\Aadmin\Providers\AadminServiceProvider::class,
    Aaran\Common\Providers\CommonServiceProvider::class,
    Aaran\Master\Providers\MasterServiceProvider::class,
    Aaran\Entries\Providers\EntriesServiceProvider::class,
    Aaran\Web\Providers\WebServiceProvider::class,

    Aaran\Blog\Providers\BlogServiceProvider::class,
    Aaran\MasterGst\Providers\MasterGstServiceProvider::class,

    Aaran\Transaction\Providers\TransactionServiceProvider::class,
    Aaran\Demodata\Providers\DemodataServiceProvider::class,
    Aaran\Taskmanager\Providers\TaskmanagerServiceProvider::class,

];

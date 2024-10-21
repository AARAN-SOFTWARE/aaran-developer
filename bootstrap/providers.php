<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FortifyServiceProvider::class,
    App\Providers\JetstreamServiceProvider::class,
    App\Providers\EventServiceProvider::class,

    Aaran\Aadmin\Providers\AadminServiceProvider::class,
    Aaran\Common\Providers\CommonServiceProvider::class,
    Aaran\Master\Providers\MasterServiceProvider::class,
    Aaran\Web\Providers\WebServiceProvider::class,

    Aaran\Blog\Providers\BlogServiceProvider::class,

    Aaran\Taskmanager\Providers\TaskmanagerServiceProvider::class,

    Aaran\Projects\Providers\ProjectServiceProvider::class,

    Aaran\Contact\Providers\ContactServiceProvider::class,

];

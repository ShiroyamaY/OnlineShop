<?php

use Illuminate\Events\EventServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\TelescopeServiceProvider::class,
    App\Providers\TestingServiceProvider::class,
    App\Providers\ViewServiceProvider::class,
    EventServiceProvider::class,
];

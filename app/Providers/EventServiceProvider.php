<?php

namespace App\Providers;

use App\Events\AuthorizeTransferEvent;
use App\Listeners\AuthorizeTransferListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        AuthorizeTransferEvent::class => [
            AuthorizeTransferListener::class,
        ],
    ];
}

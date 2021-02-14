<?php

namespace App\Providers;

use App\Events\ApproveTransferEvent;
use App\Events\AuthorizeTransferEvent;
use App\Events\CancelTransferEvent;
use App\Events\FinishTransferEvent;
use App\Listeners\ApproveTransferListener;
use App\Listeners\AuthorizeTransferListener;
use App\Listeners\CancelTransferListener;
use App\Listeners\FinishTransferListener;
use App\Listeners\UserTransferListener;
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
            AuthorizeTransferListener::class
        ],
        ApproveTransferEvent::class => [
            ApproveTransferListener::class,
            UserTransferListener::class
        ],
        CancelTransferEvent::class => [
            CancelTransferListener::class
        ],
        FinishTransferEvent::class => [
            FinishTransferListener::class
        ]
    ];
}

<?php

namespace App\Providers;

use App\Events\Transfer\{ApproveEvent, AuthorizeEvent, CancelEvent, FinishEvent};
use App\Events\Notification\{SendEvent, SentEvent};
use App\Listeners\Transfer\{ApproveListener, AuthorizeListener, CancelListener, FinishListener, TransferListener};
use App\Listeners\Notification\{CreateListener, SendListener, SentListener};
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        AuthorizeEvent::class => [
            AuthorizeListener::class
        ],
        ApproveEvent::class => [
            ApproveListener::class,
            TransferListener::class
        ],
        CancelEvent::class => [
            CancelListener::class
        ],
        FinishEvent::class => [
            FinishListener::class,
            CreateListener::class
        ],
        SendEvent::class => [
            SendListener::class
        ],
        SentEvent::class => [
            SentListener::class
        ]
    ];
}

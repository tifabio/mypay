<?php

namespace App\Providers;

use App\Events\Transfer\ApproveEvent;
use App\Events\Transfer\AuthorizeEvent;
use App\Events\Transfer\CancelEvent;
use App\Events\Transfer\FinishEvent;
use App\Events\Notification\SendEvent;
use App\Events\Notification\SentEvent;
use App\Listeners\Transfer\ApproveListener;
use App\Listeners\Transfer\AuthorizeListener;
use App\Listeners\Transfer\CancelListener;
use App\Listeners\Transfer\FinishListener;
use App\Listeners\Transfer\TransferListener;
use App\Listeners\Notification\CreateListener;
use App\Listeners\Notification\SentListener;
use App\Listeners\Notification\SendListener;
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

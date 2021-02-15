<?php

namespace App\Providers;

use App\Events\Transfer\ApproveEvent;
use App\Events\Transfer\AuthorizeEvent;
use App\Events\Transfer\CancelEvent;
use App\Events\Transfer\FinishEvent;
use App\Events\Notification\SendEvent;
use App\Events\Notification\SentEvent;
use App\Listeners\ApproveTransferListener;
use App\Listeners\AuthorizeTransferListener;
use App\Listeners\CancelTransferListener;
use App\Listeners\CreateNotificationListener;
use App\Listeners\FinishTransferListener;
use App\Listeners\NotificationSentListener;
use App\Listeners\SendNotificationListener;
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
        AuthorizeEvent::class => [
            AuthorizeTransferListener::class
        ],
        ApproveEvent::class => [
            ApproveTransferListener::class,
            UserTransferListener::class
        ],
        CancelEvent::class => [
            CancelTransferListener::class
        ],
        FinishEvent::class => [
            FinishTransferListener::class,
            CreateNotificationListener::class
        ],
        SendEvent::class => [
            SendNotificationListener::class
        ],
        SentEvent::class => [
            NotificationSentListener::class
        ]
    ];
}

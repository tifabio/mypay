<?php

namespace App\Listeners;

use App\Events\Notification\SentEvent;
use App\Services\NotificationService;

class NotificationSentListener
{
    /**
     * @var NotificationService $transferService
     */
    private $notificationService;

    /**
     * Create the event listener.
     * 
     * @return void
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     *
     * @param  SentEvent $event
     * 
     * @return void
     */
    public function handle(SentEvent $event)
    {
        $this->notificationService->sent($event->notification);
    }
}

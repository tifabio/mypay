<?php

namespace App\Listeners;

use App\Events\NotificationSentEvent;
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
     * @param  NotificationSentEvent $event
     * 
     * @return void
     */
    public function handle(NotificationSentEvent $event)
    {
        $this->notificationService->sent($event->notification);
    }
}

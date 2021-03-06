<?php

namespace App\Listeners\Notification;

use App\Events\Transfer\FinishEvent;
use App\Services\NotificationService;

class CreateListener
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
     * @param FinishEvent $event
     * 
     * @return void
     */
    public function handle(FinishEvent $event)
    {
        $this->notificationService->create($event->transfer);
    }
}

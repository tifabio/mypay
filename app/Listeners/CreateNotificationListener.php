<?php

namespace App\Listeners;

use App\Events\FinishTransferEvent;
use App\Services\NotificationService;

class CreateNotificationListener
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
     * @param  FinishTransferEvent $event
     * 
     * @return void
     */
    public function handle(FinishTransferEvent $event)
    {
        $this->notificationService->create($event->transfer);
    }
}

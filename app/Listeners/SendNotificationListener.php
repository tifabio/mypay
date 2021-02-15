<?php

namespace App\Listeners;

use App\Events\Notification\SendEvent;
use App\Repositories\MockyNotifier;
use App\Services\NotifierService;

class SendNotificationListener
{
    /**
     * @var NotifierService $notifierService
     */
    private $notifierService;

    /**
     * Create the event listener.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->notifierService = new NotifierService(new MockyNotifier);
    }

    /**
     * Handle the event.
     *
     * @param  SendEvent $event
     * 
     * @return void
     */
    public function handle(SendEvent $event)
    {
        $this->notifierService->send($event->notification);
    }
}

<?php

namespace App\Listeners\Notification;

use App\Events\Notification\SendEvent;
use App\Services\NotifierService;

class SendListener
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
    public function __construct(NotifierService $notifierService)
    {
        $this->notifierService = $notifierService;
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

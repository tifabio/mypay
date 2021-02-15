<?php

namespace App\Events;

use App\Models\Notification;

class SendNotificationEvent extends Event
{
    /**
     * @var Notification
     */
    public $notification;

    /**
     * Create a new event instance.
     * 
     * @param Notification $notification
     *
     * @return void
     */
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }    
}

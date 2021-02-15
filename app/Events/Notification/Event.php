<?php

namespace App\Events\Notification;

use App\Models\Notification;
use Illuminate\Queue\SerializesModels;

abstract class Event
{
    use SerializesModels;

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

<?php

namespace App\Services;

use App\Models\Notification;

class NotifierService
{
    /**
     * @var Notifier
     */
    private $notifier;

    /**
     * Create a new service instance
     *
     * @return void
     */
    // public function __construct(Notifier $notifier)
    // {
    //     $this->notifier = $notifier;
    // }

    public function send(Notification $notification)
    {
        // dd($notification->toArray());
    }
}
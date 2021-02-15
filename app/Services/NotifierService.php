<?php

namespace App\Services;

use App\Events\Notification\SentEvent;
use App\Exceptions\NotificationException;
use App\Models\Notification;
use App\Models\NotificationStatus;
use App\Repositories\Interfaces\Notifier;

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
    public function __construct(Notifier $notifier)
    {
        $this->notifier = $notifier;
    }

    public function send(Notification $notification)
    {
        if($notification->notification_status_id === NotificationStatus::STATUS_PENDING)
        {
            $sent = $this->notifier->send($notification);

            if($sent)
            {
                event(new SentEvent($notification));
                return;
            }

            throw new NotificationException(NotificationException::SENT_ERROR);
        }

        throw new NotificationException(NotificationException::WRONG_STATUS_PENDING);
    }
}
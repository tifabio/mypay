<?php

namespace App\Services;

use App\Models\Interfaces\Notifiable;
use App\Models\NotificationStatus;
use App\Repositories\NotificationRepository;

class NotificationService
{

    /**
     * @var NotificationRepository
     */
    private $notificationRepository;

    /**
     * Create a new service instance
     * 
     * @param NotificationRepository $notificationRepository
     *
     * @return void
     */
    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function create(Notifiable $notifiable)
    {
        $notification = [
            'content' => $notifiable->getNotificationContent(),
            'users_id' => $notifiable->getNotificationUser(),
            'notification_status_id' => NotificationStatus::STATUS_PENDING
        ];

        $notification = $this->notificationRepository->save($notification);

        if($notification)
        {
            // event(new AuthorizeTransferEvent($transfer));
            return;
        }
    }
}
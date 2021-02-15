<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository
{
    /**
     * @var Notification
     */
    private $model;

    public function __construct(Notification $notification)
    {
        $this->model = $notification;
    }

    public function save(array $data, int $id = 0)
    {
        if($id > 0) {
            $this->model
                ->where('id', $id)
                ->update($data);

            return $this->model->find($id);
        }

        $notification = $this->model->create($data);

        return $notification ? $notification : [];
    }
}
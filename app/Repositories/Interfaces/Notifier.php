<?php

namespace App\Repositories\Interfaces;

use App\Models\Notification;

interface Notifier
{
    public function send(Notification $notification);
}
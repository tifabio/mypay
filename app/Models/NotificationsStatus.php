<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationsStatus extends Model
{
    const STATUS_PENDING = 1;
    const STATUS_SENT = 2;

    protected $table = 'notifications_status';
}

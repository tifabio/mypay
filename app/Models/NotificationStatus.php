<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationStatus extends Model
{
    const STATUS_PENDING = 1;
    const STATUS_SENT = 2;

    protected $table = 'notification_status';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferStatus extends Model
{
    const STATUS_PENDING = 1;
    const STATUS_CANCELED = 2;
    const STATUS_APPROVED = 3;
    const STATUS_FINISHED = 4;

    protected $table = 'transfer_status';
}

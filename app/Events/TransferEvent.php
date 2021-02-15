<?php

namespace App\Events;

use App\Models\Transfer;
use Illuminate\Queue\SerializesModels;

abstract class TransferEvent
{
    use SerializesModels;

    /**
     * @var Transfer
     */
    public $transfer;

    /**
     * Create a new event instance.
     * 
     * @param Transfer $transfer
     *
     * @return void
     */
    public function __construct(Transfer $transfer)
    {
        $this->transfer = $transfer;
    }
}

<?php

namespace App\Events;

use App\Models\Transfer;

class AuthorizeTransferEvent extends Event
{
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

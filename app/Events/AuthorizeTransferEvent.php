<?php

namespace App\Events;

use App\Models\Transfers;

class AuthorizeTransferEvent extends Event
{
    /**
     * @var Transfers
     */
    public $transfer;

    /**
     * Create a new event instance.
     * 
     * @param Transfers $transfer
     *
     * @return void
     */
    public function __construct(Transfers $transfer)
    {
        $this->transfer = $transfer;
    }
}

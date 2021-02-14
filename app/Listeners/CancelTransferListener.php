<?php

namespace App\Listeners;

use App\Events\CancelTransferEvent;
use App\Services\TransferService;

class CancelTransferListener
{
    /**
     * @var transferService $transferService
     */
    private $transferService;

    /**
     * Create the event listener.
     * 
     * @return void
     */
    public function __construct(transferService $transferService)
    {
        $this->transferService = $transferService;
    }

    /**
     * Handle the event.
     *
     * @param  CancelTransferEvent $event
     * 
     * @return void
     */
    public function handle(CancelTransferEvent $event)
    {
        $this->transferService->cancel($event->transfer);
    }
}

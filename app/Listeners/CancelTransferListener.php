<?php

namespace App\Listeners;

use App\Events\Transfer\CancelEvent;
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
     * @param  CancelEvent $event
     * 
     * @return void
     */
    public function handle(CancelEvent $event)
    {
        $this->transferService->cancel($event->transfer);
    }
}

<?php

namespace App\Listeners;

use App\Events\FinishTransferEvent;
use App\Services\TransferService;

class FinishTransferListener
{
    /**
     * @var TransferService $transferService
     */
    private $transferService;

    /**
     * Create the event listener.
     * 
     * @return void
     */
    public function __construct(TransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    /**
     * Handle the event.
     *
     * @param  FinishTransferEvent $event
     * 
     * @return void
     */
    public function handle(FinishTransferEvent $event)
    {
        $this->transferService->finish($event->transfer);
    }
}

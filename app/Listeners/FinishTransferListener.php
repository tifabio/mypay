<?php

namespace App\Listeners;

use App\Events\Transfer\FinishEvent;
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
     * @param  FinishEvent $event
     * 
     * @return void
     */
    public function handle(FinishEvent $event)
    {
        $this->transferService->finish($event->transfer);
    }
}

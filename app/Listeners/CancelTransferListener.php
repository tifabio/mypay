<?php

namespace App\Listeners;

use App\Events\CancelTransferEvent;
use App\Services\TransfersService;

class CancelTransferListener
{
    /**
     * @var TransfersService $transfersService
     */
    private $transfersService;

    /**
     * Create the event listener.
     * 
     * @return void
     */
    public function __construct(TransfersService $transfersService)
    {
        $this->transfersService = $transfersService;
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
        // $this->transfersService->cancel($event->transfer);
    }
}

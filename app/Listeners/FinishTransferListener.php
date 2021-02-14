<?php

namespace App\Listeners;

use App\Events\FinishTransferEvent;
use App\Services\TransfersService;

class FinishTransferListener
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
     * @param  FinishTransferEvent $event
     * 
     * @return void
     */
    public function handle(FinishTransferEvent $event)
    {
        $this->transfersService->finish($event->transfer);
    }
}

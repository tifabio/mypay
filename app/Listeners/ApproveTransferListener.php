<?php

namespace App\Listeners;

use App\Events\ApproveTransferEvent;
use App\Services\TransfersService;

class ApproveTransferListener
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
     * @param  ApproveTransferEvent $event
     * 
     * @return void
     */
    public function handle(ApproveTransferEvent $event)
    {
        $this->transfersService->approve($event->transfer);
    }
}

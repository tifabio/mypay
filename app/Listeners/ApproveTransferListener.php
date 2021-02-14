<?php

namespace App\Listeners;

use App\Events\ApproveTransferEvent;
use App\Services\TransferService;

class ApproveTransferListener
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
     * @param  ApproveTransferEvent $event
     * 
     * @return void
     */
    public function handle(ApproveTransferEvent $event)
    {
        $this->transferService->approve($event->transfer);
    }
}

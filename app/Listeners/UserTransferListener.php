<?php

namespace App\Listeners;

use App\Events\ApproveTransferEvent;
use App\Services\TransferService;

class UserTransferListener
{
    /**
     * @var TransferService $transfersService
     */
    private $transfersService;

    /**
     * Create the event listener.
     * 
     * @return void
     */
    public function __construct(TransferService $transfersService)
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
        $this->transfersService->transfer($event->transfer);
    }
}

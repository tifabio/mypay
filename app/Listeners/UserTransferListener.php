<?php

namespace App\Listeners;

use App\Events\ApproveTransferEvent;
use App\Services\TransfersService;

class UserTransferListener
{
    /**
     * @var TransfersService $transfersService
     */
    private $usersService;

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
        $this->transfersService->transfer($event->transfer);
    }
}

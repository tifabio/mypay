<?php

namespace App\Listeners\Transfer;

use App\Events\Transfer\ApproveEvent;
use App\Services\TransferService;

class ApproveListener
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
     * @param  ApproveEvent $event
     * 
     * @return void
     */
    public function handle(ApproveEvent $event)
    {
        $this->transferService->approve($event->transfer);
    }
}

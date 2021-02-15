<?php

namespace App\Listeners\Transfer;

use App\Events\Transfer\CancelEvent;
use App\Services\TransferService;

class CancelListener
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

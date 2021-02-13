<?php

namespace App\Listeners;

use App\Events\AuthorizeTransferEvent;
use App\Services\AuthorizerService;

class AuthorizeTransferListener
{
    /**
     * @var AuthorizerService $authorizerService
     */
    private $authorizerService;

    /**
     * Create the event listener.
     * 
     * @param AuthorizerService $authorizerService
     *
     * @return void
     */
    public function __construct(AuthorizerService $authorizerService)
    {
        $this->authorizerService = $authorizerService;
    }

    /**
     * Handle the event.
     *
     * @param  AuthorizeTransferEvent $event
     * 
     * @return void
     */
    public function handle(AuthorizeTransferEvent $event)
    {
        $this->authorizerService->process($event->transfer);
    }
}

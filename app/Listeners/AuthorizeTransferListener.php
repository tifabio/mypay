<?php

namespace App\Listeners;

use App\Events\Transfer\AuthorizeEvent;
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
     * @return void
     */
    public function __construct(AuthorizerService $authorizerService)
    {
        $this->authorizerService = $authorizerService;
    }

    /**
     * Handle the event.
     *
     * @param  AuthorizeEvent $event
     * 
     * @return void
     */
    public function handle(AuthorizeEvent $event)
    {
        $this->authorizerService->process($event->transfer);
    }
}

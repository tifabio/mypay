<?php

namespace App\Listeners;

use App\Events\AuthorizeTransferEvent;
use App\Repositories\MockyAuthorizer;
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
    public function __construct()
    {
        $this->authorizerService = new AuthorizerService(new MockyAuthorizer);
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

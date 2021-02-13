<?php

namespace App\Services;

use App\Models\Transfers;
use App\Models\TransfersStatus;
use App\Repositories\Interfaces\Authorizer;
use App\Repositories\MockyAuthorizer;
use Exception;

class AuthorizerService
{
    /**
     * @var Authorizer
     */
    private $authorizer;

    /**
     * Create a new service instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizer = new MockyAuthorizer();
    }

    public function process(Transfers $transfer)
    {
        if($transfer->transfers_status_id === TransfersStatus::STATUS_PENDING)
        {
            $this->authorizer->call($transfer);

            return;
        }

        throw new Exception('Wrong transfer status');
    }
}
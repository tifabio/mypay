<?php

namespace App\Services;

use App\Models\Transfers;
use App\Models\TransfersStatus;
use App\Repositories\Interfaces\Authorizer;
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
    public function __construct(Authorizer $authorizer)
    {
        $this->authorizer = $authorizer;
    }

    public function process(Transfers $transfer)
    {
        if($transfer->transfers_status_id === TransfersStatus::STATUS_PENDING)
        {
            $approved = $this->authorizer->call($transfer);

            if($approved)
            {
                // emit approved
                return;
            }

            // emit cancel
            return;
        }

        throw new Exception('Wrong transfer status');
    }
}
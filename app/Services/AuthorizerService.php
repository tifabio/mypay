<?php

namespace App\Services;

use App\Events\ApproveTransferEvent;
use App\Events\CancelTransferEvent;
use App\Exceptions\TransferException;
use App\Models\Transfer;
use App\Models\TransferStatus;
use App\Repositories\Interfaces\Authorizer;

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

    public function process(Transfer $transfer)
    {
        if($transfer->transfer_status_id === TransferStatus::STATUS_PENDING)
        {
            $approved = $this->authorizer->isAuthorized($transfer);

            if($approved)
            {
                event(new ApproveTransferEvent($transfer));
                return;
            }

            event(new CancelTransferEvent($transfer));
            return;
        }

        throw new TransferException(TransferException::WRONG_STATUS_PENDING);
    }
}
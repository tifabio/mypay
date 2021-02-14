<?php

namespace App\Services;

use App\Events\AuthorizeTransferEvent;
use App\Events\FinishTransferEvent;
use App\Models\Transfers;
use App\Models\TransfersStatus;
use App\Repositories\TransfersRepository;
use Exception;

class TransfersService
{

    /**
     * @var TransfersRepository
     */
    private $transfersRepository;

    /**
     * Create a new service instance
     * 
     * @param TransfersRepository $transfersRepository
     *
     * @return void
     */
    public function __construct(TransfersRepository $transfersRepository)
    {
        $this->transfersRepository = $transfersRepository;
    }

    public function create($data) 
    {
        $transfer = [
            'value' => $data['value'],
            'payer_id' => $data['payer'],
            'payee_id' => $data['payee'],
            'transfers_status_id' => TransfersStatus::STATUS_PENDING
        ];

        $transfer = $this->transfersRepository->save($transfer);

        if($transfer)
        {
            event(new AuthorizeTransferEvent($transfer));
            return $transfer;
        }

        throw new Exception('Error creating transfer');
    }

    public function approve(Transfers $transfer)
    {
        $transfer->transfers_status_id = TransfersStatus::STATUS_APPROVED;
        
        if($transfer->save())
        {
            return $transfer;
        }

        throw new Exception('Error approving transfer');
    }

    public function cancel(Transfers $transfer)
    {
        $transfer->transfers_status_id = TransfersStatus::STATUS_CANCELED;
        
        if($transfer->save())
        {
            return $transfer;
        }

        throw new Exception('Error canceling transfer');
    }

    public function transfer(Transfers $transfer)
    {
        if($transfer->transfers_status_id === TransfersStatus::STATUS_APPROVED)
        {
            // Payer send money
            $transfer->payer->balance -= $transfer->value;
            $payerPay = $transfer->payer->save();

            if($payerPay)
            {
                // Payee receives money
                $transfer->payee->balance += $transfer->value;
                $payeeReceive = $transfer->payee->save();

                if($payeeReceive)
                {
                    event(new FinishTransferEvent($transfer));
                    return $transfer;
                }

                // Payment failed, return money to payer
                $transfer->payer->balance += $transfer->value;
                $transfer->payer->save();
            }

            return;
        }

        throw new Exception('Wrong transfer status while finishing');
    }
}
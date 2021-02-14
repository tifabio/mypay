<?php

namespace App\Services;

use App\Events\AuthorizeTransferEvent;
use App\Events\FinishTransferEvent;
use App\Exceptions\TransferException;
use App\Models\Transfers;
use App\Models\TransfersStatus;
use App\Repositories\TransfersRepository;

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

        throw new TransferException(TransferException::CREATE_ERROR);
    }

    public function approve(Transfers $transfer)
    {
        $transfer->transfers_status_id = TransfersStatus::STATUS_APPROVED;
        
        if($transfer->save())
        {
            return $transfer;
        }

        throw new TransferException(TransferException::APPROVE_ERROR);
    }

    public function cancel(Transfers $transfer)
    {
        $transfer->transfers_status_id = TransfersStatus::STATUS_CANCELED;
        
        if($transfer->save())
        {
            return $transfer;
        }

        throw new TransferException(TransferException::CANCEL_ERROR);
    }

    public function finish(Transfers $transfer)
    {
        $transfer->transfers_status_id = TransfersStatus::STATUS_FINISHED;
        
        if($transfer->save())
        {
            return $transfer;
        }

        throw new TransferException(TransferException::FINISH_ERROR);
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

            throw new TransferException(TransferException::TRANSFER_ERROR);
        }

        throw new TransferException(TransferException::WRONG_STATUS_APPROVED);
    }
}
<?php

namespace App\Services;

use App\Events\AuthorizeTransferEvent;
use App\Events\CancelTransferEvent;
use App\Events\FinishTransferEvent;
use App\Exceptions\TransferException;
use App\Models\Transfer;
use App\Models\TransferStatus;
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
            'transfer_status_id' => TransferStatus::STATUS_PENDING
        ];

        $transfer = $this->transfersRepository->save($transfer);

        if($transfer)
        {
            event(new AuthorizeTransferEvent($transfer));
            return $transfer;
        }

        throw new TransferException(TransferException::CREATE_ERROR);
    }

    public function approve(Transfer $transfer)
    {
        $transfer->transfer_status_id = TransferStatus::STATUS_APPROVED;
        
        if($transfer->save())
        {
            return $transfer;
        }

        throw new TransferException(TransferException::APPROVE_ERROR);
    }

    public function cancel(Transfer $transfer)
    {
        $transfer->transfer_status_id = TransferStatus::STATUS_CANCELED;
        
        if($transfer->save())
        {
            return $transfer;
        }

        throw new TransferException(TransferException::CANCEL_ERROR);
    }

    public function finish(Transfer $transfer)
    {
        $transfer->transfer_status_id = TransferStatus::STATUS_FINISHED;
        
        if($transfer->save())
        {
            return $transfer;
        }

        throw new TransferException(TransferException::FINISH_ERROR);
    }

    public function transfer(Transfer $transfer)
    {
        if($transfer->transfer_status_id === TransferStatus::STATUS_APPROVED)
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

    public function revert(int $id)
    {
        $transfer = $this->transfersRepository->findOrFail($id);

        if($transfer->transfer_status_id === TransferStatus::STATUS_FINISHED)
        {
            // Payer refunds money
            $transfer->payer->balance += $transfer->value;
            $payerRefund = $transfer->payer->save();

            if($payerRefund)
            {
                // Payee returns money
                $transfer->payee->balance -= $transfer->value;
                $payeeReturn = $transfer->payee->save();

                if($payeeReturn)
                {
                    event(new CancelTransferEvent($transfer));
                    return $transfer;
                }

                // Revert failed, back to original
                $transfer->payer->balance -= $transfer->value;
                $transfer->payer->save();
            }

            throw new TransferException(TransferException::REVERT_ERROR);
        }

        throw new TransferException(TransferException::WRONG_STATUS_FINISHED);
    }
}
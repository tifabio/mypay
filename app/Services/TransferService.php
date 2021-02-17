<?php

namespace App\Services;

use App\Events\Transfer\AuthorizeEvent;
use App\Events\Transfer\CancelEvent;
use App\Events\Transfer\FinishEvent;
use App\Exceptions\TransferException;
use App\Models\Transfer;
use App\Models\TransferStatus;
use App\Repositories\TransferRepository;
use Illuminate\Support\Facades\DB;

class TransferService
{

    /**
     * @var TransferRepository
     */
    private $transferRepository;

    /**
     * Create a new service instance
     * 
     * @param TransferRepository $transferRepository
     *
     * @return void
     */
    public function __construct(TransferRepository $transferRepository)
    {
        $this->transferRepository = $transferRepository;
    }

    public function create($data) 
    {
        $transfer = [
            'value' => $data['value'],
            'payer_id' => $data['payer'],
            'payee_id' => $data['payee'],
            'transfer_status_id' => TransferStatus::STATUS_PENDING
        ];

        $transfer = $this->transferRepository->save($transfer);

        if($transfer)
        {
            event(new AuthorizeEvent($transfer));
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
            return DB::transaction(function () use ($transfer) {
                // Payer send money
                $transfer->payer->balance -= $transfer->value;
                $payerPay = $transfer->payer->save();

                // Payee receives money
                $transfer->payee->balance += $transfer->value;
                $payeeReceive = $transfer->payee->save();

                if($payerPay && $payeeReceive) {
                    event(new FinishEvent($transfer));
                    return $transfer;
                }

                throw new TransferException(TransferException::TRANSFER_ERROR);
            });
        }

        throw new TransferException(TransferException::WRONG_STATUS_APPROVED);
    }

    public function revert(int $id)
    {
        $transfer = $this->transferRepository->findOrFail($id);

        if($transfer->transfer_status_id === TransferStatus::STATUS_FINISHED)
        {
            return DB::transaction(function () use ($transfer) {
                // Payer refunds money
                $transfer->payer->balance += $transfer->value;
                $payerRefund = $transfer->payer->save();

                // Payee returns money
                $transfer->payee->balance -= $transfer->value;
                $payeeReturn = $transfer->payee->save();

                if($payerRefund && $payeeReturn)
                {
                    event(new CancelEvent($transfer));
                    return $transfer;
                }

                throw new TransferException(TransferException::REVERT_ERROR);
            });
        }

        throw new TransferException(TransferException::WRONG_STATUS_FINISHED);
    }
}
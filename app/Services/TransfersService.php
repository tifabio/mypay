<?php

namespace App\Services;

use App\Events\AuthorizeTransferEvent;
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
}
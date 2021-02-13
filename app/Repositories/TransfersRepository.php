<?php

namespace App\Repositories;

use App\Models\Transfers;

class TransfersRepository
{
    /**
     * @var Transfers
     */
    private $model;

    public function __construct(Transfers $transfers)
    {
        $this->model = $transfers;
    }

    public function save(array $data, int $id = 0)
    {
        if($id > 0) {
            $this->model
                ->where('id', $id)
                ->update($data);

            return $this->model->find($id);
        }

        if($transfer = $this->model->create($data)) {
            return $transfer;
        }

        return [];
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }
}
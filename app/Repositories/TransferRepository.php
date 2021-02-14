<?php

namespace App\Repositories;

use App\Models\Transfer;

class TransferRepository
{
    /**
     * @var Transfer
     */
    private $model;

    public function __construct(Transfer $transfers)
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

        $transfer = $this->model->create($data);

        return $transfer ? $transfer : [];
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function findOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }
}
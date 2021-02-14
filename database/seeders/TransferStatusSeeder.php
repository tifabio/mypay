<?php

namespace Database\Seeders;

use App\Models\TransferStatus;
use Illuminate\Database\Seeder;

class TransferStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var TransferStatus $model
         */
        $model = app(TransferStatus::class);

        $model->create([
            'id' => TransferStatus::STATUS_PENDING,
            'status' => 'pending'
        ]);

        $model->create([
            'id' => TransferStatus::STATUS_CANCELED ,
            'status' => 'canceled'
        ]);

        $model->create([
            'id' => TransferStatus::STATUS_APPROVED,
            'status' => 'approved'
        ]);

        $model->create([
            'id' => TransferStatus::STATUS_FINISHED,
            'status' => 'finished'
        ]);
    }
}

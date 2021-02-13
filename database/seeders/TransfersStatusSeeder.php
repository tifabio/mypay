<?php

namespace Database\Seeders;

use App\Models\TransfersStatus;
use Illuminate\Database\Seeder;

class TransfersStatusSeeder extends Seeder
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
        $model = app(TransfersStatus::class);

        $model->create([
            'id' => TransfersStatus::STATUS_PENDING,
            'status' => 'pending'
        ]);

        $model->create([
            'id' => TransfersStatus::STATUS_CANCELED ,
            'status' => 'canceled'
        ]);

        $model->create([
            'id' => TransfersStatus::STATUS_APPROVED,
            'status' => 'approved'
        ]);

        $model->create([
            'id' => TransfersStatus::STATUS_FINISHED,
            'status' => 'finished'
        ]);
    }
}

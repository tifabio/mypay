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
            'id' => 1,
            'status' => TransfersStatus::STATUS_PENDING 
        ]);

        $model->create([
            'id' => 2,
            'status' => TransfersStatus::STATUS_CANCELED 
        ]);

        $model->create([
            'id' => 3,
            'status' => TransfersStatus::STATUS_APPROVED 
        ]);

        $model->create([
            'id' => 4,
            'status' => TransfersStatus::STATUS_FINISHED 
        ]);
    }
}

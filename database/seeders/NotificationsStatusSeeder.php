<?php

namespace Database\Seeders;

use App\Models\NotificationsStatus;
use Illuminate\Database\Seeder;

class NotificationsStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var NotificationsStatus $model
         */
        $model = app(NotificationsStatus::class);

        $model->create([
            'id' => 1,
            'status' => NotificationsStatus::STATUS_PENDING
        ]);

        $model->create([
            'id' => 2,
            'status' => NotificationsStatus::STATUS_SENT 
        ]);
    }
}

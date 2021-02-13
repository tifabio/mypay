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
            'id' => NotificationsStatus::STATUS_PENDING,
            'status' => 'pending'
        ]);

        $model->create([
            'id' => NotificationsStatus::STATUS_SENT,
            'status' => 'sent'
        ]);
    }
}

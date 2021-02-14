<?php

namespace Database\Seeders;

use App\Models\NotificationStatus;
use Illuminate\Database\Seeder;

class NotificationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var NotificationStatus
         */
        $model = app(NotificationStatus::class);

        $model->create([
            'id' => NotificationStatus::STATUS_PENDING,
            'status' => 'pending'
        ]);

        $model->create([
            'id' => NotificationStatus::STATUS_SENT,
            'status' => 'sent'
        ]);
    }
}

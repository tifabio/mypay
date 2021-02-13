<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTypesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(TransfersStatusSeeder::class);
        $this->call(NotificationsStatusSeeder::class);
    }
}

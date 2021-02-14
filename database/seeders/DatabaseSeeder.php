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
        $this->call(UserTypesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TransferStatusSeeder::class);
        $this->call(NotificationsStatusSeeder::class);
    }
}

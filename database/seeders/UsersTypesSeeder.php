<?php

namespace Database\Seeders;

use App\Models\UsersTypes;
use Illuminate\Database\Seeder;

class UsersTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var UsersTypes $model
         */
        $model = app(UsersTypes::class);
        
        $model->create([
            'id' => 1,
            'type' => UsersTypes::TYPE_USER 
        ]);

        $model->create([
            'id' => 2,
            'type' => UsersTypes::TYPE_SHOPKEEPER 
        ]);
    }
}

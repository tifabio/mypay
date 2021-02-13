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
         * @var UsersTypes
         */
        $model = app(UsersTypes::class);
        
        $model->create([
            'id' => UsersTypes::TYPE_USER,
            'type' => 'user'
        ]);

        $model->create([
            'id' => UsersTypes::TYPE_SHOPKEEPER,
            'type' => 'shopkeeper' 
        ]);
    }
}

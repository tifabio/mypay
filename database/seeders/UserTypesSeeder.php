<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var UserType
         */
        $model = app(UserType::class);
        
        $model->create([
            'id' => UserType::TYPE_USER,
            'type' => 'user'
        ]);

        $model->create([
            'id' => UserType::TYPE_SHOPKEEPER,
            'type' => 'shopkeeper' 
        ]);
    }
}

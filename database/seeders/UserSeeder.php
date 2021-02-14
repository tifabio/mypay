<?php

namespace Database\Seeders;

use App\Repositories\UsersRepository;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var UsersRepository
         */
        $userRepository = app(UsersRepository::class);
        $fakeUsers = $userRepository->fakeUsers();

        foreach($fakeUsers as $fakeUser) {
            $userRepository->save($fakeUser);
        }
    }
}

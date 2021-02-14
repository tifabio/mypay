<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * @var User
     */
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function save(array $data, int $id = 0)
    {
        if($id > 0) {
            $this->model
                ->where('id', $id)
                ->update($data);

            return $this->model->find($id);
        }

        $user = $this->model->create($data);

        return $user ? $user : [];
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }
    
    public function fakeUsers()
    {
        return [
            [
                'name' => 'Fulano',
                'document' => '53847521063',
                'email' => 'fulano@teste.dev',
                'password' => Hash::make('fulano@123'),
                'balance' => 500.00,
                'user_types_id' => UserType::TYPE_USER
            ],
            [
                'name' => 'Beltrano',
                'document' => '85277195092',
                'email' => 'beltrano@teste.dev',
                'password' => Hash::make('beltrano@123'),
                'balance' => 50.00,
                'user_types_id' => UserType::TYPE_USER
            ],
            [
                'name' => 'Ciclano',
                'document' => '10750005000195',
                'email' => 'ciclano@teste.dev',
                'password' => Hash::make('ciclano@123'),
                'balance' => 0.00,
                'user_types_id' => UserType::TYPE_SHOPKEEPER
            ],
        ];
    }
}
<?php

namespace App\Rules;

use App\Models\UsersTypes;
use App\Repositories\UsersRepository;
use Illuminate\Contracts\Validation\Rule;

class UserCanTransfer implements Rule
{
    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->usersRepository = app(UsersRepository::class);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = $this->usersRepository->find($value);
        return $user->users_types_id !== UsersTypes::TYPE_SHOPKEEPER;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Shopkeeper can't make transfers";
    }
}
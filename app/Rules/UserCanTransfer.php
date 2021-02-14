<?php

namespace App\Rules;

use App\Models\UserType;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Validation\Rule;

class UserCanTransfer implements Rule
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
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
        $user = $this->userRepository->find($value);
        return $user->user_types_id !== UserType::TYPE_SHOPKEEPER;
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
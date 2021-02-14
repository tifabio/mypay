<?php

namespace App\Rules;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Validation\Rule;

class UserHasBalance implements Rule
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var float
     */
    private $requestedValue;

    /**
     * Create a new rule instance.
     * 
     * @param float $requestedValue
     *
     * @return void
     */
    public function __construct(float $requestedValue)
    {
        $this->userRepository = app(UserRepository::class);
        $this->requestedValue = $requestedValue;
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
        return $user ? $user->balance >= $this->requestedValue : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Insufficient funds";
    }
}
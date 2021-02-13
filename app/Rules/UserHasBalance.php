<?php

namespace App\Rules;

use App\Repositories\UsersRepository;
use Illuminate\Contracts\Validation\Rule;

class UserHasBalance implements Rule
{
    /**
     * @var UsersRepository
     */
    private $usersRepository;

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
        $this->usersRepository = app(UsersRepository::class);
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
        $user = $this->usersRepository->find($value);
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
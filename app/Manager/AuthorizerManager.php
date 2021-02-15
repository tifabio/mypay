<?php

namespace App\Manager;

use App\Repositories\MockyAuthorizer;
use Illuminate\Support\Manager;

class AuthorizerManager extends Manager
{
    public function getDefaultDriver()
    {
        return env('AUTHORIZER_DRIVER');
    }

    public function createMockyDriver()
    {
        return new MockyAuthorizer;
    }
}
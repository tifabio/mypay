<?php

namespace App\Repositories;

use App\Models\Transfers;
use App\Repositories\Interfaces\Authorizer;

class MockyAuthorizer implements Authorizer
{
    public function call(Transfers $transfer)
    {
        // exit('aqui');
    }
}
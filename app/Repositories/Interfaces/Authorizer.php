<?php

namespace App\Repositories\Interfaces;

use App\Models\Transfers;

interface Authorizer
{
    public function call(Transfers $transfer);
}
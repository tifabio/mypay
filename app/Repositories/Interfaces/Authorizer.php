<?php

namespace App\Repositories\Interfaces;

use App\Models\Transfers;

interface Authorizer
{
    public function isAuthorized(Transfers $transfer);
}
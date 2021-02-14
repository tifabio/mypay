<?php

namespace App\Repositories\Interfaces;

use App\Models\Transfer;

interface Authorizer
{
    public function isAuthorized(Transfer $transfer);
}
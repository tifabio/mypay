<?php

namespace App\Repositories;

use App\Models\Transfer;
use App\Repositories\Interfaces\Authorizer;
use Illuminate\Support\Facades\Http;

class MockyAuthorizer implements Authorizer
{
    public function isAuthorized(Transfer $transfer)
    {
        $response = Http::get(env('AUTHORIZER_URL'));
        $authorized = isset($response['message']) && $response['message'] === 'Autorizado';
        return $authorized;
    }
}
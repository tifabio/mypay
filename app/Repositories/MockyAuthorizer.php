<?php

namespace App\Repositories;

use App\Models\Transfers;
use App\Repositories\Interfaces\Authorizer;
use Illuminate\Support\Facades\Http;

class MockyAuthorizer implements Authorizer
{
    public function isAuthorized(Transfers $transfer)
    {
        $response = Http::get(env('MOCKY_AUTHORIZER_URL'));
        $authorized = isset($response['message']) && $response['message'] === 'Autorizado';
        return $authorized;
    }
}
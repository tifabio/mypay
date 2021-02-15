<?php

namespace App\Repositories;

use App\Models\Notification;
use App\Repositories\Interfaces\Notifier;
use Illuminate\Support\Facades\Http;

class MockyNotifier implements Notifier
{
    public function send(Notification $notification)
    {
        dd($notification);
        $response = Http::get(env('MOCKY_NOTIFIER_URL'));
        $sent = isset($response['message']) && $response['message'] === 'Enviado';
        return $sent;
    }
}
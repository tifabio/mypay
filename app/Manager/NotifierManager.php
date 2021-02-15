<?php

namespace App\Manager;

use App\Repositories\MockyNotifier;
use Illuminate\Support\Manager;

class NotifierManager extends Manager
{
    public function getDefaultDriver()
    {
        return env('NOTIFIER_DRIVER');
    }

    public function createMockyDriver()
    {
        return new MockyNotifier;
    }
}
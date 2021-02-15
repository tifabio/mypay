<?php

namespace App\Models\Interfaces;

interface Notifiable
{
    public function getNotificationContent();
    public function getNotificationUser();
}
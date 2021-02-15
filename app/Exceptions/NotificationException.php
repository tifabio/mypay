<?php

namespace App\Exceptions;

use Exception;

class NotificationException extends Exception
{
    const SENT_ERROR = 'Error sending notification';
    const WRONG_STATUS_PENDING = 'Wrong transfer status, expected pending';

    public function __construc($message, $code = 0) {
        parent::__construct($message, $code);
    }    
}
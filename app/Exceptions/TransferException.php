<?php

namespace App\Exceptions;

use Exception;

class TransferException extends Exception
{
    const CREATE_ERROR = 'Error creating transfer';
    const APPROVE_ERROR = 'Error approving transfer';
    const CANCEL_ERROR = 'Error creating transfer';
    const FINISH_ERROR = 'Error finishing transfer';
    const TRANSFER_ERROR = 'Error transfering value between users';
    const WRONG_STATUS_APPROVED = 'Wrong transfer status, expected approved';
    const WRONG_STATUS_PENDING = 'Wrong transfer status, expected pending';

    public function __construc($message, $code = 0) {
        parent::__construct($message, $code);
    }    
}
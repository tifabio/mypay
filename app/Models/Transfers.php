<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfers extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value',
        'payer_id',
        'payee_id',
        'transfers_status_id'
    ];
}

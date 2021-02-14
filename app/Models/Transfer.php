<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
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
        'transfer_status_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'payer',
        'payee',
        'status'
    ];

    public function payer() {
        return $this->hasOne(User::class, 'id', 'payer_id');
    }

    public function payee() {
        return $this->hasOne(User::class, 'id', 'payee_id');
    }

    public function status() {
        return $this->hasOne(TransferStatus::class, 'id', 'transfer_status_id');
    }
}

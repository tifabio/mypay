<?php

namespace App\Models;

use App\Models\Interfaces\Notifiable;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      description="Transfer Model",
 *      title="Transfer Model",
 *      type="object",
 *      @OA\Property(property="id", type="integer"),
 *      @OA\Property(property="value", type="number"),
 *      @OA\Property(property="payer_id", type="integer"),
 *      @OA\Property(property="payee_id", type="integer"),
 *      @OA\Property(property="transfer_status_id", type="integer"),
 *      @OA\Property(property="created_at", type="string"),
 *      @OA\Property(property="updated_at", type="string")
 * )
 */
class Transfer extends Model implements Notifiable
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

    public function getNotificationContent()
    {
        return "{$this->payer->name} sent you {$this->value}";
    }

    public function getNotificationUser()
    {
        return $this->payee->id;
    }
}

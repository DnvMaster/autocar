<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = ['rental_id','amount','payment_method','status','transaction_id','paid_at','notes'];
    protected function casts(): array
    {
        return ['amount' => 'decimal:2','paid_at' => 'datetime'];
    }
    public function rental(): BelongsTo
    {
        return $this->belongsTo(Rental::class);
    }
}

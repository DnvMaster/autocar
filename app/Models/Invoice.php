<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['rental_id','invoice_number','subtotal','tax','total','status','issued_at','due_at','paid_at'];
    protected function casts(): array
    {
        return ['subtotal' => 'decimal:2','tax' => 'decimal:2','total' => 'decimal:2','issued_at' => 'date','due_at' => 'date','paid_at' => 'date'];
    }
    public function rental(): BelongsTo
    {
        return $this->belongsTo(Rental::class);
    }
}

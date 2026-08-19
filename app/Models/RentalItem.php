<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalItem extends Model
{
    use HasFactory;
     protected $fillable = ['rental_id','description','quantity','unit_price','total'];
    protected function casts(): array
    {
        return ['quantity' => 'integer','unit_price' => 'decimal:2','total' => 'decimal:2'];
    }
    public function rental(): BelongsTo
    {
        return $this->belongsTo(Rental::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = ['rental_id','contract_number','file_path','signed_at','status'];
    protected function casts(): array
    {
        return ['signed_at' => 'datetime'];
    }
    public function rental(): BelongsTo
    {
        return $this->belongsTo(Rental::class);
    }
}

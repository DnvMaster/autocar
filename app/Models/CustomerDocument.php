<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerDocument extends Model
{
    use HasFactory;
    protected $fillable = [ 'customer_id','type','document_number','file_path','issued_at','expires_at','notes'];

    protected function casts(): array
    {
        return ['issued_at' => 'date','expires_at' => 'date'];
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['customer_id','vehicle_id','created_by','start_at','end_at','pickup_location','return_location','daily_rate','subtotal','discount','deposit','total','status','notes'];
    protected function casts(): array
    {
        return ['start_at' => 'datetime','end_at' => 'datetime','daily_rate' => 'decimal:2','subtotal' => 'decimal:2','discount' => 'decimal:2','deposit' => 'decimal:2','total' => 'decimal:2'];
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function items(): HasMany
    {
        return $this->hasMany(RentalItem::class);
    }
    public function extras(): HasMany
    {
        return $this->hasMany(RentalExtra::class);
    }
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    public function contract(): HasOne
    {
        return $this->hasOne(Contract::class);
    }
    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }
}

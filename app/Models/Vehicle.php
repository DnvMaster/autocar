<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['category_id','brand','model','year','license_plate','vin','color','transmission','fuel_type','seats','mileage','daily_rate','status','registration_date','description'];
    protected function casts(): array
    {
        return ['year' => 'integer','seats' => 'integer','mileage' => 'integer','daily_rate' => 'decimal:2','registration_date' => 'date'];
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(VehicleCategory::class,'category_id');
    }
    public function images(): HasMany
    {
        return $this->hasMany(VehicleImage::class);
    }
    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }
    public function maintenance(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }
    public function expenses(): HasMany
    {
        return $this->hasMany(VehicleExpense::class);
    }
    public function getFullNameAttribute(): string
    {
        return "{$this->brand} {$this->model}";
    }
}

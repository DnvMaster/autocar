<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','description','default_daily_rate','is_active'];
    protected function casts(): array
    {
        return ['default_daily_rate' => 'decimal:2','is_active' => 'boolean'];
    }
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'category_id');
    }
}

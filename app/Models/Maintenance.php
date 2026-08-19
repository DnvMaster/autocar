<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    use HasFactory;
    protected $table = 'maintenance';
    protected $fillable = ['vehicle_id','type_id','title','description','mileage','cost','performed_at','next_service_at','status'];
    protected function casts(): array
    {
        return ['mileage' => 'integer','cost' => 'decimal:2','performed_at' => 'date','next_service_at' => 'date'];
    }
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(MaintenanceType::class,'type_id');
    }
}

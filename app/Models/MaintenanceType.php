<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaintenanceType extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','description'];
    public function maintenance(): HasMany
    {
        return $this->hasMany(Maintenance::class, 'type_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['type','first_name','last_name','company_name','tax_number','email','phone','address','city','postal_code','country','notes','is_active'];
    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
    public function documents(): HasMany
    {
        return $this->hasMany(CustomerDocument::class);
    }
    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }
    public function getDisplayNameAttribute(): string
    {
        if($this->type === 'company') {
            return $this->company_name ?? 'Company';
        }
        return trim(
            "{$this->first_name} {$this->last_name}"
        );
    }
}

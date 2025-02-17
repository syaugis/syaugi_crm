<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price'
    ];

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp' . number_format($this->price, 2, ',', '.');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'customer_product');
    }
}

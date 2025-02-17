<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lead_id',
        'name',
        'email',
        'phone_number'
    ];

    public function getProductNamesAttribute(): string
    {
        return $this->products->pluck('name')->join(', ');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'customer_product');
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}

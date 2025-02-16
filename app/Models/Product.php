<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'status',
        'assigned_to'
    ];

    const STATUS_NEW          = 0;
    const STATUS_IN_PROGRESS  = 1;
    const STATUS_CLOSED       = 2;

    const STATUSES = [
        self::STATUS_NEW            => 'New',
        self::STATUS_IN_PROGRESS    => 'In Progress',
        self::STATUS_CLOSED         => 'Closed'
    ];

    public function getFormattedStatusAttribute(): string
    {
        return self::STATUSES[$this->status] ?? 'Unknown';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function project(): HasOne
    {
        return $this->hasOne(Project::class);
    }
}

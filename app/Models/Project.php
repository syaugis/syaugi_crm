<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lead_id',
        'product_id',
        'status',
        'approved_by'
    ];

    const STATUS_PENDING  = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;

    const STATUSES = [
        self::STATUS_PENDING  => 'Pending',
        self::STATUS_APPROVED => 'Approved',
        self::STATUS_REJECTED => 'Rejected'
    ];

    public function getFormattedStatusAttribute(): string
    {
        return self::STATUSES[$this->status] ?? 'Unknown';
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'package_id',
        'amount',
        'issue_date',
        'due_date',
        'payment_status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'issue_date' => 'date',
        'due_date' => 'date',
    ];

    /**
     * Get the company (client) that owns the invoice.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'client_id');
    }

    /**
     * Get the package that this invoice is for.
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Check if the invoice is paid.
     */
    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    /**
     * Check if the invoice is overdue.
     */
    public function isOverdue(): bool
    {
        return $this->payment_status === 'overdue' || 
               ($this->payment_status === 'pending' && $this->due_date < now()->toDateString());
    }

    /**
     * Check if the invoice is pending.
     */
    public function isPending(): bool
    {
        return $this->payment_status === 'pending' && $this->due_date >= now()->toDateString();
    }
}

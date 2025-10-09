<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Get the client (company) that owns the invoice.
     * This is an alias for the company relationship.
     */
    public function client(): BelongsTo
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

    /**
     * Check if the invoice is cancelled.
     */
    public function isCancelled(): bool
    {
        return $this->payment_status === 'cancelled';
    }

    /**
     * Check if the invoice is partially paid.
     */
    public function isPartiallyPaid(): bool
    {
        return $this->payment_status === 'partially_paid';
    }

    /**
     * Get all payments for this invoice.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(InvoicePayment::class);
    }

    /**
     * Get the total amount paid for this invoice.
     */
    public function getTotalPaidAttribute(): float
    {
        return $this->payments()->sum('amount');
    }

    /**
     * Get the remaining balance for this invoice.
     */
    public function getRemainingBalanceAttribute(): float
    {
        return $this->amount - $this->total_paid;
    }

    /**
     * Check if the invoice is fully paid.
     */
    public function isFullyPaid(): bool
    {
        return $this->total_paid >= $this->amount;
    }

    /**
     * Check if the invoice has partial payments.
     */
    public function hasPartialPayments(): bool
    {
        return $this->total_paid > 0 && !$this->isFullyPaid();
    }

    /**
     * Update payment status based on payments.
     */
    public function updatePaymentStatus(): void
    {
        if ($this->isCancelled()) {
            return; // Don't update cancelled invoices
        }

        if ($this->isFullyPaid()) {
            $this->update(['payment_status' => 'paid']);
        } elseif ($this->total_paid > 0) {
            // Check if it's overdue with partial payment
            if ($this->due_date < now()->toDateString()) {
                $this->update(['payment_status' => 'overdue']); // Overdue with partial payment
            } else {
                $this->update(['payment_status' => 'partially_paid']); // Partial payment, not overdue
            }
        } elseif ($this->due_date < now()->toDateString()) {
            $this->update(['payment_status' => 'overdue']);
        } else {
            $this->update(['payment_status' => 'pending']);
        }
    }
}

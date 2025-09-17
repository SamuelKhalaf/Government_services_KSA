<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'max_employees',
        'max_employee_documents',
        'max_company_documents',
        'price',
        'duration',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'max_employees' => 'integer',
        'max_employee_documents' => 'integer',
        'max_company_documents' => 'integer',
        'duration' => 'integer',
    ];

    /**
     * Get the client packages for this package.
     */
    public function clientPackages(): HasMany
    {
        return $this->hasMany(ClientPackage::class);
    }

    /**
     * Get the invoices for this package.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get the companies (clients) associated with this package.
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'client_packages')
                    ->withPivot(['start_date', 'end_date', 'status'])
                    ->withTimestamps();
    }
}

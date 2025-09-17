<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeClickTracking extends Model
{
    use HasFactory;

    protected $table = 'employee_click_tracking';

    protected $fillable = [
        'user_id',
        'element_type',
        'element_id',
        'element_class',
        'element_text',
        'page_url',
        'x_position',
        'y_position',
        'clicked_at',
    ];

    protected $casts = [
        'clicked_at' => 'datetime',
    ];

    /**
     * Get the user that performed the click
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to filter by element type
     */
    public function scopeElementType($query, $elementType)
    {
        return $query->where('element_type', $elementType);
    }

    /**
     * Scope to filter by page URL
     */
    public function scopePageUrl($query, $pageUrl)
    {
        return $query->where('page_url', $pageUrl);
    }

    /**
     * Scope to filter by date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('clicked_at', [$startDate, $endDate]);
    }

    /**
     * Scope to filter by time range
     */
    public function scopeTimeRange($query, $startTime, $endTime)
    {
        return $query->whereTime('clicked_at', '>=', $startTime)
                    ->whereTime('clicked_at', '<=', $endTime);
    }

    /**
     * Get element display name
     */
    public function getElementDisplayName(): string
    {
        if ($this->element_text) {
            return $this->element_text;
        }
        
        if ($this->element_id) {
            return "#{$this->element_id}";
        }
        
        if ($this->element_class) {
            return ".{$this->element_class}";
        }
        
        return ucfirst($this->element_type);
    }
}
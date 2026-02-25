<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'nationality',
        'image',
        'license_number',
        'license_expiry_date',
        'experience_years',
        'languages',
        'is_active',
    ];

    protected $casts = [
        'license_expiry_date' => 'date',
        'experience_years' => 'integer',
        'languages' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    /** Display languages as comma-separated labels */
    public function getLanguagesDisplayAttribute(): string
    {
        if (empty($this->languages) || !is_array($this->languages)) {
            return '–';
        }
        $labels = array_map(function ($code) {
            return ucfirst($code);
        }, $this->languages);
        return implode(', ', $labels);
    }
}

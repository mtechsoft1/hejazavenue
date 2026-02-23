<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Accommodation extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'type',
        'city',
        'distance_meters',
        'latitude',
        'longitude',
        'bedrooms',
        'min_guests',
        'max_guests',
        'dedicated_maid_included',
        'driver_included',
        'chauffeur_included',
        'price_per_night',
        'is_active',
        'chauffeur_service_id',
        'sort_order',
    ];

    protected $casts = [
        'distance_meters' => 'integer',
        'bedrooms' => 'integer',
        'min_guests' => 'integer',
        'max_guests' => 'integer',
        'dedicated_maid_included' => 'boolean',
        'driver_included' => 'boolean',
        'chauffeur_included' => 'boolean',
        'price_per_night' => 'decimal:2',
        'is_active' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title') && !$model->isDirty('slug')) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    public function images()
    {
        return $this->hasMany(AccommodationImage::class)->orderBy('sort_order')->orderBy('id');
    }

    public function chauffeurService()
    {
        return $this->belongsTo(ChauffeurService::class, 'chauffeur_service_id');
    }

    /** Guest capacity display e.g. "4-6" or "8-10" */
    public function getGuestCapacityDisplayAttribute(): string
    {
        return $this->min_guests . '-' . $this->max_guests;
    }

    /** Distance from Masjid an-Nabawi for display */
    public function getDistanceDisplayAttribute(): string
    {
        $m = (int) $this->distance_meters;
        if ($m >= 1000) {
            return round($m / 1000, 1) . 'km from Masjid an-Nabawi';
        }
        return $m . 'm from Masjid an-Nabawi';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }
}

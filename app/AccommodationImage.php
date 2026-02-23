<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AccommodationImage extends Model
{
    protected $fillable = [
        'accommodation_id',
        'path',
        'sort_order',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    /** Full URL for display (path is relative to storage/app/public) */
    public function getUrlAttribute(): string
    {
        if (str_starts_with($this->path, 'http')) {
            return $this->path;
        }
        return asset('storage/' . $this->path);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $path = $model->path;
            if ($path && !str_starts_with($path, 'http')) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        });
    }
}

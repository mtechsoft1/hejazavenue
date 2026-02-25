<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChauffeurService extends Model
{
    protected $fillable = [
        'name',
        'description',
        'extra_price',
        'is_default',
        'is_active',
        'sort_order',
        'capacity',
        'vehicle_number',
        'model',
        'color',
    ];

    protected $casts = [
        'extra_price' => 'decimal:2',
        'is_default'  => 'boolean',
        'is_active'   => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->is_default) {
                static::where('id', '!=', $model->id)->update(['is_default' => false]);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class, 'chauffeur_service_id');
    }
}

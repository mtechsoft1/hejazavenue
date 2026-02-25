<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maid extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'image',
        'email',
        'nationality',
        'experience_years',
        'is_active',
    ];

    protected $casts = [
        'experience_years' => 'integer',
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
}

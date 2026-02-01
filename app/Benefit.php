<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }
}

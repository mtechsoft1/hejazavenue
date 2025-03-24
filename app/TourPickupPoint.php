<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourPickupPoint extends Model
{
    //
    protected $table      = 'tour_pickup_points';
    protected $primaryKey = 'id';

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }
}

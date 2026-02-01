<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    //
    protected $table      = 'tours';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class, 'agency_id', 'id');
    }
    
    public function pickuppoint()
    {
        return $this->hasMany(TourPickupPoint::class);
    }
    public function benefit()
    {
        return $this->hasMany(Benefit::class);
    }
   
}

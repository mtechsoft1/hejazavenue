<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourBooking extends Model
{
    
    protected $table="tour_bookings";

    protected $fillable = [
        'tour_id', 
        'user_id', 
        'name', 
        'email', 
        'phone', 
        'user_message', 
        'pickup_point_id', 
        'package_type', 
        'adults_in_number', 
        'kids_under_3_years', 
        'kids_between_3_to_8', 
        'payment_method', 
        'payment_amount', 
        'deposit_receipt', 
        'payment_type', 
        'is_paid', 
        'status', 
        'created_at', 
        'updated_at'
    ];
    
    public function tour_details()
    {
        return $this->belongsTo('App\Tour','tour_id','id');
    }
    
    public function pickup_point()
    {
        return $this->belongsTo('App\TourPickupPoint','pickup_point_id','id');
    }
}

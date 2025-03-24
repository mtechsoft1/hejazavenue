<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallary extends Model
{
    protected $table      = 'gallaries';
    protected $fillable = ['tour_id', 'image','video'];
    
    
}

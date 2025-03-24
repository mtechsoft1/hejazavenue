<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReviews extends Model
{
    
    protected $table = 'user_reviews';
    
    protected $fillable = [
        'user_id',
        'agency_id',
        'rating_stars',
        'review',
        'created_at',
        'updated_at',
    ];
}

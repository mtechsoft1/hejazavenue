<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model

{
    //
    protected $fillable = ['destination_name','destination_desc','destination_image','is_public'];
}

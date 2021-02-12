<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    protected $fillable = [
        "postal_code", "route", "latitude", "longitude"
    ];
}

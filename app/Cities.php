<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
     protected $table = "cities";
    protected $fillable = [
        'city_name','prov_id'
    ];
}

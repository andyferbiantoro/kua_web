<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
     protected $table = "provinces";
    protected $fillable = [
        'prov_name'
    ];
}

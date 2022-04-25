<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     public function isAdmin(){

        if($this->role == 'admin'){

            return true;
        }
            return false;
    }


     public function isPenyuluh(){

        if($this->role == 'penyuluh'){

            return true;
        }
            return false;
    }

     public function isCalonPengantin(){

        if($this->role == 'calon_pengantin'){

            return true;
        }
            return false;
    }

     public function isKepalaKua(){

        if($this->role == 'kepala_kua'){

            return true;
        }
            return false;
    }
}

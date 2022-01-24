<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hobbie extends Model 
{

    protected $table = 'hobbies';
    public $timestamps = true;

    public function customers()
    {
        return $this->belongsToMany('App\Models\Customer');
    }

}
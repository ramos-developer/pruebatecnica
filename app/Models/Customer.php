<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model 
{

    protected $table = 'customers';
    public $timestamps = true;

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function hobbies()
    {
        return $this->belongsToMany('App\Models\Hobbie');
    }

}
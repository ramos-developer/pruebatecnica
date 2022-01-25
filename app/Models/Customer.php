<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'customers';
    public $timestamps = true;
    protected $fillable = ['id'];

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function hobbies()
    {
        return $this->belongsToMany('App\Models\Hobbie', 'customers_hobbies');
    }

}

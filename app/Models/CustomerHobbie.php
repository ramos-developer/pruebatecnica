<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerHobbie extends Model
{

    protected $table = 'customers_hobbies';
    public $timestamps = true;
    protected $fillable = ['customer_id', 'hobbie_id'];

}

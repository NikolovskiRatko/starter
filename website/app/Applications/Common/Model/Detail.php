<?php

namespace App\Applications\Common\Model;

use Illuminate\Database\Eloquent\Model;

// TODO remove this since it is a duplicate for the model used for users App/User/Model/Details.php
class Detail extends Model
{
    protected $table = 'details';
    public $timestamps = true;

    protected $fillable = array(
        'name',
        'address',
        'alt_address',
        'city',
        'phone',
        'country_id'
    );

}

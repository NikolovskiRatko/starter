<?php

namespace App\Applications\User\Model;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    protected $table = 'details';
    public $timestamps = true;

    protected $fillable = array(
        'name',
        'address',
        'alt_address',
        'city',
        'phone',
        'country_id',
        'company',
        'company_vat',
        'user_id',
        'type',
        'default',
    );
}

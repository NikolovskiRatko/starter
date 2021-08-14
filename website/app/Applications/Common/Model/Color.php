<?php

namespace App\Applications\Common\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use SoftDeletes { restore as private restoreSoftDelete; }

    protected $table = 'colors';
    public $timestamps = true;

    protected $fillable = array(
        'name',
        'display_name',
        'hex_value',
        'type',
    );

}

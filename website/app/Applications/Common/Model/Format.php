<?php

namespace App\Applications\Common\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Format extends Model
{
    use SoftDeletes { restore as private restoreSoftDelete; }

    protected $table = 'formats';
    public $timestamps = true;

    protected $fillable = array(
        'name',
        'parts',
        'gluing_coefficient',
        'format_coefficient',
        'order'
    );

}
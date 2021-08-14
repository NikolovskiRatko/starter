<?php

namespace App\Applications\Common\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parameter extends Model
{
    use SoftDeletes { restore as private restoreSoftDelete; }

    protected $table = 'parameters';
    public $timestamps = true;

    protected $fillable = array(
        'name',
        'display_name',
        'value',
        'order'
    );

}

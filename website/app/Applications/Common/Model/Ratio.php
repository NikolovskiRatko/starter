<?php

namespace App\Applications\Common\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ratio extends Model
{
    use SoftDeletes { restore as private restoreSoftDelete; }

    protected $table = 'ratios';
    public $timestamps = true;

    protected $fillable = array(
        'name',
        'width',
        'length',
        'print_coefficient',
        'punch_coefficient',
        'varnish_preparation_price',
        'varnish_price',
        'hot_foil_first_price',
        'hot_foil_additional_price',
        'hot_foil_over_1000_price',
        'hot_foil_under_1000_price',
        'hot_foil_per_meter_price',
        'embossing_first_price',
        'embossing_additional_price',
        'embossing_over_1000_price',
        'embossing_under_1000_price',
        'order'
    );

}
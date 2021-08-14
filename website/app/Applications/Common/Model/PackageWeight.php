<?php

namespace App\Applications\Common\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Countries\Countries;

class PackageWeight extends Model
{
    use SoftDeletes { restore as private restoreSoftDelete; }

    protected $table = 'package_weights';
    public $timestamps = true;

    protected $fillable = array(
        'country_id',
        'weight',
        'order'
    );

    protected $with = array(
        'country'
    );

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }
}

<?php

namespace App\Applications\Common\Model;

use Illuminate\Database\Eloquent\Model;

class Cliche extends Model
{
    protected $table = 'cliches';
    public $timestamps = true;

    protected $fillable = array(
        'product_id',
        'type',
        'height',
        'width'
    );

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

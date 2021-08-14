<?php

namespace App\Applications\Order\Model;

use App\Applications\Product\Model\Offer;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $timestamps = true;

    protected $fillable = array(
        'shipping_detail_id',
        'billing_detail_id',
        'status',
        'offer_id'
    );

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}

<?php

namespace App\Applications\Product\Model;

use App\Applications\User\Model\Details;
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

    /*
        * The relations to eager load on every query.
        *
        * @var array
        */
    protected $with = [
        'offer',
        'shipping_details',
        'billing_details'
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function shipping_details()
    {
        return $this->belongsTo(Details::class, 'shipping_detail_id');
    }

    public function billing_details()
    {
        return $this->belongsTo(Details::class, 'billing_detail_id');
    }
}

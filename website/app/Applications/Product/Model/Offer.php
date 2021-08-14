<?php

namespace App\Applications\Product\Model;

use App\Applications\User\Model\User;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';
    public $timestamps = true;

    protected $fillable = array(
        'product_id',
        'user_id',
        'price',
        'name',
        'days_to_delivery',
    );


    /*
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'product'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
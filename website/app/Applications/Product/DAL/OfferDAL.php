<?php

namespace App\Applications\Product\DAL;

use App\Applications\Product\Model\Offer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * @property Offer|Model $offer
 */
class OfferDAL implements OfferDALInterface
{

    public function __construct(
        Offer $offer
    ){
        $this->offer = $offer;
    }

    public function save($request){
        return $this->offer->create($request);
    }

    public function update($data, $id){
        return $this->offer->find($id)->update($data);
    }

    public function getOffersForUser($user_id){
//        $this->offer->product()
        $query_results = DB::select(DB::raw("SELECT id FROM products 
            WHERE id not in (SELECT id FROM products where id in (SELECT product_id FROM mousebags.offers where id in (select offer_id from orders)))
            AND original_product_id not in (SELECT id FROM products where id in (SELECT product_id FROM mousebags.offers where id in (select offer_id from orders)));"));
        $product_ids = [];
        foreach ($query_results as $row)
            $product_ids[] = $row->id;
        return $this->offer
                    ->where('user_id', $user_id)
                    ->whereIn('product_id', $product_ids)
                    ->doesntHave('order')
                    ->orderBy('product_id', 'desc')
                    ->get();
    }
}

<?php

namespace App\Applications\Product\Controllers;

use App\Applications\Product\Requests\ConfiguratorRequest;
use App\Applications\Product\Requests\OfferRequest;
use App\Applications\Product\Requests\ProductRequest;
use Exception;
use App\Http\Controllers\Controller;
use App\Applications\Product\BLL\ProductBLLInterface;
use Illuminate\Http\Request;

/**
 * @property ProductBLLInterface $productBLL
 */
class ProductController extends Controller
{
    public function __construct(
        ProductBLLInterface $productBLL
    ){
        $this->productBLL = $productBLL;
    }

    /**
     * Get a JSON with the created Product
     *
     * @param  Request  $request
     * @return string|Exception
     */
    public function save($request){
        try{
            return $this->productBLL->save($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Get a JSON with the calculated offers
     *
     * @param  Request  $request
     * @return array|Exception
     */
    public function getOffers(ConfiguratorRequest $request){
        try{
            return $this->productBLL->getOffers($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Get a JSON with the calculated offers
     *
     * @param  Request  $request
     * @return array|Exception
     */
    public function recalculateOffers(Request $request){
//        try{
            $res = $this->productBLL->recalculateOffers($request);
            return $res;
//        }
//        catch(Exception $e){
//            return $e;
//        }
    }

    /**
     * Get a JSON with the calculated offers
     *
     * @param  Request  $request
     * @return array|Exception
     */
    public function recalculateOffersForTesting(Request $request){
        try{
            $product = $this->productBLL->mapProductParameters($request);
            $res = $this->productBLL->recalculateOffersForTesting($product);
            return $res;
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Add an offer to My Bags
     *
     * @param  OfferRequest  $request
     * @return array|Exception
     */
    public function saveOffer(OfferRequest $request){
        try{
            return $this->productBLL->saveOffer($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    public function drawProduct(Request $request){
        return $this->productBLL->getDataTablesReady($request);
    }

    public function getOrdersForUser(){
        return $this->productBLL->getOrdersForUser();
    }

    public function getOffersForUser(){
        return $this->productBLL->getOffersForUser();
    }

    /**
     * Delete product
     *
     * @return string
     */
    public function deleteProduct($id){
        return $this->productBLL->deleteProduct($id);
    }

    /**
     * Get product by id
     *
     * @param  integer  $id
     * @return string
     */
    public function getProduct($id){
        return $this->productBLL->getProduct($id)->toJson();
    }

    /**
     * Get offer by product_id
     *
     * @param  integer  $product_id
     * @return string
     */
    public function getOffer($product_id){
        return $this->productBLL->getOffer($product_id)->toJson();
    }

    /**
     * Store product and get JSON with a user response
     *
     * @param  ProductRequest  $request
     * @return void
     */
    public function storeProduct(ProductRequest $request){
        $this->productBLL->storeProduct($request->request->all());
    }

    /**
     * Update user
     *
     * @param  ProductRequest  $request
     * @param  integer  $id
     * @return void
     */
    public function updateProduct(ProductRequest $request, $id){
        $this->productBLL->adminEditProduct($request->product, false);
    }

    /**
     * Get a JSON with the calculated offers
     *
     * @param  Request  $request
     * @return array|Exception
     */
//    public function calculatePackaging(Request $request){
//        try{
//            return $this->productBLL->calculatePackaging($request);
//        }
//        catch(Exception $e){
//            return $e;
//        }
//    }
}

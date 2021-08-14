<?php

namespace App\Applications\Product\BLL;

use App\Applications\Product\Model\Offer;
use App\Applications\Product\Model\Product;
use App\Applications\Product\Requests\ProductRequest;
use Illuminate\Http\Request;

/**
 * Interface ProductBLLInterface
 * @package App\Applications\Product
 */

interface ProductBLLInterface
{
    /**
     * @param Request $request
     * @return string
     */
    public function save($request);

    /**
     * @param Request $request
     * @return array
     */
    public function getOffers($request);

    /**
     * @param Request $request
     * @return array
     */
    public function recalculateOffers($request);

    /**
     * @param array $product
     * @return array
     */
    public function recalculateOffersForTesting($product);

    /**
     * @param Request $request
     * @return array
     */
    public function mapProductParameters($request);

    /**
     * @param $product
     * @param $pnew
     * @return mixed
     */
    public function adminEditProduct($product, $new);
    /**
     * @param Request $request
     * @return array
     */
    public function saveOffer($request);

    /**
     * @param $offer
     * @return array
     */
    public function saveOfferAdmin($offer);

    /**
     * @param $offer
     * @return array
     */
    public function createOfferAdmin($offer);

    /**
     * @param $offer
     * @return array
     */
    public function createOfferUnregisteredUser($offer);

    /**
     * @param Request $request
     * @return array
     */
    public function getProductData($request);

    /**
     * @param Request $request
     * @return array
     */
    public function getOfferData($request);

    /**
     * @param Request $request
     * @return array
     */
    public function getDataTablesReady($request);

    /**
     * @param Request $request
     * @return array
     */
    public function getOrdersForUser();

    /**
     * @return array
     */
    public function getOffersForUser();

    /**
     * Delete product
     *
     * @param  integer  $id
     * @return string
     */
    public function deleteProduct($id);

    /**
     * Get product by id
     *
     * @param  integer  $id
     * @return Product
     */
    public function getProduct($id);

    /**
     * Get offer by product_id
     *
     * @param  integer  $product_id
     * @return Offer
     */
    public function getOffer($product_id);

    /**
     * Store product and get JSON with a user response
     *
     * @param  $request
     * @return string
     */
    public function storeProduct($request);

    /**
     * Update Product
     *
     * @param  ProductRequest  $request
     * @param  integer  $id
     * @return void
     */
    public function updateProduct($request, $id);

    /**
     * Save Hot Foil Cliches for Product
     *
     * @param  integer  $product_id
     * @param  Request  $request
     * @return void
     */
    public function saveHotFoilCliches($product_id, $request);

    /**
     * Save Embossing Cliches for Product
     *
     * @param  integer  $product_id
     * @param  Request  $request
     * @return void
     */
    public function saveEmbossingCliches($product_id, $request);

    /**
     * @param $request
     * @return mixed
     */
    public function calculatePackaging($request);
}

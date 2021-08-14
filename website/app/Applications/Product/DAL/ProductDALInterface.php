<?php

namespace App\Applications\Product\DAL;

use App\Applications\Common\Model\Handle;
use App\Applications\Common\Model\Lamination;
use App\Applications\Product\Model\Offer;
use App\Applications\Common\Model\Paper;
use App\Applications\Product\Model\Product;
use App\Applications\Product\Requests\ProductRequest;
use Illuminate\Http\Request;

/**
 * Interface ProductDALInterface
 * @package App\Applications\Product
 */

interface ProductDALInterface
{
    /**
     * @param Request $request
     * @return Product
     */
    public function save($request);

    /**
     * @param int $product_id
     * @param array $ids
     * @param string $type
     * @return void
     */
    public function syncColors($product_id, $ids, $type);

    /**
     * @param int $product_id
     * @param int $color_id
     * @param string $type
     * @return Product
     */
    public function fetchProductColor($product_id, $color_id, $type);

    /**
     * @param int $product_id
     * @param int $color_id
     * @param string $type
     * @return Product
     */
    public function insertProductColor($product_id, $color_id, $type);

    /**
     * @param array $data_array
     * @return void
     */
    public function saveCliche($data_array);

    /**
     * @param integer $product_id
     * @param string $type
     * @return void
     */
    public function deleteClichesByType($product_id, $type);

    /**
     * @param array $data
     * @return array
     */
    public function getDataTablesReady($data);

    /**
     * @param array $data
     * @return array
     */
    public function getProductsForUser($request, $status);

    /**
     * Delete product
     *
     * @param  integer  $id
     * @return string
     */
    public function deleteProduct($id);

    /**
     * Get Product by id
     *
     * @param  integer  $id
     * @return Product
     */
    public function getProduct($id);

    /**
     * Get Paper by name
     *
     * @param  string  $name
     * @return Paper
     */
    public function getPaperByName($name);

    /**
     * Get Handle by name
     *
     * @param  string  $name
     * @return Handle
     */
    public function getHandleByName($name);

    /**
     * Get Lamination by name
     *
     * @param  string  $name
     * @return Lamination
     */
    public function getLaminationByName($name);

    /**
     * Get Offer by product_id
     *
     * @param  integer  $product_id
     * @return Offer
     */
    public function getOffer($product_id);

    /**
     * Store product and get JSON with a user response
     *
     * @param  ProductRequest  $request
     * @return Product
     */
    public function storeProduct($request);

    /**
     * Update Product from admin
     *
     * @param  Product  $request
     * @param  integer  $id
     * @return Product
     */
    public function updateProduct($product, $id);

    /**
     * Update Product from configurator
     *
     * @param  Product  $product
     * @param  array  $data_array
     * @return boolean
     */
    public function editProduct($product, $data_array);

    /**
     * @param $user_id
     * @return mixed
     */
    public function getOrdersForUser($user_id);

    /**
     * @param $user_id
     * @return mixed
     */
    public function getOffersForUser($user_id);
}

<?php

namespace App\Applications\Order\DAL;

use App\Applications\Order\Model\Order;
use App\Applications\Order\Requests\OrderRequest;
use Illuminate\Http\Request;

/**
 * Interface OrderDALInterface
 * @package App\Applications\Order
 */

interface OrderDALInterface
{
    /**
     * @param Request $request
     * @return Order
     */
    public function save($request);

    /**
     * @param array $data
     * @return array
     */
    public function getDataTablesReady($data);

    /**
     * Delete order
     *
     * @return string
     */
    public function deleteOrder($id);

    /**
     * Delete order
     *
     * @return string
     */
    public function getOrder($id);

    /**
     * Store order and get JSON with a user response
     *
     * @param  OrderRequest  $request
     * @return string
     */
    public function storeOrder($request);

    /**
     * Update user
     *
     * @param  OrderRequest  $request
     * @param  integer  $id
     * @return \App\Applications\Product\Model\Order
     */
    public function createOrder($request);

    /**
     * Update user
     *
     * @param  OrderRequest  $request
     * @param  integer  $id
     * @return \App\Applications\Product\Model\Order
     */
    public function updateOrder($request, $id);


    /**
     * @param $id
     * @return mixed
     */
    public function getOrders($id);

    /**
     * @param $data
     * @return mixed
     */
    public function exportOrders($data);
}

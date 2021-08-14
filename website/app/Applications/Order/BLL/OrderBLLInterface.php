<?php

namespace App\Applications\Order\BLL;

use App\Applications\Product\Model\Order;
use App\Applications\Product\Requests\ProductRequest;
use Illuminate\Http\Request;

/**
 * Interface ProductBLLInterface
 * @package App\Applications\Product
 */

interface OrderBLLInterface
{

    /**
     * @param $request
     * @return mixed
     */
    public function getDataTablesReady($request);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteOrder($id);

    /**
     * @param $id
     * @return mixed
     */
    public function getOrder($id);

    /**
     * @param $request
     * @return mixed
     */
    public function storeOrder($request);

    /**
     * @param $request
     * @return Order
     */
    public function createOrder($request);

    /**
     * @param $request
     * @param $id
     * @return Order
     */
    public function updateOrder($request, $id);

    /**
     * @param $request
     * @param $id
     * @return Order
     */
    public function exportOrders($request);
}

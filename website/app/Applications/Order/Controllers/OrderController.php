<?php

namespace App\Applications\Order\Controllers;

use App\Applications\Order\Requests\CheckoutRequest;
use App\Applications\Order\Requests\OrderRequest;
use Exception;
use App\Http\Controllers\Controller;
use App\Applications\Order\BLL\OrderBLLInterface;
use Illuminate\Http\Request;

/**
 * @property OrderBLLInterface $orderBLL
 */
class OrderController extends Controller
{
    public function __construct(
        OrderBLLInterface $orderBLL
    ){
        $this->orderBLL = $orderBLL;
    }

    public function drawOrder(Request $request){
        return $this->orderBLL->getDataTablesReady($request);
    }

    /**
     * Delete order
     *
     * @return string
     */
    public function deleteOrder($id){
        $this->orderBLL->deleteOrder($id);
        return "Called delete";
    }

    /**
     * Store order and get JSON with a user response
     *
     * @param  OrderRequest  $request
     * @return string
     */
    public function getOrder($id){
        $order = $this->orderBLL->getOrder($id);
        return $order->toJson();
    }

    /**
     * Store Order on Checkout
     *
     * @param  OrderRequest  $request
     * @return string
     */
    public function storeOrder(CheckoutRequest $request){
        return $this->orderBLL->storeOrder($request);
    }

    /**
     * Create order from Admin panel
     *
     * @param  OrderRequest  $request
     * @param  integer  $id
     * @return void
     */
    public function createOrder(OrderRequest $request){
        $this->orderBLL->createOrder($request);
    }

    /**
     * Update data for Order from admin panel
     *
     * @param  OrderRequest  $request
     * @param  integer  $id
     * @return void
     */
    public function updateOrder(OrderRequest $request, $id){
        $this->orderBLL->updateOrder($request, $id);
    }

    /**
     * Update user
     *
     * @param  Request  $request
     * @param  integer  $id
     * @return void
     */
    public function exportOrders(Request $request){
        $this->orderBLL->exportOrders($request);
    }
}

<?php

namespace App\Applications\Order\BLL;


use App\Applications\Order\DAL\OrderDALInterface;
use App\Applications\Product\BLL\ProductBLLInterface;
use App\Applications\Product\DAL\OfferDALInterface;
use App\Applications\Product\DAL\ProductDALInterface;
use App\Applications\Product\Model\Offer;

/**
 * @property OrderDALInterface orderDAL
 * @property ProductDALInterface productDAL
 * @property OfferDALInterface offerDAL
 * @property ProductBLLInterface productBLL
 */
class OrderBLL implements OrderBLLInterface
{

    public function __construct(
        OrderDALInterface $orderDAL,
        ProductDALInterface $productDAL,
        OfferDALInterface $offerDAL,
        ProductBLLInterface $productBLL
    ){
        $this->orderDAL = $orderDAL;
        $this->productDAL = $productDAL;
        $this->offerDAL = $offerDAL;
        $this->productBLL = $productBLL;
    }

    public function getDataTablesReady($request){
        $data['columns'] = Array('id','status','user_name','address','product_name','quantity','price','shipping_price','days_to_delivery');
        $data['length'] = $request->input('length');
        $data['column'] = $request->input('column'); //Index
        $data['dir'] = $request->input('dir');

        $data['search'] = $request->input('search');
        $data['draw'] = $request->input('draw');
        $data['lang'] = $request->input('lang');

        return $this->orderDAL->getDataTablesReady($data);
    }

    public function deleteOrder($id){
        return $this->orderDAL->deleteOrder($id);
    }

    public function getOrder($id){
        return $this->orderDAL->getOrder($id);
    }

    public function storeOrder($request){
        $order = $this->orderDAL->storeOrder($request);
        $this->cloneProductAndOffer($order);
        return $order;
    }

    private function cloneProductAndOffer($order){
        $offer = $order->offer;
        $newOffer = $offer->replicate();
        $newOffer->push();
        $product = $offer->product;
        $newProduct = $product->replicate();
        $newProduct->original_product_id = $product->id;
        $newProduct->push();
        foreach($product->cliches as $item){
            unset($item->id);
            $newProduct->cliches()->create($item->toArray());
        }
        $in_list = $product->inside_colors->pluck('id')->toArray();
        $out_list = $product->outside_colors->pluck('id')->toArray();
        $handle_color_list = [$product->handle_color_id];
        $this->productDAL->syncColors($newProduct->id, $out_list, 'outside');
        $this->productDAL->syncColors($newProduct->id, $in_list, 'inside');
        $this->productDAL->syncColors($newProduct->id, $handle_color_list, 'handle');
        $newOffer->product_id = $newProduct->id;
        $newOffer->save();
    }

    public function createOrder($request){
        $order = $request->request->all();
        $offer = $order['offer'];
        unset($order['offer']);
        $product = $offer['product'];
        unset($offer['product']);

        $data = $this->productBLL->adminEditProduct($product, true);
        $offer['product_id'] = $data['product']->id;
        $offer = $this->productBLL->createOfferAdmin($offer);
        $order['offer_id'] = $offer->id;
        return $this->orderDAL->createOrder($order);
    }

    public function updateOrder($request, $id){
        $order = $request->request->all();
        $offer = $order['offer'];
        unset($order['offer']);
        $product = $offer['product'];
        unset($offer['product']);

        $this->productBLL->adminEditProduct($product, false);
        $this->productBLL->saveOfferAdmin($offer);
        return $this->orderDAL->updateOrder($order, $id);
    }

    public function exportOrders($request){
        $data['columns'] = Array('id', 'offer_id', 'billing_detail.city', 'billing_detail.phone', 'shipping_detail.city', 'shipping_detail.phone');
        $data['column'] = $request->input('column'); //Index
        $data['dir'] = $request->input('dir');
        // TODO: Improve this segment
        // this logic is required so that sorting can be done alphabetically
        if ($data['column'] == 6) {
            if ($data['dir'] == 'asc') {
                $data['dir'] = 'desc';
            } else {
                $data['dir'] = 'asc';
            }
        }
        $data['search'] = $request->input('search');
        $data['source'] = $request->input('source');

        return $this->orderDAL->exportOrders($data);
    }
}

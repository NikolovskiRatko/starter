<?php

namespace App\Applications\Order\DAL;

use App\Applications\Product\Model\Offer;
use App\Applications\Product\Model\Order;
use App\Applications\Product\Model\Product;
use App\Applications\User\DAL\UserDAL;
use App\Applications\User\Model\Details;
use App\Applications\User\Model\User;
use App\Util\DataExport\DataExportService;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property Order|Model $order
 * @property Details|Model details
 * @property Product product
 * @property Offer offer
 * @property DataExportService dataExport
 * @property User user
 * @property UserDAL userDAL
 */
class OrderDAL implements OrderDALInterface
{

    public function __construct(
        Order $order,
        User $user,
        UserDAL $userDAL,
        Details $details,
        DataExportService $dataExport
    ){
        $this->order = $order;
        $this->user = $user;
        $this->userDAL = $userDAL;
        $this->details = $details;
        $this->dataExport = $dataExport;
    }

    public function save($request){
        return $this->order->create($request);
    }

    public function getDataTablesReady($data){
        // TODO: Refactor this segment
        $query = DB::table('orders')
            ->select(
                DB::raw('orders.id'),
                DB::raw('orders.status'),
                DB::raw('shipping_detail.name as user_name'),
                DB::raw('shipping_detail.address as address'),
                DB::raw('offers.price as price'),
                DB::raw('offers.days_to_delivery as days_to_delivery'),
                DB::raw('products.name as product_name'),
                DB::raw('products.quantity as quantity'),
                DB::raw('products.shipping_price as shipping_price')
            )
            ->join('details as shipping_detail','orders.shipping_detail_id','=','shipping_detail.id')
            ->join('details as billing_detail','orders.billing_detail_id','=','billing_detail.id')
            ->join('offers','orders.offer_id','=','offers.id')
            ->join('products','offers.product_id','=','products.id');


        $search = $data['search'];
        if($search){
            $query->where(function($subquery) use ($search) {
                $subquery->where('orders.id', 'like', '%'.$search.'%');
                $subquery->orWhere('orders.status', 'like', '%'.$search.'%');
                $subquery->orWhere('shipping_detail.name', 'like', '%'.$search.'%');
                $subquery->orWhere('shipping_detail.address', 'like', '%'.$search.'%');
                $subquery->orWhere('offers.price', 'like', '%'.$search.'%');
                $subquery->orWhere('offers.days_to_delivery', 'like', '%'.$search.'%');
                $subquery->orWhere('products.name', 'like', '%'.$search.'%');
                $subquery->orWhere('products.quantity', 'like', '%'.$search.'%');
                $subquery->orWhere('products.shipping_price', 'like', '%'.$search.'%');
            });
        }

        $query->groupBy('orders.id');
        $query->orderBy($data['columns'][$data['column']], $data['dir']);

        $items = $query->paginate($data['length']);
        return ['data' => $items, 'draw' => $data['draw']];
    }

    public function deleteOrder($id){
        return $this->order
            ->where('id', $id)
            ->delete();
    }

    public function getOrder($id){
        return $this->order->find($id);
    }

    public function storeOrder($request){
        //TODO: Move this logic to BLL
        $shipping_details = $request->shipping_address;
        unset($shipping_details['type']);
        unset($shipping_details['default']);
        $shipping_details['user_id'] = Auth::user()->id;
        if($this->user->find($shipping_details['user_id'])->shipping_details == null)
            $this->userDAL->editShippingInfo($shipping_details);
        $shipping_details = $this->details->create($shipping_details);

        $billing_details = $request->billing_address;
        unset($billing_details['type']);
        unset($billing_details['default']);
        $billing_details['user_id'] = Auth::user()->id;
        if($this->user->find($billing_details['user_id'])->billing_details == null)
            $this->userDAL->editBillingInfo($billing_details);
        $billing_details = $this->details->create($billing_details);

        $order_details['offer_id'] = $request->offer_id;
        $order_details['shipping_detail_id'] = $shipping_details->id;
        $order_details['billing_detail_id'] = $billing_details->id;
        $order_details['status'] = 0;
        return $this->order->create($order_details);
    }

    public function createOrder($order){
        $order['shipping_details']['user_id'] = Auth::user()->id;
        $shipping_details = $this->details->create($order['shipping_details']);
        $order['billing_details']['user_id'] = Auth::user()->id;
        $billing_details = $this->details->create($order['billing_details']);
        $order['shipping_detail_id'] = $shipping_details->id;
        $order['billing_detail_id'] = $billing_details->id;
        return $this->order->create($order);
    }

    public function updateOrder($order, $id){
        $this->details->find($order['shipping_details']['id'])->update($order['shipping_details']);
        $this->details->find($order['billing_details']['id'])->update($order['billing_details']);
        return $this->order->find($id)->update($order);
    }

    public function getOrders($id){
        return $this->order->whereHas('offer', function (Builder $query) use ($id){
            $query->where('user_id', $id);
        })->with(['offer', 'offer.product'])->orderBy('id', 'desc')->get();
    }

    public function exportOrders($data){
        $query = DB::table('orders')
            ->select(
                DB::raw('orders.id'),
                DB::raw('orders.status'),
                DB::raw('shipping_detail.name as user_name'),
                DB::raw('shipping_detail.address as address'),
                DB::raw('offers.price as price'),
                DB::raw('offers.days_to_delivery as days_to_delivery'),
                DB::raw('products.name as product_name'),
                DB::raw('products.quantity as quantity'),
                DB::raw('products.shipping_price as shipping_price')
            )
            ->join('details as shipping_detail','orders.shipping_detail_id','=','shipping_detail.id')
            ->join('details as billing_detail','orders.billing_detail_id','=','billing_detail.id')
            ->join('offers','orders.offer_id','=','offers.id')
            ->join('products','offers.product_id','=','products.id');

        $search = $data['search'];
        if($search){
            $query->where(function($subquery) use ($search) {
                $subquery->where('orders.id', 'like', '%'.$search.'%');
                $subquery->orWhere('orders.offer_id', 'like', '%'.$search.'%');
            });
        }

        $query->groupBy('orders.id');
        $query->orderBy($data['columns'][$data['column']], $data['dir']);

        $data = $query->get();
        return $this->dataExport->array_to_csv_download($data,'orders.csv',';');
    }
}

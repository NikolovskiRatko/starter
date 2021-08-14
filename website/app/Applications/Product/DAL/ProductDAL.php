<?php

namespace App\Applications\Product\DAL;

use App\Applications\Common\Model\Cliche;
use App\Applications\Common\Model\Handle;
use App\Applications\Common\Model\Lamination;
use App\Applications\Product\Model\Offer;
use App\Applications\Common\Model\Paper;
use App\Applications\Product\Model\Product;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property Product|Model $product
 * @property Offer|Model $offer
 * @property Paper|Model $paper
 * @property Handle|Model $handle
 * @property Lamination|Model $lamination
 * @property Cliche|Model $cliche
 */
class ProductDAL implements ProductDALInterface
{

    public function __construct(
        Product $product,
        Offer $offer,
        Paper $paper,
        Handle $handle,
        Lamination $lamination,
        Cliche $cliche
    ){
        $this->product = $product;
        $this->offer = $offer;
        $this->paper = $paper;
        $this->handle = $handle;
        $this->lamination = $lamination;
        $this->cliche = $cliche;
    }

    public function save($request){
        return $this->product->create($request);
    }

    public function syncColors($product_id, $ids, $type){
        DB::table('product_color')
            ->where('product_color.product_id', $product_id)
            ->where('product_color.type', $type)
            ->whereNotIn('product_color.color_id', $ids)
            ->delete();
        foreach ($ids as $color_id) {
            $exist = $this->fetchProductColor($product_id, $color_id, $type);
            if (!$exist) {
                $this->insertProductColor($product_id, $color_id, $type);
            }
        }
    }

    public function fetchProductColor($product_id, $color_id, $type){
        return DB::table('product_color')
            ->where('product_color.product_id', $product_id)
            ->where('product_color.color_id', $color_id)
            ->where('product_color.type', $type)
            ->first();
    }

    public function insertProductColor($product_id, $color_id, $type){
        return DB::table('product_color')->insert([
            'product_id' => $product_id,
            'color_id' => $color_id,
            'type' => $type,
        ]);
    }

    public function saveCliche($data_array){
        return $this->cliche->create($data_array);
    }

    public function  deleteClichesByType($product_id, $type){
        return $this->cliche
            ->where('product_id', $product_id)
            ->where('type', $type)
            ->delete();
    }

    public function getDataTablesReady($data){
        $query = DB::table('products')
            ->select(
                DB::raw('products.id'),
                DB::raw('products.name'),
                DB::raw('products.height'),
                DB::raw('products.width'),
                DB::raw('products.length'),
                DB::raw('handles.display_name as handle'),
                DB::raw('laminations.name as lamination'),
                DB::raw('papers.display_name as paper_type')
            )
            ->leftJoin('offers', 'offers.product_id', '=', 'products.id')
            ->leftJoin('handles', 'handles.id', '=', 'products.handle_id')
            ->leftJoin('laminations', 'laminations.id', '=', 'products.lamination_id')
            ->leftJoin('papers', 'papers.id', '=', 'products.paper_id');


        $search = $data['search'];
        if($search){
            $query->where(function($subquery) use ($search) {
                $subquery->where('products.id', 'like', '%'.$search.'%');
                $subquery->orWhere('products.name', 'like', '%'.$search.'%');
                $subquery->orWhere('products.height', 'like', '%'.$search.'%');
            });
        }
        $query->whereNotIn('offers.id', DB::table('orders')->select('offer_id'));

        $query->groupBy('products.id');
        $query->orderBy($data['columns'][$data['column']], $data['dir']);
//        $query->whereNull('products.deleted_at');

        $items = $query->paginate($data['length']);
        return ['data' => $items, 'draw' => $data['draw']];
    }

    public function getProductsForUser($request, $status){
        $query = DB::table('products')
            ->select(
                DB::raw('products.id as id'),
                DB::raw('products.name as name'),
                DB::raw('products.created_at as date_placed'),
                DB::raw('products.height'),
                DB::raw('products.width'),
                DB::raw('products.length'),
                DB::raw('handles.display_name as handle'),
                DB::raw('laminations.name as lamination'),
                DB::raw('products.quantity as quantity'),
                DB::raw('orders.status as status'),
                DB::raw('papers.display_name as paper_type'),
                DB::raw('offers.delivery_date as delivery_date'),
                DB::raw('count(outside_color.id) as number_outside_colors'),
                DB::raw('count(inside_color.id) as number_inside_colors')
            )
            ->leftJoin('handles', 'handles.id', '=', 'products.handle_id')
            ->leftJoin('laminations', 'laminations.id', '=', 'products.lamination_id')
            ->leftJoin('papers', 'papers.id', '=', 'products.paper_id')
            ->leftJoin('product_color as outside_color', function ($join) {$join->on('outside_color.product_id', '=', 'products.id')->where('outside_color.type', 'outside');})
            ->leftJoin('product_color as inside_color', function ($join) {$join->on('inside_color.product_id', '=', 'products.id')->where('inside_color.type', 'inside');})
            ->leftJoin('offers', 'offers.product_id', '=', 'products.id')
            ->leftJoin('orders', 'orders.offer_id', '=', 'offers.id')
            ->where('products.user_id', Auth::user()->id)
            ->where('orders.status','like', $status);

        $query->groupBy('products.id', 'outside_color.type', 'inside_color.type');
        $query->orderBy('id');
        $items = $query->paginate(10);
        return $items;
    }

    public function deleteProduct($id){
        $product = $this->getProduct($id);
        $product->colors()->detach();
        $product->cliches()->delete();
        $product->offer()->delete();

        return $this->product
            ->where('id', $id)
            ->delete();
    }

    public function getProduct($id){
        return $this->product->with('offer.order')->where('id', $id)->firstOr(function(){
            return collect(['message' => 'No matching product found.']);
        });
    }

    public function getPaperByName($name){
        return $this->paper->where('display_name', $name)
                           ->first();
    }

    public function getHandleByName($name){
        return $this->handle->where('display_name', $name)
                           ->first();
    }

    public function getLaminationByName($name){
        return $this->lamination->where('display_name', $name)
                           ->first();
    }

    public function getOffer($product_id){
        return $this->offer
                    ->where('product_id', $product_id)
                    ->first();
    }

    public function storeProduct($product_data){
//        $product_data = $request->request->all();
        $product_data['user_id'] = Auth::user()->id;
//        $product_data['handle_id'] = (int) $product_data['handle_id'];
//        $product_data['lamination_id'] = (int) $product_data['lamination_id'];
//        $product_data['paper_id'] = (int) $product_data['paper_id'];
        return $this->product->create($product_data);
    }

    public function editProduct($product, $data_array){
        return $product->update($data_array);
    }

    public function updateProduct($product, $id){
        $this->product->find($id)->fill($product)->save();
        return $this->product->find($id);
    }

    public function getOrdersForUser($user_id){
        return $this->product->whereHas('offer.order')->get();
    }

    public function getOffersForUser($user_id){
        return $this->product->whereHas('offer')->get();
    }
}

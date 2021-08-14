<?php

namespace App\Applications\Product\BLL;

use App\Applications\Order\DAL\OrderDALInterface;
use App\Applications\Product\DAL\OfferDALInterface;
use App\Applications\Product\DAL\ProductDALInterface;
use App\Applications\Common\Model\Handle;
use App\Applications\Common\Model\Lamination;
use App\Applications\Common\Model\Paper;
use App\Applications\Product\Model\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use stdClass;

/**
 * @property ProductDALInterface $productDAL
 * @property OfferDALInterface $offerDAL
 * @property PriceConfiguratorInterface $priceConfigurator
 * @property OrderDALInterface orderDAL
 * @property Product|Model product
 */
class ProductBLL implements ProductBLLInterface
{

    public function __construct(
        ProductDALInterface $productDAL,
        OfferDALInterface $offerDAL,
        OrderDALInterface $orderDAL,
        PriceConfiguratorInterface $priceConfigurator,
        Product $product
    ){
        $this->productDAL = $productDAL;
        $this->offerDAL = $offerDAL;
        $this->orderDAL = $orderDAL;
        $this->priceConfigurator = $priceConfigurator;
        $this->product = $product;
    }

    public function save($request){
        return $this->productDAL->save($request);
    }

    public function getOffers($request){
        $product_data = $this->getProductData($request);
        $product = $this->productDAL->save($product_data);
        $this->productDAL->syncColors($product->id, $request->input('product.inside_colors'), 'inside');
        $this->productDAL->syncColors($product->id, $request->input('product.outside_colors'), 'outside');
        $this->productDAL->syncColors($product->id, [$request->input('product.handle_color_id')], 'handle');
        $this->saveHotFoilCliches($product->id, $request);
        $this->saveEmbossingCliches($product->id, $request);
        $array = $this->priceConfigurator->getOffers($product);
        $array['original_product_id'] = $product->id;
        $this->productDAL->editProduct($product, $array);
        $product = $this->productDAL->getProduct($product->id);
        $array['product'] = $product;
        $array['packaging'] = $this->calculatePackaging($product);

        $product = $this->productDAL->editProduct($product, ['shipping_price' => $array['packaging']['shipping_price']]);

        return $array;
    }

    public function recalculateOffers($request){
        $product = $request->offer['product'];
        // Build product object
        $product = $this->toObject($product);
        $product->paper = Paper::find($product->paper_id);
        $product->handle = Handle::find($product->handle_id);
        $product->lamination = Lamination::find($product->lamination_id);
        $product->outside_colors = json_decode(json_encode($product->outside_colors), true);
        $product->inside_colors = json_decode(json_encode($product->inside_colors), true);

        $array = $this->priceConfigurator->getOffers($product);
        $array['packaging'] = $this->calculatePackaging($product);
        return $array;
    }

    public function recalculateOffersForTesting($product){
        // Build product object
        $product = $this->toObject($product);
        $product->paper = Paper::find($product->paper_id);
        $product->handle = Handle::find($product->handle_id);
        $product->lamination = Lamination::find($product->lamination_id);
        $product->outside_colors = json_decode(json_encode($product->outside_colors), true);
        $product->inside_colors = json_decode(json_encode($product->inside_colors), true);

        $array = $this->priceConfigurator->getOffers($product);
        $array['packaging'] = $this->calculatePackaging($product);
        return $array;
    }

    public function mapProductParameters($request){
        // Parse the Size string
        $string = $request->input('size');
        $length = $this->get_string_between($string, '+', '/');
        $arr = explode("+", $string);
        $width = $arr[0];
        $arr = explode("/", $string);
        $height = $arr[1];
        $array['width'] = $width;
        $array['length'] = $length;
        $array['height'] = $height;

        // Parse the color string
        $string = $request->input('colors');
        $arr = explode("/", $string);
        $outside_colors = $arr[0];
        $array['outside_spot_colors'] = '';
        $arr1 = explode("+", $outside_colors);
        $array['outside_colors'] = array_fill(0, (int)$arr1[0], '');
        if (count($arr1) > 1) {
            $array['outside_spot_colors'] = $arr1[1];
        }

        $array['inside_spot_colors'] = '';
        if (count($arr) > 1) {
            $inside_colors = $arr[1];
            $arr1 = explode("+", $inside_colors);
            $array['inside_colors'] = array_fill(0, (int)$arr1[0], '');
            if (count($arr1) > 1) {
                $array['inside_spot_colors'] = $arr1[1];
            }
        } else {
            $array['inside_colors'] = [];
        }

        // Parse Paper Type
        $paper = $request->input('paper');
        $paper = $this->productDAL->getPaperByName($paper);
        $array['paper_id'] = $paper->id;
        // Parse Handle Type
        $handle = $request->input('handle');
        $handle = $this->productDAL->getHandleByName($handle);
        $array['handle_id'] = $handle->id;
        // Parse Lamination Type
        $lamination = $request->input('lamination');
        $lamination = $this->productDAL->getLaminationByName($lamination);
        $array['lamination_id'] = $lamination->id;

        $array['quantity'] = (int)$request->input('quantity');
        $array['bottom'] = $this->string_to_boolean($request->input('bottom'));
        $array['printed_bottom'] = $this->string_to_boolean($request->input('printed_bottom'));
        $array['front_back'] = $this->string_to_boolean($request->input('front_back'));
        $array['spot_uv'] = $this->string_to_boolean($request->input('spot_uv'));
        $array['hot_foil'] = $this->string_to_boolean($request->input('hot_foil'));
        $array['embossing'] = $this->string_to_boolean($request->input('embossing'));

        // Parse Cliches
        for($i = 1; $i <= 3; $i++) {
            if ($request->input('hot_foil_cliche_'.$i) != null) {
                $arr = explode("/", $request->input('hot_foil_cliche_'.$i));
                $array['hot_foil_cliches'][$i-1]['type'] = 'hot_foil';
                $array['hot_foil_cliches'][$i-1]['width'] = $arr[0];
                $array['hot_foil_cliches'][$i-1]['height'] = $arr[1];
            } else {
                $array['hot_foil_cliches'][$i-1]['type'] = 'hot_foil';
                $array['hot_foil_cliches'][$i-1]['width'] = 0;
                $array['hot_foil_cliches'][$i-1]['height'] = 0;
            }
            if ($request->input('embossing_cliche_'.$i) != null) {
                $arr = explode("/", $request->input('embossing_cliche_'.$i));
                $array['embossing_cliches'][$i-1]['type'] = 'embossing';
                $array['embossing_cliches'][$i-1]['width'] = $arr[0];
                $array['embossing_cliches'][$i-1]['height'] = $arr[1];
            } else {
                $array['embossing_cliches'][$i-1]['type'] = 'embossing';
                $array['embossing_cliches'][$i-1]['width'] = 0;
                $array['embossing_cliches'][$i-1]['height'] = 0;
            }

        }

        $array['max_package_weight'] = $request->input('max_package_weight');

        return $array;
    }

    private function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    private function string_to_boolean($string){
        if ($string === 'Yes') return true;
        return false;
    }

    public function adminEditProduct($product, $new){
        $inside_colors = $product['inside_colors'];
        $outside_colors = $product['outside_colors'];
        $handle_color = [$product['handle_color_id']];
        $hot_foil_cliches = $product['hot_foil_cliches'];
        $embossing_cliches = $product['embossing_cliches'];
        if($new)
            $product = $this->storeProduct($product);
        else
            $product = $this->updateProduct($product, $product['id']);
        $this->productDAL->syncColors($product->id, $inside_colors, 'inside');
        $this->productDAL->syncColors($product->id, $outside_colors, 'outside');
        $this->productDAL->syncColors($product->id, $handle_color, 'handle');
        $this->saveHotFoilClichesAdmin($product->id, $hot_foil_cliches);
        $this->saveEmbossingClichesAdmin($product->id, $embossing_cliches);

        //TODO min_price add to product
        $array = $this->priceConfigurator->getOffers($product);
        $this->productDAL->editProduct($product, $array);
        $product = $this->productDAL->getProduct($product->id);
        $array['product'] = $product;
        $array['packaging'] = $this->calculatePackaging($product);
        return $array;
    }

    private function ToObject($Array) {

        // Create new stdClass object
        $object = new stdClass();

        // Use loop to convert array into
        // stdClass object
        foreach ($Array as $key => $value) {
            if (is_array($value)) {
                if($key !== 'hot_foil_cliches' && $key !== 'embossing_cliches')
                    $value = $this->ToObject($value);
                else
                    $value = (array)$this->ToObject($value);
            }
            $object->$key = $value;
        }
        return $object;
    }

    public function getOrdersForUser(){
        $user_id = Auth::user()->id;
        return $this->orderDAL->getOrders($user_id);
    }

    public function getOffersForUser(){
        $user_id = Auth::user()->id;
        return $this->offerDAL->getOffersForUser($user_id);
    }

    public function saveOffer($request){
        $offer_data = $this->getOfferData($request);
        $offer = $this->offerDAL->save($offer_data);
        return $offer;
    }

    public function saveOfferAdmin($offer){
        $offer = $this->offerDAL->update($offer, $offer['id']);
        return $offer;
    }

    public function createOfferAdmin($offer){
        $offer['user_id'] = Auth::user()->id;
        $offer = $this->offerDAL->save($offer);
        return $offer;
    }


    public function createOfferUnregisteredUser($offer){
        $offer = $this->offerDAL->save($offer);
        return $offer;
    }

    public function getOfferData($request){
        $offer_data['name'] = $request->input('name');
        $offer_data['days_to_delivery'] = $request->input('days_to_delivery');
        $offer_data['price'] = $request->input('price');
        $offer_data['product_id'] = $request->input('product_id');
        $offer_data['user_id'] = Auth::user()->id;
        return $offer_data;
    }

    public function getProductData($request){
        $product_data['height'] = $request->input('product.height');
        $product_data['width'] = $request->input('product.width');
        $product_data['length'] = $request->input('product.length');
        $product_data['handle_id'] = $request->input('product.handle_id');
        $product_data['lamination_id'] = $request->input('product.lamination_id');
        $product_data['paper_id'] = $request->input('product.paper_id');
        $product_data['outside_spot_colors'] = $request->input('product.outside_spot_colors');
        $product_data['inside_spot_colors'] = $request->input('product.inside_spot_colors');
        $product_data['bottom'] = $this->handleBoolean($request->input('product.bottom'));
        $product_data['printed_bottom'] = $this->handleBoolean($request->input('product.printed_bottom'));
        $product_data['front_back'] = $this->handleBoolean($request->input('product.front_back'));
        $product_data['spot_uv'] = $this->handleBoolean($request->input('product.spot_uv'));
        $product_data['hot_foil'] = $this->handleBoolean($request->input('product.hot_foil'));
        $product_data['embossing'] = $this->handleBoolean($request->input('product.embossing'));
        $product_data['quantity'] = $request->input('product.quantity');
        $product_data['max_package_weight'] = $request->input('product.max_package_weight');
        $product_data['comment'] = $request->input('product.comment');
        return $product_data;
    }

    public function saveHotFoilCliches($product_id, $request){
        $this->saveCliches($product_id, $request, 'hot_foil', 'hf_cliche');
    }

    public function saveEmbossingCliches($product_id, $request){
        $this->saveCliches($product_id, $request, 'embossing', 'em_cliche');
    }

    private function saveCliches($product_id, $request, $type, $label){
        $cliche['height'] = 0;
        $cliche['width'] = 0;
        $cliche['product_id'] = $product_id;
        $cliche['type'] = $type;
        $this->productDAL->deleteClichesByType($product_id, $type);
        $cliche_1 = $cliche;
        $cliche_2 = $cliche;
        $cliche_3 = $cliche;
        if ($this->handleBoolean($request->input('product.'.$type))) {
            if ($request['product'][$label][1]['selected']) {
                $cliche_1['height'] = $request['product'][$label][1]['height'];
                $cliche_1['width'] = $request['product'][$label][1]['width'];
            }
            if ($request['product'][$label][2]['selected']) {
                $cliche_2['height'] = $request['product'][$label][2]['height'];
                $cliche_2['width'] = $request['product'][$label][2]['width'];
            }
            if ($request['product'][$label][3]['selected']) {
                $cliche_3['height'] = $request['product'][$label][3]['height'];
                $cliche_3['width'] = $request['product'][$label][3]['width'];
            }
        }
        $this->productDAL->saveCliche($cliche_1);
        $this->productDAL->saveCliche($cliche_2);
        $this->productDAL->saveCliche($cliche_3);
    }

    public function saveHotFoilClichesAdmin($product_id, $cliche){
        $this->productDAL->deleteClichesByType($product_id, 'hot_foil');
        $cliche_0['height'] = $cliche[0]['height'];
        $cliche_0['width'] = $cliche[0]['width'];
        $cliche_0['product_id'] = $product_id;
        $cliche_0['type'] ='hot_foil';
        $cliche_1['height'] = $cliche[1]['height'];
        $cliche_1['width'] = $cliche[1]['width'];
        $cliche_1['product_id'] = $product_id;
        $cliche_1['type'] ='hot_foil';
        $cliche_2['height'] = $cliche[2]['height'];
        $cliche_2['width'] = $cliche[2]['width'];
        $cliche_2['product_id'] = $product_id;
        $cliche_2['type'] ='hot_foil';
        $this->productDAL->saveCliche($cliche_0);
        $this->productDAL->saveCliche($cliche_1);
        $this->productDAL->saveCliche($cliche_2);
    }

    public function saveEmbossingClichesAdmin($product_id, $cliche){
        $this->productDAL->deleteClichesByType($product_id, 'embossing');
        $cliche_0['height'] = $cliche[0]['height'];
        $cliche_0['width'] = $cliche[0]['width'];
        $cliche_0['product_id'] = $product_id;
        $cliche_0['type'] ='embossing';
        $cliche_1['height'] = $cliche[1]['height'];
        $cliche_1['width'] = $cliche[1]['width'];
        $cliche_1['product_id'] = $product_id;
        $cliche_1['type'] ='embossing';
        $cliche_2['height'] = $cliche[2]['height'];
        $cliche_2['width'] = $cliche[2]['width'];
        $cliche_2['product_id'] = $product_id;
        $cliche_2['type'] ='embossing';
        $this->productDAL->saveCliche($cliche_0);
        $this->productDAL->saveCliche($cliche_1);
        $this->productDAL->saveCliche($cliche_2);
    }

    private function handleBoolean($value){
        if ($value == "true") return 1;
        if ($value == "1") return 1;
        return 0;
    }

    public function getDataTablesReady($request){
        $data['columns'] = Array('id', 'name', 'height');
        $data['length'] = $request->input('length');
        $data['column'] = $request->input('column'); //Index
        $data['dir'] = $request->input('dir');
        // TODO: Improve this segment
        // this logic is required so that sorting can be done alphabetically
//        if ($data['column'] == 6) {
//            if ($data['dir'] == 'asc') {
//                $data['dir'] = 'desc';
//            } else {
//                $data['dir'] = 'asc';
//            }
//        }
        $data['search'] = $request->input('search');
        $data['draw'] = $request->input('draw');
        $data['lang'] = $request->input('lang');

        return $this->productDAL->getDataTablesReady($data);
    }

    public function deleteProduct($id){
        return $this->productDAL->deleteProduct($id);
    }

    public function getProduct($id){
        return $this->productDAL->getProduct($id);
    }

    public function getOffer($product_id){
        return $this->productDAL->getOffer($product_id);
    }

    public function storeProduct($data){
        return $this->productDAL->storeProduct($data);
    }

    public function updateProduct($request, $id){
        return $this->productDAL->updateProduct($request, $id);
    }

    public function calculatePackaging($product){
        return $this->priceConfigurator->calculatePackaging($product);
    }
}

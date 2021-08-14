<?php

namespace App\Applications\Common\Controllers;

use Exception;
use App\Http\Controllers\Controller;
use App\Applications\Common\BLL\TaxonomiesBLLInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @property TaxonomiesBLLInterface $taxonomiesBLL
 */
class TaxonomiesController extends Controller
{
    public function __construct(
        TaxonomiesBLLInterface $taxonomiesBLL
    ){
        $this->taxonomiesBLL = $taxonomiesBLL;
    }

    /**
     * Get a JSON with handle types
     *
     * @return array|Exception
     */
    public function getHandleTypes(){
        try{
            $test = $this->taxonomiesBLL->getHandleTypes();
            return $test;
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Get a JSON with lanimation types
     *
     * @return array|Exception
     */
    public function getLaminationTypes(){
        try{
            return $this->taxonomiesBLL->getLaminationTypes();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Get a JSON with paper types
     *
     * @return array|Exception
     */
    public function getPaperTypes(){
        try{
            return $this->taxonomiesBLL->getPaperTypes();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Get a JSON with color types
     *
     * @return array|Exception
     */
    public function getColorTypes(){
        try{
            return $this->taxonomiesBLL->getColorTypes();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Get a JSON with color types
     *
     * @return array|Exception
     */
    public function getHandleColorTypes(){
        try{
            return $this->taxonomiesBLL->getHandleColorTypes();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Get a JSON with ratios
     *
     * @return array|Exception
     */
    public function getRatios(){
        try{
            return $this->taxonomiesBLL->getRatios();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Get a JSON with combinations
     *
     * @return array|Exception
     */
    public function getCombinations(){
        try{
            return $this->taxonomiesBLL->getCombinations();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Get a JSON with combinations
     *
     * @return array|Exception
     */
    public function getCombinationsAdmin(){
        try{
            return $this->taxonomiesBLL->getCombinations();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Get a JSON with formats
     *
     * @return array|Exception
     */
    public function getFormats(){
        try{
            return $this->taxonomiesBLL->getFormats();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Get a JSON with parameters
     *
     * @return array|Exception
     */
    public function getParameters(){
        try{
            return $this->taxonomiesBLL->getParameters();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Get a JSON with combinations
     *
     * @return array|Exception
     */
    public function getCountries(){
        try{
            return $this->taxonomiesBLL->getCountries();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Get a JSON with combinations
     *
     * @return array|Exception
     */
    public function drawShipping(Request $request){
        $data['columns'] = Array('id', 'title', 'subtitle');
        $data['length'] = $request->input('length');
        $data['column'] = $request->input('column'); //Index
        $data['dir'] = $request->input('dir');
        $data['search'] = $request->input('search');
        $data['draw'] = $request->input('draw');
        $data['lang'] = $request->input('lang');

        $query = DB::table('shipping')
            ->select(
                DB::raw('base_price'),
                DB::raw('price_kg'),
                DB::raw('min_price'),
                DB::raw('max_palete_weight')
            );

        $items = $query->paginate($data['length']);
        return ['data' => $items, 'draw' => $data['draw']];
    }

    public function getShippingParametars(Request $request){
        $shipping = DB::table('shipping')
            ->select(
                DB::raw('base_price'),
                DB::raw('price_kg'),
                DB::raw('min_price'),
                DB::raw('max_palete_weight')
            )->first();
        return json_encode($shipping);
    }

    public function editShippingParametars(Request $request){
        $data = $request->request->all();
        DB::table('shipping')
            ->where('id', 1)
            ->update($data);
        return $data;
    }
}

<?php

namespace App\Applications\Common\Controllers;

use App\Applications\Common\BLL\TaxonomiesBLLInterface;
use App\Applications\Common\Requests\EditCombinationRequest;
use App\Applications\Common\Requests\NewCombinationRequest;
use Exception;
use App\Http\Controllers\Controller;
use App\Applications\Common\BLL\CombinationBLLInterface;
use Illuminate\Http\Request;

/**
 * @property TaxonomiesBLLInterface $taxonomiesBLL
 * @property CombinationBLLInterface $combinationBLL
 */
class CombinationController extends Controller
{
    public function __construct(
        TaxonomiesBLLInterface $taxonomiesBLL,
        CombinationBLLInterface $combinationBLL
    ){
        $this->taxonomiesBLL = $taxonomiesBLL;
        $this->combinationBLL = $combinationBLL;
    }

    /**
     * Get a JSON with combinations for Admin Panel
     *
     * @return array|Exception
     */
    public function getCombinationsAdmin(){
        try{
            return $this->combinationBLL->getAllCombinations();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Order combinations
     *
     * @param  Request  $request
     * @return array|Exception
     */
    public function orderCombinations(Request $request){
        try{
            return $this->combinationBLL->orderCombinations($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Create a new combination
     *
     * @param NewCombinationRequest $request
     * @return integer|Exception
     */
    public function newCombination(NewCombinationRequest $request){
        try{
            return $this->combinationBLL->newCombination($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Delete a combination
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function deleteCombination($id){
        try{
            return $this->taxonomiesBLL->deleteTaxonomy('combination', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Restore a combination
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function restoreCombination($id){
        try{
            return $this->taxonomiesBLL->restoreTaxonomy('combination', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Edit a combination
     *
     * @param EditCombinationRequest $request
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function editCombination(EditCombinationRequest $request, $id){
        try{
            return $this->combinationBLL->editCombination($request, $id);
        }
        catch(Exception $e){
            return $e;
        }
    }
}

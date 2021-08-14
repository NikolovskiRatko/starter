<?php

namespace App\Applications\Common\Controllers;

use App\Applications\Common\BLL\TaxonomiesBLLInterface;
use App\Applications\Common\Requests\EditParameterRequest;
use App\Applications\Common\Requests\NewParameterRequest;
use Exception;
use App\Http\Controllers\Controller;
use App\Applications\Common\BLL\ParameterBLLInterface;
use Illuminate\Http\Request;

/**
 * @property TaxonomiesBLLInterface $taxonomiesBLL
 * @property ParameterBLLInterface $parameterBLL
 */
class ParameterController extends Controller
{
    public function __construct(
        TaxonomiesBLLInterface $taxonomiesBLL,
        ParameterBLLInterface $parameterBLL
    ){
        $this->taxonomiesBLL = $taxonomiesBLL;
        $this->parameterBLL = $parameterBLL;
    }

    /**
     * Get a JSON with parameters for Admin Panel
     *
     * @return array|Exception
     */
    public function getParametersAdmin(){
        try{
            return $this->parameterBLL->getAllParameters();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Order parameters
     *
     * @param  Request  $request
     * @return array|Exception
     */
    public function orderParameters(Request $request){
        try{
            return $this->parameterBLL->orderParameters($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Create a new parameter
     *
     * @param NewParameterRequest $request
     * @return integer|Exception
     */
    public function newParameter(NewParameterRequest $request){
        try{
            return $this->parameterBLL->newParameter($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Delete a parameter
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function deleteParameter($id){
        try{
            return $this->taxonomiesBLL->deleteTaxonomy('parameter', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Restore a parameter
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function restoreParameter($id){
        try{
            return $this->taxonomiesBLL->restoreTaxonomy('parameter', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Edit a parameter
     *
     * @param EditParameterRequest $request
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function editParameter(EditParameterRequest $request, $id){
        try{
            return $this->parameterBLL->editParameter($request, $id);
        }
        catch(Exception $e){
            return $e;
        }
    }
}

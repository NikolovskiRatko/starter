<?php

namespace App\Applications\Common\Controllers;

use App\Applications\Common\BLL\TaxonomiesBLLInterface;
use App\Applications\Common\Requests\EditPackageWeightRequest;
use App\Applications\Common\Requests\NewPackageWeightRequest;
use Exception;
use App\Http\Controllers\Controller;
use App\Applications\Common\BLL\PackageWeightBLLInterface;
use Illuminate\Http\Request;

/**
 * @property TaxonomiesBLLInterface $taxonomiesBLL
 * @property PackageWeightBLLInterface $packageweightBLL
 */
class PackageWeightController extends Controller
{
    public function __construct(
        TaxonomiesBLLInterface $taxonomiesBLL,
        PackageWeightBLLInterface $packageweightBLL
    ){
        $this->taxonomiesBLL = $taxonomiesBLL;
        $this->packageweightBLL = $packageweightBLL;
    }

    /**
     * Get a JSON with packageweights for Admin Panel
     *
     * @return array|Exception
     */
    public function getPackageWeightsAdmin(){
        try{
            return $this->packageweightBLL->getAllPackageWeights();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Order packageweights
     *
     * @param  Request  $request
     * @return array|Exception
     */
    public function orderPackageWeights(Request $request){
        try{
            return $this->packageweightBLL->orderPackageWeights($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Create a new packageweight
     *
     * @param NewPackageWeightRequest $request
     * @return integer|Exception
     */
    public function newPackageWeight(NewPackageWeightRequest $request){
        try{
            return $this->packageweightBLL->newPackageWeight($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Delete a packageweight
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function deletePackageWeight($id){
        try{
            return $this->taxonomiesBLL->deleteTaxonomy('packageweight', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Restore a packageweight
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function restorePackageWeight($id){
        try{
            return $this->taxonomiesBLL->restoreTaxonomy('packageweight', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Edit a packageweight
     *
     * @param EditPackageWeightRequest $request
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function editPackageWeight(EditPackageWeightRequest $request, $id){
        try{
            return $this->packageweightBLL->editPackageWeight($request, $id);
        }
        catch(Exception $e){
            return $e;
        }
    }
}

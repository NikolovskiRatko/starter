<?php

namespace App\Applications\Common\Controllers;

use App\Applications\Common\BLL\TaxonomiesBLLInterface;
use App\Applications\Common\Requests\EditLaminationRequest;
use App\Applications\Common\Requests\NewLaminationRequest;
use Exception;
use App\Http\Controllers\Controller;
use App\Applications\Common\BLL\LaminationBLLInterface;
use Illuminate\Http\Request;

/**
 * @property TaxonomiesBLLInterface $taxonomiesBLL
 * @property LaminationBLLInterface $laminationBLL
 */
class LaminationController extends Controller
{
    public function __construct(
        TaxonomiesBLLInterface $taxonomiesBLL,
        LaminationBLLInterface $laminationBLL
    ){
        $this->taxonomiesBLL = $taxonomiesBLL;
        $this->laminationBLL = $laminationBLL;
    }

    /**
     * Get a JSON with laminations for Admin Panel
     *
     * @return array|Exception
     */
    public function getLaminationsAdmin(){
        try{
            return $this->laminationBLL->getAllLaminations();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Order laminations
     *
     * @param  Request  $request
     * @return array|Exception
     */
    public function orderLaminations(Request $request){
        try{
            return $this->laminationBLL->orderLaminations($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Create a new lamination
     *
     * @param NewLaminationRequest $request
     * @return integer|Exception
     */
    public function newLamination(NewLaminationRequest $request){
        try{
            return $this->laminationBLL->newLamination($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Delete a lamination
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function deleteLamination($id){
        try{
            return $this->taxonomiesBLL->deleteTaxonomy('lamination', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Restore a lamination
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function restoreLamination($id){
        try{
            return $this->taxonomiesBLL->restoreTaxonomy('lamination', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Edit a lamination
     *
     * @param EditLaminationRequest $request
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function editLamination(EditLaminationRequest $request, $id){
        try{
            return $this->laminationBLL->editLamination($request, $id);
        }
        catch(Exception $e){
            return $e;
        }
    }
}

<?php

namespace App\Applications\Common\Controllers;

use App\Applications\Common\BLL\TaxonomiesBLLInterface;
use App\Applications\Common\Requests\EditClicheRequest;
use App\Applications\Common\Requests\NewClicheRequest;
use Exception;
use App\Http\Controllers\Controller;
use App\Applications\Common\BLL\ClicheBLLInterface;
use Illuminate\Http\Request;

/**
 * @property TaxonomiesBLLInterface $taxonomiesBLL
 * @property ClicheBLLInterface $clicheBLL
 */
class ClicheController extends Controller
{
    public function __construct(
        TaxonomiesBLLInterface $taxonomiesBLL,
        ClicheBLLInterface $clicheBLL
    ){
        $this->taxonomiesBLL = $taxonomiesBLL;
        $this->clicheBLL = $clicheBLL;
    }

    /**
     * Get a JSON with cliches for Admin Panel
     *
     * @return array|Exception
     */
    public function getClichesAdmin(){
        try{
            return $this->clicheBLL->getAllCliches();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Order cliches
     *
     * @param  Request  $request
     * @return array|Exception
     */
    public function orderCliches(Request $request){
        try{
            return $this->clicheBLL->orderCliches($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Create a new cliche
     *
     * @param NewClicheRequest $request
     * @return integer|Exception
     */
    public function newCliche(NewClicheRequest $request){
        try{
            return $this->clicheBLL->newCliche($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Delete a cliche
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function deleteCliche($id){
        try{
            return $this->taxonomiesBLL->deleteTaxonomy('cliche', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Restore a cliche
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function restoreCliche($id){
        try{
            return $this->taxonomiesBLL->restoreTaxonomy('cliche', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Edit a cliche
     *
     * @param EditClicheRequest $request
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function editCliche(EditClicheRequest $request, $id){
        try{
            return $this->clicheBLL->editCliche($request, $id);
        }
        catch(Exception $e){
            return $e;
        }
    }
}

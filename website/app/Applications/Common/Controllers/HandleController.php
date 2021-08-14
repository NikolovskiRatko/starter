<?php

namespace App\Applications\Common\Controllers;

use App\Applications\Common\BLL\TaxonomiesBLLInterface;
use App\Applications\Common\Requests\EditHandleRequest;
use App\Applications\Common\Requests\NewHandleRequest;
use Exception;
use App\Http\Controllers\Controller;
use App\Applications\Common\BLL\HandleBLLInterface;
use Illuminate\Http\Request;

/**
 * @property TaxonomiesBLLInterface $taxonomiesBLL
 * @property HandleBLLInterface $handleBLL
 */
class HandleController extends Controller
{
    public function __construct(
        TaxonomiesBLLInterface $taxonomiesBLL,
        HandleBLLInterface $handleBLL
    ){
        $this->taxonomiesBLL = $taxonomiesBLL;
        $this->handleBLL = $handleBLL;
    }

    /**
     * Get a JSON with handles for Admin Panel
     *
     * @return array|Exception
     */
    public function getHandlesAdmin(){
        try{
            return $this->handleBLL->getAllHandles();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Order handles
     *
     * @param  Request  $request
     * @return array|Exception
     */
    public function orderHandles(Request $request){
        try{
            return $this->handleBLL->orderHandles($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Create a new handle
     *
     * @param NewHandleRequest $request
     * @return integer|Exception
     */
    public function newHandle(NewHandleRequest $request){
        try{
            return $this->handleBLL->newHandle($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Delete a handle
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function deleteHandle($id){
        try{
            return $this->taxonomiesBLL->deleteTaxonomy('handle', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Restore a handle
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function restoreHandle($id){
        try{
            return $this->taxonomiesBLL->restoreTaxonomy('handle', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Edit a handle
     *
     * @param EditHandleRequest $request
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function editHandle(EditHandleRequest $request, $id){
        try{
            return $this->handleBLL->editHandle($request, $id);
        }
        catch(Exception $e){
            return $e;
        }
    }
}

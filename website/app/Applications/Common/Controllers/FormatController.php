<?php

namespace App\Applications\Common\Controllers;

use App\Applications\Common\BLL\TaxonomiesBLLInterface;
use App\Applications\Common\Requests\EditFormatRequest;
use App\Applications\Common\Requests\NewFormatRequest;
use Exception;
use App\Http\Controllers\Controller;
use App\Applications\Common\BLL\FormatBLLInterface;
use Illuminate\Http\Request;

/**
 * @property TaxonomiesBLLInterface $taxonomiesBLL
 * @property FormatBLLInterface $formatBLL
 */
class FormatController extends Controller
{
    public function __construct(
        TaxonomiesBLLInterface $taxonomiesBLL,
        FormatBLLInterface $formatBLL
    ){
        $this->taxonomiesBLL = $taxonomiesBLL;
        $this->formatBLL = $formatBLL;
    }

    /**
     * Get a JSON with formats for Admin Panel
     *
     * @return array|Exception
     */
    public function getFormatsAdmin(){
        try{
            return $this->formatBLL->getAllFormats();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Order formats
     *
     * @param  Request  $request
     * @return array|Exception
     */
    public function orderFormats(Request $request){
        try{
            return $this->formatBLL->orderFormats($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Create a new format
     *
     * @param NewFormatRequest $request
     * @return integer|Exception
     */
    public function newFormat(NewFormatRequest $request){
        try{
            return $this->formatBLL->newFormat($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Delete a format
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function deleteFormat($id){
        try{
            return $this->taxonomiesBLL->deleteTaxonomy('format', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Restore a format
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function restoreFormat($id){
        try{
            return $this->taxonomiesBLL->restoreTaxonomy('format', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Edit a format
     *
     * @param EditFormatRequest $request
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function editFormat(EditFormatRequest $request, $id){
        try{
            return $this->formatBLL->editFormat($request, $id);
        }
        catch(Exception $e){
            return $e;
        }
    }
}

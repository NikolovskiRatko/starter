<?php

namespace App\Applications\Common\Controllers;

use App\Applications\Common\BLL\TaxonomiesBLLInterface;
use App\Applications\Common\Requests\EditColorRequest;
use App\Applications\Common\Requests\NewColorRequest;
use Exception;
use App\Http\Controllers\Controller;
use App\Applications\Common\BLL\ColorBLLInterface;
use Illuminate\Http\Request;

/**
 * @property TaxonomiesBLLInterface $taxonomiesBLL
 * @property ColorBLLInterface $colorBLL
 */
class ColorController extends Controller
{
    public function __construct(
        TaxonomiesBLLInterface $taxonomiesBLL,
        ColorBLLInterface $colorBLL
    ){
        $this->taxonomiesBLL = $taxonomiesBLL;
        $this->colorBLL = $colorBLL;
    }

    /**
     * Get a JSON with colors for Admin Panel
     *
     * @return array|Exception
     */
    public function getColorsAdmin(){
        try{
            return $this->colorBLL->getAllColors();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Order colors
     *
     * @param  Request  $request
     * @return array|Exception
     */
    public function orderColors(Request $request){
        try{
            return $this->colorBLL->orderColors($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Create a new color
     *
     * @param NewColorRequest $request
     * @return integer|Exception
     */
    public function newColor(NewColorRequest $request){
        try{
            return $this->colorBLL->newColor($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Delete a color
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function deleteColor($id){
        try{
            return $this->taxonomiesBLL->deleteTaxonomy('color', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Restore a color
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function restoreColor($id){
        try{
            return $this->taxonomiesBLL->restoreTaxonomy('color', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Edit a color
     *
     * @param EditColorRequest $request
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function editColor(EditColorRequest $request, $id){
        try{
            return $this->colorBLL->editColor($request, $id);
        }
        catch(Exception $e){
            return $e;
        }
    }
}

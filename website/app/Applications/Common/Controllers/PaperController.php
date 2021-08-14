<?php

namespace App\Applications\Common\Controllers;

use App\Applications\Common\BLL\TaxonomiesBLLInterface;
use App\Applications\Common\Requests\EditPaperRequest;
use App\Applications\Common\Requests\NewPaperRequest;
use Exception;
use App\Http\Controllers\Controller;
use App\Applications\Common\BLL\PaperBLLInterface;
use Illuminate\Http\Request;

/**
 * @property TaxonomiesBLLInterface $taxonomiesBLL
 * @property PaperBLLInterface $paperBLL
 */
class PaperController extends Controller
{
    public function __construct(
        TaxonomiesBLLInterface $taxonomiesBLL,
        PaperBLLInterface $paperBLL
    ){
        $this->taxonomiesBLL = $taxonomiesBLL;
        $this->paperBLL = $paperBLL;
    }

    /**
     * Get a JSON with papers for Admin Panel
     *
     * @return array|Exception
     */
    public function getPapersAdmin(){
        try{
            return $this->paperBLL->getAllPapers();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Order papers
     *
     * @param  Request  $request
     * @return array|Exception
     */
    public function orderPapers(Request $request){
        try{
            return $this->paperBLL->orderPapers($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Create a new paper
     *
     * @param NewPaperRequest $request
     * @return integer|Exception
     */
    public function newPaper(NewPaperRequest $request){
        try{
            return $this->paperBLL->newPaper($request);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Delete a paper
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function deletePaper($id){
        try{
            return $this->taxonomiesBLL->deleteTaxonomy('paper', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Restore a paper
     *
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function restorePaper($id){
        try{
            return $this->taxonomiesBLL->restoreTaxonomy('paper', $id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
     * Edit a paper
     *
     * @param EditPaperRequest $request
     * @param integer $id
     *
     * @return integer|Exception
     */
    public function editPaper(EditPaperRequest $request, $id){
        try{
            return $this->paperBLL->editPaper($request, $id);
        }
        catch(Exception $e){
            return $e;
        }
    }
}

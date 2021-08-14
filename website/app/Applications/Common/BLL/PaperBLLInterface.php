<?php

namespace App\Applications\Common\BLL;

use Illuminate\Http\Request;

/**
 * Interface PaperBLLInterface
 * @package App\Applications\Common
 */

interface PaperBLLInterface
{
    /**
     * @return array
     */
    public function getAllPapers();

    /**
     * @param Request $request
     *
     * @return array
     */
    public function orderPapers($request);

    /**
     * @param Request $request
     * @param integer $id
     *
     * @return integer
     */
    public function editPaper($request, $id);

    /**
     * @param Request $request
     *
     * @return integer
     */
    public function newPaper($request);
}

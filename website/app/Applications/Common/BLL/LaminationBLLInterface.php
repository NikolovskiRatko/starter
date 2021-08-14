<?php

namespace App\Applications\Common\BLL;

use Illuminate\Http\Request;

/**
 * Interface LaminationBLLInterface
 * @package App\Applications\Common
 */

interface LaminationBLLInterface
{
    /**
     * @return array
     */
    public function getAllLaminations();

    /**
     * @param Request $request
     *
     * @return array
     */
    public function orderLaminations($request);

    /**
     * @param Request $request
     * @param integer $id
     *
     * @return integer
     */
    public function editLamination($request, $id);

    /**
     * @param Request $request
     *
     * @return integer
     */
    public function newLamination($request);
}

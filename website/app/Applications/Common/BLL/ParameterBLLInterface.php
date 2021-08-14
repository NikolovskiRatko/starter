<?php

namespace App\Applications\Common\BLL;

use Illuminate\Http\Request;

/**
 * Interface ParameterBLLInterface
 * @package App\Applications\Common
 */

interface ParameterBLLInterface
{
    /**
     * @return array
     */
    public function getAllParameters();

    /**
     * @param Request $request
     *
     * @return array
     */
    public function orderParameters($request);

    /**
     * @param Request $request
     * @param integer $id
     *
     * @return integer
     */
    public function editParameter($request, $id);

    /**
     * @param Request $request
     *
     * @return integer
     */
    public function newParameter($request);
}

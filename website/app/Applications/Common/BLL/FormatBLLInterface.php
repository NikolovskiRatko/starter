<?php

namespace App\Applications\Common\BLL;

use Illuminate\Http\Request;

/**
 * Interface FormatBLLInterface
 * @package App\Applications\Common
 */

interface FormatBLLInterface
{
    /**
     * @return array
     */
    public function getAllFormats();

    /**
     * @param Request $request
     *
     * @return array
     */
    public function orderFormats($request);

    /**
     * @param Request $request
     * @param integer $id
     *
     * @return integer
     */
    public function editFormat($request, $id);

    /**
     * @param Request $request
     *
     * @return integer
     */
    public function newFormat($request);
}

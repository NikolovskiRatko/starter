<?php

namespace App\Applications\Common\BLL;

use Illuminate\Http\Request;

/**
 * Interface HandleBLLInterface
 * @package App\Applications\Common
 */

interface HandleBLLInterface
{
    /**
     * @return array
     */
    public function getAllHandles();

    /**
     * @param Request $request
     *
     * @return array
     */
    public function orderHandles($request);

    /**
     * @param Request $request
     * @param integer $id
     *
     * @return integer
     */
    public function editHandle($request, $id);

    /**
     * @param Request $request
     *
     * @return integer
     */
    public function newHandle($request);
}

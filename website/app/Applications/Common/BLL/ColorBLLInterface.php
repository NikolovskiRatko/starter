<?php

namespace App\Applications\Common\BLL;

use Illuminate\Http\Request;

/**
 * Interface ColorBLLInterface
 * @package App\Applications\Common
 */

interface ColorBLLInterface
{
    /**
     * @return array
     */
    public function getAllColors();

    /**
     * @param Request $request
     *
     * @return array
     */
    public function orderColors($request);

    /**
     * @param Request $request
     * @param integer $id
     *
     * @return integer
     */
    public function editColor($request, $id);

    /**
     * @param Request $request
     *
     * @return integer
     */
    public function newColor($request);
}

<?php

namespace App\Applications\Common\BLL;

use Illuminate\Http\Request;

/**
 * Interface ClicheBLLInterface
 * @package App\Applications\Common
 */

interface ClicheBLLInterface
{
    /**
     * @return array
     */
    public function getAllCliches();

    /**
     * @param Request $request
     *
     * @return array
     */
    public function orderCliches($request);

    /**
     * @param Request $request
     * @param integer $id
     *
     * @return integer
     */
    public function editCliche($request, $id);

    /**
     * @param Request $request
     *
     * @return integer
     */
    public function newCliche($request);
}

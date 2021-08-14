<?php

namespace App\Applications\Common\BLL;

use Illuminate\Http\Request;

/**
 * Interface CombinationBLLInterface
 * @package App\Applications\Common
 */

interface CombinationBLLInterface
{
    /**
     * @return array
     */
    public function getAllCombinations();

    /**
     * @param Request $request
     *
     * @return array
     */
    public function orderCombinations($request);

    /**
     * @param Request $request
     * @param integer $id
     *
     * @return integer
     */
    public function editCombination($request, $id);

    /**
     * @param Request $request
     *
     * @return integer
     */
    public function newCombination($request);
}

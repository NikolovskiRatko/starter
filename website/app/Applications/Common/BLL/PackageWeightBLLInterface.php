<?php

namespace App\Applications\Common\BLL;

use Illuminate\Http\Request;

/**
 * Interface PackageWeightBLLInterface
 * @package App\Applications\Common
 */

interface PackageWeightBLLInterface
{
    /**
     * @return array
     */
    public function getAllPackageWeights();

    /**
     * @param Request $request
     *
     * @return array
     */
    public function orderPackageWeights($request);

    /**
     * @param Request $request
     * @param integer $id
     *
     * @return integer
     */
    public function editPackageWeight($request, $id);

    /**
     * @param Request $request
     *
     * @return integer
     */
    public function newPackageWeight($request);
}

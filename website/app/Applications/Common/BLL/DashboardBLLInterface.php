<?php

namespace App\Applications\Common\BLL;

/**
 * Interface DashboardBLLInterface
 * @package App\Applications\Location
 */

interface DashboardBLLInterface
{
    /**
     * @return array
     */
    public function getDashboardInformation();

    /**
     * @param $request
     * @return mixed
     */
    public function contact($request);
}

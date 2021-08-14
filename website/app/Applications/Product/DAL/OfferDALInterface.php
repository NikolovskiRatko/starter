<?php

namespace App\Applications\Product\DAL;

use App\Applications\Product\Model\Offer;
use Illuminate\Http\Request;

/**
 * Interface OfferDALInterface
 * @package App\Applications\Product
 */

interface OfferDALInterface
{
    /**
     * @param Request $request
     * @return Offer
     */
    public function save($request);

    /**
     * @param Request $request
     * @return Offer
     */
    public function update($data, $id);

    /**
     * @param integer $user_id
     * @return Offer
     */
    public function getOffersForUser($user_id);
}

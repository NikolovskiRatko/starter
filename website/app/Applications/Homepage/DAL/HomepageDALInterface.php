<?php

namespace App\Applications\Homepage\DAL;

use App\Applications\User\Model\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface UserDALInterface
 * @package App\Applications\User
 */

interface HomepageDALInterface
{
    public function getTopSliderItems();

    public function getDataTablesReady($request);

    public function deleteSlide($id);

    public function getSlide($id);

    public function storeSlide($request);

    public function updateSlide($request, $id);
}

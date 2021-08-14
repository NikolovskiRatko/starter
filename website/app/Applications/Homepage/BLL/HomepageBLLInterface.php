<?php

namespace App\Applications\Homepage\BLL;

use App\Applications\User\Model\User;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Interface UserBLLInterface
 * @package App\Applications\User
 */

interface HomepageBLLInterface
{
    public function getTopSliderItems();

    public function getDataTablesReady($request);

    public function deleteSlide($id);

    public function getSlide($id);

    public function storeSlide($request);

    public function updateSlide($request, $id);
}

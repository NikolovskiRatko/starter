<?php

namespace App\Applications\User\BLL;

use App\Applications\User\Model\User;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Interface UserBLLInterface
 * @package App\Applications\User
 */

interface UserBLLInterface
{
    /**
     * @return Collection
     */
    public function getAllUsers();

    /**
     * @param integer $id
     * @return User
     */
    public function getUserByIdForFormEdit($id);

    /**
     * @param ApiFormRequest $request
     * @return User
     */
    public function saveNewUser($request);

    /**
     * @param ApiFormRequest $request
     * @return User
     */
    public function saveNewPublicUser($request);

    /**
     * @param ApiFormRequest $request
     * @param integer $id
     * @return void
     */
    public function editUser($request, $id);

    /**
     * @param ApiFormRequest $request
     * @return void
     */
    public function editMyProfile($request);

    /**
     * @param ApiFormRequest $request
     * @return void
     */
    public function editMyAvatar($request);

    /**
     * @param Request $request
     * @return array
     */
    public function getDatatablesReady($request);

    /**
     * @param Request $request
     * @return array
     */
    public function getDatatablesReadyPublic($request);

    /**
     * @param $request
     * @return mixed
     */
    public function getDataExportPublic($request);
    /**
     * @param $request
     * @return mixed
     */
    public function getDataExportAdmin($request);
    /**
     * @return string
     */
    public function getUserRoles();

    /**
     * @return array
     */
    public function getAdmins($count, $search);

    /**
     * @param $request
     * @return mixed
     */
    public function getShippingInfo($id);

    /**
     * @param $request
     * @return mixed
     */
    public function editShippingInfo($request);

    /**
     * @param $request
     * @return boolean
     */
    public function userActivate($request);
}

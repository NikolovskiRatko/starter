<?php

namespace App\Applications\User\DAL;

use App\Applications\User\Model\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface UserDALInterface
 * @package App\Applications\User
 */

interface UserDALInterface
{
    /**
     * @return Collection
     */
    public function getAll();

    /**
     * @return Collection
     */
    public function getPublicUsers();

    /**
     * @param integer $id
     * @return User
     */
    public function getUserById($id);

    /**
     * @param integer $id
     * @return User
     */
    public function getUserByIdForFormEdit($id);

    /**
     * @param array $input
     * @return User
     */
    public function saveNewUser($input);

    /**
     * @param User $user
     * @param array $input
     * @return boolean
     */
    public function editUser($user, $input);

    /**
     * @param array $data
     * @return array
     */
    public function getDataTablesReady($data);

    /**
     * @param array $data
     * @return array
     */
    public function getDataTablesReadyPublic($data);

    /**
     * @param $data
     * @return mixed
     */
    public function getDataExportPublic($data);

    /**
     * @param $data
     * @return mixed
     */
    public function getDataExportAdmin($data);

    /**
     * @return Collection
     */
    public function getUserRoles();

    /**
     * @return array
     */
    public function getAdmins($count, $search);

    /**
     * @param int $id
     * @param array $roles
     * @return void
     */
    public function changeRoles($id, $roles);

    /**
     * @param User $user
     * @param string $password
     * @return void
     */
    public function setUserPassword($user, $password);

    /**
     * @param $id
     * @return mixed
     */
    public function getShippingInfo($id);

    /**
     * @param $shipping_details
     * @return mixed
     */
    public function editShippingInfo($shipping_details);

    /**
     * @param $billing_details
     * @return mixed
     */
    public function editBillingInfo($billing_details);

    /**
     * @param string $token
     * @return User
     */
    public function findUserByActivationCode($token);

    /**
     * @param User $user
     * @return boolean
     */
    public function activateUser($user);
}

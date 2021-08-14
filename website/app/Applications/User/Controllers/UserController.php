<?php

namespace App\Applications\User\Controllers;

use App\Applications\User\Requests\MyAvatar;
use App\Applications\User\Requests\MyProfile;
use App\Applications\User\Requests\NewPublicUserRequest;
use App\Applications\User\Requests\NewUserRequest;
use App\Applications\User\Requests\ShippingInfoRequest;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Applications\User\BLL\UserBLLInterface;
use App\Applications\User\Requests\UserRequest;
use Webpatser\Countries\Countries;

/**
 * @property UserBLLInterface $userBLL
 */
class UserController extends Controller
{
    public function __construct(
        UserBLLInterface $userBLL
    ){
        $this->userBLL = $userBLL;
    }

    /**
     * Get a JSON with all the users
     *
     * @return Collection
     */
    public function allUsers(){
        return $this->userBLL->getAllUsers();
    }

    /**
     * Get a JSON with a user by ID
     *
     * @param  integer  $id
     * @return string
     */
    public function getUser($id){
        return $this->userBLL->getUserByIdForFormEdit($id)->toJson();
    }

    /**
     * Get a JSON with a user by ID
     *
     * @param  integer  $id
     * @return string
     */
    public function getUserGuest($id){
        // TODO: Perhaps have some distinction here in the business logic for non authorized access
        return $this->userBLL->getUserByIdForFormEdit($id)->toJson();
    }

    /**
     * Get a JSON for the logged in user
     *
     * @return string
     */
    public function getMyProfile(){
        return $this->userBLL->getUserByIdForFormEdit(Auth::user()->id)->toJson();
    }

    /**
     * Store user and get JSON with a user response
     *
     * @param  NewUserRequest  $request
     * @return string
     */
    public function storeUser(NewUserRequest $request){
        return $this->userBLL->saveNewUser($request)->toJson();
    }

    /**
     * Store user and get JSON with a user response
     *
     * @param  NewPublicUserRequest  $request
     * @return string
     */
    public function storeUserGuest(NewPublicUserRequest $request){
        return $this->userBLL->saveNewPublicUser($request)->toJson();
    }

    /**
     * Update user
     *
     * @param  UserRequest  $request
     * @param  integer  $id
     * @return void
     */
    public function updateUser(UserRequest $request, $id){
        $this->userBLL->editUser($request, $id);
    }

    /**
     * Update logged user
     *
     * @param  MyProfile  $request
     * @return void
     */
    public function updateMyProfile(MyProfile $request){
        $this->userBLL->editMyProfile($request);
    }

    /**
     * Update logged user
     *
     * @param  MyProfile  $request
     * @return void
     */
    public function updateMyAvatar(MyAvatar $request){
        $this->userBLL->editMyAvatar($request);
    }

    /**
     * Get a paginated, filtered and sorted array of Users.
     * This endpoint requires some data in the request.
     *
     * @param  Request  $request
     * @return array
     */
    public function drawUser(Request $request){
        return $this->userBLL->getDataTablesReady($request);
    }

    /**
     * Get a paginated, filtered and sorted array of Public Users.
     * This endpoint requires some data in the request.
     *
     * @param  Request  $request
     * @return array
     */
    public function drawPublicUser(Request $request){
        return $this->userBLL->getDataTablesReadyPublic($request);
    }

    /**
     * Get filtered and sorted array of Public Users.
     * This endpoint requires some data in the request.
     *
     * @param  Request  $request
     * @return array
     */
    public function exportPublicUser(Request $request){
        return $this->userBLL->getDataExportPublic($request);
    }

    /**
     * Get filtered and sorted array of Public Users.
     * This endpoint requires some data in the request.
     *
     * @param  Request  $request
     * @return array
     */
    public function exportAdminUser(Request $request){
        return $this->userBLL->getDataExportAdmin($request);
    }

    /**
     * Get a paginated, filtered and sorted array of Users.
     * This endpoint requires some data in the request.
     *
     * @param  Request  $request
     * @return array
     */
    public function drawUserGuest(Request $request){
        // TODO: Perhaps have some distinction here in the business logic for non authorized access
        return $this->userBLL->getDataTablesReady($request);
    }

    /**
     * Get a JSON of User Roles.
     *
     * @return string
     */
    public function getUserRoles(){
        return $this->userBLL->getUserRoles();
    }

    /**
     * Get a JSON of Countries.
     *
     * @return string
     */
    public function getCountriesForDropdown(){
        // TODO: Refactor this to BLL and DAL
        return Countries::get()->toJson();
    }

    /**
     * Get a JSON of Admins.
     *
     * @return array
     */
    public function getAdminsForDropdown($count, $search){
        return $this->userBLL->getAdmins($count, $search);
    }

    /**
     * Delete user
     *
     * @return string
     */
    public function deleteUser($id){
        return $this->userBLL->deleteUser($id);
    }

    /**
     *
     * @return string
     */
    public function getShippingInfo(){
        return $this->userBLL->getShippingInfo(Auth::user()->id)->toJson();
    }

    /**
     * Delete user
     *
     * @return string
     */
    public function editShippingInfo(ShippingInfoRequest $request){
        return $this->userBLL->editShippingInfo($request);
    }
    /**
     * Verify user email
     *
     * @return string
     */
    public function userActivate(Request $request){
        return $this->userBLL->userActivate($request);
    }
}

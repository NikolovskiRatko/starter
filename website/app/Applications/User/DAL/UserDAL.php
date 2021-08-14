<?php

namespace App\Applications\User\DAL;

use App\Applications\User\Model\Details;
use App\Util\DataExport\DataExportService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Applications\User\Model\Role;
use App\Applications\User\Model\User;


/**
 * @property User $user
 * @property Role $role
 * @property DataExportService dataExport
 */
class UserDAL implements UserDALInterface
{
    public function __construct(
        User $user,
        Role $role,
        Details $details,
        DataExportService $dataExport
    ){
        $this->user = $user;
        $this->role = $role;
        $this->details = $details;
        $this->dataExport = $dataExport;
    }

    public function getAll(){
        return $this->user::all();
    }

    public function getPublicUsers(){
        return $this->user::whereHas('roles', function($q){
            $q->where('id', 3);
        })->get();
    }
    /**
     *
     * @return object or end with 404 termination
     *
     */
    public function getUserById($id){
        return $this->user::findOrFail($id); // can rework with NotFoundAPIException and find
    }

    public function getUserByIdForFormEdit($id){
        /** @var User $user */
        $user = $this->user::findOrFail($id);
        $user['roles_array'] = $user->roles_array();
        return $user;
    }

    public function saveNewUser($input){
        /** @var User */
        $user = $this->user->create($input);
        $this->details->create(['type' => 'SHIPPING', 'default' => true, 'user_id' => $user->id]);
        $this->details->create(['type' => 'BILLING', 'default' => true, 'user_id' => $user->id]);
        return $user;
    }

    public function editUser($user, $input){
        return $user->update($input);
    }

    public function getDataTablesReady($data){
        // TODO: Refactor this segment
        $query = DB::table('users')
            ->select(
                DB::raw('users.id as id'),
                DB::raw('users.first_name as first_name'),
                DB::raw('users.last_name as last_name'),
                DB::raw("IFNULL(users.email,users.contact_email) as email"),
                DB::raw('GROUP_CONCAT(DISTINCT roles.display_name) AS roles'),
                DB::raw('users.is_disabled as is_disabled')
            )
            ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->whereIn('roles.name', [Role::ADMIN, Role::COLLABORATOR]);

        $search = $data['search'];
        if($search){
            $query->where(function($subquery) use ($search) {
                $subquery->where('users.first_name', 'like', '%'.$search.'%');
                $subquery->orWhere('users.last_name', 'like', '%'.$search.'%');
                $subquery->orWhere('users.email', 'like', '%'.$search.'%');
                $subquery->orWhere('roles.display_name', 'like', '%'.$search.'%');
            });
        }

        $query->groupBy('users.id');
        $query->orderBy($data['columns'][$data['column']], $data['dir']);
        $query->whereNull('users.deleted_at');

        $items = $query->paginate($data['length']);
        return ['data' => $items, 'draw' => $data['draw']];
    }

    public function getDataTablesReadyPublic($data){
        // TODO: Refactor this segment
        $query = DB::table('users')
            ->select(
                DB::raw('users.id as id'),
                DB::raw('users.first_name as first_name'),
                DB::raw('users.last_name as last_name'),
                DB::raw("IFNULL(users.email,users.contact_email) as email"),
                DB::raw('GROUP_CONCAT(DISTINCT roles.display_name) AS roles'),
                DB::raw('users.is_disabled as is_disabled'),
                DB::raw('users.source as source'),
                DB::raw('users.source_info as source_info')
            )
            ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->whereIn('roles.name', [Role::PUBLIC]);

        $search = $data['search'];
        if($search){
            $query->where(function($subquery) use ($search) {
                $subquery->where('users.first_name', 'like', '%'.$search.'%');
                $subquery->orWhere('users.last_name', 'like', '%'.$search.'%');
                $subquery->orWhere('users.email', 'like', '%'.$search.'%');
                $subquery->orWhere('users.contact_email', 'like', '%'.$search.'%');
                $subquery->orWhere('roles.display_name', 'like', '%'.$search.'%');
            });
        }

        if(isset($data['source']) && $data['source'] != '' && $data['source'] != 'all'){
            $query->where('users.source','=',$data['source']);
        }

        $query->whereNull('users.deleted_at');

        $query->groupBy('users.id');
        $query->orderBy($data['columns'][$data['column']], $data['dir']);

        $items = $query->paginate($data['length']);
        return ['data' => $items, 'draw' => $data['draw']];
    }

    public function getDataExportPublic($data){
        // TODO: Refactor this segment
        $query = DB::table('users')
            ->select(
                DB::raw('users.id as id'),
                DB::raw('users.first_name as first_name'),
                DB::raw('users.last_name as last_name'),
                DB::raw("IFNULL(users.email,users.contact_email) as email"),
                DB::raw('GROUP_CONCAT(DISTINCT roles.display_name) AS roles'),
                DB::raw('users.is_disabled as is_disabled'),
                DB::raw('users.source as source'),
                DB::raw('users.source_info as source_info')
            )
            ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->whereIn('roles.name', [Role::PUBLIC]);

        $search = $data['search'];
        if($search){
            $query->where(function($subquery) use ($search) {
                $subquery->where('users.first_name', 'like', '%'.$search.'%');
                $subquery->orWhere('users.last_name', 'like', '%'.$search.'%');
                $subquery->orWhere('users.email', 'like', '%'.$search.'%');
                $subquery->orWhere('users.contact_email', 'like', '%'.$search.'%');
                $subquery->orWhere('roles.display_name', 'like', '%'.$search.'%');
            });
        }

        $query->whereNull('users.deleted_at');

        if(isset($data['source']) && $data['source'] != '' && $data['source'] != 'all'){
            $query->where('users.source','=',$data['source']);
        }

        $query->groupBy('users.id');
        $query->orderBy($data['columns'][$data['column']], $data['dir']);

        $data = $query->get();
        return $this->dataExport->array_to_csv_download($data,'public_users.csv',';');
    }

    public function getDataExportAdmin($data){
        $query = DB::table('users')
            ->select(
                DB::raw('users.id as id'),
                DB::raw('users.first_name as first_name'),
                DB::raw('users.last_name as last_name'),
                DB::raw("IFNULL(users.email,users.contact_email) as email"),
                DB::raw('GROUP_CONCAT(DISTINCT roles.display_name) AS roles'),
                DB::raw('users.is_disabled as is_disabled'),
                DB::raw('users.source as source'),
                DB::raw('users.source_info as source_info')
            )
            ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->whereNotIn('roles.name', [Role::PUBLIC]);

        $search = $data['search'];
        if($search){
            $query->where(function($subquery) use ($search) {
                $subquery->where('users.first_name', 'like', '%'.$search.'%');
                $subquery->orWhere('users.last_name', 'like', '%'.$search.'%');
                $subquery->orWhere('users.email', 'like', '%'.$search.'%');
                $subquery->orWhere('users.contact_email', 'like', '%'.$search.'%');
                $subquery->orWhere('roles.display_name', 'like', '%'.$search.'%');
            });
        }

        $query->whereNull('users.deleted_at');

        if(isset($data['source']) && $data['source'] != '' && $data['source'] != 'all'){
            $query->where('users.source','=',$data['source']);
        }

        $query->groupBy('users.id');
        $query->orderBy($data['columns'][$data['column']], $data['dir']);

        $data = $query->get();
        return $this->dataExport->array_to_csv_download($data,'admin_users.csv',';');
    }

    public function getUserRoles(){
        return $this->role->select('id', 'name', 'display_name')->get();
    }

    public function getAdmins($count, $search){
        $users = $this->user->select( DB::raw("id as admin_id"), DB::raw("CONCAT(id,' - ',IFNULL(email,''),' (',IFNULL(first_name,''),' ',IFNULL(last_name,''),')') as name"))
            ->whereHas('roles', function($q){
                $q->whereIn('name', [Role::COLLABORATOR,Role::ADMIN,Role::PUBLIC]);
            })
            ->where(function ($query) use ($search){
                return $query->where('email', 'LIKE', '%'.$search.'%')
                ->orWhere('first_name', 'LIKE', '%'.$search.'%')
                ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                ->orWhere('id', 'LIKE', '%'.$search.'%');
            })
            ->get();

        return ['data' => $users, 'draw' => $count];
    }

    public function changeRoles($id, $roles){
        DB::table('role_user')->where('user_id', $id)->delete();
//        foreach($roles as $role){
            DB::table('role_user')->insert(['user_id'=>$id, 'role_id'=>$roles]);
//        }
    }

    public function setUserPassword($user, $password){
        $pass = Hash::make($password);
        $user->password = $pass;
        $user->save();
    }

    function makeSalt() {
		$ret="";
		for($i=0;$i<16;$i++) $ret.=bin2hex(chr(mt_rand(0,255)));
		return $ret;
    }

    function bestAvailAlgo() {
		return 2;
	}

    public function delete($id){
        return $this->user
            ->where('id', $id)
            ->delete();
    }

    public function forceDelete($id){
        return $this->user
            ->where('id', $id)
            ->forceDelete();
    }

    public function getShippingInfo($id){
        if(($shipping_info = $this->user->find($id)->shipping_details) != null)
            return $shipping_info;
        else
            return collect();
    }

    public function editShippingInfo($shipping_details){
        $shipping_details['type'] = 'SHIPPING';
        $shipping_details['default'] = true;
        return $this->user->find(Auth::user()->id)->shipping_details()->updateOrCreate(['user_id' => Auth::user()->id],$shipping_details);
    }

    public function editBillingInfo($billing_details){
        $billing_details['type'] = 'BILLING';
        $billing_details['default'] = true;
        return $this->user->find(Auth::user()->id)->billing_details()->updateOrCreate(['user_id' => Auth::user()->id],$billing_details);
    }

    public function findUserByActivationCode($token){
        return $this->user->where('activation_code', $token)->first();
    }

    public function activateUser($user){
        $user->is_disabled = 0;
        return $user->save();
    }
}

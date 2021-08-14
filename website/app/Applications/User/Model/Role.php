<?php

namespace App\Applications\User\Model;

use App\Applications\User\Model\User;
use App\Applications\User\Model\Permission;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    const ADMIN = 'administrator';
    const COLLABORATOR = 'collaborator';
    const PUBLIC = 'public';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}

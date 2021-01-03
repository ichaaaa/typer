<?php

namespace App;

use App\Permission;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public function permissions()
    {
    	return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

   	public function users()
   	{
   		return $this->belongsToMany(User::class, 'users_roles');
   	}
}

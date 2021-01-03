<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles()
    {
    	return $this->belongsToMany(Role::class, 'roles_permissions');
    }

    public function users()
    {
    	return $this->belongToMany(User::class, 'users_permission');
    }
}

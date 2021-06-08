<?php

namespace App;

use App\Permission;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = Str::slug($value);
    }   	
}

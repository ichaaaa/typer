<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    public function roles()
    {
    	return $this->belongsToMany(Role::class, 'roles_permissions');
    }

    public function users()
    {
    	return $this->belongsToMany(User::class, 'users_permission');
    }

    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = Str::slug($value);
    }
}

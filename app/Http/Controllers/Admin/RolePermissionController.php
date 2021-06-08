<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index()
    {
    	$roles = Role::with('permissions')->get();
    	$permissions = Permission::with('roles')->get();


    	return view('admin.roles_permissions_list', compact('roles', 'permissions'));
    }
}

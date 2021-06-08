<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

	public function create()
	{
    	$permissions = Permission::all();

    	return view('admin.role_create_form', compact('permissions'));		
	}

	public function store(StoreRoleRequest $request)
	{
		$role = new Role;

		$data = $request->all();
		$role->name = $data['name'];
    	$role->slug = $data['name'];
    	$role->save();
    	$role->permissions()->sync($data['permissions'] ?? []);
    	

    	$response = array(
	        'status' => 'success',
	        'msg' => 'Dane zapisane.',
	    );

      	return response()->json($response); 
	}

    public function edit(Role $role)
    {

    	$permissions = Permission::all();

    	return view('admin.role_update_form', compact('role', 'permissions'));
    }

    public function update($role_id, UpdateRoleRequest $request)
    {
		try
		{
		    $role = Role::findOrFail($role_id);
		}
		catch(\Exception $e)
		{
		    $response = array(
	          'status' => 'error',
	          'msg' => 'Rola nie znaleziona',
	      	);
	      	return response()->json($response); 
		}

    	$data = $request->all();

    	$role->name = $data['name'];
    	$role->slug = $data['name'];
    	$role->permissions()->sync($data['permissions'] ?? []);
    	$role->save();

    	$response = array(
	        'status' => 'success',
	        'msg' => 'Dane zapisane.',
	    );

      	return response()->json($response); 

    }


    public function destroy($role_id)
    {

		try
		{
		    $role = Role::findOrFail($role_id);
		}
		catch(\Exception $e)
		{
		    $response = array(
	          'status' => 'error',
	          'msg' => 'Rola nie znaleziona',
	      	);
	      	return response()->json($response); 
		}

		if($role->permissions()->exists())
		{
		    $response = array(
	          'status' => 'error',
	          'msg' => 'Rola posiada uprawnienia',
	      	);
	      	return response()->json($response); 
		}

		if($role->users()->exists())
		{
		    $response = array(
	          'status' => 'error',
	          'msg' => 'Istnieją użytkownicy posiadający rolę',
	      	);
	      	return response()->json($response); 
		}

		$role->delete();

		$response = array(
	        'status' => 'success',
	        'msg' => 'Dane zapisane.',
	    );

    	return response()->json($response); 
    }
}

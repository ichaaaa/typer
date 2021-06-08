<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

	public function create()
	{
		$roles = Role::all();

    	return view('admin.permission_create_form', compact('roles'));	
	}

	public function store(StorePermissionRequest $request)
	{
		$permission = new Permission;
		$data = $request->all();

		$permission->name = $data['name'];
		$permission->slug = $data['name'];
		$permission->save();
		$permission->roles()->sync($data['roles'] ?? []);
		

    	$response = array(
	        'status' => 'success',
	        'msg' => 'Dane zapisane.',
	    );

      	return response()->json($response);

	}

    public function edit(Permission $permission)
    {

    	$roles = Role::all();

    	return view('admin.permission_update_form', compact('roles', 'permission'));
    }


    public function update($permission_id, UpdatePermissionRequest $request)
    {
		try
		{
		    $permission = Permission::findOrFail($permission_id);
		}
		catch(\Exception $e)
		{
		    $response = array(
	          'status' => 'error',
	          'msg' => 'Uprawnienie nie znalezione',
	      	);
	      	return response()->json($response); 
		}

    	$data = $request->all();

    	$permission->name = $data['name'];
    	$permission->slug = $data['name'];
    	$permission->roles()->sync($data['roles'] ?? []);
    	$permission->save();

    	$response = array(
	        'status' => 'success',
	        'msg' => 'Dane zapisane.',
	    );

      	return response()->json($response); 

    }

    public function destroy($permission_id)
    {

		try
		{
		    $permission = Permission::findOrFail($permission_id);
		}
		catch(\Exception $e)
		{
		    $response = array(
	          'status' => 'error',
	          'msg' => 'Uprawnienie nie znalezione',
	      	);
	      	return response()->json($response); 
		}

		if($permission->roles()->exists())
		{
		    $response = array(
	          'status' => 'error',
	          'msg' => 'Uprawnienie posiada role',
	      	);
	      	return response()->json($response); 
		}

		if($permission->users()->exists())
		{
		    $response = array(
	          'status' => 'error',
	          'msg' => 'Istnieją użytkownicy posiadający uprawnienie',
	      	);
	      	return response()->json($response); 
		}

		$permission->delete();

		$response = array(
	        'status' => 'success',
	        'msg' => 'Dane zapisane.',
	    );

    	return response()->json($response); 
    }

}

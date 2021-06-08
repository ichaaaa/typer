<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
    	$users = User::with(['roles', 'permissions'])->get();

    	return view('admin.users_list', compact('users'));
    }


    public function edit(User $user)
    {
    	$roles = Role::all();
    	$permissions = Permission::all();
    	return view('admin.user_details_form', compact('user', 'roles', 'permissions'));
    }

    public function update($user_id, UpdateUserRequest $request)
    {
		try
		{
		    $user = User::findOrFail($user_id);
		}
		catch(\Exception $e)
		{
		    $response = array(
	          'status' => 'error',
	          'msg' => 'Użytkownik nie znaleziony',
	      	);
	      	return response()->json($response); 
		}

    	$data = $request->all();
    	//dd(in_array(2, $data['roles']));
		if($user->id == Auth::id() && !in_array(1, $data['roles']))
		{
		    $response = array(
	          'status' => 'error',
	          'msg' => 'Nie możesz odebrać sobie uprawnień administratorskich',
	      	);
	      	return response()->json($response); 
		}

    	$user->name = $data['name'];
    	$user->roles()->sync($data['roles']);
    	$user->permissions()->sync($data['permissions']);
    	$user->save();

    	$response = array(
	        'status' => 'success',
	        'msg' => 'Dane zapisane.',
	    );

      	return response()->json($response); 
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannedUserRequest;
use App\Jobs\SendBanningNotification;
use App\Notifications\BanUserFromTyperNotification;
use App\Services\CompetitionService;
use App\Typer;
use App\User;
use Illuminate\Http\Request;

class BannedUserController extends Controller
{
    public function store(StoreBannedUserRequest $request, CompetitionService $service)
    {

		$data = $request->all();
		$typer = Typer::find($data['typer_id']);
		$user = User::find($data['user_id']);

    	if(!$typer->hasUser($user)){
			abort(403, 'Unauthorized action.');
		}

		SendBanningNotification::dispatch($typer, $user, (string)$data['banning-reason']);
		$typer->users()->where('user_id', '=', $data['user_id'])->update(['banned' => 1, 'banning_reason' => $data['banning-reason']]);
		
		return redirect()->route('show_typer_details', ['typer'=>$typer]);
    }

    public function create(Typer $typer, User $user)
    {

		if(!$typer->hasUser($user)){
			abort(403, 'Unauthorized action.');
		}

    	return view('admin.ban_create', compact(['typer', 'user']));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\InvitationNotification;
use App\Notifications\InviteUserToTyperNotification;
use App\Services\CompetitionService;
use App\Typer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserInvitationController extends Controller
{
    public function store(Typer $typer, User $user)
    {
		if($typer->hasUser($user)){
			abort(403, 'Unauthorized action.');
		}

        if(!$typer->visibility->private){
            abort(403, 'Unauthorized action.');
        }

        InvitationNotification::dispatch($typer, $user);

    	return view('front.toast', compact('user'));
    }


    public function update(Typer $typer, $token)
    {
    	if($typer->users()->wherePivot('token', '=', $token)->count() != 1)
    	{
    		abort(403, 'Unauthorized action.');
    	}

    	$user = $typer->users()->wherePivot('token', '=', $token)->get()->first();

    	if($user->id != Auth::id())
    	{
			return redirect()->route('logout');
    	}

    	$typer->users()->wherePivot('token', '=', $token)->update(['confirmed' => 1]);

    	return redirect()->route('show_accepted_invitation_confirmation_to_typer', ['typer'=>$typer]);
    }

    public function show(Typer $typer, CompetitionService $service)
    {
        if(!$typer->hasUser(Auth::user())){
            abort(403, 'Unauthorized action.');
        }

    	$competition = $typer->getCompetition($service);
    	return view('front.invitation_acceptance_confirm', compact('competition'));
    }
}

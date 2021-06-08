<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ConfirmationNotification;
use App\Notifications\UserTyperConfirmNotification;
use App\Services\CompetitionService;
use App\Typer;
use App\User;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    
    public function store(Typer $typer, User $user)
    {
    	$typer->users()->wherePivot('user_id', '=', $user->id)->update(['verified' => 1]);
    	ConfirmationNotification::dispatch($typer, $user);

    	return redirect()->route('show_typer_details', ['typer' => $typer]);
    }
}

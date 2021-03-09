<?php

namespace App\Http\Controllers;

use App\Jobs\ApplicationToTyperNotification;
use App\Notifications\UserTyperApplicationNotification;
use App\Services\CompetitionService;
use App\Typer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTyperController extends Controller
{
    public function index(CompetitionService $service)
    {
    	$typers = Auth::user()->visibleTypers;
    	return view('front.typer.typer_list', compact('typers', 'service'));
    }

    public function show(Typer $typer, CompetitionService $service)
    {
        $competition = $typer->getCompetition($service);
        return view('front.typer.typer_details', compact('competition'));
    }

    public function store(Typer $typer)
    {
        $typer->users()->attach(Auth::id());
        ApplicationToTyperNotification::dispatch($typer, Auth::user());
    	return redirect()->route('visible_for_user_typers_list');
    }
}

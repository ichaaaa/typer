<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Jobs\ApplicationToTyperNotification;
use App\Notifications\UserTyperApplicationNotification;
use App\Objects\Game;
use App\Services\BetTransformerService;
use App\Services\CompetitionService;
use App\Services\MatchService;
use App\Typer;
use App\User;
use Carbon\Carbon;
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
        $matches = $service->findWithMatchesByDate($competition->getId());

        $closestDate = Game::findClosestMatchDate(array_keys($matches));

        $bets = BetTransformerService::getArrayByTyperUser($typer->id, Auth::id());
        return view('front.typer.typer_details', compact(['competition', 'matches', 'closestDate', 'typer', 'bets']));
    }

    public function store(Typer $typer)
    {
        $typer->users()->attach(Auth::id());
        ApplicationToTyperNotification::dispatch($typer, Auth::user());
    	return redirect()->route('visible_for_user_typers_list');
    }
}

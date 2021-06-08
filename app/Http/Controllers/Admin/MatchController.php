<?php

namespace App\Http\Controllers\Admin;

use App\Bet;
use App\Http\Controllers\Controller;
use App\Objects\Game;
use App\Services\BetTransformerService;
use App\Services\CompetitionService;
use App\Services\ExtraQuestionTransformerService;
use App\Services\MatchService;
use App\Typer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    public function index(Typer $typer, CompetitionService $service)
    {
        $competition = $typer->getCompetition($service);
        $matches = $service->findWithMatchesByDate($competition->getId());

        $closestDate = Game::findClosestMatchDate(array_keys($matches));

        $bets = BetTransformerService::getArrayByTyperWithResults($typer->id);

        $questions = ExtraQuestionTransformerService::getArrayByTyper($typer->id);

    	return view('admin.matches_to_check_bet_list', compact('matches', 'typer', 'bets', 'closestDate', 'questions'));
    }
}

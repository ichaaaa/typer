<?php

namespace App\Http\Controllers;

use App\Bet;
use App\BetResult;
use App\Services\BetResultService;
use App\Services\MatchService;
use Illuminate\Http\Request;

class BetResultController extends Controller
{
    public function store(Bet $bet, MatchService $matchService)
    {
    	$betResult = new BetResult;
    	$match = $matchService->find($bet->match_id);
    	$betResultService = new BetResultService($match, $bet);

	    $betResult->bet_id = $bet->id;
		$betResult->winning_team_guess = $betResultService->isWinningTeamPicked();
		$betResult->extact_score_guess = $betResultService->isExactScore();
		$betResult->extra_question_guess = $betResultService->isExtraQuestionGuessed();
		$betResult->points = $betResultService->calculatePoints();

		$betResult->save();
    }
}

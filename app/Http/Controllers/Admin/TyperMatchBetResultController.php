<?php

namespace App\Http\Controllers\Admin;

use App\Bet;
use App\BetResult;
use App\Http\Controllers\Controller;
use App\Services\BetResultService;
use App\Services\MatchService;
use App\Typer;
use Illuminate\Http\Request;

class TyperMatchBetResultController extends Controller
{
    public function store(Typer $typer, $match_id, MatchService $matchService)
    {

    	$bets = Bet::doesntHave('betResult')->where('typer_id', $typer->id)->where('match_id', $match_id)->get();
    	$match = $matchService->find($match_id);

    	foreach($bets as $bet)
    	{
    		if($match->getStatus() == 'FINISHED' && ($typer->verifiedUser($bet->user) || $typer->confirmedUser($bet->user)) && !$typer->bannedUser($bet->user) && $match->getCompetition()->getId() == $typer->competition_id)
    		{
    			$betResult = new BetResult;
		    	$betResultService = new BetResultService($match, $bet);
			    $betResult->bet_id = $bet->id;
				$betResult->winning_team_guess = $betResultService->isWinningTeamPicked();
				$betResult->extact_score_guess = $betResultService->isExactScore();
				$betResult->extra_question_guess = $betResultService->isExtraQuestionGuessed();
				$betResult->points = $betResultService->calculatePoints();

				$betResult->save();
    		}
    	}

        return back();
    }

}

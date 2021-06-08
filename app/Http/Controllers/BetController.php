<?php

namespace App\Http\Controllers;

use App\Bet;
use App\ExtraQuestion;
use App\Http\Requests\StoreBetRequest;
use App\Http\Requests\UpdateBetRequest;
use App\Services\MatchService;
use App\Typer;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BetController extends Controller
{

    public function create($id, Typer $typer, MatchService $service)
    {
    	$match = $service->find($id);
    	if(Bet::canBet($match) && $typer->hasUser(Auth::user()))
    	{
    		$question = ExtraQuestion::where('typer_id', $typer->id)->where('match_id', $match->getId())->first();
    		return view('front.bet.bet_create', compact('typer', 'match', 'question'));
    	}
    }

    public function edit(Bet $bet, MatchService $service)
    {
    	$match = $service->find($bet->match_id);
    	if(Bet::canBet($match))
    	{
    		return view('front.bet.bet_edit', compact('bet', 'match'));
    	}
    }

    public function store(MatchService $service, StoreBetRequest $request)
    {
		try
		{
		    $typer = Typer::findOrFail($request->typer_id);
		}
		catch(ModelNotFoundException $e)
		{
		    $response = array(
	          'status' => 'error',
	          'msg' => 'Nieprawidłowy typer',
	      	);
	      	return response()->json($response); 
		}

    	$match = $service->find($request->match_id);

    	if(Bet::canBet($match) && $typer->hasUser(Auth::user()) && ($typer->verifiedUser(Auth::user()) || $typer->confirmedUser(Auth::user())) && !$typer->bannedUser(Auth::user()) && $match->getCompetition()->getId() == $typer->competition_id ){

	    	$bet = new Bet;
	    	$bet->typer_id = $request->typer_id;
	    	$bet->match_id = $request->match_id;
	    	$bet->user_id = Auth::id();
	    	$bet->home_team_score = $request->home_team_score;
	    	$bet->away_team_score = $request->away_team_score;
	    	$bet->sure_thing = $request->sure_thing == null ? 0 : 1;
			$bet->save();

			$response = array(
	          'status' => 'success',
	          'match_id' => $bet->match_id,
	          'home_team_score' => $bet->home_team_score,
	          'away_team_score' => $bet->away_team_score,
	          'sure_thing' => $bet->sure_thing,
	          'msg' => 'Typ zapisany',
	      	);
		}else{
			$response = array(
	          'status' => 'error',
	          'msg' => 'Coś poszło nie tak.',
	      	);
		}

		return response()->json($response); 
    }

    public function update(MatchService $service, UpdateBetRequest $request)
    {
		try
		{
		    $bet = Bet::findOrFail($request->bet_id);
		    $typer = Typer::findOrFail($bet->typer_id);
		}
		catch(ModelNotFoundException $e)
		{
		    $response = array(
	          'status' => 'error',
	          'msg' => 'Coś poszło nie tak.',
	      	);
	      	return response()->json($response); 
		}

		$match = $service->find($bet->match_id);

		if(Bet::canBet($match) && $bet->user_id == Auth::id() && ($typer->verifiedUser(Auth::user()) || $typer->confirmedUser(Auth::user())) && !$typer->bannedUser(Auth::user()) && $match->getCompetition()->getId() == $typer->competition_id){
	    	$bet->home_team_score = $request->home_team_score;
	    	$bet->away_team_score = $request->away_team_score;
	    	$bet->extra_question_answer_id = 1;
	    	$bet->sure_thing = $request->sure_thing == null ? 0 : 1;
	    	$bet->save();

			$response = array(
	          'status' => 'success',
	          'match_id' => $bet->match_id,
	          'home_team_score' => $bet->home_team_score,
	          'away_team_score' => $bet->away_team_score,
	          'sure_thing' => $bet->sure_thing,
	          'msg' => 'Typ zapisany',
	      	);
		}else{
			$response = array(
	          'status' => 'error',
	          'msg' => 'Coś poszło nie tak.',
	      	);
		}

		return response()->json($response); 
    }


}

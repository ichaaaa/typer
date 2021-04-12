<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Services\MatchService;
use App\Typer;
use Illuminate\Http\Request;

class MatchBetController extends Controller
{
    public function index($match_id, Typer $typer, MatchService $service)
    {

    	$match = $service->find($match_id);

    	$bets = Bet::with('user')->match($typer->id, $match)->get();

    	return view('front.bet.bet_list', compact('bets'));
    }
}

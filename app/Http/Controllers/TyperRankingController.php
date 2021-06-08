<?php

namespace App\Http\Controllers;

use App\Bet;
use App\BetResult;
use App\Services\TyperUserRankingService;
use App\Typer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TyperRankingController extends Controller
{
    public function index(Typer $typer)
    {
    	$ranking = TyperUserRankingService::getRankingData($typer->id);
    	
    	return view('admin.ranking', compact('ranking'));
    }
}

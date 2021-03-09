<?php

namespace App\Http\Controllers;

use App\Objects\League;
use App\Objects\Tournament;
use App\Services\CompetitionService;
use Illuminate\Http\Request;

class CompetitionMatchesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id, CompetitionService $service)
    {
        $competition = $service->findWithMatches($id);

        if($competition instanceof League)
        {
            return view('front.competition.league', compact('competition'));
        }
        elseif($competition instanceof Tournament)
        {
            //dd($competition);
            return view('front.competition.tournament', compact('competition'));
        }

        
    }
}

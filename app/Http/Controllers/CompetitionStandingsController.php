<?php

namespace App\Http\Controllers;

use App\Services\CompetitionService;
use Illuminate\Http\Request;

class CompetitionStandingsController extends Controller
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

    public function index($competition_id, $group = null, CompetitionService $service)
    {
        $competition = $service->findWithStandings($competition_id);
        return view('front.inc.standings', compact(['competition', 'group']));
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\CompetitionService;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }



    public function index(CompetitionService $service)
    {
    	$competitions = $service->getList();
    	return view('front.competitions', compact('competitions'));
    }

    public function show($id, CompetitionService $service)
    {
    	//$competition = $service->getCompetitionDetails($id);
    	$competition = $service->getCompetitionWithStandings($id);

    	return view('front.competition_details', compact('competition'));
    	
    }
}

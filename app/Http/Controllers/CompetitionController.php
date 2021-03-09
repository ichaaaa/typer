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
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(CompetitionService $service)
    {
    	$competitions = $service->findAll();
    	return view('front.competition.competitions', compact('competitions'));
    }

    public function show($id, CompetitionService $service)
    {
        $service->find($id);
    	return view('front.competition.competition_details', compact('competition'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\TeamService;
use Illuminate\Http\Request;

class TeamController extends Controller
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

    public function index(TeamService $service)
    {
    	$teams = $service->findAll();
    }

    public function show($id, TeamService $service)
    {
    	$team = $service->find($id);
    	return view('front.team.team_details', compact('team'));
    }
}

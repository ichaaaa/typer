<?php

namespace App\Http\Controllers;

use App\Services\TeamService;
use Illuminate\Http\Request;

class TeamMatchesController extends Controller
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

    public function index($id, TeamService $service)
    {
    	$matches = $service->findWithMatches($id);

    	return view('front.matches', compact('matches'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\PlayerService;
use Illuminate\Http\Request;

class PlayerMatchesController extends Controller
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

    public function index($id, PlayerService $service)
    {
    	$matches = $service->findWithMatches($id);

    	return view('front.inc.matches', compact('matches'));
    }
}

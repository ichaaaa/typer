<?php

namespace App\Http\Controllers;

use App\Objects\Game;
use App\Services\MatchService;
use Illuminate\Http\Request;

class MatchController extends Controller
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

    public function show($id, MatchService $service)
    {
        $match = $service->find($id);
        return view('front.match.match_details', compact('match'));
    }

    public function index( MatchService $service)
    {
        $matches = $service->findAll();
        $closestDate = Game::findClosestMatchDate(array_keys($matches));
        //dd($closestDate);
        return view('front.match.matches', compact('matches', 'closestDate'));
    }
}

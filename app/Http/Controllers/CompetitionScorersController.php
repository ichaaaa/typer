<?php

namespace App\Http\Controllers;

use App\Services\CompetitionService;
use Illuminate\Http\Request;

class CompetitionScorersController extends Controller
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

    public function index($competition_id, CompetitionService $service)
    {
        $scorers = $service->findWithScorers($competition_id);
        return view('front.scorers', compact('scorers'));
    }

}



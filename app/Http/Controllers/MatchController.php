<?php

namespace App\Http\Controllers;

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
    	//dd($match);
    	return view('front.match.match_details', compact('match'));
    }
}

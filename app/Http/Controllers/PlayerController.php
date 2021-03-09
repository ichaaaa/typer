<?php

namespace App\Http\Controllers;

use App\Services\PlayerService;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function show($id, PlayerService $service)
    {
    	$player = $service->find($id);

    	return view('front.player.player_details', compact('player'));
    }
}

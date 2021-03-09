<?php

namespace App\Http\Controllers;

use App\Services\CompetitionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailableTyperController extends Controller
{
    public function index(CompetitionService $service)
    {
    	$typers = Auth::user()->availableTypers();
    	return view('front.typer.available_typer_list', compact('typers', 'service'));
    }
}

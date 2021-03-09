<?php

namespace App\Http\Controllers;

use App\Services\CompetitionService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotConfirmedUserTyperController extends Controller
{
    public function index(CompetitionService $service)
    {

    	$typers = Auth::user()->notConfirmedTypers;
    	return view('front.typer.not_comfirmed_typer_list', compact('typers', 'service'));
    }
}

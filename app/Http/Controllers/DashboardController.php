<?php

namespace App\Http\Controllers;

use App\DataProvider;
use App\DataProviders\FootballData\FootballDataDataTransformer;
use App\DataProviders\FootballData\FootballDataWebServiceClient;
use App\Objects\Competition;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        dd(DataProvider::active()->firstOrFail()->id);
        $webClient = new FootballDataWebServiceClient();
        $transformer = new FootballDataDataTransformer();
        dd($transformer->transformToCompetitionScorers($webClient->getCompetitionScorers('PL')));
        return view('front.dashboard');
    }


    // public function store(Request $request)
    // {
    //     if ($request->user()->can('create-tasks')) {
    //         //Code goes here
    //     }
    // }

    // public function destroy(Request $request, $id)
    // {   
    //     if ($request->user()->can('delete-tasks')) {

    //     }
    // }
}

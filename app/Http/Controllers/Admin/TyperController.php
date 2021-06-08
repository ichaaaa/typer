<?php

namespace App\Http\Controllers\Admin;

use App\Bet;
use App\DataProvider;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTyperRequest;
use App\Services\CompetitionService;
use App\Typer;
use App\User;
use App\VisibilityType;
use Illuminate\Http\Request;

class TyperController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }	

	public function index(CompetitionService $service)
	{
		$typers = Typer::all();

		return view('admin.typers',compact(['typers','service']));
	}

	public function show(Typer $typer, CompetitionService $service)
	{
		$users = User::whereHas('roles',  function($query){
			return $query->where('slug', 'user');
		})->get();

		if($typer->visibility->private){
			return view('admin.private_typer_details', compact(['typer', 'service', 'users']));
		}else{
			return view('admin.public_typer_details', compact(['typer', 'service', 'users']));
		}
	}

	public function create(CompetitionService $service)
	{
		$competitions = $service->findAll();
		$visibilityTypes = VisibilityType::all();

		return view('admin.typer_create', compact(['competitions', 'visibilityTypes']));
	}

    public function store(StoreTyperRequest $request)
    {
    	Typer::create($request->all());
    	return redirect()->route('typer_list');
    }
}

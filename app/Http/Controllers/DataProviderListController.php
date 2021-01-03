<?php

namespace App\Http\Controllers;

use App\DataProvider;
use Illuminate\Http\Request;

class DataProviderListController extends Controller
{

    public function index()
    {
    	
    	$dataProviders = DataProvider::all();

    	return view('admin.data_provider_list', compact('dataProviders'));
    }
}

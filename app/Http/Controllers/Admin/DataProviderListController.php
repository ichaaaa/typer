<?php

namespace App\Http\Controllers\Admin;

use App\DataProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataProviderListController extends Controller
{

    public function index()
    {
    	
    	$dataProviders = DataProvider::all();

    	return view('admin.data_provider_list', compact('dataProviders'));
    }
}

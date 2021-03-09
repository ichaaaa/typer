<?php

namespace App\Http\Controllers\Admin;

use App\DataProvider;
use App\Http\Requests\DataProviderRequest;
use App\Http\Controllers\Controller;

class DataProviderController extends Controller
{
    public function update(DataProviderRequest $request)
    {
    	$data = $request->all();

    	$dataProvider = DataProvider::findOrFail($data['data_provider_id']);
    	$dataProvider->active = true;
    	$dataProvider->save();

    	return back();
    }
}

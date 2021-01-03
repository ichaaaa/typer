<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', 'DashboardController@index')->name('home');

Route::get('/roles', 'PermissionController@Permission');
Route::get('/competitions', 'CompetitionController@index');
Route::get('/competitions/{id}', 'CompetitionController@show')->name('show_competition_details');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:developer']], function() {
	Route::get('/data-provider-list', 'DataProviderListController@index');
	Route::post('/update-data-provider', 'DataProviderController@update')->name('update_data_provider');
});

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

//Route::get('/roles', 'PermissionController@Permission');

Route::group(['middleware' => ['auth', 'role:user']], function() {
	Route::get('/competitions', 'CompetitionController@index')->name('competitions_list');
	Route::get('/competitions/{id}', 'CompetitionMatchesController@index')->name('show_competition_details');
	Route::get('/competitions/{competition_id}/scorers', 'CompetitionScorersController@index')->name('scorers_list');
	Route::get('/competitions/{competition_id}/standigs/{group?}', 'CompetitionStandingsController@index')->name('competition_standings');
	//Route::get('/competitions/{competition_id}/matches', 'CompetitionMatchesController@index')->name('matches_list');
	Route::get('/teams/{id}', 'TeamController@show')->name('show_team_details');
	Route::get('/teams/{id}/matches', 'TeamMatchesController@index')->name('team_matches_list');

	Route::get('/players/{id}', 'PlayerController@show')->name('show_player_details');
	Route::get('/players/{id}/matches', 'PlayerMatchesController@index')->name('player_matches_list');

	Route::get('/matches', 'MatchController@index')->name('matches_list');
	Route::get('/matches/{id}', 'MatchController@show')->name('show_match_details');

	Route::get('/typer/accept-invitation/{typer}/{token}', 'Admin\UserInvitationController@update')->name('accept_invitation_to_typer');
	Route::get('/typer/invite/{typer}', 'Admin\UserInvitationController@show')->name('show_accepted_invitation_confirmation_to_typer');

	Route::get('/typer/available', 'AvailableTyperController@index')->name('available_for_user_typers_list');
	Route::get('/typer/not-confirmed', 'NotConfirmedUserTyperController@index')->name('not_confirmed_user_typers_list');
	Route::get('/typer', 'UserTyperController@index')->name('visible_for_user_typers_list');
	Route::get('/typer/{typer}', 'UserTyperController@show')->name('show_user_typer_details');

	Route::get('/typer/store/{typer}', 'UserTyperController@store')->name('user_typer_application');
	Route::get('/typer/verify/{typer}/{user}', 'Admin\UserVerificationController@store')->name('user_typer_verify');

	Route::get('/bet/create/{id}/typer/{typer}', 'BetController@create')->name('create_bet');
	Route::get('/bet/edit/{bet}', 'BetController@edit')->name('edit_bet');
	Route::post('/bet/store', 'BetController@store')->name('store_bet');
	Route::get('/bet/{match_id}/typer/{typer}', 'MatchBetController@index')->name('match_bet_list');
	Route::post('/bet/update', 'BetController@update')->name('update_bet');

});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function() {

	Route::get('/data-provider-list', 'Admin\DataProviderListController@index')->name('data_provider_list');
	Route::post('/update-data-provider', 'Admin\DataProviderController@update')->name('update_data_provider');

	Route::get('/typer', 'Admin\TyperController@index')->name('typer_list');
	Route::get('/typer/create', 'Admin\TyperController@create')->name('create_typer');
	Route::post('/typer/store', 'Admin\TyperController@store')->name('store_typer');
	Route::get('/typer/{typer}', 'Admin\TyperController@show')->name('show_typer_details');
	Route::get('/typer/{typer}/check_bets', 'Admin\TyperMatchBetResultController@index')->name('show_matches_without_bet_result');

	Route::get('/typer/invite/{typer}/{user}', 'Admin\UserInvitationController@store')->name('invite_user_to_typer');

	Route::get('/typer/ban/create/{typer}/{user}', 'Admin\BannedUserController@create')->name('ban_user_from_typer_form_create');
	Route::post('/typer/ban/store', 'Admin\BannedUserController@store')->name('save_banned_user_from_typer');

	Route::get('/typer/{typer}/match/{match_id}', 'Admin\TyperMatchBetResultController@store')->name('save_bet_results_for_match');

	Route::get('/typer/{typer}/ranking', 'TyperRankingController@index')->name('typer_ranking_list');


});



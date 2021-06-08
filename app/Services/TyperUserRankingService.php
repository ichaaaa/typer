<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class TyperUserRankingService
{

	public static function getRankingData($typer_id)
	{
    	return DB::table('users')->groupBy('users.id')
			->join('bets', 'bets.user_id', '=', 'users.id')
			->leftJoin('bets_results', 'bets_results.bet_id', '=', 'bets.id')
			->selectRaw('users.name, bets.user_id, bets.typer_id, bets.match_id, sum(bets_results.points) AS points, RANK() OVER( ORDER BY sum(bets_results.points) DESC ) AS position')
			->where('bets.typer_id', $typer_id)
			->orderBy('position', 'ASC')->get();

	}

}
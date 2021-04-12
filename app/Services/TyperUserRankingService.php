<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class TyperUserRankingService
{

	public static function getRankingData($typer_id)
	{
    	$ranking = DB::table('users')->groupBy('users.id')
			->join('bets', 'bets.user_id', '=', 'users.id')
			->join('bets_results', 'bets_results.bet_id', '=', 'bets.id')
			->selectRaw('users.name, bets.user_id, bets.typer_id, bets.match_id, sum(bets_results.points) AS points')
			->where('bets.typer_id', $typer_id)
			->orderBy('points', 'DESC');

			return $ranking->addSelect(DB::raw('RANK() OVER( ORDER BY points DESC ) AS `rank`'))->get();
	}

}
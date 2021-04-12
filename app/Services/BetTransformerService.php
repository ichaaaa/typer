<?php 

namespace App\Services;

use App\Bet;

class BetTransformerService
{

	public static function getArrayByMatch($typer_id, $user_id)
	{
		$bets = Bet::where('typer_id', $typer_id)->where('user_id', $user_id)->get();

		$array = [];

		foreach($bets as $bet)
		{
			$array[$typer_id][$user_id][$bet->match_id] = $bet;
		}

		return $array;
	}

	public static function getArrayByMatchWithResult($typer_id, $match_id)
	{
		$bets = Bet::with('betResult')->where('typer_id', $typer_id)->where('match_id', $match_id)->get();

		$array = [];

		foreach($bets as $bet)
		{
			$array[$match_id] = $bet;
		}

		return $array;
	}


}
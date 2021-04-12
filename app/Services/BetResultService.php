<?php

namespace App\Services;

use App\Bet;
use App\Objects\Game;

class BetResultService
{
	const HOME_TEAM = 'HOME_TEAM';
	const AWAY_TEAM = 'AWAY_TEAM';
	const DRAW = 'DRAW';

	private $match;
	private $bet;

	public function __construct(Game $match, Bet $bet)
	{
		$this->match = $match;
		$this->bet = $bet;
	}

	public function isExactScore(): bool
	{
		if($this->match->getFullTimeScore()->getHomeTeamScore() == $this->bet->home_team_score && $this->match->getFullTimeScore()->getAwayTeamScore() == $this->bet->away_team_score)
		{
			return true;
		}
		return false;
	}

	public function isWinningTeamPicked(): bool
	{
		if($this->match->getWinner() == self::DRAW && $this->bet->home_team_score == $this->bet->away_team_score)
		{
			return true;
		}
		else if($this->match->getWinner() == self::HOME_TEAM && $this->bet->home_team_score > $this->bet->away_team_score)
		{
			return true;
		}
		else if($this->match->getWinner() == self::AWAY_TEAM && $this->bet->home_team_score < $this->bet->away_team_score)
		{
			return true;
		}
		return false;
	}


	public function isExtraQuestionGuessed()
	{
		return false;
	}

	public function calculatePoints()
	{
		$points = 0;

		if($this->isExactScore())
		{
			$points += 3;
			if($this->bet->sure_thing)
			{
				$points += 1;
			}
		}
		else if($this->isWinningTeamPicked())
		{
			$points += 1;
			if($this->bet->sure_thing)
			{
				$points += 1;
			}
		}


		return $points;
	}

}
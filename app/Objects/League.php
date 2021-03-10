<?php 

namespace App\Objects;

use App\Objects\Game;

class League extends Competition
{
	protected $standings = [];
	protected $matches = [];


    public function addStanding(Standings $standing)
    {
        array_push($this->standings, $standing);
    }

    public function getStandings()
    {
        return $this->standings;
    }

    public function setStandings($standings)
    {
        $this->standings = $standings;
    }


	public function setMatches($matches)
	{
		$this->matches = $matches;
		return $this;
	}

	public function getMatches()
	{
		return $this->matches;
	}

	public function addMatch(Game $match)
	{
		array_push($this->matches, $match);
		return $this;
	}
}
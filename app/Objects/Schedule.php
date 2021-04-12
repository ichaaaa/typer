<?php

namespace App\Objects;

use App\Objects\Game;
use Carbon\Carbon;


class Schedule
{
	private $date;
	private $matches = [];

    /**
     * @return mixed
     */
    public function getDate()
    {
        return Carbon::parse($this->date)->format('Y.m.d');
    }

    /**
     * @param mixed $date
     *
     * @return self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * @param mixed $matches
     *
     * @return self
     */
	public function addMatch(Game $match)
	{
		array_push($this->matches, $match);
		return $this;
	}

}

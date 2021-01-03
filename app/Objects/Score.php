<?php 

namespace App\Objects;

class Score{
	private $homeTeamScore;
	private $awayTeamScore;

	

    /**
     * @return mixed
     */
    public function getHomeTeamScore()
    {
        return $this->homeTeamScore;
    }

    /**
     * @param mixed $homeTeamScore
     *
     * @return self
     */
    public function setHomeTeamScore($homeTeamScore)
    {
        $this->homeTeamScore = $homeTeamScore;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAwayTeamScore()
    {
        return $this->awayTeamScore;
    }

    /**
     * @param mixed $awayTeamScore
     *
     * @return self
     */
    public function setAwayTeamScore($awayTeamScore)
    {
        $this->awayTeamScore = $awayTeamScore;

        return $this;
    }
}
<?php 

namespace App\Objects;

class Head2head
{

	private $numberOfMatches;
	private $totalGoals;
	private $homeTeam;
	private $awayTeam;




    /**
     * @return mixed
     */
    public function getNumberOfMatches()
    {
        return $this->numberOfMatches;
    }

    /**
     * @param mixed $numberOfMatches
     *
     * @return self
     */
    public function setNumberOfMatches($numberOfMatches)
    {
        $this->numberOfMatches = $numberOfMatches;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalGoals()
    {
        return $this->totalGoals;
    }

    /**
     * @param mixed $totalGoals
     *
     * @return self
     */
    public function setTotalGoals($totalGoals)
    {
        $this->totalGoals = $totalGoals;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * @param mixed $homeTeam
     *
     * @return self
     */
    public function setHomeTeam($homeTeam)
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * @param mixed $awayTeam
     *
     * @return self
     */
    public function setAwayTeam($awayTeam)
    {
        $this->awayTeam = $awayTeam;

        return $this;
    }
}

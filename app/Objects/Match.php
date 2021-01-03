<?php 

namespace App\Objects;

use App\Objects\Score;
use App\Objects\Team;

class Match
{
	private $id;
	private $date;
	private $matchday;
    private $status;
	private $homeTeam;
	private $awayTeam;
	private $winner;
	private $fullTimeScore;
	private $halfTimeScore;
	private $extraTimeScore;
	private $penaltiesScore;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
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
    public function getMatchday()
    {
        return $this->matchday;
    }

    /**
     * @param mixed $matchday
     *
     * @return self
     */
    public function setMatchday($matchday)
    {
        $this->matchday = $matchday;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHomeTeam(): Team
    {
        return $this->homeTeam;
    }

    /**
     * @param mixed $homeTeam
     *
     * @return self
     */
    public function setHomeTeam(Team $homeTeam)
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAwayTeam(): Team
    {
        return $this->awayTeam;
    }

    /**
     * @param mixed $awayTeam
     *
     * @return self
     */
    public function setAwayTeam(Team $awayTeam)
    {
        $this->awayTeam = $awayTeam;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWinner(): Team 
    {
        return $this->winner;
    }

    /**
     * @param mixed $winner
     *
     * @return self
     */
    public function setWinner(Team $winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFullTimeScore(): Score
    {
        return $this->fullTimeScore;
    }

    /**
     * @param mixed $fullTimeScore
     *
     * @return self
     */
    public function setFullTimeScore(Score $fullTimeScore)
    {
        $this->fullTimeScore = $fullTimeScore;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHalfTimeScore(): Score
    {
        return $this->halfTimeScore;
    }

    /**
     * @param mixed $halfTimeScore
     *
     * @return self
     */
    public function setHalfTimeScore(Score $halfTimeScore)
    {
        $this->halfTimeScore = $halfTimeScore;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtraTimeScore(): Score
    {
        return $this->extraTimeScore;
    }

    /**
     * @param mixed $extraTimeScore
     *
     * @return self
     */
    public function setExtraTimeScore(Score $extraTimeScore)
    {
        $this->extraTimeScore = $extraTimeScore;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPenaltiesScore(): Score
    {
        return $this->penaltiesScore;
    }

    /**
     * @param mixed $penaltiesScore
     *
     * @return self
     */
    public function setPenaltiesScore(Score $penaltiesScore)
    {
        $this->penaltiesScore = $penaltiesScore;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}
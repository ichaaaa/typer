<?php 

namespace App\Objects;

use App\Objects\Team;

class Position
{
	private $positionNum;
	private $team;
	private $playedGames;
	private $form;
	private $won;
	private $lost;
	private $draw;
	private $points;
	private $goalsFor;
	private $goalsAgainst;
	private $goalDifference;

    /**
     * @return mixed
     */
    public function getPositionNum()
    {
        return $this->positionNum;
    }

    /**
     * @param mixed $positionNum
     *
     * @return self
     */
    public function setPositionNum($positionNum)
    {
        $this->positionNum = $positionNum;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeam(): Team
    {
        return $this->team;
    }

    /**
     * @param mixed $team
     *
     * @return self
     */
    public function setTeam(Team $team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlayedGames()
    {
        return $this->playedGames;
    }

    /**
     * @param mixed $playedGames
     *
     * @return self
     */
    public function setPlayedGames($playedGames)
    {
        $this->playedGames = $playedGames;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param mixed $form
     *
     * @return self
     */
    public function setForm($form)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWon()
    {
        return $this->won;
    }

    /**
     * @param mixed $won
     *
     * @return self
     */
    public function setWon($won)
    {
        $this->won = $won;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLost()
    {
        return $this->lost;
    }

    /**
     * @param mixed $lost
     *
     * @return self
     */
    public function setLost($lost)
    {
        $this->lost = $lost;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * @param mixed $draw
     *
     * @return self
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param mixed $points
     *
     * @return self
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGoalsFor()
    {
        return $this->goalsFor;
    }

    /**
     * @param mixed $goalsFor
     *
     * @return self
     */
    public function setGoalsFor($goalsFor)
    {
        $this->goalsFor = $goalsFor;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGoalsAgainst()
    {
        return $this->goalsAgainst;
    }

    /**
     * @param mixed $goalsAgainst
     *
     * @return self
     */
    public function setGoalsAgainst($goalsAgainst)
    {
        $this->goalsAgainst = $goalsAgainst;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGoalDifference()
    {
        return $this->goalDifference;
    }

    /**
     * @param mixed $goalDifference
     *
     * @return self
     */
    public function setGoalDifference($goalDifference)
    {
        $this->goalDifference = $goalDifference;

        return $this;
    }
}
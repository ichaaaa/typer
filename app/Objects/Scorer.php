<?php

namespace App\Objects;

class Scorer
{
	protected $player;
	protected $numberOfGoals;



    /**
     * @return mixed
     */
    public function getPlayer():Player
    {
        return $this->player;
    }

    /**
     * @param mixed $player
     *
     * @return self
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumberOfGoals()
    {
        return $this->numberOfGoals;
    }

    /**
     * @param mixed $numberOfGoals
     *
     * @return self
     */
    public function setNumberOfGoals($numberOfGoals)
    {
        $this->numberOfGoals = $numberOfGoals;

        return $this;
    }
}
<?php 

namespace App\Objects;

use App\Objects\Competition;

class Tournament extends Competition
{
	protected $stages = [];
	protected $standings = [];

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

	public function getStages()
    {
        return $this->stages;
    }

    public function addStage(Stage $stage)
    {
        if(!in_array($stage, $this->stages))
        {
            array_push($this->stages, $stage);
        }
    
        return $this;
    }

   	public function setStages($stages)
	{
		$this->stages = $stages;
	}
}
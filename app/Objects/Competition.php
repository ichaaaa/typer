<?php

namespace App\Objects;

use App\Objects\Scorer;
use App\Objects\Stage;
use App\Objects\Standings;
use Carbon\Carbon;

class Competition
{
	protected $id;
	protected $name;
	protected $teams = [];
	protected $area;
	protected $startDate;
	protected $endDate;
	protected $scorers = [];
	protected $matchday;
	protected $lastUpdated;
    protected $emblemURL;



	public function getId(): int
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	public function getName(): string
	{
		return $this->name;

	}

	public function setName(string $name)
	{
		$this->name = $name;
		return $this;
	}

	public function getStartDate()
	{
		return $this->startDate;
	}

	public function setStartDate($startDate)
	{
		$this->startDate = $startDate;
		return $this;
	}

	public function getEndDate()
	{
		return $this->endDate;
	}

	public function setEndDate($endDate)
	{
		$this->endDate = $endDate;
		return $this;
	}

	public function addTeam(Team $team)
	{
		array_push($this->teams, $team);
		return $this;
	}


	public function getTeams()
	{
		return $this->teams;
	}

	/**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param mixed $area
     *
     * @return self
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getScorers(): array
    {
        return $this->scorers;
    }

    /**
     * @param mixed $scorers
     *
     * @return self
     */
    public function addScorer(Scorer $scorer)
    {
    	array_push($this->scorers, $scorer);
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
    public function getLastUpdated()
    {
        return Carbon::parse($this->lastUpdated)->timezone('Europe/Warsaw')->format('Y-m-d H:i:s');
    }

    /**
     * @param mixed $lastUpdated
     *
     * @return self
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmblemURL(): ?string
    {
        return $this->emblemURL;
    }

    /**
     * @param mixed $emblemURL
     *
     * @return self
     */
    public function setEmblemURL($emblemURL)
    {
        $this->emblemURL = $emblemURL;

        return $this;
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
}
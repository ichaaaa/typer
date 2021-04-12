<?php 

namespace App\Objects;

use App\Bet;
use App\Objects\Competition;
use App\Objects\Score;
use App\Objects\Team;
use Carbon\Carbon;

class Game
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
    private $competition;
    private $head2head;
    private $typerUserBet;


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
        return Carbon::parse($this->date)->timezone('Europe/Warsaw')->format('Y.m.d H:i:s');
    }

    /**
     * @return mixed
     */
    public function getHour()
    {
        return Carbon::parse($this->date)->timezone('Europe/Warsaw')->format('H:i:s');
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
    public function getWinner() 
    {
        return $this->winner;
    }

    /**
     * @param mixed $winner
     *
     * @return self
     */
    public function setWinner($winner)
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

    /**
     * @return mixed
     */
    public function getCompetition(): Competition
    {
        return $this->competition;
    }

    /**
     * @param mixed $competition
     *
     * @return self
     */
    public function setCompetition(Competition $competition)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHead2head()
    {
        return $this->head2head;
    }

    /**
     * @param mixed $head2head
     *
     * @return self
     */
    public function setHead2head($head2head)
    {
        $this->head2head = $head2head;

        return $this;
    }

    public static function findClosestMatchDate(array $dates)
    {
        $now = Carbon::now()->format('Y-m-d');
        foreach($dates as $date)
        {
            if(Carbon::parse($date)->timezone('Europe/Warsaw') >= $now)
            {
                return $date;
            }
        }

        $lastElement = end($dates);
        return $lastElement;
    }

    public function setTyperUserBet($typer_id, $user_id)
    {
        $this->typerUserBet = Bet::where('typer_id', $typer_id)->where('user_id', $user_id)->where('match_id', $this->getId())->first();
    }

    public function getTyperUserBet()
    {
        return $this->typerUserBet;
    }
}
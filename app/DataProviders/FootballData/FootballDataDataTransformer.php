<?php

namespace App\DataProviders\FootballData;

use App\Contracts\DataTransformer;
use App\Objects\Competition;
use App\Objects\Group;
use App\Objects\Head2head;
use App\Objects\League;
use App\Objects\Game;
use App\Objects\Player;
use App\Objects\Position;
use App\Objects\Score;
use App\Objects\Scorer;
use App\Objects\Stage;
use App\Objects\Standings;
use App\Objects\Table;
use App\Objects\Team;
use App\Objects\Tournament;

class FootballDataDataTransformer implements DataTransformer
{

	public function transformToCompetitionsList($webServiceResponse): array
	{

		$output = [];
		foreach($webServiceResponse['competitions'] as $competition)
		{
			$obj = new Competition;
			$obj
				->setId($competition['id'])
				->setName($competition['name'])
				->setArea($competition['area']['name'])
				->setStartDate($competition['currentSeason']['startDate'])
				->setEndDate($competition['currentSeason']['startDate'])
				->setMatchday($competition['currentSeason']['currentMatchday'])
				->setLastUpdated($competition['lastUpdated'])
				->setEmblemURL($competition['emblemUrl']);
			$output[] = $obj;
		}

		return $output;
	}

	public function transformToCompetition($webServiceResponse): Competition
	{
		$competition = new Competition;
		$competition
			->setId($webServiceResponse['id'])
			->setName($webServiceResponse['name'])
			->setArea($webServiceResponse['area']['name'])
			->setStartDate($webServiceResponse['currentSeason']['startDate'])
			->setEndDate($webServiceResponse['currentSeason']['startDate'])
			->setMatchday($webServiceResponse['currentSeason']['currentMatchday'])
			->setLastUpdated($webServiceResponse['lastUpdated'])
			->setEmblemURL($webServiceResponse['emblemUrl']);

		return $competition;
	}

	public function transformToCompetitionTeams($webServiceResponse, Competition $competition): array
	{
		foreach($webServiceResponse['teams'] as $team)
		{
			$newTeam = new Team;
			$newTeam
				->setId($team['id'])
				->setName($team['name'])
				->setShortName($team['shortName'])
				->setCrestURL($team['crestUrl'])
				->setAddress($team['address'])
				->setWebsite($team['website'])
				->setFounded($team['founded'])
				->setVenue($team['venue']);

			$competition->addTeam($newTeam);
		}

		return $competition->getTeams();
	}

	public function transformToCompetitionStandings($webServiceResponse): Competition
	{

		$standings = [];
		foreach($webServiceResponse['standings'] as $standing)
		{
			$newStanding = new Standings;
			$newStanding
			->setStage($standing['stage'])
			->setType($standing['type'])
			->setGroup($standing['group']);
			$table = new Table;
			foreach($standing['table'] as $position)
			{
				$newPosition = new Position;
				$newTeam = new Team;
				$newTeam->setId($position['team']['id'])->setName($position['team']['name']);
				$newPosition
					->setPositionNum($position['position'])
					->setTeam($newTeam)
					->setPlayedGames($position['playedGames'])
					->setForm($position['form'])
					->setWon($position['won'])
					->setDraw($position['draw'])
					->setLost($position['lost'])
					->setPoints($position['points'])
					->setGoalsFor($position['goalsFor'])
					->setGoalsAgainst($position['goalsAgainst'])
					->setGoalDifference($position['goalDifference']);
				$table->addPosition($newPosition);
			}

			$newStanding->setTable($table);


			$standings[] = $newStanding;
			
		}

		$isLeague = false;
		foreach($standings as $standing){
			if($standing->getStage() == 'REGULAR_SEASON')
			{
				$isLeague = true;
				break;
			}
		}

		if($isLeague)
		{
			$competition = new League;
		}else
		{
			$competition = new Tournament;
		}

		$competition
			->setId($webServiceResponse['competition']['id'])
			->setName($webServiceResponse['competition']['name'])
			->setArea($webServiceResponse['competition']['area']['name'])
			->setStartDate($webServiceResponse['season']['startDate'])
			->setEndDate($webServiceResponse['season']['startDate'])
			->setMatchday($webServiceResponse['season']['currentMatchday'])
			->setLastUpdated($webServiceResponse['competition']['lastUpdated']);

		$competition->setStandings($standings);

		return $competition;
	}

	public function transformToCompetitionMatches($webServiceResponse): Competition
	{
		$stages = [];
		foreach($webServiceResponse['matches'] as $match)
		{
			$stage = new Stage;
			$stage->setCode($match['stage']);
			$stage->setName($match['group']);
			if(!in_array($stage, $stages))
			{
				$stages[$match['stage']][$match['group']] = $stage;
			}
		}

		//dd(array_keys($stages));
		
		if(count($stages) == 1 && array_keys($stages)[0] == 'REGULAR_SEASON'){
			$newCompetition = new League;
		}
		elseif(in_array( 'GROUP_STAGE', array_keys($stages)))
		{
			$newCompetition = new Tournament;
			foreach($stages as $code => $stage)
			{
				if($code == 'GROUP_STAGE')
				{	$newStage = new Stage;
					$newStage->setIsGroup(true);
					$newStage->setCode($code);
					foreach($stage as $name => $groupStage)
					{
						$newGroup = new Group;
						$newGroup->setName($groupStage->getName());
						$newStage->addGroup($newGroup);
					}
					$newCompetition->addStage($newStage);
				}else{
					$newCompetition->addStage(array_values($stage)[0]);
				}
			}
		}
		else
		{
			throw new \Exception("Competition cannot be initialized");
		}

		$newCompetition->setId($webServiceResponse['competition']['id']);
		$newCompetition->setName($webServiceResponse['competition']['name']);
		$newCompetition->setArea($webServiceResponse['competition']['area']['name']);

		$matches = [];
		foreach($webServiceResponse['matches'] as $match )
		{
			$newMatch = new Game();
			$homeTeam = new Team;
			$homeTeam->setId($match['homeTeam']['id'])->setName($match['homeTeam']['name']);
			$awayTeam = new Team;
			$awayTeam->setId($match['awayTeam']['id'])->setName($match['awayTeam']['name']);

			$newFullTimeScore = new Score;
			$newFullTimeScore->setHomeTeamScore($match['score']['fullTime']['homeTeam']);
			$newFullTimeScore->setAwayTeamScore($match['score']['fullTime']['awayTeam']);

			$newHalfTimeScore = new Score;
			$newHalfTimeScore->setHomeTeamScore($match['score']['halfTime']['homeTeam']);
			$newHalfTimeScore->setAwayTeamScore($match['score']['halfTime']['awayTeam']);

			$newExtraTimeScore = new Score;
			$newExtraTimeScore->setHomeTeamScore($match['score']['extraTime']['homeTeam']);
			$newExtraTimeScore->setAwayTeamScore($match['score']['extraTime']['awayTeam']);

			$newPenaltiesScore = new Score;
			$newPenaltiesScore->setHomeTeamScore($match['score']['penalties']['homeTeam']);
			$newPenaltiesScore->setAwayTeamScore($match['score']['penalties']['awayTeam']);

			$newMatch
				->setId($match['id'])
				->setDate($match['utcDate'])
				->setMatchday($match['matchday'])
				->setStatus($match['status'])
				->setHomeTeam($homeTeam)
				->setAwayTeam($awayTeam)
				->setFullTimeScore($newFullTimeScore)
				->setHalfTimeScore($newHalfTimeScore)
				->setExtraTimeScore($newExtraTimeScore)
				->setPenaltiesScore($newPenaltiesScore)
				->setCompetition($newCompetition);

			if($newCompetition instanceof League)
			{
				$newCompetition->addMatch($newMatch);
			}

			$matches[$match['stage']][$match['group']][] = $newMatch;
		}

		if($newCompetition instanceof Tournament)
		{
			foreach($newCompetition->getStages() as $stage)
			{	if($stage->getCode() == 'GROUP_STAGE'){
					$stage->setMatches($matches[$stage->getCode()]);
				}else{
					$stage->setMatches($matches[$stage->getCode()][$stage->getName()]);
				}

				
			}			
		}

		//dd($newCompetition);
		return $newCompetition;
	}

	public function transformToCompetitionScorers($webServiceResponse): Competition
	{

		$competition = new Competition;
		$competition->setId($webServiceResponse['competition']['id']);
		$competition->setName($webServiceResponse['competition']['name']);

		foreach($webServiceResponse['scorers'] as $scorer)
		{
			$newScorer = new Scorer;
			$newPlayer = new Player;
			$newTeam = new Team;

			$newTeam
				->setId($scorer['team']['id'])
				->setName($scorer['team']['name']);


			$newPlayer
				->setId($scorer['player']['id'])
				->setName($scorer['player']['name'])
				->setFirstName($scorer['player']['firstName'])
				->setLastName($scorer['player']['lastName'])
				->setDateOfBirth($scorer['player']['dateOfBirth'])
				->setCountryOfBirth($scorer['player']['countryOfBirth'])
				->setNationality($scorer['player']['nationality'])
				->setPosition($scorer['player']['position'])
				->setShirtNumber($scorer['player']['shirtNumber']);

			$newScorer
				->setPlayer($newPlayer)
				->setTeam($newTeam)
				->setNumberOfGoals($scorer['numberOfGoals']);

			$competition->addScorer($newScorer);
		}

		return $competition;
	}

	public function transformToMatchesList($webServiceResponse)
	{
		$output = [];

		foreach($webServiceResponse['matches'] as $match )
		{
			$newMatch = new Game;
			$homeTeam = new Team;
			$homeTeam->setId($match['homeTeam']['id'])->setName($match['homeTeam']['name']);
			$awayTeam = new Team;
			$awayTeam->setId($match['awayTeam']['id'])->setName($match['awayTeam']['name']);

			$newFullTimeScore = new Score;
			$newFullTimeScore->setHomeTeamScore($match['score']['fullTime']['homeTeam']);
			$newFullTimeScore->setAwayTeamScore($match['score']['fullTime']['awayTeam']);

			$newHalfTimeScore = new Score;
			$newHalfTimeScore->setHomeTeamScore($match['score']['halfTime']['homeTeam']);
			$newHalfTimeScore->setAwayTeamScore($match['score']['halfTime']['awayTeam']);

			$newExtraTimeScore = new Score;
			$newExtraTimeScore->setHomeTeamScore($match['score']['extraTime']['homeTeam']);
			$newExtraTimeScore->setAwayTeamScore($match['score']['extraTime']['awayTeam']);

			$newPenaltiesScore = new Score;
			$newPenaltiesScore->setHomeTeamScore($match['score']['penalties']['homeTeam']);
			$newPenaltiesScore->setAwayTeamScore($match['score']['penalties']['awayTeam']);

			$newCompetition = new Competition;
			$newCompetition->setId($match['competition']['id']);
			$newCompetition->setName($match['competition']['name']);
			$newMatch
				->setId($match['id'])
				->setDate($match['utcDate'])
				->setMatchday($match['matchday'])
				->setStatus($match['status'])
				->setHomeTeam($homeTeam)
				->setAwayTeam($awayTeam)
				->setFullTimeScore($newFullTimeScore)
				->setHalfTimeScore($newHalfTimeScore)
				->setExtraTimeScore($newExtraTimeScore)
				->setPenaltiesScore($newPenaltiesScore)
				->setCompetition($newCompetition);

			$output[] = $newMatch;
		}

		return $output;

	}

	public function transformToMatch($webServiceResponse): Match
	{
			$newMatch = new Game;

			$homeTeam = new Team;
			$homeTeam
				->setId($webServiceResponse['match']['homeTeam']['id'])
				->setName($webServiceResponse['match']['homeTeam']['name'])
				->setWins($webServiceResponse['head2head']['homeTeam']['wins'])
				->setDraws($webServiceResponse['head2head']['homeTeam']['draws'])
				->setLosses($webServiceResponse['head2head']['homeTeam']['losses'])
				;
			$awayTeam = new Team;
			$awayTeam
				->setId($webServiceResponse['match']['awayTeam']['id'])
				->setName($webServiceResponse['match']['awayTeam']['name'])
				->setWins($webServiceResponse['head2head']['awayTeam']['wins'])
				->setDraws($webServiceResponse['head2head']['awayTeam']['draws'])
				->setLosses($webServiceResponse['head2head']['awayTeam']['losses']);


			$newHead2head = new Head2head;
			$newHead2head
				->setNumberOfMatches($webServiceResponse['head2head']['numberOfMatches'])
				->setTotalGoals($webServiceResponse['head2head']['totalGoals'])
				->setHomeTeam($homeTeam)
				->setAwayTeam($awayTeam);				

			$newFullTimeScore = new Score;
			$newFullTimeScore->setHomeTeamScore($webServiceResponse['match']['score']['fullTime']['homeTeam']);
			$newFullTimeScore->setAwayTeamScore($webServiceResponse['match']['score']['fullTime']['awayTeam']);

			$newHalfTimeScore = new Score;
			$newHalfTimeScore->setHomeTeamScore($webServiceResponse['match']['score']['halfTime']['homeTeam']);
			$newHalfTimeScore->setAwayTeamScore($webServiceResponse['match']['score']['halfTime']['awayTeam']);

			$newExtraTimeScore = new Score;
			$newExtraTimeScore->setHomeTeamScore($webServiceResponse['match']['score']['extraTime']['homeTeam']);
			$newExtraTimeScore->setAwayTeamScore($webServiceResponse['match']['score']['extraTime']['awayTeam']);

			$newPenaltiesScore = new Score;
			$newPenaltiesScore->setHomeTeamScore($webServiceResponse['match']['score']['penalties']['homeTeam']);
			$newPenaltiesScore->setAwayTeamScore($webServiceResponse['match']['score']['penalties']['awayTeam']);

			$newCompetition = new Competition;
			$newCompetition->setId($webServiceResponse['match']['competition']['id']);
			$newCompetition->setName($webServiceResponse['match']['competition']['name']);

			$newMatch
				->setId($webServiceResponse['match']['id'])
				->setDate($webServiceResponse['match']['utcDate'])
				->setMatchday($webServiceResponse['match']['matchday'])
				->setStatus($webServiceResponse['match']['status'])
				->setHomeTeam($homeTeam)
				->setAwayTeam($awayTeam)
				->setFullTimeScore($newFullTimeScore)
				->setHalfTimeScore($newHalfTimeScore)
				->setExtraTimeScore($newExtraTimeScore)
				->setPenaltiesScore($newPenaltiesScore)
				->setCompetition($newCompetition)
				->setHead2head($newHead2head);

			return $newMatch;
	}

	public function transformToTeamMatches($webServiceResponse): array
	{
		$output = [];

		foreach($webServiceResponse['matches'] as $match )
		{
			$newMatch = new Game;
			$homeTeam = new Team;
			$homeTeam->setId($match['homeTeam']['id'])->setName($match['homeTeam']['name']);
			$awayTeam = new Team;
			$awayTeam->setId($match['awayTeam']['id'])->setName($match['awayTeam']['name']);

			$newFullTimeScore = new Score;
			$newFullTimeScore->setHomeTeamScore($match['score']['fullTime']['homeTeam']);
			$newFullTimeScore->setAwayTeamScore($match['score']['fullTime']['awayTeam']);

			$newHalfTimeScore = new Score;
			$newHalfTimeScore->setHomeTeamScore($match['score']['halfTime']['homeTeam']);
			$newHalfTimeScore->setAwayTeamScore($match['score']['halfTime']['awayTeam']);

			$newExtraTimeScore = new Score;
			$newExtraTimeScore->setHomeTeamScore($match['score']['extraTime']['homeTeam']);
			$newExtraTimeScore->setAwayTeamScore($match['score']['extraTime']['awayTeam']);

			$newPenaltiesScore = new Score;
			$newPenaltiesScore->setHomeTeamScore($match['score']['penalties']['homeTeam']);
			$newPenaltiesScore->setAwayTeamScore($match['score']['penalties']['awayTeam']);

			$newCompetition = new Competition;
			$newCompetition->setId($match['competition']['id']);
			$newCompetition->setName($match['competition']['name']);

			$newMatch
				->setId($match['id'])
				->setDate($match['utcDate'])
				->setMatchday($match['matchday'])
				->setStatus($match['status'])
				->setHomeTeam($homeTeam)
				->setAwayTeam($awayTeam)
				->setFullTimeScore($newFullTimeScore)
				->setHalfTimeScore($newHalfTimeScore)
				->setExtraTimeScore($newExtraTimeScore)
				->setPenaltiesScore($newPenaltiesScore)
				->setCompetition($newCompetition);

			$output[] = $newMatch;
		}

		return $output;
	}

	public function transformToTeam($webServiceResponse): Team
	{
		$newTeam = new Team;
		$newTeam
			->setId($webServiceResponse['id'])
			->setName($webServiceResponse['name'])
			->setShortName($webServiceResponse['shortName'])
			->setCrestURL($webServiceResponse['crestUrl'])
			->setAddress($webServiceResponse['address'])
			->setWebsite($webServiceResponse['website'])
			->setFounded($webServiceResponse['founded'])
			->setVenue($webServiceResponse['venue'])
			->setClubColors($webServiceResponse['clubColors']);

		foreach($webServiceResponse['squad'] as $player)
		{
			if($player['role'] == 'PLAYER'){
				$newPlayer = new Player;
				$newPlayer
					->setId($player['id'])
					->setName($player['name'])
					->setDateOfBirth($player['dateOfBirth'])
					->setCountryOfBirth($player['countryOfBirth'])
					->setNationality($player['nationality'])
					->setPosition($player['position'])
					->setShirtNumber($player['shirtNumber']);
			}
			$newTeam->addPlayer($newPlayer);	
		}

		foreach ($webServiceResponse['activeCompetitions'] as $competition) {
			if($competition['plan'] == config('app.api_keys.football_data.plan'))
			{
				$newCompetition = new Competition;
				$newCompetition
					->setId($competition['id'])
					->setName($competition['name'])
					->setLastUpdated($competition['lastUpdated'])
					->setArea($competition['area']['name']);
				$newTeam->addCompetition($newCompetition);
			}
		}
		return $newTeam;

	}

	public function transformToPlayer($webServiceResponse): Player
	{
		$newPlayer = new Player;
		$newPlayer
		->setId($webServiceResponse['id'])
		->setName($webServiceResponse['name'])
		->setFirstName($webServiceResponse['firstName'])
		->setLastName($webServiceResponse['lastName'])
		->setDateOfBirth($webServiceResponse['dateOfBirth'])
		->setCountryOfBirth($webServiceResponse['countryOfBirth'])
		->setNationality($webServiceResponse['nationality'])
		->setPosition($webServiceResponse['position'])
		->setShirtNumber($webServiceResponse['shirtNumber']);
		return $newPlayer;
	}

	public function transformToPlayerMatches($webServiceResponse): array
	{
		$output = [];

		foreach($webServiceResponse['matches'] as $match )
		{
			$newMatch = new Game;
			$homeTeam = new Team;
			$homeTeam->setId($match['homeTeam']['id'])->setName($match['homeTeam']['name']);
			$awayTeam = new Team;
			$awayTeam->setId($match['awayTeam']['id'])->setName($match['awayTeam']['name']);

			$newFullTimeScore = new Score;
			$newFullTimeScore->setHomeTeamScore($match['score']['fullTime']['homeTeam']);
			$newFullTimeScore->setAwayTeamScore($match['score']['fullTime']['awayTeam']);

			$newHalfTimeScore = new Score;
			$newHalfTimeScore->setHomeTeamScore($match['score']['halfTime']['homeTeam']);
			$newHalfTimeScore->setAwayTeamScore($match['score']['halfTime']['awayTeam']);

			$newExtraTimeScore = new Score;
			$newExtraTimeScore->setHomeTeamScore($match['score']['extraTime']['homeTeam']);
			$newExtraTimeScore->setAwayTeamScore($match['score']['extraTime']['awayTeam']);

			$newPenaltiesScore = new Score;
			$newPenaltiesScore->setHomeTeamScore($match['score']['penalties']['homeTeam']);
			$newPenaltiesScore->setAwayTeamScore($match['score']['penalties']['awayTeam']);

			$newCompetition = new Competition;
			$newCompetition->setId($match['competition']['id']);
			$newCompetition->setName($match['competition']['name']);

			$newMatch
				->setId($match['id'])
				->setDate($match['utcDate'])
				->setMatchday($match['matchday'])
				->setStatus($match['status'])
				->setHomeTeam($homeTeam)
				->setAwayTeam($awayTeam)
				->setFullTimeScore($newFullTimeScore)
				->setHalfTimeScore($newHalfTimeScore)
				->setExtraTimeScore($newExtraTimeScore)
				->setPenaltiesScore($newPenaltiesScore)
				->setCompetition($newCompetition);

			$output[] = $newMatch;
		}

		return $output;
	}
}
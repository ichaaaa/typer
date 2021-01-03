<?php

namespace App\DataProviders\FootballData;

use App\Contracts\DataTransformer;
use App\Objects\Competition;
use App\Objects\Match;
use App\Objects\Player;
use App\Objects\Position;
use App\Objects\Score;
use App\Objects\Scorer;
use App\Objects\Standings;
use App\Objects\Table;
use App\Objects\Team;

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
				->setLastUpdated($competition['lastUpdated']);
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
			->setLastUpdated($webServiceResponse['lastUpdated']);

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
		$competition = new Competition;
		$competition
			->setId($webServiceResponse['competition']['id'])
			->setName($webServiceResponse['competition']['name'])
			->setArea($webServiceResponse['competition']['area']['name'])
			->setStartDate($webServiceResponse['season']['startDate'])
			->setEndDate($webServiceResponse['season']['startDate'])
			->setMatchday($webServiceResponse['season']['currentMatchday'])
			->setLastUpdated($webServiceResponse['competition']['lastUpdated']);

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
			$competition->addStanding($newStanding);
		}

		return $competition;
	}

	public function transformToCompetitionMatches($webServiceResponse): array
	{
		$output = [];

		foreach($webServiceResponse['matches'] as $match )
		{
			$newMatch = new Match;
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
				->setPenaltiesScore($newPenaltiesScore);

			$output[] = $newMatch;
		}

		return $output;
	}

	public function transformToCompetitionScorers($webServiceResponse): array
	{

		$competition = new Competition;
		$competition->setId($webServiceResponse['competition']['id']);
		$competition->setName($webServiceResponse['competition']['name']);

		foreach($webServiceResponse['scorers'] as $scorer)
		{
			$newScorer = new Scorer;
			$newPlayer = new Player;
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
				->setNumberOfGoals($scorer['numberOfGoals']);
			$competition->addScorer($newScorer);
		}

		return $competition->getScorers();
	}

	public function transformToMatchesList($webServiceResponse)
	{
		$output = [];

		foreach($webServiceResponse['matches'] as $match )
		{
			$newMatch = new Match;
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
				->setPenaltiesScore($newPenaltiesScore);

			$output[] = $newMatch;
		}

		return $output;

	}

	public function transformToMatch($webServiceResponse): Match
	{
			$newMatch = new Match;
			$homeTeam = new Team;
			$homeTeam->setId($webServiceResponse['match']['homeTeam']['id'])->setName($webServiceResponse['match']['homeTeam']['name']);
			$awayTeam = new Team;
			$awayTeam->setId($webServiceResponse['match']['awayTeam']['id'])->setName($webServiceResponse['match']['awayTeam']['name']);

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
				->setPenaltiesScore($newPenaltiesScore);

			return $newMatch;
	}

	public function transformToTeamMatches($webServiceResponse): array
	{
		$output = [];

		foreach($webServiceResponse['matches'] as $match )
		{
			$newMatch = new Match;
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
				->setPenaltiesScore($newPenaltiesScore);

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
			->setVenue($webServiceResponse['venue']);
		return $newTeam;

	}

	public function transformToPlayer($webServiceResponse): Player
	{
		$newPlayer = new Player;
		$newPlayer
		->setId($scorer['id'])
		->setName($scorer['name'])
		->setFirstName($scorer['firstName'])
		->setLastName($scorer['lastName'])
		->setDateOfBirth($scorer['dateOfBirth'])
		->setCountryOfBirth($scorer['countryOfBirth'])
		->setNationality($scorer['nationality'])
		->setPosition($scorer['position'])
		->setShirtNumber($scorer['shirtNumber']);
		return $newPlayer;
	}

	public function transformToPlayerMatcher($webServiceResponse): array
	{
		$output = [];

		foreach($webServiceResponse['matches'] as $match )
		{
			$newMatch = new Match;
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
				->setPenaltiesScore($newPenaltiesScore);

			$output[] = $newMatch;
		}

		return $output;
	}
}
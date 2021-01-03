<?php

namespace App\Contracts;

use App\Objects\Competition;
use App\Objects\Match;
use App\Objects\Player;
use App\Objects\Standings;
use App\Objects\Team;

interface DataTransformer
{
	public function transformToCompetitionsList($webServiceResponse): array;

	public function transformToCompetition($webServiceResponse): Competition;

	public function transformToCompetitionTeams($webServiceResponse, Competition $competition): array;

	public function transformToCompetitionStandings($webServiceResponse): Competition;

	public function transformToCompetitionMatches($webServiceResponse): array;

	public function transformToCompetitionScorers($webServiceResponse): array;

	public function transformToMatchesList($webServiceResponse);

	public function transformToMatch($webServiceResponse): Match;

	public function transformToTeamMatches($webServiceResponse): array;

	public function transformToTeam($webServiceResponse): Team;

	public function transformToPlayer($webServiceResponse): Player;

	public function transformToPlayerMatcher($webServiceResponse): array;

}
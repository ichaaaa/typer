<?php

namespace App\Contracts;

use App\Objects\Competition;
use App\Objects\Game;
use App\Objects\Player;
use App\Objects\Standings;
use App\Objects\Team;

interface DataTransformer
{
	public function transformToCompetitionsList($webServiceResponse): array;

	public function transformToCompetition($webServiceResponse): Competition;

	public function transformToCompetitionTeams($webServiceResponse, Competition $competition): array;

	public function transformToCompetitionStandings($webServiceResponse): Competition;

	public function transformToCompetitionMatches($webServiceResponse): Competition;

	public function transformToCompetitionMatchesArray($webServiceResponse): array;

	public function transformToCompetitionScorers($webServiceResponse): Competition;

	public function transformToMatchesList($webServiceResponse);

	public function transformToMatch($webServiceResponse): Game;

	public function transformToTeamMatches($webServiceResponse): array;

	public function transformToTeam($webServiceResponse): Team;

	public function transformToPlayer($webServiceResponse): Player;

	public function transformToPlayerMatches($webServiceResponse): array;

}
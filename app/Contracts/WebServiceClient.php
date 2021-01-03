<?php 

namespace App\Contracts;

interface WebServiceClient
{
	public function getCompetitionsList();

	public function getCompetition($id);

	public function getCompetitionTeams($competition_id, array $params = []);

	public function getCompetitionStanding($competition_id, array $params = []);

	public function getCompetitionMatches($competition_id, array $params = []);

	public function getCompetitionScorers($competition_id, array $params = []);

	public function getAllMatches(array $params = []);

	public function getMatch($id);

	public function getTeamMatches($id, array $params = []);

	public function getTeam($id);

	public function getPlayer($id);

	public function getPlayerMatches($id, array $params = []);

}
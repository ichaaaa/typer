<?php 

namespace App\Services;

use App\Services\DataProviderService;

class TeamService extends DataProviderService
{

	public function find($id)
	{
		return $this->dataTransformer->transformToTeam($this->webServiceClient->getTeam($id));
	}

	public function findWithMatches($id)
	{
		return $this->dataTransformer->transformToTeamMatches($this->webServiceClient->getTeamMatches($id));
	}

}
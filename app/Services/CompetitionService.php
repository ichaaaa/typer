<?php 

namespace App\Services;

use App\Services\DataProviderService;

class CompetitionService extends DataProviderService
{

	public function getList()
	{
		return $this->dataTransformer->transformToCompetitionsList($this->webServiceClient->getCompetitionsList());
	}

	public function getCompetitionDetails($id)
	{
		return $this->dataTransformer->transformToCompetition($this->webServiceClient->getCompetition($id));
	}

	public function getCompetitionWithStandings($id)
	{
		return $this->dataTransformer->transformToCompetitionStandings($this->webServiceClient->getCompetitionStanding($id));
	}


}
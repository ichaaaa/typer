<?php 

namespace App\Services;

use App\Objects\Game;
use App\Services\DataProviderService;


class MatchService extends DataProviderService
{
	public function findAll()
	{
		return $this->dataTransformer->transformToMatchesList($this->webServiceClient->getAllMatches());
	}

	public function find($id): Game
	{
		return $this->dataTransformer->transformToMatch($this->webServiceClient->getMatch($id));
	}	
}
<?php 

namespace App\Services;

use App\Objects\Match;
use App\Services\DataProviderService;


class MatchService extends DataProviderService
{
	public function findAll()
	{
		return $this->dataTransformer->transformToMatchesList($this->webServiceClient->getAllMatches());
	}

	public function find($id): Match
	{
		return $this->dataTransformer->transformToMatch($this->webServiceClient->getMatch($id));
	}	
}
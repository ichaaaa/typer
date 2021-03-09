<?php 

namespace App\Services;

use App\Services\DataProviderService;

class PlayerService extends DataProviderService
{
	public function find($id)
	{
		return $this->dataTransformer->transformToPlayer($this->webServiceClient->getPlayer($id));
	}

	public function findWithMatches($id)
	{
		return $this->dataTransformer->transformToPlayerMatches($this->webServiceClient->getPlayerMatches($id));
	}
}
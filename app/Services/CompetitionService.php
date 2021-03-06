<?php 

namespace App\Services;

use App\Objects\Competition;
use App\Objects\Schedule;
use App\Services\DataProviderService;
use App\Services\GroupByDateTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class CompetitionService extends DataProviderService
{

	use GroupByDateTrait;

	public function findAll()
	{

		return Cache::remember('competitions', 1440, function () {
			return $this->dataTransformer->transformToCompetitionsList($this->webServiceClient->getCompetitionsList());
        });
	}

	public function find($id): Competition
	{
		return $this->dataTransformer->transformToCompetition($this->webServiceClient->getCompetition($id));
	}

	public function findWithStandings($id): Competition
	{
		return $this->dataTransformer->transformToCompetitionStandings($this->webServiceClient->getCompetitionStanding($id));
	}

	public function findWithScorers($id)
	{
		return $this->dataTransformer->transformToCompetitionScorers($this->webServiceClient->getCompetitionScorers($id));
	}

	public function findWithMatches($id)
	{
		return $this->dataTransformer->transformToCompetitionMatches($this->webServiceClient->getCompetitionMatches($id));
	}

	public function findWithMatchesByDate($id)
	{
		$matches = $this->dataTransformer->transformToCompetitionMatchesArray($this->webServiceClient->getCompetitionMatches($id));

		return $this->groupByDate($matches);
	}

}
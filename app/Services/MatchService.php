<?php 

namespace App\Services;

use App\Objects\Game;
use App\Services\DataProviderService;
use App\Services\GroupByDateTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;


class MatchService extends DataProviderService
{

	use GroupByDateTrait;

	public function findAll()
	{
		$matches = $this->dataTransformer->transformToMatchesList($this->webServiceClient->getAllMatches(['dateFrom' => Carbon::now()->timezone('Europe/Warsaw')->subDays(5)->format('Y-m-d'), 'dateTo' => Carbon::now()->timezone('Europe/Warsaw')->addDays(5)->format('Y-m-d')]));
		//dd();
		return $this->groupByDate($matches);
	}

	public function find($id): Game
	{

		return Cache::remember('match:'.$id, 60, function () use ($id) {
			return $this->dataTransformer->transformToMatch($this->webServiceClient->getMatch($id));
        });		
		
	}
}
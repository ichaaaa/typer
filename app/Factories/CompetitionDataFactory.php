<?php 

namespace App\Factories;

use App\DataProvider;
use App\DataProviders\FootballData\FootballDataManager;

class CompetitionDataFactory
{

	const FOOTBALL_DATA = 1;

	public static function make(DataProvider $dataProvider)
	{
		if($dataProvider->const_id === self::FOOTBALL_DATA)
		{
			return new FootballDataManager();
		}
		else
		{
			throw new \Exception("Data provider not found");
		}
	}

}
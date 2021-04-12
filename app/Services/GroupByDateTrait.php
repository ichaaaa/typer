<?php

namespace App\Services;

use Carbon\Carbon;

trait GroupByDateTrait
{
	public function groupByDate(array $array)
	{
		$dates = [];

		foreach($array as $match)
		{
			$dates[Carbon::createFromFormat('Y.m.d H:i:s', $match->getDate())->timezone('Europe/Warsaw')->format('Y-m-d')][] = $match;
		}
		ksort($dates);
		return $dates;
	}

}
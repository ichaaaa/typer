<?php

namespace App\Services;

use App\ExtraQuestion;

class ExtraQuestionTransformerService
{
	public static function getArrayByTyper($typer_id)
	{
		$questions = ExtraQuestion::where('typer_id', $typer_id)->get();

		$array = [];

		foreach($questions as $question)
		{
			$array[$question->match_id] = $question;
		}

		return $array;
	}
}
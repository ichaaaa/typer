<?php

namespace App\Factories;

use App\ExtraQuestionType;
use App\Helpers\ExtraQuestionHelpers\ChoiceQuestionBuilder;
use App\Helpers\ExtraQuestionHelpers\DescriptiveQuestionBuilder;
use App\Helpers\ExtraQuestionHelpers\RangeQuestionBuilder;


class ExtraQuestionFactory
{

	const DESCRIPTIVE = 'Opisowe';
	const CHOICE = 'Do wyboru';
	const RANGE = 'Zakres';

	public static function make(ExtraQuestionType $type)
	{
		if($type->type == self::DESCRIPTIVE)
		{
			return new DescriptiveQuestionBuilder;
		}elseif ($type->type == self::CHOICE)
		{
			return new ChoiceQuestionBuilder;
		}elseif ($type->type == self::RANGE) 
		{
			return new RangeQuestionBuilder;
		}else
		{
			throw new \Exception("Nie znaleziono typu", 1);
		}
	}
}
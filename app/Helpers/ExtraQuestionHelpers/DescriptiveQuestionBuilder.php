<?php

namespace App\Helpers\ExtraQuestionHelpers;

use App\Contracts\QuestionBuilderContract;

class DescriptiveQuestionBuilder implements QuestionBuilderContract
{
	

	public function renderHtml()
	{
		return 'Pytanie opisowe nie wymaga dotatkowych ustawień';
	}

	public function renderJs()
	{
		return '
			<script>

			</script>


		';
	}
}
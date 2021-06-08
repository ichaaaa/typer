<?php

namespace App\Helpers\ExtraQuestionHelpers;

use App\Contracts\QuestionBuilderContract;

class RangeQuestionBuilder implements QuestionBuilderContract
{
	

	public function renderHtml()
	{
		return '
		<div class="form-group ">
	        <label for="answer" class="form-label">Określ długość przedziału</label>
				<input class="form-control" name="answer" type="text" value="" id="answer">
			<span></span>
	  	</div>
        ';
	}

	public function renderJs()
	{
		return '<script>
			
		</script>';
	}
}
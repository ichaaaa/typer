<?php

namespace App\Helpers\ExtraQuestionHelpers;

use App\Contracts\QuestionBuilderContract;

class ChoiceQuestionBuilder implements QuestionBuilderContract
{

	public function renderHtml()
	{
		return '<div class="form-group"><label class="form-label" for="answer">Możliwa Odpowiedź</label>
				<div class="input-group">
	                <input type="text" class="form-control" name="answer[]">
	                <div class="input-group-append">
	                    <button class="btn btn-primary waves-effect waves-themed button-addon" type="button"><i class="fal fa-plus"></i></button>
	                </div>
	            </div>
	            <span></span>
</div>
	            ';
	}

	public function renderJs()
	{
		return''
		;
	}
}
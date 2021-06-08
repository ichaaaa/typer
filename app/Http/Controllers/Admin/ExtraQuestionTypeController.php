<?php

namespace App\Http\Controllers\Admin;

use App\ExtraQuestionType;
use App\Factories\ExtraQuestionFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExtraQuestionTypeController extends Controller
{
    public function create(ExtraQuestionType $type)
    {
    	$builder = ExtraQuestionFactory::make($type);
    	$html = $builder->renderHtml();
    	$js = $builder->renderJs();

    	return view('admin.create_extra_question_type_field', compact('html', 'js'));

    }
}

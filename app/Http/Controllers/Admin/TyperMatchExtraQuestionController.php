<?php

namespace App\Http\Controllers\Admin;

use App\ExtraQuestion;
use App\ExtraQuestionChoice;
use App\ExtraQuestionType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExtraQuestionRequest;
use App\Range;
use App\Typer;
use Illuminate\Http\Request;

class TyperMatchExtraQuestionController extends Controller
{
    public function create(Typer $typer, $match_id)
    {
    	$questionTypes = ExtraQuestionType::all();

    	return view('admin.create_extra_question', compact('questionTypes', 'typer', 'match_id'));
    }

    public function edit(ExtraQuestion $question)
    {
    	return view('admin.edit_extra_question', compact('question'));
    }

    public function store(Typer $typer, $match_id, StoreExtraQuestionRequest $request)
    {
    	$data = $request->all();

    	$question = new ExtraQuestion;
    	$question->description = $data['description'];
    	$question->typer_id = $typer->id;
    	$question->match_id = $match_id;
    	$question->description = $data['description'];
    	$question->helper = $data['helper'];
    	$question->question_type_id = $data['question_type_id'];
    	$question->save();

    	if( array_key_exists('answer', $data))
    	{
    		if(is_array($data['answer']))
    		{
	    		foreach($data['answer'] as $k => $v)
	    		{
	    			ExtraQuestionChoice::create([
	    				'extra_question_id' => $question->id,
	    				'choice' => $v,
	    			]);
	    		}
    		}else
    		{
    			Range::create([
    				'extra_question_id' => $question->id,
    				'value' => $data['answer'],
    			]);
    		}
    	}


	    $response = array(
          'status' => 'success',
          'msg' => 'Pytanie dodane',
      	);

    	return response()->json($response); 
    }


    public function update(ExtraQuestion $question, Request $request)
    {
    	$question->update($request->only(['description', 'helper']));


    	$response = array(
          'status' => 'success',
          'msg' => 'Pytanie dodane',
      	);

		return response()->json($response);    	
    }

    public function destroy(ExtraQuestion $question)
    {
    	$question->delete();

    	$response = array(
          'status' => 'success',
          'msg' => 'Pytanie dodane',
      	);

		return response()->json($response); 

    }


}

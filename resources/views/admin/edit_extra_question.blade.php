{!! Form::open(['route' => ['update_match_question', $question], 'id'=>'question_edit_form']) !!}
	<div class="form-group @error('description') alert alert-danger @enderror">
        {{ Form::label('description', 'Treść', ['class'=>'form-label']) }}
			{{ Form::text('description', $question->description, ['class'=>'form-control']) }}
		    <span></span>
  	</div>
	<div class="form-group @error('helper') alert alert-danger @enderror">
        {{ Form::label('helper', 'Podpowiedź', ['class'=>'form-label']) }}
			{{ Form::text('helper', $question->helper, ['class'=>'form-control']) }}
		<span></span>
  	</div>
  	{{ Form::button('Zapisz', array('type'=>'submit', 'id'=>'update-question-button', 'class' => 'btn btn-primary btn-lg btn-block waves-effect waves-themed')) }}
  	{{ Form::button('Usuń', array('type'=>'submit', 'id'=>'delete-question-button', 'question_id'=>$question->id, 'class' => 'btn btn-danger btn-lg btn-block waves-effect waves-themed')) }}
{!! Form::close() !!}
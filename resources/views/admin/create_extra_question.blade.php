{!! Form::open(['route' => ['store_match_question', $typer, $match_id], 'id'=>'question_create_form']) !!}
	<div class="form-group @error('description') alert alert-danger @enderror">
        {{ Form::label('description', 'Treść', ['class'=>'form-label']) }}
			{{ Form::text('description', '', ['class'=>'form-control']) }}

		    <span></span>

  	</div>
	<div class="form-group @error('helper') alert alert-danger @enderror">
        {{ Form::label('helper', 'Podpowiedź', ['class'=>'form-label']) }}
			{{ Form::text('helper', '', ['class'=>'form-control']) }}

		<span></span>

  	</div>
	<div class="form-group @error('question_type_id') alert alert-danger @enderror">
        {{ Form::label('question_type_id', 'Typ pytania', ['class'=>'form-label']) }}
		  <select class="form-control question-type" name="question_type_id">
			<option value="">- Wybierz -</option>
            @foreach($questionTypes as $type)
            <option value="{{$type->id}}">{{$type->type}}</option>
            @endforeach
        </select>

		<span></span>

  	</div>

  	<div class="form-group question-type-details">

  	</div>
  	{{ Form::button('Zapisz', array('type'=>'submit', 'id'=>'store-question-button', 'class' => 'btn btn-primary btn-lg btn-block waves-effect waves-themed')) }}
{!! Form::close() !!}
{!! Form::open(['route' => 'save_banned_user_from_typer', 'method' => 'post']) !!}
	{{ Form::hidden('typer_id', $typer->id) }}
	{{ Form::hidden('user_id', $user->id) }}
	<div class="form-group @error('banning-reason') alert alert-danger @enderror">
        {{ Form::label('banning-reason', 'Powód zbanowania') }}
			<textarea class="form-control" id="banning-reason" name="banning-reason" rows="5"></textarea>
		@error('banning-reason')
		    <span>{{ $message }}</span>
		@enderror
  	</div>
  	{{ Form::button('Zapisz', array('type'=>'submit', 'class' => 'btn btn-primary btn-lg btn-block waves-effect waves-themed')) }}
{!! Form::close() !!}
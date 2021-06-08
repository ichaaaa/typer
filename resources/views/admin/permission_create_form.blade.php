{!! Form::open(['route' => ['permission_store'], 'method' => 'post', 'id'=>'permission_create_form']) !!}
	<div class="form-group @error('name') alert alert-danger @enderror">
        {{ Form::label('name', 'Nazwa', ['class'=>'form-label']) }}
			{{ Form::text('name', '', ['class'=>'form-control']) }}

		    <span></span>

  	</div>
	<div class="form-group @error('roles') alert alert-danger @enderror">
        {{ Form::label('roles', 'Role', ['class'=>'form-label']) }}
		<select class="select2 form-control select2-hidden-accessible" multiple="" name="roles[]" id="multiple-basic"  tabindex="-1" aria-hidden="true">
            @foreach($roles as $role)
            <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>

		    <span></span>

  	</div>
  	{{ Form::button('Zapisz', array('type'=>'submit', 'id'=>'store-permission-button', 'class' => 'btn btn-primary btn-lg btn-block waves-effect waves-themed')) }}
{!! Form::close() !!}
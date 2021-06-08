{!! Form::open(['route' => ['user_update', $user->id], 'method' => 'post', 'id'=>'user_update_form']) !!}
	<div class="form-group @error('name') alert alert-danger @enderror">
        {{ Form::label('name', 'Nazwa', ['class'=>'form-label']) }}
			{{ Form::text('name', $user->name, ['class'=>'form-control']) }}

		    <span></span>

  	</div>
	<div class="form-group @error('roles') alert alert-danger @enderror">
        {{ Form::label('roles', 'Role', ['class'=>'form-label']) }}
		<select class="select2 form-control select2-hidden-accessible" multiple="" name="roles[]" id="multiple-basic"  tabindex="-1" aria-hidden="true">
            @foreach($roles as $role)
            <option @if($user->hasRole($role->slug)) selected @endif value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>

		    <span></span>

  	</div>

	<div class="form-group @error('permissions') alert alert-danger @enderror">
        {{ Form::label('permissions', 'Uprawnienia', ['class'=>'form-label']) }}
		<select class="select22 form-control select2-hidden-accessible" multiple="" name="permissions[]" id="multiple-basic-2"  tabindex="-1" aria-hidden="true">
            @foreach($permissions as $permission)
            <option @if($user->hasPermission($permission)) selected @endif value="{{$permission->id}}">{{$permission->name}}</option>
            @endforeach
        </select>
		@error('name')
		    <span>{{ $message }}</span>
		@enderror
  	</div>
  	{{ Form::button('Zapisz', array('type'=>'submit', 'id'=>'update-user-button', 'class' => 'btn btn-primary btn-lg btn-block waves-effect waves-themed')) }}
{!! Form::close() !!}
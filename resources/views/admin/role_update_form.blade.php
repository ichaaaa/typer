{!! Form::open(['route' => ['role_update', $role->id], 'method' => 'post', 'id'=>'role_update_form']) !!}
	<div class="form-group @error('name') alert alert-danger @enderror">
        {{ Form::label('name', 'Nazwa', ['class'=>'form-label']) }}
			{{ Form::text('name', $role->name, ['class'=>'form-control']) }}

		    <span></span>

  	</div>
	<div class="form-group @error('permissions') alert alert-danger @enderror">
        {{ Form::label('permissions', 'Uprawnienia', ['class'=>'form-label']) }}
		<select class="select2 form-control select2-hidden-accessible" multiple="" name="permissions[]" id="multiple-basic"  tabindex="-1" aria-hidden="true">
            @foreach($permissions as $permission)
            <option @if($role->permissions->contains($permission)) selected @endif value="{{$permission->id}}">{{$permission->name}}</option>
            @endforeach
        </select>

		    <span></span>

  	</div>
  	{{ Form::button('Zapisz', array('type'=>'submit', 'id'=>'update-role-button', 'class' => 'btn btn-primary btn-lg btn-block waves-effect waves-themed')) }}
{!! Form::close() !!}
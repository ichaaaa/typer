<form id="edit-bet-form">
 {{ csrf_field() }}
<input type="hidden" name="bet_id" value="{{$bet->id}}">

<div class="row">
    <div class="col-6 form-group">
        <div class="@error('home_team_score') alert alert-danger @enderror">
            {{ Form::label('home_team_score', $match->getHomeTeam()->getName(), ['class' => 'form-label']) }}
            {{ Form::text('home_team_score',$bet->home_team_score, ['class'=>'form-control'])}}

                <span></span>

        </div>
    </div>

    <div class="col-6 form-group">
        <div class=" @error('away_team_score') alert alert-danger @enderror">
            {{ Form::label('away_team_score', $match->getAwayTeam()->getName(), ['class' => 'form-label']) }}
            {{ Form::text('away_team_score',$bet->away_team_score,['class'=>'form-control'])}}

                <span></span>

        </div>
    </div>

</div>
<div class="row form-group">

    <div class="col-sm-12 ">
        <div class="@error('sure_thing') alert alert-danger @enderror">
            <div class="custom-control custom-switch">
                <input type="checkbox" @if($bet->sure_thing == 1) checked @endif class="custom-control-input" name="sure_thing" id="sure_thing" >
                <label class="custom-control-label form-label" for="sure_thing">Pewniak</label>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-12">
        {{ Form::button('Zapisz', array('type'=>'submit', 'id'=>'update-bet-button', 'class' => 'btn btn-primary btn-lg btn-block waves-effect waves-themed')) }}        
    </div>
</div>

</form>

<table id="dt-bets" class="table table-bordered table-hover table-striped w-100">
    <thead>
        <tr>
            <th>Użytkownika</th>
            <th>Wynik</th>
            <th>Pewniak</th>
            <th>Pytanie</th>

        </tr>
    </thead>
    <tbody>

    	@foreach($bets as $bet)
    		<tr>
    			<td>{{$bet->user->name}}</td>
    			<td>{{$bet->home_team_score}} : {{$bet->away_team_score}}</td>
    			<td>{{$bet->sure_thing}}</td>
    			<td></td>
    		</tr>
    	@endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Użytkownika</th>
            <th>Wynik</th>
            <th>Pewniak</th>
            <th>Pytanie</th>
        </tr>
    </tfoot>
</table>
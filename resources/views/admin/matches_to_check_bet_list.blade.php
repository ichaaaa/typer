<table id="dt-matches-to-check" class="table table-bordered table-hover table-striped w-100">
    <thead>
        <tr>
            <th>Data</th>
            <th>Rozgrywki</th>
            <th>Gospodarz</th>
            <th>Gość</th>
            <th>Wynik</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    	@forelse($matches as $match)
    	<tr>
    		<td>{{$match->getDate()}}</td>
            <td><a class="nav-link" href="{{route('show_competition_details',['id' => $match->getCompetition()->getId()])}}">{{$match->getCompetition()->getName()}}</a></td>
    		<td><a class="nav-link" href="{{route('show_team_details',['id' => $match->getHomeTeam()->getId()])}}" >{{$match->getHomeTeam()->getName()}}</a></td>
    		<td><a class="nav-link" href="{{route('show_team_details',['id' => $match->getAwayTeam()->getId()])}}" >{{$match->getAwayTeam()->getName()}}</a></td>
    		<td>{{$match->getFullTimeScore()->getHomeTeamScore()}} : {{$match->getFullTimeScore()->getAwayTeamScore()}}</td>
    		<td>{{$match->getStatus()}}</td>
            <td><a class="btn btn-primary btn-lg active" role="button" href="{{route('save_bet_results_for_match',['typer' => $typer, 'match_id'=>$match->getId()])}}" >Sprawdź typy</a></td>
    	</tr>
    	@empty

    	@endforelse

    </tbody>
    <tfoot>
        <tr>
            <th>Data</th>
            <th>Rozgrywki</th>
            <th>Gospodarz</th>
            <th>Gość</th>
            <th>Wynik</th>
            <th>Status</th>
            <th></th>
        </tr>
    </tfoot>
</table>
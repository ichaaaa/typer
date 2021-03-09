<table id="dt-matches" class="table table-bordered table-hover table-striped w-100">
    <thead>
        <tr>
            <th>Data</th>
            <th>Rozgrywki</th>
            <th>Gospodarz</th>
            <th>Gość</th>
            <th>Wynik</th>
            <th>Status</th>
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
        </tr>
    </tfoot>
</table>
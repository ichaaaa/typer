<table id="dt-scorers" class="table table-bordered table-hover table-striped w-100">
    <thead>
        <tr>
            <th>Position</th>
            <th>Name</th>
            <th>Team</th>
            <th>Number Of Goals</th>

        </tr>
    </thead>
    <tbody>
    	@forelse($scorers->getScorers() as $scorer)
        <tr>
            <th>{{$loop->iteration}}</th>
            <th><a href="{{route('show_player_details', ['id' => $scorer->getPlayer()->getId()])}}" class="nav-link">{{$scorer->getPlayer()->getName()}}</a></th>
            <th>{{$scorer->getTeam()->getName()}}</th>
            <th>{{$scorer->getNumberOfGoals()}}</th>
        </tr>
        @empty

        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <th>Position</th>
            <th>Name</th>
            <th>Team</th>
            <th>Number Of Goals</th>
        </tr>
    </tfoot>
</table>
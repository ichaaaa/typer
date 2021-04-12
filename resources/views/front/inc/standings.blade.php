<div class="panel">
    <div class="panel-hdr">
        <h2>
            Tabele z podziałem na TOTAL, HOME, AWAY
        </h2>
        <div class="panel-toolbar">
            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
        </div>
    </div>
    <div class="panel-container show">
        <div class="panel-content">
            <ul class="nav nav-pills nav-justified" role="tablist">
                @foreach($competition->getStandings() as $standing)
                @if($group != null && $group == $standing->getGroup() || $group == null)
                <li class="nav-item"><a class="nav-link @if($standing->getType() == 'TOTAL') active @endif" data-toggle="tab" href="#{{$standing->getType()}}">{{$standing->getType()}}</a></li>
                @endif
                @endforeach
            </ul>
            <div class="tab-content py-3">
                @foreach($competition->getStandings() as $standing)
                @if($group != null && $group == $standing->getGroup() || $group == null)
                <div class="tab-pane fade active @if($standing->getType() == 'TOTAL') show @endif" id="{{$standing->getType()}}" role="tabpanel">
                    <table id="dt-standing-{{$standing->getType()}}" class="table table-bordered table-hover table-striped w-100">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Name</th>
                                <th>Points</th>
                                <th>Played Games</th>
                                <th>Won</th>
                                <th>Draw</th>
                                <th>Lost</th>
                                <th>Goals For</th>
                                <th>Goals Against</th>
                                <th>Goals Diffrence</th>
                                @if($standing->getType() == 'TOTAL')<th>Form</th>@endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($standing->getTable()->getPositions() as $position)
                            <tr>
                                <th>{{$position->getPositionNum()}}</th>
                                <th><a href="{{route('show_team_details',['id' => $position->getTeam()->getId()])}}" class="nav-link">{{$position->getTeam()->getName()}}</a></th>
                                <th>{{$position->getPoints()}}</th>
                                <th>{{$position->getPlayedGames()}}</th>
                                <th>{{$position->getWon()}}</th>
                                <th>{{$position->getDraw()}}</th>
                                <th>{{$position->getLost()}}</th>
                                <th>{{$position->getGoalsFor()}}</th>
                                <th>{{$position->getGoalsAgainst()}}</th>
                                <th>{{$position->getGoalDifference()}}</th>
                                @if($standing->getType() == 'TOTAL')<th>{{$position->getForm()}}</th>@endif
                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Position</th>
                                <th>Name</th>
                                <th>Points</th>
                                <th>Played Games</th>
                                <th>Won</th>
                                <th>Draw</th>
                                <th>Lost</th>
                                <th>Goals For</th>
                                <th>Goals Against</th>
                                <th>Goals Diffrence</th>
                                @if($standing->getType() == 'TOTAL')<th>Form</th>@endif
                            </tr>
                        </tfoot>
                    </table>

                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

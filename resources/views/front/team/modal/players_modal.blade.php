<div class="modal fade players_list_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-right modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
				<table id="dt-players" class="table table-bordered table-hover table-striped w-100">
				    <thead>
				        <tr>
				            <th>Lp.</th>
				            <th>Imię i nazwisko</th>
				            <th>Pozycja</th>
				            <th>Data urodzenia</th>
				            <th>Narodowość</th>
				            <th>Numer koszulki</th>
				        </tr>
				    </thead>
				    <tbody>
				    	@forelse($team->getPlayers() as $player)
				        <tr>
				            <td>{{$loop->iteration}}</td>
				            <td><a href="{{route('show_player_details', ['id' => $player->getId()])}}" class="nav-link">{{$player->getName()}}</a></td>
				            <td>{{$player->getPosition()}}</td>
				            <td>{{$player->getDateOfBirth()}}</td>
				            <td>{{$player->getNationality()}}</td>
				            <td>{{$player->getShirtNumber()}}</td>
				        </tr>
				        @empty

				        @endforelse
				    </tbody>
				    <tfoot>
				        <tr>
				            <th>Lp.</th>
				            <th>Imię i nazwisko</th>
				            <th>Pozycja</th>
				            <th>Data urodzenia</th>
				            <th>Narodowość</th>
				            <th>Numer koszulki</th>
				        </tr>
				    </tfoot>
				</table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
            </div>
        </div>
    </div>
</div>
<table id="dt-matches-to-check" class="table table-bordered table-hover table-striped w-100">
    <thead>
        <tr>
            <th>Pozycja</th>
            <th>Użytkownik</th>
            <th>Punkty</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    	@forelse($ranking as $user)
    	<tr>
    		<td>#</td>
    		<td>{{$user->name}}</td>
            <td>{{$user->points}}</td>
    	</tr>
    	@empty

    	@endforelse

    </tbody>
    <tfoot>
        <tr>
            <th>Pozycja</th>
            <th>Użytkownik</th>
            <th>Punkty</th>
            <th></th>
        </tr>
    </tfoot>
</table>
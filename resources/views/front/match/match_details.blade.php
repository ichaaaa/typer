<div class="panel">
	<div class="panel-hdr">
	    <h2>
	        Szczegóły
	    </h2>
	</div>

	<div class="col-xl-12">
		
		<div class="row bg-primary-50">
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-left">{{$match->getHomeTeam()->getName()}}</div><div class="float-right">{{$match->getFullTimeScore()->getHomeTeamScore()}}</div></div></div>
			<div class="col-xl-2"><div class="p-2 text-center">:</div></div>
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-left">{{$match->getFullTimeScore()->getAwayTeamScore()}}</div><div class="float-right">{{$match->getAwayTeam()->getName()}}</div></div></div>
		</div>
		<div class="row">
			<div class="col-xl-12 text-center">
				Do przerwy
			</div>
		</div>
		<div class="row bg-primary-50">
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-right">{{$match->getHalfTimeScore()->getHomeTeamScore()}}</div></div></div>
			<div class="col-xl-2"><div class="p-2 text-center">:</div></div>
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-left">{{$match->getHalfTimeScore()->getAwayTeamScore()}}</div></div></div>
		</div>
		@if($match->getExtraTimeScore()->getHomeTeamScore() != null)	
		<div class="row">
			<div class="col-xl-12 text-center">
				Dogrywka
			</div>
		</div>
		<div class="row bg-primary-50">
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-right">{{$match->getExtraTimeScore()->getHomeTeamScore()}}</div></div></div>
			<div class="col-xl-2"><div class="p-2 text-center">:</div></div>
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-left">{{$match->getExtraTimeScore()->getAwayTeamScore()}}</div></div></div>
		</div>
		@endif
		@if($match->getPenaltiesScore()->getHomeTeamScore() != null)
		<div class="row">
			<div class="col-xl-12 text-center">
				Karne
			</div>
		</div>
		<div class="row bg-primary-50">
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-right">{{$match->getPenaltiesScore()->getHomeTeamScore()}}</div></div></div>
			<div class="col-xl-2"><div class="p-2 text-center">:</div></div>
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-left">{{$match->getPenaltiesScore()->getAwayTeamScore()}}</div></div></div>
		</div>
		@endif
		<div class="row">
			<div class="col-xl-12">
				Kolejka: {{$match->getMatchday()}}
			</div>
		</div>			
		<div class="row">
			<div class="col-xl-12">
				Data: {{$match->getDate()}}
			</div>
		</div>			
		<div class="row">
			<div class="col-xl-12">
				Stadion:
			</div>
		</div>			
		<div class="row">
			<div class="col-xl-12">
				Sędziowie:
			</div>
		</div>			
<!-- 			<div class="d-flex justify-content-center">
            <div class="p-2 clearfix"><div class="float-left">Fullham</div><div class="float-right">1</div></div>
            <div class="p-2">:</div>
            <div class="p-2 clearfix"><div class="float-left">Fullham</div><div class="float-right">1</div></div>
        </div> -->

	</div>
</div>
<div class="panel">

	<div class="panel-hdr">
	    <h2>
	        Bezpośrednie pojedynki
	    </h2>
	</div>

	<div class="col-xl-12">
		<div class="row">
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-right">Mecze</div></div></div>
			<div class="col-xl-2"><div class="p-2 text-center">:</div></div>
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-left">{{$match->getHead2head()->getNumberOfMatches()}}</div></div></div>
		</div>		
		<div class="row">
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-right">Gole</div></div></div>
			<div class="col-xl-2"><div class="p-2 text-center">:</div></div>
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-left">{{$match->getHead2head()->getTotalGoals()}}</div></div></div>
		</div>

		<div class="row">
			<div class="col-xl-12 text-center">
				Wygrane
			</div>
		</div>
		<div class="row bg-primary-50">
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-right">{{$match->getHead2head()->getHomeTeam()->getWins()}}</div></div></div>
			<div class="col-xl-2"><div class="p-2 text-center">:</div></div>
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-left">{{$match->getHead2head()->getAwayTeam()->getWins()}}</div></div></div>
		</div>			
		<div class="row">
			<div class="col-xl-12 text-center">
				Remisy
			</div>
		</div>
		<div class="row bg-primary-50">
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-right">{{$match->getHead2head()->getHomeTeam()->getDraws()}}</div></div></div>
			<div class="col-xl-2"><div class="p-2 text-center">:</div></div>
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-left">{{$match->getHead2head()->getAwayTeam()->getDraws()}}</div></div></div>
		</div>			
		<div class="row">
			<div class="col-xl-12 text-center">
				Przegrane
			</div>
		</div>
		<div class="row bg-primary-50">
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-right">{{$match->getHead2head()->getHomeTeam()->getLosses()}}</div></div></div>
			<div class="col-xl-2"><div class="p-2 text-center">:</div></div>
			<div class="col-xl-5"><div class="p-2 clearfix"><div class="float-left">{{$match->getHead2head()->getAwayTeam()->getLosses()}}</div></div></div>
		</div>			
	</div>
</div>

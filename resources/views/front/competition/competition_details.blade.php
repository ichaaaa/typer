@extends('layouts.app')

@section('css')
        <link rel="stylesheet" media="screen, print" href="{{asset('css/datagrid/datatables/datatables.bundle.css')}}">
@endsection

@section('content')

@role('manager')

 Hello developer

@endrole

    <!-- BEGIN Body -->
    <!-- Possible Classes

		* 'header-function-fixed'         - header is in a fixed at all times
		* 'nav-function-fixed'            - left panel is fixed
		* 'nav-function-minify'			  - skew nav to maximize space
		* 'nav-function-hidden'           - roll mouse on edge to reveal
		* 'nav-function-top'              - relocate left pane to top
		* 'mod-main-boxed'                - encapsulates to a container
		* 'nav-mobile-push'               - content pushed on menu reveal
		* 'nav-mobile-no-overlay'         - removes mesh on menu reveal
		* 'nav-mobile-slide-out'          - content overlaps menu
		* 'mod-bigger-font'               - content fonts are bigger for readability
		* 'mod-high-contrast'             - 4.5:1 text contrast ratio
		* 'mod-color-blind'               - color vision deficiency
		* 'mod-pace-custom'               - preloader will be inside content
		* 'mod-clean-page-bg'             - adds more whitespace
		* 'mod-hide-nav-icons'            - invisible navigation icons
		* 'mod-disable-animation'         - disables css based animations
		* 'mod-hide-info-card'            - hides info card from left panel
		* 'mod-lean-subheader'            - distinguished page header
		* 'mod-nav-link'                  - clear breakdown of nav links

		>>> more settings are described inside documentation page >>>
	-->
        <div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                @include('front.nav.left_side_nav_bar')
                <!-- END Left Aside -->
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
					@include('front.header')
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
                            <li class="breadcrumb-item">Application Intel</li>
                            <li class="breadcrumb-item active">Analytics Dashboard</li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol>
                        <div class="subheader">
                            <h1 class="subheader-title">
                                <i class='subheader-icon fal fa-eye'></i>{{$competition->getName()}}
                                <small>
                                    {{$competition->getArea()}}
                                </small>
                            </h1>
                        </div>
                        @php ($count = 1)
                        @forelse($competition->getStandings() as $standing)
                        @if($standing->getStage() == 'REGULAR_SEASON')
                        <div class="row">
                        	<div class="col-xl-8">
                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Tabela - {{$standing->getType()}}
                                        </h2>
                                        <div class="panel-toolbar">

                                            @if($standing->getType() == 'TOTAL')<div class="btn-group" role="group" aria-label="Basic example"><button type="button" id="scorers-modal-button" class="btn btn-primary" data-attr="{{ route('scorers_list', ['competition_id' => $competition->getId()]) }}" data-toggle="modal" data-target=".default-example-modal-right-lg" data-title="Klasyfikacja strzelców">Strzelcy</button>@endif
                                            @if($standing->getType() == 'TOTAL')<button type="button" id="matches-modal-button" class="btn btn-primary" data-attr="{{ route('matches_list', ['competition_id' => $competition->getId()]) }}" data-toggle="modal" data-target=".default-example-modal-right-lg" data-title="Terminarz">Terminarz</button></div>@endif
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,20" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,20" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,20" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
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
                                    </div>
                        	   </div>
                            </div>
                        </div>
                        @if($standing->getType() == 'TOTAL')
                            
                        @endif

                        @endif
                        @if($standing->getStage() == 'GROUP_STAGE' && $standing->getType() == 'TOTAL')
                        @if($count == 1)
                        <div class="row">
                            <div class="col-xl-12">

                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Faza Grupowa
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                            
                                            <div class="card-columns">
                        @endif

                                                <div class="card m-3 bg-primary-50">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$standing->getFormattedGroupName()}}</h5>
                                                        <p class="card-text"></p>
                                                    </div>
                                                    <div class="card-body">
                                                    <table class="table m-0">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nazwa</th>
                                                                <th>Punkty</th>
                                                                <th>W</th>
                                                                <th>D</th>
                                                                <th>L</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($standing->getTable()->getPositions() as $position)
                                                            <tr>
                                                                <th scope="row">{{$position->getPositionNum()}}</th>
                                                                <td><a href="{{route('show_team_details',['id' => $position->getTeam()->getId()])}}" >{{$position->getTeam()->getName()}}</a></td>
                                                                <td>{{$position->getPoints()}}</td>
                                                                <td>{{$position->getWon()}}</td>
                                                                <td>{{$position->getDraw()}}</td>
                                                                <td>{{$position->getLost()}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    </div>
<!--                                                 <ul class="list-group list-group-flush">
                                                    @foreach($standing->getTable()->getPositions() as $position)
                                                    <li class="list-group-item"><a href="{{route('show_team_details',['id' => $position->getTeam()->getId(), 'group'=>$standing->getGroup()])}}" class="nav-link">{{$position->getPositionNum()}}. {{$position->getTeam()->getName()}}</a></li>
                                                    @endforeach
                                                </ul> -->                                      
                                                    <div class="card-body">
                                                        <a href="#" class="btn btn-primary">Pokaż więcej</a>
                                                    </div>
                                                </div>
                        @php ($count++)
                        @endif
                        @if($loop->last)
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @empty
                        @endforelse
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    @include('front.footer')
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                    @include('front.nav.shortcuts')
                    <!-- END Shortcuts -->
                    <!-- BEGIN Color profile -->
                    <!-- this area is hidden and will not be seen on screens or screen readers -->
                    <!-- we use this only for CSS color refernce for JS stuff -->

                    <!-- END Color profile -->
                </div>
            </div>
        </div>
        @include('front.modal.right_large_modal')
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->
        <!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
        @include('front.nav.quick_menu')
        <!-- END Quick Menu -->
        <!-- BEGIN Messenger -->
        @include('front.nav.messanger')
        <!-- END Messenger -->
        <!-- BEGIN Page Settings -->
        @include('front.nav.settings')
		@endsection
        <!-- END Page Settings -->
        <!-- base vendor bundle: 
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
		@section('js')
        <script src="{{asset('js/datagrid/datatables/datatables.bundle.js')}}"></script>
        <script>
            /* demo scripts for change table color */
            /* change background */
            $(document).on('click', '#scorers-modal-button', function(event) {
                event.preventDefault();
                var title = $(this).attr('data-title');
                let href = $(this).attr('data-attr');
                $.ajax({
                    url: href,
                    beforeSend: function() {
                        $('#loader').show();
                        $('.default-example-modal-right-lg .modal-body').html('');
                    },
                    // return the result
                    success: function(result) {
                        $('.default-example-modal-right-lg').modal("show");
                        $('.default-example-modal-right-lg .modal-body').html(result).show();
                        $('.default-example-modal-right-lg .modal-title').text(title);

                        $('#dt-scorers').dataTable(
                        {
                            responsive: true
                        });
                    },
                    complete: function() {
                        $('#loader').hide();
                    },
                    error: function(jqXHR, testStatus, error) {
                        console.log(error);
                        alert("Page " + href + " cannot open. Error:" + error);
                        $('#loader').hide();
                    },
                    timeout: 8000
                })
            });

            $(document).on('click', '#matches-modal-button', function(event) {
                event.preventDefault();
                var title = $(this).attr('data-title');
                let href = $(this).attr('data-attr');
                $.ajax({
                    url: href,
                    beforeSend: function() {
                        $('#loader').show();
                        $('.default-example-modal-right-lg .modal-body').html('');
                    },
                    // return the result
                    success: function(result) {
                        $('.default-example-modal-right-lg').modal("show");
                        $('.default-example-modal-right-lg .modal-body').html(result).show();
                        $('.default-example-modal-right-lg .modal-title').text(title);

                        $('#dt-matches').dataTable(
                        {
                            responsive: true
                        });
                    },
                    complete: function() {
                        $('#loader').hide();
                    },
                    error: function(jqXHR, testStatus, error) {
                        console.log(error);
                        alert("Page " + href + " cannot open. Error:" + error);
                        $('#loader').hide();
                    },
                    timeout: 8000
                })
            });

            $(document).ready(function()
            {
                $("table[id^=dt-basic-example]").dataTable(
                {
                    responsive: false

                });

                $('.js-thead-colors a').on('click', function()
                {
                    var theadColor = $(this).attr("data-bg");
                    //console.log(theadColor);
                    $('#dt-basic-example thead').removeClassPrefix('bg-').addClass(theadColor);
                });

                $('.js-tbody-colors a').on('click', function()
                {
                    var theadColor = $(this).attr("data-bg");
                    //console.log(theadColor);
                    $('#dt-basic-example').removeClassPrefix('bg-').addClass(theadColor);
                });

            });

        </script>
		@endsection

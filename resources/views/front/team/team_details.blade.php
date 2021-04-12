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
					@include('front.inc.header')
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
                                <i class='subheader-icon fal fa-check'></i>{{$team->getName()}}
                                <small>
                                    Dane drużyny
                                </small>
                            </h1>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">

                                <div id="panel-2" class="panel">

                                    <div class="panel-hdr">
                                        <h2>
                                            Bio
                                        </h2>
                                        <div class="panel-toolbar">
                                            <div class="btn-group" role="group" aria-label="Basic example"><button type="button" id="matches-modal-button" class="btn btn-primary" data-attr="{{ route('team_matches_list', ['id' => $team->getId()]) }}" data-toggle="modal" data-target=".default-example-modal-right-lg" data-title="Terminarz">Terminarz</button>
                                            <button type="button" id="players-modal-button" class="btn btn-primary" data-toggle="modal" data-target=".players_list_modal">Zawodnicy</button></div>
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="row">
                                                <div class="col-sm-3"><img src="{{url($team->getCrestURL())}}" class="img-fluid" alt="Responsive image"></div>
                                                <div class="col-sm-9">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">Nazwa: {{$team->getName()}}</li>
                                                        <li class="list-group-item">Założono: {{$team->getFounded()}}</li>
                                                        <li class="list-group-item">Stadion: {{$team->getVenue()}}</li>
                                                        <li class="list-group-item">Adress: {{$team->getAddress()}}</li>
                                                        <li class="list-group-item">Strona WWW: <a target="_blank" href="{{url($team->getWebsite())}}">{{$team->getWebsite()}}</a></li>
                                                        <li class="list-group-item">Barwy: {{$team->getClubColors()}}</li>
                                                    </ul>                                        
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
<!--                         <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Zawodnicy
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="card-group">    
                                                @forelse($team->getPlayers() as $player)
                                
                                                <div class="card m-3 bg-primary-50">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$player->getName()}} - {{$player->getNationality()}}</h5>
                                                        <p class="card-text"></p>
                                                    </div>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">Pozycja: {{$player->getPosition()}}</li>
                                                        <li class="list-group-item">Data urodzenia: {{$player->getDateOfBirth()}}</li>
                                                        <li class="list-group-item">Numer: {{$player->getShirtNumber()}}</li>
                                                    </ul>                                                    
                                                    <div class="card-body">
                                                        <a href="{{route('show_player_details', ['id' => $player->getId()])}}" class="btn btn-primary">Pokaż więcej</a>
                                                    </div>
                                                </div>
                                                @if( $loop->iteration % 3 == 0 ) </div><div class="card-group"> @endif
                                                @empty

                                                    Brak zawodników do wyświetlenia

                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Rozgrywki
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="card-group">    
                                                @forelse($team->getCompetitions() as $competition)
                                
                                                <div class="card">
                                                    <div class="w-100 bg-fusion-50 rounded-top border-top-right-radius-0" style="padding:40px 0 40px;"></div>
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$competition->getName()}} - {{$competition->getArea()}}</h5>
                                                        <small class="text-muted">Last updated: {{ $competition->getLastUpdated() }}</small>
                                                    </div>
                                                    <div class="card-body">
                                                        <a href="{{ route('show_competition_details', ['id'=>$competition->getId()]) }}" class="btn btn-primary">Wybierz</a>
                                                    </div>
                                                </div>
                                                @if( $loop->iteration % 3 == 0 ) </div><div class="card-group"> @endif
                                                @empty

                                                    Brak rozgrywek do wyświetlenia

                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('front.modal.right_large_modal')
                        @include('front.team.modal.players_modal')
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    @include('front.inc.footer')
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
                        $('.default-example-modal-right-lg  .modal-body').html(result).show();
                        $('.default-example-modal-right-lg  .modal-title').text(title);

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
                $('#dt-players').dataTable(
                {
                    responsive: true
                });

            });

        </script>
        @endsection


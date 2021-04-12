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
                                <i class='subheader-icon fal fa-eye'></i>{{$competition->getName()}}
                                <small>
                                    {{$competition->getArea()}}
                                </small>
                            </h1>
                        </div>
                        <div class="row">
                        	<div class="col-xl-12">
								<div class="panel">
								    <div class="panel-hdr">
								        <h2>
								            Fazy
								        </h2>
								        <div class="panel-toolbar">
								        	<button type="button" id="scorers-modal-button" class="btn btn-primary" data-attr="{{ route('scorers_list', ['competition_id' => $competition->getId()]) }}" data-toggle="modal" data-target=".default-example-modal-right-lg" data-title="Klasyfikacja strzelców">Strzelcy</button>
								            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
								            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
								            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
								        </div>
								    </div>
								    <div class="panel-container show">
								        <div class="panel-content">
								            <ul class="nav nav-pills nav-justified" role="tablist">

								                @foreach($competition->getStages() as $stage)
								                @if(!$stage->getIsGroup())
								                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-{{$stage->getCode()}}">{{$stage->getCode()}}</a></li>
								                @else

								                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#tab-{{$stage->getCode()}}">{{$stage->getCode()}}</a>
												<div class="dropdown-menu" style="position: absolute; will-change: top, left; top: 37px; left: 0px;" x-placement="bottom-start">
													@foreach($stage->getGroups() as $group )
                                                    <a class="dropdown-item" data-toggle="tab" href="#tab-group-{{$loop->iteration}}" role="tab" aria-selected="true" aria-expanded="true">{{$group->getName()}}</a>
                                                    @endforeach
                                                </div>

								                </li>
								                
								                @endif
								                @endforeach
								            </ul>
								            <div class="tab-content py-3">
								                @foreach($competition->getStages() as $stage)
								                @if($stage->getCode() != 'GROUP_STAGE')
								                <div class="tab-pane fade" id="tab-{{$stage->getCode()}}" role="tabpanel">
		                                           	<table class="table table-bordered table-hover table-striped w-100">
		                                                <thead>
		                                                    <tr>
		                                                        <th>Data</th>
		                                                        <th>Gospodarz</th>
		                                                        <th>Gość</th>
		                                                        <th>Wynik</th>
		                                                        <th>Status</th>
		                                                        <th></th>
		                                                    </tr>
		                                                </thead>
		                                                <tbody>
		                                                    @forelse($stage->getMatches() as $match)
		                                                    <tr>
		                                                        <td>{{$match->getDate()}}</td>
		                                                        <td><a href="{{route('show_team_details',['id' => $match->getHomeTeam()->getId()])}}" >{{$match->getHomeTeam()->getName()}}</a></td>
		                                                        <td><a href="{{route('show_team_details',['id' => $match->getAwayTeam()->getId()])}}" >{{$match->getAwayTeam()->getName()}}</a></td>
		                                                        <td>{{$match->getFullTimeScore()->getHomeTeamScore()}} : {{$match->getFullTimeScore()->getAwayTeamScore()}}</td>
		                                                        <td>{{$match->getStatus()}}</td>
		                                                        <td><a href="{{route('show_match_details', ['id' => $match->getId()])}}" id="match-{{$match->getId()}}" class="badge badge-primary">Pokaż więcej</a></td>
		                                                    </tr>
		                                                    @empty

		                                                    @endforelse
		                                                </tbody>
		                                                <tfoot>
		                                                    <tr>
		                                                        <th>Data</th>
		                                                        <th>Gospodarz</th>
		                                                        <th>Gość</th>
		                                                        <th>Wynik</th>
		                                                        <th>Status</th>
		                                                        <th></th>
		                                                    </tr>
		                                                </tfoot>
		                                            </table>								                	
								                </div>
								                @else
												@foreach($stage->getGroups() as $group )
								                <div class="tab-pane fade" id="tab-group-{{$loop->iteration}}" role="tabpanel">
								                	<div class="btn-group" role="group">
														<button type="button" id="standings-modal-button" class="btn btn-primary" data-attr="{{ route('competition_standings', ['competition_id' => $competition->getId(), 'group'=>$group->getCode()]) }}" data-toggle="modal" data-target=".default-example-modal-right-lg" data-title="Tabela">Tabela {{$group->getName()}}</button>								                		
								                	</div>								                	
		                                           <table class="table table-bordered table-hover table-striped w-100">
		                                                <thead>
		                                                    <tr>
		                                                        <th>Data</th>
		                                                        <th>Gospodarz</th>
		                                                        <th>Gość</th>
		                                                        <th>Wynik</th>
		                                                        <th>Status</th>
		                                                        <th></th>
		                                                    </tr>
		                                                </thead>
		                                                <tbody>
		                                                    @forelse($stage->getMatches() as $groupName => $matches)
		                                                    @if($groupName == $group->getName())
		                                                    @foreach($matches as $match)
			                                                    <tr>
			                                                        <td>{{$match->getDate()}}</td>
			                                                        <td><a href="{{route('show_team_details',['id' => $match->getHomeTeam()->getId()])}}" >{{$match->getHomeTeam()->getName()}}</a></td>
			                                                        <td><a href="{{route('show_team_details',['id' => $match->getAwayTeam()->getId()])}}" >{{$match->getAwayTeam()->getName()}}</a></td>
			                                                        <td>{{$match->getFullTimeScore()->getHomeTeamScore()}} : {{$match->getFullTimeScore()->getAwayTeamScore()}}</td>
			                                                        <td>{{$match->getStatus()}}</td>
			                                                        <td><a href="{{route('show_match_details', ['id' => $match->getId()])}}" id="match-{{$match->getId()}}" class="badge badge-primary">Pokaż więcej</a></td>
			                                                    </tr>
			                                                @endforeach
		                                                    @endif

		                                                    @empty

		                                                    @endforelse
		                                                </tbody>
		                                                <tfoot>
		                                                    <tr>
		                                                        <th>Data</th>
		                                                        <th>Gospodarz</th>
		                                                        <th>Gość</th>
		                                                        <th>Wynik</th>
		                                                        <th>Status</th>
		                                                        <th></th>
		                                                    </tr>
		                                                </tfoot>
		                                            </table>								                	
								                </div>
												@endforeach
								                @endif
								                @endforeach
								            </div>
								        </div>
								    </div>
								</div>                        		
                            </div>
                        </div>
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

            $(document).on('click', '#standings-modal-button', function(event) {
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

                        $('table[id^=dt-standing]').dataTable(
                        {
                            bLengthChange: true,
                                "lengthMenu": [ [10, 20, -1], [10, 20, "All"] ],
                                "iDisplayLength": 20,
                                bInfo: false,
                                responsive: true,
                                "bAutoWidth": false
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


            $(document).on('click', 'a[id^=match-]', function(event) {
                event.preventDefault();
                var title = $(this).attr('data-title');
                let href = $(this).attr('href');
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

            // $(document).on('click', '#matches-modal-button', function(event) {
            //     event.preventDefault();
            //     var title = $(this).attr('data-title');
            //     let href = $(this).attr('data-attr');
            //     $.ajax({
            //         url: href,
            //         beforeSend: function() {
            //             $('#loader').show();
            //             $('.default-example-modal-right-lg .modal-body').html('');
            //         },
            //         // return the result
            //         success: function(result) {
            //             $('.default-example-modal-right-lg').modal("show");
            //             $('.default-example-modal-right-lg .modal-body').html(result).show();
            //             $('.default-example-modal-right-lg .modal-title').text(title);

            //             $('#dt-matches').dataTable(
            //             {
            //                 responsive: true
            //             });
            //         },
            //         complete: function() {
            //             $('#loader').hide();
            //         },
            //         error: function(jqXHR, testStatus, error) {
            //             console.log(error);
            //             alert("Page " + href + " cannot open. Error:" + error);
            //             $('#loader').hide();
            //         },
            //         timeout: 8000
            //     })
            // });

            $(document).ready(function()
            {
                $("table[id^=dt-basic-example]").dataTable(
                {
                    responsive: false

                });

                $('#dt-matches thead tr').clone(true).appendTo('#dt-matches thead');
                $('#dt-matches thead tr:eq(1) th').each(function(i)
                {
                    var title = $(this).text();
                    $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');

                    $('input', this).on('keyup change', function()
                    {
                        if (table.column(i).search() !== this.value)
                        {
                            table
                                .column(i)
                                .search(this.value)
                                .draw();
                        }
                    });
                });

                var table = $('#dt-matches').DataTable(
                {
                    responsive: true,
                    orderCellsTop: true,
                    fixedHeader: true,
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

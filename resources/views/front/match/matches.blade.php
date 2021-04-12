@extends('layouts.app')

@section('css')
        <link rel="stylesheet" media="screen, print" href="{{asset('css/datagrid/datatables/datatables.bundle.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{asset('css/fa-solid.css')}}">

        <style type="text/css">
            
            .tab-slider {
              padding: 0 40px;
            }

            .tab-slider .btn-icon {
              position: absolute;
              top: 17px;
            }

            #goPrev {
                left:0;
            }
            #goNext {
                right:0;
            }
            .wrap {
                overflow: hidden;
                position: relative;
                white-space: nowrap;
                width: 100%;
                border: 1px solid #efefef;
                font-size: 0;
            }

            .nav-pills>li.active>a,
            .nav-pills>li.active>a:focus,
            .nav-pills>li.active>a:hover {
                border: 1px solid transparent;
            }

            .wrap>.nav-pills {
                display: inline-block;
                padding: 0;
                margin: 0;
                position: relative;
                top: 0;
                left: 0;
            }

            .wrap>.nav-pills>li {
                background: #fff;
                display: inline-block;
                position: relative;
                white-space: normal;
                float: none;
                font-size: 14px;
            }

            .nav-pills>li>a {
                margin-right: 0;
                border-radius: 0;
            }

        </style>
@endsection

@section('content')

@role('admin')

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
                                <i class='subheader-icon fal fa-eye'></i>Ostatnie oraz nadchodzące mecze
                                <small>
                                    
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
								        	<button type="button" id="scorers-modal-button" class="btn btn-primary" data-attr="#" data-toggle="modal" data-target=".default-example-modal-right-lg" data-title="Klasyfikacja strzelców">Strzelcy</button>
								            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
								            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
								            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
								        </div>
								    </div>
								    <div class="panel-container show">
								        <div class="panel-content">
                                        <div class="tab-slider">                                            
                                            <div class="wrap">
                                                <ul class="nav nav-pills nav-justified" role="tablist" id="menus">

                                                @foreach($matches as $date => $match)
                                                    <li class="nav-item"><a class="nav-link game-date" data-toggle="tab" href="#tab-{{$date}}">{{$date}}</a></li>
                                                @endforeach                                            
                                                </ul>
                                            </div>
                                            <button id="goPrev" class="btn btn-default btn-icon"><i class="fa fa-angle-left"></i></button>
                                            <button id="goNext" class="btn btn-default btn-icon"><i class="fa fa-angle-right"></i></button>
                                        </div>
                                        <div class="tab-content py-3">
                                            @foreach($matches as $date => $games)
                                            <div class="tab-pane fade" id="tab-{{$date}}" role="tabpanel">
                                                <table class="table table-bordered table-hover table-striped w-100" id="dt-matchday-{{$date}}">
                                                    <thead>
                                                        <tr>
                                                            <th>Godzina</th>
                                                            <th>Gospodarz</th>
                                                            <th>Gość</th>
                                                            <th>Wynik</th>
                                                            <th>Status</th>
                                                            <th>Rozgrywki</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($games as $match)
                                                        <tr>
                                                            <td>{{$match->getHour()}}</td>
	                                                        <td><a href="{{route('show_team_details',['id' => $match->getHomeTeam()->getId()])}}" >{{$match->getHomeTeam()->getName()}}</a></td>
	                                                        <td><a href="{{route('show_team_details',['id' => $match->getAwayTeam()->getId()])}}" >{{$match->getAwayTeam()->getName()}}</a></td>
                                                            <td>{{$match->getFullTimeScore()->getHomeTeamScore()}} : {{$match->getFullTimeScore()->getAwayTeamScore()}}</td>
                                                            <td>{{$match->getStatus()}}</td>
                                                            <td><a href="{{route('show_competition_details', ['id' => $match->getCompetition()->getId()])}}">{{$match->getCompetition()->getName()}}</a></td>
	                                                        <td><a href="{{route('show_match_details', ['id' => $match->getId()])}}" id="match-{{$match->getId()}}" class="badge badge-primary">Pokaż więcej</a></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Godzina</th>
                                                            <th>Gospodarz</th>
                                                            <th>Gość</th>
                                                            <th>Wynik</th>
                                                            <th>Status</th>
                                                            <th>Rozgrywki</th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>                                                    
                                            </div>
                                            @endforeach
                                        </div>


<!-- 								            <ul class="nav nav-pills nav-justified" role="tablist">
								                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-1">Tabela Uczestników</a></li>
								                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-2">Zakłady</a></li>
								            </ul>
								            <div class="tab-content py-3">
								                <div class="tab-pane fade" id="tab-1" role="tabpanel">
		                                           	<table class="table table-bordered table-hover table-striped w-100">
		                                                <thead>
		                                                    <tr>
		                                                        <th>Nazwa</th>
		                                                        <th>Punkty</th>
                                                                <th>Trafione wyniki</th>
                                                                <th>Trafieni zwycięzcy</th>
		                                                        <th>Pytania</th>
		                                                        <th></th>
		                                                    </tr>
		                                                </thead>
		                                                <tbody>

		                                                </tbody>
		                                                <tfoot>
		                                                    <tr>
                                                                <th>Nazwa</th>
                                                                <th>Punkty</th>
                                                                <th>Trafione wyniki</th>
                                                                <th>Trafieni zwycięzcy</th>
                                                                <th>Pytania</th>
		                                                        <th></th>
		                                                    </tr>
		                                                </tfoot>
		                                            </table>								                	
								                </div>
								                <div class="tab-pane fade" id="tab-2" role="tabpanel">
		                                           	<table class="table table-bordered table-hover table-striped w-100">
		                                                <thead>
		                                                    <tr>
		                                                        <th>Data</th>
		                                                        <th>Drużyny</th>
		                                                        <th>Wynik</th>
		                                                        <th>Twój typ</th>
		                                                        <th>Status</th>
		                                                        <th></th>
		                                                    </tr>
		                                                </thead>
		                                                <tbody>

		                                                </tbody>
		                                                <tfoot>
		                                                    <tr>
                                                                <th>Data</th>
                                                                <th>Drużyny</th>
                                                                <th>Wynik</th>
                                                                <th>Twój typ</th>
                                                                <th>Status</th>
                                                                <th></th>
		                                                    </tr>
		                                                </tfoot>
		                                            </table>								                	
								                </div>
 -->								            <!-- </div> -->
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
 //console.log('{{$closestDate}}');
                // if($('.game-date').first().text() == '2020-08-08')
                // {
                    
                // }

                $('.game-date').each(function(e){
                    if($(this).text() == "{{$closestDate}}" ){
                        $(this).click();
                    }else{
                        $(this).removeClass('active');
                    }
                });

                var table = $('table[id^=dt-matchday]').DataTable(
                {
                    responsive: true,
                    orderCellsTop: true,
                    fixedHeader: true,
                    rowGroup:
                    {
                        dataSrc: 5
                    },
			        "columnDefs": [
			            {
			                "targets": [ 5 ],
			                "visible": false,
			                "searchable": true
			            }
			        ],
                    order: [
                        [5, 'asc'],
                        [0, 'asc'],
                    ],			        

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


                //function itemWidth() {
                  // get the larger item to set the width of every item
                  var largestWidth = 0;
                  var index = 0;
                  $(".nav-pills>li>a").each(function() {
                    if ($(this).outerWidth() > largestWidth) {
                      largestWidth = $(this).outerWidth();
                    }

                    if($(this).hasClass("active")){
                        index = $(this).parent().index();
                    }
                  });



                  Wrap = $(".wrap").outerWidth(); // the wrapper full width
                  someSpace = largestWidth + 10; // make some space, 5px each side
                  roundFigure = Wrap / someSpace; // parent width divided by larger item width
                  roundFigure = Math.round(roundFigure); // round the figure 
                  finalWidth = Wrap / roundFigure; // get the final width 
                  $(".nav-pills>li>a").outerWidth(finalWidth); // set the final width

                  numberOfItems = $(".nav-pills>li>a").length;
                  itemsPerPage = Math.ceil(Wrap / finalWidth);

                    $("#menus").stop(true).animate({
                       "left": -finalWidth * ( index - Math.ceil(itemsPerPage / 2) )
                    }, "slow");


                //}

                //itemWidth();

                var menus = $("#menus"),
                  menuWidth = menus.parent().outerWidth();
                var menupage = Math.ceil(menus[0].scrollWidth / menuWidth),
                  currPage = Math.ceil((index - 1) / itemsPerPage);
                if (menupage > 1) {
                  $("#goNext").click(function() {
                    currPage < menupage && menus.stop(true).animate({
                      "left": -menuWidth * currPage
                    }, "slow") && currPage++
                  });
                  $("#goPrev").click(function() {
                    currPage > 1 && menus.stop(true).animate({
                      "left": -menuWidth * (currPage - 2)
                    }, "slow") && currPage--;
                  });

                  $(window).on("resize", function() {


                  var largestWidth = 0;
                  var index = 0;
                  $(".nav-pills>li>a").each(function() {
                    if ($(this).outerWidth() > largestWidth) {
                      largestWidth = $(this).outerWidth();
                    }

                    if($(this).hasClass("active")){
                        index = $(this).parent().index();
                    }
                  });

                  Wrap = $(".wrap").outerWidth(); // the wrapper full width
                  someSpace = largestWidth + 10; // make some space, 5px each side
                  roundFigure = Wrap / someSpace; // parent width divided by larger item width
                  roundFigure = Math.round(roundFigure); // round the figure 
                  finalWidth = Wrap / roundFigure; // get the final width 
                  $(".nav-pills>li>a").outerWidth(finalWidth); // set the final width

                  numberOfItems = $(".nav-pills>li>a").length;
                  itemsPerPage = Math.floor(Wrap / finalWidth);

                    $("#menus").stop(true).animate({
                       "left": -finalWidth * ( index - Math.ceil(itemsPerPage / 2) )
                    }, "slow");

                    menuWidth = menus.parent().outerWidth();
                    menupage = Math.ceil(menus[0].scrollWidth / menuWidth);
                    currPage = Math.ceil((index - 1) / itemsPerPage);
                    //console.log(currPage);
                  });
                }

            });
        </script>
		@endsection

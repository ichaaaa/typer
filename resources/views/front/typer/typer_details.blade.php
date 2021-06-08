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
                                                <table class="table table-bordered table-hover table-striped w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>Godzina</th>
                                                            <th>Drużyny</th>
                                                            <th>Wynik</th>
                                                            <th>Twój typ</th>
                                                            <th>Pytanie</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($games as $match)
                                                        <tr>
                                                            <td>{{$match->getHour()}}</td>
                                                            <td><a href="{{route('show_team_details',['id' => $match->getHomeTeam()->getId()])}}" >{{$match->getHomeTeam()->getName()}}</a> : <a href="{{route('show_team_details',['id' => $match->getAwayTeam()->getId()])}}" >{{$match->getAwayTeam()->getName()}}</a></td>
                                                            <td>{{$match->getFullTimeScore()->getHomeTeamScore()}} : {{$match->getFullTimeScore()->getAwayTeamScore()}} <a href="{{route('show_match_details', ['id' => $match->getId()])}}" id="match-{{$match->getId()}}" class="badge badge-primary">Pokaż więcej</a></td>
                                                            <td id="bet-{{$match->getId()}}">@if(isset($bets[$typer->id][Auth::id()][$match->getId()])) {{$bets[$typer->id][Auth::id()][$match->getId()]->home_team_score}} : {{$bets[$typer->id][Auth::id()][$match->getId()]->away_team_score}} @if($bets[$typer->id][Auth::id()][$match->getId()]->sure_thing) <i class="fas fa-check" data-toggle="tooltip" data-original-title="Pewniak"></i> @endif @endif</td>
                                                            <td></td>
                                                            <td>{{$match->getStatus()}}</td>
                                                            <td id="actions-{{$match->getId()}}">
                                                                @if($match->getStatus() == 'SCHEDULED' && !isset($bets[$typer->id][Auth::id()][$match->getId()]) )<button type="button" class="btn btn-primary waves-effect waves-themed create-bet" data-attr="{{route('create_bet', ['id'=>$match->getId(), 'typer' => $typer])}}" data-toggle="modal" data-target=".default-example-modal-right-lg" data-title="Typujesz wynik">Typuj wynik</button>@elseif($match->getStatus() == 'SCHEDULED' && isset($bets[$typer->id][Auth::id()][$match->getId()]) ) <button type="button" class="btn btn-primary waves-effect waves-themed create-bet" data-attr="{{route('edit_bet', ['bet'=>$bets[$typer->id][Auth::id()][$match->getId()]])}}" data-toggle="modal" data-target=".default-example-modal-right-lg" data-title="Edytujesz typ">Edytuj typ</button> @else <button type="button"  class="btn btn-primary waves-effect waves-themed show-bets-list" data-attr="{{route('match_bet_list', ['match_id'=>$match->getId(), 'typer' => $typer])}}" data-toggle="modal" data-target=".default-example-modal-right-lg" data-title="{{$match->getHomeTeam()->getName()}} {{$match->getFullTimeScore()->getHomeTeamScore()}} : {{$match->getFullTimeScore()->getAwayTeamScore()}} {{$match->getAwayTeam()->getName()}}">Pokaż typy</button> @endif
                                                                <button type="button"  class="btn btn-primary waves-effect waves-themed create-question-answer" data-attr="{{route('create_question_answer', ['match_id'=>$match->getId(), 'typer' => $typer])}}" data-toggle="modal" data-target=".default-example-modal-right-lg" data-title="Odpowiedz na pytanie">Odpowiedz na pytanie</button>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Godzina</th>
                                                            <th>Drużyny</th>
                                                            <th>Wynik</th>
                                                            <th>Twój typ</th>
                                                            <th>Pytanie</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>                                                    
                                            </div>
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

            $(document).on('click', '.show-bets-list', function(event) {
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

                        $('table[id^=dt-bets]').dataTable(
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

            $(document).on('click', '.create-bet', function(event) {
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



            $(document).on('click', '#save-bet-button', function(event) {
                $(this).remove();
                event.preventDefault();
                $.ajax({
                    /* the route pointing to the post function */
                    url: "{{route('store_bet')}}",
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: $('#create-bet-form').serialize(),
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        alert(data.msg);
                        //console.log(data);
                        $("#bet-"+data.match_id).text(data.home_team_score+" : "+data.away_team_score);
                        if(data.sure_thing == 1)
                        {
                            $("#bet-"+data.match_id).append(' <i class="fas fa-check" data-toggle="tooltip" data-original-title="Pewniak"></i>');
                        }
                        $('#actions-'+data.match_id).find('button').remove();

                    },
                    error:function(data){
                        obj = data.responseJSON.errors;
                        $.each(obj, function(key,value) {
                            $("input[name='"+key+"']").parent().addClass('alert').addClass('alert-danger');
                            $("input[name='"+key+"']").siblings('span').text(value);
                        });
                    }
                }); 
            });

            $(document).on('click', '#update-bet-button', function(event) {
                event.preventDefault();
                $.ajax({
                    /* the route pointing to the post function */
                    url: "{{route('update_bet')}}",
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: $('#edit-bet-form').serialize(),
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) { 
                        alert(data.msg);
                        $("#bet-"+data.match_id).text(data.home_team_score+" : "+data.away_team_score);
                        if(data.sure_thing == 1)
                        {
                            $("#bet-"+data.match_id).append(' <i class="fas fa-check" data-toggle="tooltip" data-original-title="Pewniak"></i>');
                        }else{
                            $("#bet-"+data.match_id).find('.fa-check').remove();
                        }
                    },
                    error:function(data){
                        obj = data.responseJSON.errors;
                        $.each(obj, function(key,value) {
                            $("input[name='"+key+"']").parent().addClass('alert').addClass('alert-danger');
                            $("input[name='"+key+"']").siblings('span').text(value);
                        });
                    }
                }); 
            });


            $(document).ready(function()
            {
                $('.game-date').each(function(e){
                    if($(this).text() == "{{$closestDate}}" ){
                        $(this).click();
                    }else{
                        $(this).removeClass('active');
                    }
                });



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

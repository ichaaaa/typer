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
                                <i class='subheader-icon fal fa-check'></i>{{$typer->getCompetition($service)->getName()}}
                                <small>
                                    Dane typera
                                </small>
                            </h1>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">

                                <div id="panel-2" class="panel">

                                    <div class="panel-hdr">
                                        <h2>
                                            Szczegóły
                                        </h2>

                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="row">
                                                <div class="col-sm-3"><img src="@if($typer->getCompetition($service)->getEmblemURL() != null) {{url($typer->getCompetition($service)->getEmblemURL())}} @else https://via.placeholder.com/150 @endif" class="img-fluid" alt="Responsive image"></div>
                                                <div class="col-sm-9">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">Rozpoczęcie: {{$typer->getCompetition($service)->getStartDate()}}</li>
                                                        <li class="list-group-item">Zakończenie: {{$typer->getCompetition($service)->getEndDate()}}</li>
                                                        <li class="list-group-item">Kolejka: {{$typer->getCompetition($service)->getMatchday()}}</li>
                                                        <li class="list-group-item">Data aktualizacji: {{ $typer->getCompetition($service)->getLastUpdated() }}</li>
                                                    </ul>                                        
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-xl-8">
                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Zgłoszeni uczestnicy
                                        </h2>
                                        <div class="panel-toolbar">

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
                                                        <th>Lp.</th>
                                                        <th>Nazwa</th>
                                                        <th>Email</th>
                                                        <th>Zatwierdzony</th>
                                                        <th>Zapłacone</th>
                                                        <th>Zbanowany</th>
                                                        <th>Opcje</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $user)
                                                    @if( $typer->hasUser($user))
                                                    <tr>
                                                        <th>{{$loop->iteration}}</th>
                                                        <th>{{$user->name}}</th>
                                                        <th>{{$user->email}}</th>
                                                        <th><p class="@if($typer->verifiedUser($user))text-success"> TAK @else text-danger">NIE @endif</p></th>
                                                        <th>NIE</th>
                                                        <th>NIE</th>
                                                        <th><div class="btn-group" role="group">@if(!$typer->verifiedUser($user))<button type="button" data-attr="{{route('user_typer_verify', ['typer'=>$typer, 'user'=>$user])}}" class="btn btn-primary verify-user-button">Aceptuj</button>@endif<button type="button" data-attr="{{route('ban_user_from_typer_form_create', ['typer'=>$typer, 'user'=>$user])}}" class="btn btn-danger ban-user-button">Zbanuj</button></div></th>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Lp.</th>
                                                        <th>Nazwa</th>
                                                        <th>Email</th>
                                                        <th>Potwierdził</th>
                                                        <th>Zapłacone</th>
                                                        <th>Zbanowany</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                        	   </div>
                            </div>
                        </div>
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


            $(document).on('click', '.verify-user-button', function(event) {
                event.preventDefault();
                var thisButton = $(this);
                thisButton.prop('disabled', true);
                //var title = $(this).attr('data-title');
                let href = $(this).attr('data-attr');
                $.ajax({
                    url: href,
                    beforeSend: function() {
                        //$('#loader').show();
                        //$('.default-example-modal-right-lg .modal-body').html('');
                    },
                    // return the result
                    success: function(result) {
                        // $('.default-example-modal-right-lg').modal("show");
                         $('#toast-container').append(result);
                        // $('.default-example-modal-right-lg .modal-title').text(title);

                        // $('#dt-scorers').dataTable(
                        // {
                        //     responsive: true
                        // });
                    },
                    complete: function() {
                        $('.toast').toast('show');

                    },
                    error: function(jqXHR, testStatus, error) {
                        console.log(error);
                        alert("Page " + href + " cannot open. Error:" + error);
                        $('#loader').hide();
                        thisButton.prop('disabled', false);
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

            });

        </script>
        @endsection


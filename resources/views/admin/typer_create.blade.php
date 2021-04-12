@extends('layouts.app')


@section('css')
    <link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
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
                                <i class='subheader-icon fal fa-edit'></i>Typer
                                <small>
                                    Utwórz nowy typer
                                </small>
                            </h1>
                        </div>
                        <div class="row">
                        	<div class="col-xl-6">
                        		<div id="panel-1" class="panel">
                        			<div class="panel-container show">
                        				<div class="panel-content">
                        					{!! Form::open(['route' => 'store_typer', 'method' => 'post']) !!}
                                                <div class="form-group @error('name') alert alert-danger @enderror">
                                                    {{ Form::label('name', 'Nazwa', ['class' => 'form-label']) }}
                                                    {{ Form::text('name','', ['class'=>'form-control'])}}
                                                    @error('name')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group @error('description') alert alert-danger @enderror">
                                                    {{ Form::label('description', 'Opis', ['class' => 'form-label']) }}
                                                    {{ Form::text('description','',['class'=>'form-control'])}}
                                                    @error('description')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group @error('start_date') alert alert-danger @enderror">
                                                    {{ Form::label('start_date', 'Data rozpoczęcia', ['class' => 'form-label']) }}
                                                    <div class="input-group">
                                                        <input type="text" name="start_date" id="start_date" class="form-control " readonly="" placeholder="Wybierz datę" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text fs-xl">
                                                                <i class="fal fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div> 
                                                    @error('start_date')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group @error('competition_id') alert alert-danger @enderror">
                                                    {{ Form::label('competition_id', 'Rozgrywki', ['class' => 'form-label']) }}
                                                    <select name="competition_id" id="competition_id" class="form-control">
                                                        <option value="">- Wybierz -</option>
                                                        @foreach($competitions as $competition)
                                                            <option value="{{$competition->getId()}}">{{$competition->getName()}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('competition_id')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group @error('visibility_type_id') alert alert-danger @enderror">
                                                    {{ Form::label('visibility_type_id', 'Widoczność', ['class' => 'form-label']) }}
                                                    <select name="visibility_type_id" id="visibility_type_id" class="form-control">
                                                        <option value="">- Wybierz -</option>
                                                        @foreach($visibilityTypes as $type)
                                                            <option value="{{$type->id}}">{{$type->type}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('visibility_type_id')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('membership_fee_amount', 'Wpisowe', ['class' => 'form-label']) }}
                                                <div class="input-group @error('membership_fee_amount') alert alert-danger @enderror">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    {{ Form::text('membership_fee_amount','', ['class'=>'form-control', 'min'=>0]) }}
                                                    @error('membership_fee_amount')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                    <select name="membership_fee_currency" id="membership_fee_currency" class="form-control">
                                                        <option value="">- Waluta -</option>
                                                        <option value="PLN">PLN</option>
                                                        <option value="EUR">EUR</option>
                                                    </select>
                                                    @error('membership_fee_currency')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>                                                    
                                                </div>

                                                <div class="form-group @error('awarded_positions') alert alert-danger @enderror">
                                                    {{ Form::label('awarded_positions', 'Nagradzane miejsca: ', ['class' => 'form-label']) }}<span class="awarded_positions_value"></span>
                                                    <input class="form-control" name="awarded_positions" id="awarded_positions" type="range" name="range" value="1" min="1" max="5">
                                                    @error('awarded_positions')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>                                                


                                                <div class="form-group @error('status') alert alert-danger @enderror">


                                                    {{ Form::label('status', 'Status') }}
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="">- Status -</option>
                                                        <option value="0">Nieaktywny</option>
                                                        <option value="1">Aktywny</option>
                                                        <option value="9">Zakończony</option>
                                                    </select>
                                                    @error('status')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                   
                                                </div>

                                                {{ Form::button('Zapisz', array('type'=>'submit', 'class' => 'btn btn-primary btn-lg btn-block waves-effect waves-themed')) }}
                        					{!! Form::close() !!}
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
        <script src="{{asset('js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
        <script>

            var controls = {
                leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
                rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
            }

            $(document).ready(function(){



                $('#start_date').datepicker(
                {
                    format: "yyyy-mm-dd",
                    todayHighlight: true,
                    orientation: "bottom left",
                    templates: controls,
                    
                });

                $('#awarded_positions').change(function(){
                    $(".awarded_positions_value").text($(this).val());
                }).change();

                
            });
        </script>
		@endsection

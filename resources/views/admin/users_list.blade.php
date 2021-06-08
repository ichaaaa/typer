@extends('layouts.app')

@section('css')
        <link rel="stylesheet" media="screen, print" href="{{asset('css/datagrid/datatables/datatables.bundle.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/select2/select2.bundle.css')}}">

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
                                <i class='subheader-icon fal fa-check'></i>
                                <small>
                                    Użytkownicy
                                </small>
                            </h1>
                        </div>
                        <div class="row">
                        	<div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Zarządzaj
                                        </h2>
                                        <div class="panel-toolbar">

                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,20" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,20" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,20" data-original-title="Close"></button>
                                        </div>
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
                                                        <th>Role</th>
                                                        <th>Uprawnienia</th>
                                                        <th>Zbanowany</th>
                                                        <th>Opcje</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	@foreach($users as $user)
                                                    <tr>
                                                        <th>{{$loop->iteration}}</th>
                                                        <th>{{$user->name}}</th>
                                                        <th>{{$user->email}}</th>
                                                        <th>
                                                            @foreach($user->roles as $role)
                                                                <span class="badge badge-primary">{{$role->name}}</span>
                                                            @endforeach
                                                        </th>
                                                        <th>
                                                           @foreach($user->permissions as $permission)
                                                                <span class="badge badge-primary">{{$permission->name}}</span>
                                                            @endforeach
                                                        </th>
                                                        <th></th>
                                                        <th><button type="button" data-attr="{{route('user_edit', ['user'=>$user])}}" class="btn btn-danger edit-user">Edytuj</button></th>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Lp.</th>
                                                        <th>Nazwa</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th>Uprawnienia</th>
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
												<div id="toast-container" style="position: fixed; top: 0; right: 10px;">
                                                    <!-- Then put toasts within -->
<!--                                                     <div class="toast fade hide" role="alert" data-autohide="false" aria-live="assertive" aria-atomic="true" data-toggle="toast">
                                                        <div class="toast-header">
                                                            <img src="{{asset('img/logo.png')}}" alt="brand-logo" height="16" class="mr-2">
                                                            <strong class="mr-auto">SmartAdmin</strong>
                                                            <small class="text-muted">2 seconds ago</small>
                                                            <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="toast-body">
                                                            Heads up, toasts will stack automatically
                                                        </div>
                                                    </div> -->
                                                    <!--end toast-->
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
        @include('admin.modal.right_large_modal')
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
        <script src="{{asset('js/formplugins/select2/select2.bundle.js')}}"></script>


        <script>

            $(document).on('click', '.edit-user', function(event) {
                event.preventDefault();
                //var title = $(this).attr('data-title');
                let href = $(this).attr('data-attr');
                $.ajax({
                    url: href,
                    beforeSend: function() {
                        //$('#loader').show();
                        $('.default-example-modal-right-lg .modal-body').html('');
                    },
                    // return the result
                    success: function(result) {
                        $('.default-example-modal-right-lg').modal("show");
                        $('.default-example-modal-right-lg .modal-body').html(result).show();
                $(function()
                {
                    $('.select2').select2(
                        {
                            dropdownParent: $('.default-example-modal-right-lg')
                        }
                    );

                    $('.select22').select2(
                        {
                            dropdownParent: $('.default-example-modal-right-lg')
                        }
                    );

                    $(".js-hide-search").select2(
                    {
                        minimumResultsForSearch: 1 / 0
                    });
                    $(".js-max-length").select2(
                    {
                        maximumSelectionLength: 2,
                        placeholder: "Select maximum 2 items"
                    });

                    $(".js-select2-icons").select2(
                    {
                        minimumResultsForSearch: 1 / 0,
                        templateResult: icon,
                        templateSelection: icon,
                        escapeMarkup: function(elm)
                        {
                            return elm
                        }
                    });

                    function icon(elm)
                    {
                        elm.element;
                        return elm.id ? "<i class='" + $(elm.element).data("icon") + " mr-2'></i>" + elm.text : elm.text
                    }

                    $(".js-data-example-ajax").select2(
                    {
                        ajax:
                        {
                            url: "https://api.github.com/search/repositories",
                            dataType: 'json',
                            delay: 250,
                            data: function(params)
                            {
                                return {
                                    q: params.term, // search term
                                    page: params.page
                                };
                            },
                            processResults: function(data, params)
                            {
                                // parse the results into the format expected by Select2
                                // since we are using custom formatting functions we do not need to
                                // alter the remote JSON data, except to indicate that infinite
                                // scrolling can be used
                                params.page = params.page || 1;

                                return {
                                    results: data.items,
                                    pagination:
                                    {
                                        more: (params.page * 30) < data.total_count
                                    }
                                };
                            },
                            cache: true
                        },
                        placeholder: 'Search for a repository',
                        escapeMarkup: function(markup)
                        {
                            return markup;
                        }, // let our custom formatter work
                        minimumInputLength: 1,
                        templateResult: formatRepo,
                        templateSelection: formatRepoSelection
                    });

                    function formatRepo(repo)
                    {
                        if (repo.loading)
                        {
                            return repo.text;
                        }

                        var markup = "<div class='select2-result-repository clearfix d-flex'>" +
                            "<div class='select2-result-repository__avatar mr-2'><img src='" + repo.owner.avatar_url + "' class='width-2 height-2 mt-1 rounded' /></div>" +
                            "<div class='select2-result-repository__meta'>" +
                            "<div class='select2-result-repository__title fs-lg fw-500'>" + repo.full_name + "</div>";

                        if (repo.description)
                        {
                            markup += "<div class='select2-result-repository__description fs-xs opacity-80 mb-1'>" + repo.description + "</div>";
                        }

                        markup += "<div class='select2-result-repository__statistics d-flex fs-sm'>" +
                            "<div class='select2-result-repository__forks mr-2'><i class='fal fa-lightbulb'></i> " + repo.forks_count + " Forks</div>" +
                            "<div class='select2-result-repository__stargazers mr-2'><i class='fal fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
                            "<div class='select2-result-repository__watchers mr-2'><i class='fal fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
                            "</div>" +
                            "</div></div>";

                        return markup;
                    }

                    function formatRepoSelection(repo)
                    {
                        return repo.full_name || repo.text;
                    }
                });

                    },
                    complete: function() {
                    },
                    error: function(jqXHR, testStatus, error) {
                        console.log(error);
                        alert("Page " + href + " cannot open. Error:" + error);
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

           $(document).on('click', '#update-user-button', function(event) {
                event.preventDefault();
                $.ajax({
                    /* the route pointing to the post function */
                    url: $('#user_update_form').attr('action'),
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: $('#user_update_form').serialize(),
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        alert(data.msg);
                        //alert(data.status);
                        if(data.status == 'success')
                        {
                            location.reload();
                        }
                        
                    },
                    error:function(data){
                        obj = data.responseJSON.errors;
                        $.each(obj, function(key,value) {
                            $("input[name='"+key+"']").parent().addClass('alert').addClass('alert-danger');
                            $("input[name='"+key+"']").siblings('span').text(value);

                            $("select[name^='"+key+"']").parent().addClass('alert').addClass('alert-danger');
                            $("select[name^='"+key+"']").siblings('span').text(value);
                        });
                    }
                }); 
            });

        </script>
        @endsection


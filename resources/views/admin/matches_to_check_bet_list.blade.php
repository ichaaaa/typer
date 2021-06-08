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
                    <td>
                        @if(isset($questions[$match->getId()]))
                            {{$questions[$match->getId()]->description}}
                        @endif

                    </td>
                    <td>{{$match->getStatus()}}</td>
                    <td id="actions-{{$match->getId()}}">
                        <div class="btn-group" role="group">
                        @if($match->getStatus() == 'FINISHED' && isset($bets[$typer->id][$match->getId()]) && $bets[$typer->id][$match->getId()]->betResult == null )
                        <a class="btn btn-primary" href="{{route('save_bet_results_for_match', ['typer' => $typer, 'match_id'=>$match->getId()])}}" role="button">Przelicz punkty</a>
                        @endif

                        @if(!isset($questions[$match->getId()]) && $match->getStatus() == 'SCHEDULED')
                        <button type="button" class="btn btn-primary waves-effect waves-themed create-question" data-attr="{{route('create_match_question', ['typer' => $typer, 'match_id'=>$match->getId()])}}" data-toggle="modal" data-target=".default-example-modal-right-lg" data-title="{{$match->getHomeTeam()->getName()}} {{$match->getFullTimeScore()->getHomeTeamScore()}} : {{$match->getFullTimeScore()->getAwayTeamScore()}} {{$match->getAwayTeam()->getName()}}">Dodaj pytanie</button>
                        @endif
                        @if(isset($questions[$match->getId()]) && $match->getStatus() == 'SCHEDULED')
                        <button type="button" class="btn btn-primary waves-effect waves-themed edit-question" data-attr="{{route('edit_match_question', ['question'=>$questions[$match->getId()]])}}" data-toggle="modal" data-target=".default-example-modal-right-lg" data-title="{{$match->getHomeTeam()->getName()}} {{$match->getFullTimeScore()->getHomeTeamScore()}} : {{$match->getFullTimeScore()->getAwayTeamScore()}} {{$match->getAwayTeam()->getName()}}">Edytuj pytanie</button>
                        @endif

                        <button type="button" class="btn btn-primary waves-effect waves-themed show-bets-list" data-attr="{{route('match_bet_list', ['match_id'=>$match->getId(), 'typer' => $typer])}}" data-toggle="modal" data-target=".default-example-modal-right-lg" data-title="{{$match->getHomeTeam()->getName()}} {{$match->getFullTimeScore()->getHomeTeamScore()}} : {{$match->getFullTimeScore()->getAwayTeamScore()}} {{$match->getAwayTeam()->getName()}}">Pokaż typy</button> 
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Godzina</th>
                    <th>Drużyny</th>
                    <th>Wynik</th>
                    <th>Pytanie</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>                                                    
    </div>
    @endforeach
</div>
<script>
            $(document).ready(function()
            {
                $('.game-date').each(function(e){
                    if($(this).text() == "{{$closestDate}}" ){
                        $(this).click();
                    }else{
                        $(this).removeClass('active');
                    }
                });
                  var largestWidth = 0;
                  var index = 0;
                  $(".game-date").each(function() {
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
                  $(".game-date").outerWidth(finalWidth); // set the final width

                  numberOfItems = $(".game-date").length;
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
                  $(".game-date").each(function() {
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
                  $(".game-date").outerWidth(finalWidth); // set the final width

                  numberOfItems = $(".game-date").length;
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


            $(document).on("click", ".button-addon", function(event) {
                event.preventDefault();
                $(this).parent().parent().parent().parent().append("<div class=\'form-group\'><label class=\'form-label\' for=\'answer\'>Możliwa Odpowiedź</label><div class=\'input-group\'><input type=\'text\' class=\'form-control\' name=\'answer[]\'><div class=\'input-group-append\'><button class=\'btn btn-danger waves-effect waves-themed button-remove\' type=\'button\'><i class=\'fal fa-minus\'></i></button></div></div><span></span></div>");
            });

            $(document).on("click", ".button-remove", function(event) {
                event.preventDefault();
                $(this).parent().parent().parent().remove();
            });

            $(document).on('click', '.create-question', function(event) {
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

            $(document).on('click', '.edit-question', function(event) {
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

            $(document).on("click", "#store-question-button", function(event) {
               var me = $(this);
                event.preventDefault();


                $.ajax({
                    url: $("#question_create_form").attr("action"),
                    type: "POST",
                    dataType: "json",
                    data: $("#question_create_form").serialize(),
                    success: function(result) {
                      location.reload();

                    },

                    error:function(data){
                        obj = data.responseJSON.errors;
                        $.each(obj, function(key,value) {
                          //console.log(key.substring(0, 5));
                            if(key.substring(0, 6) == 'answer')
                            {
                            $("input[name^='"+key.substring(0, 6)+"']").parent().parent().addClass('alert').addClass('alert-danger');
                            $("input[name^='"+key.substring(0, 6)+"']").parent().siblings('span').text(value);
                            }
                            $("input[name='"+key+"']").parent().addClass('alert').addClass('alert-danger');
                            $("input[name='"+key+"']").siblings('span').text(value);

                            $("select[name^='"+key+"']").parent().addClass('alert').addClass('alert-danger');
                            $("select[name^='"+key+"']").siblings('span').text(value);
                        });
                    }
                    
                })                
            }); 

            $(document).on("click", "#update-question-button", function(event) {
               var me = $(this);
                event.preventDefault();


                $.ajax({
                    url: $("#question_edit_form").attr("action"),
                    type: "PUT",
                    dataType: "json",
                    data: $("#question_edit_form").serialize(),
                    success: function(result) {
                      location.reload();

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
                    
                })                
            });               

            $(document).on("click", "#delete-question-button", function(event) {
              var question_id = $(this).attr('question_id');

              let url = "{{ route('destroy_match_question', ':question_id') }}";
              url = url.replace(':question_id', question_id);

              event.preventDefault();

                $.ajax({
                    url: url,
                    type: "DELETE",
                    dataType: "json",
                    data: $("#question_edit_form").serialize(),
                    success: function(result) {
                      location.reload();

                    }
                })                
            });               

            });
</script>
@extends('layouts.app')


@section('content')


        <div class="container">
            <div class="row">
                <div id="add_report">
                <div class="col-md-10">
                    @foreach($reports_id as $id)
                        <?php $id_1 = explode( ',',$id);?>

                            @foreach($id_1 as $id_rep)

                                @foreach($reports as $report)

                                    @if($id_rep == $report['id'])
                                        @if($report['date_up'] == $report['date_down'])
                                            {{$report['date_up']}}
                                            @foreach($users as $user)
                                                @if($user['id'] == $report['id_user'])
                                                    {{$user['name'].' '.$user['surname']}}
                                                @endif
                                            @endforeach
                                            у місті {{$report['office']}} допоміг
                                            <?php $id_peoples = explode( ',',$report['id_peoples']);?>
                                                @foreach($id_peoples as $id_people)
                                                    @foreach($peoples as $people)
                                                        @if($people['id'] == $id_people)
                                                        <a href="/list/{{$people['id']}}">{{$people['surname'].' '.$people['name']}}</a>,
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            {{'"'.$report['report'].'"'}}
                                        @else
                                            з {{$report['date_up']}} по {{$report['date_down']}}
                                            @foreach($users as $user)
                                                    @if($user['id'] == $report['id_user'])
                                                        {{$user['name'].' '.$user['surname']}},
                                                @endif
                                                @endforeach
                                            у місті {{$report['office']}} допоміг
                                            <?php $id_peoples = explode( ',',$report['id_peoples']);?>
                                                @foreach($id_peoples as $id_people)
                                                    @foreach($peoples as $people)
                                                        @if($people['id'] == $id_people)
                                                        <a href="/list/{{$people['id']}}">{{$people['surname'].' '.$people['name']}}</a>,
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            {{'"'.$report['report'].'"'}}

                                        @endif
                                        <br>
                                    @endif

                                @endforeach

                            @endforeach
                            <hr>
                    @endforeach

                </div>
                <div class="col-md-2">
                    <button onclick="open_page_ajax('/report/add_page','#add_report')" style="width: 100%; margin-top: 10%" class="btn btn-success " id="button_cansel">Додати звіт</button>
                </div>




            </div>
            </div>





        </div>



<?php $pass = Hash::make('123456890+');
//echo $pass; ?>
















<script>






</script>

    @stop
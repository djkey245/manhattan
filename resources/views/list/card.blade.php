@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" >

            <div class="col-md-5">
                <table class="table table-bordered">
                    @foreach($menus as $menu)
                    <tr>
                        @if($menu->actual <50)
                        <th class="info">{{$menu->name_ukr}} </th>
                        <th class="warning"><?php echo $items->{$menu->name_eng} ;?> </th>
                        @endif
                    </tr>
                    @endforeach
                        @if(Auth::user()->actual == 2)

                                @foreach($menus as $menu)
                                    <tr>
                                        @if($menu->actual >49)


                                                <th class="info">{{$menu->name_ukr}} </th>
                                                <th class="warning"><?php echo $items->{$menu->name_eng} ;?> </th>
                                            @endif
                                        
                                    </tr>
                @endforeach
                @endif
                </table>
            </div>
            <div class="col-md-2">
                    <button class="btn btn-primary" style="width: 100%"   onclick="open_page_ajax('/list/card_edit/{{$items->id}}','#list')">Редагувати</button>
                <button onclick="cancel_hide('#list')" style="width: 100%; margin-top: 5%" class="btn btn-warning " id="button_cansel">Відмінити</button>
                @if(Auth::user()->actual == 2)
                    <button onclick="open_page_ajax('/card/comment_page_add/{{$items->id}}','#list')" style="width: 100%; margin-top: 5%" class="btn btn-default " id="button_cansel">Додати комент</button>
                    <button style="width: 100%; margin-top: 5%"  onclick="open_page_ajax('/upload/release_add/{{$items->id}}','#list')" class="btn btn-danger btn-sm">Звільнення</button>

                        @endif
                <button  class="btn btn-success" style="width: 100%; margin-top: 5%" onclick="history.back();" id="button_cansel">Назад</button>

            </div>

            <div class="col-md-5" id="list">

            </div>


    </div>
    </div>
    @if(Auth::user()->actual == 2)
    <div class="container">
        <?php $sum = 0; ;?>
        @foreach($comments as $comment)
            <?php
                $count_comments = count($comments);
                $sum += $comment['mark'] ;
                $mark = $sum/$count_comments; ?>
        @endforeach
        <div class="row">
            <div style="background-color: #f8f8f8; border-color: #e7e7e7; border: 1px solid transparent ; color: #777 ">
            <h3 id="comments" class="text-center" >Історія роботи з користувачем(kоментарі)!
                @if(!empty($mark))
                        @if($mark>3)
                            <div style="display: inline" class="text-success"> ({{$mark}}#)</div>
                        @elseif($mark<3)
                                    <div style="display: inline" class="text-danger" > ({{$mark}}#)</div>
                                @else
                                    <div style="display: inline" class="text-warning"> ({{$mark}}#)</div>
                            @endif
                    @endif
            </h3>

            </div>
            <?php
            $count_comments = count($comments);
            if($count_comments%2){
                $count_comments += 1;
            }

            $i = 1;
            ?>

                <div style="margin-top: 1%" class="col-md-6">
                    <table class="table" >

                            @foreach($comments as $comment)
                                @if($i <= $count_comments/2)
                                @if($comment['mark']>3)
                                    <tr class="success">
                                @elseif($comment['mark']<3)
                                    <tr class="danger">
                                @else
                                    <tr class="warning">
                                        @endif
                                        <td>{{$comment['data']}}</td>
                                        <td>{{$comment['comment']}}</td>
                                        <td>
                                            @foreach($users as $user)

                                                @if($comment['id_user'] == $user['id'])
                                                    {{$user['name']}} {{$user['surname']}}
                                                @endif



                                            @endforeach
                                        </td>

                                    </tr>

                                @endif
                                    <?php $i++; ?>

                        @endforeach
                    </table>
                </div>


            <div style="margin-top: 1%" class="col-md-6">
                <table class="table">
                    <?php $i = 1;?>
                    @foreach($comments as $comment)
                        @if($i > $count_comments/2)
                            @if($comment['mark']>0)
                            <tr class="success">
                                @elseif($comment['mark']<0)
                                    <tr class="danger">
                                    @else
                                    <tr>
                                    @endif
                                <td>{{$comment['data']}}</td>
                                <td>{{$comment['comment']}}</td>
                                <td>
                                    @foreach($users as $user)

                                        @if($comment['id_user'] == $user['id'])
                                            {{$user['name']}} {{$user['surname']}}
                                            @endif



                                        @endforeach

                                </td>

                            </tr>

                        @endif
                            <?php $i++; ?>

                        @endforeach
                </table>
            </div>






        </div>
    </div>
    <div class="container">
        <div class="row">
            <div style="background-color: #f8f8f8; border-color: #e7e7e7; border: 1px solid transparent ; color: #777 ">
                <h3 id="comments" class="text-center" >Звіти(рапорти) з поїздок.
                </h3>
            </div>
            @foreach($reports as $report)<br>
            @foreach($users as $user)
                @if($report['id_user'] == $user['id'])
                    {{$user['name'].' '.$user['surname']}}
                @endif
            @endforeach
            був у місті {{$report['office']}}
            @if($report['date_up'] == $report['date_down'])
                з {{$report['date_up']}} по {{$report['date_down']}}
            @else {{$report['date_up']}}
            @endif
            і допоміг працівнику {{$items->name.' '.$items->surname}} у справі
            <u>{{'"'.$report['report'].'"'}}</u><hr>
            @endforeach
        </div>
    </div>
    @endif



@stop

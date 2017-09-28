@extends('layouts.app')

@section('content')
    <script>
        function del_virtual(id){

            if (confirm("Ви впевнені?") == true) {
                var id_people = {{$items->id}};
                var id_user = document.getElementById('id_user').value;


                $.ajax({


                    type: 'POST',
                    url:'/list/delete_virtual/'+ id_people,
                    data:{'_token':"{{csrf_token()}}",
                        'id': id,
                        'id_user': id_user
                    },

                    success: function(){
                        location.reload(true);
                        //$('#list').html(msg);

                    }

                });
            } else {
                return 0;
            }

        }
    </script>
    <input type="hidden" id="id_user" value="{{Auth::user()->id}}">
    <div class="container ">
        <div class="row" >

            <div class="col-md-5" >
                <table class="table table-bordered">
                    @foreach($menus as $menu)
                    <tr>
                        @if($menu->actual <50)
                        <th >{{$menu->name_ukr}} </th>
                        <th ><?php echo $items->{$menu->name_eng} ;?> </th>
                        @endif
                    </tr>
                    @endforeach
                        @if(Auth::user()->actual == 2)

                                @foreach($menus as $menu)
                                    <tr>
                                        @if($menu->actual >49)


                                                <th >{{$menu->name_ukr}} </th>
                                                <th ><?php echo $items->{$menu->name_eng} ;?> </th>
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
                    <button class="btn btn-primary" style="width: 100%;margin-top: 5%;"   onclick="open_page_ajax('/list/server_edit/{{$items->id}}','#list')">Додати SRV</button>
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
        <div class="container border-h">
            <div class="row">
        <div class="cap" style=" border: 1px solid transparent ;  margin-bottom: 2%; ">
            <h3 id="comments" class="text-center" >Сервери та віртуалки
            </h3>

        </div>
                <ul class="thumbnails">
                    @foreach($virtuals as $virtual)

                        <div class="col-md-4">

                            <div class="thumbnail bg-success" >
                                @foreach($servers as $server)
                                    @if($virtual->id_server == $server->id)
                                        <div class="caption" style="background-color:  #d9edf7;     font-size: 14px; text-align: center; border: 1px solid transparent;  border-radius: 4px;">
                                            <button onclick="del_virtual({{$virtual->id}})" class="btn btn-sm btn-danger right" style="margin-left: 90%">x</button>
                                            <h4 style="color: black;">{{$server->name}}</h4>
                                            <p style="color: black;">{{$server->ip}}</p>
                                            @if($server->purpose == 'rdp')
                                                <p style="color: black;">RDP: {{$server->rdp}}</p>
                                                <p style="color: black;">VNC: {{$server->vnc}}</p>
                                            @elseif($server->purpose == 'vrt')
                                                <p style="color: black;">Pass: {{$server->vnc}}</p>
                                                <p style="color: black;">Other: {{$server->rdp}}</p>
                                            @endif
                                        </div>


                                        @endif
                                    @endforeach
                                <div class="caption" style="background-color:  #ecb342;     font-size: 14px; text-align: center; border: 1px solid transparent;  border-radius: 4px;">
                                    <h4 style="color: white;">{{$virtual->name}}</h4>
                                    <p style="color: white;">{{$virtual->ip}}</p>
                                    <p style="color: white;">{{$virtual->lp}}</p>
                                </div>
                            </div>




                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    <div class="container border-h" style="border-bottom: 1px solid; border-top: 1px solid;">
        <?php $sum = 0; ;?>
        @foreach($comments as $comment)
            <?php
                $count_comments = count($comments);
                $sum += $comment['mark'] ;
                $mark = $sum/$count_comments; ?>
        @endforeach
        <div class="row">
            <div class="cap" style=" border: 1px solid transparent ">
            <h3 id="comments" class="text-center" >Історія роботи з користувачем(kоментарі)!
                @if(!empty($mark))
                        @if($mark>3)
                            <div style="display: inline" class="text-green"> ({{$mark}}#)</div>
                        @elseif($mark<3)
                                    <div style="display: inline" class="text-red" > ({{$mark}}#)</div>
                                @else
                                    <div style="display: inline" class="text-yellow"> ({{$mark}}#)</div>
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
                                    <tr class="back-green">
                                @elseif($comment['mark']<3)
                                    <tr class="back-red">
                                @else
                                    <tr class="back-yellow">
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
                            <tr class="back-green">
                                @elseif($comment['mark']<0)
                                    <tr class="back-red">
                                    @else
                                    <tr class="back-yellow">
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
    <div class="container border-h">
        <div class="row">
            <div class="cap" style="border: 1px solid transparent ">
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

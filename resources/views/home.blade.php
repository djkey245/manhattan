@extends('layouts.app')

@section('content')
    @if (Auth::guest())

    @else
        @if(Auth::user()->actual == 2)

            <div class="container" >
        <div class="row" style="width: auto">
            <div class="col-md-1"></div>
            <div class="col-md-5">

                Actual

            </div>

            <div class="col-md-6" style="border-left: 1px solid black;">
            @foreach($importants as $important)
                    <?php $i = 0; ?>
                        @if(count($notactuals[$important->id]['0']) > 0)
                            @if(count($notactuals[$important->id]['0']) == 1)
                                {{$important->info}} y {{count($notactuals[$important->id]['0'])}} працівникa!
                            @elseif(count($notactuals[$important->id]['0']) > 1)
                                {{$important->info}} y {{count($notactuals[$important->id]['0'])}} працівників!
                            @endif
                    @foreach($notactuals[$important->id]['0'] as $notactual)
                            @if($i <= 2)

                                @foreach($peoples as $people )
                                    @if($people->id == $notactual)
                                        <a href="/list/{{$people->id}}">{{$people->surname.' '.$people->name}}</a>,
                                    @endif
                                    @endforeach

                            @else
                                {{" та інші"}}
                                @break
                            @endif

                    <?php $i++;?>
                @endforeach

                        <br>
                        @endif
                @endforeach
            </div>

        </div>
        <div class="row" style="padding-top: 20%">
            <hr>

            <div class="col-md-2"></div>
            <div class="col-md-8">
                    @foreach($history as $event)

                        @if($event['event'] == 'insert')

                                    <p>
                                        <b>{{$event['date']}}  </b>
                                        Користувач
                                        @foreach ($users as $usr)
                                            @if($usr['id'] == $event['id_user'])
                                                {{$usr['name'] .' '. $usr['surname']}}
                                            @endif
                                        @endforeach
                                        додав
                                        @if($event['model'] == 'peoples' )
                                            нового  працівника
                                            @foreach ($peoples as $people)
                                                @if($people['id'] == $event['data'])
                                                    <a href="/list/{{$event['data']}}">{{$people['name'] .' '. $people['surname']}}</a>
                                                @endif
                                            @endforeach

                                        @elseif($event['model'] == 'user')
                                            нового користувача
                                            @foreach ($users as $usr)
                                                @if($usr['id'] == $event['data'])
                                                    {{$usr['name'] .' '. $usr['surname']}}
                                                @endif
                                            @endforeach
                                        @elseif($event['model'] == 'menus')
                                            новий пункт меню
                                            @foreach ($menus as $menu)
                                                @if($menu['id'] == $event['data'])
                                                    {{$menu['name'] .' '. $menu['surname']}}
                                                @endif
                                            @endforeach




                                        @endif


                                    </p>

                        @elseif($event['event'] == 'update')

                                    <p>
                                        <b>{{$event['date']}}  </b>
                                        Користувач
                                        @foreach ($users as $usr)
                                            @if($usr['id'] == $event['id_user'])
                                                {{$usr['name'] .' '. $usr['surname']}}
                                            @endif
                                        @endforeach
                                        змінив дані відносно

                                        @if($event['model'] == 'peoples' )
                                            працівника @foreach ($peoples as $people)
                                                @if($people['id'] == $event['data'])
                                                    <a href="/list/{{$event['data']}}"> {{$people['name'] .' '. $people['surname']}}</a>
                                                @endif
                                            @endforeach

                                        @elseif($event['model'] == 'user')
                                            користувача @foreach ($users as $usr)
                                                @if($usr['id'] == $event['data'])
                                                    {{$usr['name'] .' '. $usr['surname']}}
                                                @endif
                                            @endforeach
                                        @elseif($event['model'] == 'menus')
                                            пункту меню @foreach ($menus as $menu)
                                                @if($menu['id'] == $event['data'])
                                                    {{$menu['name_ukr'] }}
                                                @endif
                                            @endforeach
                                        @elseif($event['model'] == 'virtual')
                                            віртуалки @foreach($virtuals as $virtual)
                                                @if($event['data'] == $virtual->id)

                                                    {{$virtual->name}} {{$virtual->ip}}
                                                @endif
                                            @endforeach
                                        @elseif($event['model'] == 'server')
                                            сервера @foreach($servers as $server)
                                                @if($event['data'] == $server->id)

                                                    {{$server->name}} {{$server->ip}}
                                                @endif
                                            @endforeach

                                        @endif
                                    </p>


                        @elseif($event['event'] == 'delete')

                                    <p>
                                        <b>{{$event['date']}}  </b>
                                        Користувач
                                        @foreach ($users as $usr)
                                            @if($usr['id'] == $event['id_user'])
                                                {{$usr['name'] .' '. $usr['surname']}}
                                            @endif
                                        @endforeach
                                        видалив
                                        @if($event['model'] == 'peoples' )
                                            працівника {{$event['data']}}

                                        @elseif($event['model'] == 'user')
                                            користувача {{$event['data']}}
                                        @elseif($event['model'] == 'menus')
                                            пункт меню {{$event['data']}}
                                        @elseif($event['model'] == 'server')
                                            сервер {{$event['data']}}
                                        @elseif($event['model'] == 'virtual')
                                            віртуалку <b>{{$event['data']}}</b> з сервера
                                            @foreach($servers as $server)
                                                @if($event['plus'] == $server->id)

                                                    <a href="/server/{{$server->id}}">{{$server->name}}</a>
                                                @endif
                                            @endforeach
                                        @endif
                                    </p>


                        @elseif($event['event'] == 'comment')

                                    <p>
                                        <b>{{$event['date']}}  </b>
                                        Користувач
                                        @foreach ($users as $usr)
                                            @if($usr['id'] == $event['id_user'])
                                                {{$usr['name'] .' '. $usr['surname']}}
                                            @endif
                                        @endforeach
                                        прокоментував

                                        працівника @foreach ($peoples as $people)
                                            @if($people['id'] == $event['data'])
                                                <a href="/list/{{$event['data']}}">{{$people['name'] .' '. $people['surname']}}</a>
                                            @endif
                                        @endforeach



                                    </p>


                        @elseif($event['event'] == 'report')

                                    <p>
                                        <b>{{$event['date']}}  </b>
                                        Користувач
                                        @foreach ($users as $usr)
                                            @if($usr['id'] == $event['id_user'])
                                                {{$usr['name'] .' '. $usr['surname']}}
                                            @endif
                                        @endforeach
                                        написав звіт

                                        відносно поїздки  <a href="/report">{{$event['data']}}</a>



                                    </p>


                        @elseif($event['event'] == 'moving')

                                    <p>
                                        <b>{{$event['date']}}  </b>
                                        Користувач
                                        @foreach ($users as $usr)
                                            @if($usr['id'] == $event['id_user'])
                                                {{$usr['name'] .' '. $usr['surname']}}
                                            @endif
                                        @endforeach
                                        переніс віртуалку "
                                        @foreach($virtuals as $virtual)
                                            @if($event['data'] == $virtual->id)

                                                {{$virtual->name}}
                                            @endif
                                        @endforeach"
                                        на сервер
                                        @foreach($servers as $server)
                                            @if($event['plus'] == $server->id)

                                                <a href="/server/{{$server->id}}"> {{$server->name}}  </a> IP:{{$server->ip}}
                                            @endif
                                        @endforeach



                                    </p>


                        @elseif($event['event'] == 'create')

                                    <p>
                                        <b>{{$event['date']}}  </b>
                                        Користувач
                                        @foreach ($users as $usr)
                                            @if($usr['id'] == $event['id_user'])
                                                {{$usr['name'] .' '. $usr['surname']}}
                                            @endif
                                        @endforeach
                                        створив
                                        @if($event['model'] == 'virtual')

                                            віртуалку на сервері
                                            @foreach($servers as $server)
                                                @if($event['data'] == $server->id)

                                                    <a href="/server/{{$server->id}}"> {{$server->name}}  </a> IP:{{$server->ip}}
                                                @endif
                                            @endforeach
                                        @elseif($event['model'] == 'server')
                                            сервер
                                            @foreach($servers as $server)
                                                @if($event['data'] == $server->id)

                                                    <a href="/server/{{$server->id}}"> {{$server->name}}  </a> IP:{{$server->ip}}
                                                @endif
                                            @endforeach
                                        @endif
                                    </p>




                        @endif
                    @endforeach


                <center><div >{{$history->links()}}</div></center></div>
            <div class="col-md-2"></div>

        </div>
    </div>

        @endif
        @endif
@endsection

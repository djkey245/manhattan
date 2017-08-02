@extends('layouts.app')

@section('content')
    @if (Auth::guest())

    @else
        @if(Auth::user()->actual == 2)

            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 col-sm-12">
                        <table class="table">
                            <tbody>
                                    @foreach($history as $event)

                                        @if($event['event'] == 'insert')
                                            <tr>
                                                <td>
                                                <p>Користувач
                                                    @foreach ($users as $usr)
                                                    @if($usr['id'] == $event['id_user'])
                                                        {{$usr['name'] .' '. $usr['surname']}}
                                                    @endif
                                                    @endforeach
                                                    додав @if($event['model'] == 'peoples' )
                                                              нового  працівника @foreach ($peoples as $people)
                                                            @if($people['id'] == $event['data'])
                                                                <a href="/list/{{$event['data']}}">{{$people['name'] .' '. $people['surname']}}</a>
                                                            @endif
                                                        @endforeach

                                                            @elseif($event['model'] == 'user')
                                                              нового користувача @foreach ($users as $usr)
                                                            @if($usr['id'] == $event['data'])
                                                                {{$usr['name'] .' '. $usr['surname']}}
                                                            @endif
                                                        @endforeach
                                                            @elseif($event['model'] == 'menus')
                                                              новий пункт меню @foreach ($menus as $menu)
                                                            @if($menu['id'] == $event['data'])
                                                                {{$menu['name'] .' '. $menu['surname']}}
                                                            @endif
                                                        @endforeach
                                                            @endif
                                                </p></td>
                                                <td>{{$event['date']}}</td>
                                            </tr>
                                            @elseif($event['event'] == 'update')
                                            <tr><td>
                                                <p>Користувач
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
                                                </p></td>
                                                <td>{{$event['date']}}</td>

                                            </tr>
                                        @elseif($event['event'] == 'delete')
                                            <tr><td>
                                                <p>Користувач
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
                                                </p></td>
                                                <td>{{$event['date']}}</td>

                                            </tr>
                                        @elseif($event['event'] == 'comment')
                                            <tr><td>
                                                <p>Користувач
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



                                                </p></td>
                                                <td>{{$event['date']}}</td>

                                            </tr>
                                        @elseif($event['event'] == 'report')
                                            <tr><td>
                                                    <p>Користувач
                                                        @foreach ($users as $usr)
                                                            @if($usr['id'] == $event['id_user'])
                                                                {{$usr['name'] .' '. $usr['surname']}}
                                                            @endif
                                                        @endforeach
                                                        написав звіт

                                                        відносно поїздки  <a href="/report">{{$event['data']}}</a>



                                                    </p></td>
                                                <td>{{$event['date']}}</td>

                                            </tr>
                                        @elseif($event['event'] == 'moving')
                                            <tr><td>
                                                    <p>Користувач
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
                                                        на інший сервер.



                                                    </p></td>
                                                <td>{{$event['date']}}</td>

                                            </tr>
                                            @endif
                                        @endforeach

                            </tbody>
                        </table>
                        <center><div >{{$history->links()}}</div></center>
                    </div>
                    <div class="col-md-2">


                    </div>
                </div>
            </div>





        @endif
    @endif
@stop

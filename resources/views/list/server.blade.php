@extends('layouts.app')



@section('content')

    <div class="container">
        <div class="row"><div id="serv">
            <div class="col-md-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">Ім’я:</div>
                        <div class="col-md-4">ІР:</div>
                        <div class="col-md-4">К-ть віртуалок</div>
                    </div>
                    <hr>
                        @foreach($servers as $server )
                        <div class="row">
                            <a href="/server/{{$server->id}}">
                            <div class="col-md-4">{{$server->name}}</div>
                            <div class="col-md-4">{{$server->ip}}</div>
                            <div class="col-md-4"><?php $i = 0;?>
                                @foreach($virtuals as $virtual)

                                        @if($server->id == $virtual->id_server)
                                            <?php $i++;?>
                                        @endif
                                    @endforeach
                                {{$i}}
                            </div>
                            </a>
                        </div>
                        <hr>
                        @endforeach

                </div>
            </div>
            <div class="col-md-2">
                <button onclick="open_page_ajax('/server/page_add','#serv')" style="width: 100%; margin-top: 10%" class="btn btn-success ">Додати сервер</button>
            </div>
            </div></div>
    </div>

























    @stop
@extends('layouts.app')



@section('content')
@if(Auth::user()->actual == 2)
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
                <button onclick="open_page_ajax('/server/page_add','#serv')"  class="btn btn-success ">+</button>
                <button onclick="open_page_ajax('/server/page_move','#serv')"  class="btn btn-primary ">Перенести</button>
            </div>
            </div></div>
    </div>




@endif




















    @stop
@extends('layouts.app')



@section('content')
@if(Auth::user()->actual == 2)
    <div class="container">
        <div class="row"><div id="serv">
            <div class="col-md-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">Ім’я:</div>
                        <div class="col-md-3">ІР:</div>
                        <div class="col-md-2">Кількість об’єктів:</div>
                        <div class="col-md-2">Тип:</div>
                    </div>
                    <br>
                        @foreach($servers as $server )
                        <div class="row" >
                            <a href="/server/{{$server->id}}">
                            <div class="col-md-3">{{$server->name}}</div>
                            <div class="col-md-3">{{$server->ip}}</div>
                            <div class="col-md-2"><?php $i = 0;?>
                                @foreach($virtuals as $virtual)

                                        @if($server->id == $virtual->id_server)
                                            <?php $i++;?>
                                        @endif
                                    @endforeach
                                {{$i}}
                            </div>
                                <div class="col-md-2">{{$server->purpose}}</div>

                            </a>
                        </div>
                        <br>

                        @endforeach

                </div>
            </div>
            <div class="col-md-2">
                <button onclick="open_page_ajax('/server/page_add_vrt','#serv')" style="width:100px"  class="btn btn-success ">+VIRT</button>                        <br>


                <button onclick="open_page_ajax('/server/page_add_rdp','#serv')"  style="width:100px"  class="btn btn-success ">+RDP</button>                        <br>

                <button onclick="open_page_ajax('/server/page_move','#serv')"  style="width:100px"  class="btn btn-primary ">Перенести</button>                        <br>

            </div>
            </div></div>
    </div>




@endif




















    @stop
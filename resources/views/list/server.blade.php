@extends('layouts.app')



@section('content')
@if(Auth::user()->actual == 2)
    <div class="container">
        <div class="row"><div id="serv">
            <div class="col-md-10">
                <div class="container">
                    <div class="row">
                        <form action="/server/search" method="post" class="form-inline">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input id="search"  type="text" style="width: 60%; margin-left: 2%" name="referal" placeholder="Пошук..."  class="form-control" >
                            <button type="submit"  class="btn btn-primary"  value="Пошук">Пошук SRV</button>
                        </form>
                        <br>

                    @if(empty($ids))
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
                    @else
                        <div class="col-md-3">Ім’я об'єкту:</div>
                        <div class="col-md-3">Ім’я сервера:</div>
                        <div class="col-md-2">ІР:</div>
                        <div class="col-md-2">Кількість об’єктів:</div>
                        <div class="col-md-2">Тип:</div>
                </div>
                <br>
                        @foreach($virtuals as $virtual )



                            @foreach($servers as $server)
                                @if($server->id == $virtual->id_server )
                                    @foreach($ids as $id)
                                        @if($id == $virtual->id)<br>
                                                <div class="row" >
                                                    <a href="/server/{{$server->id}}">
                                                        <div class="col-md-3">{{$virtual->name}}</div>
                                                        <div class="col-md-3">{{$server->name}}</div>
                                                        <div class="col-md-2">{{$server->ip}}</div>
                                                        <div class="col-md-2"><?php $i = 0;?>
                                                            @foreach($virtuals as $virtual)

                                                                @if($server->id == $virtual->id_server)
                                                                    <?php $i++;

                                                                    ?>


                                                                @endif
                                                            @endforeach
                                                            {{$i}}
                                                        </div>
                                                        <div class="col-md-2">{{$server->purpose}}</div>

                                                    </a>
                                                </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach



                        @endforeach

                    @endif
                <div class="row" >
                    <a href="/servers/without">
                        <div class="col-md-3">Віртуалки без сервера</div>
                        <div class="col-md-3"></div>
                        <div class="col-md-2"><?php $i = count($virtualWithoutServer);?>

                            {{$i}}
                        </div>
                        <div class="col-md-2"></div>

                    </a>
                </div>
                <br>
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
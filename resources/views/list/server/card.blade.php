@extends('layouts.app')



@section('content')
    <script>



        function next_page_add() {
            var id = document.getElementById('id').value;

            $.ajax({

                type: 'post',
                url: '/server/add_virtual',
                dataType: 'html',
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id


                },
                success: function (message) {

                    $("#serv").html(message);
                    //location.reload(true);

                }


            });


        }

    </script>
    @foreach($servers as $server)

    <input type="hidden" id="id" value="{{$id}}">
    <div class="container-fluid">
        <div id="serv">
            <div id="server">
        <div class="row">
                <div class="col-md-9">
                    <div class="container ">
                            <div class="block">

                                @if($server['purpose'] == 'rdp')

                                <div class="row">
                                    <div class="col-md-1"> </div>
                                    <div class="col-md-2" ><h4 >Ім’я:</h4></div>
                                    <div class="col-md-2"><h4>ІР:</h4></div>
                                    <div class="col-md-2"><h4>RDP:</h4></div>
                                    <div class="col-md-2"><h4>VNC:</h4></div>
                                    <div class="col-md-3"> <h4><b>SRV RDP</b></h4></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"> </div>
                                        <div class="col-md-2" ><h5>{{$server->name}}</h5></div>
                                        <div class="col-md-2"><h5>{{$server->ip}}</h5></div>
                                        <div class="col-md-2"><h5>{{$server->rdp}}</h5></div>
                                        <div class="col-md-2"><h5>{{$server->vnc}}</h5></div>
                                        <div class="col-md-3"></div>
                                </div>
                                @elseif($server['purpose'] == 'vrt')
                                    <div class="row">
                                        <div class="col-md-1"> </div>
                                        <div class="col-md-2" ><h4 >Ім’я:</h4></div>
                                        <div class="col-md-2"><h4>ІР:</h4></div>
                                        <div class="col-md-2"><h4>Login:</h4></div>
                                        <div class="col-md-2"><h4>Pass:</h4></div>
                                        <div class="col-md-2"><h4>VNC:</h4></div>
                                        <div class="col-md-1"><h4><b>SRV VRT</b></h4> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"> </div>
                                        <div class="col-md-2" ><h5>{{$server->name}}</h5></div>
                                        <div class="col-md-2"><h5>{{$server->ip}}</h5></div>
                                        <div class="col-md-2"><h5>{{$server->login}}</h5></div>
                                        <div class="col-md-2"><h5>{{$server->rdp}}</h5></div>
                                        <div class="col-md-2"><h5>{{$server->vnc}}</h5></div>
                                        <div class="col-md-1"></div>
                                    </div>

                                @endif
                            <br><br><br><br>
                        </div>




                    </div>
                </div>

                <div class="block col-md-2" style="margin-top: 1.45%">
                    <button onclick="next_page_add()" style="width: 100%; margin-top: 5%" class="btn btn-success ">Додати віртуалку</button>
                    <button onclick="edit_server({{$server->id}})" style="width: 100%; margin-top: 5%" class="btn btn-primary ">Редагувати сервер</button>
                    <button onclick="delete_server({{$server->id}})" style="width: 100%; margin-top: 5%" class="btn btn-danger ">Видалити сервер</button>
                </div>
            </div>

        <div class="row block">
            <div class="alert-contr">
                <div class="exit">
                    <button class="btn btn-sm btn-danger left" onclick="$('.alert-contr').hide()">x</button>
                </div>
<?php $i = 0; ?>
                @foreach($contracts as $contract)

                    <input type="radio" checked name="contr" value="{{$contract->id}}">
                    <label class="radio-inline"><b>
                        {{$contract->name.' '.$contract->ip.' '}}
                        @if($contract->ppp0e == 1)
                            ppp0e
                        @elseif($contract->nat == 1)
                            nat
                        @elseif($contract->mac == 1)
                            mac
                        @endif</b>
                    </label>
                    <br>
                @endforeach
                <input type="radio" checked name="contr" value="0">
                <label class="radio-inline">
                    <b>none
                    </b>
                </label>
                <br>
                <br>
                <button class="btn btn-primary" onclick="save_contr()">Save</button>
            </div>
            <ul class="thumbnails">
            @foreach($virtuals as $virtual)

            <div class="col-md-4">

                            <div class="thumbnail bg-success" style="background-color:  #ec971f;    margin-top: 2; font-size: 14px; text-align: center; border: 1px solid transparent;  border-radius: 4px;">

                                <div class="caption">
                                    <div class="btn-group" style="padding-left: 80%">
                                        <button onclick="add_contr({{$virtual->id}})" class="btn btn-sm btn-success right " >+</button>
                                        <button onclick="edit_vrt( {{$virtual->id}} )" class="btn btn-sm btn-primary right " >-</button>

                                        <button onclick="delete_virtuals({{$virtual->id}})" class="btn btn-sm btn-danger right" >x</button>

                                    </div>
                                    <h4 style="color: white;">{{$virtual->name}}</h4>
                                    <h4 style="color: red;">{{$virtual->os}}</h4>
                                    <p style="color: white;">{{$virtual->ip}}</p>
                                    <p style="color: white;">{{$virtual->lp}}</p>
                                    <h4 style="color: red;">{{$virtual->purpose}}</h4>

                                    <h4 style="color: white; display: inline-block">
                                        @foreach($peoples as $people)
                                            <?php $vrts = explode(',', $people->virtuals);  ?>
                                            @foreach($vrts as $virt)
                                                @if($virt == $virtual->id)
                                                        <a href="/list/{{$people->id}}">{{$people->surname.' '.$people->name}}</a>
                                                        <p style="margin-top: 3px; color: #4d54c7 ">{{$people->profession.' '.$people->office}}</p>

                                                    @endif
                                            @endforeach
                                        @endforeach

                                    </h4>
                                    <a style="display: inline-block; text-align: right; padding-left: 70%; cursor: pointer" onclick="$('#contr-{{$virtual->id}}').toggle()"  >Detail</a>
                                </div>
                                <div class="card-contr container-fluid" id="contr-{{$virtual->id}}">

                                    @foreach($contracts as $contract)
                                                @if($contract->id == $virtual->contracts_id)
                                                    <b style="color: black">
                                                    Name: {{$contract->name}}<br>
                                                    Type: @if($contract->ppp0e == 1)
                                                        ppp0e <br>
                                                              ppp0e: {{$contract->ppp0e_login}}<br>
                                                              pass: {{$contract->pass}}<br>
                                                    @elseif($contract->nat == 1)
                                                        nat<br>
                                                              nat: {{$contract->nat_login}}<br>
                                                    @elseif($contract->mac == 1)
                                                        mac<br>
                                                    @endif
                                                    MAC: {{$contract->mac_address}}<br>
                                                    IP: {{$contract->ip}}

                                                    </b>
                                                @endif

                                        @endforeach
                                </div>
                            </div>




            </div>
            @endforeach
            </ul>



        </div>
    </div>
        </div>
    </div>

    @endforeach
    <script>
        function edit_vrt(id){
            var block_a = document.querySelectorAll("a .block-sidebar-menu .all-text-sidebar-menu .text-sidebar-menu");
            //block_a.text();

            $.ajax({

                type: 'post',
                url: '/server/edit_virtual_page',
                dataType: 'html',
                data:{
                    '_token': "{{csrf_token()}}" ,
                    'id': id


                },
                success: function (message) {

                    $("#serv").html(message);
                    //location.reload(true);

                }



            });


        }
        function edit_server(id){


            $.ajax({

                type: 'post',
                url: '/server/edit_server_page',
                dataType: 'html',
                data:{
                    '_token': "{{csrf_token()}}" ,
                    'id': id


                },
                success: function (message) {

                    $("#serv").html(message);
                    //location.reload(true);

                }



            });


        }
        function delete_virtuals(id){

            if (confirm("Ви впевнені?") == true) {

                var id_user = {{Auth::user()->id}};
                var id_server = document.getElementById('id').value;

                $.ajax({


                    type: 'put',
                    url:'/server/delete_virtual/',
                    data:{'_token':"{{csrf_token()}}",
                        'id': id,
                        'id_user': id_user,
                        'id_server': id_server
                    },
                    dataType: 'html',
                    success: function(message){
                        location.reload(true);
                        //$("#server").html(message);


                    }

                });
            } else {
                return 0;
            }

        }
        function delete_server(id){

            if (confirm("Ви впевнені?") == true) {

                var id_user = {{Auth::user()->id}};
                var id_server = document.getElementById('id').value;

                $.ajax({


                    type: 'put',
                    url:'/server/delete_server/',
                    data:{'_token':"{{csrf_token()}}",
                        'id': id,
                        'id_user': id_user,
                        'id_server': id_server
                    },
                    dataType: 'html',
                    success: function(message){
                        document.location.replace("/server");
                        //$("#server").html(message);


                    }

                });
            } else {
                return 0;
            }

        }
        var  contr_vrt_id = 0;
        function add_contr(vrt_id) {
                $('.alert-contr').show();
                contr_vrt_id = vrt_id;
        }

        function save_contr() {
            var name_contr = document.getElementsByName('contr');
            var a = name_contr.length;
            var id_contr;
            for(var i = 0; i<a; i++){
                if(name_contr[i].checked){
                    id_contr = name_contr[i].value;
                }
            }
            $.ajax({
                type: "POST",
                url: "/contracts/virtual",
                data:{
                    _token: "{{csrf_token()}}",
                    id_contr: id_contr,
                    id_vrt: contr_vrt_id
                },
                success: function () {
                    location.reload(true);
                }
            });
        }
    </script>
@stop

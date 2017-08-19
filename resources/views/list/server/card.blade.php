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
    <div class="container">
        <div id="serv">
            <div id="server">
        <div class="row">
                <div class="col-md-10">
                    <div class="container ">
                        <div class="thumbnail ">
                            <div class="">

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
                                        <div class="col-md-2" ><h4 >Ім’я(Login):</h4></div>
                                        <div class="col-md-2"><h4>ІР:</h4></div>
                                        <div class="col-md-3"><h4>Pass:</h4></div>
                                        <div class="col-md-3"><h4><b>SRV VRT</b></h4> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"> </div>
                                        <div class="col-md-2" ><h5>{{$server->name}}</h5></div>
                                        <div class="col-md-2"><h5>{{$server->ip}}</h5></div>
                                        <div class="col-md-3"><h5>{{$server->vnc}}</h5></div>
                                        <div class="col-md-3"></div>
                                    </div>

                                @endif
                            </div>
                            <br><br><br><br>
                        </div>




                    </div>
                </div>

                <div class="col-md-2">
                    <button onclick="next_page_add()" style="width: 100%; margin-top: 10%" class="btn btn-success ">Додати віртуалку</button>
                    <button onclick="edit_server({{$server->id}})" style="width: 100%; margin-top: 5%" class="btn btn-primary ">Редагувати сервер</button>
                    <button onclick="delete_server({{$server->id}})" style="width: 100%; margin-top: 5%" class="btn btn-danger ">Видалити сервер</button>
                </div>
            </div>

        <div class="row">
            <ul class="thumbnails">
            @foreach($virtuals as $virtual)

            <div class="col-md-4">

                            <div class="thumbnail bg-success" style="background-color:  #ec971f;    margin-top: 2; font-size: 14px; text-align: center; border: 1px solid transparent;  border-radius: 4px;">

                                <div class="caption">
                                    <div class="btn-group" style="padding-left: 80%">
                                        <button onclick="edit_vrt( {{$virtual->id}} )" class="btn btn-sm btn-primary right " >-</button>

                                        <button onclick="delete_virtuals({{$virtual->id}})" class="btn btn-sm btn-danger right" >x</button>

                                    </div>
                                    <h4 style="color: white;">{{$virtual->name}}</h4>
                                    <p style="color: white;">{{$virtual->ip}}</p>
                                    <p style="color: white;">{{$virtual->lp}}</p>
                                    <h4 style="color: white;">
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
    </script>
@stop
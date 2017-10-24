<script>
    function next_krok(type) {
        var id_people = {{$id}};
        if (type == 'rdp'){
            var id = document.getElementsByName('srv_rdp');
            var a = id.length;
            var id_server_rdp;

            for (var i = 0; i < a; i++) {
            if (id[i].checked) {
                id_server_rdp = id[i].value;
            }
        }

            $.ajax({


                type:'post',
                url: '/list/virtual_edit_rdp/'+id_people,
                data:{'_token':"{{csrf_token()}}",
                    'id_server': id_server_rdp,
                    'type': 'rdp'

                },
                dataType: 'html',
                success: function (message) {


                    $('#rdp').html(message);

                }
            });
    }
        else{

            var id = document.getElementsByName('srv_vrt');
            var a = id.length;
            var id_server_vrt;

            for (var i = 0; i < a; i++) {
                if (id[i].checked) {
                    id_server_vrt = id[i].value;
                }
            }
            $.ajax({


                type:'post',
                url: '/list/virtual_edit_vrt/'+id_people,
                data:{'_token':"{{csrf_token()}}",
                    'id_server': id_server_vrt,
                    'type': 'vrt'

                },
                dataType: 'html',
                success: function (message) {


                    $('#vrt').html(message);
exit;
                }
            });
        }


    }
    
    
    
    
</script>

<div class="row" style="margin-left: 10%">
<div class="col-md-10" >
    <center>RDP</center>
    <div id="rdp">
@foreach($srv_rdp as $server)

    <label class="radio" style="width: 100%;display: flex">
        <input type="radio" name="srv_rdp" checked value="{{$server->id}}">
        {{$server->name.' '.$server->ip}}
    </label>

    @endforeach
    <button class="btn btn-primary" style="margin-top: 5%; margin-left: 10%;"   onclick="next_krok('rdp')">Далі..</button>
    </div>
</div>
</div>
<br>
<br>
<div class="row" style="margin-left: 10%">
<div class="col-md-10" >
    <center>VRT</center>
    <div id="vrt">

    @foreach($srv_vrt as $server)

        <label class="radio" style="width: 100%;display: flex">
            <input type="radio" name="srv_vrt"  checked value="{{$server->id}}">
            {{$server->name.' '.$server->ip}}
        </label>

    @endforeach
    <button class="btn btn-primary" style="margin-top: 5%; margin-left: 10%;"   onclick="next_krok('vrt')">Далі..</button>
    </div>
</div>
    </div>